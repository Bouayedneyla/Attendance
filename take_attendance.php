<?php

$file = "students.json";

if (!file_exists($file)) {
    echo "<h2>Aucun étudiant pour le moment.</h2>";
    echo "<a href='/Attendance/add_student.php'>
            <button style='padding:10px 15px;'>Ajouter un étudiant</button>
          </a>";
    exit;
}

$students = json_decode(file_get_contents($file), true);

if (!is_array($students)) {
    echo "<h2>Erreur : impossible de lire students.json</h2>";
    exit;
}

echo "<h2>Liste des étudiants</h2>";

echo "<table border='1' cellpadding='10' cellspacing='0'>
        <tr style='background:#f0f0f0;'>
            <th>ID</th>
            <th>Nom complet</th>
            <th>Groupe</th>
            <th>Actions</th>
        </tr>";

foreach ($students as $s) {
    echo "<tr>
            <td>{$s['id']}</td>
            <td>{$s['fullname']}</td>
            <td>{$s['group']}</td>
            <td>
                <a href='update_students.php?id={$s['id']}'>Edit</a> | 
                <a href='delete_student.php?id={$s['id']}' onclick='return confirm(\"Supprimer cet étudiant ?\");'>Delete</a>
            </td>
          </tr>";
}

echo "</table>";

echo "<br><a href='/Attendance/add_student.php'>
        <button style='padding:10px 15px;'>Ajouter un étudiant</button>
      </a>";
?>