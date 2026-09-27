<?php require('db.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $select = "SELECT * FROM users WHERE id=$id";
        $result = mysqli_query($conn, $select);
        // fetch single row from database
        $data = mysqli_fetch_assoc($result);
    }

    if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $update = "UPDATE users SET name='$name', phone='$phone', email='$email' WHERE id=$id";
        $result = mysqli_query($conn, $update);

        if ($result) {
            echo "Data updated successfully";
            //  header("Location: index.php");
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard.php\">";
        } else {
            echo "Error updating data: " . mysqli_error($conn);
        }
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $data['name']; ?>"> <br><br>

        <label for="Phone">Phone:</label><br>
        <input type="text" id="Phone" name="phone" value="<?php echo $data['phone']; ?>"> <br><br>

        <label for="Email">Email:</label><br>
        <input type="text" id="Email" name="email" value="<?php echo $data['email']; ?> "> <br><br>

        <input type="submit" name="save" value="Submit">
    </form>

</body>

</html>