<?php 
class Formador {
    private $id_formador;
    private $nome;
    private $genero;
    private $data_nascimento;
    private $email;
    private $telefone;
    private $senha;

    public function __construct($id_formador = null, $nome = '', $genero = '', $data_nascimento = '', $email = '', $telefone = null, $senha = '') {
        $this->id_formador = $id_formador;
        $this->nome = $nome;
        $this->genero = $genero;
        $this->data_nascimento = $data_nascimento;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->senha = $senha;
    }

    // Getters
    public function getId_formador() { return $this->id_formador; }
    public function getNome() { return $this->nome; }
    public function getGenero() { return $this->genero; }
    public function getData_nascimento() { return $this->data_nascimento; }
    public function getEmail() { return $this->email; }
    public function getTelefone() { return $this->telefone; }
    public function getSenha() { return $this->senha; }

    // Setters
    public function setId_formador($id) { $this->id_formador = $id; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setGenero($genero) { $this->genero = $genero; }
    public function setData_nascimento($data) { $this->data_nascimento = $data; }
    public function setEmail($email) { $this->email = $email; }
    public function setTelefone($tel) { $this->telefone = $tel; }
    public function setSenha($senha) { $this->senha = $senha; }
}
?>