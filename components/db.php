<?php
    class Database{
        private $hostname = '127.0.0.1';
        private $username = 'root';
        private $password = '';
        private $database = 'shop-bot';
        private $port = 19546;
        
        private function connect(){
            $mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->database);
            
            if ($mysqli->connect_error) {
                die('Connect Error (' . $mysqli->connect_errno . ')  '. $mysqli->connect_error);
            }
            return $mysqli;
        }
        
        public function setUser($chatID, $fullName, $date){
            $chatID = mysqli_real_escape_string($this->connect(), $chatID);
            $fullName = mysqli_real_escape_string($this->connect(), addslashes($fullName));
            
            mysqli_query($this->connect(), "INSERT INTO `users` (`user_id`, `full_name`, `date`) VALUES ($chatID, '$fullName', $date)");
            mysqli_query($this->connect(), "INSERT INTO `data` (`user_id`, `lang`) VALUES ($chatID, 'uz')");
        }
        
        public function getUser($chatID){
            $chatID = mysqli_real_escape_string($this->connect(), $chatID);
    
            
            $query = mysqli_query($this->connect(), "SELECT * FROM `users` WHERE `user_id` = $chatID LIMIT 1");
            if ($query) {
                return mysqli_fetch_assoc($query);
            } else {
                return false;
            }
        }

        public function setLang($chatID, $lang){
            $lang = mysqli_real_escape_string($this->connect(), $lang);

            $query = mysqli_query($this->connect(), "UPDATE `data` SET `lang`='$lang' WHERE `chat_id` = $chatID") or die(mysqli_errno($this->connect()));
        }

        public function getText($keyword, $lang){
            $query = mysqli_query($this->connect(), "SELECT `$lang` FROM `texts` WHERE `keyword` = '$keyword' LIMIT 1");
            if ($query) {
                $result = mysqli_fetch_assoc($query)[$lang];
                return $result;
            } else {
                return false;
            }
        }

        public function getBasket($chatID){
            $query = mysqli_query($this->connect(), "SELECT `cash`, `basket` FROM `data` WHERE `user_id`=$chatID LIMIT 1");
            if ($query) {
                $result = mysqli_fetch_assoc($query);
                return $result;
            } else {
                return false;
            }
        }

        public function getBalance($chatID){
            $query = mysqli_query($this->connect(), "SELECT `cash` FROM `data` WHERE `user_id`=$chatID LIMIT 1");
            if ($query) {
                $result = mysqli_fetch_assoc($query)['cash'];
                
                return $result;
            } else {
                return false;
            }
        }

        public function editBasket($chatID, $data){
            $basket = $this->getBasket($chatID);
            $oldData = json_decode($basket['basket'], true);
            $cash = 0;
            
            if (count($oldData) > 0) {
                array_push($oldData['basket']['items'], $data);
            } else {
                array_push($oldData['basket']['items'], $data);
            }
            $items = $oldData['basket']['items'];
            $oldData['basket']['count'] = count($items);
            for ($i=0; $i < count($items); $i++) { 
                $cash += $items[$i]['price'];
            }
            
            $oldData['cash'] = $cash;
            $basket = json_encode($oldData);
            $query = mysqli_query($this->connect(), "UPDATE `data` SET `basket`='$basket',`cash`=$cash WHERE `user_id`=$chatID");
            var_dump(json_encode($items));
        }

        public function checkProducts($id){
            $id = $this->stringToInt($id);
            $query = mysqli_query($this->connect(), "SELECT `id` FROM `products` WHERE `id` = $id LIMIT 1");

            if ($query) {
                return mysqli_fetch_assoc($query)['id'];
            } else {
                return false;
            }
        }

        public function getProducts($lang){
            $lang = mysqli_real_escape_string($this->connect(), $lang);

            $query = mysqli_query($this->connect(), "SELECT `$lang`, `id` FROM `products`");
            $result = [];
            while ($products = mysqli_fetch_assoc($query)) {
                $result[] = $products;
            }
            return $result;
        }

        public function getBrands($productID){
            $productID = $this->stringToInt($productID);
            $query = mysqli_query($this->connect(), "SELECT * FROM `brands` WHERE `product_id` = $productID");

            $result = [];
            if ($query) {
                while ($brands = mysqli_fetch_assoc($query)) {
                    $result[] = $brands['name'];
                }
                return $result;
            }
            return false;
        }

        public function checkBrand($productID, $name){
            $productID = $this->stringToInt($productID);
            $query = mysqli_query($this->connect(), "SELECT `id` FROM `brands` WHERE `name` = '$name' AND `product_id` = $productID LIMIT 1");

            if ($query) {
                return mysqli_fetch_assoc($query)['id'];
            } else {
                return false;
            }
        }

        public function getItems($productID, $brandID){
            $productID = $this->stringToInt($productID);
            $query = mysqli_query($this->connect(), "SELECT * FROM `items` WHERE `product_id` = $productID AND `brand_id` = $brandID");
            $result = [];

            if ($query) {
                while ($items = mysqli_fetch_assoc($query)) {
                    $result[] = $items;
                }
                return $result;
            }
            return false;
        }
        
        public function botStatistics(){
            $query = mysqli_query($this->connect(), "SELECT * FROM `users`");
            $output = [];
            $today = strtotime('00:00');
            $count = $todayCount = $referrals = 0;

            while ($user = mysqli_fetch_assoc($query)) {
                if ($user['date'] - $today > 0 ) {
                    $todayCount += 1;
                }
                $count += 1;
                $referrals += $user['referrals'];
            }
            array_push($output, ['count' => $count, 'todayCount' => $todayCount, 'referrals' => $referrals]);
            return $output;
        }

        public function stringToInt($string){
            $result = (int) $string;
            if ($result != 0) {
                return $result;
            }
        }
    }
?>