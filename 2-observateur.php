<?php

interface Sujet {
    public function enregistrerObservateur(Observateur $ob);
    public function supprimerObservateur(Observateur $ob);
    public function notifierObservateurs();
}
interface Observateur {
    public function actualiser(Donnees $thp);
}
interface Affichage {
    public function afficher();
}
class Donnees{

    public $temperature;
    public $humidite;
    public $pression;

    public function __construct($temperature, $humidite, $pression)
    {
        $this->temperature = $temperature;
        $this->humidite = $humidite;
        $this->pression = $pression;
    }

}
class DonneesMeteo implements Sujet {

    protected $donnees;
    protected $observateurs = [];

    public function setMesures($temperature, $humidite, $pression){
        $this->donnees = new Donnees($temperature,$humidite,$pression);
        $this->actualiserMesures();
    }

    public function actualiserMesures(){
        $this->notifierObservateurs();
    }

    public function enregistrerObservateur(Observateur $ob)
    {
        $this->observateurs[] = $ob;
    }

    public function supprimerObservateur(Observateur $ob)
    {
        $this->observateurs = array_filter($this->observateurs, function ($observateur) use ($ob) {
            return $observateur !== $ob;
        });
    }

    public function notifierObservateurs()
    {
        foreach ($this->observateurs as $ob){
            $ob->actualiser($this->donnees);
        }
    }
}

class AffichageConditions implements Observateur, Affichage {
    protected $temperature;
    protected $humidite;

    public function actualiser(Donnees $thp)
    {
        $this->temperature = $thp->temperature;
        $this->humidite = $thp->humidite;
        $this->afficher();
    }

    public function afficher()
    {
        echo "Conditions actuelles : $this->temperature °C et $this->humidite % d'humidité";
    }
}
class AffichageStats implements Observateur, Affichage {

    public function actualiser(Donnees $thp)
    {
        // TODO: Implement actualiser() method.
    }

    public function afficher()
    {
        // TODO: Implement afficher() method.
    }
}
class AffichagePrevisions implements Observateur, Affichage {

    public function actualiser(Donnees $thp)
    {
        // TODO: Implement actualiser() method.
    }

    public function afficher()
    {
        // TODO: Implement afficher() method.
    }
}

$donneesMeteo = new DonneesMeteo;
$affichageConditions = new AffichageConditions();
$donneesMeteo->setMesures(26,65,1020);