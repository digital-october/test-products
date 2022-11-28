<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Installation

I'm using docker to run applications. Laravel has a new wrapper for launching applications, I decided to try it.

You must have <a href="https://www.docker.com/products/docker-desktop/">Docker Desktop</a> installed to run.
And it's necessary to stop all already running containers in docker (if any).

1. `git clone ..`

I use macOS, and I will indicate the commands for this system.
If there are problems on other OS, write to me and I will help. 
(mylyrium@gmail.com, https://t.me/lyrium).

2. `brew install composer` // if not macOS use <a href="https://getcomposer.org/download/">official link</a>
3. `php artisan sail:install` //interesting wrapper for docker
4. `cp .env.example .env`
5. `./vendor/bin/sail up -d` 
6. `./vendor/bin/sail composer i`
7. `./vendor/bin/sail php artisan key:generate`
8. `./vendor/bin/sail artisan migrate --seed` // It is important to use migrations with seeds.

I have not deployed projects with this wrapper before. Here is a 
<a href="https://laravel.com/docs/9.x/sail#installing-sail-into-existing-applications">official link</a> to the documentation.
But I checked the installation of the project by these commands this morning and everything was successful.

## Usage
Now you can go to http://localhost, there will be a test task.

To run tests, use the command: `./vendor/bin/sail test`

<hr>

It is possible not to use `sail` wrapper. The project has the usual `docker-compose.yml` and you can use the usual docker commands.
Just do a standard Laravel + Docker installation and use migrations with seeds.
