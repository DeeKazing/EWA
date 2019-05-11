<!DOCTYPE html>
<html lang="de">  
<head>
    <meta charset="UTF-8" />
    <!-- f�r sp�ter: CSS include -->
    <!-- <link rel="stylesheet" href="XXX.css"/> -->
    <!-- f�r sp�ter: JavaScript include -->
    <!-- <script src="XXX.js"></script> -->
    <title>Text des Titels</title>
    <!-- <link rel="stylesheet" href="style.css" type="Text/css"> -->
    <link rel="stylesheet" href="style.css" type="Text/css">
</head>


<body>
        <div id ="wrapper">

        <header>
            <img src="Bilder/logo.png" alt="logo">
            <nav>
                <ul>
                    <li><a  href="bestellung.php">Bestellungen</a></li>
                    <li><a href="baecker.php">B�cker</a></li>
                    <li><a class="active" href="Kunde.php">Kunde</a></li>
                    <li><a  href="Fahrer.php">Fahrer</a></li>
                </ul>
            </nav>
        </header>


        <section>
        <h1>Lieferstatus</h1>
          <div class="order">
              <div class="Item">Margherita: Bestellt</div>
          </div>
          <div class="order">
              <div class="Item">Salami: In Ofen</div>
          </div>
          <div class="order">
              <div class="Item">Tonno:</div>
              <div class="Status">Fertig</div>
          </div>
          <div class="order">
              <div class="Item">Hawaii:</div>
              <div class="Status">bestellt</div>
          </div>
          <button>Neue Bestellung</button>
    </section>
    <footer>Fusszeile</footer>
</div>
</body>
</html>