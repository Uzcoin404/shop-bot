<?php
    class Products {
        public function showProducts(){
            global $telegram, $products, $db, $language, $func, $userData;
            $products = $db->getProducts($language);
            $id = 1;

            for ($i=0; $i < count($products); $i+=2, $id+=1) { 
                $productButtons[] = [$telegram->buildInlineKeyboardButton($products[$i][$language], '', $products[$i]['id']), $telegram->buildInlineKeyboardButton($products[$i+1][$language], '', $products[$i+1]['id'])];
            }
            $productButtons[] = [$telegram->buildInlineKeyboardButton($db->getText('back', $language), '', $db->getText('back', $language))];
            
            $productsBtn = $telegram->buildInlineKeyBoard($productButtons);
            $func->sendMessage($db->getText('products', $language), true, $productsBtn);
            $userData->setPage('products');
            $telegram->buildKeyBoardHide(false);
        }
    }
?>