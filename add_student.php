<?php
// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $student_id = trim($_POST["student_id"]);
    $fullname   = trim($_POST["fullname"]);
    $group      = trim($_POST["group"]);

    if ($student_id === "" || $fullname === "" || $group === "") {
        echo "Erreur : tous les champs sont obligatoires.";
        exit;
    }

    $file = "students.json";
    if (file_exists($file)) {
        $students = json_decode(file_get_contents($file), true);
    } else {
        $students = [];
    }

    $students[] = [
        "id" => $student_id,
        "fullname" => $fullname,
        "group" => $group
    ];

    file_put_contents($file, json_encode($students, JSON_PRETTY_PRINT));

    echo "<h2>Étudiant ajouté avec succès !</h2>";
    echo "<a href='/Attendance/list_student.php'>
            <button style='padding:10px 15px;'>Voir la liste</button>
          </a>";
    exit;
}
?>

<h2>Ajouter un étudiant</h2>
<form method="POST">
    <label>ID Étudiant :</label><br>
    <input type="text" name="student_id" required><br><br>

    <label>Nom complet :</label><br>
    <input type="text" name="fullname" required><br><br>

    <label>Groupe :</label><br>
    <input type="text" name="group" required><br><br>

    <button type="submit" style="padding:10px 15px;">Ajouter</button>
</form>

<br>
<a href="/Attendance/list_student.php">
    <button style="padding:10px 15px;">Voir la liste</button>
</a>

