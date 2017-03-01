# PHP Mods N Libs Gallery Vast

In progress

## Installation
- Make new MySQL database under the name mods-n-libs
- In project directory run 'composer install' and enter database details and pleas skip mailing info
(incomplete)

## Running
 'php bin/console server:run' and browse to 'http://localhost:8000/'

### Opauth library setup
If using Opauth for social login enter api and keys enter in a new file called:
/web/Opauth/example/opauth.conf.php

Refer to https://github.com/opauth/facebook and opauth.conf-dist.php

You may need to change urls in PHP_Mods-N-Libs_Gallery_Vast/app/Resources/views/items/opauth.html.twig as well