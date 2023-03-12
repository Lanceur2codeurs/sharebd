# Présentation
Sur le site https://nuage-pedagogique.fr vous trouverez des cours pour découvrir Symfony. Share est l'application que nous créons pas à pas afin de parcourir les différentes facettes de Symfony. Sharebd est exclusivement la partie "base de données" qui vous permet :

tester la création de tables et de relations (contraintes d'intégrité multiples, fonctionnelles, entités faibles, spécialisations).
interroger la base de données à l'aide du jeu d'essai intégré (fixtures)
requêtes simples et utilisation du QueryBuilder

## Installation
git clone 

Dans votre projet :
composer install
cp .env .env.local

Configurer la base de données dans le .env.local
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
