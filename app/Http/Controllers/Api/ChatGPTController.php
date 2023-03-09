<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\HttpFoundation\Response;

class ChatGPTController extends Controller
{
    public function getResponse(Request $request){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
            CURLOPT_SSL_VERIFYPEER => false, // Add If local
            CURLOPT_SSL_VERIFYHOST => false, // Add If local
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "model": "gpt-3.5-turbo",
                "messages": [
                    {
                        "role": "user", 
                        "content": "Write me an email response to this \"'.$request->prompt.'\""
                    }
                ]
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.config('app.chat_gpt_key')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return response()->json([
            'data' => array(
                'response' => json_decode($response)
            )
        ], Response::HTTP_OK);
    }
}
