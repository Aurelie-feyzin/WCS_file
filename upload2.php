<?php
//**********************Boucle pour upload toute les fichiers****************
if (count($_FILES['img']['name']) > 0) {

    //Loop through each file
    for ($i = 0; $i < count($_FILES['img']['name']); $i++) {

        //************* Vérification de l'extension***************

// Création d'une liste blanche des extensions autorisées
        $controle_extensions_autorisees = ['jpg', 'png', 'gif'];

// Récupération du nom du fichier
        $fichier_upload_nom = $_FILES['img']['name'][$i];
// Récupération de l'extension du fichier
        $fichier_extension = strtolower(pathinfo($fichier_upload_nom, PATHINFO_EXTENSION));
// Vérification de l'extension du fichier
        if (!in_array($fichier_extension, $controle_extensions_autorisees)) {
            echo 'L\'extension du fichier n\'est pas autorisée';
        }


//*********************Vérification du type MIME*****************************
// Ce tableau contient la liste des types MIME autorisés:
// On autorise uniquement les fichiers image de type gif, jpeg et png
        $controle_type_mime_autorises = ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png'];

// Récupération du type MIME avec mime_content_type()
        $fichier_upload_source = $_FILES['img']['tmp_name'][$i];
        $fichier_mime_type = mime_content_type($fichier_upload_source);

// On vérifie que le type MIME appartient à la liste blanche
        if (!in_array($fichier_mime_type, $controle_type_mime_autorises)) {
            echo 'Le type du fichier n\'est pas autorisée';
        }

//********************************Vérifier la taille du fichier ***************
// Définition de la taille maximale autorisée à 1Mo, soit 100000 octets
        $controle_taille_maximum = 104875;

        $fichier_upload_taille = $_FILES['img']['size'][$i];

        if ($fichier_upload_taille > $controle_taille_maximum) {
            echo 'La taille du fichier est de ' . $fichier_upload_taille . ' et dépasse la taille autorisée de ' . $controle_taille_maximum;
        }


//************************Renommer le fichier uploadé avec un nom aléatoire**********
        $upload_repertoire = 'upload';
        /*
        // Exemple 1: on génère une chaîne aléatoire avec hash()
        $nouveau_nom = hash('sha256', (microtime().$fichier_upload_nom)).'.'.$fichier_extension;
        */
// Exemple 2: on génère une chaîne aléatoire avec bin2hex() sur random_bytes()
        $nouveau_nom = "image" . bin2hex(random_bytes(5)) . '.' . $fichier_extension;


        $fichier_upload_destination = $upload_repertoire . '/' . $nouveau_nom;

        //$files[] = $fichier_upload_destination;


//************************Transfert du fichier********************************

// Upload du fichier dans son chemin de destination
        move_uploaded_file($fichier_upload_source, $fichier_upload_destination);
//Modification des droits
        chmod($fichier_upload_destination, 0777);

//**********************Liste les fichiers Upload dans un tableau*************
        $files[] = $fichier_upload_destination;


    }

//************************Message de transfert*********************************
/*
//show success message
    echo "<h1>Uploaded:</h1>";
    if (is_array($files)) {
        echo "<ul>";
        foreach ($files as $file) {
            echo "<li>$file</li>";
        }
        echo "</ul>";
    }
*/

    header( "refresh:0;url=index.php" );
}
