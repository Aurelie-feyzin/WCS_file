<?php

if(isset($_GET['id'])) {
    $filename = $_GET['id'];
   unlink ("upload/".$filename );
    header( "refresh:0;url=index.php" );
   // echo "L'article a été supprimé";

}
