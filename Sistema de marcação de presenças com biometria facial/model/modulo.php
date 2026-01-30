<?php 
class Modulo {
    private $id_modulo;
    private $nome;
    private $id_formador;

    public function __construct($id_modulo = null, $nome = '', $id_formador = null) {
        $this->id_modulo = $id_modulo;
        $this->nome = $nome;
        $this->id_formador = $id_formador;
    }

    public function getId_modulo() { return $this->id_modulo; }
    public function getNome() { return $this->nome; }
    public function getId_formador() { return $this->id_formador; }

    public function setId_modulo($id) { $this->id_modulo = $id; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setId_formador($id_f) { $this->id_formador = $id_f; }
}?>