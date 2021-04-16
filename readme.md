# Smart Frame Task

## Task content

Look into [Task file](task.md)
## Start project from scratch

    docker-compose build
    docker-compose up -d
    docker-compose exec php composer install

## Execute recruitement task 

Go into browser and open url: http://localhost:8080/

There are two links which work:
- http://localhost:8080/health 
- http://localhost:8080/file/{filename.json}

## Execute tests

    docker-compose exec php php bin/phpunit