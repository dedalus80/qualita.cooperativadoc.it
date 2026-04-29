<?php
  
  class MySql_DB {
      private $Debug = false;
      private $rc = null;
      private $charset = 'utf8';
      var $alertEmail =''; 
      var $alertFile  ='';
      
      
      //function Connect(){
      function __construct($HOST, $DB_NAME, $DB_USER, $DB_PASS, $debug = false, $charset = '') {
          if($debug) $this->Debug = $debug;
          if($charset) $this->charset = $charset;
          
          //richiesta connessione
          $connessione = @mysql_connect($HOST, $DB_USER, $DB_PASS, true); 
          if(!$connessione)
            return $this->db_error(mysql_error());
        
          //selezione del database
          @mysql_select_db($DB_NAME, $connessione);
          if(mysql_error($connessione))
            return $this->db_error(mysql_error($connessione));
          
          $this->rc = $connessione;
          
          $this->charsetDB();
          
          $this->Query('SET SESSION sql_mode = ""');
          
      }
      
      private function charsetDB(){
          #$this->Query("SET NAMES ".$this->charset);
      }

      //query sulla tabella 
      function Query($sql){
          $res = @mysql_query($sql, $this->rc);
          if (mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc), $sql);
       
          return $res;
      }

      //estrazione di un record
      function FetchRow($sql){
          $rows = @mysql_fetch_row($sql);
          if(mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc), $sql);
          
          return $rows;
      }

      //conteggio dei records
      function FetchNum($sql){
          $num = @mysql_num_rows($sql);
          if(mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc), $sql);
          
          return $num;
      }

      //estrazione dei records 
      function FetchArray($sql){
          $array = @mysql_fetch_array($sql);
          if(mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc), $sql);
          
          return $array;
      }
      
      //estrazione dei records  
      function FetchAssoc($sql){
          $array = @mysql_fetch_assoc($sql);
          if(mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc), $sql);
          
          return $array;
      }
      
      function FetchObject($sql){
          $objdata = @mysql_fetch_object($sql);
          if(mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc), $sql);
          
          return $objdata;
      }
      
      //ultimo id inserito
      function LastId(){
          $id = @mysql_insert_id($this->rc);
          if(mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc));
          
          return $id;
      }
     
      function NumRows($sql){
          $n = @mysql_num_rows($sql);
          if(mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc));
          
          return $n;
      }
      
      function EmptyMem($result){
          @mysql_free_result($result);
          if(mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc));
          
          return TRUE;
      }
      
      
      function CycleArray($sql) {
        $x =0;
        while($dati = @mysql_fetch_assoc($sql)){
            $array[0][$x] = $dati['id'];
            $array[1][$x] = $dati['nome'];
            $x++;
        }
        if (mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc), $sql);

        return $array;
     } 
     
      function CycleField($sql) {
        $x =0;
        while($dati = @mysql_fetch_assoc($sql)){
            $array[$x] = $dati['nome'];
            $x++;
        }
        if (mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc), $sql);

        return $array;
     } 
     
     function CycleAssochId($sql) {
        
        while($dati = @mysql_fetch_assoc($sql)){
            $array[$dati['id']] = $dati['nome'];
            
        }
        if (mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc), $sql);

        return $array;
     }
     
     
      function CycleAssoch($sql) {
        $x =0;
        $field = @mysql_num_fields($sql);
        
        while($dati = @mysql_fetch_assoc($sql)){
            for($k=0; $k<$field; $k++)
                $array[$x][mysql_field_name($sql, $k)] = $dati[mysql_field_name($sql, $k)];
            
            $x++;
        }
        if (mysql_error($this->rc))
            return $this->db_error(mysql_error($this->rc), $sql);

        return $array;
     } 
     
      function GetPagination($query, $pagina, $quanti){
          $sql = $this->Query($query);
          $array['tot']         = $this->NumRows($sql);
          $array['start']       = 1;#($pagina - 1) * $quanti ;
          $array['last_page']   = ceil($array['tot']  / $quanti);
          $array['quanti']      = $quanti;
          return $array;
      }
      
      
      
      //estrae direttamente il valore di un campo
      function SingleField($field, $table, $where){
          $query = $this->Query("SELECT ".$field." FROM ".$table." ".$where);
          $field = $this->FetchRow($query);
          $this->EmptyMem($query);
        
          return $field[0];
      }
      
      //visualizza errori
      function db_error($msg, $query = ""){
          if($this->Debug)
            die ($msg."\n\n".$query);
          else
            return FALSE;
      }
      
      //chiusura della connessione
      function Close() {
          @mysql_close($this->rc);
      }
      
      function escape($val) {
        return mysql_real_escape_string($val, $this->rc);
      }
      
      //function Close(){
      function __destruct() {
          $this->Close();
      }
      
      
      function debugEmail($file){ 
          
          if($this->alertEmail!=''){
            $this->alertFile = $file;  
            mail("djamal@archynet.it", "ERRORE OPERAZIONE FILE", ": FILE :  \n" . $this->alertFile . " \n QUERY: \n" . $this->alertEmail . "\n ", "From:debug@mediawebsms.com", "");
          }
          
      }
      
  }
  



?>
