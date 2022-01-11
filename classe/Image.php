<?php 
 class Image {

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
    private $id_image;
    private $id_famille;

    /**
     * Setter
     */
    public function set_id_image($id_image)
    {
        $this->id_image = $id_image;
    }
    public function set_id_famille($id_famille)
    {
        $this->id_famille = $id_famille;
    }

    /**
    * Getter
    */
    public function get_id_image()
    {
        return $this->id_image;
    }
    public function get_id_famille()
    {
        return $this->id_famille;
    }
}
