<?php 
class Admin {
    private $id_admin;
    private $email;
    private $senha;

    public function __construct( $id_admin = null, $email= '', $senha= ''){
            $this->id_admin = $id_admin;
            $this->email = $email;
            $this->senha = $senha;
        }

        public function getId_admin(){ return $this->id_admin; }
        public function getEmail(){ return $this->email; }
        public function getSenha(){ return $this->senha; }

        public function setId_admin($id_admin){ $this->id_admin = $id_admin; }
        public function setEmail($email){ $this->email = $email; }
        public function setSenha($senha){ $this->senha = $senha; }
    }
?>