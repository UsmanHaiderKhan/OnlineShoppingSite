<?php require_once "connection.php" ?>
<?php
session_start();
if (isset($_POST["submit1"])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $sql = "select * from users where email='$email' AND password='$password'";
    $statement = $conn->prepare($sql);
    $result = $statement->execute(array(
        'email' => $email,
        'password' => $password
    ));

    if ($statement->rowCount() > 0) {
        $sqls = "select * from users";
        $statements = $conn->prepare($sqls);
        $statements->execute();
        foreach ($statements as $value) {
            $user_id = $value['id'];
            $username = $value["username"];
            $email = $value['email'];
            $fullAddress = $value['fulladdress'];
            $phoneNo = $value['phoneNo'];
            $city = $value['city'];
            $user_image = $value['user_image'];
            $role = $value['Role'];

            $user_info = array(
                'user_id' => $user_id,
                'username' => $username,
                'email' => $email,
                'fullAddress' => $fullAddress,
                'phoneNo' => $phoneNo,
                'city' => $city,
                'user_image' => $user_image,
                'role' => $role,

            );

            $_SESSION['admin'] = $user_info;
        }

        if ($role == "User") {
            echo '<script>window.location="../userpanel/AdvCart.php"</script>';
        } elseif ($role == 'Admin') {
            echo ' <script>window.location = "dashboard.php";
        </script>';

        }

    } else {
        echo "some thing going wrong";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/login.css">
    <title>User | Entrance</title>
</head>
<body>
<h2>Users Entrance</h2>
<div class="login-page-container" id="container">
    <div class="form-container sign-up-container">
        <?php
        if (isset($_POST["submit"])) {
            $username = trim($_POST["username"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            $con_pass = trim($_POST['con_pass']);
            echo $password . " " . $con_pass;
            if ($password != $con_pass) {
                echo '<script> alert("Password Does not Match"); </script>';
                die();
            }
            $fullAddress = trim($_POST['fulladdress']);
            $phoneNo = trim($_POST['phoneNo']);
            $city = trim($_POST['city']);
            $Role = "User";

            $filename = $_FILES['user_image']['name'];
            $r1 = rand(1111, 9999);
            $r2 = rand(1111, 9999);
            $r3 = $r1 . $r2;
            $r3 = md5($r3);
            $dst = "./User_Images/" . $r3 . $filename;
            $user_image = "User_Images" . $r3 . $filename;
            move_uploaded_file($_FILES['image']['tmp_name'], $dst);

            $insertQuery = "insert into users(username,email,password,fulladdress,phoneNo,city,user_image,Role)
                            VALUES ('$username','$email','$password','$fullAddress','$phoneNo','$city','$user_image','$Role')";
            $statement = $conn->prepare($insertQuery);
            $result = $statement->execute();
            if ($result) {
                echo "User Registered Successfully";
            } else {
                echo "Some Thing Went Going Wrong...!";
            }
        }

        ?>
        <form action="admin_login.php" method="post" name="register-form" enctype="multipart/form-data">

            <input type="text" placeholder="Username" name="username"/>
            <input type="email" placeholder="Email" name="email"/>
            <input type="password" placeholder="Password" name="password"/>
            <input type="password" placeholder="Confirm Password" name="con_pass"/>
            <input type="text" placeholder="Full Address" name="fulladdress"/>
            <input type="number" placeholder="Phone No" name="phoneNo"/>
            <input type="text" placeholder="City" name="city"/>
            <input type="file" placeholder="" name="user_image"/>

            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="#" method="post" name="loginForm">
            <h1>Sign in</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fa fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="social"><i class="fa fa-linkedin"></i></a>
            </div>
            <span>or use your account</span>
            <input type="email" placeholder="Email" name="email"/>
            <input type="password" placeholder="Password" name="password"/>
            <a href="#">Forgot your password?</a>
            <button name="submit1">Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Create Account</h1>
                <p>To keep connected with us please login with your personal info</p>
                <div class="social-container">
                    <a href="#" class="social text-white"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="social text-white"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="social text-white"><i class="fa fa-linkedin"></i></a>
                </div>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
</body>
</html>