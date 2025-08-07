<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HikvisionEventService
{
    protected string $url = 'https://192.168.100.62/ISAPI/AccessControl/AcsEvent?format=json';
    protected string $username;
    protected string $password;

    public function __construct()
    {
        $this->username = env('HIKVISION_USERNAME');
        $this->password = env('HIKVISION_PASSWORD');
    }

    public function getEvents(array $params, $deviceIp): array
    {
        
        $this->url = 'https://' . $deviceIp . '/ISAPI/AccessControl/AcsEvent?format=json';

        try {
            $response = Http::withDigestAuth($this->username, $this->password)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->withoutVerifying()
                ->post($this->url, $params);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Error al obtener eventos Hikvision', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'message' => 'Error al obtener eventos',
                'status' => $response->status(),
                'body' => $response->body(),
            ];
        } catch (\Exception $e) {
            Log::error('Excepción en HikvisionEventService', ['error' => $e->getMessage()]);

            return [
                'success' => false,
                'message' => 'Excepción: ' . $e->getMessage(),
            ];
        }
    }
}




