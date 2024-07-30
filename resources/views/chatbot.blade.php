<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .chat-container {
            max-width: 600px;
            margin: 50px auto;
        }
        .chat-box {
            height: 400px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .chat-message {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container chat-container">
        <h2>Chatbot</h2>
        <div id="chat-box" class="chat-box">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="input-group mb-3">
            <input type="text" id="user-input" class="form-control" placeholder="Type your message here...">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="send-button">Send</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#send-button').click(function() {
                var userInput = $('#user-input').val();
                if (userInput.trim() === '') {
                    return;
                }

                // Append user's message to chat box
                $('#chat-box').append('<div class="chat-message"><strong>You:</strong> ' + userInput + '</div>');
                $('#user-input').val('');

                // Send the message to the chatbot
                $.ajax({
                    url: '{{ url("/chatbot") }}',
                    type: 'POST',
                    data: {
                        text: userInput,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#chat-box').append('<div class="chat-message"><strong>Bot:</strong> ' + response.response + '</div>');
                        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                    }
                });
            });

            // Send message on Enter key press
            $('#user-input').keypress(function(e) {
                if (e.which == 13) {
                    $('#send-button').click();
                }
            });
        });
    </script>
</body>
</html>
