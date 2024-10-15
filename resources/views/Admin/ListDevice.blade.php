<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actived Devices') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div id="successMessage" class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div id="errorMessage" class="bg-red-500 text-white p-4 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="flex justify-end text-end mb-3">
                        <a href="{{route('addnewdevice')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Add Device</a>
                    </div>
                    <table class="w-full table-auto">
                        <thead class="bg-gray-200 rounded rounded-full mb-2">
                            <tr>
                                <th>No</th>
                                <th>IP Address</th>
                                <th>Hostname</th>
                                <th>Username</th>
                                <th>SSH Port</th>
                                <th>Date Created</th>
                                <th>Last Update</th>
                                <th>Actions</th>
                            </tr> 
                        </thead>
                        <tbody>
                            @php
                                    $no = 1;      
                            @endphp
                            
                            @foreach ($data as $a )    
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$a->ipaddress}}</td>
                                <td>{{$a->hostname}}</td>
                                <td>{{$a->username}}</td>
                                <td>{{$a->sshport}}</td>
                                <td>{{$a->created_at}}</td>
                                <td>{{$a->updated_at}}</td>
                                <td>
                                    <a href="{{ route('devices.edit', $a->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-sm py-0 px-4 rounded-full inline-block">Edit</a>
                                    <form action="{{ route('devices.destroy', $a->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-sm py-0 px-4 rounded-full inline-block m-1">Delete</button>
                                    </form>
                                </td>                                                          
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 5000);
    }

    const errorMessage = document.getElementById('error-message');
    if (errorMessage) {
        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, 5000);
    }
</script>