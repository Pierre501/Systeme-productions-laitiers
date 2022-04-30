<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CtrlAdministrateur extends CI_Controller 
{

    public function pageAdministrateur()
    {
        $this->load->helper('assets_helper');
		$this->load->view('admin');
    }

    public function verifierAdministrateur()
    {
        $this->load->helper('assets_helper');
        $this->load->model('Administrateur');
        $data = array();
        $condition = $this->Administrateur->verifierAdministrateur($this->input->post('username'), $this->input->post('mdp'));
        if($condition == 1)
        {
            $this->load->model('Utilisateur');
            $data['tabUtilisateur'] = $this->Utilisateur->getAllUtilisateurNonValider();
            $this->load->view('accueilAdmin', $data);
        }
        else
        {
            $data['message'] = "Oups! Veiullez réessayez s'il vous plait!";
            $this->load->view('admin', $data);
        }
    }

    public function envoyerMail()
    {
        $this->load->helper('assets_helper');
        $this->load->model('Utilisateur');
        $this->Utilisateur->modifierUtilisateur($this->input->post('id'));
        $this->Utilisateur->envoyerMailUtilisateur($this->input->post('id'));
        $data = array();
        $data['tabUtilisateur'] = $this->Utilisateur->getAllUtilisateurNonValider();
		$this->load->view('accueilAdmin', $data);
    }
}

?>