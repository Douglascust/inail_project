<?php

namespace models;
use core\database\DBQuery;

class Profissional {
    
    private $idprofissional;
    private $nome;
    private $funcao;
    private $rg;
    private $telefone;
    private $endereco;
    private $cnpj_cpf;
    
    private $dbquery;
    
    // Definimos a tabela, os campos e a chave primairia para as consultas SQL na classe DBQuery
    public function __construct() {
        
        $tableName  = "profissional";
        $fieldsName = "idProfissional, nome, funcao, rg, telefone, endereco, cnpj_cpf";
        $fieldKey   = "idProfissional";
        $this->dbquery = new DBQuery($tableName, $fieldsName, $fieldKey);
        
    }
    // Função que preenche os atributos da classe, não colocamos no contruct pois as vezes só queremos fazer uma operação basica, sem precisar preencher
    public function populate($idProfissional, $nome, $funcao, $rg, $telefone, $endereco, $cnpj_cpf) {
        
        $this-> setIdProfissional ($idProfissional);
        $this-> setNome           ($nome);
        $this-> setFuncao         ($funcao);
        $this-> setRg             ($rg);
        $this-> setTelefone       ($telefone);
        $this-> setEndereco       ($endereco);
        $this-> setCnpj_cpf        ($cnpj_cpf);
    }
    // Função que transforma os valores em array, isto porque é necessário na DBQuery
    public function toArray(){
        
        return array(
            $this-> getIdProfissional (),
            $this-> getNome           (),
            $this-> getFuncao         (),
            $this-> getRg             (),
            $this-> getTelefone       (),
            $this-> getEndereco       (),
            $this-> getCnpj_cpf       ()
        );
    }
    
    //Função que faz a listagem e preenche os atributos com os dados da listagem
    public function listProfissional($where = null) : array {
        $profissional = array();
        $rSet = null;
        if ( $where == null){
            $rSet = $this->dbquery->select();
        }else{
            $rSet = $this->dbquery->selectFiltered($where);
        }
        
        if ($rSet) {
            foreach ($rSet as $linha) {
                $profissionalObj = new Profissional();
                $profissionalObj->populate(
                    $linha['idProfissional'],
                    $linha['nome'],
                    $linha['funcao'],
                    $linha['rg'],
                    $linha['telefone'],
                    $linha['endereco'],
                    $linha['cnpj_cpf']
                    );
                $profissional[] = $profissionalObj;
            }
        } else {
            $profissional[] = array();
            echo  "{'msg':'Nenhum profissional encontrado.\n'}";
        }
        return( $profissional );
    }
    
    // Função que transforma a array em string
    public function toString(){
        return("\n\t\t\t\t". implode(", ",$this->toArray()));
    }
    
    function setNome($nome) {
        
        $this->nome = $nome;
        
    }
    
    function getNome() {
        return($this->nome);
    }
    
    function setIdProfissional($idProfissional) {
        
        $this->idProfissional = $idProfissional;
        
    }
    
    function getIdProfissional() {
        return($this->idProfissional);
    }
    
    function setFuncao($funcao) {
        
        $this->funcao = $funcao;
        
    }
    
    function getFuncao() {
        return($this->funcao);
    }
    
    function setRg($rg) {
        
        $this->rg = $rg;
        
    }
    
    function getRg() {
        return($this->rg);
    }
    
    function setTelefone($telefone) {
        
        $this->telefone = $telefone;
        
    }
    
    function getTelefone() {
        return($this->telefone);
    }
    
    function getEndereco() {
        return($this->endereco);
    }
    
    function setEndereco($endereco) {
        
        $this->endereco = $endereco;
        
    }
    
    function setCnpj_cpf($cnpj_cpf) {
        
        $this->cnpj_cpf = $cnpj_cpf;
        
    }
    
    function getCnpj_cpf() {
        return($this->cnpj_cpf);
    }
    
}

?>