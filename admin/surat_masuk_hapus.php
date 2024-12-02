<?php
session_start();
include "../koneksi.php";

// Check if the user is logged in
if (!isset($_SESSION['id_user'])) {
    echo "You must be logged in to delete a surat.";
    exit();
}

// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    $id_surat = intval($_GET['id']); // Sanitize the input to prevent SQL injection

    // Prepare and execute the delete query
    $query = "DELETE FROM surat_masuk WHERE id_surat = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_surat);

    if ($stmt->execute()) {
        // Redirect back to the surat_masuk.php page with a success message
        header("Location: surat_masuk.php?message=success");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
} else {
    // If 'id' is not set, redirect with an error message
    header("Location: surat_masuk.php?message=error");
    exit();
}
?>
