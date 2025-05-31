<?php 
    session_start();
    require_once "../dbcontroller.php";
    $db = new DB;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Login Restauran</title>
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header h2 {
            color: #333;
            font-weight: 700;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.75rem;
        }
        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            border-radius: 8px;
            background: #007bff;
            border: none;
            transition: background 0.3s;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .alert {
            margin-top: 1rem;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="login-container">
                <div class="login-header">
                    <h2>Login Restauran</h2>
                </div>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="Login">Login</button>
                </form>
                <?php 
                    if (isset($_POST['Login'])) {
                        $email = $_POST['email'];
                        $password = hash('sha256',$_POST['password']);
                        $sql = "SELECT * FROM tbluser WHERE email='$email' AND password='$password'";
                        $count = $db->rowCOUNT($sql);
                        if ($count == 0) {
                            echo '<div class="alert alert-danger mt-3" role="alert">Email atau Password Salah!!</div>';
                        } else {
                            $sql = "SELECT * FROM tbluser WHERE email='$email' AND password='$password'";
                            $row = $db->getITEM($sql);
                            $_SESSION['user'] = $row['email'];
                            $_SESSION['level'] = $row['level'];
                            $_SESSION['iduser'] = $row['iduser'];
                            header("Location:index.php");
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>