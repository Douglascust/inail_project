<?php

namespace models;

use models\Procedimento;
use models\Profissional;
use models\Agendaprofissional;
use models\AgendaRecurso;
use core\database\DBQuery;
use core\database\Where;

class Agendacliente{
    
    private $idAgendaCliente;    
    private $idProcedimento;
    private $idRecurso;
    private $idProfissional;
    private $idCliente;
    private $data;
    private $hora;
    private $preco;
    private $dbquery;
    
    public function __construct() {
        $tableName  = "agenda_cliente";
        $fieldsName = "idAgendaCliente, idProcedimento, idRecurso, idProfissional, idCliente, data, hora, preco";
        $fieldKey   = "idAgendaCliente";
        $this->dbquery = new DBQuery($tableName, $fieldsName, $fieldKey);
    }
    
    public function populate($idAgendaCliente, $idProcedimento, $idRecurso,
        $idProfissional, $idCliente, $data, $hora ,$preco){
            $this->setIdAgendaCliente($idAgendaCliente);
            $this->setIdProcedimento($idProcedimento);
            $this->setIdRecurso($idRecurso);
            $this->setIdProfissional($idProfissional);
            $this->setIdCliente($idCliente);
            $this->setData($data);
            $this->setHora($hora);
            $this->setPreco($preco);
    }
    public function toArray(){
        return array(
            $this->getIdAgendaCliente(),
            $this->getIdProcedimento(),
            $this->getIdRecurso(),
            $this->getIdProfissional(),
            $this->getIdCliente(),
            $this->getData(),
            $this->getHora(),
            $this->getPreco()
        );
    }
    // Função que salva os dados, se Id não existir (Id == 0), ele insere, se não, ele faz update
    public function save() {
        if ($this->getIdAgendaCliente() == 0) {
            return $this->dbquery->insert($this->toArray());
        } else {
            return $this->dbquery->update($this->toArray());
        }
    }
    
    // Função que excluir os clientes por meio do ID
    public function delete() {
        if($this->getIdAgendaCliente() != 0){
            return( $this->dbquery->delete($this->toArray()));
        }
    }
       
    public function listAgendamentos($where = null) : array {
        $agenda = array();
        $rSet = null;
        if ( $where == null){
            $rSet = $this->dbquery->select();
        }else{
            $rSet = $this->dbquery->selectFiltered($where);
        }
        if ($rSet) {           
            foreach ($rSet as $linha) {
                $agendaObj = new Agendacliente();
                $agendaObj->populate(
                    $linha['idAgendaCliente'],
                    $linha['idProcedimento'],
                    $linha['idRecurso'],
                    $linha['idProfissional'],
                    $linha['idCliente'],
                    $linha['data'],
                    $linha['hora'],
                    $linha['preco']
                    );
                $agenda[] = $agendaObj;
            }
        } else {
            $agenda = array();
            echo "{'msg':'Nenhum agendamento encontrado.\n'}";
        }
        return( $agenda );
    }
    
    public function validHours($start, $end, $duration, $date){
        $start = date_create($start);
        $startHour = date_format($start, "H:i:s");
        $validHours = array();
        $agendaRecurso = new AgendaRecurso();
        
        // Obter todas as entradas disponíveis para a data especificada
        $rSet = $agendaRecurso->getEntriesForDate($date);
        
        while (true) {
            $calc = strtotime("$startHour +$duration minutes");
            $endHour = date("H:i:s", $calc);
            // Verificar disponibilidade utilizando as informações pré-obtidas
            if ($agendaRecurso->checkAvailable($startHour, $endHour, $rSet)) {
                $validHours[] = $startHour;
            }
            if ($endHour >= $end) {
                break;
            }
            $startHour = $endHour;
        }
        return $validHours;
    }
    
    public function getIdAgendaCliente(){
        return $this->idAgendaCliente;
    }
    
    public function setIdAgendaCliente($idAgendaCliente){
        $this->idAgendaCliente = $idAgendaCliente;
    }
    
    public function getIdCliente(){
        return $this->idCliente;
    }

    public function setIdCliente($idCliente){
        $this->idCliente = $idCliente;
    }
    
    public function getIdProcedimento(){
        return $this->idProcedimento;
    }

    public function setIdProcedimento($idProcedimento){
        $this->idProcedimento = $idProcedimento;
    }

    public function getIdRecurso(){
        return $this->idRecurso;
    }
    
    public function setIdRecurso($idRecurso){
        $this->idRecurso = $idRecurso;
    }
    
    public function getIdProfissional(){
        return $this->idProfissional;
    }
    
    public function setIdProfissional($idProfissional){
        $this->idProfissional = $idProfissional;
    }
    
    public function getData(){
        return $this->data;
    }
    
    public function setData($data){
        $this->data = $data;
    }
    
    public function getHora(){
        return $this->hora;
    }
    
    public function setHora($hora){
        $this->hora = $hora;
    }
    
    public function getPreco(){
        return $this->preco;
    }
    
    public function setPreco($preco){
        $this->preco = $preco;
    }
}
//$agenda = new Agendacliente();
//print_r($agenda->validHours("13:00:00", "17:00:00", 60, "2023-11-21"));
//$agenda->populate(0, 4, 1, 2, 1, "2023-11-30", "9:00", 1);
//echo $agenda->save();
//echo $agenda->save()?"true":"false";

?>