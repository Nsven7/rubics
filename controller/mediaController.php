<?php
// Include the model file
require ($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/mediaModel.php");


// Handle form submission
if (isset($_POST['submit'])) {
    $id = htmlspecialchars($_POST['projectId']);

    // Directory where files will be uploaded
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/Rubics/public/uploads/projects/" . $id . "/";

    // Create the directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // 0777 gives full permissions, true creates nested directories if needed
    }

    // Count total files
    $countfiles = count($_FILES['files']['name']);
    $names = [];

    // Loop through all files
    for ($i = 0; $i < $countfiles; $i++) {
        // Get original file name and extension
        $originalFilename = $_FILES['files']['name'][$i];
        $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);

        // Generate a unique name for the file
        $uniqueFilename = uniqid() . '.' . $fileExtension;

        // Upload file with the new unique name
        move_uploaded_file($_FILES['files']['tmp_name'][$i], $uploadDir . '/' . $uniqueFilename);
        $names[] = $uniqueFilename;
    }

    // Call to the function inside the model file
    $error = insertData($names, $uploadDir, $id);

    if (isset($error)) {

        // Redirection with error message
        $message = implode(" - ", $error);
        header("Location: ../view/view-admin-media-new.php?message=$message");
        exit;
    } else {
        // Redirection with success message
        $message = "success";
        header("Location: ../view/view-admin-media-new.php");
        exit;
    }
} else {
    header("Location: ../view/view-admin-media-new.php");
    exit;
}
