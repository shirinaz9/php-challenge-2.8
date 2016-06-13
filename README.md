challenge_2.8
=============

A Symfony project created on June 8, 2016, 12:56 am.

installation
============

Docker
1. docker-compose up
2. docker exec -it phpchallenge28_php_1 composer install - the default parameters.yml have been configured for docker
3. docker exec -it phpchallenge28_php_1 php /var/www/symfony/app/console doctrine:schema:update --force

Docker will bring up 3 containers, exposing nginx over port 8081. You should now be able to load up http://localhost:8081



