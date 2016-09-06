<?php
# ----- CONFIGURATION DIRECTIVES ----- #

define('DEPLOY_DIRECTORY', __DIR__);

# This is the project directory. If you have deploy.php in the root directory
# then you can leave this alone, otherwise change it to the correct path.
# Absolute paths recommended, eg: /home/you/Projects/CoolStuff
define('PROJECT_DIRECTORY', __DIR__ . '/home');

# This is the username and host part that you use to login.
# eg: user5_testsite@ssh.phx.nearlyfreespeech.net
define('SSH_USERHOST', 'swut4ewr2_maglabs@nfsn');

# This is the path to the NFSN deployer.
# TODO: write this as a library
define('DEPLOYER_PATH', '/home/work/.local/lib/php/nfsn_deploy.php');

# ----- END CONFIGURATION DIRECTIVES ----- #
###########################################
# ----- DO NOT EDIT BELOW THIS LINE ----- #

require DEPLOYER_PATH;
