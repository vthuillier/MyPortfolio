# Portfolio Dynamique PHP

Ce projet est un portfolio moderne et dynamique construit en PHP (MVC simplifié) avec une base de données SQLite.

## Installation

1. **Serveur Web** : Pointez votre serveur web (Apache/Nginx) vers le dossier `public/`.
2. **Dépendances PHP** : Assurez-vous d'avoir PHP 8+ et l'extension `pdo_sqlite` installée.
   - Sur Ubuntu/Debian : `sudo apt-get install php-sqlite3`
3. **Initialisation de la base de données** :
   Exécutez la commande suivante à la racine du projet :
   ```bash
   php init_db.php
   ```
   _Note : Si la commande échoue à cause du driver PDO, installez l'extension mentionnée ci-dessus._

## Accès Administration

- **URL** : `/login`
- **Utilisateur par défaut** : `admin`
- **Mot de passe par défaut** : `admin123`
  _N'oubliez pas de changer le mot de passe dans la base de données après votre première connexion._

## Structure du projet

- `public/` : Point d'entrée web (Assets, Uploads).
- `src/` : Code source (MVC).
  - `Controllers/` : Logique de l'application.
  - `Models/` : Interaction avec la base de données.
  - `Views/` : Templates HTML (Public & Admin).
  - `Config/` : Configuration (Base de données).
  - `Helpers/` : Utilitaires (Auth).
- `database/` : Fichiers SQLite.
- `init_db.php` : Script de migration initiale.
