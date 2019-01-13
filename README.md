# NauticApp
1) telecharger Projet 
2) lancer commande  php bin/console doctrine:database:create
pour que la base soit creer
3) Installer Postman Pour tester L'api et resultat Fournie:
4)executer l'api avec : php bin/console server:run
5) Tester Avec Postman
-GET:Liste des bases nautiques : chaque élément de la liste ne doit contenir que son nom et sa description
http://127.0.0.1:8000/Nautics

- Post: Créer une base nautique
http://127.0.0.1:8000/Nautics  + dans le Body 
{  "name": "test",
	"description": "test",
	"adresse": "test",
	"city":"test",
	"postal_code":"test"
}

-DELETE:Supprimer une base nautique
http://127.0.0.1:8000/Nautics/1

-PUT:Mettre à jour une base nautique
http://127.0.0.1:8000/Nautic/1 + dans le body
{  "name": "test",
	"description": "test",
	"adresse": "test",
	"city":"test",
	"postal_code":"test"}
  
-GET:Récupération des détails d’une base nautique
http://127.0.0.1:8000/Nautic_get/1

==> Si vous voulez voir les Test et les captures c'est dans  le fichier WORD envoyé par email 
