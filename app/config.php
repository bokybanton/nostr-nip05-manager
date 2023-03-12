<?php
    session_start();

    // now we run de ROUTER
    // should be the first file to be loaded, start the session and
    // include and check mariadb.data.php

    // if mariadb.data.php.sample exist, abort and prompt message to 
    // configure the package with database connection
    // copying and edditing manually the file.
    // should do this with php? 

    class MariaDBConfigChecker {
        public function checkAndCopyConfig() {
          $sampleConfigPath = '/path/to/mariadb.config.php.sample';
          $configPath = '/path/to/mariadb.config.php';
      
          if (file_exists($sampleConfigPath)) {
            copy($sampleConfigPath, $configPath);
            unlink($sampleConfigPath);
            echo "Sample MariaDB config copied to $configPath and deleted from $sampleConfigPath.";
          } else {
            echo "Sample MariaDB config not found at $sampleConfigPath.";
          }
        }
      }

      
    // improve this task to prompt a form to wizard install.

    // include all first classes

    // include_once all files in /class/ folder
 class PHPDirectoryLoader {
    protected $directory;

    public function __construct($directory) {
        $this->directory = $directory;
    }

    public function load() {
        $files = glob($this->directory . '/*.php');
        foreach ($files as $file) {
            if ($this->syntaxCheck($file)) {
                include_once $file;
            }
            else {

            }
        }
    }


    protected function syntaxCheck($file) {

        $output = shell_exec('php -l ' . escapeshellarg($file) . ' 2>&1');
            if (strpos($output, 'No syntax errors detected') !== false) {
                return true;
            } else {
                return false;
            }

    }
}

$loader = new PHPDirectoryLoader('app/classes/');
$loader->load();



?>