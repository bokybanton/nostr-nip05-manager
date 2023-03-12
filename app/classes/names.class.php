<?php
# $nip05 = new nip05();
# $nip05->addNip($pubkey,$display);
# if $nip05['result'] = ok, ['data'] and so on
include_once(__DIR__."/../mariadb.class.php");
include_once(__DIR__."/../classes/login.class.php");
class namesNip {
    public $pubkey; public $display;
    private $con; private $table; private $db; private $displayReg; private $pubkeyReg;
    private $hexkey;
    private $id_user;
    public function __construct() {
        $this->db['host'] = DB_HOST; $this->db['port'] = DB_PORT; $this->db['table'] = DB_TABLENAME;
        $this->db['user'] = DB_USERNAME; $this->db['pwd'] = DB_PASSWORD;
        $this->table = DB_NIPNAMES;
        $userLogged = new LoginSession();
        $check = $userLogged->is_logged_in();
        if ($check) { $this->id_user = $_SESSION['user_id']; }
        $this->con = new mysqli();
        $this->con->connect($this->db['host'],$this->db['user'],$this->db['pwd'],$this->db['table']);
    }
    public function addNip($pubkey,$hexkey,$display) {
        $this->pubkey = $pubkey;
        $this->hexkey = $hexkey;
        $this->display = $display;
        $this->displayReg = $this->buscaDisplay($this->display);
        if (!$this->displayReg) {
            $this->con->
            query("
                INSERT INTO $this->table 
                (pubkey,hexkey,display,created_at) VALUES 
                ('$this->pubkey','$this->hexkey','$this->display',NOW()) 
                ");
            return $this->con->insert_id;
        }
        else { return false; }
    }
    public function addUserNip($pubkey,$hexkey,$display) {
        $this->pubkey = $pubkey;
        $this->display = $display;
        $this->hexkey = $hexkey;
        $this->displayReg = $this->buscaDisplay($this->display);
        if (!$this->displayReg) {
            $this->con->
            query("
                INSERT INTO $this->table 
                (pubkey,hexkey,display,created_at,id_user) VALUES 
                ('$this->pubkey','$this->hexkey','$this->display',NOW(),'$this->id_user') 
                ");
            return $this->con->insert_id;
        }
        else { return false; }
    }
    public function buscaDisplay($display) {
        $this->display = $display;
        $query = $this->con->query("SELECT * FROM $this->table WHERE display = '$display'");
        if ($row = mysqli_fetch_array($query)) { 
            if($row['display'] == $display) { return $row; }
         }
    }
    public function buscaPubkey($pubkey) {
        $this->pubkey = $pubkey;
        $query = $this->con->query("SELECT * FROM $this->table WHERE pubkey = '$pubkey'");
        if ($row = mysqli_fetch_array($query)) { 
            if($row['pubkey'] == $pubkey) { return $row['display']; }
            else { return false; }
         }
    }    
    
    public function dameNames() {
        $query = $this->con->query("
            SELECT * FROM $this->table WHERE id_user = '$this->id_user'
        ");
        $names = array();
        while ($row = mysqli_fetch_array($query)) {
            $names[] = $row;
          }
        return $names;
    }
    public function dameDataName($id_user,$id_name) {
        $query = $this->con->query("
            SELECT * FROM $this->table WHERE id_user = '$id_user' AND $id_name = '$id_name'
        ");
        $name = mysqli_fetch_assoc($query);
        return $name;
    }
    public function dameName($id_name) {
        $query = $this->con->query("
            SELECT * FROM $this->table WHERE id = '$id_name' AND id_user = '$this->id_user'
        ");
        if ($name = $query->fetch_assoc()) {
            return $name;
        }
        else {
            return false;
        }

    }
    
    public function editName($id_user,$id_name,$pubkey,$hexkey,$display) {
        $existeName = $this->buscaDisplay($display);
        if($existeName) { return false; }
        $query = $this->con->query("
            UPDATE $this->table SET pubkey = '$pubkey',hexkey = '$hexkey',display = '$display' 
            WHERE id = '$id_name' AND id_user = '$id_user'
        ");
        return $query;

    }
    public function deleteName($id_name) {
        $query = $this->con->query("
            DELETE FROM $this->table WHERE id = '$id_name' AND id_user = '$this->id_user'
        ");
        $affected = $this->con->affected_rows;
        if ($affected > 0) { return true; }
        else { return false; }
    }
    public function isNip() {

    }
}

?>