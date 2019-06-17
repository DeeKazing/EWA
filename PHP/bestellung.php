<?php	// UTF-8 marker äöüÄÖÜß€
/**
 * Class PageTemplate for the exercises of the EWA lecture
 * Demonstrates use of PHP including class and OO.
 * Implements Zend coding standards.
 * Generate documentation with Doxygen or phpdoc
 * 
 * PHP Version 5
 *
 * @category File
 * @package  Pizzaservice
 * @author   Bernhard Kreling, <b.kreling@fbi.h-da.de> 
 * @author   Ralf Hahn, <ralf.hahn@h-da.de> 
 * @license  http://www.h-da.de  none 
 * @Release  1.2 
 * @link     http://www.fbi.h-da.de 
 */

// to do: change name 'Bestellung' throughout this file
require_once './Page.php';
require_once './angebot.php';
/**
 * This is a template for top level classes, which represent 
 * a complete web page and which are called directly by the user.
 * Usually there will only be a single instance of such a class. 
 * The name of the template is supposed
 * to be replaced by the name of the specific HTML page e.g. baker.
 * The order of methods might correspond to the order of thinking 
 * during implementation.
 
 * @author   Bernhard Kreling, <b.kreling@fbi.h-da.de> 
 * @author   Ralf Hahn, <ralf.hahn@h-da.de> 
 */
class Bestellung extends Page
{
    // to do: declare reference variables for members 
    // representing substructures/blocks

    
    /**
     * Instantiates members (to be defined above).   
     * Calls the constructor of the parent i.e. page class.
     * So the database connection is established.
     *
     * @return none
     */
    protected function __construct() 
    {
        parent::__construct();
        // to do: instantiate members representing substructures/blocks
    }
    
    /**
     * Cleans up what ever is needed.   
     * Calls the destructor of the parent i.e. page class.
     * So the database connection is closed.
     *
     * @return none
     */
    protected function __destruct() 
    {
        parent::__destruct();
    }

    /**
     * Fetch all data that is necessary for later output.
     * Data is stored in an easily accessible way e.g. as associative array.
     *
     * @return none
     */
    protected function getViewData()
    {
        $angebotitems = $this->_database->query("SELECT * FROM angebot");
        if(!$angebotitems)
            throw new Exception("Query failed:" .$_database->error);
        $ergebnis = [];
        while($item = $angebotitems->fetch_assoc()){
           /* $pizzaname = $item["PizzaName"];
            $pfad = $item["Bilddatei"];
            $preis = $item["Preis"];
            $this->ergebnis[] = new Angebot($pizzaname, $pfad, $preis);*/
            array_push($ergebnis, new Angebot($item['PizzaName'], $item['Bilddatei'], $item['Preis']));
        }
        return $ergebnis;
    }


    
    /**
     * First the necessary data is fetched and then the HTML is 
     * assembled for output. i.e. the header is generated, the content
     * of the page ("view") is inserted and -if avaialable- the content of 
     * all views contained is generated.
     * Finally the footer is added.
     *
     * @return none
     */
    protected function generateView() 
    {
        $ergebnis = $this->getViewData();
        $this->generatePageHeader('Bestellung');
        // to do: call generateView() for all members
       /*foreach($this->ergebnis as $item) {
           //echo var_dump($item);
           echo<<<EOT
        <div>i
        <p>$item->pfad</p>
        <p>$item->pizzaname</p>
        <p>$item->preis</p>
        </div>
EOT;
       };
       */
echo <<<EOT
    <div id ="wrapper">
    <header>
        <img id="logo" src="../Bilder/logo.png" alt="logo">
        <nav id="navbar">
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
EOT;

foreach($ergebnis as $item) {
    $toPass = htmlspecialchars(json_encode($item));
echo <<<EOT

        <div class="item">
            <div class="text">$item->pizzaname</div>
            <div class="price">$$item->preis €</div>            
            <div class="thumb"><img src="$item->pfad" width="100" alt="$item->pizzaname" onclick="addToBasket(this, '$toPass')"></div>
        </div>
EOT;
};

echo <<<code

<h1>Warenkorb</h1>
<form action="bestellung.php" method="post" onsubmit="return isValidForm()">
    <label>
      <select name="Bestellung[]" id="wk" size="6" tabindex="1" multiple>
      </select>
    </label>

<div class="total" id="sumField">Gesamtpreis: 0€</div>
    <input type="button" value="Auswahl Löschen" onclick="removeFromBasket()" tabindex="2">
    <input type="button" value="Alle Löschen" onclick="emptyBasket()" tabindex="3">
    <input type="text" name="Name" value="" id="name" placeholder="Name" tabindex="4">
    <input type="text" name="Adresse" value="" id="adr" placeholder="Adresse" tabindex="5">
    <input type="text" name="PLZ" value="" id="plz" placeholder="PLZ" pattern="\b\d{5}\b" tabindex="6">
    <input type="submit" disabled="disabled" value="Bestellen" onclick="submitOrder()" id="send" tabindex="7">
</form>

</section>
code;
        $this->generatePageFooter();
    }
    
    /**
     * Processes the data that comes via GET or POST i.e. CGI.
     * If this page is supposed to do something with submitted
     * data do it here. 
     * If the page contains blocks, delegate processing of the 
	 * respective subsets of data to them.
     *
     * @return none 
     */
    protected function processReceivedData() 
    {
        parent::processReceivedData();
        // to do: call processReceivedData() for all members
        if (sizeof($_POST) > 0) {
            if (!isset($_POST['Name']) || !isset($_POST['PLZ']) || !isset($_POST['Adresse']) || (sizeof($_POST['Bestellung']) < 0)) {
              return;
            }
            try {
              $sql = "INSERT INTO `Bestellung` (BestellungID, Adresse, Bestellzeitpunkt) VALUES (NULL, ? , CURRENT_TIMESTAMP)";
              if ($stmt = $this->_database->prepare($sql)) {
                $adr = $this->_database->real_escape_string(htmlspecialchars($_POST['Name'] . " " . $_POST['Adresse'] . " " . $_POST['PLZ']));
                $stmt->bind_param("s", $adr);
                $stmt->execute();
                $oid = $this->_database->insert_id;
                $_SESSION['oid'] = $oid;
              } else {
                echo "something broke.:/<br>";
              }
              $stmt->close();
              $sql = "";
              foreach (($_POST['Bestellung']) as $item) {
                $item = $this->_database->real_escape_string($item);
                $sql = "INSERT INTO `bestelltepizza` (fBestellungID, fPizzaNummer) SELECT $oid, PizzaNummer FROM `angebot` WHERE angebot.PizzaName = '$item'; ";
                $this->_database->query($sql);
                //echo ($sql . "\n");
              }
              header('Location: kunde.php');
            } catch (\Exception $e) {
              throw $e;
            }
          }
    }

    /**
     * This main-function has the only purpose to create an instance 
     * of the class and to get all the things going.
     * I.e. the operations of the class are called to produce
     * the output of the HTML-file.
     * The name "main" is no keyword for php. It is just used to
     * indicate that function as the central starting point.
     * To make it simpler this is a static function. That is you can simply
     * call it without first creating an instance of the class.
     *
     * @return none 
     */    
    public static function main() 
    {
        try {
            session_start();
            $page = new Bestellung();
            $page->processReceivedData();
            $page->generateView();
        }
        catch (Exception $e) {
            header("Content-type: text/plain; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

// This call is starting the creation of the page. 
// That is input is processed and output is created.
Bestellung::main();

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends). 
// Not specifying the closing ? >  helps to prevent accidents 
// like additional whitespace which will cause session 
// initialization to fail ("headers already sent"). 
//? >