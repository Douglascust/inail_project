<?php

namespace models;
use core\database\DBQuery;

class AgendaProfissional{
    
    private $idAgendaProfissional;
    private $idProfissional;
    private $idInstituicao;
    private $dataIni;
    private $horaIni;
    private $dataFim;
    private $horaFim;
    private $dbquery;
    
    public function __construct() {
        
        $tableName  = "agenda_profissional";
        $fieldsName = "idAgendaProfissional, idInstituicao, idProfissional, dataIni, horaIni, dataFim, horaFim";
        $fieldKey   = "idAgendaProfissional";
        $this->dbquery = new DBQuery($tableName, $fieldsName, $fieldKey);
        
    }
    
    public function populate($idAgendaProfissional, $idInstituicao, $idProfissional, $dataIni, $horaIni, $dataFim, $horaFim) {
        
        $this-> setIdAgendaProfissional($idAgendaProfissional);
        $this-> setIdProfissional ($idProfissional);
        $this-> setIdInstituicao  ($idInstituicao);
        $this-> setDataIni     ($dataIni);
        $this-> setHoraIni     ($horaIni);
        $this-> setDataFim        ($dataFim);
        $this-> setHoraFim        ($horaFim);
    }
    
    public function listAgendaProfissional($where = null) : array {
        $agendaProfissional = array();
        $rSet = null;
        if ( $where == null){
            $rSet = $this->dbquery->select();
        }else{
            $rSet = $this->dbquery->selectFiltered($where);
        }
        
        if ($rSet) {
            foreach ($rSet as $linha) {
                $agendaProfissionalObj = new AgendaProfissional();
                $agendaProfissionalObj->populate(
                    $linha['idAgendaProfissional'],
                    $linha['idInstituicao'],
                    $linha['idProfissional'],
                    $linha['dataIni'],
                    $linha['horaIni'],
                    $linha['dataFim'],
                    $linha['horaFim']
                    );
                $agendaProfissional[] = $agendaProfissionalObj;
            }
        } else {
            $agendaProfissional[] = array();
            echo  "{'msg':'Nenhum registro em agenda_aprofissional encontrado.\n'}";
        }
        return( $agendaProfissional );
    }
    
    public function getIdAgendaProfissional(){
        return $this->idAgendaProfissional;
    }
    
    public function setIdAgendaProfissional($idAgendaProfissional){
        $this->idAgendaProfissional = $idAgendaProfissional;
    }
    
    public function getIdProfissional(){
        return $this->idProfissional;
    }
    
    public function setIdProfissional($idProfissional){
        $this->idProfissional = $idProfissional;
    }
    
    public function getIdInstituicao(){
        return $this->idInstituicao;
    }
    
    public function setIdInstituicao($idInstituicao){
        $this->idInstituicao = $idInstituicao;
    }
    
    public function getDataIni(){
        return $this->dataIni;
    }
    
    public function setDataIni($dataIni){
        $this->dataIni = $dataIni;
    }
    
    public function getHoraIni(){
        return $this->horaIni;
    }
    
    public function setHoraIni($horaIni){
        $this->horaIni = $horaIni;
    }
    
    public function getDataFim(){
        return $this->dataFim;
    }
    
    public function setDataFim($dataFim){
        $this->dataFim = $dataFim;
    }
    
    public function getHoraFim(){
        return $this->horaFim;
    }
    
    public function setHoraFim($horaFim){
        $this->horaFim = $horaFim;
    }
    
}
?>