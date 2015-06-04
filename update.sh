#!/bin/bash
sudo php app/console cache:clear --env=prod --no-debug
sudo php app/console cache:clear --env=dev --no-debug
sudo php app/console assetic:dump --no-debug
sudo php app/console assets:install --no-debug --symlink
sudo chmod -R 777 app/cache/*