<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Mes Travaux</title>
</head>
<body class="bg-[#f8fafc] min-h-screen font-sans">

<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Mes Travaux</h1>
            <p class="text-slate-500 text-sm">Consultez et gérez les devoirs de vos classes.</p>
        </div>
        
        <a href="/teacher/addwork"
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-sm flex items-center">
            <i class="fas fa-plus-circle mr-2"></i> Nouveau Travail
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-200">
                    <th class="px-6 py-4 text-[13px] font-semibold text-slate-500 uppercase tracking-wider">Travail</th>
                    <th class="px-6 py-4 text-[13px] font-semibold text-slate-500 uppercase tracking-wider text-center">Classe</th>
                    <th class="px-6 py-4 text-[13px] font-semibold text-slate-500 uppercase tracking-wider text-right">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if (empty($works)): ?>
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-slate-400 italic">Aucun travail publié pour le moment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($works as $w): ?>
                    <tr class="hover:bg-indigo-50/30 transition-colors group">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-700 group-hover:text-indigo-600 transition-colors uppercase text-sm">
                                <?= htmlspecialchars($w['title']) ?>
                            </p>
                            <p class="text-xs text-slate-400 truncate max-w-[300px]"><?= htmlspecialchars($w['description']) ?></p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                <?= htmlspecialchars($w['class_name'] ?? 'N/A') ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-xs font-medium text-slate-500">
                            <?= date('d/m/Y', strtotime($w['created_at'])) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>