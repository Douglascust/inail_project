<?php

Class AgendaInstituicao{
    
    private $idInstituicao;
    private $dataIni;
    private $horaIni;
    private $dataFim;
    private $horaFim;
    
    public function __construct($idInstituicao, $dataIni, $horaIni, $dataFim, $horaFim) {
        $this->setIdInstituicao($idInstituicao);
        $this->setDataIni($dataIni);
        $this->setHoraIni($horaIni);
        $this->setDataFim($dataFim);
        $this->setHoraFim($horaFim);
    }
    
    public function setIdInstituicao($idInstituicao){
        
        $this->idInstituicao = $idInstituicao;
    }
    
    public function getIdInstituicao(){
        
        return $this->idInstituicao;
    }
    
    public function setDataIni($dataIni){
        
        $this->dataIni = $dataIni;
    }
    
    public function getDataIni(){
        
        return $this->dataIni;
    }
    
    public function setHoraIni($horaIni){
        
        $this->horaIni = $horaIni;
    }
    
    public function getHoraIni(){
        
        return $this->horaIni;
    }
    
    public function setDataFim($dataFim){
        
        $this->dataFim = $dataFim;
    }
    
    public function getDataFim(){
        
        return $this->dataFim;
    }
    
    public function setHoraFim($horaFim){
        
        $this->horaFim = $horaFim;
    }
    
    public function getHoraFim(){
        
        return $this->horaFim;
    }
}