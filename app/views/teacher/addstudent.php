<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Étudiant | EduClass</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen">

    <?php include(dirname(__DIR__) . '/layouts/sidebar.php'); ?>

    <main class="flex-1 p-10 flex flex-col items-center justify-center">
        <div class="w-full max-w-xl">
            <header class="text-center mb-10">
                <div class="inline-flex p-3 bg-indigo-100 rounded-2xl mb-4">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900">Nouvel Étudiant</h1>
                <p class="text-gray-500 mt-2 font-medium italic">Inscrivez un nouvel élève et marquez sa présence initiale</p>
            </header>

            <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/50">
                <form action="/teacher/classes/<?= $classId ?>/addstudent" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nom complet</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </span>
                            <input type="text" name="name" id="name" placeholder="Ex: Jean Dupont" required 
                                class="block w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Adresse Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </span>
                            <input type="email" name="email" id="email" placeholder="etudiant@exemple.com" required 
                                class="block w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-bold text-gray-700 mb-2">Statut de présence initial</label>
                        <div class="relative">
                            <select name="status" id="status" 
                                class="block w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                                <option value="present" class="text-green">Présent</option>
                                <option value="absent" class="text-red">Absent</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex gap-4">
                        <button type="submit" class="w-full py-4 px-6 border border-transparent rounded-2xl shadow-lg shadow-indigo-100 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform active:scale-95">
                            Ajouter l'étudiant à la classe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>