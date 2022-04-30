<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Formule extends CI_Model
{
    private $idFormule;
    private $nomFormule;
    private $idMatierePremiers;
    private $nomMatiersPremiers;
    private $pourcentage;
    private $pourcentageAvecQuantite;


    public function setIdFormule($id)
    {
        $this->idFormule = $id;
    }

    public function getIdFormule()
    {
        return $this->idFormule;
    }

    public function setNomFormule($formule)
    {
        $this->nomFormule = $formule;
    }

    public function getNomFormule()
    {
        return $this->nomFormule;
    }

    public function setIdMatierePremiers($id)
    {
        $this->idMatierePremiers = $id;
    }

    public function getIdMatierePremiers()
    {
        return $this->idMatierePremiers;
    }

    public function setNomMatierePremiers($matierePremiers)
    {
        $this->nomMatiersPremiers = $matierePremiers;
    }

    public function getNomMatierePremiers()
    {
        return $this->nomMatiersPremiers;
    }

    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;
    }

    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    public function setPourcentageAvecQuantite($quantite)
    {
        $this->pourcentageAvecQuantite = $quantite;
    }

    public function getPourcentageAvecQuantite()
    {
        return $this->pourcentageAvecQuantite;
    }


    public function calculePourcentage($quantite, $nombre)
    {
        $pourcentages = $quantite * $nombre / 100;
        return $pourcentages;
    }

    public function calculeProduitsFiniMinimale($quantite, $pourcentage)
    {
        $produitsFiniMinimal = $quantite * 100 / $pourcentage;
        return $produitsFiniMinimal;
    }

    public function eliminerDoublantNomMatieresPremiers($tabMatieresPremiers, $nomMatiersPremiers)
    {
        $data = array();
        foreach($tabMatieresPremiers as $matierePremiers)
        {
            if($matierePremiers->getNomMatierePremiers() != $nomMatiersPremiers)
            {
                $data[] = $matierePremiers->getNomMatierePremiers() ;
            }
        }
        return $data;
    }

    public function insertionFormule($idProduits, $nomFormule)
    {
        $sql = "insert into formule values(default, %d, %s)";
        $sql = sprintf($sql, $idProduits, $this->db->escape($nomFormule));
        $this->db->query($sql);
    }

    public function modificationComposantFormule($nomFormule, $nomMatiersPremiers, $nouveauMatiersPremiers, $pourcentage)
    {
        $this->load->model('MatierePremiers');
        $matierePremiers = $this->MatierePremiers->getMatierePremiersByName($nomMatiersPremiers);
        $formule = $this->getFormulesByName($nomFormule);
        $sql = "select * from details_formule where id_formule = %d and id_matiere_premiers = %d";
        $sql = sprintf($sql, $formule->getIdFormule(), $matierePremiers->getIdMatierePremiers());
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $idDetailsFormule = $rows['id_details_formule'];
        $matierePremiers2 = $this->MatierePremiers->getMatierePremiersByName($nouveauMatiersPremiers);
        $sql2 = "update details_formule set id_matiere_premiers = %d, pourcentage = %d where id_details_formule = %d";
        $sql2 = sprintf($sql2, $matierePremiers2->getIdMatierePremiers(), $pourcentage, $idDetailsFormule);
        $this->db->query($sql2);
    }

    public function suppressionFormule($nomFormule, $idMatierePremiers)
    {
        $formule = $this->getFormulesByName($nomFormule);
        $sql = "delete from details_formule where id_formule = %d and id_matiere_premiers = %d";
        $sql = sprintf($sql, $formule->getIdFormule(), $idMatierePremiers);
        $this->db->query($sql);
    }

    public function insertionDetailsFormule($nomFormule, $idMatierePremiers, $pourcentage)
    {
        $formule = $this->getFormulesByName($nomFormule);
        $sql = "insert into details_formule values(default, %d, %d, %d)";
        $sql = sprintf($sql, $formule->getIdFormule(), $idMatierePremiers, $pourcentage);
        $this->db->query($sql);
    }

    public function getFormulesByName($nomFormule)
    {
        $sql = "select * from formule where nom_formule = %s";
        $sql = sprintf($sql, $this->db->escape($nomFormule));
        $query  = $this->db->query($sql);
        $rows = $query->row_array();
        $formule = new Formule();
        $formule->setIdFormule($rows['id_formule']);
        $formule->setNomFormule($rows['nom_formule']);
        return $formule;
    }

    public function getAllFormules()
    {
        $data = array();
        $sql = "select * from formule";
        $query  = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $formule = new Formule();
            $formule->setIdFormule($rows['id_formule']);
            $formule->setNomFormule($rows['nom_formule']);
            $data[] = $formule;
        }
        return $data;
    }

    public function getDetailsFormuleByName($nomFormule)
    {
        $data = array();
        $sql = "select * from view_formule where nom_formule = %s";
        $sql = sprintf($sql, $this->db->escape($nomFormule));
        $query = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $formule = new Formule();
            $formule->setNomFormule($rows['nom_formule']);
            $formule->setIdMatierePremiers($rows['id_matiere_premiers']);
            $formule->setNomMatierePremiers($rows['nom_matiere_premiers']);
            $formule->setPourcentage($rows['pourcentage']);
            $data[] = $formule;
        }
        return $data;
    }


    public function getFormuleByName($nomProduit)
    {
        $data = array();
        $sql = "select * from view_formule where nom_produits = %s";
        $sql = sprintf($sql, $this->db->escape($nomProduit));
        $query = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $formule = new Formule();
            $formule->setNomFormule($rows['nom_formule']);
            $formule->setIdMatierePremiers($rows['id_matiere_premiers']);
            $formule->setNomMatierePremiers($rows['nom_matiere_premiers']);
            $formule->setPourcentage($rows['pourcentage']);
            $data[] = $formule;
        }
        return $data;
    }

    public function getSimpleFormule($nomFormule, $idMatierePremiers)
    {
        $sql = "select * from view_formule where nom_formule = %s and id_matiere_premiers = %d";
        $sql = sprintf($sql, $this->db->escape($nomFormule), $idMatierePremiers);
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $formule = new Formule();
        $formule->setNomFormule($rows['nom_formule']);
        $formule->setIdMatierePremiers($rows['id_matiere_premiers']);
        $formule->setNomMatierePremiers($rows['nom_matiere_premiers']);
        $formule->setPourcentage($rows['pourcentage']);
        return $formule;
    }

    public function getFormuleByQuantite($quantite, $nomProduit)
    {
        $data = array();
        $tabFormule = $this->getFormuleByName($nomProduit);
        foreach($tabFormule as $formule)
        {
            $formule->setPourcentageAvecQuantite($this->calculePourcentage($quantite, $formule->getPourcentage()));
            $data[] = $formule;
        }
        return $data;
    }

    public function verifierQuantite($quantite, $nomProduit)
    {
        $this->load->model('StockRestant');
        $verifier = false;
        $compteur = 0;
        $tabFormule = $this->getFormuleByQuantite($quantite, $nomProduit);
        foreach($tabFormule as $formule)
        {
            $stockRestant = $this->StockRestant->getStockRestantByName($formule->getNomMatierePremiers());
            if($formule->getPourcentageAvecQuantite() <= $stockRestant->getQuantiteStockRestant())
            {
                $compteur++;
            }
        }
        if($compteur == count($tabFormule))
        {
            $verifier = true;
        }
        return $verifier;
    }

    public function getMatierePremiersInsuffisant($quantite, $nomProduit)
    {
        $data = array();
        $this->load->model('StockRestant');
        $tabFormule = $this->getFormuleByQuantite($quantite, $nomProduit);
        foreach($tabFormule as $formule)
        {
            $stockRestant = $this->StockRestant->getStockRestantByName($formule->getNomMatierePremiers());
            if($formule->getPourcentageAvecQuantite() > $stockRestant->getQuantiteStockRestant())
            {
                $data[] = $this->StockRestant->getStockRestantByName($formule->getNomMatierePremiers());
            }
        }
        return $data;
    }

    public function trierNombre($tableau)
    {
        for($i = 0; $i < count($tableau); $i++)
        {
            for($j = $i+1; $j < count($tableau); $j++)
            {
                if($tableau[$j] < $tableau[$i])
                {
                    $temp = $tableau[$i];
                    $tableau[$i] = $tableau[$j];
                    $tableau[$j] = $temp;
                }
            }
        }
        $nombreMinimal = $tableau[0];
        return $nombreMinimal;
    }

    public function fabrication($quantite, $nomProduit)
    {
        $quantiteProposeFinale = 0;
        $verifierStockRestant = $this->verifierQuantite($quantite, $nomProduit);
        if($verifierStockRestant == true)
        {
            $this->load->model('StockSortant');
            $this->load->model('StockProduitsFiniEntrant');
            $this->load->model('ProduitsFini');
            $tabFormule = $this->getFormuleByQuantite($quantite, $nomProduit);
            foreach($tabFormule as $formule)
            {
                $this->StockSortant->insertionStockSortante($formule->getIdMatierePremiers(), $formule->getPourcentageAvecQuantite());
            }
            $produitsFini = $this->ProduitsFini->getProduitsFiniByName($nomProduit);
            $this->StockProduitsFiniEntrant->insertionProduitsFini($produitsFini->getIdProduit(), $quantite);
        }
        else
        {
            $this->load->model('StockRestant');
            $data = array();
            $tabStockRestant = $this->StockRestant->getAllStockRestantByName($nomProduit);
            foreach($tabStockRestant as $stockRestant)
            {
                $quantitePropose = $this->calculeProduitsFiniMinimale($stockRestant->getQuantiteStockRestant(), $stockRestant->getPourcentage());
                $data[] = $quantitePropose;
            }
            $quantiteProposeFinale = $this->trierNombre($data);
        }
        return $quantiteProposeFinale;
    }
}
?>


