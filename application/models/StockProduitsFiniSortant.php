<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class StockProduitsFiniSortant extends CI_Model
{

    private $idProduits;
    private $nomProduits;
    private $quantiteSortant;
    private $dateStock;

    public function setIdProduit($id)
    {
        $this->idProduits = $id;
    }

    public function getIdProduit()
    {
        return $this->idProduits;
    }

    public function setNomProduit($nom)
    {
        $this->nomProduits = $nom;
    }

    public function getNomProduit()
    {
        return $this->nomProduits;
    }

    public function setQuantiteSortant($quantite)
    {
        $this->quantiteSortant = $quantite;
    }

    public function getQuantiteSortant()
    {
        return $this->quantiteSortant;
    }

    public function setDateStock($date)
    {
        $this->dateStock = $date;
    }

    public function getDateStock()
    {
        return $this->dateStock;
    }

    public function insertionStockProduitsFiniSortant($id, $quantite)
    {
        $sql = "insert into stock_produit_fini_sortant values(default, %d, %d, current_date)";
        $sql = sprintf($sql, $id, $quantite);
        $this->db->query($sql);
    }

    public function getAllStockProduitsFiniSortant()
    {
        $data = array();
        $sql = "select * from view_stock_sortant_produits_finiv2";
        $query = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $stock = new StockProduitsFiniSortant();
            $stock->setIdProduit($rows['id_produits']);
            $stock->setNomProduit($rows['nom_produits']);
            $stock->setQuantiteSortant($rows['quantite_stock_produit_fini_sortant']);
            $stock->setDateStock($rows['date_stock_produit_fini_sortant']);
            $data[] = $stock;
        }
        return $data;
    }
}
?>