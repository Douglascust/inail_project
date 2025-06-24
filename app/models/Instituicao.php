<?php

class Instituicao{
    
    private $idinstituicao;
    private $endereco;
    private $nome;
    private $razaosocial;
    private $cpfcnpj;
    private $telefone;
    private $email;
    
    
    
    public function __construct($idinstituicao, $endereco, $nome, $razaosocial, $cpfcnpj, $telefone, $email) {
        
           $this-> setidinstituicao ($idinstituicao);
           $this-> setEndereco      ($endereco);
           $this-> setNome          ($nome);
           $this-> setRazaosocial   ($razaosocial);
           $this-> setCpfcnpj       ($cpfcnpj);
           $this-> setTelefone      ($telefone);
           $this-> setEmail         ($email);
    }
    
 
    public function getIdinstituicao(){
        return $this->idinstituicao;
    }

    public function setIdinstituicao($idinstituicao){
        $this->idinstituicao = $idinstituicao;
        return $this;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
        return $this;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }

    public function getRazaosocial(){
        return $this->razaosocial;
    }

    public function setRazaosocial($razaosocial){
        $this->razaosocial = $razaosocial;
        return $this;
    }

    public function getCpfcnpj(){
        return $this->cpfcnpj;
    }


    public function setCpfcnpj($cpfcnpj){
        $this->cpfcnpj = $cpfcnpj;
        return $this;
    }

  
    public function getTelefone(){
        return $this->telefone;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

}

?>