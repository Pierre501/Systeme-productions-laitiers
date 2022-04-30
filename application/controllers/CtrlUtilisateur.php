<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Base_Controller.php');

class CtrlUtilisateur extends Base_Controller 
{

    public function __construct()
    {
		parent::__construct();

	}

    public function pageRetour()
    {
        $this->load->helper('assets_helper');
        $this->load->view('accueil');
    }

    public function stock()
    {
        $this->load->helper('assets_helper');
        $this->load->model('StockRestant');
        $this->load->model('MatierePremiers');
        $data = array();
        $data['tabStockRestant'] = $this->StockRestant->getAllStockRestant();
        $data['listeAchat'] = $this->MatierePremiers->getListeAchatAFaire();
        $this->load->view('stock', $data);
    }

    public function achat()
    {
        $this->load->helper('assets_helper');
        $this->load->model('MatierePremiers');
        $data = array();
        $data['tabMatierePremiers'] = $this->MatierePremiers->getAllMatierePremiers();
		$this->load->view('achat', $data);
    }

    public function valideAchat()
    {
        $this->load->helper('assets_helper');
        $this->load->model('MatierePremiers');
        $this->load->model('StockEntrant');
        $stock = new StockEntrant();
        $stock->setIdMatierePremiers($this->input->post('id'));
        $stock->setQuantiteStockEntrant($this->input->post('quantite'));
        $stock->setDateStockEntrant($this->input->post('date'));
        $this->StockEntrant->insertionStockEntrant($stock);
        $data = array();
        $data['tabMatierePremiers'] = $this->MatierePremiers->getAllMatierePremiers();
		$this->load->view('achat', $data);
    }

    public function deconnexion()
    {
        $this->load->helper('assets_helper');
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
?>