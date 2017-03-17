<?php
# ----- CONFIGURATION DIRECTIVES ----- #

# This is the directory where we will output deploy.sftp
define('DEPLOY_DIRECTORY', __DIR__);

# Set to true if you want to confirm deployment before sending sftp commands
define('DEPLOY_TEST', false);

# This is the project directory. If you have deploy.php in the root directory
# then you can leave this alone, otherwise change it to the correct path.
# Absolute paths recommended, eg: /home/you/Projects/CoolStuff
define('PROJECT_ROOT', __DIR__ . '/..');

# This is the username and host part that you use to login.
# eg: user5_testsite@ssh.phx.nearlyfreespeech.net
define('SSH_USERHOST', 'swut4ewr2_maglabs@nfsn');

# This is the path to the NFSN deployer.
# TODO: write this as a library
define('DEPLOYER_PATH', '/home/work/.local/lib/php/nfsn_deploy.php');

# This defines the path to the marker file and its target path relative to /home
# The marker file gets some special replacements
# $~COMMIT~ will be replaced with the deployed commit
$deploy_marker = array(
    'template' => (DEPLOY_DIRECTORY . '/marker.php'),
    'remote_target' => 'protected/maglab/config/config_cachebust.php'
  );


# ----- END CONFIGURATION DIRECTIVES ----- #
###########################################
# ----- DO NOT EDIT BELOW THIS LINE ----- #

require DEPLOYER_PATH;
