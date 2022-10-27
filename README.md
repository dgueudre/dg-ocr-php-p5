## Configuration de developpement
```shell
composer global require friendsofphp/php-cs-fixer
```
## Installation du projet

1. Génération de l'autoloader :
```shell
composer install
```

2. Configuration de l'environement :
```shell
cp .env.example .env
```
Editer le ficher .env afin de configurer l'environnement

3. Installation de la bdd :
```shell
php php public/index.php cmd/install
```

## Lancement du serveur de test
```shell
php -S localhost:8080 -t public/
```

## TODO
* le truc de selection de la bdd est pourri / splitter en 2 classes ?
* la classe Prout\SQL est nulle, il faut trouver autre chose.. dans Database ?
* la classe Pourt\Form est pas top
* faire un contexte pour la ligne de commande

