<?php

namespace App\Http\Controllers;
use App\Models\AddDeviceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // Admin view controller
    public function addNewDevice() {
        return view('Admin/addNewDevice');
    }
    public function ListDevice() {
        $data = addDeviceModel::all();

        return view('Admin/ListDevice', compact('data'));
    }
    public function TerminalConfiguration() {
        $data = addDeviceModel::all();

        return view('Admin/TerminalConfiguration', compact('data'));
    }
    public function LogHistory() {
        return view('Admin/LogHistory');
    }
    // end view controller


    // Admin CRUD Controller
    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'ipaddress' => 'required|ip',
                'hostname' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'password' => 'required|string',
                'sshport' => 'nullable|integer',
            ]);
    
            AddDeviceModel::create($validatedData);
            return redirect()->route('listdevice')->with('success', 'Device added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('listdevice')->with('error', 'Device could not be added: ' . $e->getMessage());
        }
    }
    

    public function edit($id) {
         $data = addDeviceModel::findOrFail($id);

         return view('Admin/editDevice', compact('data'));
    }

    public function update(Request $request, $id) {
        try {
            $validatedData = $request->validate([
                'ipaddress' => 'required|ip',
                'hostname' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'password' => 'required|string',
                'sshport' => 'nullable|integer',
            ]);
    
            $data = AddDeviceModel::findOrFail($id);
            $data->update($validatedData);
            return redirect()->route('listdevice')->with('success', 'Device edited successfully.');
        } catch (\Exception $e) {
            return redirect()->route('listdevice')->with('error', 'Device could not be edited: ' . $e->getMessage());
        }
    }
    

    public function destroy($id) {
        try {
            $data = AddDeviceModel::findOrFail($id);
            $data->delete();
            return redirect()->route('listdevice')->with('success', 'Device deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('listdevice')->with('error', 'Device could not be deleted: ' . $e->getMessage());
        }
    }
}
