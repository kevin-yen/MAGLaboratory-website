<?php
error_reporting(E_ALL);
# On NFSN, php.ini is set based on the /home/conf/php.ini but since it's global
# we set it here for per-site usage
set_include_path(".:/usr/share/php:/usr/share/pear/:/home/httpd/maglabs-www/home/protected");

# This is a development function
function raise($o){
  header('Content-Type: text/plain');
  var_dump($o);
  die();
}


# This file holds all the config for your app. This is for local development.
# You will need to manually upload another config file on production.

define('MYSQL_USER', '');
define('MYSQL_PASS', '');
define('MYSQL_HOST', '');
define('MYSQL_DB', '');

define('PASSWORD_BCRYPT', '');
