#!/bin/bash

DIR=$( dirname "$0" )

sass --style=compressed --sourcemap=none --watch $DIR/scss:$DIR/../home/public/css &

while true; do
  change=$(inotifywait -e close_write,moved_to,create,modify -r $DIR/views)
  echo $change;
  sleep 1;
  php $DIR/compile.php
done
