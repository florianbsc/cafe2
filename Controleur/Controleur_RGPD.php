<?php

use App\Modele\Modele_Catalogue;
use App\Modele\Modele_Commande;
use App\Modele\Modele_Utilisateur;
use App\Vue\Vue_Menu_Administration;
use App\Vue\Vue_Menu_Entreprise_Salarie;
use App\Vue\Vue_Produits_Info_Clients;
use App\Vue\Vue_Structure_Entete;

switch ($action) {

    case "AccepterRGPD" :
        Modele_Utilisateur::Utilisateur_Modifier_AccepterRGPD($_SESSION["idUtilisateur"] , 1);
        switch ($_SESSION["idCategorie_utilisateur"]) {

            case 2:
                $Vue->setEntete(new Vue_Structure_Entete());
                $Vue->setMenu(new Vue_Menu_Administration());

                break;

            case 4:

                $Vue->setEntete(new Vue_Structure_Entete());
                $quantiteMenu = Modele_Commande::Panier_Quantite($_SESSION["idEntreprise"]);
                $Vue->setMenu(new Vue_Menu_Entreprise_Salarie($quantiteMenu));

                $listeProduit = Modele_Catalogue::Produits_Select_Libelle_Categ("client");
                $Vue->addToCorps(new Vue_Produits_Info_Clients($listeProduit));


                break;
        }
        break;
    case "RefuserRGPD" :

        break;
    default :
    case "AfficherRGPD" :
        $Vue->addToCorps(new \App\Vue\Vue_ConsentementRGPD());

        break;

}