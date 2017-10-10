<?php

print_r($_POST);
print_r($_FILES);


//Recup l'upload
$image = $_FILES["img"]["name"];
$imageFileType = pathinfo($image, PATHINFO_EXTENSION);

//Chaine aléatoire
$chaine = 'abcdefghijklmnopqrstuvwyz0123456789';
$melange = str_shuffle($chaine);
$nameFile = "images" . substr($melange, 0, 10) . $imageFileType;


//Par défault
$uploadOK = 0;



$target_dir = "images/";
$target_file = $target_dir.$nameFile;

// Vérif du type de l'image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES['img']['tmp_name']);
    if ($check !== false) {
        echo "Le fichier est une image" . $check ['mine'];
        $uploadOK = 1;

    } else {
        echo "Le fichier n'est pas une image";
        $uploadOK = 0;

    }

}

// Vérif que l'image n'existe pas déjà
if (file_exists($target_file)) {
    echo "Désolé le fichier existe déjà";
    $uploadOK = 0;

}

// Vérif la taille du fichier
if ($_FILES["img"]["size"] > 104875) {
    echo "Désolé le fichier est trop lourd";
    $uploadOK = 0;
}

// Vérif du type
if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif') {
    echo "Pas le bon type de fichier";

}



if ($uploadOK == 0) {
    echo "Désolé ton fichier n'a pas été uploadé";

} else {
    if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
        echo "l'image";
    }
}






