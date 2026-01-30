<?php 
class Turma {
    private $id_turma;
    private $numero_turma;

    public function __construct($id_turma = null, $numero_turma = '') {
        $this->id_turma = $id_turma;
        $this->numero_turma = $numero_turma;
    }

    public function getId_turma() { return $this->id_turma; }
    public function getNumero_turma() { return $this->numero_turma; }

    public function setId_turma($id) { $this->id_turma = $id; }
    public function setNumero_turma($num) { $this->numero_turma = $num; }
}?>