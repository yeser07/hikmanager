<?php

namespace App\Http\Controllers\Devices;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Device;
use Inertia\Inertia;

class DeviceController extends Controller
{
    //
    // This controller will handle the device management logic
    // It will interact with the Device model to perform CRUD operations
    // and return the necessary data to the frontend.

    public function getDevices(Request $request){
        try {
            $devices = Device::all();
            return response()->json($devices);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch devices'], 500);
        }
    }
    public function getDevice($id)
    {
        try {
            $device = Device::findOrFail($id);

            if (!$device) {
                return Inertia::render('devices',
                    [
                        'error' => 'Device not found',
                    ]
                );
            }

            //send divice as prop to the CreateDevice component

            return Inertia::render('devices/CreateDevice', [
                'device' => $device,
            ]);

        } catch (\Exception $e) {
            return Inertia::render('devices',
                [
                    'error' => 'Failed to fetch device: ' . $e->getMessage(),
                ]
            );
        }
    }


    public function createDevice(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'operation' => 'required|string|max:255',
            'ip_address' => 'required|ip',
        ]);

        try {
            $device = Device::create($data);
            return response()->json($device, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create device: ' . $e->getMessage()], 500);
        }
    }
    public function updateDevice(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'location' => 'sometimes|required|string|max:255',
            'operation' => 'sometimes|required|string|max:255',
            'ip_address' => 'sometimes|required|ip',
        ]);

        try {
            $device = Device::findOrFail($id);
            $device->update($data);
            return response()->json($device);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update device'], 500);
        }
    }
    public function deleteDevice($id)
    {
        try {
            $device = Device::findOrFail($id);
            if(!$device){
                return Inertia::render('devices',
                    [
                        'error' => 'Device not found',
                    ]
                );
            }
            $device->delete();

            return Inertia::render('devices/Index', [
                'message' => 'Device deleted successfully',
            ]);

        } catch (\Exception $e) {
            return Inertia::render('devices',
                [
                    'error' => 'Failed to delete device: ' . $e->getMessage(),
                ]
            );
        }
    }


}
