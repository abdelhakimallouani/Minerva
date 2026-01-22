<h1><?= $class->getName() ?></h1>
<p>Créée le : <?= $class->getCreatedAt() ?></p>

<hr>

<div>
    <a href="/teacher/classes/<?= $class->getIdClasse() ?>/add-student">
        Ajouter étudiant
    </a>

    <a href="/teacher/classes/<?= $class->getIdClasse() ?>/add-work">
        Ajouter travail
    </a>
</div>

<hr>

<h2>Liste des étudiants</h2>

<?php if (!empty($students)): ?>
    <ul>
        <?php foreach ($students as $student): ?>
            <li>
                <?= $student['name'] ?> (<?= $student['email'] ?>)
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun étudiant dans cette classe.</p>
<?php endif; ?>
