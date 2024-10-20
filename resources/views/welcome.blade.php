<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chat-container {
            width: 100%;
            max-width: 800px;
            height: 90vh;
            display: flex;
            flex-direction: column;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-photo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-name {
            font-size: 16px;
            font-weight: bold;
        }

        .nav-icons {
            display: flex;
            align-items: center;
        }

        .nav-icon {
            width: 30px;
            height: 30px;
            margin-left: 15px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .nav-icon:hover {
            transform: scale(1.1);
        }

        .chat-box {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            border-bottom: 1px solid #ddd;
            background-image: url('https://i.pinimg.com/originals/87/93/b7/8793b7f3009c87baf350de82a5f72423.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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
            background-color: #DCF8C6;
            color: #000;
        }

        .bot-message p {
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .input-container {
            display: flex;
            padding: 10px;
            align-items: center;
            border-top: 1px solid #ddd;
            background-color: #fff;
        }

        input[type="text"] {
            flex: 1;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 25px;
            outline: none;
            font-size: 14px;
            transition: all 0.3s ease;
            margin-right: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        input[type="text"]:focus {
            border-color: #0084ff;
            box-shadow: 0 0 8px rgba(0, 132, 255, 0.3);
        }

        input[type="file"] {
            display: none;
        }

        .file-label {
            padding: 10px 15px;
            background-color: #f4f4f9;
            border-radius: 25px;
            cursor: pointer;
            border: 2px solid #ddd;
            transition: background-color 0.3s ease;
            font-size: 14px;
            margin-right: 10px;
        }

        .file-label:hover {
            background-color: #e0e0e0;
        }

        button {
            background-color: #0084ff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 25px;
            cursor: pointer;
            outline: none;
            transition: background-color 0.3s ease;
            font-size: 14px;
        }

        button:hover {
            background-color: #006bb3;
        }

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
            font-size: 24px;
        }

        .product-card .product-info p {
            font-size: 14px;
            color: #777;
        }

        .sender-info {
            font-size: 12px;
            color: #888;
            margin-bottom: 5px;
        }

        @media (max-width: 600px) {
            .chat-container {
                max-width: 100%;
                height: 100vh;
            }

            .input-container {
                flex-direction: row;
                padding: 5px;
            }

            input[type="text"] {
                margin-bottom: 0;
                width: auto;
            }

            button {
                width: auto;
            }

            .file-label {
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <!-- Navbar -->
        <div class="navbar">
            <div class="user-info">
                <img src="https://i.pinimg.com/originals/87/93/b7/8793b7f3009c87baf350de82a5f72423.jpg" alt="User Photo" class="user-photo">
                <span class="user-name">Agen</span>
            </div>
            <div class="nav-icons">
                <img src="https://img.icons8.com/ios-filled/50/000000/video-call.png" alt="Video Call" class="nav-icon">
                <img src="https://img.icons8.com/ios-filled/50/000000/phone.png" alt="Phone" class="nav-icon">
                <img src="https://img.icons8.com/ios-filled/50/000000/settings.png" alt="Settings" class="nav-icon">
            </div>
        </div>

        <div id="chat-box" class="chat-box">

        </div>
        <div class="input-container">
            <input type="text" id="user-input" placeholder="Type a message...">
            <label for="file-input" class="file-label">Upload File</label>
            <input type="file" id="file-input">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
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
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        async function fetchChatData() {
            displayProductCard();

            try {
                const response = await fetch('https://gist.githubusercontent.com/asharijuang/23745f3132fa30e666db68d2bf574e4a/raw/5d556dbb9c2aea9fdf3e1ec96e45f62a88cea7b6/chat_response.json');
                const data = await response.json();
                displayMessages(data.results[0].comments);
            } catch (error) {
                console.error('Error fetching chat data:', error);
            }
        }

        function displayMessages(messages) {
    const chatBox = document.getElementById('chat-box');
    messages.forEach(msg => {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message');
        messageDiv.classList.add(msg.sender === 'customer@mail.com' ? 'user-message' : 'bot-message');

        let content;
        if (msg.type === "text") {
            content = `<p>${msg.message}</p>`;
        } else if (msg.type === "image") {
            content = `<p>${msg.message}</p><img src="${msg.file_url}" alt="Image" style="max-width: 100%;">`;
        } else if (msg.type === "video") {
            content = `<p>${msg.message}</p><video controls style="max-width: 100%;"><source src="${msg.file_url}" type="video/mp4">Your browser does not support the video tag.</video>`;
        } else if (msg.type === "pdf") {
            content = `<p>${msg.message}</p><a href="${msg.file_url}" target="_blank">Download PDF</a>`;
        }

        messageDiv.innerHTML = `
            <div class="sender-info">${msg.sender === 'customer@mail.com' ? 'King Customer' : 'Agent A'}</div>
            ${content}
        `;
        chatBox.appendChild(messageDiv);
    });
    chatBox.scrollTop = chatBox.scrollHeight;
}


function sendMessage() {
    const chatBox = document.getElementById('chat-box');
    const userInput = document.getElementById('user-input');
    const fileInput = document.getElementById('file-input');
    const message = userInput.value.trim();
    const file = fileInput.files[0];

    if (message || file) {
        const userMessageDiv = document.createElement('div');
        userMessageDiv.classList.add('message', 'user-message');

        let messageContent = message;
        if (file) {
            messageContent = `File: ${file.name}`;
            const fileUrl = URL.createObjectURL(file);
            messageContent += `<br><a href="${fileUrl}" download>Download File</a>`;
        }

        userMessageDiv.innerHTML = `
            <div class="sender-info">You</div>
            <p>${messageContent}</p>
        `;

        chatBox.appendChild(userMessageDiv);

        setTimeout(() => {
            const botMessage = {
                "id": 885520,
                "type": "text",
                "message": "Terima kasih, bukti pembayaran sudah diterima",
                "sender": "agent@mail.com"
            };

            botResponse(botMessage);
        }, 1000);

        userInput.value = '';
        fileInput.value = '';
        chatBox.scrollTop = chatBox.scrollHeight;
    }
}


function botResponse(botMessage) {
    const chatBox = document.getElementById('chat-box');
    const botMessageDiv = document.createElement('div');
    botMessageDiv.classList.add('message', 'bot-message');


    botMessageDiv.innerHTML = `
        <div class="sender-info">Agent A</div>
        <p>${botMessage.message}</p>
    `;

    chatBox.appendChild(botMessageDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
}

        fetchChatData();
    </script>
</body>
</html>
