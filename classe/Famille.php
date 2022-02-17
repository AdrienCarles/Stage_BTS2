<?php 
 class Famille {

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
    private $id_famille;
    private $lib_famille;
    
    /**
     * Setter
     */
    public function set_id_famille($id_famille)
    {
        $this->id_famille = $id_famille;
    }
    public function set_lib_famille($lib_famille)
    {
        $this->lib_famille = $lib_famille;
    }
    public function set_promo_famille($promo_famille)
    {
        $this->promo_famille = $promo_famille;
    }

    /**
    * Getter
    */
    public function get_id_famille()
    {
        return $this->id_famille;
    }
    public function get_lib_famille()
    {
        return $this->lib_famille;
    }
    public function get_promo_famille()
    {
        return $this->promo_famille;
    }
}
