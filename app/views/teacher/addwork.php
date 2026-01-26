<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Ajouter un Travail</title>
</head>
<body class="bg-[#f8fafc] min-h-screen font-sans flex items-center justify-center py-12 px-4">

<div class="max-w-2xl w-full">
    <div class="bg-white rounded-3xl shadow-xl border border-indigo-100 p-8 ring-8 ring-indigo-50/50">
        
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Nouveau Travail</h2>
            <a href="/Minerva/public/teacher/classes/showclasse/<?= $classId ?>" class="text-slate-400 hover:text-red-500 transition-all transform hover:rotate-90">
                <i class="fas fa-times-circle text-2xl"></i>
            </a>
        </div>

        <form action="/teacher/storework" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="class_id" value="<?= $classId ?>">

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Titre du devoir</label>
                <input name="title" type="text" placeholder="Ex: TP de Programmation Orientée Objet" 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all text-sm" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Instructions</label>
                <textarea name="description" rows="4" placeholder="Décrivez les objectifs et les consignes..." 
                          class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all text-sm" required></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1 text-indigo-600">Assigner à qui ? (Étudiants du groupe)</label>
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 max-h-48 overflow-y-auto space-y-2">
                    <?php if (!empty($students)): ?>
                        <?php foreach($students as $student): ?>
                            <label class="flex items-center p-2 hover:bg-white rounded-lg transition-colors cursor-pointer group">
                                <input type="checkbox" name="student_ids[]" value="<?= $student['id'] ?>" 
                                       class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                                <span class="ml-3 text-sm text-slate-600 group-hover:text-slate-900">
                                    <?= htmlspecialchars($student['name']) ?>
                                </span>
                            </label>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-xs text-slate-400 italic">Aucun étudiant trouvé dans cette classe.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Document (PDF/Image)</label>
                <div class="relative border-2 border-dashed border-slate-200 rounded-xl p-6 text-center group hover:border-indigo-400 transition-all bg-slate-50/50">
                    <input type="file" name="file" class="hidden" id="fileInput">
                    <label for="fileInput" class="cursor-pointer">
                        <i class="fas fa-file-upload mb-2 text-2xl text-indigo-500 block"></i>
                        <span id="fileLabel" class="text-sm text-slate-600 font-medium">Glissez votre fichier ou <span class="text-indigo-600 underline">cliquez ici</span></span>
                        <p class="text-[10px] text-slate-400 mt-1">PDF, DOCX, PNG (Max. 5MB)</p>
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-200 transition-all transform active:scale-[0.98]">
                Enregistrer et Publier
            </button>
        </form>
    </div>
</div>

<script>

    document.getElementById('fileInput').addEventListener('change', function(e) {
        let fileName = e.target.files[0].name;
        if(fileName) {
            document.getElementById('fileLabel').innerHTML = "Fichier sélectionné : <b class='text-indigo-700'>" + fileName + "</b>";
        }
    });
</script>

</body>
</html>