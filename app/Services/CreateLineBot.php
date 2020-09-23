<?php


namespace App\Services;


use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class CreateLineBot
{
    public function __construct()
    {
    }

    public function create(Request $request)
    {
        $httpClient = new CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $bot = new LINEBot($httpClient, [
            'channelSecret' => env('LINE_CHANNEL_SECRET')
        ]);

        //Signature Validation
        $signature = $request->header(LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
        if (!$signature) {
            abort(403);
        }
        try {
            $bot->parseEventRequest($request->getContent(), $signature);
        } catch (LINEBot\Exception\InvalidSignatureException $exception) {
            abort(403);
        } catch (LINEBot\Exception\InvalidEventRequestException $exception) {
            abort(403);
        }

        return $bot;
    }

}
