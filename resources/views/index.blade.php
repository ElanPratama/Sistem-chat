<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .chat-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .chat-box {
            height: 400px;
            padding: 20px;
            overflow-y: scroll;
            border-bottom: 1px solid #ddd;
        }
        .message {
            margin: 10px 0;
        }
        .user-message {
            text-align: right;
        }
        .bot-message {
            text-align: left;
        }
        .message p {
            display: inline-block;
            padding: 10px;
            border-radius: 10px;
            max-width: 80%;
        }
        .user-message p {
            background-color: #0084ff;
            color: #fff;
        }
        .bot-message p {
            background-color: #f1f0f0;
        }
        .input-container {
            display: flex;
            padding: 10px;
            align-items: center;
        }
        input[type="text"], input[type="file"] {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 4px;
            outline: none;
        }
        input[type="file"] {
            margin-right: 10px;
        }
        button {
            background-color: #0084ff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #006bb3;
        }
        /* Styling for the product card */
        .product-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 10px;
        }
        .product-card img {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .product-card .product-info {
            text-align: center;
        }
        .product-card .product-info h3 {
            margin: 5px 0;
            font-size: 18px;
        }
        .product-card .product-info p {
            font-size: 14px;
            color: #777;
        }
        /* Sender info styling */
        .sender-info {
            font-size: 12px;
            color: #888;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div id="chat-box" class="chat-box">
            <!-- Product image and messages will appear here -->
        </div>
        <div class="input-container">
            <input type="text" id="user-input" placeholder="Type a message...">
            <input type="file" id="file-input">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        // Function to display initial product card
        function displayProductCard() {
            const chatBox = document.getElementById('chat-box');
            const product = {
                name: "Product A",
                id: 12456,
                image_url: "https://picsum.photos/id/237/200/300"
            };

            const productCardDiv = document.createElement('div');
            productCardDiv.classList.add('message', 'bot-message');
            productCardDiv.innerHTML = `
                <div class="product-card">
                    <img src="${product.image_url}" alt="${product.name}">
                    <div class="product-info">
                        <h3>${product.name}</h3>
                        <p>ID: ${product.id}</p>
                    </div>
                </div>
                <p>Here is Product A that might interest you.</p>
            `;
            chatBox.appendChild(productCardDiv);
            chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom
        }

        // Fetch JSON data from the provided URL
        async function fetchChatData() {
            displayProductCard(); // Display product card before fetching chat data

            try {
                const response = await fetch('https://gist.githubusercontent.com/asharijuang/23745f3132fa30e666db68d2bf574e4a/raw/5d556dbb9c2aea9fdf3e1ec96e45f62a88cea7b6/chat_response.json');
                const data = await response.json();
                displayMessages(data.results[0].comments);
            } catch (error) {
                console.error('Error fetching chat data:', error);
            }
        }

        // Function to display messages in the chat box
        function displayMessages(messages) {
            const chatBox = document.getElementById('chat-box');
            messages.forEach(msg => {
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('message');
                messageDiv.classList.add(msg.sender === 'customer@mail.com' ? 'user-message' : 'bot-message');
                messageDiv.innerHTML = `
                    <div class="sender-info">${msg.sender === 'customer@mail.com' ? 'King Customer' : 'Agent A'}</div>
                    <p>${msg.message}</p>
                `;
                chatBox.appendChild(messageDiv);
            });
            chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom
        }

        // Function to send user message and handle file upload
        function sendMessage() {
            const chatBox = document.getElementById('chat-box');
            const userInput = document.getElementById('user-input');
            const fileInput = document.getElementById('file-input');
            const message = userInput.value.trim();
            const file = fileInput.files[0];

            if (message || file) {
                // Display user message or file
                const userMessageDiv = document.createElement('div');
                userMessageDiv.classList.add('message', 'user-message');

                userMessageDiv.innerHTML = `
                    <div class="sender-info">You</div>
                    <p>${message ? message : file.name}</p>
                `;

                chatBox.appendChild(userMessageDiv);

                // Trigger automatic bot response
                setTimeout(() => {
                    botResponse(message || file);
                }, 1000);

                userInput.value = ''; // Clear the input
                fileInput.value = ''; // Clear the file input
                chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom
            }
        }

        // Function to generate an automatic bot response
        function botResponse(userMessageOrFile) {
            const chatBox = document.getElementById('chat-box');
            const botMessageDiv = document.createElement('div');
            botMessageDiv.classList.add('message', 'bot-message');

            botMessageDiv.innerHTML = `
                <div class="sender-info">Agent A</div>
                <p>${typeof userMessageOrFile === 'string' ? 'Baik akan saya proses.' : 'Bot received your file.'}</p>
            `;

            chatBox.appendChild(botMessageDiv);
            chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom
        }

        // Fetch and display chat data when the page loads
        fetchChatData();
    </script>
</body>
</html>
