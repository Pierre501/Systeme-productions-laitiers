<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class StockSortant extends CI_Model
{
    private $idStockSortant;
    private $idMatierePremiers;
    private $quantiteStockSortant;
    private $dateStockSortant;


    public function setIdStockSortant($id)
    {
        $this->idStockSortant = $id;
    }

    public function getIdStockSortant()
    {
        return $this->idStockSortant;
    }

    public function setIdMatierePremiers($id)
    {
        $this->idMatierePremiers = $id;
    }

    public function getIdMatierePremiers()
    {
        return $this->idMatierePremiers;
    }

    public function setQuantiteStockSortant($quantite)
    {
        $this->quantiteStockSortant = $quantite;
    }

    public function getQuantiteStockSortant()
    {
        return $this->quantiteStockSortant;
    }


    public function setDateStockSortant($date)
    {
        $this->dateStockSortant = $date;
    }

    public function getDateStockSortant()
    {
        return $this->dateStockSortant;
    }

    public function insertionStockSortant($stock)
    {
        $sql = "insert into stock_sortant values(default, %d, %d, %s)";
        $sql = sprintf($sql, $stock->getIdMatierePremiers(), $stock->getQuantiteStockSortant(), $this->db->escape($stock->getDateStockSortant()));
        $this->db->query($sql);
    }

    public function insertionStockSortante($id, $quantite)
    {
        $sql = "insert into stock_sortant values(default, %d, %d, current_date)";
        $sql = sprintf($sql, $id, $quantite);
        $this->db->query($sql);
    }
}
?>