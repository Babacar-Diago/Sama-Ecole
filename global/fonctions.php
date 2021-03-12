<?php
    class globalFonctions {

        private $_db; // Instance de PDO

        public function __construct($db) {
            $this->setDb($db);
        }

        public function setDb(PDO $db) {
            $this->_db = $db;
        }

    	public function debug($variable){
            
            echo '<pre>' . print_r($variable, true) . '</pre>';
            
        }
        
        public function str_random($length){
            
            $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
            
            return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
        }

        public function logged_only(){

        	if (session_status() == PHP_SESSION_NONE) {
    	      session_start();
    	    }

        	if (!isset($_SESSION['auth'])) {
    		
    		$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";

            header('Location: index.php');   		
    		exit();
    	    }

        }

}