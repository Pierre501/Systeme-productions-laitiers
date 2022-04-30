<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class StockEntrant extends CI_Model
{
    private $idStockEntrant;
    private $idMatierePremiers;
    private $quantiteStockEntrant;
    private $dateStockEntrant;


    public function setIdStockEntrant($id)
    {
        $this->idStockEntrant = $id;
    }

    public function getIdStockEntrant()
    {
        return $this->idStockEntrant;
    }

    public function setIdMatierePremiers($id)
    {
        $this->idMatierePremiers = $id;
    }

    public function getIdMatierePremiers()
    {
        return $this->idMatierePremiers;
    }

    public function setQuantiteStockEntrant($quantite)
    {
        $this->quantiteStockEntrant = $quantite;
    }

    public function getQuantiteStockEntrant()
    {
        return $this->quantiteStockEntrant;
    }

    public function setDateStockEntrant($date)
    {
        $this->dateStockEntrant = $date;
    }

    public function getDateStockEntrant()
    {
        return $this->dateStockEntrant;
    }

    public function insertionStockEntrant($stock)
    {
        $sql = "insert into stock_entrant values(default, %d, %d, %s)";
        $sql = sprintf($sql, $stock->getIdMatierePremiers(), $stock->getQuantiteStockEntrant(), $this->db->escape($stock->getDateStockEntrant()));
        $this->db->query($sql);
    }
}
?>