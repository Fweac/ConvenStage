# ConvenStage


[![forthebadge](https://forthebadge.com/images/badges/built-by-developers.svg)](https://forthebadge.com)  [![forthebadge](https://forthebadge.com/images/badges/gluten-free.svg)](https://forthebadge.com)

Le site à pour but de simplifier la gestion des conventions de stage et propose un suivis des signatures des conventions de stage.

## Pour commencer

### Pré-requis

- Éditeur de texte ou IDE
- Navigateur web
- Serveur local (ou internet)
- Logiciel de gestion de base de données
- MailTrap (pour les tests)

### Installation

Pour installer le site, il suffit de faire un `git clone` sur le dépôt GitHub.

Il faut ensuite faire un ```composer install``` pour installer les dépendances, `cp .env.example .env` pour copier le fichier de configuration, et `php artisan key:generate` pour générer une clé secrète.

N'oubliez pas de migrer votre base de données avec `php artisan migrate --seed` pour initialiser les données de base.

Une fois que tout est installé, il suffit de lancer le serveur web avec `php artisan serve`, ou votre logiciel tel que Wamp, Mamp, etc.

## Démarrage

Lancer votre serveur local et dirigez-vous vers l'adresse de votre réseau local.

## Fabriqué avec

* [Laravel](https://laravel.com) - Framework PHP (back-end)
* [PHPStorm](https://www.jetbrains.com/fr-fr/phpstorm/) - IDE de développement php
* [GitHub](https://github.com) - Logiciel de gestion de dépôts
* [PHPMyAdmin](https://www.phpmyadmin.net/) - Logiciel de gestion de base de données
* [MailTrap](https://mailtrap.io/) - Serveur de test de mail
* [MAMP](http://www.mamp.info/) - Serveur de développement

## Auteurs

* **Hardouin Armel**

