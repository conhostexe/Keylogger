# PHP Script (server-side) to Handle File Upload:

<?php
// Set the target directory where files will be saved
$targetDir = "uploaded_logs/";
// Ensure the directory exists (create if not)
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}
// Check if a file was uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    // Get file info
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $targetFilePath = $targetDir . $fileName;
    // Check for errors in file upload
    if ($file['error'] == 0) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            echo "File uploaded successfully!";
        } else {
            echo "Error: Could not move the uploaded file.";
        }
    } else {
        echo "Error: File upload failed. Error code: " . $file['error'];
    }
} else {
    echo "Error: No file uploaded.";
}
?>