<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Gestion des Travaux</title>
</head>
<body class="bg-[#f8fafc] min-h-screen font-sans">

<div class="max-w-6xl mx-auto py-10 px-4">
    
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Mes Travaux</h1>
            <p class="text-slate-500 text-sm">Consultez et ajoutez vos devoirs en un clic.</p>
        </div>
        
        <a href="?create=1#form" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-sm flex items-center">
            <i class="fas fa-plus-circle mr-2"></i> Nouveau Travail
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <div class="lg:col-span-2 order-2 lg:order-1">
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
                        <?php foreach ($works as $w): ?>
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-700 group-hover:text-indigo-600 transition-colors uppercase text-sm">
                                    <?= htmlspecialchars($w['title']) ?>
                                </p>
                                <p class="text-xs text-slate-400 truncate max-w-[200px]"><?= htmlspecialchars($w['description']) ?></p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                    <?= htmlspecialchars($w['class_name']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right text-xs font-medium text-slate-500">
                                <?= date('d/m/Y', strtotime($w['created_at'])) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:col-span-1 order-1 lg:order-2 sticky top-8" id="form">
            <?php if (isset($_GET['create'])): ?>
            <div class="bg-white rounded-2xl shadow-xl border border-indigo-100 p-6 ring-4 ring-indigo-50/50">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-slate-800">Ajouter un travail</h2>
                    <a href="?" class="text-slate-400 hover:text-red-500 transition-colors">
                        <i class="fas fa-times-circle text-xl"></i>
                    </a>
                </div>

                <form method="POST" action="/work/store" enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1 ml-1">Titre</label>
                        <input name="title" type="text" placeholder="Nom du TP..." 
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all text-sm" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1 ml-1">Description</label>
                        <textarea name="description" rows="3" placeholder="Instructions..." 
                                  class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all text-sm" required></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1 ml-1">Classe</label>
                        <select name="class_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none text-sm appearance-none cursor-pointer" required>
                            <option value="">Choisir...</option>
                            <?php foreach ($classes as $c): ?>
                                <option value="<?= $c['id_classe'] ?>"><?= $c['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <form>
                            <?php foreach($students as $student):?>
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                <label for="vehicle1"><?php $student['name']?></label><br>
                            <?php endforeach;?>
                        </form>
                    </div>

                    <div class="relative group">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1 ml-1">Document (PDF/Image)</label>
                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-4 text-center group-hover:border-indigo-300 transition-colors">
                            <input type="file" name="file" class="hidden" id="fileInput">
                            <label for="fileInput" class="cursor-pointer text-sm text-indigo-600 font-medium">
                                <i class="fas fa-cloud-upload-alt mb-2 text-xl block"></i>
                                Cliquez pour uploader
                            </label>
                        </div>
                    </div>

                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-indigo-200 transition-all active:scale-95">
                        Enregistrer
                    </button>
                </form>
            </div>
            <?php else: ?>
            <div class="bg-indigo-50 border border-dashed border-indigo-200 rounded-2xl p-8 text-center">
                <div class="bg-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm text-indigo-500">
                    <i class="fas fa-plus"></i>
                </div>
                <p class="text-sm text-indigo-700 font-medium">Prêt à publier un nouveau sujet ?</p>
                <a href="?create=1#form" class="mt-4 inline-block text-xs font-bold uppercase tracking-widest text-indigo-600 border-b-2 border-indigo-600 pb-1">Commencer ici</a>
            </div>
            <?php endif; ?>
        </div>

    </div>
</div>

</body>
</html>