<form class="row" method="POST" action="" name="myForm" onSubmit="validate()">
            <?php
            $nama = '';
            $alamat = '';
            $no_hp = '';
            if (isset($_GET['id'])) {$ambil = mysqli_query($mysqli,"SELECT * FROM pasien WHERE id='" . $_GET['id'] . "'");
                while ($row = mysqli_fetch_array($ambil)) {
                    $nama = $row['nama'];
                    $alamat = $row['alamat'];
                    $no_hp = $row['no_hp'];
                }
            ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <?php
            }
            ?>
            <div class="row">
                <div class="col">
                    <label for="inputIsi" class="form-label fw-bold">
                        Pasien
                    </label>
                    <input type="text" class="form-control" name="nama" id="inputIsi" placeholder="Pasien" value="<?php echo $nama ?>">
                </div>
                <div class="col">
                    <label for="inputalamat" class="form-label fw-bold">
                        Alamat
                    </label>
                    <input type="text" class="form-control" name="alamat" id="inputtanggalawal" placeholder="Alamat" value="<?php echo $alamat ?>">
                </div>
                <div class="col mb-2">
                    <label for="inputTanggalAkhir" class="form-label fw-bold">
                        No hp
                    </label>
                    <input type="text" class="form-control" name="no_hp" id="inputTanggalAkhir" placeholder="No hp" value="<?php echo $no_hp ?>">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
                </div>
            </form>
            
    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">No HP</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $result = mysqli_query($mysqli,"SELECT * FROM pasien ORDER BY nama");
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <th scope="row"><?php echo $no++ ?></th>
                <td><?php echo $data['nama'] ?></td>
                <td><?php echo $data['alamat'] ?></td>
                <td><?php echo $data['no_hp'] ?></td>
                <td>
                    <a class="btn btn-info rounded-pill px-3" href="index.php?id=<?php echo $data['id'] ?>&page=pasien">Ubah
                    </a>
                    <a class="btn btn-danger rounded-pill px-3" href="index.php?id=<?php echo $data['id'] ?>&aksi=hapus&page=pasien">Hapus
                    </a>
                </td>

            </tr>
        <?php
        }
        ?>

    </tbody>
</table>

<?php
if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE pasien SET 
                                        nama = '" . $_POST['nama'] . "',
                                        alamat = '" . $_POST['alamat'] . "',
                                        no_hp = '" . $_POST['no_hp'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO pasien(nama,alamat,no_hp) 
                                        VALUES ( 
                                            '" . $_POST['nama'] . "',
                                            '" . $_POST['alamat'] . "',
                                            '" . $_POST['no_hp'] . "'
                                            )");
    }
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=pasien'>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM pasien WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($mysqli, "UPDATE pasien SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERES
                                        id = '" . $_GET['id'] . "'");
    }
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=pasien'>";
}
?>