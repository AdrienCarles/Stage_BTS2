<?php 
 class Statut {

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
    private $id_statut;
    private $lib_statut;
    
    /**
     * Setter
     */
    public function set_id_statut($id_statut)
    {
        $this->id_statut = $id_statut;
    }
    public function set_lib_statut($lib_statut)
    {
        $this->lib_statut = $lib_statut;
    }

    /**
    * Getter
    */
    public function get_id_statut()
    {
        return $this->id_statut;
    }
    public function get_lib_statut()
    {
        return $this->lib_statut;
    }
}
