<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Enseignant | EduClass</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen">

    <?php include(dirname(__DIR__) . '/layouts/sidebar.php'); ?>

    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Bonjour, <?= explode(' ', $_SESSION['user']['name'])[0] ?> 👋</h1>
            <p class="text-gray-500 font-medium italic">Voici un aperçu de vos classes et travaux</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-indigo-50/50 p-6 rounded-3xl border border-indigo-100 flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-sm font-semibold mb-1">Total Étudiants</p>
                    <p class="text-3xl font-bold text-gray-900">156</p>
                    <p class="text-xs text-green-500 font-bold mt-2">+12% <span class="text-gray-400 font-normal">vs mois dernier</span></p>
                </div>
                <div class="bg-indigo-600 p-3 rounded-2xl shadow-lg shadow-indigo-100">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-sm font-semibold mb-1">Travaux Assignés</p>
                    <p class="text-3xl font-bold text-gray-900">24</p>
                    <p class="text-xs text-gray-400 mt-2 italic font-medium">Ce mois</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-2xl">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.246.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.246.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
            </div>

            <div class="bg-green-50/50 p-6 rounded-3xl border border-green-100 flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-sm font-semibold mb-1">Taux de Présence</p>
                    <p class="text-3xl font-bold text-gray-900">94%</p>
                    <p class="text-xs text-green-500 font-bold mt-2">+3% <span class="text-gray-400 font-normal">vs mois dernier</span></p>
                </div>
                <div class="bg-green-500 p-3 rounded-2xl shadow-lg shadow-green-100">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
            </div>

            <div class="bg-orange-50/50 p-6 rounded-3xl border border-orange-100 flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-sm font-semibold mb-1">Moyenne Générale</p>
                    <p class="text-3xl font-bold text-gray-900">14.5<span class="text-lg text-gray-400 font-normal">/20</span></p>
                    <p class="text-xs text-green-500 font-bold mt-2">+2% <span class="text-gray-400 font-normal">vs mois dernier</span></p>
                </div>
                <div class="bg-orange-400 p-3 rounded-2xl shadow-lg shadow-orange-100">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-8">Activité récente</h3>
                <div class="space-y-8">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4">
                            <div class="bg-indigo-50 p-2 rounded-lg"><svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Nouveau travail assigné</p>
                                <p class="text-xs text-gray-500 italic">Exercice de mathématiques - Chapitre 5</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400">Il y a 2 heures</span>
                    </div>
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4">
                            <div class="bg-green-50 p-2 rounded-lg"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Travail noté</p>
                                <p class="text-xs text-gray-500 italic">Lucas Martin - 18/20</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400">Il y a 3 heures</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-bold text-gray-900">Travaux à venir</h3>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div class="space-y-4">
                    <div class="p-4 bg-red-50/50 border border-red-100 rounded-2xl">
                        <div class="flex justify-between items-start mb-1">
                            <p class="text-sm font-bold text-red-600">Devoir de Mathématiques</p>
                            <span class="text-[10px] flex items-center gap-1 text-red-400"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Demain, 23:59</span>
                        </div>
                        <p class="text-xs text-red-400 font-medium italic">Terminale S1</p>
                    </div>
                    <div class="p-4 bg-gray-50/50 border border-gray-100 rounded-2xl">
                        <div class="flex justify-between items-start mb-1">
                            <p class="text-sm font-bold text-gray-800">Dissertation Français</p>
                            <span class="text-[10px] flex items-center gap-1 text-gray-400">Dans 3 jours</span>
                        </div>
                        <p class="text-xs text-gray-400 font-medium italic">Terminale S1</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
