<?php
function page_title()
	{
	$page = $_SERVER['PHP_SELF'];
	$php_self = substr($page,1,-4);
	$name_page_ucfirst = ucfirst($php_self);
	
	switch ($name_page_ucfirst)
		{
		case 'Synthese' : $name_page_ucfirst = "Synthèse";
		break;
		case 'Causes-effets' : $name_page_ucfirst = "Causes et effets";
		break;
		case 'Lutter' : $name_page_ucfirst = "Lutter contre le technostress";
		break;
		case '404' : $name_page_ucfirst = "Erreur 404";
		break;
		}
	
	if ($php_self != 'index') 
		{
		echo '<title>'.$name_page_ucfirst.' | Le technostress</title>';
		}
	else 
		{
		echo '<title>Le technostress | Étude sur le stress causé par les NTIC</title>';
		}
	}

function sous_titre_plan ($numero,$titre,$page='causes-effets') 
	{
	if ($numero == 'a')
		{
		$marge = '';
		}
	else
		{
		$marge = 'margin_top_10';
		}
	echo '<div class="sous_titre '.$marge.'"><span class="numero_titre">'.$numero.'.</span><a href="'.$page.'#'.$numero.'" title="'.$titre.'">'.$titre.'</a></div>';
	}

function grand_titre_plan ($numero,$titre,$page='causes-effets') 
	{
	echo '<div class="grand_titre"><span class="numero_titre">'.$numero.'-</span><a href="'.$page.'" class="link_black" title="'.$titre.'">'.$titre.'</a></div>';
	}

function grande_idee ($titre)
	{
	echo '<div class="grande_idee"><li class="square">'.$titre.'.</li></div>';
	}

	
function captchaMath()
	{
		$n1 = mt_rand(1,30);
		$n2 = 42 - $n1;
		$nbrFr = array('0','1','2','3','4','5','6','7','8','9','10');
		$resultat = $n1 + $n2;
		$phrase = ''.$n1.' + '.$n2.'';
		
		return array($resultat, $phrase);	
	}

function captcha()
	{
		list($resultat, $phrase) = captchaMath();
		$_SESSION['captcha'] = $resultat;
		return $phrase;
	}
?>