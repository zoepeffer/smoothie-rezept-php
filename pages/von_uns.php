<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="display-2">Willkommen </h1>
      <h2>bei Smoothie Makers</h2>
      <br />
      <h4><em>Ich brauche noch etwas Zeit...</em></h4>
      <br />
      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
        sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum
        dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
        sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
    </div>
    <div class="col">
    </div>
  </div>

  <?php
echo "<br /><b>Heute ist:</b><br />";
echo date("d.m.Y");
echo "<br />";

$endTime = mktime(16, 30, 0, 5, 1, 2020); //Stunde, Minute, Sekunde, Monat, Tag, Jahr;
$timeNow = microtime(true);
$diffTime = $endTime - $timeNow;
$milli = explode(".", round($diffTime, 2));
$millisec = round($milli[1]);

$day = floor($diffTime / (24*3600));
$diffTime = $diffTime % (24*3600);
$houre = floor($diffTime / (60*60));
$diffTime = $diffTime % (60*60);
$min = floor($diffTime / 60);
$sec = $diffTime % 60;

echo "<br /><b>Ich brauche noch:</b><br />";
echo $day." Tage ";
echo $houre." Stunden ";
echo $min." Minuten ";
echo $sec." Sec ";
echo $millisec." Millisec";
echo "<br />";
echo "<br />";
echo "<br />";
?>