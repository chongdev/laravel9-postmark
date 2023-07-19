<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InboxController extends Controller
{
    function index()
    {
        $endpointURL = "https://api.postmarkapp.com";
        $apiKey = env('POSTMARK_TOKEN');
        $streamId = env('POSTMARK_MESSAGE_STREAM_ID');

        $page = 1;
        $perPage = 50;
        $offset = ($page - 1) * $perPage;

        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "{$endpointURL}/messages/{$streamId}?count={$perPage}&offset={$offset}",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    "X-Postmark-Server-Token: {$apiKey}"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $jsonResponse = json_decode($response, 1);

            $messageList = $jsonResponse['Messages'] ?? [];
            // dd($messageList);
            return view('inbox', compact('messageList'));
        } catch (\Throwable $th) {
            dd('Failed', $th);
        }
    }


    function send(Request $request)
    {
        $request->validate([
            'to' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        try {
            $emailTo = $request->to; // 'sales@uchoosetour.com';
            Mail::to($request->to)->send(new TestMail($request->subject, $request->message));

            return back()->with('success', 'Email sent successfully!');
        } catch (\Throwable $th) {
            //throw $th;

            return back()->with('error', 'Email sent failed!');
        }
    }
}
