<?php
# This script is used to make daily automatic backups of the database.
# It will only keep the last 4 days of backups.
# TODO: Upload to AWS-S3 so we can keep longer backups?

if($argv[1] == 'wiki'){
  require_once(dirname(__FILE__) . '/../maglab/config/config_wiki.php');
} else {
  require_once(dirname(__FILE__) . '/../maglab/config/config.php');
}


$backupRoot = realpath(dirname(__FILE__) . '/../../private/backups') . '/';

if(defined('MYSQL_BACKUP_PATH') and realpath(MYSQL_BACKUP_PATH)){
  $backupRoot = realpath(MYSQL_BACKUP_PATH);
}

$host = escapeshellarg(MYSQL_HOST);
$user = escapeshellarg(MYSQL_USER);
$pass = escapeshellarg(MYSQL_PASS);
$db = escapeshellarg(MYSQL_DB);
$now = time();
$target = escapeshellarg( $backupRoot . MYSQL_DB . strftime('-%Y%m%d_%s.sql', $now) );

system("mysqldump --host=$host --user=$user --password=$pass $db > $target");

system("gzip $target");

$backups = array_reverse( glob( $backupRoot . MYSQL_DB . '-*.sql.gz' ) );

for($i = 4; $i < count($backups); $i++){
  unlink($backups[$i]);
}
