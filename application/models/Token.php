<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Token extends CI_Model
{
    private $idToken;
    private $idUtilisateur;
    private $token;
    private $dure;

    public function setIdToken($idToken)
    {
        $this->idToken = $idToken;
    }

    public function getIdToken()
    {
        return $this->idToken;
    }

    public function setIdUtilisateur($idUser)
    {
        $this->idUtilisateur = $idUser;
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setDure($dure)
    {
        $this->dure = $dure;
    }

    public function getDure()
    {
        return $this->dure;
    }

    public function verifierToken($username, $mdp)
    {
        $sql = "select count(*) as lignee from view_token where username_utilisateur = %s and mdp_utilisateur = %s";
        $sql = sprintf($sql, $this->db->escape($username), $this->db->escape(sha1($mdp)));
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $ligne = $rows['lignee'];
        return $ligne;
    }

    public function getDateTime()
    {
        $sql = "select now() as date";
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $date = $rows['date'];
        return $date;
    }

    public function insertionToken($idUtilisateur, $username)
    {
        $date = $this->getDateTime();
        $sql = "insert into token_utilisateur values(default, %d, %s, current_date)";
        $sql = sprintf($sql, $idUtilisateur, $this->db->escape(sha1($username.$date)));
        $this->db->query($sql);
    }

    public function supprimerToken()
    {
        $sql = "delete from token_utilisateur where dure < current_date";
        $this->db->query($sql);
    }

    public function getSimpleToken($username, $mdp)
    {
        $sql = "select * from view_token where username_utilisateur = %s and mdp_utilisateur = %s";
        $sql = sprintf($sql, $this->db->escape($username), $this->db->escape(sha1($mdp)));
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $token = new Token();
        $token->setIdToken($rows['id_token_utilisateur']);
        $token->setIdUtilisateur($rows['id_utilisateur']);
        $token->setToken($rows['token']);
        $token->setDure($rows['dure']);
        return $token;
    }

}
?>