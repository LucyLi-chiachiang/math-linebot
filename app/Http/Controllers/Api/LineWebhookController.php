<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;


class LineWebhookController extends Controller
{
    //
    public function webhook (Request $request)
    {
        $httpClient = new CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $bot = new LINEBot($httpClient, [
            'channelSecret' => env('LINE_CHANNEL_SECRET')
        ]);

        //Signature Validation
        $signature = $request->header(LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
        if(!$signature) {
            return $this->http403();
        }

        try {
            $bot->parseEventRequest($request->getContent(), $signature);
        } catch (LINEBot\Exception\InvalidSignatureException $exception) {
            return $this->http403();
        } catch (LINEBot\Exception\InvalidEventRequestException $exception) {
            return $this->http403();
        }

        $events = $request->events;
        foreach ($events as $event) {
            logger(json_encode($event));
        }
        return $this->http200('done');
    }

    private function http403()
    {
        abort(403);
    }

    private function http200($string)
    {
        return response($string, 200);
    }
}
