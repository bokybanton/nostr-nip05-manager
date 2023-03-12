<?php
/*

<?php

// Create instance of SettingsManager for user with ID 1
$settingsManager = new ettingsManager(1);
// Set a setting
$settingsManager->setSetting("theme_color", "blue");
// Get the value of a setting
$themeColor = $settingsManager->getSetting("theme_color");
// Erase a setting
$settingsManager->eraseSetting("theme_color");
// Close database connection
$conn->close();



*/

class settingsManager {
        private $id_user;
        private $conn;
    
    public function __construct($id_user) {
        $this->conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_TABLENAME);
        $this->id_user = $id_user;
    }
    
    public function getSetting($setting_name) {
        $sql = "SELECT setting_value FROM settings WHERE setting_name = ? AND id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $setting_name, $this->id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['setting_value'];
        } else {
            return null;
        }
    }
    
    public function setSetting($setting_name, $setting_value) {
        $sql = "INSERT INTO settings (setting_name, setting_value, id_user) VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value), updated_at = NOW()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $setting_name, $setting_value, $this->id_user);
        $stmt->execute();
        return true;
    }
    
    public function eraseSetting($setting_name) {
        $sql = "DELETE FROM settings WHERE setting_name = ? AND id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $setting_name, $this->id_user);
        $stmt->execute();
        return true;
    }
}

?>