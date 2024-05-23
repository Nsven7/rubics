<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

// Insert datas for media
function insertData($names, $uploadDir, $id)
{
    // Retrieve db connection
    global $bdd;

    $query = "INSERT INTO media (name, extension, path, project_id) VALUES (:name, :extension, :path, :project_id)";
    $stmt = $bdd->prepare($query);

    $errors = [];

    foreach ($names as $name) {
        $finalName = pathinfo($name, PATHINFO_FILENAME);
        $extension = '.' . pathinfo($name, PATHINFO_EXTENSION);
        $path = $uploadDir;
        $project_id = $id;

        $stmt->bindParam(':name', $finalName);
        $stmt->bindParam(':extension', $extension);
        $stmt->bindParam(':path', $path);
        $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            $errors[] = $stmt->errorInfo();
        }
    }

    return $errors;
}

// Retrieve all project's medias
function getMedias($id)
{
    // Retrieve db connection
    global $bdd;

    $sql = "SELECT * FROM media WHERE project_id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $medias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $medias;
}