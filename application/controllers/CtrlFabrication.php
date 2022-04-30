<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('Base_Controller.php');

class CtrlFabrication extends Base_Controller
{

    public function __construct()
    {
		parent::__construct();

	}

    public function pageFabrication()
    {
        $this->load->helper('assets_helper');
        $this->load->model('ProduitsFini');
        $data = array();
        $data['tabProduitsFini'] = $this->ProduitsFini->getAllProduitsFini();
		$this->load->view('fabrication', $data);
    }

    public function pageCrud()
    {
        $this->load->helper('assets_helper');
        $this->load->model('Formule');
        $data = array();
        $data['tabFormule'] = $this->Formule->getAllFormules();
        $this->load->view('crud', $data);
    }

    public function pageModifiantFormule()
    {
        $this->load->helper('assets_helper');
        $this->load->model('MatierePremiers');
        $this->load->model('Formule');
        $idMatierePremiers = $this->input->get('id');
        $nomFormule = $this->input->get('formule');
        $nomMatierePremier = $this->input->get('nomMatieres');
        $data = array();
        $tabMatierePremiers = $this->MatierePremiers->getAllMatierePremiers();
        $data['nomFormule'] = $nomFormule;
        $data['formule'] = $this->Formule->getSimpleFormule($nomFormule, $idMatierePremiers);
        $data['tabNomMatieresPremiers'] = $this->Formule->eliminerDoublantNomMatieresPremiers($tabMatierePremiers, $nomMatierePremier);
        $this->load->view('modifer', $data);
    }

    public function pageAjoutantFormule()
    {
        $this->load->helper('assets_helper');
        $this->load->model('ProduitsFini');
        $data = array();
        $data['tabProduitsFini'] = $this->ProduitsFini->getAllProduitsFini();
        $this->load->view('formule', $data);
    }

    public function modificationComposant()
    {
        $this->load->helper('assets_helper');
        $this->load->model('MatierePremiers');
        $this->load->model('Formule');
        $nomFormule = $this->input->post('nomFormule');
        $nouveauNom = $this->input->post('nouveauNom');
        $encienNom = $this->input->post('encienNom');
        $pourcentage = $this->input->post('pourcentage');
        $this->Formule->modificationComposantFormule($nomFormule, $encienNom, $nouveauNom, $pourcentage);
        $data = array();
        $data['nomFormule'] = $nomFormule;
        $data['tabFormule'] = $this->Formule->getAllFormules();
        $data['tabNomMatierePremiers'] = $this->MatierePremiers->getAllMatierePremiers();
        $data['tabMatieresPremiers'] = $this->Formule->getDetailsFormuleByName($nomFormule);
        $this->load->view('crud', $data);
    }

    public function suppressionComposant()
    {
        $this->load->helper('assets_helper');
        $this->load->model('Formule');
        $this->load->model('MatierePremiers');
        $idMatierePremiers = $this->input->get('id');
        $nomFormule = $this->input->get('formule');
        $this->Formule->suppressionFormule($nomFormule, $idMatierePremiers);
        $data = array();
        $data['nomFormule'] = $nomFormule;
        $data['tabFormule'] = $this->Formule->getAllFormules();
        $data['tabNomMatierePremiers'] = $this->MatierePremiers->getAllMatierePremiers();
        $data['tabMatieresPremiers'] = $this->Formule->getDetailsFormuleByName($nomFormule);
        $this->load->view('crud', $data);

    }

    public function ajoutantFormule()
    {
        $this->load->helper('assets_helper');
        $this->load->model('ProduitsFini');
        $this->load->model('Formule');
        $idProduits = $this->input->post('produits');
        $nomFormule = $this->input->post('nomFormule');
        $this->Formule->insertionFormule($idProduits, $nomFormule);
        $data = array();
        $data['tabProduitsFini'] = $this->ProduitsFini->getAllProduitsFini();
        $this->load->view('formule', $data);
    }

    public function detailsFormule()
    {
        $this->load->helper('assets_helper');
        $this->load->model('Formule');
        $this->load->model('MatierePremiers');
        $nomFormule = $this->input->post('formule');
        $data = array();
        $data['nomFormule'] = $nomFormule;
        $data['tabFormule'] = $this->Formule->getAllFormules();
        $data['tabNomMatierePremiers'] = $this->MatierePremiers->getAllMatierePremiers();
        $data['tabMatieresPremiers'] = $this->Formule->getDetailsFormuleByName($nomFormule);
        $this->load->view('crud', $data);
    }

    public function insertionDetailsFormule()
    {
        $this->load->helper('assets_helper');
        $this->load->model('Formule');
        $this->load->model('MatierePremiers');
        $nomFormule = $this->input->post('formule');
        $idMatierePremiers = $this->input->post('matiere');
        $pourcentage = $this->input->post('pourcentage');
        $data = array();
        $this->Formule->insertionDetailsFormule($nomFormule, $idMatierePremiers, $pourcentage);
        $data['nomFormule'] = $nomFormule;
        $data['tabFormule'] = $this->Formule->getAllFormules();
        $data['tabNomMatierePremiers'] = $this->MatierePremiers->getAllMatierePremiers();
        $data['tabMatieresPremiers'] = $this->Formule->getDetailsFormuleByName($nomFormule);
        $this->load->view('crud', $data);
    }

    public function fabricationProduitsFini()
    {
        $this->load->helper('assets_helper');
        $this->load->model('ProduitsFini');
        $this->load->model('Formule');
        $nomProduitsFini = $this->input->post('produits');
        $quantite = $this->input->post('quantite');
        $data = array();
        $exception = $this->Formule->fabrication($quantite, $nomProduitsFini);
        if(!empty($exception))
        {
            $data['exception'] = $exception;
            $data['produits'] = $nomProduitsFini;
        }
        $data['tabProduitsFini'] = $this->ProduitsFini->getAllProduitsFini();
		$this->load->view('fabrication', $data);
    }

    public function stockProduitsFini()
    {
        $this->load->helper('assets_helper');
        $this->load->model('StockRestantProduitsFini');
        $data = array();
        $data['tabStockRestant'] = $this->StockRestantProduitsFini->getAllStockRestantProduitsFini();
        $this->load->view('stockProduitsFini', $data);
    }
}
?>