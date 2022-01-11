<?php 
 class Utilisateur {

    /**
     * Constructeur
     */
    public function __construct(array $tableau = null)
    {
        if ($tableau != null) {
            $this->fill($tableau);
        }
    }

    /**
     * Hydrateur
     * Alimente les propriétés à partir d'un tableau
     */
    public function fill(array $tableau)
    {
        foreach ($tableau as $cle => $valeur) {
            $methode = 'set_' . $cle;
            if (method_exists($this, $methode)) {
                $this->$methode($valeur);
            }
        }
    }

    /**
     * Propriétées
     */
    private $id_user;
    private $nom_user;
    private $prenom_user;
    private $mdp_user;
    private $classe_user;
    private $tel_user;
    private $mail_user;
    private $id_role ;

    /**
     * Setter
     */
    public function set_id_user($id_user)
    {
        $this->id_user = $id_user;
    }
    public function set_nom_user($nom_user)
    {
        $this->nom_user = $nom_user;
    }
    public function set_prenom_user($prenom_user)
    {
        $this->prenom_user = $prenom_user;
    }
    public function set_mdp_user($mdp_user)
    {
        $this->mdp_user = $mdp_user;
    }
    public function set_classe_user($classe_user)
    {
        $this->classe_user = $classe_user;
    }
    public function set_tel_user($tel_user)
    {
        $this->tel_user = $tel_user;
    }
    public function set_mail_user($mail_user)
    {
        $this->mail_user = $mail_user;
    }
    public function set_id_role($id_role)
    {
        $this->id_role = $id_role;
    }

    /**
    * Getter
    */
    public function get_id_user()
    {
        return $this->id_user;
    }
    public function get_nom_user()
    {
        return $this->nom_user;
    }
    public function get_prenom_user()
    {
        return $this->prenom_user;
    }
    public function get_mdp_user()
    {
        return $this->mdp_user;
    }
    public function get_classe_user()
    {
        return $this->classe_user;
    }
    public function get_tel_user()
    {
        return $this->tel_user;
    }
    public function get_mail_user()
    {
        return $this->mail_user;
    }
    public function get_id_role()
    {
        return $this->id_role;
    }
}
