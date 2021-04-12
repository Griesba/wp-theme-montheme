## create you own wordpress theme
- we will be working in wp-content/ folder

## La page des themes
- http://localhost/wordpress/wp-admin/themes.php


# Indentation dans VSCode
- Crtl + Shift + P  et chercher `Format Document` ou alors `Alt + Shift + F` pour aller plus rapidement


## Hook
- see documentation. Exemple: after_setup_theme, wp_register_style

- wp_register_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', [], version); // le parametre de version est important pour éviter la mise en cache

# Les filtres
- permetent d'alterer une valeur

## Les boucles

## Hierachie des templates
- https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png
- taxonomy-sport.php: fichier template pour la gestion de l'affichage des taxonomy lié au sport
- archive-bien.php: fichier template des post de type bien

## Les formats d'image
- on a installé le plugin 'Regenerate Thumbnails' qui nous permet générer different format d'image en fonction du format qu'on a choisi

## Taxonomy et type de post
- lorsqu'on enregitre un nouveau type de taxonomy et de post, il faut également enregistrer les permalinks pour qu'ils soient pris en compte.

## get_template_part('parts/card', 'post');
    - si dans parts j'ai un fichier card-post je l'utilise sinon c'est card.php 

## pour avoir la page courente
echo var_dump(get_current_screen()); die();

## widgets
dynamic_sidebar('homepage')) ici on charche une side avec le nom 'homepage' et son code est dans le fichier sidebar-homepage.php 

## commentaires
comments_open() || get_comments_number() si les commentaire sont ouvert ou s'il en existe

comments.php contient le code pour representer les commentaires. Il écrase le code par defaut de wordpress

Dand la partie Setting de l'admin, sous la categorie 'Discussion' tu peux reglé l'order d'afficher des commentaire et le nombre de commentaire par page. ça peut aussi se faire par le code en utilisant la function wp_list_comments, mais c'est plus complexe à gérer
Le filter comment_form_default_fields permet de modifier le html du formulaire comment. il faut se connecté comme user pour tester ça. l'admin ne le voit pas