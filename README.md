challenge_2.8
=============

A Symfony project created on June 8, 2016, 12:56 am.

installation
============

## Docker
1. docker-compose up
2. docker exec -it phpchallenge28_tools_1 composer install - the default parameters.yml have been configured for docker
3. docker exec -it phpchallenge28_tools_1 app/console doctrine:database:create
4. docker exec -it phpchallenge28_tools_1 app/console doctrine:database:create --env=test
5. docker exec -it phpchallenge28_tools_1 app/console doctrine:schema:update --force
6. docker exec -it phpchallenge28_tools_1 app/console doctrine:schema:update --force --env=test
7. docker exec -it phpchallenge28_tools_1 npm install

Docker will bring up 4 containers (php, mysql, sync and dev-tools), exposing php-server over port 8081. 
You should now be able to load up http://localhost:8081
Sync is responsible for copying files as they change to nginx as docker filesystem checks can be slow and cause errors.
Dev-tools is for accessing composer and other utilities

## Other
1. create nginx/php, mysql instances
2. composer install - change parameters.yml config based off your configuration
3. app/console doctrine:database:create --env=test
4. app/console doctrine:database:create --env=test
5. app/console doctrine:schema:update --force
6. app/console doctrine:schema:update --force --env=test

known issues:
============

1. Docker sometimes gives a "bus error" error message. This happens sporadically. Rerunning the command will usually make it work.

