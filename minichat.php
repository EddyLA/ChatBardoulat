<?php
include('./includes/includes.inc.php');

define('SUP_ENTREE', 1); // Remplac� 0 par 1 si vous voulez supprimer les N derni�res entr�es
$n = 50; // Nombres d'entr�es � supprimer lorsque le nombre d'entr�es max est atteint
$nb_max = 150; // Nombre d'entr�es max
$longueur_message = 120; // La taille du message (caract�res maximum)
$nmpp = 8; // Nombres de messages par pages

$sql_ret = "SELECT COUNT(*) AS nb_post FROM minichat";
$retour = mysql_query($sql_ret, $link) or die(mysql_error());
$data_Post = mysql_fetch_array($retour);
$totalPost = $data_Post['nb_post'];
$nombreDePages = ceil($totalPost / $nmpp);

if (isset($_POST['pseudo'], $_POST['message'])) // Si les variables existent
{
  if (!empty($_POST['pseudo']) && !empty($_POST['message'])) // Si on a quelque chose � enregistrer
  {
    if (empty($_POST['info'])) // le $_POST['info'] est une ruse pour les spammeurs
    {
      if (strlen($_POST['message']) < $longueur_message) // Si le message ne d�passe pas la taille autoris�e
      {
        // On utilise les fonctions PHP mysql_real_escape_string pour la s�curit�
        $pseudo = trim(mysql_real_escape_string(utf8_decode($_POST['pseudo'])));
        $message = mysql_real_escape_string(utf8_decode($_POST['message']));
        $time = time();
 
        // Ensuite on enregistre le message
        $sql = "INSERT INTO minichat VALUES('', '".$pseudo."', '".$message."', '".$time."')";
        $insert = mysql_query($sql, $link) or die(mysql_error());

        if($insert == TRUE)
        {
          header('Location: minichat.php');
        }
        else
        {
          header('Location: minichat.php?erreur=send');
        }
        
        mysql_free_result($insert);
      }
      else
      {
        header('Location: minichat.php?erreur=solong');
      }
    }
    else
    {
      header('Location: minichat.php?erreur=spam');
    }
  }
  else
  {
    header('Location: minichat.php?erreur=vide');
  }
}
else
{ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <?php echo utf8_encode('<title>Mini-chat (D�mo)</title>'); ?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <script type="text/javascript">
        function addText(instext) {
        var mess = document.mess.message;
        //IE support
        if (document.selection) {
            mess.focus();
            sel = document.selection.createRange();
            sel.text = instext;
            document.guestbook.focus();
        }
        //MOZILLA/NETSCAPE support
        else if (mess.selectionStart || mess.selectionStart == "0") {
            var startPos = mess.selectionStart;
            var endPos = mess.selectionEnd;
            var chaine = mess.value;

            mess.value = chaine.substring(0, startPos) + instext + chaine.substring(endPos, chaine.length);

            mess.selectionStart = startPos + instext.length;
            mess.selectionEnd = endPos + instext.length;
            mess.focus();
        } else {
            mess.value += instext;
            mess.focus();
            }
        }
        </script>
        
        <style type="text/css">
        body
        {
          width: 86%;
          margin-top: 16px;
          margin-right: 64px;
          margin-bottom: 32px;
          margin-left: 64px;
          background-color: #F9F9F9;
        }
    
        .chat
        {
          width: 55%;
          margin-left: 32px;
          margin-top: 16px;
          font-size: 11px;
          font-family: Verdana, Arial, "Times New Roman", Sans-Serif;
          text-align: left;
          border-style: dashed;
          border-width: 1px;
          padding: 10px;
          background-color: #FFFFFF;
        }
    
        .erreur
        {
          font-family: Verdana, Arial, "Times New Roman", Sans-Serif;
          font-size: 13px;
          text-align: left;
          color: red;
        }
    
        h3
        {
          text-align: center;
        }
        
        #smileys 
        {
          margin: 2px;
        }
        
        .souligne 
        {
          text-decoration: underline;
        }
        
        .input 
        {
          display: none;
        }
        </style>
    </head>
    <body>
   
<?php
}

// On supprime les entr�es sup�rieur � N si SUP_ENTREE est d�fini � 1
if(SUP_ENTREE == 1)
{
  if ($totalPost > $nb_max)
  {
		$sql_d2 = "DELETE FROM minichat ORDER BY id LIMIT ".$n;
		$res_d2 = mysql_query($sql_d2, $link)or die(mysql_error());
		mysql_free_result($res_d2); 
  }
}

$url = trim(strip_tags($_SERVER['REQUEST_URI']));
$url = ereg_replace('/', ' ', $url);
$uri = explode('=', $url);
$uri_final = explode('.', $uri[1]);
$p = $uri_final[0];

if (isset($_GET['p']) && !empty($_GET['p']) && intval($p) <= intval($nombreDePages))
{
	$page = intval($_GET['p']);  
}
else 
{
  $page = 1; 
}

$ppaa = ($page - 1) * intval($nmpp);
$ppaa = mysql_real_escape_string($ppaa);

// Maintenant on doit r�cup�rer les N derni�res entr�es de la table
// On utilise la requ�te suivante pour r�cup�rer les N derniers messages :

$sql_rep = "SELECT pseudo, message, time FROM minichat ORDER BY time DESC LIMIT " . $ppaa . ", " . $nmpp;
$reponse = mysql_query($sql_rep, $link) or die(mysql_error());

echo utf8_encode('<div class="chat"><h3>Bienvenue sur le MiniChat (D�mo)</h3>');

if(mysql_num_rows($reponse) > 0)
{
  // Gestion des erreurs
  if(isset($_GET['erreur']) && $_GET['erreur'] == 'vide')
  {
    echo utf8_encode('<p class="erreur">Un ou plusieurs champs sont rest�s vides.</p>');
  }

  if(isset($_GET['erreur']) && $_GET['erreur'] == 'send')
  {
    echo utf8_encode('<p class="erreur">Une erreur est survenue lors de l\'envoi du message.</p>');
  }

  if(isset($_GET['erreur']) && $_GET['erreur'] == 'solong')
  {
    echo utf8_encode('<p class="erreur">Le message d�passe la taille autoris�e de '.$longueur_message.' caract�res</p>');
  }
  
  if(isset($_GET['erreur']) && $_GET['erreur'] == 'spam')
  {
    echo utf8_encode('<p class="erreur">Les spammeurs n\'ont rien � faire ici.</p>');
  }

  // Puis on fait une boucle pour afficher tous les r�sultats :
  while ($donnees = mysql_fetch_array($reponse))
  {
    echo utf8_encode('<b>'.$donnees['pseudo'].'</b> a �crit le <span style="color:green;font-size:10px;font-style:italic;">'.date('d/m/Y � H\hi', $donnees['time']).'</span> <br/>'.stripslashes(controle($donnees['message'])));
    echo '<br/><br/>';
  }

// Fin de la boucle, le script est termin� !
}
else
{
  echo utf8_encode('<p class="erreur">Il n\'y a encore aucun message d\'envoy� dans le minichat.</p>');
}

mysql_free_result($reponse);

$i = intval($i);
echo '<p>Page : ';
echo get_list_page($page, $nombreDePages, './minichat.php');

?> 
<h5>Postez un message:</h5>
<form method="post" action="minichat.php" name="mess">
<div id="smileys">
  <a onclick="addText(' :O ');return(false)"><img src="./images/1.gif" border="0" alt="" /></a>
  <a onclick="addText(' ^^ ');return(false)"><img src="./images/2.gif" border="0" alt="" /></a>
  <a onclick="addText(' lol ');return(false)"><img src="./images/3.gif" border="0" alt="" /></a>
  <a onclick="addText(' o_O ');return(false)"><img src="./images/4.gif" border="0" alt="" /></a>
  <a onclick="addText(' ;) ');return(false)"><img src="./images/5.gif" border="0" alt="" /></a>
  <a onclick="addText(' :p ');return(false)"><img src="./images/6.gif" border="0" alt="" /></a>
  <a onclick="addText(' :( ');return(false)"><img src="./images/23.gif" border="0" alt="" /></a>
  <a onclick="addText(' O_O ');return(false)"><img src="./images/19.gif" border="0" alt="" /></a>
  <a href="#" onclick="addText('[b][/b]');return(false)"><b style="text-decoration:none;">G</b></a>
  <a href="#" onclick="addText('[i][/i]');return(false)"><i style="text-decoration:none;">i</i></a>
  <a href="#" onclick="addText('[s][/s]');return(false)"><u style="text-decoration:none;">s</u></a>
</div>

<table border="0" cellpadding="1" cellspacing="1">
<tr>
<td>Pseudo :</td> <td><input type="text" name="pseudo" size="20" maxlength="20" /></td></tr>
<tr>
<td>Message :</td> <td><textarea name="message" cols="50" rows="7" ></textarea></td></tr>
<tr><td><input class="input" type="text" name="info" /></td></tr>
<tr>
<td colspan="3" align="center"><input type="submit" value="Envoyer" /></td></tr>

</table>
<a href="javascript:window.document.mess.submit()"></a>
</form></div>
 
</body>
</html>

<?php
// On se d�connecte de MySQL
mysql_close($link);
?>
