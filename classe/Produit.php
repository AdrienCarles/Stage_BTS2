<?php 
 class Produit {

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
    private $lib_produit;
    private $type_produit;
    private $spec_produit;
    private $prix;
    private $diametre;

    /**
     * Setter
     */
    public function set_id_produit($id_produit)
    {
        $this->id_produit = $id_produit;
    }
    public function set_lib_produit($lib_produit)
    {
        $this->lib_produit = $lib_produit;
    }
    public function set_type_produit($type_produit)
    {
        $this->type_produit = $type_produit;
    }
    public function set_spec_produit($spec_produit)
    {
        $this->spec_produit = $spec_produit;
    }
    public function set_prix($prix)
    {
        $this->prix = $prix;
    }
    public function set_diametre($diametre)
    {
        $this->diametre = $diametre;
    }


    /**
    * Getter
    */
    public function get_id_produit()
    {
        return $this->id_produit;
    }
    public function get_lib_produit()
    {
        return $this->lib_produit;
    }
    public function get_type_produit()
    {
        return $this->type_produit;
    }
    public function get_spec_produit()
    {
        return $this->spec_produit;
    }
    public function get_prix()
    {
        return $this->prix;
    }
    public function get_diametre()
    {
        return $this->diametre;
    }
}