<?php 
class BiometriaFacial {
    private $id_biometria;
    private $codificacao_facial;
    private $data_captura;

    public function __construct($id_biometria = null, $codificacao = null, $data_captura = null) {
        $this->id_biometria = $id_biometria;
        $this->codificacao_facial = $codificacao;
        $this->data_captura = $data_captura;
    }

    public function getId_biometria() { return $this->id_biometria; }
    public function getCodificacao_facial() { return $this->codificacao_facial; }
    public function getData_captura() { return $this->data_captura; }

    public function setId_biometria($id) { $this->id_biometria = $id; }
    public function setCodificacao_facial($cod) { $this->codificacao_facial = $cod; }
    public function setData_captura($data) { $this->data_captura = $data; }
}?>