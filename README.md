# Dolivel
***
Fonctions d'utilisation de l'API Dolibarr

## Installation
***
Installation du Package
```
$ composer require fermeturegarage/dolivel
```

Mise à jour de l'autoload (facultatif)
```
$ composer dump-autoload
```

Intégration du code
```PHP
require 'vendor/autoload.php';

use Fermeturegarage\Dolivel\Client;
$client = new Client();
return $client->hello();
```

## Mettre à jour
***
Mise à jour du Package
```
$ composer update fermeturegarage/dolivel
```

## Supprimer le paquet
***
```
$ composer remove fermeturegarage/dolivel
