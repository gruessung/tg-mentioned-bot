<?php
ini_set("log_errors", 1);
ini_set("error_log", "./tg.log");

// Load composer
require_once __DIR__ . '/vendor/autoload.php';


use Longman\TelegramBot\Request;
use Exception;
use Longman\TelegramBot\Commands\Command;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Exception\TelegramException;
use PDO;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;


// Add you bot's API key and name
$bot_api_key  = '';
$bot_username = '';

$yourUsername = '';
$yourChatId = 0;



try {
 
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    Longman\TelegramBot\TelegramLog::initErrorLog(__DIR__ . "/{$bot_username}_error.log");
    Longman\TelegramBot\TelegramLog::initDebugLog(__DIR__ . "/{$bot_username}_debug.log");
    Longman\TelegramBot\TelegramLog::initUpdateLog(__DIR__ . "/{$bot_username}_update.log");

    $telegram->enableLimiter();
    
    $post = json_decode(Request::getInput(), true);


    $oUpdate = new Update($post, $bot_username);
    $oMessage = $oUpdate->getMessage();

 
    $sText = $oMessage->getText();
    if (strpos($sText, '@'.$yourUsername) !== false || (isset($post['reply_to_message']) && $post['reply_to_message']['from']['username'] == $yourUsername)) {
      $data = []; 
      $data['chat_id'] = $yourChatId;
  		$data['text'] = 'Neue Nachricht in: '.$oMessage->getChat()->getTitle()."\n\nVon: @".$oMessage->getFrom()->getUsername()." (".$oMessage->getFrom()->getFirstName().")\nNachricht:\n".$sText;
      return Request::sendMessage($data);
    }
    return Request::emptyResponse();
 
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    //echo $e;
    // Log telegram errors
    Longman\TelegramBot\TelegramLog::error($e);
} catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
    // Silence is golden!
    // Uncomment this to catch log initialisation errors
    //echo $e;
}