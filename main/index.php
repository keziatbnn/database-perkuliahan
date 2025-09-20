<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Perkuliahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=database" />
    <style>
        header {
            font-family: Georgia, serif;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar align-items-center py-2 px-2" style="background-color: lightpink;">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center fw-bold" href="#">
                    <span class="material-symbols-outlined mx-2 me-2">database</span>
                    Database Perkuliahan
                </a>
            </div>
        </nav>
    </header>
    <main>
        <div >
            <a href="dosen.php">Dosen</a>
            <p>Tabel berisi data dosen.</p>
        </div>
        <div>
            <a href="mahasiswa.php">Mahasiswa</a>
            <p>Tabel berisi data mahasiswa.</p>
        </div>
        <div>
            <a href="matakuliah.php">Mata Kuliah</a>
            <p>Tabel berisi data mata kuliah.</p>
        </div>
        <div>
            <a href="kuliah.php">Kuliah</a>
            <p>Tabel berisi data kuliah.</p>
        </div>
    </main>
    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>