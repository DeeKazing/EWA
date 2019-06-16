<?php
Class Lieferung{
    public $status;
    public $adresse;
    public $bestellungen;
    public $gesamtpreis;
    public $id;
    public function __construct($s,$a,$o,$t,$i){
      $this->status = $s;
      $this->adresse = $a;
      $this->bestellungen = $o;
      $this->gesamtpreis = $t;
      $this->id = $i;
    }
}
?>