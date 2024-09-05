<?php
    require_once "vendor/autoload.php";

    $messageText = "Hello, World!";
    echo "Bot started...\n";

    // Initialize Telegram Bot API
    try {
        $bot = new \TelegramBot\Api\Client("7472898032:AAG_YrQQlyWzkdC3LA6YosOAJ9kAFn399SI");

        $bot -> command('start', function ($message) use ($bot) {
            $bot -> sendMessage($message->getChat()->getId(), $messageText);
        });
        
    } catch (\TelegramBot\Api\Exception $e) {
        $e -> getMessage();
    }
