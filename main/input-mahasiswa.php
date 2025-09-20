<?php
require_once 'config.php';
session_start();

$NIM      = "";
$Nama     = "";
$Alamat   = "";
$NIM_lama = "";
$error    = "";
$mode_edit = false;

if (isset($_GET['NIM'])) {
    $mode_edit = true;
    $NIM_lama = $_GET['NIM'];

    $sql_get = "SELECT * FROM Mahasiswa WHERE NIM = '$NIM_lama'";
    $query_get = mysqli_query($conn, $sql_get);
    $result = mysqli_fetch_array($query_get);

    if ($result) {
        $NIM    = $result['NIM'];
        $Nama   = $result['Nama'];
        $Alamat = $result['Alamat'];
    } else {
        $error = "Data tidak ditemukan.";
        $NIM_lama = "";
    }
}

if (isset($_POST['Simpan'])) {
    $NIM      = $_POST['NIM'];
    $Nama     = $_POST['Nama'];
    $Alamat   = $_POST['Alamat'];
    $NIM_lama = $_POST['NIM_lama'];

    if ($NIM == '' || $Nama == '' || $Alamat == '') {
        $error = "Semua field wajib diisi.";
    }

    if(empty($NIM_lama) || (!empty($NIM_lama) && ($NIM !== $NIM_lama))) {
        $check_sql = "SELECT NIM FROM Mahasiswa WHERE NIM = '$NIM'";
        $query_check = mysqli_query($conn, $check_sql);

        if(mysqli_num_rows($query_check) > 0) {
            $error = "NIM '$NIM' sudah terdaftar. Silakan gunakan NIM yang lain.";
        }
    }

    if (empty($error)) {
        if ($NIM_lama) {
            $sql_query = "UPDATE Mahasiswa SET NIM='$NIM', Nama='$Nama', Alamat='$Alamat' WHERE NIM = '$NIM_lama'";
        } else {
            $sql_query = "INSERT INTO Mahasiswa(NIM, Nama, Alamat) VALUES ('$NIM', '$Nama', '$Alamat')";
        }
        
        $execution = mysqli_query($conn, $sql_query);
        
        if ($execution) {
            $_SESSION['sukses'] = "Berhasil menyimpan data.";
            header("Location: mahasiswa.php");
            exit();
        } else {
            $error = "Gagal menyimpan data ke database.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($mode_edit) ? "Edit" : "Input"; ?> Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=database" />
    <style>        
        .form-container {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .btn-custom, .btn-secondary {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .btn-custom:hover, .btn-secondary:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
       <nav class="navbar navbar-expand-lg py-2 px-2" style="background-color: lightpink;">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center fw-bold" href="#">
                    <span class="material-symbols-outlined mx-2 me-2">database</span>
                    Database Perkuliahan
                </a>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="index.php">Home</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container my-5">
        <div class="form-container">
            <h1 class="text-center p-3 mb-4">
                <?php echo ($mode_edit) ? "Edit Data Mahasiswa" : "Input Data Mahasiswa"; ?>
            </h1>
            
            <?php if ($error) : ?>
                <div class="alert alert-danger" role="alert"><?php echo $error ?></div>
            <?php endif; ?>

            <form action="" method="post">
                <input type="hidden" name="NIM_lama" value="<?php echo $NIM_lama; ?>">

                <div class="mb-3">
                    <label for="NIM" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="NIM" name="NIM" value="<?php echo $NIM; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="Nama" name="Nama" value="<?php echo $Nama; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="Alamat" name="Alamat" value="<?php echo $Alamat; ?>" required>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <input type="submit" class="btn btn-custom fw-medium" name="Simpan" value="Simpan Data" style="background-color: lightpink;">
                    <a href="mahasiswa.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>