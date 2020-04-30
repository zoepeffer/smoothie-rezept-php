<style>
.fehlertext {color:red;}
.fehlerhintergrund {background-color: red;}
</style>


<?php
$fehler = 0;
if(isset($_POST["registration"]))
{
	$_POST["login"] 	= trim($_POST["login"]); // leerzeichen vorne und hinten entfernen
	$_POST["email"] 	= trim($_POST["email"]); // leerzeichen vorne und hinten entfernen
	$_POST["passwort"] 	= trim($_POST["passwort"]); // leerzeichen vorne und hinten entfernen
	
	if($_POST["login"] == "")
	{	
		$fehler++; // Fehler hochzählen
		$login_fehler = "<span class='fehlertext'>Bitte Nutzername angeben!</span>";
		$login_hintergrund = "class='fehlerhintergrund'";
	}
	
	if($_POST["passwort"] == "")
	{
		$fehler++; // Fehler hochzählen
		$password_fehler .= "<span class='fehlertext'>Bitte Passwort eintragen!</span>";
		$passwort_hintergrund = "class='fehlerhintergrund'";
	}
	
	$passwort = $_POST["passwort"];
	$laenge = mb_strlen($passwort);
	$passwort_fehler = "";
	
	
	$email = $_POST["email"];
	$at_zeichen = mb_strpos($email,"@");
	$punkt_zeichen = mb_strrpos($email, ".", $at_zeichen); //	offset = erst ab @ zeichen suchen
	$laenge = mb_strlen($email);
	$email_fehler = "";
	
	if($_POST["email"] == "")
	{
		$fehler++; // Fehler hochzählen
		$email_fehler .= "<span class='fehlertext'>Bitte E-Mail eintragen!</span>";
		$email_hintergrund = "class='fehlerhintergrund'";
	}
	
	else	
	{
		if($at_zeichen === false)
		{
			$fehler++; // Fehler hochzählen
			$email_fehler .= "<span class='fehlertext'>Sie müssen ein <b>'@'</b> Zeichen verwenden!</span>";
			$email_hintergrund = "class='fehlerhintergrund'";
		}	
		// Kein . Zeichen gefunden
		if($punkt_zeichen === false)
		{	
			$fehler++; // Fehler hochzählen
			$email_fehler .= "<span class='fehlertext'>Nach dem @ Zeichen müssen Sie ein 
			<b>'.'</b> Zeichen verwenden!</span>";
			$email_hintergrund = "class='fehlerhintergrund'";
		}

		// Vor dem @ Zeichen müssen 2 Zeichen stehen
		if($at_zeichen < 2)
		{
			$fehler++; // Fehler hochzählen
			$email_fehler .= "<span class='fehlertext'>Schreiben Sie mind. 2 Zeichen vor dem @!</span>";
			$email_hintergrund = "class='fehlerhintergrund'";		
		}

		// Zwischen @ und . müssen mind. 2 Zeichen stehen
		if($punkt_zeichen - $at_zeichen < 3)
		{
			$fehler++; // Fehler hochzählen
			$email_fehler .= "<span class='fehlertext'>Zwischen @ und . müssen mind. 2 Zeichen stehen!</span>";
			$email_hintergrund = "class='fehlerhintergrund'";
		}

		// Nach dem . Zeichen müssen mind. 2 Zeichen folgen
		if($laenge - $punkt_zeichen < 3)
		{
			$fehler++; // Fehler hochzählen
			$email_fehler = "<span class='fehlertext'>Nach dem . Zeichen müssen mind. 2 Zeichen folgen</span>";
			$email_hintergrund = "class='fehlerhintergrund'";		
		}			
	}
	
	

}
?>

<?php
if(!isset($_POST["registration"]) || $fehler > 0)
{
?>
<form action="" method="post">
Name * <?php echo @$login_fehler; ?><br />
<input type="text" name="login" value="<?php echo @$_POST["login"];?>" 
<?php echo @$login_hintergrund ?> /><br />


E-Mail * <?php echo @$email_fehler; ?><br />
<input type="text" name="email" value="<?php echo @$_POST["email"];?>"
 <?php echo @$email_hintergrund ?> /> <br />
 <br />
Beispiel: max.mustermann@gmail.de
<br /><br />
 
Passwort * <?php echo @$password_fehler; ?><br />
<input type="password" name="passwort" value="<?php echo @$_POST["passwort"];?>"
 <?php echo @$passwort_hintergrund ?> /> <br />
<br />



<br />
<input type="submit" name="registration" value="eigene Beschriftung" />

* = Pflichtfeld
</form>
<?php
}
else
{
	echo "<h1 style='color:green'>Vielen Dank für Ihre Anfrage!</h1>";
	echo "<h1>Name:'".$_POST["login"]."'</h1>";
	echo "<h1>E-Mail:'".$_POST["email"]."'</h1>";
	echo "<h1>Passwort:'".$_POST["passwort"]."'</h1>";
}
?>