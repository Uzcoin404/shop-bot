<?php 
    class UserData {
        public $chatID;

        public function __construct($chatID){
            $this->chatID = $chatID;
        }

        public function setLang($data){
            file_put_contents("users/lang/$this->chatID.txt", $data);
        }
        
        public function getLang(){
            return file_get_contents("users/lang/$this->chatID.txt");
        }

        public function setPage($data){
            file_put_contents("users/page/$this->chatID.txt", $data);
        }

        public function getPage(){
            return file_get_contents("users/page/$this->chatID.txt");
        }

        public function setData($path, $data){
            file_put_contents("users/$path/$this->chatID.txt", $data);
        }

        public function getData($path){
            return file_get_contents("users/$path/$this->chatID.txt");
        }
    }
    
?>