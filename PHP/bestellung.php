<!DOCTYPE html>
<html lang="de">  
<head>
    <meta charset="UTF-8" />
    <!-- für später: CSS include -->
    <!-- <link rel="stylesheet" href="XXX.css"/> -->
    <!-- für später: JavaScript include -->
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
                    <li><a class="active" href= "bestellung.php">Bestellungen</a></li>
                    <li><a href="baecker.php">Bäcker</a></li>
                    <li><a href="Kunde.php">Kunde</a></li>
                    <li><a href="Fahrer.php">Fahrer</a></li>
                </ul>
            </nav>
        </header>

        <section>
            <h1>Bestellung</h1>
            <h1>Speisekarte</h1>
            <img src="Bilder/pizza.png" width="90" height="90" alt="pizza"><br>
            <p>Margherita</p>
            <p>4.00€</p>
            <img src="Bilder/pizza.png" width="90" height="90" alt="pizza"><br>
            <p>Salami</p>
            <p>4.50€</p>
            <img src="Bilder/pizza.png" width="90" height="90" alt="pizza"><br>
            <p>Hawaii</p>
            <p>5.50€</p>
            <h3>Warenkorb</h3>
            <form action="https://echo.fbi.h-da.de/">
                <label>
                  <select name="Bestellung[]" size="6" tabindex="1" multiple>
                    <option value="Salami">Salami</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="Salami" selected>Salami</option>
                  </select>
                </label>

            <!--<div style="height:120px;width:120px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow: scroll;">
                Salami <br> Hawaii <br> Salami <br>
            </div> -->
            <p>14.50€</p>
            <input type="submit" value="Auswahl Löschen" tabindex="2">
                <input type="submit" value="Alle Löschen" tabindex="3">
                <input type="text" name="Name" value="" placeholder="Name" tabindex="4">
                <input type="text" name="Adresse" value="" placeholder="Adresse" tabindex="5">
                <input type="text" name="PLZ" value="" placeholder="PLZ" pattern="\b\d{5}\b" tabindex="6">
                <input type="submit" value="Bestellen" tabindex="7">
        </form>

        </section>

        <footer>Fusszeile</footer>

    </div>
</body>
</html>