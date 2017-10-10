<?php

$allFiles = scandir ( "upload");
$files = preg_grep("/image/", $allFiles);

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <title>WCS quête file</title>
</head>
<body>

<div class="row">


<form action="upload2.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
    <div class="file-field input-field">
        <div class="btn">
            <input type="file" name="img[]"  id="img"  multiple="multiple" />
            <span>Image à uploader</span>
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Upload one or more files">
        </div>
    </div>
    <button class="btn" type="submit" name="action">Submit<i class="material-icons right">send</i>
    </button>
</form>
</div>
<div class="row">
<?php foreach ($files as $file): ?>

    <div class="col s12 m6 l3">
        <div class="card">
            <div class="card-image">
                <img src="upload/<?php echo $file; ?>" class="responsive-img " alt="">
            </div>
            <div class="card-card-content">
                <p class="center-align"><?php echo $file; ?></p>
            </div>
            <div class="card-action">
                <a href="delete.php?id=<?php echo $file;?>" class="btn btn-danger" role="button">Supprimer</a>
            </div>
        </div>
    </div>

<?php endforeach; ?>
</div>











<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</body>
</html>