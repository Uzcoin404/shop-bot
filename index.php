<?php
date_default_timezone_set('Asia/Tashkent');
require_once('library/Telegram.php');
require_once('components/db.php');
require_once('functions.php');
require_once('user.php');
include_once('components/products.php');
include_once('components/brands.php');
include_once('components/items.php');

$telegram = new Telegram("5055709592:AAHyt7y78TNwmRqOxaNW63BHTF2GQYN4jpc", true);
$chatID = $telegram ->ChatID();
$db = new Database();
$userData = new UserData($chatID);
$func = new Functions();
$products = new Products();
$brands = new Brands();
$items = new Items();
$Admin = "829349149";
// $telegram->setWebhook('https://5d25-139-28-28-203.ngrok.io/shop-bot/');

$message = isset($telegram->getData()['message']) ? $telegram->getData()['message'] : '';
$messageID = $telegram ->MessageID();
$text = $telegram ->Text();
$firstName = $telegram -> FirstName();
$lastName = $telegram -> LastName();
$fullName = $firstName . ' ' . $lastName;
$username = $telegram -> Username();
$language = $userData->getLang();

if ($text == '/start' || str_contains($text, '/start')) {
    setUser();
    if (!isset($language)) {
        showLanguage();
    } else {
        showMain();
    }
} else {
    switch ($userData->getPage()) {
        case "start":
            switch ($text) {
                case "🇺🇿 O'zbekcha 🇺🇿":
                    $userData->setLang('uz');
                    showMain('uz');
                    break;
                case "🇬🇧 English 🇬🇧":
                    $userData->setLang('uk');
                    showMain('uk');
                    break;
                default:
                    $func->sendMessage($db->getText('no_command1', $language), true);
                    break;
            }
            break;
        case "main":
            switch ($text) {
                case $db->getText('products', $language):
                    $products->showProducts();
                    break;
                case $db->getText('basket', $language):
                    $func->sendMessage($text);
                    break;
                case $db->getText('contact', $language):
                    $func->sendMessage($text);
                    break;
                case $db->getText('info_bot', $language):
                    $func->sendMessage($text);
                    break;
                case $db->getText('choose_lang', $language):
                    showLanguage();
                    break;
                default:
                    $func->sendMessage($db->getText('no_command3', $language), true);
                    break;
            }
            break;
        case "products":
            if ($db->checkProducts($text)) {
                $brands->showBrands($text);
                $userData->setData('product', $text);
            } else if ($db->getText('back', $language) == $text) {
                showMain();
            } else {
                $func->sendMessage($db->getText('no_command4', $language), true);
            }
            $telegram->answerCallbackQuery(['callback_query_id' => $telegram->Callback_ID(), 'text' => '']);
            break;
        case "brands":
            $callbackData = json_decode($text, true);
            $brand = $db->checkBrand($userData->getData('product'), $text);

            if ($callbackData) {
                $db->editBasket($chatID, $callbackData);
                $telegram->answerCallbackQuery(['callback_query_id' => $telegram->Callback_ID(), 'text' => $db->getText('addedBasket', $language)]);
                $items->showWarning();
            }
            if ($brand) {
                $userData->setData('brand', $brand);
                $items->showItems($brand);
            } else if ($db->getText('back', $language) == $text) {
                $products->showProducts();
            } else if ($db->getText('yes', $language) == $text) {
                $products->showProducts();
            } else if ($db->getText('no', $language) == $text) {
                showMain();
            }
            break;
        default:
            $func->sendMessage($db->getText('no_command2', 'uz'), true);
    }
}

function setUser(){
    global $db, $chatID, $fullName;

    if (!$db->getUser($chatID)) {
        $db->setUser($chatID, $fullName, time());
    }
}

function showLanguage(){
    global $telegram, $func, $userData;

    $languageButtons = $telegram->buildKeyBoard([
        [$telegram->buildKeyboardButton("🇺🇿 O'zbekcha 🇺🇿"), $telegram->buildKeyboardButton("🇬🇧 English 🇬🇧")]
    ]);

    $text = "*🇺🇿 Tilni tanlang \n🇬🇧 Choose your language*";
    $func->sendMessage($text, true, $languageButtons);
    $userData->setPage('start');
}

function showMain($lang = null){
    global $telegram, $userData, $func, $db, $language;
    if ($lang != null) {
        $language = $lang;
    }
    
    $mainButtons = $telegram->buildKeyBoard([
        [$telegram->buildKeyboardButton($db->getText('products', $language))],
        [$telegram->buildKeyboardButton($db->getText('basket', $language)), $telegram->buildKeyboardButton($db->getText('contact', $language))],
        [$telegram->buildKeyboardButton($db->getText('info_bot', $language))],
        [$telegram->buildKeyboardButton($db->getText('choose_lang', $language))]
    ]);
    $text =$db->getText('welcome_message', $language);
    $func->sendMessage($text, true, $mainButtons);
    $userData->setPage('main');
}
?>