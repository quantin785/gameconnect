# GameConnect — Plateforme sociale communautaire

Application web PHP permettant à des membres de publier des posts, commenter et gérer leur compte. Architecture MVC/N-Tiers.

---

## Installation

**Prérequis :** XAMPP (Apache + MySQL), PHP 8+

1. Cloner le projet dans `C:/xampp/htdocs/game2`
2. Démarrer Apache et MySQL via XAMPP
3. Créer la base de données dans phpMyAdmin :
   - Nom : `game`
   - Importer le fichier SQL si disponible
4. Configurer la connexion dans `app/config/Database.php` :

```php
private $host = 'localhost';
private $dbname = 'game';
private $username = 'root';
private $password = '';
```

5. Accéder à l'application : `http://localhost/game2/html/index.php`

---

## Architecture

Le projet suit le pattern **MVC/N-Tiers** avec 5 couches distinctes :

```
Navigateur
    │
html/          ← Pages d'entrée (index.php, sign-in.php, sign-up.php)
    │
Controllers/   ← Orchestration (PostController, CommentController, AuthController)
    │
Services/      ← Logique métier (PostService, CommentService)
    │
DAO/           ← Accès base de données via PDO (PostDAO, CommentDAO, UserDAO)
    │
Models/        ← Entités (Post, Comment, User)
    │
MySQL (base de données)
```

### Structure des fichiers

```
game2/
├── app/
│   ├── config/
│   │   ├── Database.php       # Connexion PDO (singleton)
│   │   └── config.php         # Configuration générale
│   ├── Models/                # Entités métier
│   ├── DAO/                   # Requêtes SQL
│   ├── Services/              # Logique applicative
│   ├── Controllers/           # Orchestration
│   └── utils/helpers.php      # Fonctions utilitaires
├── html/                      # Pages accessibles
├── public/                    # Points d'entrée actions (add-post, add-comment)
├── views/                     # Templates HTML
├── uploads/                   # Médias uploadés
├── assets/                    # CSS, JS, fonts
└── bootstrap.php              # Initialisation centralisée
```

### Flux d'une requête

```
Utilisateur → html/index.php
    → require bootstrap.php (autoload + config)
    → PostController::getAllPosts()
    → PostService → PostDAO → MySQL
    → views/posts/index.php (affichage)
```

---

## Sécurité

- Requêtes préparées PDO (protection injections SQL)
- Hashage des mots de passe (`password_hash`)
- Échappement des sorties HTML (`htmlspecialchars`)
- Vérification de session sur les pages protégées
