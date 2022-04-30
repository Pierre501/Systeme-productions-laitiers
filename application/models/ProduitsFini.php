<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class ProduitsFini extends CI_Model
{
    private $idProduit;
    private $nomProduit;

    public function setIdProduit($id)
    {
        $this->idProduit = $id;
    }

    public function getIdProduit()
    {
        return $this->idProduit;
    }

    public function setNomProduit($nom)
    {
        $this->nomProduit = $nom;
    }

    public function getNomProduit()
    {
        return $this->nomProduit;
    }

    public function getAllProduitsFini()
    {
        $data = array();
        $sql = "select * from produits_fini";
        $query = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $produit = new ProduitsFini();
            $produit->setIdProduit($rows['id_produits']);
            $produit->setNomProduit($rows['nom_produits']);
            $data[] = $produit;
        }
        return $data;
    }

    public function getAllProduitsFiniDansLeStock()
    {
        $data = array();
        $sql = "select * from view_stock_restant_produits_fini_final";
        $query = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $produit = new ProduitsFini();
            $produit->setIdProduit($rows['id_produits']);
            $produit->setNomProduit($rows['nom_produits']);
            $data[] = $produit;
        }
        return $data;
    }

    public function getProduitsFiniByName($nomProduit)
    {
        $sql = "select * from produits_fini where nom_produits = %s";
        $sql = sprintf($sql, $this->db->escape($nomProduit));
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $produit = new ProduitsFini();
        $produit->setIdProduit($rows['id_produits']);
        $produit->setNomProduit($rows['nom_produits']);
        return $produit;
    }
}
?>