<?php require("db.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard | Palpasa Café</title>
    <script>
        if (sessionStorage.getItem("isLoggédIn") !== "true") {
            alert("Access Denied! Please log in first.");
            window.location.href = "login.php";
        }
    </script>

    <style>
        form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #6F4E37;
        }

        form label {
            font-size: 16px;
            font-weight: bold;
            color: #6F4E37;
        }

        form .submit {
            padding: 5px;
            border-style: none;
            border-radius: 5px;
            background-color: #fff;
            color: #6F4E37;
            font-size: 16px;
            font-weight: bold;
        }

        .table {
            padding: 20px;
        }

        .table tr th,
        tr td {
            padding: 5px;
            height: fit-content;
            min-width: 200px;
            width: fit-content;
        }

        .table .action {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>

<body class="dash-body">
    <div class="dashboard-container">
        <div class="aside">
            <div class="logo">
                <img src="assets/palpasa-café-secondary-logo.png" alt="Palpasa Café">
            </div>
            <a href="#administrators" class="menu">Administrators</a>
            <a href="#" class="menu">Purchase</a>
            <a href="#" class="menu">Sales</a>
            <a href="#" class="menu">Inventory</a>
            <a href="#" class="menu">Debtors</a>
            <a href="#" class="menu">Creditors</a>
            <button class="logoutBtn" onclick="logout()">Log Out</button>
        </div>
        <div class="dash-main">
            <div class="dash-welcome-back">
                <h2 id="dash-greetings"></h2>
            </div>
            <div class="link">
                <a href="#" class="links">
                    <p class="fa fa-user"></p>
                    <p>Users</p>
                </a>
                <a href="#" class="links">
                    <p class="fa fa-list"></p>
                    <p>Orders</p>
                </a>
                <a href="#" class="links">
                    <p class="fa fa-burger"></p>
                    <p>Foods</p>
                </a>
                <a href="#" class="links">
                    <p class="fa fa-coffee"></p>
                    <p>Drinks</p>
                </a>
                <a href="#" class="links">
                    <p class="fa fa-pie-chart"></p>
                    <p>Reports</p>
                </a>
                <a href="#" class="links">
                    <p class="fa fa-cog"></p>
                    <p>Settings</p>
                </a>
            </div>
            <section id="administrators">

                <h1>Administrators</h1>

                <?php
                if (isset($_POST['save'])) {
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $insert = "INSERT INTO users(name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')";

                    $result = mysqli_query($conn, $insert);

                    if ($result) {
                        echo "Data inserted successfully";
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard.php\">";
                    } else {
                        echo "Error inserting data: " . mysqli_error($conn);
                    }
                }
                ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name"> <br><br>

                    <label for="Phone">Phone:</label>
                    <input type="text" id="Phone" name="phone"> <br><br>

                    <label for="Email">Email:</label>
                    <input type="text" id="Email" name="email"> <br><br>

                    <label for="password">password:</label>
                    <input type="password" id="password" name="password"> <br><br>

                    <input type="submit" class="submit" name="save" value="Submit">
                </form>

                <div class="table">
                    <table border="1" cellpadding="10" cellspacing="0">
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>

                        <?php
                        $select = "SELECT * FROM users";
                        $result = mysqli_query($conn, $select);

                        foreach ($result as $a) {
                        ?>
                            <tr>
                                <td><?php echo $a['name']; ?></td>
                                <td><?php echo $a['phone']; ?></td>
                                <td><?php echo $a['email']; ?></td>
                                <td class="action">
                                    <a href="edit.php?id=<?php echo $a['id']; ?>" style="padding: 0.5rem; background: #007bff; color: white; text-decoration: none; border-radius: 5px">Edit</a>
                                    <a href="delete.php?id=<?php echo $a['id']; ?>" style="padding: 0.5rem; background: #dc3545; color: white; text-decoration: none; border-radius: 5px" onclick="return confirm('Do you want to delete this data?')">Delete</a>
                                    <a href="" style="padding: 0.5rem; background: #28a745; color: white; text-decoration: none; border-radius: 5px">View</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <script>
        function logout() {
            let logoutVal = confirm("Are you sure want to logout?");
            if (logoutVal == true) {
                sessionStorage.removeItem("isLoggédIn");
                window.location.href = "login.php";
            }
        }
    </script>
    <script>
        // Admin Greetings
        let dashGreetings = document.getElementById("dash-greetings");

        const hour = new Date().getHours();
        let timeOfDay;

        if (hour >= 5 && hour < 12) {
            timeOfDay = "Good Morning, Admin!";
        } else if (hour >= 12 && hour < 17) {
            timeOfDay = "Good Afternoon, Admin!";
        } else if (hour >= 17 && hour < 21) {
            timeOfDay = "Good Evening, Admin!";
        } else {
            timeOfDay = "Good Night, Admin!";
        }

        dashGreetings.innerHTML = timeOfDay;
    </script>
</body>

</html>