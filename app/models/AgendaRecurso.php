<?php

namespace models;
use core\database\Where;
use core\database\DBQuery;

Class AgendaRecurso{
    
    private $idAgendaRecurso;
    private $idRecurso;
    private $idInstituicao;
    private $data;
    private $hora;
    private $tempo;
    private $dbquery;
    
    public function __construct() {
        $tableName  = "agenda_recurso";
        $fieldsName = "idAgendaRecurso, idInstituicao, idRecurso, data, hora, tempo";
        $fieldKey   = "idAgendaRecurso";
        $this->dbquery = new DBQuery($tableName, $fieldsName, $fieldKey);
    }
    
    public function populate($idAgendaRecurso, $idInstituicao, $idRecurso, $data, $hora, $tempo){

        $this->setIdAgendaRecurso($idAgendaRecurso);
        $this->setIdInstituicao($idInstituicao);
        $this->setIdRecurso($idRecurso);
        $this->setData($data);
        $this->setHora($hora);
        $this->setTempo($tempo);
    }
    
    public function toArray(){
        return array(
            $this->getIdAgendaRecurso(),
            $this->getIdInstituicao(),
            $this->getIdRecurso(),
            $this->getData(),
            $this->getHora(),
            $this->getTempo() 
        );
    }
    
    public function save() {
        if($this->getIdAgendaRecurso() == 0){
            return( $this->dbquery->insert($this->toArray()));
        }else{
            return( $this->dbquery->update($this->toArray()));
        }
    }
    
    public function getEntriesForDate($date){
        $where = new Where();
        $where->addCondition('AND', 'data', '=', $date);
        return $this->dbquery->selectFiltered($where);
    }
    
    public function checkAvailable($start, $end, $entries){
        foreach ($entries as $linha) {
            $startReference = $linha['hora'];
            $duration = $linha['tempo'];
            $calc = strtotime("$startReference +$duration minutes");
            $endReference = date("H:i:s", $calc);
            //$kekw="(s$start >= $startReference && s$start < $endReference) || (e$end > $startReference && e$end <= $endReference)</br>";
            if(($start >= $startReference && $start < $endReference) || ($end > $startReference && $end <= $endReference)){
                //echo $kekw;
                return false;
            }
        }
        return true;
    }
    public function listAgendaRecurso($where = null) : array {
        $agendaRecurso = array();
        $rSet = null;
        if ( $where == null){
            $rSet = $this->dbquery->select();
        }else{
            $rSet = $this->dbquery->selectFiltered($where);
        }
        if ($rSet) {
            foreach ($rSet as $linha) {
                $agendaRecursoObj = new AgendaRecurso();
                $agendaRecursoObj->populate(
                    $linha['idAgendaRecurso'],
                    $linha['idInstituicao'],
                    $linha['idRecurso'],
                    $linha['data'],
                    $linha['hora'],
                    $linha['tempo']
                    );
                $agendaRecurso[] = $agendaRecursoObj;
            }
        } else {
            $agendaRecurso = array();
            echo "{'msg':'Nenhum agendamento encontrado.\n'}";
        }
        return( $agendaRecurso );
    }
    public function delete() {
        if($this->getIdAgendaRecurso() != 0){
            return( $this->dbquery->delete($this->toArray()));
        }
    }
    
    public function setIdAgendaRecurso($idAgendaRecurso){
        
        $this->idAgendaRecurso = $idAgendaRecurso;
    }
    
    public function getIdAgendaRecurso(){
        
        return $this->idAgendaRecurso;
    }
    
    public function setIdRecurso($idRecurso){
        
        $this->idRecurso = $idRecurso;
    }
    
    public function getIdRecurso(){
        
        return $this->idRecurso;
    }
    
    public function setIdInstituicao($idInstituicao){
        
        $this->idInstituicao = $idInstituicao;
    }
    
    public function getIdInstituicao(){
        
        return $this->idInstituicao;
    }
    
    public function setData($data){
        
        $this->data = $data;
    }
    
    public function getData(){
        
        return $this->data;
    }
    
    public function setHora($hora){
        
        $this->hora = $hora;
    }
    
    public function getHora(){
        
        return $this->hora;
    }
    
    public function setTempo($tempo){
        
        $this->tempo = $tempo;
    }
    
    public function getTempo(){
        
        return $this->tempo;
    }
}

