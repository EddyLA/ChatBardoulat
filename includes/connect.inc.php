<?php
/*
MiniChat
Author : Eddy Bardoulat
Email : eddybardoulat69@gmail.com
Cr�ation : 2018
*/

define('HOST', 'localhost'); // Nom du serveur (en g�n�ral c'est localhost)
define('USER', 'root'); // Utilisateur de la base de donn�e
define('PASS', ''); // Mot de passe de l'utilisateur de la base
define('DBASE', 'test'); // Nom de la base de donn�e

$link = @mysql_connect(HOST, USER, PASS); // Lien de connexion au serveur
$db = @mysql_select_db(DBASE, $link); // S�lection de la base de donn�es

if(!$link || !$db)
{
	echo 'Impossible de se connecter � la base de donn�es, v�rifiez vos identifiants de connexion � mysql.';
}
?>