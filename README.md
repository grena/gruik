<p align="center">
<img src="http://i.imgur.com/9J2KiWr.png" alt="Gruik Logo"/>
</p>

## Gruik
[![Travis CI](https://travis-ci.org/grena/gruik.svg)](https://travis-ci.org/grena/gruik/tree/symfony)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/grena/gruik/badges/quality-score.png?b=symfony)](https://scrutinizer-ci.com/g/grena/gruik/?branch=symfony)
[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/grena/gruik?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)

Gruik is a free & open-source **note-taking service**. A space where you can store notes, tutorials, code snippets... by writing them in markdown and then keep them private or public.

## Prerequisite
- PHP 5.6+
- MySQL
- Composer
- NodeJS & NPM _(only used to grab front JS dependencies)_

## Installation
Gruik is based on the great Symfony framework. **If you encounter some installation errors**,
please have a look on the [Symfony installation documentation](http://symfony.com/doc/2.8/book/installation.html).
If you still have some troubles, feel free to ping someone on [Gitter](https://gitter.im/grena/gruik) or open a [GitHub issue](https://github.com/grena/gruik/issues/new).

#### 1) Create Github OAuth application
https://github.com/settings/applications/new

#### 2) Setup your database
```
mysql -u root -p

CREATE DATABASE gruik;
GRANT ALL PRIVILEGES ON gruik.* TO gruik_user@localhost IDENTIFIED BY 'gruik_password';
EXIT
```

#### 3) Install Composer dependencies
```
composer install
```

#### 4) Creating database schema
```bash
php app/console doctrine:schema:create
```

#### 5) Install frontend assets
```bash
npm install # Install frontend dependencies, like Bootstrap
php app/console assets:install # Move bundle assets to web/ directory
nodejs node_modules/gulp/bin/gulp.js less # Compile bundle .less files to .css
nodejs node_modules/gulp/bin/gulp.js install # Move downloaded assets to web/ directory
```


## License
The Gruik App is open-sourced software licensed under the [GNU General Public License v 3.0](https://opensource.org/licenses/GPL-3.0)
