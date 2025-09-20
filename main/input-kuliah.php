<?php
require_once 'config.php';
session_start();

// mahasiswa
$query_mhs = "SELECT NIM, Nama FROM Mahasiswa ORDER BY NIM ASC";
$result_mhs = mysqli_query($conn, $query_mhs);
$data_mahasiswa = mysqli_fetch_all($result_mhs, MYSQLI_ASSOC);

//dosen
$query_dosen = "SELECT NIP, Nama FROM Dosen ORDER BY NIP ASC";
$result_dosen = mysqli_query($conn, $query_dosen);
$data_dosen = mysqli_fetch_all($result_dosen, MYSQLI_ASSOC);

//matkul
$query_mk = "SELECT KodeMatkul, NamaMatkul FROM Matakuliah ORDER BY KodeMatkul ASC";
$result_mk = mysqli_query($conn, $query_mk);
$data_mk = mysqli_fetch_all($result_mk, MYSQLI_ASSOC);

$IDKuliah      = "";
$NIM     = "";
$NIP   = "";
$KodeMatkul = "";
$Nilai = "";
$IDKuliah_lama = "";
$error    = "";
$mode_edit = false;

if (isset($_GET['IDKuliah'])) {
    $mode_edit = true;
    $IDKuliah_lama = $_GET['IDKuliah'];

    $sql_get = "SELECT * FROM Kuliah WHERE IDKuliah = '$IDKuliah_lama'";
    $query_get = mysqli_query($conn, $sql_get);
    $result = mysqli_fetch_array($query_get);

    if ($result) {
        $IDKuliah    = $result['IDKuliah'];
        $NIM   = $result['NIM'];
        $NIP = $result['NIP'];
        $KodeMatkul = $result['KodeMatkul'];
        $Nilai = $result['Nilai'];
    } else {
        $error = "Data tidak ditemukan.";
        $IDKuliah_lama = "";
    }
}

if (isset($_POST['Simpan'])) {
    $IDKuliah      = $_POST['IDKuliah'];
    $NIM     = $_POST['NIM'];
    $NIP   = $_POST['NIP'];
    $KodeMatkul = $_POST['KodeMatkul'];
    $Nilai = $_POST['Nilai'];
    $IDKuliah_lama = $_POST['IDKuliah_lama'];

    if ($IDKuliah == '' || $NIM == '' || $NIP == '' || $KodeMatkul == '' || $Nilai == '') {
        $error = "Semua field wajib diisi.";
    }

    if(empty($IDKuliah_lama) || (!empty($IDKuliah_lama) && ($IDKuliah !== $IDKuliah_lama))) {
        $check_sql = "SELECT IDKuliah FROM Kuliah WHERE IDKuliah = '$IDKuliah'";
        $query_check = mysqli_query($conn, $check_sql);

        if(mysqli_num_rows($query_check) > 0) {
            $error = "IDKuliah '$IDKuliah' sudah terdaftar. Silakan gunakan IDKuliah yang lain.";
        }
    }

    if (empty($error)) {
        if ($IDKuliah_lama) {
            $sql_query = "UPDATE Kuliah SET IDKuliah='$IDKuliah', NIM='$NIM', NIP='$NIP', KodeMatkul='$KodeMatkul', Nilai='$Nilai' WHERE IDKuliah = '$IDKuliah_lama'";
        } else {
            $sql_query = "INSERT INTO Kuliah(IDKuliah, NIM, NIP, KodeMatkul, Nilai) VALUES ('$IDKuliah', '$NIM', '$NIP','$KodeMatkul', '$Nilai')";
        }
        
        $execution = mysqli_query($conn, $sql_query);
        
        if ($execution) {
            $_SESSION['sukses'] = "Berhasil menyimpan data.";
            header("Location: kuliah.php");
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
    <title><?php echo ($mode_edit) ? "Edit" : "Input"; ?> Data Kuliah</title>
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
                <?php echo ($mode_edit) ? "Edit Data Kuliah" : "Input Data Kuliah"; ?>
            </h1>
            
            <?php if ($error) : ?>
                <div class="alert alert-danger" role="alert"><?php echo $error ?></div>
            <?php endif; ?>

            <form action="" method="post">
                <input type="hidden" name="IDKuliah_lama" value="<?php echo $IDKuliah_lama; ?>">

                <div class="mb-3">
                    <label for="IDKuliah" class="form-label">IDKuliah</label>
                    <input type="number" class="form-control" id="IDKuliah" name="IDKuliah" value="<?php echo $IDKuliah; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="NIM" class="form-label">NIM</label>
                    <select class="form-select" name="NIM" id="NIM" required>
                        <option value="">Pilih Mahasiswa</option>
                        <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                            <option value="<?php echo $mahasiswa['NIM']; ?>" <?php if($NIM == $mahasiswa['NIM']) echo 'selected' ?>>
                                <?php echo $mahasiswa['NIM'] . ' - ' . $mahasiswa['Nama']; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="NIP" class="form-label">NIP</label>
                    <select class="form-select" name="NIP" id="NIP" required>
                        <option value="">Pilih Dosen</option>
                        <?php foreach ($data_dosen as $dosen) : ?>
                            <option value="<?php echo $dosen['NIP']; ?>" <?php if($NIP == $dosen['NIP']) echo 'selected' ?>>
                                <?php echo $dosen['NIP'] . ' - ' . $dosen['Nama']; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="KodeMatkul" class="form-label">Kode Mata Kuliah</label>
                    <select class="form-select" name="KodeMatkul" id="KodeMatkul" required>
                        <option value="">Pilih Mata Kuliah</option>
                        <?php foreach ($data_mk as $matakuliah) : ?>
                            <option value="<?php echo $matakuliah['KodeMatkul']; ?>" <?php if($KodeMatkul == $matakuliah['KodeMatkul']) echo 'selected'; ?>>
<option value="<?php echo $matakuliah['KodeMatkul']; ?>" <?php if($KodeMatkul == $matakuliah['KodeMatkul']) echo 'selected'; ?>>                                <?php echo $matakuliah['KodeMatkul'] . ' - ' . $matakuliah['NamaMatkul']; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Nilai" class="form-label">Nilai</label>
                    <input type="number" step="0.01" class="form-control" id="Nilai" name="Nilai" value="<?php echo $Nilai; ?>" required>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <input type="submit" class="btn btn-custom fw-medium" name="Simpan" value="Simpan Data" style="background-color: lightpink;">
                    <a href="kuliah.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>