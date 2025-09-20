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

        /* 3. CSS untuk efek hover pada card */
        .clickable-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .clickable-card:hover {
            transform: scale(1.03);
            /* Sedikit membesar saat di-hover */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            /* Tambah bayangan */
        }

        /* Membuat link di dalam card terlihat seperti teks biasa */
        .card-title-link {
            color: inherit;
            /* Mewarisi warna dari parent */
            text-decoration: none;
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

    <main class="container mt-5 pt-5">
        <div class="row g-4">

            <div class="col-md-6">
                <div class="p-4 border rounded-4 text-center position-relative clickable-card" style="background-color: lightpink;">
                    <h3 class="h4">
                        <a href="dosen.php" class="stretched-link card-title-link">Dosen</a>
                    </h3>
                    <p class="mt-2">Tabel berisi data dosen.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 border rounded-4 text-center position-relative clickable-card" style="background-color: lightpink;">
                    <h3 class="h4">
                        <a href="mahasiswa.php" class="stretched-link card-title-link">Mahasiswa</a>
                    </h3>
                    <p class="mt-2">Tabel berisi data mahasiswa.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 border rounded-4 text-center position-relative clickable-card" style="background-color: lightpink;">
                    <h3 class="h4">
                        <a href="matakuliah.php" class="stretched-link card-title-link">Mata Kuliah</a>
                    </h3>
                    <p class="mt-2">Tabel berisi data mata kuliah.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 border rounded-4 text-center position-relative clickable-card" style="background-color: lightpink;">
                    <h3 class="h4">
                        <a href="kuliah.php" class="stretched-link card-title-link">Kuliah</a>
                    </h3>
                    <p class="mt-2">Tabel transaksi berisi data kuliah.</p>
                </div>
            </div>

        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>