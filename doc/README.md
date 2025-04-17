# SprintLook - Site de Tableaux de Rétrospective

## Description
Ce projet est un site web permettant aux utilisateurs de créer et de gérer des tableaux de rétrospective en ligne. Les utilisateurs peuvent s'inscrire, se connecter, créer des salons (rooms) et inviter d'autres participants de manière anonyme via un code et le nom de la room. Les participants peuvent ajouter, supprimer et modifier leurs propres étiquettes (notes), tandis que le créateur de la room a la possibilité de supprimer n'importe quelle étiquette.

## Fonctionnalités
- **Inscription/Connexion** : Les utilisateurs peuvent créer un compte et se connecter.
- **Profil** : Les utilisateurs peuvent choisir une image de profil 
- **Création de Salon** : Les utilisateurs connectés peuvent créer des salons de rétrospective.
- **Anonymat personnalisé** : choississez un nom et une image de profil afin que personne ne vous reconnaisse
- **Invitation Anonyme** : Rejoignez un salon anonymement grace à son code et son nom de room
- **Gestion des Étiquettes** :
  - Tous les participants peuvent ajouter, supprimer et modifier leurs propres étiquettes.
  - Le créateur du salon peut supprimer n'importe quelle étiquette.
- **Interface Interactive** : Les étiquettes sont rechargées dynamiquement toutes les 5 secondes.

## Fonctionnalités Futures
- **Système de Clôture** : Permettre au créateur de la room de clôturer la rétrospective, empêchant ainsi toute modification ultérieure, et permettant à l'utilisateur de garder une trace de ses retrospectives. 

## Technologies Utilisées
- **Frontend** : HTML, Tailwind(CSS+), JavaScript
- **Backend** : PHP
- **Base de Données** : MySQL (via phpMyAdmin)
- **Version** : Dernières versions des technologies mentionnées.

## Installation
1. **Prérequis** :
   - Serveur web (Apache, Nginx, etc.)
   - PHP (dernière version recommandée)
   - MySQL (dernière version recommandée)
   - phpMyAdmin (pour la gestion de la base de données)

2. **Configuration** :
   - Clonez ce dépôt dans le dossier de votre serveur web.
   - Importez le fichier SQL (SprintLook.sql) dans phpMyAdmin pour configurer la base de données.
   - Creer un fichier `.env` pour y ajouter vos identifiants de base de données.

   **.env exemple** : 
       "DB_HOST=localhost
        DB_NAME=exemple
        DB_USER=user_exemple
        DB_PASS=MotDePasse"

3. **Lancement** :
   - Accédez à l'application via votre navigateur (ex: `http://sprintlook.local/App/`).

## Arborescence des fichiers
 ```
SprintLook/
├── doc/
│   ├── .env                     # Fichier d'environnement (variables sensibles)
│   ├── README.md                # Documentation du projet
│   ├── rooms.sql                # Script SQL pour la création de salons de test
│   └── SprintLook.sql           # Fichier SQL principal à importer dans phpMyAdmin
│
├── www/
│   ├── App/
│   │   ├── Footer/
│   │   │   └── footer.php       # Bas de page du site
│   │   │
│   │   ├── Header/
│   │   │   ├── header.php       # En-tête du site
│   │   │   ├── logout.php       # Gestion de la déconnexion
│   │   │   ├── mobile.js        # Script pour le menu burger
│   │   │   ├── style.css        # Styles CSS pour le menu burger et les post-its
│   │   │   └── tailwind_config.js # Configuration TailwindCSS
│   │   │
│   │   ├── Index/ 
│   │   │   └── faq.js           # Script pour l'affichage de la partie questions/réponses
│   │   │
│   │   ├── Join/
│   │   │   ├── carousel.js      # Script pour le défilement des images de profil et des noms
│   │   │   ├── join.js          # Envoi des données du formulaire et redirection vers la page de rétrospective associée
│   │   │   └── join.php         # Vérification du code avec le nom du salon + création du nameless et ajout dans le salon
│   │   │
│   │   ├── Login/
│   │   │   ├── login_ajax.php   # Script de vérification et création de session
│   │   │   └── login.js         # Envoi des données du formulaire et affichage des messages de succès/erreur
│   │   │
│   │   ├── Profile/
│   │   │   ├── profile_data.php # Récupère les informations de l'utilisateur + si méthode POST, supprime l'ancienne image et met à jour la nouvelle
│   │   │   └── update_picture.js # Vérification de l'image + affichage de l'aperçu
│   │   │
│   │   ├── Protected/           # Classes PHP avec requêtes vers la BDD
│   │   │   ├── class_nameless.php # Création d'utilisateurs anonymes + vérification du code/nom + ajout dans le salon
│   │   │   ├── class_retro.php  # Récupération des informations du salon et des post-its + CRUD post-its + filtrage par catégorie + vérification d'accès
│   │   │   ├── class_room.php   # CRUD des salons
│   │   │   ├── class_user.php   # Création/vérification/récupération d'informations utilisateur + modification de l'image de profil
│   │   │   └── database.php     # Connexion à la base de données
│   │   │
│   │   ├── Register/
│   │   │   ├── password.js      # Script affichant la force du mot de passe
│   │   │   ├── register_ajax.php# Vérification des données + création d'un utilisateur/d'une session user_id
│   │   │   ├── register.js      # Envoi des données du formulaire et affichage des messages de succès/erreur
│   │   │   └── validator.php    # Classe PHP pour valider le mot de passe et l'email
│   │   │
│   │   ├── Retrospective/
│   │   │   ├── delete_postit.js # Ajout d'un événement sur les boutons de suppression + envoi des données
│   │   │   ├── delete_postit.php# Vérification des autorisations + suppression du post-it
│   │   │   ├── edit_postit.js   # Ajout d'un événement sur les boutons de modification + envoi des données
│   │   │   ├── edit_postit.php  # Vérification des autorisations + modification du post-it
│   │   │   ├── postit_template.php# Modèle HTML Tailwind d'un post-it
│   │   │   ├── refresh_postits.js# Récupération de l'id de la room dans l'URL + envoi des données + actualisation des post-its toutes les 5s
│   │   │   ├── refresh_postits.php# Récupération de chaque post-it + tri par colonne + envoi de chaque colonne au JS
│   │   │   ├── retrospective_data.php# Vérification des accès à la room + récupération de chaque post-it + tri par colonne
│   │   │   ├── retrospective.js # Ajout d'un événement sur le bouton de création + envoi des données
│   │   │   └── save_postit.php  # Création du post-it
│   │   │
│   │   ├── Room/
│   │   │   ├── room_ajax.php    # Récupération des salons en fonction du tri et des termes de recherche
│   │   │   ├── room_create.js   # Classe RoomModal avec fonctions : initialisation des événements, ouverture/fermeture, envoi du formulaire pour créer un salon
│   │   │   ├── room_create.php  # Création de salon
│   │   │   ├── room_delete.php  # Suppression de salon
│   │   │   ├── room_update.js   # Classe RoomUpdate avec fonctions : initialisation des événements, ouverture/fermeture, envoi du formulaire pour modifier le nom d'un salon
│   │   │   ├── room_update.php  # Modification du salon
│   │   │   └── room.js          # Initialisation des événements pour la barre de recherche + fonction pour envoyer le formulaire de récupération des salons + affichage des salons + fonction pour envoyer le formulaire de suppression des salons
│   │   │
│   │   ├── index.php            # Page d'accueil
│   │   ├── join.php             # Rejoindre un salon anonymement
│   │   ├── login.php            # Page de connexion
│   │   ├── profile.php          # Page de profil utilisateur
│   │   ├── register.php         # Page d'inscription
│   │   ├── retrospective.php    # Page de rétrospective
│   │   └── room.php             # Gestion des salons utilisateur
│   │
│   └── Resources/
│       ├── Client/              # Images de profil des utilisateurs
│       └── Images/              # Assets du site (logo SprintLook + avatars anonymes)
│
└── .gitignore                   # Fichier Git ignore
 ```
## Auteur
- [Amandine GUISY](https://github.com/AmandineGUISY)
