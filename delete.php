<?php require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete = "DELETE FROM users WHERE id=$id";
    $result = mysqli_query($conn, $delete);

    if ($result) {
        echo "Data deleted successfully";
        // page referesh after 0 second
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard.php\">";
    } else {
        echo "Error deleting data: " . mysqli_error($conn);
    }
}
