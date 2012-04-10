<?php
include 'header.php';
$action = mysql_escape_string($_GET['action']);

if (empty($action))
	{
?>
	<h2><img src="//www.technostress.fr/images/icones/contact.png" class="icone" alt="Icône" />Contact</h2>
	<div class="grey_post">
		<img src="//www.technostress.fr/images/icones/mail.png" class="icone" alt="Icône" ><a href="mailto:antoine@augusti.fr" target="_blank">antoine@augusti.fr</a><br>
		<img src="//www.technostress.fr/images/icones/website.png" class="icone" alt="Icône" ><a href="//www.antoine-augusti.fr" target="_blank">www.antoine-augusti.fr</a><br>
		<img src="//www.technostress.fr/images/icones/facebook.png" class="icone" alt="Icône" ><a href="//www.facebook.com/AntoineAugusti" target="_blank">www.facebook.com/AntoineAugusti</a><br>
		<img src="//www.technostress.fr/images/icones/twitter.png" class="icone" alt="Icône" ><a href="//www.twitter.com/AntoineAugusti" target="_blank">www.twitter.com/AntoineAugusti</a><br> 
		<img src="//www.technostress.fr/images/icones/skype.png" class="icone" alt="Icône" ><a href="#">AntoineAugusti</a><br>
	</div>
	<br /><br />
	<h2><img src="//www.technostress.fr/images/icones/mail.png" class="icone" alt="Icône" />Me contacter par email</h2>
	<form action="contact?action=send" method="post"> 
		Sujet :<br>
		<input type="text" name="sujet" size="20" maxlength="30"><br> 
		<br /> 
		Votre nom :<br>
		<input type="text" name="nom" size="20" maxlength="30"><br> 
		<br /> 
		Votre email :<br>
		<input type="text" name="email" size="20" maxlength="30"><br> 
		<br />
		<?php echo captcha(); ?> =<br>
		<input type="text" name="captcha" size="20" maxlength="30"><br> 
		<br />
		<textarea rows="10" cols="70" name="message" value="Entrez votre message ici. Soyez le plus précis possible." onblur="javascript:if(this.value==''){this.value='Entrez votre message ici. Soyez le plus précis possible.'}" onFocus="javascript:if(this.value=='Entrez votre message ici. Soyez le plus précis possible.'){this.value=''}"/>Entrez votre message ici. Soyez le plus précis possible.</textarea><br> 
		<br /> 
		Recevoir une copie de cet email ? : <input type="checkbox" value="1" name="copie" checked/> 
		<center><input type="submit" name="submit" class="submit" value="Envoyer"></center> 
	</form>
<?php
	}
elseif ($action == 'send')
	{
	echo '<h2><img src="//www.technostress.fr/images/icones/mail.png" class="icone" alt="Icône" />Me contacter par email</h2>';
	
	if(isset($_POST['sujet']))      $sujet = $_POST['sujet'];
	else      $sujet = "";

	if (isset ($_POST ['copie'])) $copie = TRUE; 
	else $copie = FALSE; 

	if(isset($_POST['message']))      $message = $_POST['message'];
	else      $message = "";

	if(isset($_POST['email']) && preg_match("#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))     $email = $_POST['email'];
	else      $email = "";


	if(isset($_POST['nom']))      $nom = $_POST['nom'];
	else      $nom = "";
	
	if(empty($sujet) OR empty($message) OR empty($email) OR empty($nom))
		{ 
		echo '<div class="erreur">Attention, un champ est vide</div><br /><br />
		<a href="javascript:history.back()">&raquo; Retour</a>';
		}
	else      
		{
		if($_POST['captcha'] == $_SESSION['captcha'])
			{
		  
			$headers ='From: "'.$nom.'"<no-reply@technostress.fr>'."\n";
			$headers .='Reply-To: '.$email.''."\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
			$headers .='Content-Transfer-Encoding: 8bit';
			$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
			 
			 
			$message .= "\r\n";
			$message .= "\r\n";
			$message .= "------------------ Message envoyé depuis www.technostress.fr ------------------";
			
			if(mail("antoine.augusti@gmail.com", stripslashes($sujet), stripslashes($message), $headers))
				{ 
				echo '<img src="//www.technostress.fr/images/icones/success.png" class="icone" alt="Icône" />Le message a bien été envoyé !<br><br /><br />Vous recevrez une réponse sur votre adresse email donnée (<a href="mailto:'.$email.'">'.$email.'</a>)';
				}
			else
				{
				echo '<div class="erreur">Le message n\'a pu être envoyé</div><br /><br />
				<a href="javascript:history.back()">Retour</a>';
				}

			$message .= "\r\n";
			$message .= "\r\n";
			$message .= "------------------ Ceci est la copie de votre message ------------------";

			if ($copie == TRUE && mail($email, stripslashes($sujet), stripslashes($message), "$headers"))
				{
				echo "<br /><br />Une copie de votre message &agrave; été envoyée sur votre adresse email.";
				}
			}
		else 
			{
			echo '<div class="erreur">Le code de sécurité entré est mauvais</div><br /><br /><a href="javascript:history.back()">&raquo; Retour</a>';
			}
		}
	}
include 'footer.php'; 
?>