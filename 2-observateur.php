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

abstract class AffichageClass implements Affichage{

    protected $sujet;

    public function __construct(Sujet $sujet)
    {
        $this->sujet = $sujet;
        $this->sujet->enregistrerObservateur($this);
    }

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
            $ob->afficher();
        }
    }
}

class AffichageConditions extends AffichageClass implements Observateur {
    protected $temperature;
    protected $humidite;


    public function actualiser(Donnees $thp)
    {
        $this->temperature = $thp->temperature;
        $this->humidite = $thp->humidite;
    }

    public function afficher()
    {
        echo "Conditions actuelles : $this->temperature °C et $this->humidite % d'humidité\n";
    }
}
class AffichageStats  extends AffichageClass  implements Observateur {
    protected $min;
    protected $max;
    protected $moy ;

    public function actualiser(Donnees $thp)
    {
        $this->max = is_null($this->max) || $thp->temperature > $this->max ?
            $thp->temperature : $this->max;

        $this->min = is_null($this->min) || $thp->temperature < $this->min ?
            $thp->temperature : $this->min;

        $this->moy = ($this->max + $this->min) / 2;
    }

    public function afficher()
    {
        echo "Température Moy/Max/Min : $this->moy / $this->max / $this->min\n";
    }
}
class AffichagePrevisions extends AffichageClass implements Observateur {

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
$affichageConditions = new AffichageConditions($donneesMeteo);
$affichageStats = new AffichageStats($donneesMeteo);


$donneesMeteo->setMesures(26,65,1020);
$donneesMeteo->setMesures(28,70,1012);
$donneesMeteo->setMesures(22,90,1012);