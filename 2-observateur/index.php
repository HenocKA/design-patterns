<?php

interface Sujet {
    public function enregistrerObservateur();
    public function supprimerObservateur();
    public function notifierObservateur();
}
interface Observateur {
    public function actualiser();
}

class DonneesMeteo implements Sujet {

    protected $observateurs;
    public function getTemperature(){

    }
    public function getHumidite(){

    }
    public function getPression(){

    }
    public function actualiserMesures(){
        $temp = $this->getTemperature();
        $humidite = $this->getHumidite();
        $pression = $this->getPression();

    }

    public function enregistrerObservateur()
    {
        // TODO: Implement enregistrerObservateur() method.
    }

    public function supprimerObservateur()
    {
        // TODO: Implement supprimerObservateur() method.
    }

    public function notifierObservateur()
    {
        // TODO: Implement notifierObservateur() method.
    }
}