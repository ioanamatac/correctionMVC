<?php
    class DbManager{

        protected $bdd;

        public function __construct()
        {
            try {
                $this->bdd = new PDO('mysql:host=db; dbname=forum', 'user', 'root');
                $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e) {
                die('Erreur '.$e->getMessage());
            }
        }
    }
?>