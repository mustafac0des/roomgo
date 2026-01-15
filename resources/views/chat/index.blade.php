@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 bg-[#9A616D] border-b border-gray-200">
            <h1 class="text-xl font-bold text-white font-['Outfit']">Chat with Support</h1>
        </div>
        
        <div class="p-6">
            <form id="chat-form" class="space-y-4">
                @csrf
                <div>
                     <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Message</label>
                    <div class="flex gap-2">
                        <input type="text" id="message" name="message" required
                               class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-[#9A616D] focus:border-[#9A616D] transition sm:text-sm"
                               placeholder="Type your question here...">
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-[#9A616D] hover:bg-[#854d58] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#9A616D] transition">
                            Send
                        </button>
                    </div>
                </div>
            </form>

            <div id="response" class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-100 text-gray-700 min-h-[100px] hidden">
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('chat-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const messageInput = document.getElementById('message');
    const message = messageInput.value;
    const responseDiv = document.getElementById('response');
    
    // Show loading state (optional)
    responseDiv.classList.remove('hidden');
    responseDiv.innerText = 'Thinking...';

    fetch('{{ route('chat') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message: message })
    })
    .then(response => response.json())
    .then(data => {
        responseDiv.innerText = data.response;
        messageInput.value = ''; // Clear input
    })
    .catch(error => {
        console.error('Error:', error);
        responseDiv.innerText = 'Sorry, something went wrong. Please try again.';
        responseDiv.classList.add('text-red-600');
    });
});
</script>
@endsection
