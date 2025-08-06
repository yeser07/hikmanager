
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HikvisionEventService
{
    protected string $url = 'https://192.168.100.62/ISAPI/AccessControl/AcsEvent?format=json';

    protected string $username = env('HIKVISION_USERNAME');
    protected string $password = env('HIKVISION_PASSWORD');






////https://192.168.100.62/ISAPI/AccessControl/AcsEvent?format=json enpoint

////PARAMS
/*{
  "AcsEventCond": {
    "searchID": "test-search-id-001",
    "searchResultPosition": 0,
    "maxResults": 200,
    "major": 0,
    "minor": 0,
    "startTime": "2025-08-04T00:00:00-06:00",
    "endTime": "2025-08-04T23:59:59-06:00",
    "timeReverseOrder": true
  }
}*/


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









