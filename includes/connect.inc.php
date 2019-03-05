<?php
/*
MiniChat
Author : Eddy Bardoulat
Email : eddybardoulat69@gmail.com
Création : 2018
*/

define('HOST', 'localhost'); // Nom du serveur (en général c'est localhost)
define('USER', 'root'); // Utilisateur de la base de donnée
define('PASS', ''); // Mot de passe de l'utilisateur de la base
define('DBASE', 'test'); // Nom de la base de donnée

$link = @mysql_connect(HOST, USER, PASS); // Lien de connexion au serveur
$db = @mysql_select_db(DBASE, $link); // Sélection de la base de données

if(!$link || !$db)
{
	echo 'Impossible de se connecter à la base de données, vérifiez vos identifiants de connexion à mysql.';
}
?>