<?php 
    session_start();
    require_once "dbcontroller.php";
    $db = new DB;
    $sql = "SELECT * FROM tblkategori ORDER BY kategori ";
    $row = $db->getALL($sql);

    if (isset($_GET['log'])) {
        session_destroy();
        header("Location:index.php");
    }

    function cart(){
        global $db;
        $cart = 0;
        foreach ($_SESSION as $key => $value) {
            if ($key<>'pelanggan' && $key<>'idpelanggan' && $key<>'user' && $key<>'level' && $key<>'iduser') {
                $id = substr($key,1);
                $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
                $row = $db->getALL($sql);

                foreach ($row as $r) {
                    $cart++;
                }
            }
        }
        return $cart;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restauran SMK JAYA | Aplikasi Restauran SMK</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm animate-nav">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-utensils me-2"></i>Restauran SMK JAYA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php 
                    if (isset($_SESSION['pelanggan'])) {
                        echo '
                            <li class="nav-item">
                                <a class="nav-link" href="?f=home&m=beli"><i class="fas fa-user me-1"></i>'.$_SESSION['pelanggan'].'</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?f=home&m=beli"><i class="fas fa-shopping-cart me-1"></i>Cart ('.cart().')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?f=home&m=history"><i class="fas fa-history me-1"></i>History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?log=logout"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
                            </li>
                        ';
                    } else {
                        echo '
                            <li class="nav-item">
                                <a class="nav-link" href="?f=home&m=login"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?f=home&m=daftar"><i class="fas fa-user-plus me-1"></i>Daftar</a>
                            </li>
                        ';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Sidebar: Categories -->
            <div class="col-md-3">
                <div class="card shadow-sm animate-card">
                    <div class="card-header bg-gradient-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-list me-2"></i>Kategori</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($row)) { ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($row as $r): ?>
                            <li class="list-group-item">
                                <a href="?f=home&m=product&id=<?php echo $r['idkategori']; ?>" class="text-decoration-none">
                                    <i class="fas fa-tag me-2"></i><?php echo $r['kategori']; ?>
                                </a>
                            </li>
                            <?php endforeach ?>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-9">
                <div class="card shadow-sm animate-card">
                    <div class="card-body">
                        <?php 
                        if (isset($_GET['f']) && isset($_GET['m'])) {
                            $f = $_GET['f'];
                            $m = $_GET['m'];
                            $file = $f.'/'.$m.'.php';
                            require_once $file;
                        } else {
                            require_once "home/menu.php";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-dark text-white text-center py-4 animate-footer">
        <div class="container">
            <p class="mb-0"><i class="fas fa-copyright me-2"></i>© 2015 - <?php echo date("Y"); ?> Restauran SMK JAYA. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <!-- Intersection Observer for Footer Animation -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const footer = document.querySelector('.animate-footer');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        footer.classList.add('footer-visible');
                        observer.unobserve(footer);
                    }
                });
            }, { threshold: 0.1 });
            observer.observe(footer);
        });
    </script>
</body>
</html>