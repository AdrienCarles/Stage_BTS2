<?php 
 class Produit_image_commande {

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
    private $id_produit;
    private $id_famille;
    private $id_image;
    private $id_commande;
    private $quantite;
    private $message;
    
    /**
     * Setter
     */
    public function set_id_produit($id_produit)
    {
        $this->id_produit = $id_produit;
    }
    public function set_id_famille($id_famille)
    {
        $this->id_famille = $id_famille;
    }
    public function set_id_image ($id_image)
    {
        $this->id_image = $id_image;
    }
    public function set_id_commande($id_commande)
    {
        $this->id_commande = $id_commande;
    }
    public function set_quantite($quantite)
    {
        $this->quantite = $quantite;
    }
    public function set_message($message)
    {
        $this->message = $message;
    }

    /**
    * Getter
    */
    public function get_id_produit()
    {
        return $this->id_produit;
    }
    public function get_id_famille()
    {
        return $this->id_famille;
    }
    public function get_id_image()
    {
        return $this->id_image;
    }
    public function get_id_commande()
    {
        return $this->id_commande;
    }
    public function get_quantite()
    {
        return $this->quantite;
    }
    public function get_message()
    {
        return $this->message;
    }
}
