# hackathonJs  - Starter Kit - Symfony

## Presentation

This starter kit is here to easily start the repository.
It's a --webapp symfony 6.2 project.

## Getting Started 

### Prerequisites

1. Check composer is installed
2. Check yarn & node are installed

### Install

1. Clone this project
2. Run `composer install`
3. Run `symfony server:start -d` to launch your local php web server

### Database

1. Create a new ".env.local" file at the root of the project and copy the ".env" file content inside of it.
2. Comment the "postgresql" line (32) and uncomment the "sql" line (31)
3. Enter your username, your password and the name of your database on the dedicated places to configure the access of your sql database.
4. Run `symfony console doctrine:database:create` to create your local database.
5. Run `symfony console doctrine:migrations:migrate` to run the migrations.
6. Run `php bin/console doctrine:fixtures:load` to load the fixtures.

### Windows Users

If you develop on Windows, you should edit you git configuration to change your end of line rules with this command:

`git config --global core.autocrlf true`

The `.editorconfig` file in root directory do this for you. You probably need `EditorConfig` extension if your IDE is VSCode.

### Run locally with Docker

1. Fill DATABASE_URL variable in .env.local file with
   `DATABASE_URL="mysql://root:password@database:3306/<choose_a_db_name>"`
2. Install Docker Desktop an run the command:
```bash
docker-compose up -d
```
3. Wait a moment and visit http://localhost:8000

## Authors

Helene FOURCADE, Killian PORTIER, Andy RICAÑA, Pierre BRIGNOLI, Tolotra RAMAROVAOHAKA, Bixente LASSERE.
