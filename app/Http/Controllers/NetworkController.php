<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddDeviceModel;
use Illuminate\Support\Facades\Log;
use phpseclib3\Net\SSH2;

class NetworkController extends Controller
{
    public function executeCommands(Request $request) {
        $deviceIds = $request->input('device_ids');
        $commands = $request->input('commands');
    
        $outputData = [];
    
        // Pastikan deviceIds adalah array
        if (!is_array($deviceIds)) {
            Log::error('Device IDs input is not an array.');
            return redirect()->back()->withErrors(['message' => 'No devices selected.']);
        }
    
        foreach ($deviceIds as $deviceId) {
            $device = AddDeviceModel::find($deviceId);
    
            if ($device) {
                $output = $this->runCommandOnDevice($device, $commands);
                $outputData[$device->ipaddress] = $output;
            } else {
                Log::error("Device with ID {$deviceId} not found.");
            }
        }
    
        return view('Admin/LogHistory', ['outputData' => $outputData]);
    }
    
    


    private function runCommandOnDevice($device, $commands) {
        $output = '';
        $ssh = new SSH2($device->ipaddress, $device->sshport);
    
        if (!$ssh->login($device->username, $device->password)) {
            Log::error("Failed to connect to {$device->ipaddress}");
            return "Connection failed";
        }
    
        // Menjalankan perintah
        $output = $ssh->exec($commands);
        return $output;
    }
    
    
}
