<?php
    require_once "vendor/autoload.php";
    use SergiX44\Nutgram\Nutgram;

   $bot = new Nutgram($_ENV['7472898032:AAG_YrQQlyWzkdC3LA6YosOAJ9kAFn399SI']);

   $bot->onCommand('start', function(Nutgram $bot) {
    $bot->sendMessage('Ciao!');
   });
   
   $bot->onText('My name is {name}', function(Nutgram $bot, string $name) {
    $bot->sendMessage("Hi $name");
   });
   
   $bot->run();

  

    
