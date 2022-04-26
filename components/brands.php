<?php
    class Brands  {
        public function showBrands($productID){
            global $telegram, $db, $language, $func, $userData;
            $brands = $db->getBrands($productID);
            if ($brands) {
                for ($i=0; $i < count($brands); $i+=2) { 
                    $brandButtons[] = [$telegram->buildKeyboardButton($brands[$i]), $telegram->buildKeyboardButton($brands[$i+1])];
                }
                $brandButtons[] = [$telegram->buildKeyboardButton($db->getText('back', $language))];
    
                $productsBtn = $telegram->buildKeyBoard($brandButtons);
                $func->sendMessage($db->getText('choose_brands', $language), false, $productsBtn);
                $userData->setPage('brands');
                $telegram->buildKeyBoardHide(false);
            } else {
                $func->sendMessage($db->getText('no_brands', $language), true);
            }
        }
    }
    
?>