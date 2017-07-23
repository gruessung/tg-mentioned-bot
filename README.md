# tg-mentioned-bot


## Install instructions:

### Require this package with Composer

Install this package through [Composer](https://getcomposer.org/).
Edit your project's `composer.json` file to require
`longman/telegram-bot`.

Create *composer.json* file
```json
{
    "name": "yourproject/yourproject",
    "type": "project",
    "require": {
        "php": ">=5.6",
        "longman/telegram-bot": "*"
    }
}
```
and run `composer update`

**or**

run this command in your command line:

```bash
composer require longman/telegram-bot
```

## add tg-mentioned-bot
Clone index.php of this project and put it on your server.

See README from  https://github.com/php-telegram-bot/core to create a telegram bot with @botfather and create set.php to connect telegrams bot engine to your webhook url.

Open index.php and set following vars:

* bot_apikey = API Key given by @botfather
* bot_username = username you select for your bot
* yourUsername = your own telegram username. the bot use this to listen for mentions
* yourChatid = your own chatId 

## Your filesystem should look like this
![fileSystemPicture](http://img.gruessung.eu/?f=1500738194.png)
