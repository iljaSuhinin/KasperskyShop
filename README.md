Kaspersky online store
========================
interenet shop with the use of the engine and silius soantaAdmnBundle

Installation:
------------------------
1. Clone the repository

``` bash
$ git clone https://github.com/iljaSuhinin/OnlineStore.git
$ cd OnlineStore
```
2. Configure your database parameters

``` bash
$ cp app/config/parameters.yml-dist app/config/parameters.yml
```
3. Composer install

``` bash
$ curl -s http://getcomposer.org/installer | php
```
4. vendors install

``` bash
$ php composer.phar install
```
5. Migration install

``` bash
$ php app/console doctrine:migrations:migrate
```
6. Assetics dump

``` bash
$ php sandbox/console assetic:dump
```

7. Create root user for backend

``` bash
$ php app/console fos:user:create root --super-admin
```
