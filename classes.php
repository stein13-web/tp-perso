<?php
class Arme{
    public $nom;
    public $degats;

    public function __construct(string $nom, int $degats){
        $this->nom=$nom;
        $this->degats=$degats;
    }
}

class Perso{
    public $image;
    public $force;
    public $pvmax;
    public $pv;
    public $arme;
    public $armure;
    public $nbPotions;
    

    public function __construct(Arme $arme, int $force=10, int $pvmax=200, int $nbPotions=0, String $image="default"){
        $this->force = $force;
        $this->pvmax = $pvmax;
        $this->pv = $pvmax;
        $this->arme = $arme;
        $this->armure = new Armure("",0);
        $this->nbPotions=$nbPotions;
        $this->image=$image;
    }

    public function attaque(Perso $cible):int{
        $degats = rand($this->force,$this->arme->degats) - $cible->armure->niveau;
        if ($degats <5){
            $degats = 5;
        }
        $cible->pv -= $degats;
        return $degats;
    }

    public function utiliserPotion():int{
        $potion = ceil($this->pvmax/10);
        $this->pv += $potion;
        $this->nbPotions = $this->nbPotions - 1;
        return $potion;
    }

    public function changerArme(Arme $nouvelleArme){
        $this->arme = $nouvelleArme;
    }

    public function changerArmure(Armure $nouvelleArmure){
        $this->armure = $nouvelleArmure;
    }
}

class Armure{
    public $nom;
    public $niveau;

    public function __construct(string $nom, int $niveau){
        $this->nom = $nom;
        $this->niveau=$niveau;
    }
}

class Sayajin extends Perso{
    public $transforme=false;

    public function ssj1(){
        $this->transformation();
    }

    public function ssj2(){
        $this->transformation();
        $this->force*=1.5;
    }

    public function ssj3(){
        $this->transformation();
        $this->force*=2;
    }

    private function transformation(){
        $this->transforme=true;
    }

    public function attaque(Perso $cible):int{
        $degats = parent::attaque($cible);        
        if($this->transforme){
            $degats+=parent::attaque($cible);
        }
        return $degats;
    }
}

class Action{
    public $perso;
    public $type;
    public $texte;
    public function __construct(Perso $perso, String $type, String $texte){
        $this->perso=$perso;
        $this->type=$type;
        $this->texte=$texte;
    }
}