<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TranslateController extends Controller
{
    //
    public function home()
    {
        return view('home');
    }

    public function translate(Request $request)
    {
        $sourceLanguage = $request->input('sourceLanguage');
        $targetLanguage = $request->input('targetLanguage');
        $query = urlencode($request->input('inputText'));

        // dd($sourceLanguage.' '.$targetLanguage);
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://free-google-translator.p.rapidapi.com/external-api/free-google-translator?from={$sourceLanguage}&to={$targetLanguage}&query={$query}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                'translate' => 'rapidapi',
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'x-rapidapi-host: free-google-translator.p.rapidapi.com',
                'x-rapidapi-key: 19712ae800msh39302756eeef1abp1b8019jsnc7967b2210ac',
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo 'cURL Error #:'.$err;
        }

        $data = json_decode($response, true);

        $translated_text = $data['translation'];

        return view('home', compact('translated_text'));
    }
}
