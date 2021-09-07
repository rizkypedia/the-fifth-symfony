# General

This is a basic Symfony 5 setup based on
 [Symfony5 Tutorials](https://symfonycasts.com/tracks/symfony) on SymfonyCasts.

This Symfony Repository has all necessary basic packages to start up with a Symfony project

## Setup

If you've just downloaded the code, congratulations!!

To get it working, follow these steps:

**Download Composer dependencies**

Make sure you have [Composer installed](https://getcomposer.org/download/)
and then run:

```
composer install
```

You may alternatively need to run `php composer.phar install`, depending
on how you installed Composer.

**Start the Symfony web server**

You can use Nginx or Apache, but Symfony's local web server
works even better.

To install the Symfony local web server, follow
"Downloading the Symfony client" instructions found
here: https://symfony.com/download - you only need to do this
once on your system.

Then, to start the web server, open a terminal, move into the
project, and run:

```
symfony serve
```

(If this is your first time using this command, you may see an
error that you need to run `symfony server:ca:install` first).

Now check out the site at `https://localhost:8000`

**Alternative: Use docker**

If you dont want to use Symfony 5 on your local machine, you can also use docker. For this approach you can use 
the basic [Symfony Docker Container](https://github.com/TrustedLegalServices/symfony-docker).

In order to use it properly you have to put the docker container sources and the Symfony sources 
under the same  folder.  Switch to the docker container and run

```
docker-compose build && docker-compose up
```

Then switch to the container e.g . 
```
docker exec -it symfony-php bash
```

and execute
```
composer install
```

This will install all basic necessary packages of symfony

Then you are ready to go

## Getting started

This Symfony has already one controller which containes following routes you can use:

```
/home
```


And
```
/question/test
```

After that you a free to get started with the Symfony app
