# Unit tests beginner course
## Project configuration

Congratulations on successfully downloading the code!

### 1. Download Composer Dependencies

Ensure [Composer is installed](https://getcomposer.org/download/) and then execute the following command:
```
composer install
```

### 2. Database Setup

The code comes with a `docker-compose.yaml` file and we recommend using
Docker to boot a database container. You will still have PHP installed
locally, but you'll connect to a database inside Docker. This is optional,
but I think you'll love it!

First, make sure you have [Docker installed](https://docs.docker.com/get-docker/)
and running. To start the container, run:

```
docker compose up -d
```

Next, build the database and the schema with:

```
# "symfony console" is equivalent to "bin/console"
# but its aware of your database container
symfony console doctrine:database:create --if-not-exists
symfony console doctrine:schema:create
symfony console doctrine:fixtures:load
```

If you do *not* want to use Docker, just make sure to start your own
database server and update the `DATABASE_URL` environment variable in
`.env` or `.env.local` before running the commands above.

### 3. Initiate the Symfony Web Server

While Nginx or Apache are options, Symfony's local web server is highly recommended.

To install the Symfony local web server, refer to the instructions for "Downloading the Symfony client" at 
[Symfony Download](https://symfony.com/download). This is a one-time setup on your system.

After installation, start the web server by opening a terminal, navigating to the project directory, and running:

```
symfony serve -d
```
For first-time users of this command, you may encounter an error prompting you to run:

```
symfony server:ca:install
```
### 4. Access the Site

Visit the site at https://localhost:8000 and enjoy exploring!

Now follow the course and have a great time!
