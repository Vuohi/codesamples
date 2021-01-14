<html>
 <head>
  <title></title>
 </head>
 <body>

   <?php

$y_tiedot = "";

if (!$yhteys = pg_connect($y_tiedot))
   die("Tietokantayhteyden luominen ep�onnistui.");



   pg_query("CREATE TABLE IF NOT EXISTS asiakkaat (
       asiakasnumero INT,
       nimi VARCHAR,
       osoite VARCHAR,
       PRIMARY KEY (asiakasnumero)
       )");

   pg_query("CREATE TABLE IF NOT EXISTS Lasku(
     laskuID SERIAL NOT NULL,
     pvm DATE DEFAULT CURRENT_DATE,
     maksupaiva DATE,
     erapaiva DATE DEFAULT CURRENT_DATE + '30 DAYS' :: INTERVAL,
     summa NUMERIC (7, 2),
     jarjestysnumero INT NOT NULL,
     asiakasnumero INT NOT NULL,
     alkuperainen_laskuID INT,
     PRIMARY KEY (laskuID),
     FOREIGN KEY (asiakasnumero) REFERENCES Asiakkaat,
     CONSTRAINT FK_alkuperainen_laskuID_Lasku FOREIGN KEY(alkuperainen_laskuID)
     REFERENCES Lasku(laskuID)
   );");

   $id = 1 + pg_query("SELECT max(asiakasnumero) FROM Asiakkaat");

   pg_query("INSERT INTO Asiakkaat(asiakasnumero, nimi, osoite) VALUES('$id', 'Markku Kurkku', 'Herkkukurkku 22')");
   $id++;
   pg_query("INSERT INTO Asiakkaat(asiakasnumero, nimi, osoite) VALUES('$id', 'Johannes Vihannes', 'Hylly 7')");
   $id++;
   pg_query("INSERT INTO Asiakkaat(asiakasnumero, nimi, osoite) VALUES('$id', 'Agrippa Paprika', 'Luku 1700')");

   $tulos = pg_query("SELECT asiakasnumero
     FROM Asiakkaat");
$id = 1 + pg_query("SELECT max(kohdenumero) FROM Kohde");
     while($rivi = pg_fetch_row($tulos)) {
       pg_query("INSERT INTO Kohde(kohdenumero, kuvaus, osoite, asiakasnumero)
       VALUES('$id', 'KOTI', 'Tie 3', '$rivi[0]')");
       $id++;
     }

     $tulos = pg_query("SELECT kohdenumero, asiakasnumero
       FROM Kohde");

       $id = 1 + pg_query("SELECT max(tyosuoritusID) FROM tyosuoritus");

       while($rivi = pg_fetch_row($tulos)) {
         pg_query("INSERT INTO Tyosuoritus(tyosuoritusID, tila, kohdenumero, asiakasnumero)
         VALUES('$id','Valmis', '$rivi[0]', '$rivi[1]')");
          $id++;
       }

       $tulos = pg_query("SELECT tyosuoritusID, asiakasnumero
         FROM Tyosuoritus");

$id = 1 + pg_query("SELECT max(laskuID) FROM Lasku");

     while($rivi = pg_fetch_row($tulos)) {
       pg_query("INSERT INTO Lasku(laskuID, erapaiva, summa, jarjestysnumero, asiakasnumero, tyosuoritusID)
       VALUES('$id','2019-03-31', '7300', '1', '$rivi[1]', '$rivi[0]')");
       $id++;
     }

     $tulos = pg_query("SELECT laskuID, asiakasnumero
       FROM Lasku");

       $id = 1 + pg_query("SELECT max(laskuID) FROM Lasku");

       while($rivi = pg_fetch_row($tulos)) {
         pg_query("INSERT INTO Lasku(laskuID, erapaiva, summa, jarjestysnumero, asiakasnumero, alkuperainen_laskuID)
         VALUES('$id','2019-04-15', '7305', '2', '$rivi[1]', '$rivi[0]')");
         $id++;
       }



         $tulos = pg_query("SELECT asiakasnumero
           FROM Asiakkaat");

$id = 1 + pg_query("SELECT max(laskuID) FROM Lasku");

           while($rivi = pg_fetch_row($tulos)) {
             pg_query("INSERT INTO Lasku(laskuID, erapaiva, summa, jarjestysnumero, asiakasnumero)
             VALUES('$id','2019-02-27', '5200', '1', '$rivi[0]')");
             $id++;
           }

pg_close($yhteys);

    ?>

  </body>
</html>
