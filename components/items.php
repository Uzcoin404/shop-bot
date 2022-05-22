<?php
    class Items {
        public function showItems($brandID){
            global $telegram, $db, $userData, $func, $language, $siteUrl;
            $productID = $userData->getData('product');
            $items = $db->getItems($productID, $brandID);

            if ($items) {
                foreach ($items as $key => $item) {
                    $name = addslashes($item['name']);
                    $photo = $siteUrl . $item['photo_url'];
                    $price = number_format($item['price'], 0, '', ' ');
                    $info = $item[$language];

                    $callbackData = [
                        'id' => $item['id'],
                        'brand_id' => $brandID,
                        'product_id' => $productID,
                        'name' => $name,
                        'price' => $item['price']
                    ];

                    $basketBtn = $telegram->buildInlineKeyBoard([
                        [$telegram->buildInlineKeyboardButton($db->getText('tobasket', $language) . " ($price)", '', json_encode($callbackData))]]);

                    $text = "$name \n💰 $price so'm \n\n$info";
                    $func->sendPhoto($photo, $text, false, $basketBtn);
                }
            } else {
                $func->sendMessage($db->getText('no_brands', $language), true);
            }
        }

        public function showWarning(){
            global $telegram, $func, $db, $language;
            $buttons = $telegram->buildKeyBoard([
                [$telegram->buildKeyboardButton($db->getText('yes', $language))], [$telegram->buildKeyboardButton($db->getText('no', $language))]]);
            
            $func->sendMessage($db->getText('isUserWantShop', $language), true, $buttons);
        }
    }
?>