# Smart Frame Task

## Task content

Look into [Task file](task.md)
## Start project

1. From scratch:

    docker-compose build
    docker-compose up -d
    docker-compose exec php composer install

2. Next time:

    docker-compose up -d
## Execute recruitement task 

Go into browser and open url: http://localhost:8080/

There are two links which work:
- http://localhost:8080/health 
- http://localhost:8080/file/{filename.json|txt}

## Execute tests

If you want execute all tests:

    docker-compose exec php php bin/phpunit

If you want execute only functional tests:

    docker-compose exec php php bin/phpunit tests/Controller

If you want execute only unit tests:

    docker-compose exec php php bin/phpunit tests/Service