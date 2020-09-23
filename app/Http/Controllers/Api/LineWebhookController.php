<?php

namespace App\Http\Controllers\Api;


use App\Services\CreateLineBot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ReflectionException;


class LineWebhookController extends Controller
{
    //
    public function webhook(Request $request, CreateLineBot $createLineBot)
    {
        $bot = $createLineBot->create($request);

        $events = $request->events;
        foreach ($events as $event) {
            // 不是訊息的event先不處理
            if ($event['type'] != 'message') continue;
            $messageType = $event['message']['type'];
            $message = $event['message']['text'];

            // 不是文字訊息的類型先不處理
            if ($messageType != 'text') continue;

            try {
                $response = $bot->replyText($event['replyToken'], $message);
                if ($response->isSucceeded()) {
                    logger('reply successfully');
                    return $this->http200('send success');
                }
            } catch (ReflectionException $e) {
            }

        }
        return $this->http200('done');
    }

    private function http200($string)
    {
        return response($string, 200);
    }
}
