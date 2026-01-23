<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <title>Détails Classe | EduClass</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen">

    <?php include(dirname(__DIR__) . '/layouts/sidebar.php'); ?>

    <main class="flex-1 p-10 overflow-y-auto">
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900"><?= htmlspecialchars($class->getName()) ?></h1>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="/teacher/classes/<?= $class->getIdClasse() ?>/addstudent" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-200 text-sm font-bold rounded-xl text-gray-700 hover:bg-gray-50 shadow-sm transition-all">
                    <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    Ajouter étudiant
                </a>
                <a href="/teacher/classes/<?= $class->getIdClasse() ?>/work" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-sm font-bold rounded-xl text-white hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Ajouter travail
                </a>
            </div>
        </header>

        <section class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900">Liste des étudiants</h2>
                <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full">
                    <?= count($students) ?> inscrits
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 border-b border-gray-100">Étudiant</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 border-b border-gray-100">Statut (Aujourd'hui)</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 border-b border-gray-100">Dernière Note</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php if (!empty($students)): ?>
                            <?php foreach ($students as $student): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 font-bold text-xs border border-gray-200">
                                            <?= strtoupper(substr($student['name'], 0, 2)) ?>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900"><?= htmlspecialchars($student['name']) ?></p>
                                            <p class="text-xs text-gray-400"><?= htmlspecialchars($student['email']) ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if (isset($student['status'])): ?>
                                        <?php if ($student['status'] === 'present'): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-50 text-green-600 border border-green-100">Présent</span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-50 text-red-600 border border-red-100">Absent</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-xs text-gray-400 italic">Non marqué</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if (isset($student['last_grade'])): ?>
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-bold text-gray-900"><?= number_format($student['last_grade'], 2) ?></span>
                                            <span class="text-xs text-gray-400">/20</span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-xs text-gray-300">N/A</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        <p class="text-gray-400 font-medium italic">Aucun étudiant dans cette classe.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

</body>
</html>