# Projet Backend de mini-rpg

**Prérequis**: Base PHP, les objets, le modèle MVC, la validation

## Introduction

Ceci est une application type API REST qui renvoie des données JSON au mini rpg qui les traite pour réaliser des actions.
On peut aussi envoyer des données à l'API pour qu'elle les enregistre dans une base de données MySQL.

## Etape 2 - Composer et l'autoloading

- Initialiser le dossier comme étant un projet composer

```shell
$ composer init  # crée le fichier composer.json
$ composer install # install l'autoloader
```

- Remplir le fichier composer avec la règle d'autoloading

```json
"autoload": {
    "psr-4": {
        "RootName\\": "src/"
    }
}
```

- Réinitialiser l'autoloader

```shell
$ composer dump-autoload
```

- lancer php -S localhost:8000 dans le dossier public

```shell
$ cd public
$ php -S localhost:8000
```

## Etape 3 - Le router

Voici une liste de route que l'on peut implementer (Ceci est un exemple pour une ToDo List):

- "/dashboard/{todo}task/{task}, GET => montre le détail d'une tache
- "/dashboard/task/nouveau, GET => création d'une tache
- "/dashboard/task/nouveau, POST => crée la tache en base dde données
- "/dashboard/{todo}/task/{task}, POST => met en jour la tache
- "/dashboard/{todo}/task/{task}/delete => supprime la tache

## Etape 3 - Les Models

Création des entitées  `Task` et des managers  `TaskManager``

Pour les manager, on va pouvoir implementer les methodes:

- `find($name, $listid)` => retrouve une entité grâce à son id
- `check($slug)` => retrouve une entité grâce à n'importe quel champs renseigné
- `getall($id)` => retrouve toutes les entité
- `store()` => enregistre une entité
- `update($param)` => met à jour une entité
- `delete($param)`=> supprime une entité

## Etape 4 - Le controller

Créer un `TodoController` avec les methodes suivante:


- `store()`=> enregistre la todoliste
- `check($param)` => formulaire pour editer la todoliste
- `update($param)`=> met à jour la todoliste
- `delete($param)`=> supprime la todo liste