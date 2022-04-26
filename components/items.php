<?php
    class Items {
        public function showItems($brandID){
            global $telegram, $db, $userData, $func, $language;
            $productID = $userData->getData('product');
            $items = $db->getItems($productID, $brandID);

            if ($items) {
                foreach ($items as $key => $item) {
                    $name = addslashes($item['name']);
                    $photo = "https://47f4-139-28-28-241.ngrok.io/delivery-bot/" . $item['photo_url'];
                    $price = $item['price'];
                    $info = $item[$language];

                    $basket = [
                        'funds' => $item['price'],
                        'items' => [
                            0 => [
                                'name' => $item['name'],
                                'product_id' => $productID,
                                'brand_id' => $brandID
                            ],
                            1 => [
                                'name' => $item['name'],
                                'product_id' => $productID,
                                'brand_id' => $brandID
                            ]
                        ],
                        'amount' => 1
                    ];
                    $func->sendMessage(json_encode($basket));
                    $basketBtn = $telegram->buildInlineKeyBoard([[$telegram->buildInlineKeyboardButton($db->getText('tobasket', $language) . " ($price)", '', $price)]]);

                    $text = "$name \n💰 $price so'm \n\n$info";
                    $func->sendPhoto($photo, $text, false, $basketBtn);
                }
            } else {
                $func->sendMessage($db->getText('no_brands', $language), true);
            }
        }
    }
?>