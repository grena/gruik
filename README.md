## What is Gruik ?

![Gruik logo](http://lut.im/25GVA1uQ/KAFzH5RA)

Well, Gruik is for you if...

* You __take a lot of notes__ (post-it, gists, evernote, blog entries, .txt on your desktop (_Oh you know what I mean_)...)
* You want to __"Bring You Own Server"__
* You want to store __all your notes in one place__
* You write your notes __with Markdown__
* You want to keep those __notes private__ or...
* ...__publish them__ just like a blog, or just to be referenced by search-engines
* ...and maybe allow notes to be discussed __with comments__
* You want to __keep interesting notes__ from other people, but __don't want them to vanish__ if author becomes a zombie
* You like __pigs__ (well, Gruiiik !)

![Gruik preview](http://lut.im/OYLqTKCB/s6CWP6Pg)

## How to install ?
__For now, Gruik is under hard development, and it's TOTALLY BROKEN, like a broken.. thing.__

But if you want to try it :
 
* Clone this repo
* Make sure to have a database that Laravel framework supports, and edit `app/config/local/database.php` file.
* `composer install && bower install && php artisan migrate --seed && php artisan serve`
* Go to [http://localhost:8000/admin](http://localhost:8000/admin) and login with [test@grena.fr : test]

## Technologies, libs & design

#### Technos

* PHP 5.4+
* Laravel Framework
* AngularJS

#### Libs
Well, the best way to look for libs we use is to search in the [composer file](https://github.com/grena/gruik/blob/master/composer.json), and the [bower file](https://github.com/grena/gruik/blob/master/bower.json).

#### Design & Logo
Design template is the free MIT licensed [template AdminLTE](https://github.com/almasaeed2010/AdminLTE), and the awesome and sweet logo has been designed by [MyleneLa](http://www.mylenela.fr/en/).

## License

The Gruik App is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
