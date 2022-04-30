<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class MatierePremiers extends CI_Model
{
    private $idMatierePremiers;
    private $nomMatierePremiers;
    private $sueilMinimum;

    public function setIdMatierePremiers($id)
    {
        $this->idMatierePremiers = $id;
    }

    public function getIdMatierePremiers()
    {
        return $this->idMatierePremiers;
    }

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

    public function getMatierePremiersByid($id)
    {
        $sql = "select * from matiere_premiers where id_matiere_premiers = %d";
        $sql = sprintf($sql, $id);
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $matiere = new MatierePremiers();
        $matiere->setIdMatierePremiers($rows['id_matiere_premiers']);
        $matiere->setNomMatierePremiers($rows['nom_matiere_premiers']);
        $matiere->setSueilMinimum($rows['sueil_mininum']);
        return $matiere;
    }

    public function getMatierePremiersByName($nom)
    {
        $sql = "select * from matiere_premiers where nom_matiere_premiers = %s";
        $sql = sprintf($sql, $this->db->escape($nom));
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $matiere = new MatierePremiers();
        $matiere->setIdMatierePremiers($rows['id_matiere_premiers']);
        $matiere->setNomMatierePremiers($rows['nom_matiere_premiers']);
        $matiere->setSueilMinimum($rows['sueil_mininum']);
        return $matiere;
    }

    public function getAllMatierePremiers()
    {
        $data = array();
        $sql = "select * from matiere_premiers";
        $query = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $matiere = new MatierePremiers();
            $matiere->setIdMatierePremiers($rows['id_matiere_premiers']);
            $matiere->setNomMatierePremiers($rows['nom_matiere_premiers']);
            $matiere->setSueilMinimum($rows['sueil_mininum']);
            $data[] = $matiere;
        }
        return $data;
    }

    public function getListeAchatAFaire()
    {
        $data = array();
        $this->load->model('StockRestant');
        $stockRestant = new StockRestant();
        $tabStockRestant = $stockRestant->getAllStockRestant();
        foreach($tabStockRestant as $stock)
        {
            if($stock->getQuantiteStockRestant() < $stock->getSueilMinimum())
            {
                $data[] = $this->getMatierePremiersByName($stock->getNomMatierePremiers());
            }
        }
        return $data;
    }
}
?>