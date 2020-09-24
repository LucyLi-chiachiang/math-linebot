<?php

namespace App\Services;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class CreateLineBot
{

    public function create($signature, $content)
    {
        $httpClient = new CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $bot = new LINEBot($httpClient, [
            'channelSecret' => env('LINE_CHANNEL_SECRET')
        ]);

        //Signature validation
        if (!$signature) {
            abort(403);
        }
        try {
            $bot->parseEventRequest($content, $signature);
        } catch (LINEBot\Exception\InvalidSignatureException $exception) {
            abort(403);
        } catch (LINEBot\Exception\InvalidEventRequestException $exception) {
            abort(403);
        }

        return $bot;
    }

}
