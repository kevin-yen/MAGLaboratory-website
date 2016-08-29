#!/bin/bash

DIR=$( dirname "$0" )

while true; do
  change=$(inotifywait -e close_write,moved_to,create,modify -r .)
  echo $change;
  sleep 1;
  php $DIR/compile.php
done
