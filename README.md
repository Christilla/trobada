<!--
--	Projet Trobada dans le cadre de la formation Développeur Logiciel de niveau III
--	Beweb - École Régionale du Numérique session Février 2018 - Janvier 2019
--	
--	@author : Jean-Jacques PARRINELLO
--	@pseudo : Padbrain
--	@email 	: padbrain@free.fr
--	
-->
# Projet Trobada

## Définition

### Le projet

Le projet Trobada prend vie au *cœur* des Pyrénées Orientales

Son objectif est de faire la promotion de la culture, de valoriser l'artisanat local et de favoriser ainsi le développement du lien social.

L'organisation de festivals à travers la région est le pretexte permettant de réunir en un même lieu tous les acteurs d'un même évènement.

* 	Les fournisseurs, qui proposent à la vente leurs produits.
* 	Les partenaires
* 	Les festivaliers, qui sont les consommateurs.


### Le lien

Afin de faciliter et sécuriser les échanges monétaires au sein du festival, chaque festivalier est identifié individuellement à l'aide d'un QR Code unique qui doit lui être attribué via une inscription sur le site web de Trobada et pour lequel lui sera délivré un fichier représentant le QR Code à imprimer.

Ce QR Code prendra place sur une carte, format carte bancaire, comme support physique.

### Pourquoi avoir développé cette application ?
Cette application a été développée dans le cadre d'un partenariat entre [Beweb - École Régionale du Numérique](http://fabrique-beweb.com/) et [Alter'Incub - Incubateur d'innovation Sociale](http://www.alterincub.coop/).

Le but était de mettre en relation des [Bewebeurs](https://www.facebook.com/bewebERN/) et des porteurs de projet.

L'intérêt consiste, d'une part, à mettre les premiers interlocuteurs en situation pratique de production, leur permettant
de parcourir l'ensemble des étapes d'un projet jusqu'à la livraison et, d'autre part, à permettre aux porteurs de projet
d'acquérir un prototype de leur application leur permettant la promotion de leurs idées auprès de partenaires ou financeurs
potentiels et d'affiner les fonctionnalités nécessaires à la gestion du projet.

L'application comprend :
  - Une partie publique permettant de présenter le projet.
  - Une partie avec identification permettant :
    * La gestion de quatre profils utilisateur (Identification par token JWT et gestion de droits).
    * La gestion de différents évènements par les `Organisateurs`.
    * La gestion et l'identification par QR Codes de produits par les `Commerçants`.
    * Le rechargement 3D Secure d'un compte en ligne par carte bancaire par les `Festivaliers`.
    * La gestion du commissionnement des commerçants par l'`administrateur` du projet.
    * Les différents historiques `ventes`, `achats` et `commissionnement` des profils précédents.
    * Différents CRUD pour l'administrateur.

Ce projet a été réalisé sur la période du 03/09/18 au 05/10/18. 


## Configuration
Pour ce projet, les technologies utilisées en backend sont le PHP, avec le framework CodeIgniter, pour la couche métier 
et MySql pour le modèle de données. En frontend, le classique couple HTML/CSS avec quelques touches de Javascript et de JQuery. 

> **`Toutes les commandes
  utilisée dans la suite de ce fichier sont valables pour la configuration suivante :`**
  
### Serveur Web
Le serveur Web est un serveur apache en version 2.4.18 sur une distribution Linux Mint en version 18.3. 

### PHP
La version de PHP utilisée est, à minima, la version 7.2.
Pour la génération des images des QR Codes, la librairie PHP-GD doit être installée.

  - Installation de la librairie

    `apt install php7.2-gd`

### MySql
La version de MySql utilisée est à minima, la version 5.7.22 **avec l'option SQL_MODE::ONLY_FULL_GROUP_BY désactivée**.

#### Désactiver l'option `ONLY_FULL_GROUP_BY` temporairement à l'aide de phpmyadmin :

***Pour un fonctionnement `non permanent`, parfait pour un test ponctuel de l'application***.

  - Cliquer sur `Serveur:localhost`
  - Onglet `Plus` sous menu `Variables`
  - Dans le champ de filtre, saisir `sql mode`
  - Cliquer sur `Modifier`
  - Supprimer `ONLY_FULL_GROUP_BY,` de la liste
  
Ceci sera réinitialisé à la configuration précédente au redémarrage du serveur MySql.

#### Désactiver l'option `ONLY_FULL_GROUP_BY` de manière permanente à l'aide du fichier de configuration `my.cnf`.

***Pour un fonctionnement `permanent`, pour un test en pré-production***.

Ce fichier peut se trouver en différents endroits, sur le serveur, et chacun des fichiers existants sera lu en redéfinissant la configuration précédente.

  * Trouver tous les fichiers lu au démarrage du serveur mysql :
  
      ```
      mysqladmin --help
      ```
      
  * Dans le flot délivré par la console nous pouvons lire quelque chose qui peut ressembler à ceci :
  
    ```
    Default options are read from the following files in the given order: 
    /etc/my.cnf /etc/mysql/my.cnf ~/.my.cnf 
   
  * La commande suivante renseigne sur les fichiers effectivement existants :
    
     ```
     ls /etc/my.cnf /etc/mysql/my.cnf ~/.my.cnf
     ```
     
Dans le flot délivré par la console nous pouvons lire quelque chose qui peut ressembler à ceci :

     ls: cannot access /etc/my.cnf : No such file or directory
     ls: cannot access /home/padbrain/.my.cnf: No such file or directory
     /etc/mysql/my.cnf
     
Dans ce cas, seul le fichier `/etc/mysql/my.cnf` est existant
    
  * Édition du fichier :
  
    ```
    sudo nano /etc/mysql/my.cnf
    ```
    
  * Ajout de la directive suivante en fin de fichier :
  
  ```
  [mysqld]
     sql-mode="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION"
  ```

  * Redémarrer le serveur :
  
  ```
  /etc/init.d/mysql restart
  ```  
  


## Installation

### Par téléchargement de l'archive
Décompresser [l'archive](https://gitlab.com/externals-projects/trobada/-/archive/master/trobada-master.tar.gz) sur votre serveur.

### En clonant le dépôt gitlab
Saisir la commande suivante à la racine de votre serveur : 

#### En ssh
```
git clone git@gitlab.com:externals-projects/trobada.git
```

#### En https
```
git clone https://gitlab.com/externals-projects/trobada.git
```

### Installer les dépendances

  - À la racine du projet exécuter cette ligne de commande :
    `composer install`

### Gestion des QR Codes
Donner accès en écriture à l'utilisateur `www-data` sur le dossier/sous dossiers `assets/img`.

  - Ouvrir un terminal et se positionner à la racine du projet
  - Rendre l'utilisateur `www-data` propriétaire du dossier `assets/img` et lui donner les droits en écriture

```
sudo chown -R www-data assets/img
sudo chmod -R 755 assets/img
```

  - Donner accès en écriture à l'utilisateur `www-data` sur le dossier `vendor/mpdf/mpdf/tmp` et ses sous dossiers.

    * Toujours à la racine du projet dans un terminal
    * Rendre l'utilisateur `www-data` propriétaire du dossier `vendor/mpdf/mpdf/tmp` et lui donner les droits en écriture

```
sudo chown -R www-data vendor/mpdf/mpdf/tmp
sudo chmod -R 755 vendor/mpdf/mpdf/tmp
```


## Création de la base de données

### Base de données avec quelques fixtures pour tester l'application
Importer, via phpmyadmin, le fichier `trobada_db_init_wf.sql` situé dans le dossier database situé lui même
à la racine du projet.

### Base de données avec les utilisateurs de base
Importer, via phpmyadmin, le fichier `trobada_db_init.sql` situé dans le dossier database situé lui même
 à la racine du projet.

### Dans les deux cas, les utilisateurs de base sont :
  - Administrateur
    * login : `admin`
    * password : `admin`
  - Festivalier
    * login : `festi`
    * password : `festi`
  - Commerçant
    * login : `comme`
    * password : `comme`
  - Organisateur
    * login : `organ`
    * password : `organ`



## Création d'un virtual-host

`www.trobada.eu`

Cette étape est facultative et n'est pas détaillée dans ce fichier.



## Configuration de l'application
Deux fichiers de configuration doivent être édités afin de paramétrer l'url de base de l'application et
l'accès à la base de données.

Rendez vous dans le fichier `application/config/config;php` à la ligne 26 et renseigner le paramètre
`config['base_url']` avec le virtual-host précédemment créé ou bien avec la valeur `http://localhost/dossier_du_projet`.

Ouvrir ensuite le fichier `application/config/database.php` et saisir les paramètres d'accès à votre base MySql :

*exemple :*
  - 'hostname' => 'localhost'
  - 'username' => 'root'
  - 'password' => 'root'
  - 'database' => 'trobada'

**L'application est maintenant accessible en saisissant l'url, précédemment définie, dans la barre d'adresse
de votre navigateur.**
