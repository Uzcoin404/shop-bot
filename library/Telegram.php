<?php

if (file_exists('TelegramErrorLogger.php')) {
    require_once 'TelegramErrorLogger.php';
}

class Telegram{
    /**
     * Constant for type Inline Query.
     */
    const INLINE_QUERY = 'inline_query';
    /**
     * Constant for type Callback Query.
     */
    const CALLBACK_QUERY = 'callback_query';
    /**
     * Constant for type Edited Message.
     */
    const EDITED_MESSAGE = 'edited_message';
    /**
     * Constant for type Reply.
     */
    const REPLY = 'reply';
    /**
     * Constant for type Message.
     */
    const MESSAGE = 'message';
    /**
     * Constant for type Photo.
     */
    const PHOTO = 'photo';
    /**
     * Constant for type Video.
     */
    const VIDEO = 'video';
    /**
     * Constant for type Audio.
     */
    const AUDIO = 'audio';
    /**
     * Constant for type Voice.
     */
    const VOICE = 'voice';
    /**
     * Constant for type animation.
     */
    const ANIMATION = 'animation';
    /**
     * Constant for type sticker.
     */
    const STICKER = 'sticker';
    /**
     * Constant for type Document.
     */
    const DOCUMENT = 'document';
    /**
     * Constant for type Location.
     */
    const LOCATION = 'location';
    /**
     * Constant for type Contact.
     */
    const CONTACT = 'contact';
    /**
     * Constant for type Channel Post.
     */
    const CHANNEL_POST = 'channel_post';

    private $bot_token = '';
    private $data = [];
    private $updates = [];
    private $log_errors;
    private $proxy;

    public function __construct($bot_token, $log_errors = true, array $proxy = [])
    {
        $this->bot_token = $bot_token;
        $this->data = $this->getData();
        $this->log_errors = $log_errors;
        $this->proxy = $proxy;
    }

    public function endpoint($api, array $content, $post = true)
    {
        $url = 'https://api.telegram.org/bot'.$this->bot_token.'/'.$api;
        if ($post) {
            $reply = $this->sendAPIRequest($url, $content);
        } else {
            $reply = $this->sendAPIRequest($url, [], false);
        }

        return json_decode($reply, true);
    }

    public function getMe()
    {
        return $this->endpoint('getMe', [], false);
    }

    /// A method for responding http to Telegram.

    /**
     * \return the HTTP 200 to Telegram.
     */
    public function respondSuccess()
    {
        http_response_code(200);

        return json_encode(['status' => 'success']);
    }

    public function sendMessage(array $content)
    {
        return $this->endpoint('sendMessage', $content);
    }

    public function forwardMessage(array $content)
    {
        return $this->endpoint('forwardMessage', $content);
    }

    public function sendPhoto(array $content)
    {
        return $this->endpoint('sendPhoto', $content);
    }

    public function sendAudio(array $content)
    {
        return $this->endpoint('sendAudio', $content);
    }

    public function sendDocument(array $content)
    {
        return $this->endpoint('sendDocument', $content);
    }

    public function sendAnimation(array $content)
    {
        return $this->endpoint('sendAnimation', $content);
    }

    public function sendSticker(array $content)
    {
        return $this->endpoint('sendSticker', $content);
    }

    public function sendVideo(array $content)
    {
        return $this->endpoint('sendVideo', $content);
    }

    public function sendVoice(array $content)
    {
        return $this->endpoint('sendVoice', $content);
    }

    public function sendLocation(array $content)
    {
        return $this->endpoint('sendLocation', $content);
    }

    public function editMessageLiveLocation(array $content)
    {
        return $this->endpoint('editMessageLiveLocation', $content);
    }

    public function stopMessageLiveLocation(array $content)
    {
        return $this->endpoint('stopMessageLiveLocation', $content);
    }

    public function setChatStickerSet(array $content)
    {
        return $this->endpoint('setChatStickerSet', $content);
    }

    public function deleteChatStickerSet(array $content)
    {
        return $this->endpoint('deleteChatStickerSet', $content);
    }

    public function sendMediaGroup(array $content)
    {
        return $this->endpoint('sendMediaGroup', $content);
    }

    public function sendVenue(array $content)
    {
        return $this->endpoint('sendVenue', $content);
    }

    public function sendContact(array $content)
    {
        return $this->endpoint('sendContact', $content);
    }

    public function sendChatAction(array $content)
    {
        return $this->endpoint('sendChatAction', $content);
    }

    public function getUserProfilePhotos(array $content)
    {
        return $this->endpoint('getUserProfilePhotos', $content);
    }

    /// Use this method to get basic info about a file and prepare it for downloading

    /**
     *  Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
     * \param $file_id String File identifier to get info about
     * \return the JSON Telegram's reply.
     */
    public function getFile($file_id)
    {
        $content = ['file_id' => $file_id];

        return $this->endpoint('getFile', $content);
    }

    public function kickChatMember(array $content)
    {
        return $this->endpoint('kickChatMember', $content);
    }

    public function leaveChat(array $content)
    {
        return $this->endpoint('leaveChat', $content);
    }

    public function unbanChatMember(array $content)
    {
        return $this->endpoint('unbanChatMember', $content);
    }

    public function getChat(array $content)
    {
        return $this->endpoint('getChat', $content);
    }

    public function getChatAdministrators(array $content)
    {
        return $this->endpoint('getChatAdministrators', $content);
    }

    public function getChatMembersCount(array $content)
    {
        return $this->endpoint('getChatMembersCount', $content);
    }
    
    public function getChatMember(array $content)
    {
        return $this->endpoint('getChatMember', $content);
    }

    public function answerInlineQuery(array $content)
    {
        return $this->endpoint('answerInlineQuery', $content);
    }

    public function setGameScore(array $content)
    {
        return $this->endpoint('setGameScore', $content);
    }

    public function answerCallbackQuery(array $content)
    {
        return $this->endpoint('answerCallbackQuery', $content);
    }

    public function editMessageText(array $content)
    {
        return $this->endpoint('editMessageText', $content);
    }

    public function editMessageCaption(array $content)
    {
        return $this->endpoint('editMessageCaption', $content);
    }

    public function editMessageReplyMarkup(array $content)
    {
        return $this->endpoint('editMessageReplyMarkup', $content);
    }

    /// Use this method to download a file

    /**
     *  Use this method to to download a file from the Telegram servers.
     * \param $telegram_file_path String File path on Telegram servers
     * \param $local_file_path String File path where save the file.
     */
    public function downloadFile($telegram_file_path, $local_file_path)
    {
        $file_url = 'https://api.telegram.org/file/bot'.$this->bot_token.'/'.$telegram_file_path;
        $in = fopen($file_url, 'rb');
        $out = fopen($local_file_path, 'wb');

        while ($chunk = fread($in, 8192)) {
            fwrite($out, $chunk, 8192);
        }
        fclose($in);
        fclose($out);
    }

    /// Set a WebHook for the bot

    /**
     *  Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts.
     *
     * If you'd like to make sure that the Webhook request comes from Telegram, we recommend using a secret path in the URL, e.g. https://www.example.com/<token>. Since nobody else knows your botâ€˜s token, you can be pretty sure itâ€™s us.
     * \param $url String HTTPS url to send updates to. Use an empty string to remove webhook integration
     * \param $certificate InputFile Upload your public key certificate so that the root certificate in use can be checked
     * \return the JSON Telegram's reply.
     */
    public function setWebhook($url, $certificate = '')
    {
        if ($certificate == '') {
            $requestBody = ['url' => $url];
        } else {
            $requestBody = ['url' => $url, 'certificate' => "@$certificate"];
        }

        return $this->endpoint('setWebhook', $requestBody, true);
    }

    /// Delete the WebHook for the bot

    /**
     *  Use this method to remove webhook integration if you decide to switch back to <a href="https://core.telegram.org/bots/api#getupdates">getUpdates</a>. Returns True on success. Requires no parameters.
     * \return the JSON Telegram's reply.
     */
    public function deleteWebhook()
    {
        return $this->endpoint('deleteWebhook', [], false);
    }

    /// Get the data of the current message

    /** Get the POST request of a user in a Webhook or the message actually processed in a getUpdates() enviroment.
     * \return the JSON users's message.
     */
    public function getData()
    {
        if (empty($this->data)) {
            $rawData = file_get_contents('php://input');

            return json_decode($rawData, true);
        } else {
            return $this->data;
        }
    }

    /// Set the data currently used
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /// Get the text of the current message

    /**
     * \return the String users's text.
     */
    public function Text()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['data'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['text'];
        }
        // if ($type == self::EDITED_MESSAGE) {
        //     return @$this->data['edited_message']['text'];
        // }

        return @$this->data['message']['text'];

    }

    public function Caption()
    {
        $type = $this->getUpdateType();
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['caption'];
        }

        return @$this->data['message']['caption'];
    }

    /// Get the chat_id of the current message

    /**
     * \return the String users's chat_id.
     */
    public function ChatID()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['message']['chat']['id'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['chat']['id'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['chat']['id'];
        }
        if ($type == self::INLINE_QUERY) {
            return @$this->data['inline_query']['from']['id'];
        }

        return $this->data['message']['chat']['id'];
    }

    /// Get the message_id of the current message

    /**
     * \return the String message_id.
     */
    public function MessageID()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['message']['message_id'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['message_id'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['message_id'];
        }

        return $this->data['message']['message_id'];
    }

    /// Get the reply_to_message message_id of the current message

    /**
     * \return the String reply_to_message message_id.
     */
    public function ReplyToMessageID()
    {
        return $this->data['message']['reply_to_message']['message_id'];
    }

    /// Get the reply_to_message forward_from user_id of the current message

    /**
     * \return the String reply_to_message forward_from user_id.
     */
    public function ReplyToMessageFromUserID()
    {
        return $this->data['message']['reply_to_message']['forward_from']['id'];
    }

    /// Get the inline_query of the current update

    /**
     * \return the Array inline_query.
     */
    public function Inline_Query()
    {
        return $this->data['inline_query'];
    }

    /// Get the callback_query of the current update

    /**
     * \return the String callback_query.
     */
    public function Callback_Query()
    {
        return $this->data['callback_query'];
    }

    /// Get the callback_query id of the current update

    /**
     * \return the String callback_query id.
     */
    public function Callback_ID()
    {
        return $this->data['callback_query']['id'];
    }

    /// Get the Get the data of the current callback

    /**
     * \deprecated Use Text() instead
     * \return the String callback_data.
     */
    public function Callback_Data()
    {
        return $this->data['callback_query']['data'];
    }

    /// Get the Get the message of the current callback

    /**
     * \return the Message.
     */
    public function Callback_Message()
    {
        return $this->data['callback_query']['message'];
    }

    /// Get the Get the chat_id of the current callback

    /**
     * \deprecated Use ChatId() instead
     * \return the String callback_query.
     */
    public function Callback_ChatID()
    {
        return $this->data['callback_query']['message']['chat']['id'];
    }
    
    /// Get the Get the from_id of the current callback

    /**
     * \return the String callback_query from_id.
     */
    public function Callback_FromID()
    {
        return $this->data['callback_query']['from']['id'];
    }


    /// Get the date of the current message

    /**
     * \return the String message's date.
     */
    public function Date()
    {
        return $this->data['message']['date'];
    }

    /// Get the first name of the user
    public function FirstName()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['from']['first_name'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['from']['first_name'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['from']['first_name'];
        }

        return @$this->data['message']['from']['first_name'];
    }

    /// Get the last name of the user
    public function LastName()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['from']['last_name'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['from']['last_name'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['from']['last_name'];
        }
        if ($type == self::MESSAGE) {
            return @$this->data['message']['from']['last_name'];
        }

        return '';
    }

    /// Get the username of the user
    public function Username()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return @$this->data['callback_query']['from']['username'];
        }
        if ($type == self::CHANNEL_POST) {
            return @$this->data['channel_post']['from']['username'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['from']['username'];
        }

        return @$this->data['message']['from']['username'];
    }

    /// Get the location in the message
    public function Location()
    {
        return $this->data['message']['location'];
    }

    /// Get the update_id of the message
    public function UpdateID()
    {
        return $this->data['update_id'];
    }

    /// Get the number of updates
    public function UpdateCount()
    {
        return count($this->updates['result']);
    }

    /// Get user's id of current message
    public function UserID()
    {
        $type = $this->getUpdateType();
        if ($type == self::CALLBACK_QUERY) {
            return $this->data['callback_query']['from']['id'];
        }
        if ($type == self::CHANNEL_POST) {
            return $this->data['channel_post']['from']['id'];
        }
        if ($type == self::EDITED_MESSAGE) {
            return @$this->data['edited_message']['from']['id'];
        }

        return $this->data['message']['from']['id'];
    }

    /// Get user's id of current forwarded message
    public function FromID()
    {
        return $this->data['message']['forward_from']['id'];
    }

    /// Get chat's id where current message forwarded from
    public function FromChatID()
    {
        return $this->data['message']['forward_from_chat']['id'];
    }

    /// Tell if a message is from a group or user chat

    /**
     *  \return BOOLEAN true if the message is from a Group chat, false otherwise.
     */
    public function messageFromGroup()
    {
        if ($this->data['message']['chat']['type'] == 'private') {
            return false;
        }

        return true;
    }

    /// Get the title of the group chat

    /**
     *  \return a String of the title chat.
     */
    public function messageFromGroupTitle()
    {
        if ($this->data['message']['chat']['type'] != 'private') {
            return $this->data['message']['chat']['title'];
        }

        return '';
    }

    /// Set a custom keyboard

    /** This object represents a custom keyboard with reply options
     * \param $options Array of Array of String; Array of button rows, each represented by an Array of Strings
     * \param $onetime Boolean Requests clients to hide the keyboard as soon as it's been used. Defaults to false.
     * \param $resize Boolean Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     * \param $selective Boolean Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * \return the requested keyboard as Json.
     */
    public function buildKeyBoard(array $options, $onetime = false, $resize = true, $selective = true)
    {
        $replyMarkup = [
            'keyboard'          => $options,
            'one_time_keyboard' => $onetime,
            'resize_keyboard'   => $resize,
            'selective'         => $selective,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);

        return $encodedMarkup;
    }

    /// Set an InlineKeyBoard

    /** This object represents an inline keyboard that appears right next to the message it belongs to.
     * \param $options Array of Array of InlineKeyboardButton; Array of button rows, each represented by an Array of InlineKeyboardButton
     * \return the requested keyboard as Json.
     */
    public function buildInlineKeyBoard(array $options)
    {
        $replyMarkup = [
            'inline_keyboard' => $options,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);

        return $encodedMarkup;
    }

    /// Create an InlineKeyboardButton

    /** This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
     * \param $text String; Array of button rows, each represented by an Array of Strings
     * \param $url String Optional. HTTP url to be opened when button is pressed
     * \param $callback_data String Optional. Data to be sent in a callback query to the bot when button is pressed
     * \param $switch_inline_query String Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot‘s username and the specified inline query in the input field. Can be empty, in which case just the bot’s username will be inserted.
     * \param $switch_inline_query_current_chat String Optional. Optional. If set, pressing the button will insert the bot‘s username and the specified inline query in the current chat's input field. Can be empty, in which case only the bot’s username will be inserted.
     * \param $callback_game  String Optional. Description of the game that will be launched when the user presses the button.
     * \param $pay  Boolean Optional. Specify True, to send a <a href="https://core.telegram.org/bots/api#payments">Pay button</a>.
     * \return the requested button as Array.
     */
    public function buildInlineKeyboardButton(
        $text,
        $url = '',
        $callback_data = '',
        $switch_inline_query = null,
        $switch_inline_query_current_chat = null,
        $callback_game = '',
        $pay = ''
    ) {
        $replyMarkup = [
            'text' => $text,
        ];
        if ($url != '') {
            $replyMarkup['url'] = $url;
        } elseif ($callback_data != '') {
            $replyMarkup['callback_data'] = $callback_data;
        } elseif (!is_null($switch_inline_query)) {
            $replyMarkup['switch_inline_query'] = $switch_inline_query;
        } elseif (!is_null($switch_inline_query_current_chat)) {
            $replyMarkup['switch_inline_query_current_chat'] = $switch_inline_query_current_chat;
        } elseif ($callback_game != '') {
            $replyMarkup['callback_game'] = $callback_game;
        } elseif ($pay != '') {
            $replyMarkup['pay'] = $pay;
        }

        return $replyMarkup;
    }

    /// Create a KeyboardButton

    /** This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
     * \param $text String; Array of button rows, each represented by an Array of Strings
     * \param $request_contact Boolean Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only
     * \param $request_location Boolean Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only
     * \return the requested button as Array.
     */
    public function buildKeyboardButton($text, $request_contact = false, $request_location = false){
        $replyMarkup = [
            'text'             => $text,
            'request_contact'  => $request_contact,
            'request_location' => $request_location,
        ];

        return $replyMarkup;
    }

    /// Hide a custom keyboard

    /** Upon receiving a message with this object, Telegram clients will hide the current custom keyboard and display the default letter-keyboard. By default, custom keyboards are displayed until a new keyboard is sent by a bot. An exception is made for one-time keyboards that are hidden immediately after the user presses a button.
     * \param $selective Boolean Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * \return the requested keyboard hide as Array.
     */
    public function buildKeyBoardHide($selective = true)
    {
        $replyMarkup = [
            'remove_keyboard' => true,
            'selective'       => $selective,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);

        return $encodedMarkup;
    }

    /// Display a reply interface to the user
    /* Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if the user has selected the bot‘s message and tapped ’Reply'). This can be extremely useful if you want to create user-friendly step-by-step interfaces without having to sacrifice privacy mode.
     * \param $selective Boolean Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * \return the requested force reply as Array
     */
    public function buildForceReply($selective = true)
    {
        $replyMarkup = [
            'force_reply' => true,
            'selective'   => $selective,
        ];
        $encodedMarkup = json_encode($replyMarkup, true);

        return $encodedMarkup;
    }

    public function sendInvoice(array $content)
    {
        return $this->endpoint('sendInvoice', $content);
    }

    public function answerShippingQuery(array $content)
    {
        return $this->endpoint('answerShippingQuery', $content);
    }

    public function answerPreCheckoutQuery(array $content)
    {
        return $this->endpoint('answerPreCheckoutQuery', $content);
    }

    public function sendVideoNote(array $content)
    {
        return $this->endpoint('sendVideoNote', $content);
    }

    public function restrictChatMember(array $content)
    {
        return $this->endpoint('restrictChatMember', $content);
    }

    public function promoteChatMember(array $content)
    {
        return $this->endpoint('promoteChatMember', $content);
    }

    public function exportChatInviteLink(array $content)
    {
        return $this->endpoint('exportChatInviteLink', $content);
    }

    public function setChatPhoto(array $content)
    {
        return $this->endpoint('setChatPhoto', $content);
    }

    public function deleteChatPhoto(array $content)
    {
        return $this->endpoint('deleteChatPhoto', $content);
    }

    public function setChatTitle(array $content)
    {
        return $this->endpoint('setChatTitle', $content);
    }

    public function setChatDescription(array $content)
    {
        return $this->endpoint('setChatDescription', $content);
    }

    public function pinChatMessage(array $content)
    {
        return $this->endpoint('pinChatMessage', $content);
    }

    public function unpinChatMessage(array $content)
    {
        return $this->endpoint('unpinChatMessage', $content);
    }

    public function getStickerSet(array $content)
    {
        return $this->endpoint('getStickerSet', $content);
    }

    public function uploadStickerFile(array $content)
    {
        return $this->endpoint('uploadStickerFile', $content);
    }

    public function createNewStickerSet(array $content)
    {
        return $this->endpoint('createNewStickerSet', $content);
    }

    public function addStickerToSet(array $content)
    {
        return $this->endpoint('addStickerToSet', $content);
    }

    public function setStickerPositionInSet(array $content)
    {
        return $this->endpoint('setStickerPositionInSet', $content);
    }

    public function deleteStickerFromSet(array $content)
    {
        return $this->endpoint('deleteStickerFromSet', $content);
    }

    public function deleteMessage(array $content)
    {
        return $this->endpoint('deleteMessage', $content);
    }

    public function getUpdates($offset = 0, $limit = 100, $timeout = 0, $update = true)
    {
        $content = ['offset' => $offset, 'limit' => $limit, 'timeout' => $timeout];
        $this->updates = $this->endpoint('getUpdates', $content);
        if ($update) {
            if (array_key_exists('result', $this->updates) && is_array($this->updates['result']) && count($this->updates['result']) >= 1) { //for CLI working.
                $last_element_id = $this->updates['result'][count($this->updates['result']) - 1]['update_id'] + 1;
                $content = ['offset' => $last_element_id, 'limit' => '1', 'timeout' => $timeout];
                $this->endpoint('getUpdates', $content);
            }
        }

        return $this->updates;
    }

    /// Serve an update

    /** Use this method to use the bultin function like Text() or Username() on a specific update.
     * \param $update Integer The index of the update in the updates array.
     */
    public function serveUpdate($update)
    {
        $this->data = $this->updates['result'][$update];
    }

    /// Return current update type

    /**
     * Return current update type `False` on failure.
     *
     * @return bool|string
     */
    public function getUpdateType()
    {
        $update = $this->data;
        if (isset($update['inline_query'])) {
            return self::INLINE_QUERY;
        }
        if (isset($update['callback_query'])) {
            return self::CALLBACK_QUERY;
        }
        if (isset($update['edited_message'])) {
            return self::EDITED_MESSAGE;
        }
        if (isset($update['message']['text'])) {
            return self::MESSAGE;
        }
        if (isset($update['message']['photo'])) {
            return self::PHOTO;
        }
        if (isset($update['message']['video'])) {
            return self::VIDEO;
        }
        if (isset($update['message']['audio'])) {
            return self::AUDIO;
        }
        if (isset($update['message']['voice'])) {
            return self::VOICE;
        }
        if (isset($update['message']['contact'])) {
            return self::CONTACT;
        }
        if (isset($update['message']['location'])) {
            return self::LOCATION;
        }
        if (isset($update['message']['reply_to_message'])) {
            return self::REPLY;
        }
        if (isset($update['message']['animation'])) {
            return self::ANIMATION;
        }
        if (isset($update['message']['sticker'])) {
            return self::STICKER;
        }
        if (isset($update['message']['document'])) {
            return self::DOCUMENT;
        }
        if (isset($update['channel_post'])) {
            return self::CHANNEL_POST;
        }

        return false;
    }

    private function sendAPIRequest($url, array $content, $post = true)
    {
        if (isset($content['chat_id'])) {
            $url = $url.'?chat_id='.$content['chat_id'];
            unset($content['chat_id']);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        }
        // 		echo "inside curl if";
        if (!empty($this->proxy)) {
            // 			echo "inside proxy if";
            if (array_key_exists('type', $this->proxy)) {
                curl_setopt($ch, CURLOPT_PROXYTYPE, $this->proxy['type']);
            }

            if (array_key_exists('auth', $this->proxy)) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxy['auth']);
            }

            if (array_key_exists('url', $this->proxy)) {
                // 				echo "Proxy Url";
                curl_setopt($ch, CURLOPT_PROXY, $this->proxy['url']);
            }

            if (array_key_exists('port', $this->proxy)) {
                // 				echo "Proxy port";
                curl_setopt($ch, CURLOPT_PROXYPORT, $this->proxy['port']);
            }
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        if ($result === false) {
            $result = json_encode(
                ['ok' => false, 'curl_error_code' => curl_errno($ch), 'curl_error' => curl_error($ch)]
            );
        }
        curl_close($ch);
        if ($this->log_errors) {
            if (class_exists('TelegramErrorLogger')) {
                $loggerArray = ($this->getData() == null) ? [$content] : [$this->getData(), $content];
                TelegramErrorLogger::log(json_decode($result, true), $loggerArray);
            }
        }

        return $result;
    }
}

// Helper for Uploading file using CURL
if (!function_exists('curl_file_create')) {
    function curl_file_create($filename, $mimetype = '', $postname = '')
    {
        return "@$filename;filename="
            .($postname ?: basename($filename))
            .($mimetype ? ";type=$mimetype" : '');
    }
}