<?php

namespace models;

//puxando a classe DBQuery
use core\database\DBQuery;

Class Procedimento{
    
    private $idProcedimento;
    private $tipoProcedimento;
    private $tempo;
    private $preco;
    private $dbquery;
    
    public function __construct() {
        $tableName  = "procedimento";
        $fieldsName = "idProcedimento, tipoProcedimento, tempo, preco";
        $fieldKey   = "idProcedimento";
        $this->dbquery = new DBQuery($tableName, $fieldsName, $fieldKey);
    }
    
    public function populate($idProcedimento, $tipoProcedimento, $tempo, $preco){
        
        $this->setIdProcedimento($idProcedimento);
        $this->setTipoProcedimento($tipoProcedimento);
        $this->setTempo($tempo);
        $this->setPreco($preco);
    }
    // Função que transforma os valores em array, isto porque é necessário na DBQuery
    public function toArray(){
        return array(
            $this->getIdProcedimento(),
            $this->getTipoProcedimento(),
            $this->getTempo(),
            $this->getPreco()
        );
    }
    // Função que transforma a array em string
    public function toString(){
        return("\n\t\t\t\t". implode(", ",$this->toArray()));
    }
    
    // Função que salva os dados, se Id não existir (Id == 0), ele insere, se não, ele faz update
    public function save() {
        if($this->getIdProcedimento() == 0){
            return( $this->dbquery->insert($this->toArray()));
        }else{
            return( $this->dbquery->update($this->toArray()));
        }
    }
    
    //Função que faz a listagem e preenche os atributos com os dados da listagem
    public function listProcedimentos($where = null) : array {
        $procedimento = array();
        $rSet = null;
        if ( $where == null){
            $rSet = $this->dbquery->select();
        }else{
            $rSet = $this->dbquery->selectFiltered($where);
        }
        
        if ($rSet) {
            foreach ($rSet as $linha) {
                $procedimentoObj = new Procedimento();
                $procedimentoObj->populate(
                    $linha['idProcedimento'],
                    $linha['tipoProcedimento'],
                    $linha['tempo'],
                    $linha['preco']
                    );
                $procedimento[] = $procedimentoObj;
            }
        } else {
            $procedimento[] = array();
            echo  "{'msg':'Nenhum procedimento encontrado.\n'}";
        }
        return( $procedimento );
    }
    // Função que excluir os clientes por meio do ID
    public function delete() {
        if($this->getIdProcedimento() != 0){
            return( $this->dbquery->delete($this->toArray()));
        }
    }
    
    public function setIdProcedimento($idProcedimento){
        
        $this->idProcedimento = $idProcedimento;
    }
    
    public function getIdProcedimento(){
        
        return $this->idProcedimento;
    }
    
    public function setTipoProcedimento($tipoProcedimento){
        
        $this->tipoProcedimento = $tipoProcedimento;
    }
    
    public function getTipoProcedimento(){
        
        return $this->tipoProcedimento;
    }
    
    public function setDescricao($descricao){
        
        $this->descricao = $descricao;
    }
    
    public function getDescricao(){
        
        return $this->descricao;
    }
    
    public function setTempo($tempo){
        
        $this->tempo = $tempo;
    }
    
    public function getTempo(){
        
        return $this->tempo;
    }
    
    public function setPreco($preco){
        
        $this->preco = $preco;
    }
    
    public function getPreco(){
        
        return $this->preco;
    }
}