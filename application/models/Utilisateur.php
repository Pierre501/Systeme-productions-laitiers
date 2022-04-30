<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur extends CI_Model
{
    private $id_utilisateur;
    private $nom_utilisateur;
    private $prenom_utilisateur;
    private $date_de_naissance;
    private $username_utilisateur;
    private $mdp_utilisateur;
    private $etat_compte;

    public function setIdUtilisateur($id)
    {
        $this->id_utilisateur = $id;
    }

    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    public function setNomUtilisateur($nom)
    {
        $this->nom_utilisateur = $nom;
    }

    public function getNomUtilisateur()
    {
        return $this->nom_utilisateur;
    }

    public function setPrenomUtilisateur($prenom)
    {
        $this->prenom_utilisateur = $prenom;
    }

    public function getPrenomUtilisateur()
    {
        return $this->prenom_utilisateur;
    }

    public function setDateDeNaissance($date)
    {
        $this->date_de_naissance = $date;
    }

    public function getDateDeNaissance()
    {
        return $this->date_de_naissance;
    }

    public function setUserNameUtilisateur($username)
    {
        $this->username_utilisateur = $username;
    }

    public function getUserNameUtilisateur()
    {
        return $this->username_utilisateur;
    }

    public function setMdpUtilisateur($mdp)
    {
        $this->mdp_utilisateur = $mdp;
    }

    public function getMdpUtilisateur()
    {
        return $this->mdp_utilisateur;
    }

    public function setEtatCompte($etat)
    {
        $this->etat_compte = $etat;
    }

    public function getEtatCompte()
    {
        return $this->etat_compte;
    }

    public function verificationUtilisateur($username, $motDePasse)
    {
        $sql = "select count(*) as lignee from utilisateur where username_utilisateur = %s and mdp_utilisateur = %s and etat_compte = 'Valide'";
        $sql = sprintf($sql, $this->db->escape($username), $this->db->escape(sha1($motDePasse)));
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $ligne = $rows['lignee'];
        return $ligne;
    }

    public function insertionUtilisateur($user)
    {
        $sql = "insert into utilisateur values(default, %s, %s, %s, %s, %s, %s)";
        $sql = sprintf($sql, $this->db->escape($user->getNomUtilisateur()), $this->db->escape($user->getPrenomUtilisateur()), $this->db->escape($user->getDateDeNaissance()), $this->db->escape($user->getUserNameUtilisateur()), $this->db->escape(sha1($user->getMdpUtilisateur())), $this->db->escape($user->getEtatCompte()));
        $this->db->query($sql);
    }

    public function getSimpleUtilisateurById($id)
    {
        $user = new Utilisateur();
        $sql = "select * from utilisateur where id_utilisateur = %d";
        $sql = sprintf($sql, $id);
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $user->setIdUtilisateur($rows['id_utilisateur']);
        $user->setNomUtilisateur($rows['nom_utilisateur']);
        $user->setPrenomUtilisateur($rows['prenom_utilisateur']);
        $user->setDateDeNaissance($rows['date_de_naissance']);
        $user->setUserNameUtilisateur($rows['username_utilisateur']);
        $user->setMdpUtilisateur($rows['mdp_utilisateur']);
        $user->setEtatCompte($rows['etat_compte']);
        return $user;
    }

    public function getSimpleUtilisateur($username, $mdp)
    {
        $user = new Utilisateur();
        $sql = "select * from utilisateur where username_utilisateur = %s and mdp_utilisateur = %s";
        $sql = sprintf($sql, $this->db->escape($username), $this->db->escape(sha1($mdp)));
        $query = $this->db->query($sql);
        $rows = $query->row_array();
        $user->setIdUtilisateur($rows['id_utilisateur']);
        $user->setNomUtilisateur($rows['nom_utilisateur']);
        $user->setPrenomUtilisateur($rows['prenom_utilisateur']);
        $user->setDateDeNaissance($rows['date_de_naissance']);
        $user->setUserNameUtilisateur($rows['username_utilisateur']);
        $user->setMdpUtilisateur($rows['mdp_utilisateur']);
        $user->setEtatCompte($rows['etat_compte']);
        return $user;
    }

    public function getAllUtilisateurValide()
    {
        $data = array();
        $sql = "select * from utilisateur";
        $query = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $user = new Utilisateur();
            $user->setIdUtilisateur($rows['id_utilisateur']);
            $user->setNomUtilisateur($rows['nom_utilisateur']);
            $user->setPrenomUtilisateur($rows['prenom_utilisateur']);
            $user->setDateDeNaissance($rows['date_de_naissance']);
            $user->setUserNameUtilisateur($rows['username_utilisateur']);
            $user->setMdpUtilisateur($rows['mdp_utilisateur']);
            $user->setEtatCompte($rows['etat_compte']);
            $data[] = $user;
        }
        return $data;
    }

    public function getAllUtilisateurNonValider()
    {
        $data = array();
        $sql = "select * from utilisateur where etat_compte = 'Non valide'";
        $query = $this->db->query($sql);
        foreach($query->result_array() as $rows)
        {
            $user = new Utilisateur();
            $user->setIdUtilisateur($rows['id_utilisateur']);
            $user->setNomUtilisateur($rows['nom_utilisateur']);
            $user->setPrenomUtilisateur($rows['prenom_utilisateur']);
            $user->setDateDeNaissance($rows['date_de_naissance']);
            $user->setUserNameUtilisateur($rows['username_utilisateur']);
            $user->setMdpUtilisateur($rows['mdp_utilisateur']);
            $user->setEtatCompte($rows['etat_compte']);
            $data[] = $user;
        }
        return $data;
    }

    public function modifierUtilisateur($id)
    {
        $sql = "update utilisateur set etat_compte = 'Valide' where id_utilisateur = %d";
        $sql = sprintf($sql, $id);
        $this->db->query($sql);
    }

    public function envoyerMailUtilisateur($id)
    {
        date_default_timezone_set('utc');
        $utilisateur = $this->getSimpleUtilisateurById($id);
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.googlemail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'tolotraitu@gmail.com';
        $config['smtp_pass'] = 'qwertyuioP1234!';
        $config['smtp_crypto'] = 'ssl';
        $config['mailtype'] = 'html';
        $config['starttls'] = true;
        $config['newline'] = "\r\n";
        $this->email->initialize($config);
        $this->email->from('tolotraitu@gmail.com', 'Administrateur');
        $this->email->to($utilisateur->getUserNameUtilisateur());
        $this->email->subject('Validation compte');
        $this->email->message('Vôtre compte est validé, vous pouvez connecter maintenant');
        $this->email->send();
    }
}
?>

