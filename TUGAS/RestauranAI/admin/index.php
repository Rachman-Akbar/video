<?php 
    session_start();
    require_once "../dbcontroller.php";
    $db = new DB;
    
    if (!isset($_SESSION['user'])) {
        header("location:login.php");
    }

    if (isset($_GET['log'])) {
        session_destroy();
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page | Aplikasi Restauran SMK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', system-ui, sans-serif;
            overflow-x: hidden;
        }
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideInLeft {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideInUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            animation: fadeIn 0.6s ease-out;
        }
        .header h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
        }
        .header a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }
        .header a:hover {
            color: #e0e7ff;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            animation: slideInRight 0.6s ease-out;
        }
        .user-info a, .user-info span {
            color: white;
            font-size: 0.95rem;
            text-decoration: none;
            transition: transform 0.2s;
        }
        .user-info a:hover, .user-info span:hover {
            transform: scale(1.05);
        }
        .logout-btn {
            color: #ff6b6b;
            font-weight: 500;
            transition: color 0.3s, transform 0.2s;
        }
        .logout-btn:hover {
            color: #ff8787;
            transform: scale(1.05);
        }
        /* Content Styles */
        .content {
            flex: 1;
            padding: 2rem 0;
        }
        .sidebar {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            animation: slideInLeft 0.8s ease-out;
        }
        .sidebar:hover {
            transform: translateY(-5px);
            transition: transform 0.3s;
        }
        .nav-link {
            color: #333;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            opacity: 0;
            animation: slideInUp 0.5s ease-out forwards;
        }
        .nav-link:nth-child(1) { animation-delay: 0.1s; }
        .nav-link:nth-child(2) { animation-delay: 0.2s; }
        .nav-link:nth-child(3) { animation-delay: 0.3s; }
        .nav-link:nth-child(4) { animation-delay: 0.4s; }
        .nav-link:nth-child(5) { animation-delay: 0.5s; }
        .nav-link:nth-child(6) { animation-delay: 0.6s; }
        .nav-link:hover {
            background: #667eea;
            color: white;
            transform: translateX(5px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        .nav-link i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }
        .content-area {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            animation: slideInRight 0.8s ease-out;
        }
        .content-area:hover {
            transform: translateY(-5px);
            transition: transform 0.3s;
        }
        /* Footer Styles */
        .footer {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem;
            text-align: center;
            color: white;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 1s ease-out;
        }
        .footer p {
            margin: 0;
            font-size: 0.9rem;
        }
        @media (max-width: 768px) {
            .header h2 {
                font-size: 1.5rem;
            }
            .user-info {
                flex-direction: column;
                align-items: flex-end;
                gap: 0.5rem;
            }
            .sidebar, .content-area {
                margin-bottom: 1rem;
                animation: slideInUp 0.6s ease-out;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h2><a href="index.php"><i class="fas fa-utensils me-2"></i>Admin Page</a></h2>
                </div>
                <div class="col-md-9">
                    <div class="user-info d-flex justify-content-end">
                        <span><a href="?f=user&m=updateuser&id=<?php echo $_SESSION['iduser']; ?>"><i class="fas fa-user me-1"></i> <?php echo $_SESSION['user']; ?></a></span>
                        <span><i class="fas fa-shield-alt me-1"></i> Level: <?php echo $_SESSION['level']; ?></span>
                        <a href="?log=logout" class="logout-btn"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Content Section -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <ul class="nav flex-column">
                            <?php 
                                $level = $_SESSION['level'];
                                switch ($level) {
                                    case 'admin':
                                        echo '
                                            <li class="nav-item"><a class="nav-link" href="?f=kategori&m=select"><i class="fas fa-tags"></i> Kategori</a></li>
                                            <li class="nav-item"><a class="nav-link" href="?f=menu&m=select"><i class="fas fa-book"></i> Menu</a></li>
                                            <li class="nav-item"><a class="nav-link" href="?f=pelanggan&m=select"><i class="fas fa-users"></i> Pelanggan</a></li>
                                            <li class="nav-item"><a class="nav-link" href="?f=order&m=select"><i class="fas fa-shopping-cart"></i> Order</a></li>
                                            <li class="nav-item"><a class="nav-link" href="?f=orderdetail&m=select"><i class="fas fa-list"></i> Order Detail</a></li>
                                            <li class="nav-item"><a class="nav-link" href="?f=user&m=select"><i class="fas fa-user-cog"></i> User</a></li>
                                        ';
                                        break;
                                    case 'kasir':
                                        echo '
                                            <li class="nav-item"><a class="nav-link" href="?f=order&m=select"><i class="fas fa-shopping-cart"></i> Order</a></li>
                                            <li class="nav-item"><a class="nav-link" href="?f=orderdetail&m=select"><i class="fas fa-list"></i> Order Detail</a></li>
                                        ';
                                        break;
                                    case 'koki':
                                        echo '
                                            <li class="nav-item"><a class="nav-link" href="?f=orderdetail&m=select"><i class="fas fa-list"></i> Order Detail</a></li>
                                        ';
                                        break;
                                    default:
                                        echo '<li class="nav-item"><span class="nav-link">Tidak Ada Menu</span></li>';
                                        break;
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="content-area">
                        <?php 
                            if (isset($_GET['f']) && isset($_GET['m'])) {
                                $f = $_GET['f'];
                                $m = $_GET['m'];
                                $file = '../'.$f.'/'.$m.'.php';
                                require_once $file;
                            } else {
                                require_once "../menu/select.php";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <p>2015 - copyright@smkrevit</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>