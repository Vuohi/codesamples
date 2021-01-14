<?php

if (isset($_POST['luokarhulaskut'])){


$y_tiedot = "";

if (!$yhteys = pg_connect($y_tiedot))
   die("Tietokantayhteyden luominen ep�onnistui.");



date_default_timezone_set('Europe/Helsinki');

$tulos = pg_query("SELECT Lasku.alkuperainen_laskuID, Lasku.summa, Lasku.asiakasnumero, Lasku.jarjestysnumero, Asiakkaat.nimi, Asiakkaat.osoite, Kohde.kuvaus
  FROM Lasku
  INNER JOIN
  (SELECT alkuperainen_laskuID, MAX(jarjestysnumero) AS suurin
  FROM Lasku
  GROUP BY alkuperainen_laskuID) viimeisin
  ON Lasku.alkuperainen_laskuID = viimeisin.alkuperainen_laskuID
  INNER JOIN Asiakkaat ON Asiakkaat.asiakasnumero = Lasku.asiakasnumero
  INNER JOIN Tyosuoritus ON Tyosuoritus.Asiakasnumero = Asiakkaat.asiakasnumero
  INNER JOIN Kohde ON Kohde.kohdenumero = Tyosuoritus.kohdenumero
  AND Lasku.jarjestysnumero = viimeisin.suurin
  WHERE Lasku.jarjestysnumero >= 2 AND Lasku.erapaiva < CURRENT_DATE AND Lasku.maksupaiva IS NULL");


$luku = 0;

$nyt = new DateTime('now');


echo "<table class=\"table table-striped\">
   <thead>
   <tr>
   <th>Asiakkaan nimi</th>
   <th>Osoite</th>
   <th>Kohde</th>
   <th>Summa</th>
   <th>Laskun järjestysnumero</th>
   </tr>
   </thead>";
   echo "<br><h3>Luodut Karhulaskut:</h3>";
   echo "<br>";


while($rivi = pg_fetch_row($tulos)) {
  $ap_lasku = pg_fetch_row(pg_query("SELECT erapaiva, summa FROM Lasku WHERE laskuID = $rivi[0]"));
  $ap_ep = new DateTime($alkuperainen_lasku[0]);
  $rivi[3] += 1;
  $rivi[1] = round($rivi[1] + ((16 * date_diff($ap_ep, $nyt) * $ap_lasku[1]) / 36000) + 5.00, 2);
  pg_query("INSERT INTO Lasku(summa, jarjestysnumero, asiakasnumero, alkuperainen_laskuID)
  VALUES('$rivi[1]','$rivi[3]','$rivi[2]','$rivi[0]')");
  $luku++;
  echo "<tr>
          <td>$rivi[4]</td>
          <td>$rivi[5]</td>
          <td>$rivi[6]</td>
          <td>$rivi[1]</td>
          <td>$rivi[3]</td>"
          ;
}
echo $luku;
echo "</table>";


pg_close($yhteys);
}
    ?>
