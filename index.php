<?php
/*
MiniChat
Author : Eddy Bardoulat
Email : eddybardoulat69@gmail.com
Création : 2018
*/

$file = 'minichat.php';

if(file_exists($file))
{
  header('Location: '.$file);
}
else
{
  echo '<h4>Veuillez mettre en place le fichier minichat.php svp...</h4>';
}
?>