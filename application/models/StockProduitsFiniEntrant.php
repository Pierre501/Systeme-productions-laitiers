<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class StockProduitsFiniEntrant extends CI_Model
{

    private $idStockProduitsFiniEntrant;
    private $idProduitsFini;
    private $quantiteStockProduitsFiniEntrant;
    private $dateStockProduitsFiniEntrant;

    public function setIdStockProduitsFiniEntrant($id)
    {
        $this->idStockProduitsFiniEntrant = $id;
    }

    public function getIdStockProduitsFiniEntrant()
    {
       return $this->idStockProduitsFiniEntrant;
    }

    public function setIdProduitsFini($id)
    {
        $this->idProduitsFini = $id;
    }

    public function getIdProduitsFini()
    {
        return $this->idProduitsFini;
    }

    public function setQuantiteStockProduitsFiniEntrant($quantite)
    {
        $this->quantiteStockProduitsFiniEntrant = $quantite;
    }

    public function getQuantiteStockProduitsFiniEntrant()
    {
        return $this->quantiteStockProduitsFiniEntrant;
    }

    public function setDateStockProduitsFiniEntrant($date)
    {
        $this->dateStockProduitsFiniEntrant = $date;
    }

    public function getDateStockProduitsFiniEntrant()
    {
        return $this->dateStockProduitsFiniEntrant;
    }

    public function insertionProduitsFini($id, $quantite)
    {
        $sql = "insert into stock_produit_fini_entrant values(default, %d, %d, current_date)";
        $sql = sprintf($sql, $id, $quantite);
        $this->db->query($sql);
    }
}

?>