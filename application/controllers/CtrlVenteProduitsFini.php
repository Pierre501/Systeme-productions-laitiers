<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Base_Controller.php');

class CtrlVenteProduitsFini extends Base_Controller 
{

    public function __construct()
    {
		parent::__construct();

	}
    
    public function pageVente()
    {
        $this->load->helper('assets_helper');
        $this->load->model('ProduitsFini');
        $this->load->model('StockProduitsFiniSortant');
        $data = array();
        $data['tabProduitsFini'] = $this->ProduitsFini->getAllProduitsFiniDansLeStock();
        $data['tabStockSortant'] = $this->StockProduitsFiniSortant->getAllStockProduitsFiniSortant();
		$this->load->view('venteProduitsFini', $data);
    }

    public function venteProduitsFini()
    {
        $this->load->helper('assets_helper');
        $this->load->model('ProduitsFini');
        $this->load->model('StockProduitsFiniSortant');
        $idProduitsFini = $this->input->post('produits');
        $quantite = $this->input->post('quantite');
        $this->StockProduitsFiniSortant->insertionStockProduitsFiniSortant($idProduitsFini, $quantite);
        $data = array();
        $data['tabProduitsFini'] = $this->ProduitsFini->getAllProduitsFiniDansLeStock();
        $data['tabStockSortant'] = $this->StockProduitsFiniSortant->getAllStockProduitsFiniSortant();
		$this->load->view('venteProduitsFini', $data);
    }
}
?>