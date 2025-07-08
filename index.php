<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beqsoft OpenAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">  
    <link href="style.css" rel="stylesheet">  

  </head>
<body class="bg-gradient-to-br from-indigo-50 to-purple-50 min-h-screen flex items-center justify-center p-4">
<div class="chat-container w-full max-w-2xl bg-white rounded-2xl shadow-xl overflow-hidden">
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 text-white">
        <div class="flex items-center space-x-3">
            <div class="bg-white/20 p-2 rounded-full">
                <i class="fas fa-brain text-xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold">Chat with Phi 🧠</h2>
                <p class="text-indigo-100 text-sm">AI-powered conversations</p>
            </div>
        </div>
    </div>

    <div class="chat-box h-96 overflow-y-auto p-6 space-y-4" id="chat">
        <?php session_start(); if (!isset($_SESSION['log'])) $_SESSION['log'] = [];
        foreach ($_SESSION['log'] as $entry): ?>
            <div class="<?= $entry['role'] === 'user' ? 'text-right' : 'text-left' ?>">
                <div class="<?= $entry['role'] === 'user' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-800' ?> inline-block rounded-2xl px-4 py-2 max-w-xs md:max-w-md lg:max-w-lg">
                    <?php if ($entry['role'] !== 'user'): ?>
                        <div class="font-bold text-indigo-600">Phi:</div>
                    <?php endif; ?>
                    <?= htmlspecialchars($entry['content']) ?>
                </div>
                <div class="text-xs text-gray-500 mt-1">
                    <?= $entry['role'] === 'user' ? 'You' : 'AI' ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <form action="chat.php" method="POST" class="p-4 border-t border-gray-200 bg-gray-50">
        <div class="flex space-x-2">
            <input type="text" name="message" placeholder="Say something..." required autofocus
                   class="flex-1 px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-full w-12 h-12 flex items-center justify-center transition-colors duration-200">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
        <p class="text-xs text-gray-500 mt-2 text-center">Phi may produce inaccurate information about people, places, or facts.</p>
    </form>
</div>

<script>
    // Auto-scroll to bottom of chat
    const chatBox = document.getElementById('chat');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>
</body>
</html>