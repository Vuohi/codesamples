
<?php


if (isset($_POST['luomuistutuslaskut'])){


  $y_tiedot = "";

  if (!$yhteys = pg_connect($y_tiedot))
  die("Tietokantayhteyden luominen ep�onnistui.");




  $tulos = pg_query("SELECT Lasku.laskuID, Lasku.summa, Lasku.asiakasnumero, Asiakkaat.nimi, Asiakkaat.osoite, Kohde.kuvaus
    FROM Lasku
    INNER JOIN Asiakkaat ON Asiakkaat.asiakasnumero = Lasku.asiakasnumero
    INNER JOIN Tyosuoritus ON Tyosuoritus.Asiakasnumero = Asiakkaat.asiakasnumero
    INNER JOIN Kohde ON Kohde.kohdenumero = Tyosuoritus.kohdenumero
    WHERE Lasku.jarjestysnumero = 1 AND Lasku.erapaiva < CURRENT_DATE AND Lasku.maksupaiva IS NULL");

    if (!$tulos) {
      echo "Virhe kyselyssä.\n";
      exit;
    }

    $luku = 0;

    echo "<br><h3>Luodut muistutuslaskut:</h3>";

    echo "<table class=\"table table-striped\">
    <thead>
    <tr>
    <th>Asiakkaan nimi</th>
    <th>Osoite</th>
    <th>Kohde</th>
    <th>Summa</th>
    </tr>
    </thead>";



    while($rivi = pg_fetch_row($tulos)) {
      if (!$tehtyjo = pg_fetch_row(pg_query("SELECT * FROM Lasku WHERE alkuperainen_laskuID = $rivi[0]"))) {
        $rivi[1] += 5.00;
        pg_query("INSERT INTO Lasku(summa, jarjestysnumero, asiakasnumero, alkuperainen_laskuID) VALUES(
          '$rivi[1]','2','$rivi[2]','$rivi[0]')");
          echo "<tr>
          <td>$rivi[3]</td>
          <td>$rivi[4]</td>
          <td>$rivi[5]</td>
          <td>$rivi[1]</td>";

          $luku++;
        }
      }

      echo $luku;
      echo "</table>";

      pg_close($yhteys);
    }

    ?>
