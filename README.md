# MyLittleMVCFramework
Squelette de Framework MVC en PHP 7

Protections failles XSS, injections SQL ou Javascript et attaques CSRF

1) Changer le nom de l'url de base dans le htaccess de premier niveau
2) Changer les paramètres dans le répertoire config
3) Ajouter vos classes Controllers dans le répertoire controllers
4) Ajouter vos classes Models et vos requêtes préparées dans le répertoire models
5) Ajouter vos vues dans le répertoire "views"
6) Ajouter vos Helpers si besoin dans le répertoire helpers et chargez les dans le fichier "bootstrap.php"
7) Méthode des controllers appellée par défaut = route($page)