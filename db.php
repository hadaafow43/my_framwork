<?php

class Database{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "barawo";

    private $mysqli = "";
    private $result = array();
    private $conn = false;
    private $myquery = "";

    public function __construct()
    {
        if(!$this->conn){
            $this->mysqli = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);

            if($this->mysqli->connect_error){
                array_push($this->result,$this->mysqli->connect_error);
                return false;
            }
            else
            {
                return true;

            }
        }
    }

    // inseted

    public function insert($table,$params=array()){
        if($this->tableExists($table))
        {
            $table_colomes = implode(', ', array_keys($params));
            $table_value = implode("','",$params);

             $sql = "INSERT INTO $table ($table_colomes) VALUES ('$table_value')";

             if($this->mysqli->query($sql))
             {
                array_push($this->result,$this->mysqli->insert_id);
                return true;
             }
             else
             {
                array_push($this->result,$this->mysqli->error);
                return false;
             }
        }
        else
        {
           return true;
        }
    }
    // end inserted
   
     public function select($table,$rows="*",$join = null,$where = null,$orderby=null,$limit=null)
     {
        if($this->tableExists($table))
        {
            $sql = "SELECT $rows from $table";
            if($join != null){
                $sql .=" JOIN $join";

            }
            if($where != null){
                $sql .=" WHERE $where";

            }
            if($orderby != null){
                $sql .=" ORDER BY $orderby";
                
            }
            if($limit != null){
               if(isset($_GET['page'])){
                $page = $_GET["page"];

               }
               else
               {
                $page = 1;
               }
               $start = ($page-1) * $limit;

              $sql .= 'LIMIT '.$start.', '.$limit;
            }
            $this->myquery = $sql;

            $query = $this->mysqli->query($sql);

            if($query)
            {
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;

            }
            
         
        }
        else
        {
            return false;
        }
     }


     // update 
    public function upadate($table,$params=array(),$where = null){
        if($this->tableExists($table)){
            
            $arg = array();
            foreach($params as $key => $value){
                $arg[] = "$key = '$value'"; 
            }
            

            $sql = "UPDATE $table SET " . implode(', ',$arg);
            if($where != null){
                $sql .= " where $where";
            }
            if($this->mysqli->query($sql)){
                array_push($this->result,$this->mysqli->affected_rows);
                return true;
               }
               else{
               array_push($this->result,$this->mysqli->error);
               return false;

               }
        }
        else{
            return false;
        }
    }
     // end update

     public function delete($table,$where = null){
        if($this->tableExists($table)){
            $sql = "DELETE FROM $table";
            if($where != null){
                $sql .= " where $where";
            }
            if($this->mysqli->query($sql)){
                array_push($this->result,$this->mysqli->affected_rows);
                return true;
               }
               else{
               array_push($this->result,$this->mysqli->error);
               return false;

               }
        }
        else{
            return false;
        }
     }

    public function getResult(){
        $val = $this->result;
        $this->result = array();
        return $val;
    }

     

    public function escapeString($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $this->mysqli->real_escape_string($data);
    }



    private function tableExists($table){
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
        $tableINdb = $this->mysqli->query($sql);
        if($tableINdb){
            if($tableINdb->num_rows ==1){
                return true;
            }
            else{
                array_push($this->result,$table." xogtaan database ka majirto.");
                return false;
            }
        }
    }

    public function __destruct(){
        if($this->conn){
            if($this->mysqli->close()){
                $this->conn = false;
                return true;
            }
            else{
                return false;
            }
        }
    }



   




 
     
 
}
















?>