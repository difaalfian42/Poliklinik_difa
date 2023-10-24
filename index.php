<?php
include_once("koneksi.php")
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Sistem Informasi Poliklinik
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="index.php?page=dokter">
                                    Dokter
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="index.php?page=pasien">
                                    Pasien
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=periksa">
                            Periksa
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main role="main" class="container">
        <?php
        if (isset($_GET['page'])) {
        ?>
            <h2><?php echo ucwords($_GET['page']) ?></h2>
        <?php
            include($_GET['page'] . ".php");
        } else {
            echo "Selamat Datang di Sistem Informasi Poliklinik";
        }
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>