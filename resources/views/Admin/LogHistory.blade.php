<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Log History') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-3/4 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-200 rounded rounded-full mb-2">
                            <tr>
                                <th>No</th>
                                <th>IP Address</th>
                                <th>Hostname</th>
                                <th>Username</th>
                                <th>SSH Port</th>
                                <th>Status</th>
                                <th>Date Created</th>
                            </tr> 
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="py-12">
        <div class="max-3/4 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Command Output</h2>
    
                    @foreach ($outputData as $ip => $output)
                        <h3>Output for {{ $ip }}:</h3>
                        <pre>{{ $output }}</pre>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
