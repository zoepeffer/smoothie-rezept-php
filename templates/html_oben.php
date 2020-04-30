<!DOCTYPE html>
<html>

<head>
  <title>Smoothie Makers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>

  <div class="kopf">
    <a class="btn btn-outline-light" data-toggle="collapse" href='?seite=von_uns' role="button" aria-expanded="false" aria-controls="collapseExample">Von Uns</a>
    <?php 
if(isset($_SESSION["erfolgreich_eingeloggt"]))
{
?>
	<a class="btn btn-outline-light" data-toggle="collapse" href='?seite=smoothie_schreiben' role="button" aria-expanded="false" aria-controls="collapseExample">Schreiben</a>
    <a class="btn btn-outline-light" data-toggle="collapse" href='?seite=alle_smoothie' role="button" aria-expanded="false" aria-controls="collapseExample">Smoothies bearbeiten</a>
    <a class="btn btn-danger" data-toggle="collapse" href='?seite=logout' role="button" aria-expanded="false" aria-controls="collapseExample">Logout</a>
    <?php
}
else
{
?>	
     <a class="btn btn-outline-light" data-toggle="collapse" href='?seite=smoothies' role="button" aria-expanded="false" aria-controls="collapseExample">Smoothies</a>
	 <a class="btn btn-outline-light" data-toggle="collapse" href='?seite=login' role="button" aria-expanded="false" aria-controls="collapseExample">Login</a>
	 <a class="btn btn-outline-light" data-toggle="collapse" href='?seite=registration' role="button" aria-expanded="false" aria-controls="collapseExample">Registrieren</a>
	 <?php
}
?>
  </div>

  <div class="hauptteil">