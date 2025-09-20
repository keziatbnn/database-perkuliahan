<?php
require_once 'config.php';
session_start();

$KodeMatkul = "";
$NamaMatkul = "";
$SKS = "";
$Semester = "";
$KodeMatkul_lama = "";
$error = "";
$mode_edit = false;

if (isset($_GET['KodeMatkul'])) {
    $mode_edit = true;
    $KodeMatkul_lama = $_GET['KodeMatkul'];

    $sql_get = "SELECT * FROM MataKuliah WHERE KodeMatkul = '$KodeMatkul_lama'";
    $query_get = mysqli_query($conn, $sql_get);
    $result = mysqli_fetch_array($query_get);

    if ($result) {
        $KodeMatkul = $result['KodeMatkul'];
        $NamaMatkul   = $result['NamaMatkul'];
        $SKS = $result['SKS'];
        $Semester = $result['Semester'];
    } else {
        $error = "Data tidak ditemukan.";
        $KodeMatkul_lama = "";
    }
}

if (isset($_POST['Simpan'])) {
    $KodeMatkul      = $_POST['KodeMatkul'];
    $NamaMatkul     = $_POST['NamaMatkul'];
    $SKS   = $_POST['SKS'];
    $Semester   = $_POST['Semester'];
    $KodeMatkul_lama = $_POST['KodeMatkul_lama'];

    if ($KodeMatkul == '' || $NamaMatkul == '' || $SKS == '') {
        $error = "Semua field wajib diisi.";
    }

    if(empty($KodeMatkul_lama) || (!empty($KodeMatkul_lama) && ($KodeMatkul !== $KodeMatkul_lama))) {
        $check_sql = "SELECT KodeMatkul FROM MataKuliah WHERE KodeMatkul = '$KodeMatkul'";
        $query_check = mysqli_query($conn, $check_sql);

        if(mysqli_num_rows($query_check) > 0) {
            $error = "Kode Mata Kuliah '$KodeMatkul' sudah terdaftar. Silakan gunakan Kode Mata Kuliah yang lain.";
        }
    }

    if (empty($error)) {
        if ($KodeMatkul_lama) {
            $sql_query = "UPDATE MataKuliah SET KodeMatkul='$KodeMatkul', NamaMatkul='$NamaMatkul', SKS='$SKS', Semester='$Semester' WHERE KodeMatkul = '$KodeMatkul_lama'";
        } else {
            $sql_query = "INSERT INTO MataKuliah(KodeMatkul, NamaMatkul, SKS, Semester) VALUES ('$KodeMatkul', '$NamaMatkul', '$SKS', '$Semester')";
        }
        
        $execution = mysqli_query($conn, $sql_query);
        
        if ($execution) {
            $_SESSION['sukses'] = "Berhasil menyimpan data.";
            header("Location: matakuliah.php");
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
    <title><?php echo ($mode_edit) ? "Edit" : "Input"; ?> Data MataKuliah</title>
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
                <?php echo ($mode_edit) ? "Edit Data Mata Kuliah" : "Input Data Mata Kuliah"; ?>
            </h1>
            
            <?php if ($error) : ?>
                <div class="alert alert-danger" role="alert"><?php echo $error ?></div>
            <?php endif; ?>

            <form action="" method="post">
                <input type="hidden" name="KodeMatkul_lama" value="<?php echo $KodeMatkul_lama; ?>">

                <div class="mb-3">
                    <label for="KodeMatkul" class="form-label">Kode Mata Kuliah</label>
                    <input type="text" class="form-control" id="KodeMatkul" name="KodeMatkul" value="<?php echo $KodeMatkul; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="NamaMatkul" class="form-label">Nama Mata Kuliah</label>
                    <input type="text" class="form-control" id="NamaMatkul" name="NamaMatkul" value="<?php echo $NamaMatkul; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="SKS" class="form-label">SKS</label>
                    <input type="number" class="form-control" id="SKS" name="SKS" value="<?php echo $SKS; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Semester" class="form-label">Semester</label>
                    <input type="number" class="form-control" id="Semester" name="Semester" value="<?php echo $Semester; ?>" required>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <input type="submit" class="btn btn-custom fw-medium" name="Simpan" value="Simpan Data" style="background-color: lightpink;">
                    <a href="matakuliah.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>