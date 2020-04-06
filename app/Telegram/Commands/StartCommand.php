<?php


namespace App\Telegram\Commands;


use App\UsersTelegram;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class StartCommand extends Command
{

    protected $name = 'start';

    protected $description = 'submit data';

    /**
     * @inheritDoc
     */
    public function handle($arguments)
    {
        $forom_id = request('message.chat.id');
        $data = UsersTelegram::where('Usr_ChatId',$forom_id)->first();

        if (!$data) {
            $user = UsersTelegram::firstOrCreate([
                'Usr_ChatId' => request('message.chat.id'),
                'Usr_FName' => request('message.chat.first_name'),
                'Usr_LName' => request('message.chat.username'),
            ]);

        }

        $first_name = request('message.chat.first_name');
        $text = " سلام $first_name
            به ربات تلگرام شرکت تخصصی سفرهای رادینا خوش آمدید 😍

            لطفا برای شروع یکی از گزینه های زیر را انتخاب کنید 👇🏻";
        $keyboard = [
            ['امتیازهای شما','شارژ رایگان']
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);

        Telegram::sendMessage([
            'chat_id' => $forom_id,
            'text' => $text,
            'reply_markup' => $reply_markup,
        ]);

    }
}
