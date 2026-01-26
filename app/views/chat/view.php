<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat MVC - Classe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta http-equiv="refresh" content="30">
</head>
<body class="bg-slate-100 h-screen flex flex-col">

<header class="bg-indigo-600 text-white p-4 shadow-lg flex justify-between items-center">
    <div class="flex items-center gap-4">
        <a href="teacher/dashboard" class="hover:bg-indigo-500 p-2 rounded-full transition-colors" title="Retour au tableau de bord">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-lg font-semibold tracking-wide">Espace Classe #<?= htmlspecialchars($classId) ?></h1>
    </div>
    
    <div class="flex items-center gap-3">
        <span class="text-xs bg-indigo-500 px-2 py-1 rounded">En direct</span>
    </div>
</header>

    <main class="flex-1 overflow-y-auto p-4 space-y-4">
        
        <?php if (empty($messages)): ?>
            <div class="text-center text-gray-400 mt-10">Aucun message pour le moment. Soyez le premier !</div>
        <?php else: ?>
            <?php foreach ($messages as $msg): ?>
                <?php 
                    $isMe = ($msg->getIdUser() == ($_SESSION['user']['id'] ?? 0)); 
                ?>
                
                <div class="flex <?= $isMe ? 'justify-end' : 'justify-start'; ?>">
                    <div class="max-w-[80%] md:max-w-md px-4 py-2 rounded-2xl shadow-sm 
                        <?= $isMe 
                            ? 'bg-indigo-600 text-white rounded-tr-none' 
                            : 'bg-white text-slate-800 rounded-tl-none border border-slate-200'; ?>">
                        
                        <p class="text-[10px] font-bold uppercase mb-1 <?= $isMe ? 'text-indigo-200' : 'text-slate-500'; ?>">
                            User #<?= $msg->getIdUser(); ?>
                        </p>
                        
                        <p class="text-sm leading-relaxed">
                            <?= nl2br(htmlspecialchars($msg->getMessage())); ?>
                        </p>
                        
                        <p class="text-[9px] mt-1 text-right opacity-60 italic">
                            <?= date('H:i', strtotime($msg->getCreatedAt())); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </main>

    <footer class="bg-white p-4 border-t border-slate-200">
        <form action="/chat/send" method="POST" class="max-w-4xl mx-auto flex items-end gap-2">
            <input type="hidden" name="id_classe" value="<?= $classId ?>">
            
            <div class="flex-1">
                <textarea 
                    name="message" 
                    required
                    placeholder="Votre message..." 
                    class="w-full bg-slate-50 border border-slate-300 rounded-2xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none h-12 pt-3"
                ></textarea>
            </div>
            
            <button 
                type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold p-3 rounded-xl transition-all shadow-md active:scale-95"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        </form>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="text-red-500 text-xs mt-2 text-center font-medium"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
    </footer>
    <script>
        window.onload = function() {
            const main = document.querySelector('main');
            main.scrollTop = main.scrollHeight;
        };
    </script>

</body>
</html>