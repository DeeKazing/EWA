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
      <div id="wrapper">

        <header>
            <img src="Bilder/logo.png" alt="logo">
            <nav>
                <ul>
                    <li><a href="bestellung.php">Bestellungen</a></li>
                    <li><a class="active" href="baecker.php">B�cker</a></li>
                    <li><a href="Kunde.php">Kunde</a></li>
                    <li><a href="Fahrer.php">Fahrer</a></li>
                </ul>
            </nav>
        </header>


      <section>
            <h1>Bestellte Pizzen</h1>
            <form action="https://echo.fbi.h-da.de/">
              <h2>Margherita</h2>
              <div class="radio">
                <fieldset>
                  <input type="radio" id="b" name="Status" value="bestellt">
                  <label for="b"> Bestellt</label>
                  <input type="radio" id="io" name="Status" value="im ofen">
                  <label for="io"> Im Ofen</label>
                  <input checked type="radio" id="f" name="Status" value="fertig">
                  <label for="f"> Fertig</label>
                </fieldset>
                <input class="submit" type="submit" value="Bestellen" tabindex="7">
              </div>
            </form>
        </section>
        <footer>Fusszeile</footer>
    </div>
  </body>
</html>