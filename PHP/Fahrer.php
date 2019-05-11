<!DOCTYPE html>
<html lang="de">  
<head>
    <meta charset="UTF-8" />
    <!-- f¸r sp‰ter: CSS include -->
    <!-- <link rel="stylesheet" href="XXX.css"/> -->
    <!-- f¸r sp‰ter: JavaScript include -->
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
                    <li><a href="baecker.php">B‰cker</a></li>
                    <li><a href="Kunde.php">Kunde</a></li>
                    <li><a class="active" href="Fahrer.php">Fahrer</a></li>
                </ul>
            </nav>
        </header>


      <section>
        <h1>Auslieferbare Bestellung</h1>          
            <form action="https://echo.fbi.h-da.de/">
              <h2>Adresse: Jaman-straﬂe.5, 64423, Gibtsnicht</h2>
              <h2>Margerita, Salami, Tonno</h2>
              <p>14,30Ä</p> 
              <div class="radio">
                <fieldset>
                  <input type="radio" id="f" name="Status" value="fertig">
                  <label for="f"> Fertig</label>
                  <input type="radio" id="u" name="Status" value="unterwegs">
                  <label for="u"> Unterwegs</label>
                  <input checked type="radio" id="g" name="Status" value="geliefert">
                  <label for="g">Geliefert</label>
                </fieldset>
                <input class="submit" type="submit" value="Bestellen" tabindex="7">
              </div>
            </form>
      </section>
      <footer>Fusszeile</footer>
    </div>
  </body>
</html>