<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class StockRestant extends CI_Model
{
    private $nomMatierePremiers;
    private $sueilMinimum;
    private $quantiteStockRestant;
    private $dateStockRestant;
    private $pourcentage;

    public function setNomMatierePremiers($nom)
    {
        $this->nomMatierePremiers = $nom;
    }

    public function getNomMatierePremiers()
    {
        return $this->nomMatierePremiers;
    }

    public function setSueilMinimum($sueil)
    {
        $this->sueilMinimum = $sueil;
    }

    public function getSueilMinimum()
    {
        return $this->sueilMinimum;
    }

    public function setQuantiteStockRestant($quantite)
    {
        $this->quantiteStockRestant = $quantite;
    }

    public function getQuantiteStockRestant()
    {
        return $this->quantiteStockRestant;
    }

    public function setDateStockRestant($date)
    {
        $this->dateStockRestant = $date;
    }

    public function getDateStockRestant()
    {
        return $this->dateStockRestant;
    }

    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;
    }

    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    public function getAllStockRestant()
    {
        $data = array();
        $sql = "select * from view_stock_restant_finale order by somme_quantite_stock_restant desc";
        $query = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $stock = new StockRestant();
            $stock->setNomMatierePremiers($rows['nom_matiere_premiers']);
            $stock->setSueilMinimum($rows['sueil_mininum']);
            $stock->setQuantiteStockRestant($rows['somme_quantite_stock_restant']);
            $stock->setDateStockRestant($rows['date_stock']);
            $data[] = $stock;
        }
        return $data;
    }

    public function getAllStockRestantByName($nomProduit)
    {
        $data = array();
        $sql = "select * from view_quantite_minimale where nom_produits = %s";
        $sql = sprintf($sql, $this->db->escape($nomProduit));
        $query = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $stock = new StockRestant();
            $stock->setNomMatierePremiers($rows['nom_matiere_premiers']);
            $stock->setSueilMinimum($rows['sueil_mininum']);
            $stock->setQuantiteStockRestant($rows['somme_quantite_stock_restant']);
            $stock->setDateStockRestant($rows['date_stock']);
            $stock->setPourcentage($rows['pourcentage']);
            $data[] = $stock;
        }
        return $data;
    }

    public function getStockRestantByName($nomMatierePremiers)
    {
        $sql = "select * from view_stock_restant_finale where nom_matiere_premiers = %s";
        $sql = sprintf($sql, $this->db->escape($nomMatierePremiers));
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $stock = new StockRestant();
        $stock->setNomMatierePremiers($rows['nom_matiere_premiers']);
        $stock->setSueilMinimum($rows['sueil_mininum']);
        $stock->setQuantiteStockRestant($rows['somme_quantite_stock_restant']);
        $stock->setDateStockRestant($rows['date_stock']);
        return $stock;
    }


}
?>