<?php

interface ComportementVol
{
    public function voler();
}

class VolerAvecDesAiles implements ComportementVol{

    public function voler()
    {
        echo "Je vole avec des ailes\n";
    }
}
class PropulsionAReaction implements ComportementVol{

    public function voler()
    {
        echo "Je vole avec un réacteur\n";
    }
}
class NePasVoler implements ComportementVol{

    public function voler()
    {
        print "Je ne sais pas voler\n";
    }
}

interface ComportementCancan
{
    public function cancaner();
}

class Cancan implements ComportementCancan{
     public function cancaner()
     {
         echo "Cancan\n";
     }
}

class CancanMuet implements ComportementCancan{
     public function cancaner()
     {
         echo "Silence\n";
     }
}
class Coincoin implements ComportementCancan{
     public function cancaner()
     {
         echo "Coincoin\n";
     }
}

abstract class Canard
{
    protected  $comportementVol;
    protected  $comportementCancan;

    public function __construct()
    {
    }

    public abstract function afficher();

    public function effectuerCancan(){
        $this->comportementCancan->cancaner();
    }
    public function effectuerVol(){
        $this->comportementVol->voler();
    }

    public function setComportementVol(ComportementVol $cv)
    {
        $this->comportementVol = $cv;
    }

    public function setComportementCancan(ComportementCancan $cc)
    {
        $this->comportementCancan = $cc;
    }

    public function nager(){
        echo "Tous les canards flottent, même les leurres!\n";
    }

}


class PrototypeCanard extends Canard{
    public function __construct()
    {
        $this->comportementVol = new NePasVoler();
        $this->comportementCancan = new Cancan();
    }


    public function afficher()
    {
        echo "Je suis un prototype de canard\n";
    }
}

class Colvert extends Canard{
    public function __construct()
    {
        $this->comportementVol = new VolerAvecDesAiles();
        $this->comportementCancan = new Cancan();
    }


    public function afficher()
    {
        echo "Je suis un Colvert\n";
    }
}

$colvert = new Colvert();
$colvert->effectuerCancan();
$colvert->effectuerVol();

$proto = new PrototypeCanard();
$proto->effectuerVol();
$proto->setComportementVol(new PropulsionAReaction());
$proto->effectuerVol();

