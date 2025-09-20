<?php
require_once 'config.php';

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

$sukses = "";

if ($op == 'delete') {
    $NIP = $_GET['id'];
    $sql1 = "delete from Dosen where NIP = '$NIP'";
    $q1 = mysqli_query($conn, $sql1);

    if ($q1) {
        $sukses = "Berhasil menghapus data.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=database" />
    <style>
        .tombol {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .tombol:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
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
    <main class="px-4">
        <h1 class="text-center p-3">Data Dosen</h1>
        <?php
        if ($sukses) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php echo $sukses ?>
            </div>
        <?php
        }
        ?>

        <p>
            <a href="input-dosen.php">
                <input type="button" class="btn fw-medium tombol text-dark" style="background-color: lightpink;" value="+ Tambah Data">
            </a>
        </p>
        <table class="table table-striped px-2">
            <thead>
                <tr>
                    <th class="col-1">No.</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql1 = "select * from Dosen";
                $q1 = mysqli_query($conn, $sql1);
                $nomor = 1;
                while ($r1 = mysqli_fetch_array($q1)) {
                ?>
                    <tr>
                        <td><?php echo $nomor++ ?></td>
                        <td><?php echo $r1['NIP'] ?></td>
                        <td><?php echo $r1['Nama'] ?></td>
                        <td><?php echo $r1['Alamat'] ?></td>
                        <td>
                            <a href="input-dosen.php?NIP=<?php echo $r1['NIP'] ?>" class="text-decoration-none">
                                <span class="badge bg-warning text-dark tombol">Edit</span>
                            </a>
                            <a href="dosen.php?op=delete&id=<?php echo $r1['NIP'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')">
                                <span class="badge bg-danger tombol">Delete</span>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>