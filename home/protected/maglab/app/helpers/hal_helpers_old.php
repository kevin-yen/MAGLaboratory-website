<?php

##### HELPERS
# TODO: Wrap this in an object
function get_mysqli(){
  global $mysqli;
  if($mysqli){
    return $mysqli;
  } else {
    try {
      $mysqli = new mysqli(mysql_host, mysql_user, mysql_pass, mysql_db);
    } catch (Exception $e){
      $mysqli = false;
    }
    if(mysqli_connect_errno()){
      return false;
    }
    return $mysqli;
  }
}

function get_mysqli_or_die(){
  $mysqli = get_mysqli();
  if($mysqli){ return $mysqli; }
  else { die('unable to connect to database'); }
}


function filter_email($text, $html = true){
  $filtered = filter_var($text, FILTER_SANITIZE_EMAIL);
  return ($html ? htmlspecialchars($filtered, ENT_QUOTES | ENT_HTML5) : $filtered);
}

# htmlentities works in value attribute, so no need to use this?
#function filter_text_basic($text, $html = true){
#  return ($html ? htmlspecialchars($text, ENT_QUOTES | ENT_HTML5) : $text);
#}

function filter_text($text){
  return htmlentities($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function base64url_encode($data) { 
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

function base64url_decode($data) { 
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
}

function random_b64($length = 21){
  return base64url_encode(openssl_random_pseudo_bytes($length));
}

##### END HELPERS

##### HALDOR HELPERS


function base64_urlencode($data) { 
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

function generate_session(){
  return base64_urlencode(openssl_random_pseudo_bytes(30));
}

function authenticate($req) {
  if(SKIP_CHECKSUM){
    return true;
  }
  
  global $secret;
  $input = file_get_contents('php://input');
  $session = $req->getHeader('X-Session');
  $hmac = hash_hmac('sha256', $input . $session, $secret, false);
  if($hmac != $req->getHeader('X-Checksum')){
    die("AUTH FAIL");
  } else {
    return true;
  }
}

function save_payload($req){
  $post = $req->getParsedBody();
  $session = $req->getHeader('X-Session');
  
  $mysqli = get_mysqli();
  if(!$mysqli){ return false; }
  
  if($stmt = $mysqli->prepare("INSERT INTO haldor_payloads (payload, session) VALUES (?, ?)")){
    $stmt->bind_param('ss', json_encode($post), $session);
    $stmt->execute();
    $stmt->close();
  } else {
    return false;
  }
}

function save_switches($req) {
  $post = $req->getParsedBody();
  $session = $req->getHeader('X-Session');
  $checks = ['Front_Door', 'Main_Door', 'Office_Motion', 'Shop_Motion', 'Open_Switch', 'Temperature'];

  mark_old_switches();

  foreach($checks as $i => $sensor){
    if(isset($post[$sensor])){
      update_switch($sensor, $session, $post[$sensor]);
    }
  }

  update_switch('Boot', $session, '1');
}

function mark_old_switches(){
  $mysqli = get_mysqli();
  if(!$mysqli){ return false; }
  
  # If the last response we got was over 15 minutes ago, it means we missed 3 update payloads
  # assume we lost connectivity and mark them as ended.
  
  $mysqli->real_query("UPDATE haldor SET end_at = NOW(), mark_at = NOW() WHERE end_at IS NULL AND progress_at < DATE_SUB(NOW(), INTERVAL 15 MINUTE)");

}

function update_switch($sensor, $session, $value){
  $mysqli = get_mysqli();
  if(!$mysqli){ return false; }
  
  $ival = (int)$value;
  $query = null;
  if($ival < 1){
    # TODO: Treat Motion type sensors differently because they're instantaneous
    # Item is no longer open, mark end_at
    $query = "UPDATE haldor SET progress_count = progress_count + 1, end_at = NOW(), last_value = ? WHERE sensor = ? AND end_at IS NULL AND session = ?";
  } else {
    $query = "UPDATE haldor SET last_value = ?, progress_count = progress_count + 1, progress_at = NOW() WHERE sensor = ? AND end_at IS NULL AND session = ?";
  }
  
  if($stmt = $mysqli->prepare($query)){
    $stmt->bind_param('sss', $value, $sensor, $session);
    $stmt->execute();
    if($ival >= 1 && $mysqli->affected_rows == 0){
      insert_switch($sensor, $session);
      # If we couldn't update when sensor is on, it means this is newly activated
      # so we'll have to do an insert.
      # If it's off, we don't care
    }
    
    $stmt->close();
  } else {
    return false;
  }
}

function set_boot_switch($req, $session){
  $post = $req->getParsedBody();
  
  $mysqli = get_mysqli();
  if(!$mysqli){ return false; }
  
  if($stmt = $mysqli->prepare("INSERT INTO haldor_payloads (payload, session) VALUES (?, ?)")){
    $stmt->bind_param('ss', json_encode($post), $session);
    $stmt->execute();
    $stmt->close();
  } else {
    return false;
  }
  
  mark_old_switches();
  insert_switch('Boot', $session);
}

function insert_switch($sensor, $session){
  $mysqli = get_mysqli();
  if(!$mysqli){ return false; }
  
  if($stmt = $mysqli->prepare("INSERT INTO haldor (sensor, start_at, progress_at, session, created_at) VALUES (?, NOW(), NOW(), ?, NOW())")){
    $stmt->bind_param('ss', $sensor, $session);
    $stmt->execute();
    $stmt->close();
  } else {
    return false;
  }
}

function parse_halley_output($app){
  $post = $app->request->post();
  $session = $app->request->headers->get('X-Session');
  
  $mysqli = get_mysqli();
  if(!$mysqli){ return false; }
  
  $now = time();
  
  $rfid = null;
  $open_at = null;
  $denied_at = null;

  preg_match_all('/User (\d+) presented tag.+?(denied|granted) access at/s', $post['output'], $matches, PREG_SET_ORDER);
  
  if($stmt = $mysqli->prepare("INSERT INTO space_invaders (keycode, open_at, denied_at, created_at) VALUES (?, FROM_UNIXTIME(?), FROM_UNIXTIME(?), NOW())")){
    foreach($matches as $match){
      $rfid = $match[1];
      if($match[2] == 'denied'){
        $open_at = null;
        $denied_at = $now;
      } else {
        $open_at = $now;
        $denied_at = null;
      }
      $stmt->bind_param('sii', $rfid, $open_at, $denied_at);
      $stmt->execute();
    }
    $stmt->close();
  }
  
  return true;
}
##### END HALDOR HELPERS

##### HAL HELPERS
function timeline_graph_data($from, $to){
  $mysqli = get_mysqli();
  if($stmt = $mysqli->prepare("SELECT sensor, UNIX_TIMESTAMP(start_at), UNIX_TIMESTAMP(progress_at), UNIX_TIMESTAMP(end_at) FROM haldor WHERE start_at BETWEEN FROM_UNIXTIME(?) AND FROM_UNIXTIME(?) AND (end_at IS NULL OR end_at BETWEEN FROM_UNIXTIME(?) AND FROM_UNIXTIME(?))")){
    $stmt->bind_param('iiii', $from, $to, $from, $to);
    $stmt->execute();
    if($res = $stmt->get_result()){
      $data = $res->fetch_all();
      return $data;
    }
  }
  return null;
}

function timeline_graph_json($from, $to){
  $data = timeline_graph_data($from, $to);
  if($data){
    $response = [];
    
    foreach($data as $value){
      $name = str_replace('_', ' ', $value[0]);
      $end_at = $value[1];
      if($value[2] && $value[2] > $end_at){
        $end_at = $value[2];
      }
      
      if($value[3] && $value[3] > $end_at){
        $end_at = $value[3];
      }
      array_push($response, "['${name}', '', new Date(${value[1]}000), new Date(${end_at}000)]");
    }
  
    $response = implode(",\n", $response);
    return "[${response}]";
  }  
  # [Name, Subname, from, to]
  return "[]";
}

function get_latest($sensor){
  $mysqli = get_mysqli();
  if($stmt = $mysqli->prepare("SELECT UNIX_TIMESTAMP(progress_at), UNIX_TIMESTAMP(end_at), UNIX_TIMESTAMP(mark_at), last_value FROM haldor WHERE sensor = ? ORDER BY progress_at DESC LIMIT 1")){
    $stmt->bind_param('s', str_replace(' ', '_', $sensor));
    $stmt->execute();
    if($res = $stmt->get_result()){
      $data = $res->fetch_all()[0];
      return $data;
    }
  }

  return null;
}

function latest_changes(){
  $change_items = array(
    'Open Switch' => [],
    'Front Door' => [],
    'Main Door' => [],
    'Office Motion' => [],
    'Shop Motion' => [],
    'Temperature' => []
    );
  
  $now = time();
  $last_update_time = 0;
  
  // TODO: May be better to manually run each one to avoid extra strpos calls
  foreach($change_items as $sensor => &$value){
    $data = get_latest($sensor);
    
    if($data == null){
      array_push($value, 'No Data');
      array_push($value, null);
      array_push($value, false);
      continue;
    }
    
    # Doors are either open or closed. Easy
    if(strpos($sensor, 'Door') !== false){
      if($data[1] == null && $data[2] == null){
        array_push($value, 'Open');
        array_push($value, $data[0]);
        array_push($value, true);
      } else {
        array_push($value, 'Closed');
        array_push($value, $data[1] | $data[2]);
        array_push($value, false);
      }
    }
    
    if(strpos($sensor, 'Motion') !== false){
      if($data[1] == null && $data[2] == null){
        array_push($value, 'Moving');
        array_push($value, $data[0]);
        array_push($value, true);
      } elseif($now - 20*60 < $data[0] && ($data[1] or $data[2])){
        array_push($value, 'Moving');
        array_push($value, $data[0]);
        array_push($value, true);
      } else {
        array_push($value, 'No Movement since');
        array_push($value, $data[0]);
        array_push($value, false);
      }
    }
    
    if(strpos($sensor, 'Switch') !== false){
      if($data[1] == null && $data[2] == null){
        array_push($value, 'Flipped ON');
        array_push($value, $data[0]);
        array_push($value, true);
      } else {
        array_push($value, 'Flipped OFF');
        array_push($value, $data[1] | $data[2]);
        array_push($value, false);
      }
    }
    
    if($sensor == 'Temperature'){
      array_push($value, '' . sprintf("%.2f °C/ %.2f °F", (($data[3] | 0) / 1000), ((($data[3] | 0) / 1000)*1.8 + 32)));
      array_push($value, $data[2] | $data[1] | $data[0]);
    }
    
    if($value[1] and $value[1] > $last_update_time){
      $last_update_time = $value[1];
    }
  }

  $change_items['Page Loaded'] = ['at', $now];
  $change_items['LastUpdate'] = ['at', $last_update_time];

  return $change_items;
}

function is_maglabs_open($latest){
  # Space is open when:
  # a) a door is open (main or front)
  # b) one of the following is true: open switch ON, movement in last 20 minutes
  $movement = $latest['Open Switch'][2] | $latest['Office Motion'][2] | $latest['Shop Motion'][2];
  $doors = $latest['Front Door'][2] | $latest['Main Door'][2];
  
  return $movement && $doors;
}

function is_tech_bad(&$latest){
  $last_update_time = $latest['LastUpdate'][1];
  unset($latest['LastUpdate']);
  $now = time();
  
  if($last_update_time <= $now-(60*20)){
    return true; # No response in 20 minutes is bad
  } else {
    return false;
  }
}

##### END HAL HELPERS
