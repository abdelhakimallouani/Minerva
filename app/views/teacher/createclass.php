<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <title>Créer une classe | EduClass</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen">

    <?php include(dirname(__DIR__) . '/layouts/sidebar.php'); ?>

    <main class="flex-1 p-10 flex flex-col items-center justify-center">
        <div class="w-full max-w-lg">
            <header class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900">Nouvelle Classe</h1>
                <p class="text-gray-500 mt-2 font-medium italic">Définissez le nom de votre nouveau groupe d'apprentissage</p>
            </header>

            <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/50">
                <form action="/teacher/classes/createclass" method="POST" class="space-y-6">
                    <input type="hidden" name="id_teacher" value="<?= $_SESSION['user']['id'] ?>">

                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nom de la classe</label>
                        <input type="text" name="name" id="name" required 
                            class="block w-full px-4 py-3 rounded-xl border border-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                            placeholder="Ex: Terminale S1, Développement Web 2026...">
                    </div>

                    <div class="pt-4 flex gap-4">
                        <a href="/teacher/classes" class="flex-1 text-center py-3 px-4 border border-gray-200 rounded-xl text-sm font-bold text-gray-500 hover:bg-gray-50 transition">
                            Annuler
                        </a>
                        <button type="submit" class="flex-[2] py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-100 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                            Créer la classe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>