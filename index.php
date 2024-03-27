<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "tugas2";

$conn = new mysqli($host, $user, $password, $database);

// Fungsi untuk menambah data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah'])) {
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $npm = $_POST['npm'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $no_telepon = $_POST['no_telepon'];
    $hobby = $_POST['hobby'];
    $email = $_POST['email'];

    $sql = "INSERT INTO data_pribadi (nik, nama_lengkap, npm, tanggal_lahir, tempat_lahir, no_telepon, hobby, email) VALUES ('$nik', '$nama_lengkap', '$npm', '$tanggal_lahir', '$tempat_lahir', '$no_telepon', '$hobby', '$email')";
    $conn->query($sql);
}

// Fungsi untuk mengedit data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $npm = $_POST['npm'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $no_telepon = $_POST['no_telepon'];
    $hobby = $_POST['hobby'];
    $email = $_POST['email'];

    $sql = "UPDATE data_pribadi SET nik='$nik', nama_lengkap='$nama_lengkap', npm='$npm', tanggal_lahir='$tanggal_lahir', tempat_lahir='$tempat_lahir', no_telepon='$no_telepon', hobby='$hobby', email='$email' WHERE id=$id";
    $conn->query($sql);
}

// Fungsi untuk menghapus data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM data_pribadi WHERE id=$id";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pribadi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Data Pribadi</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nik">NIK (Nomor Induk Kependudukan):</label>
                <input type="number" class="form-control" id="nik" name="nik" pattern="[0-9]{16}" maxlength="16" required>
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" minlength="5" required>
            </div>
            <div class="form-group">
                <label for="npm">NPM:</label>
                <input type="number" class="form-control" id="npm" name="npm" pattern="[0-9]+" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir:</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
            </div>
            <div class="form-group">
                <label for="no_telepon">Nomor Telepon:</label>
                <input type="number" class="form-control" id="no_telepon" name="no_telepon" pattern="[0-9]+" required>
            </div>
            <div class="form-group">
                <label for="hobby">Hobby:</label>
                <input type="text" class="form-control" id="hobby" name="hobby" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
        </form>

        <hr>

        <table class="table">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>NPM</th>
                    <th>Tanggal Lahir</th>
                    <th>Tempat Lahir</th>
                    <th>Nomor Telepon</th>
                    <th>Hobby</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM data_pribadi";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['nik'] . "</td>
                            <td>" . $row['nama_lengkap'] . "</td>
                            <td>" . $row['npm'] . "</td>
                            <td>" . $row['tanggal_lahir'] . "</td>
                            <td>" . $row['tempat_lahir'] . "</td>
                            <td>" . $row['no_telepon'] . "</td>
                            <td>" . $row['hobby'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td class=' d-flex gap-6'>
                                <button type='button' class='btn  edit-btn' data-toggle='modal' data-target='#editModal' data-id='" . $row['id'] . "' data-nik='" . $row['nik'] . "' data-nama-lengkap='" . $row['nama_lengkap'] . "' data-npm='" . $row['npm'] . "' data-tanggal-lahir='" . $row['tanggal_lahir'] . "' data-tempat-lahir='" . $row['tempat_lahir'] . "' data-no-telepon='" . $row['no_telepon'] . "' data-hobby='" . $row['hobby'] . "' data-email='" . $row['email'] . "'><i class='fas fa-edit text-primary'></i></button>
                                <button type='button' class='btn  delete-btn' data-toggle='modal' data-target='#deleteModal' data-id='" . $row['id'] . "'><i class='fas fa-trash text-danger'></i></a>
                                </button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal untuk Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-nik">NIK (Nomor Induk Kependudukan):</label>
                            <input type="number" class="form-control" id="edit-nik" name="nik" pattern="[0-9]{16}" maxlength="16" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-nama-lengkap">Nama Lengkap:</label>
                            <input type="text" class="form-control" id="edit-nama-lengkap" name="nama_lengkap" minlength="5" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-npm">NPM:</label>
                            <input type="number" class="form-control" id="edit-npm" name="npm" pattern="[0-9]+" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-tanggal-lahir">Tanggal Lahir:</label>
                            <input type="date" class="form-control" id="edit-tanggal-lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-tempat-lahir">Tempat Lahir:</label>
                            <input type="text" class="form-control" id="edit-tempat-lahir" name="tempat_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-no-telepon">Nomor Telepon:</label>
                            <input type="number" class="form-control" id="edit-no-telepon" name="no_telepon" pattern="[0-9]+" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-hobby">Hobby:</label>
                            <input type="text" class="form-control" id="edit-hobby" name="hobby" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email:</label>
                            <input type="email" class="form-control" id="edit-email" name="email" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <input type="hidden" id="delete-id" name="id">
                        <p>Apakah Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Event untuk tombol Edit
            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                var nik = $(this).data('nik');
                var namaLengkap = $(this).data('nama-lengkap');
                var npm = $(this).data('npm');
                var tanggalLahir = $(this).data('tanggal-lahir');
                var tempatLahir = $(this).data('tempat-lahir');
                var noTelepon = $(this).data('no-telepon');
                var hobby = $(this).data('hobby');
                var email = $(this).data('email');

                $('#edit-id').val(id);
                $('#edit-nik').val(nik);
                $('#edit-nama-lengkap').val(namaLengkap);
                $('#edit-npm').val(npm);
                $('#edit-tanggal-lahir').val(tanggalLahir);
                $('#edit-tempat-lahir').val(tempatLahir);
                $('#edit-no-telepon').val(noTelepon);
                $('#edit-hobby').val(hobby);
                $('#edit-email').val(email);
            });

            // Event untuk tombol Hapus
            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                $('#delete-id').val(id);
            });
        });
    </script>
</body>
</html>