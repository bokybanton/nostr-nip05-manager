<?php
/*
<script type="text/javascript" src="/public/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/public/bootstrap/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="/public/js/bech32.js"></script>
    <script type="text/javascript" src="/public/js/key.js?v=3"></script>

*/
class ScriptManager {
    private $scripts = array();
  
    public function __construct() {
      $this->scripts = array(
        'home' => array('bootstrap/js/bootstrap.min.js','bootstrap/js/bootstrap.bundle.js'),
        'login' => array('bootstrap/js/bootstrap.min.js','bootstrap/js/bootstrap.bundle.js'),
        'terms-of-use' => array('bootstrap/js/bootstrap.min.js','bootstrap/js/bootstrap.bundle.js'),
        'signup' => array('bootstrap/js/bootstrap.min.js','bootstrap/js/bootstrap.bundle.js'),
        'profile' => array(
            'bootstrap/js/bootstrap.min.js',
            'bootstrap/js/bootstrap.bundle.js',
            'js/bech32.js',
            'js/key.js?v=3')
      );
    }
  
    public function getScripts() {
      $whereIam = $_SESSION['whereIam'];
      if (array_key_exists($whereIam, $this->scripts)) {
        return $this->scripts[$whereIam];
      } else {
        return array();
      }
    }
  
    public function outputScripts() {
      $scripts = $this->getScripts();
      foreach ($scripts as $script) {
        echo '<script src="/public/' . $script . '"></script>';
      }
    }
  }

  
  ?>