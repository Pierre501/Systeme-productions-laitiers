<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class StockRestantProduitsFini extends CI_Model
{
    private $idProduits;
    private $nomProduits;
    private $quantiteRestant;
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

    public function setQuantiteRestant($quantite)
    {
        $this->quantiteRestant = $quantite;
    }

    public function getQuantiteRestant()
    {
        return $this->quantiteRestant;
    }

    public function setDateStock($date)
    {
        $this->dateStock = $date;
    }

    public function getDateStock()
    {
        return $this->dateStock;
    }

    public function getAllStockRestantProduitsFini()
    {
        $data = array();
        $sql = "select * from view_stock_restant_produits_fini_final";
        $query = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $stock = new StockRestantProduitsFini();
            $stock->setIdProduit($rows['id_produits']);
            $stock->setNomProduit($rows['nom_produits']);
            $stock->setQuantiteRestant($rows['somme_quantite_stock_produit_fini_restant']);
            $stock->setDateStock($rows['date_stock']);
            $data[] = $stock;
        }
        return $data;
    }
}
?>