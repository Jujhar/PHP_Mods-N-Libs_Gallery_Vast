# PHP Mods N Libs Gallery Vast

In Beta

## Features
Currently includes [Imagine](https://github.com/avalanche123/Imagine "Title"), [monolog](https://github.com/Seldaek/monolog "Title"), [Geocoder](https://github.com/geocoder-php/Geocoder "Title"), [Opauth](https://github.com/opauth/opauth "Title"), and [Faker](https://github.com/fzaninotto/Faker "Title")

## Installation
- Make new MySQL database using the install/mods-n-libs.sql file using the database name mods-n-libs
- In project directory run 'composer install' and enter database details and skip mailing info

## Running

    $ php bin/console server:run

Run the above command and then browse to 'http://localhost:8000/'

### Opauth library setup (optional)
If using Opauth for social login enter api and keys enter in a new file called:
/web/Opauth/example/opauth.conf.php

Refer to https://github.com/opauth/facebook and opauth.conf-dist.php

You may need to change urls in PHP_Mods-N-Libs_Gallery_Vast/app/Resources/views/items/opauth.html.twig as well