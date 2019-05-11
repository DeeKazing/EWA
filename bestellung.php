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
    public $ergebnis = [];

    
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
       // $ergebnis=[];
        while($item = $angebotitems->fetch_assoc()){
            //echo $item["PizzaName"];
            $pizzaname = $item["PizzaName"];
            $pfad = $item["Bilddatei"];
            $preis = $item["Preis"];
            $this->ergebnis[] = new Angebot($pizzaname, $pfad, $preis);
        }
        $angebotitems->free();
    //return $ergebnis;
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
        $this->getViewData();
        $this->generatePageHeader('Bestellung');
        // to do: call generateView() for all members
       /*foreach($this->ergebnis as $item) {
           //echo var_dump($item);
           echo<<<EOT
        <div>
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
EOT;

foreach($this->ergebnis as $item) {
echo <<<EOT
        <div>
        <p>$item->pfad</p>
        <p>$item->pizzaname</p>
        <p>$item->preis</p>
        </div>
EOT;
};
        foreach ($items as $item){
            $opizzaname = htmlspecialchars($item->pizzaname, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $opfad = htmlspecialchars($item->pfad);
            $opreis = htmlspecialchars($item->preis);
        
echo <<<code
<h3>Warenkorb</h3>
            <div class="item">
                <div class="text">$opizzaname</div>
                <div class="thumb"></div>
                <div class="price">$opreis €</div>
            </div>
code;
        }

echo <<<code

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