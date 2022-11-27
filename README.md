<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Installation

I'm using docker to run applications. Laravel has a new wrapper for launching applications, I decided to try it.

You must have <a href="https://www.docker.com/products/docker-desktop/">Docker Desktop</a> installed to run.
And it's necessary to stop all already running containers in docker (if any).

1. `git clone ..`
2. `./vendor/bin/sail up -d` 
3. `./vendor/bin/sail artisan migrate --seed`

## Usage
Now you can go to http://localhost, there will be a test task.

To run tests, use the command: `./vendor/bin/sail test`

<hr>

It is possible not to use `sail` wrapper. The project has the usual `docker-compose.yml` and you can use the usual docker commands.
