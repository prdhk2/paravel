<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Command Prompt') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-3/4 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('execute.commands') }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap">
                            <button type="button" onclick="toggleSelectAll()" class="hover:text-white font-bold bg-gray-300 hover:bg-gray-400 h-8 w-40 rounded-full m-2">
                                Select All
                            </button>
                            @foreach ($data as $device)        
                                <div class="flex box-border border-gray-300 hover:border-blue-500 h-8 w-40 border-4 rounded-full m-2 items-center justify-start">
                                    <input type="checkbox" name="device_ids[]" value="{{ $device->id }}" class="rounded-full m-2">
                                    <p class="text-center">{{ $device->ipaddress }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <label for="commands" class="block">Commands:</label>
                            <textarea id="commands" name="commands" rows="4" class="w-full border rounded p-2" required></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-4">Execute Commands</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('executeCommand').addEventListener('click', function() {
        const command = document.getElementById('commands').value;
        const selectedIPs = Array.from(document.querySelectorAll('input[name="device_ids[]"]:checked')).map(input => input.value);
    
        fetch('/execute-command', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ command, ips: selectedIPs })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('output').innerHTML = `<pre>${data.output}</pre>`;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    function toggleSelectAll() {
        const checkboxes = document.querySelectorAll('input[name="device_ids[]"]');
        const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
        
        checkboxes.forEach(checkbox => {
            checkbox.checked = !allChecked;
        });
    }
</script>
