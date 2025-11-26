<?php
$today = date("Y-m-d");
$fileName = "attendance_" . $today . ".json";

if (file_exists($fileName)) {
    $alreadyTaken = true;
} else {
    $alreadyTaken = false;
}

$students = json_decode(file_get_contents("students.json"), true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Prendre présence</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    
    <a href="/Attendance/add_student.php">Ajouter étudiant</a>
    <a href="/Attendance/list_student.php">Liste étudiants</a>
    <a href="/Attendance/take_attendance.php" class="active">Prendre présence</a>
</div>

<h2>Prendre la présence du <?= $today ?></h2>

<?php if ($alreadyTaken): ?>
    <p style="color:blue;">La présence d'aujourd'hui a déjà été enregistrée.</p>

    <a href="update_attendance.php?date=<?= $today ?>">
        <button>Modifier la présence</button>
    </a>

    <a href="/Attendance/list_student.php">
        <button>Retour</button>
    </a>

<?php else: ?>

<form method="POST">
<table>
    <tr>
        <th>ID</th>
        <th>Nom complet</th>
        <th>Groupe</th>
        <th>Statut</th>
    </tr>

    <?php foreach ($students as $s): ?>
    <tr>
        <td><?= $s['id'] ?></td>
        <td><?= htmlspecialchars($s['fullname']) ?></td>
        <td><?= htmlspecialchars($s['group']) ?></td>
        <td>
            <label><input type="radio" name="status[<?= $s['id'] ?>]" value="present" required> Présent</label>
            <label><input type="radio" name="status[<?= $s['id'] ?>]" value="absent"> Absent</label>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<button type="submit">Enregistrer</button>
</form>

<?php endif; ?>

</body>
</html>
