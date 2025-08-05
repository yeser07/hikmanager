<?php

namespace App\Http\Services


class HikAcsEventServices
{

  
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

public function getAcsEvents($deviceIp,$startTime,$endTime,$maxResults)
{

  $url = 'https://'+$deviceIp+'/ISAPI/AccessControl/AcsEvent?format=json'

  $client = new GuzzleHttp\Client(['verify' => false ]);

  try
}



  
}








