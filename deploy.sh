#!/bin/bash

DEPLOY_PATH=`dirname $0`

php $DEPLOY_PATH/deploy/deploy.php "$@"
