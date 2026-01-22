<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <title>Mes Classes | EduClass</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen">

    <?php include(dirname(__DIR__) . '/layouts/sidebar.php'); ?>

    <main class="flex-1 p-10">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Gestion des Classes</h1>
                <p class="text-gray-500 font-medium italic">Consultez et gérez vos groupes d'étudiants</p>
            </div>
            <a href="/teacher/classes/createclass" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Créer une classe
            </a>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if(!empty($classes)): ?>
                <?php foreach($classes as $class): ?>
                <a  href="/teacher/classes/showclasse/<?php echo $class->getIdClasse(); ?>" class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all group cursor-pointer">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-indigo-50 p-3 rounded-2xl group-hover:bg-indigo-600 transition-colors">
                            <svg class="w-6 h-6 text-indigo-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <span class="text-xs text-gray-400 font-medium">Créée le <?= date('d/m/Y', strtotime($class->getCreatedAt())) ?></span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($class->getName()) ?></h3>
                    
                    <div class="flex items-center gap-2 text-gray-500 text-sm mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>ID Enseignant: <?= $class->getIdTeacher()?></span>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-20 bg-white border-2 border-dashed border-gray-200 rounded-3xl text-center">
                    <p class="text-gray-400 font-medium italic">Vous n'avez pas encore créé de classe.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>