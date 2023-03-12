<?php
class Relay {
    private $id; private $name; private $url; private $created_at;
    private $id_user; private $conn; private $relaytable;
    public function __construct() {
        $this->relaytable = DB_RELAYTABLE;
        $this->conn = new mysqli();
        $this->conn->connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_TABLENAME);
    }
    public function create($id_user, $id_name, $name, $url) {   
        $this->name = $name;
        $this->url = $url;
        $this->id_user = $id_user;
        $this->created_at = date('Y-m-d H:i:s');
        $sql = "INSERT INTO $this->relaytable (relay_name, relay_url, created_at, id_user, id_name)
                VALUES ('$this->name', '$this->url', '$this->created_at', $this->id_user, $id_name)";
        $result = $this->conn->query($sql);
        if ($result) {
            $this->id = $this->conn->insert_id;
            return true;
        } else {
            return false;
        }
    }
    public function getRelays($id_user,$id_name) {
        $sql = "SELECT * FROM $this->relaytable WHERE id_name = '$id_name' AND id_user = '$id_user'";
        $result = $this->conn->query($sql);
        $relays = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $relays[] = $row;
        }
        return $relays;
    }
    public function getById($id) {
        $sql = "SELECT * FROM $this->relaytable WHERE id = $id";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->url = $row['url'];
            $this->created_at = $row['created_at'];
            $this->id_user = $row['id_user'];
            return true;
        } else {
            return false;
        }
    }
    public function getRelay($id) {
        $sql = "SELECT * FROM $this->relaytable WHERE id = $id";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }
    public function update($relay_id,$relay_name,$relay_url) {
        $sql = "UPDATE $this->relaytable SET relay_name = '$relay_name', relay_url = '$relay_url'
                WHERE id = $relay_id";
        $result = $this->conn->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($relay_id) {
        $sql = "DELETE FROM $this->relaytable WHERE id = $relay_id";
        $result = $this->conn->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Getters and setters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }
}


?>