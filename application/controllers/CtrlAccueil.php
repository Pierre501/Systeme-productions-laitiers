<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CtrlAccueil extends CI_Controller 
{

    public function index()
    {
        $this->load->helper('assets_helper');
        $this->load->model('Token');
        $this->Token->supprimerToken();
		$this->load->view('index');
    }

    public function pageInscription()
    {
        $this->load->helper('assets_helper');
		$this->load->view('inscription');
    }

    public function inscription()
    {
        $this->load->helper('assets_helper');
        $this->load->model('Utilisateur');
        $utilisateur = new Utilisateur();
        $utilisateur->setNomUtilisateur($this->input->post('nom'));
        $utilisateur->setPrenomUtilisateur($this->input->post('prenom'));
        $utilisateur->setDateDeNaissance($this->input->post('naissance'));
        $utilisateur->setUserNameUtilisateur($this->input->post('username'));
        $utilisateur->setMdpUtilisateur($this->input->post('mdp'));
        $utilisateur->setEtatCompte('Non valide');
        $this->Utilisateur->insertionUtilisateur($utilisateur);
        $this->load->view('inscription');
    }

    public function verifierLogin()
    {
        $this->load->helper('assets_helper');
        $this->load->model('Utilisateur');
        $data = array();
        $username = $this->input->post('username');
        $mdp = $this->input->post('mdp');
        $condition = $this->Utilisateur->verificationUtilisateur($username, $mdp);
        if($condition == 1)
        {
            $this->load->model('Token');
            $verifierToken = $this->Token->verifierToken($username, $mdp);
            if($verifierToken == 1)
            {
                $token = $this->Token->getSimpleToken($username, $mdp);
                $this->session->set_userdata('token', $token->getToken());
            }
            else
            {
                $utilisateur = $this->Utilisateur->getSimpleUtilisateur($username, $mdp);
                $this->Token->insertionToken($utilisateur->getIdUtilisateur(), $username);
                $token = $this->Token->getSimpleToken($username, $mdp);
                $this->session->set_userdata('token', $token->getToken());
            }
            $this->load->view('accueil', $data);
        }
        else
        {
            $data['message'] = "Oups! Veiullez réessayez s'il vous plait!";
            $this->load->view('index', $data);
        }
    }
}
?>