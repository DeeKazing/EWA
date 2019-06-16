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
require_once './Lieferung.php';

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
class Baecker extends Page
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
        $orders = $this->_database->query("SELECT Adresse, Status, BestellungID, SUM(Preis) AS Total FROM `bestellung`, `angebot`,`bestelltepizza` WHERE fBestellungID = BestellungID AND fPizzanummer = PizzaNummer GROUP BY BestellungID");
        if (!$orders)
            throw new Exception("Query failed:" . $this->_database->error());
        $result=[];
        while($item = $orders->fetch_assoc()){
          $prp = (string) $item['BestellungID'];
          $orderitems = $this->_database->query("SELECT PizzaName FROM `bestelltepizza`, `angebot` WHERE fBestellungID = $prp AND fPizzanummer = PizzaNummer");
          if (!$orderitems)
              throw new Exception("Query failed:" .$_database->error());
          $items=[];
          while($x = $orderitems->fetch_assoc()){
            array_push($items, $x['PizzaName']);
          }
          array_push($result,new Lieferung($item['Status'],$item['Adresse'],$items, $item['Total'], $item['BestellungID']));
        }
        return $result;
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
        $items = $this->getViewData();
        $this->generatePageHeader('Baecker');
        // to do: call generateView() for all members
echo <<<feri
<div id="wrapper">
<header>
    <img src="../Bilder/logo.png" alt="logo">
    <nav>
        <ul>
            <li><a href="bestellung.php">Bestellungen</a></li>
            <li><a class="active" href="baecker.php">Bäcker</a></li>
            <li><a href="Kunde.php">Kunde</a></li>
            <li><a href="Fahrer.php">Fahrer</a></li>
        </ul>
    </nav>
</header>
<section>
feri;
$i = 0;
foreach($items as $item){
    $i++;
    $ostatus = htmlspecialchars($item->status, ENT_QUOTES | ENT_HTML5 | ENT_DISALLOWED | ENT_SUBSTITUTE, 'UTF-8');
    $oadress = htmlspecialchars($item->adresse);
    $oitems = "";
    $oid = $item->id;
    $checked1 = "";
    $checked2 = "";
    $checked3 = "";
    switch ($item->status) {
      case 'Bestellt':
        $checked1 = "checked";
        break;
      case 'Im Ofen':
        $checked2 = "checked";
        break;
      case 'Fertig':
        $checked3 = "checked";
        break;
      default:
        continue 2;
    }
    $ototal = htmlspecialchars($item->gesamtpreis);
    foreach ($item->bestellungen as $x){
      $oitems .= $x ." ";
    }
    //var_dump($item);
    echo <<<form
    <div class="todo">
      <form action="./baecker.php" method="post" id = "formid$i">
                  <div class="items">$oitems</div>
                  <div class="ordernum">Order# : $oid</div>
                  <div class="radio">
                    <fieldset>
                      <input $checked1 type="radio" id="b$i" name="Status" value="Bestellt" onclick="document.forms['formid$i'].submit();">
                      <label for="b$i"> Bestellt</label>
                      <input $checked2 type="radio" id="io$i" name="Status" value="Im Ofen" onclick="document.forms['formid$i'].submit();">
                      <label for="io$i"> Im Ofen</label>
                      <input $checked3 type="radio" name="Status" id="f$i" value="Fertig" onclick="document.forms['formid$i'].submit();">
                      <label for="f$i"> Fertig</label>
                      <input type="hidden" name="OID" value="$oid" />
                    </fieldset>
                  </div>
              </form>
            </div>
form;
echo("</section>");
}


   /* <h1>Bestellte Pizzen</h1>
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
*/
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
        
        if (sizeof($_POST) > 0){
            if(!isset($_POST['Status']) || !isset($_POST['OID'])){
              echo("Invalid Input");
              return;
            }
            if($_POST['Status'] != "Bestellt" && $_POST['Status'] != "Im Ofen" && $_POST['Status'] != "Fertig" || !is_numeric($_POST['OID'])){
              throw new Exception(var_dump($_POST));
              return;
              echo("Invalid Input");
            }
            try {
                $sql = "UPDATE `bestellung` SET Status = ? WHERE BestellungID = ? ;";
                if($stmt = $this->_database->prepare($sql)){
                  $stmt->bind_param("ss", $_POST['Status'], $_POST['OID']);
                  $stmt->execute();
                }else{
                  echo "something broke.:/<br>";
                }
                $stmt->close();
                header('Location: baecker.php');
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
            $page = new Baecker();
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
Baecker::main();
// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends). 
// Not specifying the closing ? >  helps to prevent accidents 
// like additional whitespace which will cause session 
// initialization to fail ("headers already sent"). 
//? >