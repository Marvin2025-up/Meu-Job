<?php 
class Formando {
    private $id_formando;
    private $nome;
    private $genero;
    private $data_nascimento;
    private $email;
    private $telefone;
    private $estado;
    private $senha;
    private $id_formador;
    private $id_turma;
    private $id_biometria;

    public function __construct($id_formando = null, $nome = '',  $genero = '', $data_nascimento = '', $email = '', $telefone = null, $estado = '', $senha = '', $id_formador = null, $id_turma = null, $id_biometria = null) {
        $this->id_formando = $id_formando;
        $this->nome = $nome;
        
        $this->genero = $genero;
        $this->data_nascimento = $data_nascimento;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->estado = $estado;
        $this->senha = $senha;
        $this->id_formador = $id_formador;
        $this->id_turma = $id_turma;
        $this->id_biometria = $id_biometria;
    }

    // GETTERS
    public function getId_formando() { return $this->id_formando; }
    public function getNome() { return $this->nome; }
 
    public function getGenero() { return $this->genero; }
    public function getData_nascimento() { return $this->data_nascimento; }
    public function getEmail() { return $this->email; }
    public function getTelefone() { return $this->telefone; }
    public function getEstado() { return $this->estado; }
    public function getSenha() { return $this->senha; }
    public function getId_formador() { return $this->id_formador; }
    public function getId_turma() { return $this->id_turma; }
    public function getId_biometria() { return $this->id_biometria; }

    // SETTERS
    public function setId_formando($id_formando) { $this->id_formando = $id_formando; }
    public function setNome($nome) { $this->nome = $nome; }

    public function setGenero($genero) { $this->genero = $genero; }
    public function setData_nascimento($data_nascimento) { $this->data_nascimento = $data_nascimento; }
    public function setEmail($email) { $this->email = $email; }
    public function setTelefone($telefone) { $this->telefone = $telefone; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setSenha($senha) { $this->senha = $senha; }
    public function setId_formador($id_formador) { $this->id_formador = $id_formador; }
    public function setId_turma($id_turma) { $this->id_turma = $id_turma; }
    public function setId_biometria($id_biometria) { $this->id_biometria = $id_biometria; }
}
?>
