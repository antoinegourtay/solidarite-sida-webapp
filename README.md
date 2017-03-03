Welcome to the Sodidarité Sida - Trombinoscope project
========================

This repository is made for the versioning of the web application of Solidarité Sida - Trombinoscope.

Who work on it ?
--------------
[**Anne Maurice-Peroumal**][1] - *Head of Project*

[**Jennyfer Millet**][2] - *Designer UX/UI*

[**Aymeric Chappuy**][3] - *Designer UX/UI*

[**Timothée Blanco**][4] - *Marketing Correspondant*

[**Nicolas Castells**][5] - *Front-end Developer*

[**Antoine Gourtay**][6] - *Back-end Developer*

How to install the project
--------------------------

First installation :

````
git clone https://github.com/AntoineGourtayHetic/solidarite-sida-webapp.git
cd solidarite-sida-webapp
composer install
php bin/symfony_requirements

php bin/console doctrine:database:create
php bin/console doctrine:schema:update --dump-sql
php bin/console doctrine:schema:update --force
````

Launching the server :

````
php bin/console server:run
````

How to contribute to the project
--------------------------------

Commit synthax : 
* [ADD] your message - *When you add anything in the project*
* [REMOVE] your message - *When you remove anything in the project*
* [UPDATE] your message  - *When you update anything in the project*
* [WORKFLOW] your message - *When you are impacting the project workflow*

Commit when you want and what is necessary to the project


Credentials
-----------

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Sortez couverts !

[1]: https://github.com/annemp
[2]: https://github.com/Jennyfer-M
[3]: https://github.com/nico0290
[4]: https://github.com/timothe3192
[5]: https://github.com/nico0290
[6]: https://github.com/AntoineGourtayHetic