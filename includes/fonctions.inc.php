<?php
// Affichage des smileys
function controle($texte)
{	
  $texte = htmlspecialchars($texte);
  $texte = nl2br($texte);
  $texte = str_replace(":O","<img src=\"images/1.gif\" border=\"0\" />",$texte);
  $texte = str_replace("^^","<img src=\"images/2.gif\" border=\"0\" />",$texte);
  $texte = str_replace("lol","<img src=\"images/3.gif\" border=\"0\" />",$texte);
  $texte = str_replace("o_O","<img src=\"images/4.gif\" border=\"0\" />",$texte);
  $texte = str_replace(";)","<img src=\"images/5.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":p","<img src=\"images/6.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":gulp:","<img src=\"images/7.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":ouep:","<img src=\"images/8.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":honte:","<img src=\"images/9.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":fache:","<img src=\"images/10.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":hein:","<img src=\"images/11.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":heu:","<img src=\"images/12.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":rire:","<img src=\"images/13.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/14/","<img src=\"images/14.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/15/","<img src=\"images/15.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/16/","<img src=\"images/16.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":decu:","<img src=\"images/17.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/18/","<img src=\"images/18.gif\" border=\"0\" />",$texte);
  $texte = str_replace("O_O","<img src=\"images/19.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/20/","<img src=\"images/20.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/21/","<img src=\"images/21.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":)","<img src=\"images/22.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":(","<img src=\"images/23.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/24/","<img src=\"images/24.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/25/","<img src=\"images/25.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":love:","<img src=\"images/26.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/27/","<img src=\"images/27.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":hum:","<img src=\"images/28.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":ruse:","<img src=\"images/29.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":-))","<img src=\"images/30.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/31/","<img src=\"images/31.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":reponse:","<img src=\"images/32.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/33/","<img src=\"images/33.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/34/","<img src=\"images/34.gif\" border=\"0\" />",$texte);
  $texte = str_replace("/35/","<img src=\"images/35.gif\" border=\"0\" />",$texte);
  $texte = str_replace(":amour:","<img src=\"images/36.gif\" border=\"0\" />",$texte);
  $texte = preg_replace("!\[b\](.+)\[/b\]!isU","<strong>$1</strong>", $texte);
  $texte = preg_replace("!\[b\]\[/b\]!isU","<img src=\"images/ange.gif\" alt=\"\" />", $texte);
  $texte = preg_replace("!\[i\](.+)\[/i\]!isU","<em>$1</em>", $texte);
  $texte = preg_replace("!\[i\]\[/i\]!isU","<img src=\"images/ange.gif\" alt=\"\" />", $texte);
  $texte = preg_replace("!\[s\](.+)\[/s\]!isU","<span class=\"souligne\">$1</span>", $texte);
  $texte = preg_replace("!\[s\]\[/s\]!isU","<img src=\"images/ange.gif\" alt=\"\" />", $texte);
  $texte = eregi_replace("([[:alnum:]]+)://([^[:space:]]*)([[:alnum:]#?/&=])","<a href=\"\\1://\\2\\3\" target=\"_blank\">\\1://\\2\\3</a>",$texte);
  $texte = eregi_replace("(([a-z0-9_]|\\-|\\.)+@([^[:space:]]*)([[:alnum:]-])\.([^[:space:]]*)([[:alnum:]-]))","<a href=\"mailto:\\1\">\\1</a>",$texte);
  
  return $texte;
}

//Fonction listant les pages
function get_list_page($page, $nb_page, $link, $nb = 2)
{
	$list_page = array();
	for ($i=1; $i <= $nb_page; $i++)
	{
		if (($i < $nb) OR ($i > $nb_page - $nb) OR (($i < $page + $nb) AND ($i > $page -$nb)))
			$list_page[] = ($i==$page)?'<strong>'.$i.'</strong>':'<a href="'.$link.'?p='.$i.'">'.$i.'</a>'; 
		else
		{
			if ($i >= $nb AND $i <= $page - $nb)
				$i = $page - $nb;
			elseif ($i >= $page + $nb AND $i <= $nb_page - $nb)
				$i = $nb_page - $nb;
				$list_page[] = '...';
		}
	}
	$print = implode('-', $list_page);
	return $print;
}

?>