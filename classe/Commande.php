<?php 
 class Commande {

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
    private $id_commande;
    private $num_commande;
    private $date_commande;
    private $total_comande;
    private $mode_paiement;
    private $nom_commande;
    private $prenom_commande;
    private $classe_commande;
    private $tel_commande;
    private $mail_commande;
    private $id_user;
    private $id_statut ;

    /**
     * Setter
     */
    public function set_id_commande($id_commande)
    {
        $this->id_commande = $id_commande;
    }
    public function set_num_commande($num_commande)
    {
        $this->num_commande = $num_commande;
    }
    public function set_date_commande($date_commande)
    {
        $this->date_commande = $date_commande;
    }
    public function set_total_comande($total_comande)
    {
        $this->total_comande = $total_comande;
    }
    public function set_mode_paiement($mode_paiement)
    {
        $this->mode_paiement = $mode_paiement;
    }
    public function set_nom_commande($nom_commande)
    {
        $this->nom_commande = $nom_commande;
    }
    public function set_prenom_commande($prenom_commande)
    {
        $this->prenom_commande = $prenom_commande;
    }
    public function set_classe_commande($classe_commande)
    {
        $this->classe_commande = $classe_commande;
    }
    public function set_tel_commande($tel_commande)
    {
        $this->tel_commande = $tel_commande;
    }
    public function set_mail_commande($mail_commande)
    {
        $this->mail_commande = $mail_commande;
    }
    public function set_id_user($id_user)
    {
        $this->id_user = $id_user;
    }
    public function set_id_statut ($id_statut )
    {
        $this->id_statut  = $id_statut ;
    }


    /**
    * Getter
    */
    public function get_id_commande()
    {
        return $this->id_commande;
    }
    public function get_num_commande()
    {
        return $this->num_commande;
    }
    public function get_date_commande()
    {
        return $this->date_commande;
    }
    public function get_total_comande()
    {
        return $this->total_comande;
    }
    public function get_mode_paiement()
    {
        return $this->mode_paiement;
    }
    public function get_nom_commande()
    {
        return $this->nom_commande;
    }
    public function get_prenom_commande()
    {
        return $this->prenom_commande;
    }
    public function get_classe_commande()
    {
        return $this->classe_commande;
    }
    public function get_tel_commande()
    {
        return $this->tel_commande;
    }
    public function get_mail_commande()
    {
        return $this->mail_commande;
    }
    public function get_id_user()
    {
        return $this->id_user;
    }
    public function get_id_statut ()
    {
        return $this->id_statut ;
    }

}