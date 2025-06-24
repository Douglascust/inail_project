<?php

Class Recurso{
    
    private $idRecurso;
    private $tipo;
    private $descricao;
    private $dependencia_recurso;
    
    public function __construct($idRecurso, $tipo, $descricao, $dependencia_recurso) {
        
        $this->setIdRecurso($idRecurso);
        $this->setTipo($tipo);
        $this->setDescricao($descricao);
        $this->setDependencia_Recurso($dependencia_recurso);
    }
    
    public function setIdRecurso($idRecurso) {
        
        $this->idRecurso = $idRecurso;
    }
    
    public function getIdRecurso() {
        
        return $this->idRecurso;
    }
    
    public function setTipo($tipo) {
        
        $this->tipo = $tipo;
    }
    
    public function getTipo() {
        
        return $this->tipo;
    }
    
    public function setDescricao($descricao) {
        
        $this->descricao = $descricao;
    }
    
    public function getDescricao() {
        
        return $this->descricao;
    }
    
    public function setDependencia_Recurso($dependencia_recurso) {
        
        $this->dependencia_recurso = $dependencia_recurso;
    }
    
    public function getDependencia_Recurso() {
        
        $this->dependencia_recurso;
    }
    
}