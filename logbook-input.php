<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

// 1. Get Cookie by Login
$cookie = '';
// 2. Get LogBookID by Opening the LogBook, check Payload
$logBookHeader = '';
// 3. Change MONTH
$selectedMonth = ''; // (01, 02, 03, 04, 05, .....)

for ($i = 1; $i <= 31; $i++) {
    try {
        $client = new Client();
        $headers = [
            'Accept' => '*/*',
            'Accept-Language' => 'en-US,en;q=0.9',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Cookie' => $cookie,
            'Origin' => 'https://activity-enrichment.apps.binus.ac.id',
            'Pragma' => 'no-cache',
            'Referer' => 'https://activity-enrichment.apps.binus.ac.id/LearningPlan/StudentIndex',
            'Sec-Fetch-Dest' => 'empty',
            'Sec-Fetch-Mode' => 'cors',
            'Sec-Fetch-Site' => 'same-origin',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',
            'X-Requested-With' => 'XMLHttpRequest',
            'sec-ch-ua' => '"Google Chrome";v="125", "Chromium";v="125", "Not.A/Brand";v="24"',
            'sec-ch-ua-mobile' => '?0',
            'sec-ch-ua-platform' => '"Windows"'
        ];

        $job = [
            'Melakukan API Integration terhadap API Partner Airpaz',
            'Melakukan API Integration terhadap API Partner Airpaz',
            'Melakukan API Integration terhadap API Partner Airpaz',
            'Melakukan API Integration terhadap API Partner Airpaz',
            'Melakukan API Integration terhadap API Partner Airpaz',
            'Melakukan Web Scrapping terhadap Website Partner',
            'Melakukan Web Scrapping terhadap Website Partner',
            'Memperbaiki Bug',
            'Memperbaiki Bug',
            'Memperbaiki Bug',
        ];
        $desc = $job[array_rand($job)];

        $date = "2024-" . $selectedMonth . "-" . str_pad($i, 2, '0', STR_PAD_LEFT) . "T00:00:00";

        $body = [
            "model" => [
                "ID" => "00000000-0000-0000-0000-000000000000",
                "LogBookHeaderID" => $logBookHeader,
                "Date" => $date,
                "Activity" => "Kerja",
                "ClockIn" => '07:00 am',
                "ClockOut" => '05:30 pm',
                "Description" => $desc,
                "flagjulyactive" => false
            ]
        ];

        $convertedBody = json_encode($body);
        $convertedBody = json_decode($convertedBody, true);
        $convertedBody = http_build_query($convertedBody);

        $request = new Request('POST', 'https://activity-enrichment.apps.binus.ac.id/LogBook/StudentSave', $headers, $convertedBody);
        $res = $client->sendAsync($request)->wait();
        var_dump($res->getBody());
        var_dump($i);
    } catch (\Throwable $th) {
        var_dump($th);
        return;
    }
}
