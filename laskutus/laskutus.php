<html>
<head>
   <meta charset="utf-8" />
   <title>Harjoitustyö</title>
   <link rel="stylesheet" href="../css/style.css">
</head>
   <body>
      <h1>Sähkötärsky</h1>
      <ul>
      <li><a href="../index.php">Etusivu</a></li>
      <li><a href="../asiakkaat/asiakkaat.php">Asiakkaat</a></li>
      <li><a href="../tarvikkeet/tarvikkeet.php">Tarvikkeet</a></li>
      <li><a href="laskutus.php">Laskutus</a></li>
      </ul>
      <h2>Laskutus</h2>

      <h3>Muistutuslaskut</h3>

      <form action="laskutus.php" method="post">

      <input type="hidden" name="luomuistutuslaskut" value="jep" />

       <input type="submit" value="Luo muistutuslaskut" />

     </form>
<?php
require 'muistutuslasku.php';
       ?>


       <h3>Karhulaskut</h3>

       <form action="laskutus.php" method="post">

       <input type="hidden" name="luokarhulaskut" value="jep" />

        <input type="submit" value="Luo karhulaskut" />

      </form>

        <?php
        require 'karhulasku.php';

               ?>




              

             </body>
             </html>
