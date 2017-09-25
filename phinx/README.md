# Présentation

Phinx est un outil de gestion et migrations de base de données. Il permet de s'adapter facilement à différents systèmes de gestions des bases de données (MySQL, MS SQL, PostgreSQL,...).
Site du projet : https://phinx.org/
L'outil est développé en PHP et est développé en suivant la logique de Symfony 2. 

# Installation

#### Cloner le repository

Commencez par cloner le repository: 
    
    https://github.com/m3t1x/operating
    
Vous pouvez le cloner avec votre logiciel de gestion de version (type **GitHub Desktop**).
Ou bien avec la ligne de commande suivante (à exécuter dans votre terminal) 

    git clone https://github.com/m3t1x/operating

#### Requis

Certains éléments sont requis afin de pouvoir installer et utiliser Phinx.

##### PHP-Cli

PHP-Cli est installé par défaut sur MacOSX. Lors de l'installation de MAMP, une autre version de ce dernier est aussi installée.

Seulement, par défaut, la commande php va utiliser celle de MacOSX qui n'est pas configurer correctement.

Pour configurer la version de PHP correctement :
* Allez récupérer votre version PHP de MAMP : Allez dans le logiciel MAMP, allez dans Préférences => PHP puis copiez la version de PHP sélectionnée.
* Par ligne de commande, déplacez vous dans le projet puis exécutez le script d'installation


    cd operating
    ./scripts/php-config.sh

Une fois la commande exécutée, vous devez redémarrer votre terminal. Une fois fait, votre système utilisera la bonne version de PHP

Pour le vérifier, entrez la commande:

    which php
    
La commande devrait vous retourner un chemin du type : 
    
    /Applications/MAMP/bin/php/php5.6.30/bin/php
    
##### Composer

Pour l'installation de Phinx, l'orchestrateur Composer est lui aussi nécessaire : https://getcomposer.org/

Pour l'installer, il faut suivre les étapes décrites sur cette page : https://getcomposer.org/download/

    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer
    
### Installation de Phinx

Maintenant que PHP et Composer sont correctement installés et configurés, il reste à installer Phinx.

Aller dans le dossier phinx du repository Operating et lancez l'installation par composer

    cd /pathtotherepository/phinx
    composer install
    
Une fois fait, vous devriez avoir Phinx d'installer, pour vérifier, lancez la commande **"phinx"**, si le système dit qu'elle est introuvable, relancez votre terminal et revenez dans le dossier.
Pour plus d'information sur l'installation de Phinx : http://docs.phinx.org/en/latest/install.html

#### Commande 'phinx'

Afin de faciliter l'utilisation de Phinx, la commande _"php vendor/bin/phinx"_ peut être remplacée par un lien symbolique: _"phinx"_

Lors de l'exécution de _php-config.sh_, le lien symbolique est automatiquement créé. Il peut être modifié/supprimé en éditant le _"bash profile"_ de l'utilisateur (voir les fichiers _~/.bash_profile_ ou _~/.zshrc_)

# Utilisation de Phinx

#### Presentation

Maintenant que Phinx est installé, vous allez pouvoir l'utiliser pour mettre à jour facilement vos bases de données.

Pour plus de détails sur la création/édition d'un projet Phinx, vous pouvez vous référer à la documentation officielle : http://docs.phinx.org/en/latest/

#### Mise à jour de la base de données

Pour mettre à jour sa base de données à jour en fonction à partir de Phinx

    phinx migrate -e development
    
#### Annuler la dernière mise à jour

Pour annuler la dernière mise à jour de sa base de données

    phinx rollback -e development
    
### Migration et Seeding

Phinx se base sur deux principes généraux :
* La Migration: 

La Migration est en général utilisée pour créer/modifier/supprimer des tables dans les base de données

Elle utilise un système de versions (basées sur la date) et permet d'avancer ou reculer dans les versions à l'aide de diverses commandes.

Pour créer une migration : http://docs.phinx.org/en/latest/migrations.html

* Le Seeding

Le Seeding est utilisé pour insérer/modifier des données en base.


Il n'utilise pas de système de version et chaque script sont appelés séparément. Il n'est pas possible de gerer les rollbacks avec les données.

### Configuration Multi-environnements

C'est ici le gros avantage de Phinx : il permet d'utiliser les mêmes scripts sur différents serveurs possédant différents systèmes de base de données.
Il suffit de préciser dans le fichier de configuration, quel environnement tourne sur quel système, il s'occupe d'effectuer les bonnes requêtes (voir la partie Configuration plus bas pour plus de détails)

#### Configuration

Les éléments de configuration de phinx sont définis dans le fichier _phinx.yml_.

###### Example de fichier phinx.yml

    paths:
        migrations: %%PHINX_CONFIG_DIR%%/db/migrations/bciti
        seeds: %%PHINX_CONFIG_DIR%%/db/seeds/bciti
        
    environments:
        default_migration_table: Op_PhinxLog
        default_database: dev
        
        dev:
            adapter: mysql
            host: localhost
            name: bciti
            user: root
            pass: 'root'
            port: 3306
            charset: utf8
            
    version_order: creation  

Tous les détails de configuration sont [ici](http://docs.phinx.org/en/latest/configuration.html)

#### Gestion multi-base de données

Phinx ne permet pas de gérer plusieurs bases de données à l'intérieur d'une même configuration.  Pour remédier à ça, nous utilisons un fichier de configuration par base de données qui décris la structure de répertoires et des connexions aux environnements.

###### Structure des répertoires

    -> phinx
        -> db
            -> migrations
                -> bciti
                    scripts_de_migration_bciti.php
                    
                -> app02
                    scripts_de_migration_app02.php
                    
                -> app03
                    scripts_de_migration_app03.php
                    
            -> seeds
                -> bciti
                    -> data
                        fichiers_de_data_bciti.json
                        
                    scripts_de_seed_bciti.php                

                        
                -> app02
                    -> data
                        fichiers_de_data_app02.json
                    
                -> app03
                    -> data
                        fichiers_de_data_app03.json
                        
        -> vendor
        
        composer.json
        composer.lock
        
        phinx.bciti.yml.sample
        phinx.app02.yml.sample
        phinx.app03.yml.sample
        
        phinx.yml
        
        Readme.md
        
        seed_bciti.sh
        
Les fichiers *yml.sample* contiennent les éléments de configurations à adapter à son environnement propre.  Pour l'environnement de développement, il faut le copier en _"phinx.yml"_ et y ajouter les paramètres de connexions à sa base de données locale.  

