<?php

namespace App\Http\Controllers;

use App\UsersTelegram;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function telegram()
    {
        Telegram::setwebhook(['url' => 'https://20ba014f.ngrok.io/516823442:AAHGu7Ob-0SrThiwYkzf11phgHtWUC8Z35Q/webhook']);
    }

    public function webhook()
    {
        Telegram::commandsHandler(true);

        $from_id = request('message.from.id');
        $data = UsersTelegram::all()->where('Usr_ChatId', $from_id );


        switch (request('message.text'))
        {
            case 'امتیازهای شما':
                return $this->user_score();

                break;

            case 'شارژ رایگان':
                return $this->gift();

                break;

        }
    }

    private function user_score()
    {
       $users = UsersTelegram::latest()->take(5)->get();
       $add = request('message.new_chat_members');

       if ($users)
       {
           $text = '';


           foreach ($users as $user)
           {
               $text .= $user->Usr_LName . "\n";
           }

           Telegram::sendMessage([
            'chat_id' => request('message.chat.id'),
            'text' => $text,
        ]);
       }

       else
       {
           Telegram::sendMessage([
            'chat_id' => request('message.chat.id'),
            'text' => 'No User',
        ]);
       }
    }

    private function gift()
    {
    }
}
