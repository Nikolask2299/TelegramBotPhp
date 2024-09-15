<?php

class TGBot {
    protected $tocken;

    public function __construct($tocken) { 
        $this->tocken = $tocken;
    }

    public function request($method, $data) {
        $ch = curl_init("https://api.telegram.org/bot". $this->tocken ."/" . $method . "?" . http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $out = curl_exec($ch);
        
        curl_close($ch);
    }

    public function sendMessage($chat_id, $message, $keyboat = '') {
        $data = array(
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
        );

        if ($keyboat) {
            $data['reply_markup'] = json_encode(array('inline_keyboard' => $keyboat));
        }

        $this->request('sendMessage', $data);
    }

    public function editMessage($chat_id, $ms_id, $ms_text, $keyboat = '') {
        $data = array(
            'chat_id' => $chat_id,
            'message_id' => $ms_id,
            'text' => $ms_text,
            'parse_mode' => 'HTML',
        );

        if ($keyboat) {
            $data['reply_markup'] = json_encode(array('inline_keyboard' => $keyboat));
        }

        $this->request('editMessageText', $data);
    }

    public function sendChatAction($chat_id, $actions = 'typing') {
            $data = array(
                'chat_id' => $chat_id,
                'actions' => $actions,
            );
        $this->request('sendChatAction', $data);
    }

    public function setWebhook($webhook) {
        $data = array(
            'url' => $webhook,
        );
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . $this->tocken . '/setWebhook?' . http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $out = curl_exec($curl);
        
        curl_close($curl);

        echo $out;
    }

    public function deleteWebhook() {
        $data = array('drop_pending_updates' => true);
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . $this->tocken . '/deletWebhook?' . http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $out = curl_exec($curl);
        
        curl_close($curl);

        echo $out;
    }    

    public function getWebhookinfo() {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . $this->tocken . '/getWebhookinfo');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $out = curl_exec($curl);
        
        curl_close($curl);

        echo $out;
    }
}