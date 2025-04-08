<?php 
    class Manager {
        private $visitCount;
        
        public function __construct() {
            session_start();
            if (!isset($_SESSION['count'])) {
                $_SESSION['count'] = 1;
            }
            else{$_SESSION['count']++;}
            $this->visitCount = $_SESSION['count'];

        }

        public function getVisitCount() {
            return $this->visitCount;
        }

        public function resetSession() {
            session_unset(); 
            $_SESSION = []; 
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }


    }

?>