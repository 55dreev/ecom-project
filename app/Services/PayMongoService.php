<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PayMongoService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('PAYMONGO_API_KEY');  // Use environment variable for security
    }

    public function createPaymentLink($amount, $description, $remarks)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Basic ' . $this->apiKey,
            'content-type' => 'application/json',
        ])->post('https://api.paymongo.com/v1/links', [
            'data' => [
                'attributes' => [
                    'amount' => $amount,
                    'description' => $description,
                    'remarks' => $remarks,
                ]
            ]
        ]);

        $responseData = $response->json();

        if (isset($responseData['data']['attributes']['checkout_url'])) {
            return $responseData['data']['attributes']['checkout_url'];
        }

        return null;
    }
}
