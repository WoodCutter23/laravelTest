<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Project

This is test Laravel Project 


## Requirements

- Docker 
- docker-compose


## Install

####Step 1

Find the .env.example file -> rename it in .env

#### Step 2

up containers

```sh
$ docker-compose up
```

#### Step 3

run migrations 

```sh
$ docker exec -it laravel_app /bin/bash ./migrations.sh
```

#### Step 4

run tests 

```sh
$ docker exec -it laravel_app /bin/bash ./test.sh
```


#### Step 5

run docs generate 

```sh
$ docker exec -it laravel_app /bin/bash ./docs.sh
```


See Docs at
 ```sh
 /api/documentation
 ```
 
 
 Your Project on 
  ```sh
  localhost:2018
  ```