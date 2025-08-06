<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HikvisionEventService;
use Carbon\Carbon;

class ReportsController extends Controller
{
    //
    // This controller will handle the reports logic
    // It will interact with the HikvisionEventService to fetch events
    // and return them in a suitable format for the frontend.

    protected HikvisionEventService $eventService;

    public function __construct(HikvisionEventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function getAcsEvents(Request $request)
    {
        $deviceIp = $request->input('device_ip');

        if (!$deviceIp) {
            return response()->json(['error' => 'Device IP is required'], 400);
        }

        $params = [
            "AcsEventCond" => [
                "searchID" => $request->input('search_id', 'default-search-id'),
                "searchResultPosition" => $request->input('search_result_position', 0),
                "maxResults" => $request->input('max_results', 200),
                "major" => $request->input('major', 0),
                "minor" => $request->input('minor', 0),
                "startTime" => $request->input('start_time', Carbon::now()->subDay()->toIso8601String()),
                "endTime" => $request->input('end_time', Carbon::now()->toIso8601String()),
                "timeReverseOrder" => $request->input('time_reverse_order', true)
            ]
        ];


        $events = $this->eventService->getEvents($params, $deviceIp);

        return response()->json($events);
    }
}
