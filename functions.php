<?php

class Functions {
    public $lang;

    public function __constructor(){
        
    }

    public function sendMessage($text, $parseMode = false, $replyMarkup = null){
        global $telegram, $chatID;
        
        if ($replyMarkup == null && !$parseMode) {
            $telegram->sendMessage(['chat_id' => $chatID, 'text' => $text]);
        } else if ($replyMarkup != null && !$parseMode) {
            $telegram->sendMessage(['chat_id' => $chatID, 'text' => $text, 'reply_markup' => $replyMarkup]);
        } else if ($replyMarkup == null && $parseMode) {
            $telegram->sendMessage(['chat_id' => $chatID, 'text' => $text, 'parse_mode' => 'markdownV2']);
        } else {
            $telegram->sendMessage(['chat_id' => $chatID, 'text' => $text, 'reply_markup' => $replyMarkup, 'parse_mode' => 'markdownV2']);
        }
    }

    public function sendPhoto($photo, $caption, $parseMode = false, $replyMarkup = false){
        global $telegram, $chatID;

        if ($replyMarkup && !$parseMode) {
            $telegram->sendPhoto(['chat_id' => $chatID, 'photo' => $photo, 'caption' => $caption, 'reply_markup' => $replyMarkup]);
        } else if (!$replyMarkup && $parseMode) {
            $telegram->sendPhoto(['chat_id' => $chatID, 'photo' => $photo, 'caption' => $caption, 'parse_mode' => 'markdownV2']);
        } else if ($replyMarkup && $parseMode) {
            $telegram->sendPhoto(['chat_id' => $chatID, 'photo' => $photo, 'caption' => $caption, 'reply_markup' => $replyMarkup, 'parse_mode' => 'markdownV2']);
        } else {
            $telegram->sendPhoto(['chat_id' => $chatID, 'photo' => $photo, 'caption' => $caption]);
        }
    }
    
    public function resendMessage(){
        global $telegram;
        
        $this->sendMessage(json_encode($telegram->getData(), JSON_PRETTY_PRINT));
    }
}
?>