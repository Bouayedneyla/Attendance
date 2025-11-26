<?php
$file = "students.json";

if (!file_exists($file)) {
    $students = [];
} else {
    $students = json_decode(file_get_contents($file), true);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <a href="/Attendance/add_student.php">Ajouter étudiant</a>
    <a href="/Attendance/list_student.php" class="active">Liste étudiants</a>
    <a href="/Attendance/take_attendance.php">Prendre présence</a>
</div>

<h2>Liste des étudiants</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nom complet</th>
        <th>Groupe</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($students as $s): ?>
    <tr>
        <td><?= $s["id"] ?></td>
        <td><?= htmlspecialchars($s["fullname"]) ?></td>
        <td><?= htmlspecialchars($s["group"]) ?></td>
        <td>
            <a href="update_student.php?id=<?= $s['id'] ?>"><button>Modifier</button></a>
            <a href="delete_student.php?id=<?= $s['id'] ?>"><button style="background:red;">Supprimer</button></a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>


