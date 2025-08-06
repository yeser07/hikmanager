<?php

namespace App\Http\Controllers\Devices;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Device;

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
            return response()->json($device);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Device not found'], 404);
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
            $device->delete();
            return response()->json(['message' => 'Device deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete device'], 500);
        }
    }


}
