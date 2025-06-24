<?php
    
    namespace models;

    //puxando a classe DBQuery
    use core\database\DBQuery;

    Class Cliente{
        
        private $idCliente;
        private $nome;
        private $email;
        private $senha;
        private $cpf;
        private $dbquery;
        
        // Definimos a tabela, os campos e a chave primairia para as consultas SQL na classe DBQuery
        public function __construct() {
           $tableName  = "cliente";
           $fieldsName = "idCliente, nome, email, senha, cpf";
           $fieldKey   = "idCliente";
           $this->dbquery = new DBQuery($tableName, $fieldsName, $fieldKey);
        }
        
        // Função que preenche os atributos da classe, não colocamos no contruct pois as vezes só queremos fazer uma operação basica, sem precisar preencher
        public function populate($idCliente, $nome, $email, $senha, $cpf){
            $this->setIdCliente($idCliente);
            $this->setNome($nome);
            $this->setEmail($email);
            $this->setSenha($senha);
            $this->setCpf($cpf);
        }
        // Função que transforma os valores em array, isto porque é necessário na DBQuery     
        public function toArray(){
            return array(
                $this->getIdCliente(),
                $this->getNome(),
                $this->getEmail(),
                $this->getSenha(),
                $this->getCpf()
            );
        }
        // Função que transforma a array em string
        public function toString(){
            return("\n\t\t\t\t". implode(", ",$this->toArray()));
        }
        
        // Função que salva os dados, se Id não existir (Id == 0), ele insere, se não, ele faz update
        public function save() {
            if($this->getIdCliente() == 0){
                return( $this->dbquery->insert($this->toArray()));
            }else{
                return( $this->dbquery->update($this->toArray()));
            }
        }
        //Função que faz a listagem basica
        public function list($where) {
            if ( $where == null){
                $rSet = $this->dbquery->select();
            }else{
                $rSet = $this->dbquery->selectFiltered($where);
            }
            return( $rSet );
        }
        //Função que faz a listagem e preenche os atributos com os dados da listagem
        public function listClientes($where = null) : array {
            $cliente = array();
            $rSet = null;
            if ( $where == null){
                $rSet = $this->dbquery->select();
            }else{
                $rSet = $this->dbquery->selectFiltered($where);   
            }
            
            if ($rSet) {
                foreach ($rSet as $linha) {
                    $clienteObj = new Cliente();
                    $clienteObj->populate(
                        $linha['idCliente'],
                        $linha['nome'],
                        $linha['email'],
                        $linha['senha'],
                        $linha['cpf']
                        );
                    $cliente[] = $clienteObj;
                }
            } else {
                $cliente[] = array();
                echo  "{'msg':'Nenhum cliente encontrado.\n'}";
            }
            return( $cliente );
        }
        // Função que excluir os clientes por meio do ID
        public function delete() {
            if($this->getIdCliente() != 0){
                return( $this->dbquery->delete($this->toArray()));
            }
        }
    
        public function getIdCliente(){
            return $this->idCliente;
        }
            
        public function setIdCliente($idCliente){
            $this->idCliente = $idCliente;
            return $this;
        }
    
        public function getNome(){
            return $this->nome;
        }
    
        public function setNome($nome){
            $this->nome = $nome;
            return $this;
        }
   
    
        public function getEmail(){
            return $this->email;
        }
    
        public function setEmail($email){
            $this->email = $email;
            return $this;
        }
    
        public function getSenha(){
            return $this->senha;
        }
    
        public function setSenha($senha){
            $this->senha = $senha;
            return $this;
        }
    
        public function getCpf(){
            return $this->cpf;
        }
    
        public function setCpf($cpf){
            $this->cpf = $cpf;
            return $this;
        }
    
    }

?>