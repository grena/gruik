## What is Gruik ?

It's a free & open-source **note-taking service**. A space where you can store notes, tutorials, code snippets... by writing them in markdown and then keep them private or public.

![Gruik preview](http://gruik.io/img/screen2.png)

## How to install ?
__For now, Gruik is under hard development with regular breaking changes !__

But if you want to try it :

* Clone this repo
* Make sure to have a database that Laravel framework supports, and edit `app/config/local/database.php` file.
* `composer install && bower install && php artisan migrate --seed && php artisan serve`
* Go to [http://localhost:8000](http://localhost:8000) and login with [test@example.com : test]

## Technologies, libs & design

#### Technos

* PHP 5.5+
* Laravel Framework
* AngularJS

#### Libs
Well, the best way to look for libs we use is to search in the [composer file](https://github.com/grena/gruik/blob/master/composer.json), and the [bower file](https://github.com/grena/gruik/blob/master/bower.json).

#### Design & Logo
Design template is the free MIT licensed [template AdminLTE](https://github.com/almasaeed2010/AdminLTE), and the awesome and sweet logo has been designed by [MyleneLa](http://www.mylenela.fr).

## License

The Gruik App is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
