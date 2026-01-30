<?php 
class Presenca {
    private $id_presenca;
    private $data_presenca;
    private $tipo;
    private $id_formando;

    public function __construct($id_presenca = null, $data = '', $tipo = '', $id_formando = null) {
        $this->id_presenca = $id_presenca;
        $this->data_presenca = $data;
        $this->tipo = $tipo;
        $this->id_formando = $id_formando;
    }

    public function getId_presenca() { return $this->id_presenca; }
    public function getData_presenca() { return $this->data_presenca; }
    public function getTipo() { return $this->tipo; }
    public function getId_formando() { return $this->id_formando; }

    public function setId_presenca($id) { $this->id_presenca = $id; }
    public function setData_presenca($data) { $this->data_presenca = $data; }
    public function setTipo($tipo) { $this->tipo = $tipo; }
    public function setId_formando($id_f) { $this->id_formando = $id_f; }
}?>