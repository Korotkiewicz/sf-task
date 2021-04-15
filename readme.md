# Smart Frame Task

## Task content

Look into ./task.md file
## Start project from scratch

    docker-compose build
    docker-compose up -d
    docker-compose exec php composer install

## Execute recruitement task 

Go into browser and open url: http://localhost:8080/

## Execute tests

    docker-compose exec php php bin/phpunit