<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Works</title>
</head>
<body class="bg-gray-100 p-8">

<a href="/work/index?create=1" class="bg-indigo-600 text-white px-4 py-2 rounded">
    Créer un travail
</a>

<?php if (isset($_GET['create'])): ?>
<form method="POST" action="/work/store" enctype="multipart/form-data"
      class="bg-white p-6 mt-6 rounded shadow">
    <input name="title" placeholder="Titre" class="w-full mb-3 border p-2" required>
    <textarea name="description" placeholder="Description" class="w-full mb-3 border p-2" required></textarea>
    <select name="class_id" class="w-full mb-3 border p-2" required>
        <option value="">Classe</option>
        <?php foreach ($classes as $c): ?>
            <option value="<?= $c['id_classe'] ?>"><?= $c['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="file" name="file" class="mb-3">
    <button class="bg-green-600 text-white px-4 py-2 rounded">Enregistrer</button>
</form>
<?php endif; ?>

<?php if (!empty($_SESSION['success'])): ?>
<div class="bg-green-100 text-green-700 p-3 mt-4 rounded">
    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
</div>
<?php endif; ?>

<table class="w-full bg-white mt-6 rounded shadow">
    <tr class="bg-gray-200">
        <th class="p-2">Titre</th>
        <th class="p-2">Classe</th>
        <th class="p-2">Date</th>
    </tr>
    <?php foreach ($works as $w): ?>
    <tr class="border-t">
        <td class="p-2"><?= htmlspecialchars($w['title']) ?></td>
        <td class="p-2"><?= htmlspecialchars($w['class_name']) ?></td>
        <td class="p-2"><?= date('d/m/Y', strtotime($w['created_at'])) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
