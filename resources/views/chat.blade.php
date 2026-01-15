<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with ChatGPT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Chat with ChatGPT</h1>
    <form id="chat-form">
        <input type="text" id="message" name="message" placeholder="Type your message here">
        <button type="submit">Send</button>
    </form>
    <div id="chat-box"></div>

    <script>
        document.getElementById('chat-form').addEventListener('submit', async function(event) {
            event.preventDefault();
            const message = document.getElementById('message').value;
            const response = await fetch('/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message })
            });
            const data = await response.json();
            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML += `<p><strong>You:</strong> ${message}</p>`;
            chatBox.innerHTML += `<p><strong>ChatGPT:</strong> ${data.response}</p>`;
            document.getElementById('message').value = '';
        });
    </script>
</body>
</html>
