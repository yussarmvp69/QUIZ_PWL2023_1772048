<!--    Yussar Ma'arif Volindra Pratma 1772048  -->
<?php
session_start();
include_once 'utility/db_util.php';
include_once 'function/user.php';
if (!isset($_SESSION['registered_user'])) {
    $_SESSION['registered_user'] =  false;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="home.css">
    <title>Document</title>
</head>

<body>
    <?php
    if ($_SESSION['registered_user']) {
    ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">UltraBook</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="?menu=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?menu=ticket">Ticket Price</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?menu=parking">Parking Management</a>
                        </li>
                        <li>
                            <a class="nav-link" href="?menu=logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <?php
            $navigation = filter_input(INPUT_GET, 'menu');
            switch ($navigation) {
                case 'home':
                    include_once 'halaman/index.php';
                    break;
                case 'ticket':
                    include_once 'halaman/ticket.php';
                    break;
                case 'parking':
                    include_once 'halaman/parking.php';
                    break;
                case 'login':
                    include_once 'halaman/login.php';
                    break;
                case 'logout':
                    session_unset();
                    session_destroy();
                    header('location:index.php');
                    break;
                default:
                    include_once 'halaman/home.php';
            }
            ?>
        </main>
    <?php
    } else {
        include_once 'halaman/login.php';
    }
    ?>
</body>

</html>