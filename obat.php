<form class="row" method="POST" action="" name="myForm" onSubmit="validate()">
            <?php
            $nama_obat = '';
            $kemasan = '';
            $harga = '';
            if (isset($_GET['id'])) {$ambil = mysqli_query($mysqli,"SELECT * FROM obat WHERE id='" . $_GET['id'] . "'");
                while ($row = mysqli_fetch_array($ambil)) {
                    $nama_obat = $row['nama_obat'];
                    $kemasan = $row['kemasan'];
                    $harga = $row['harga'];
                }
            ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <?php
            }
            ?>
            <div class="row">
                <div class="col">
                    <label for="inputIsi" class="form-label fw-bold">
                        Nama Obat
                    </label>
                    <input type="text" class="form-control" name="nama_obat" id="inputIsi" placeholder="Nama obat" value="<?php echo $nama_obat ?>">
                </div>
                <div class="col">
                    <label for="inputalamat" class="form-label fw-bold">
                        Kemasan
                    </label>
                    <input type="text" class="form-control" name="kemasan" id="inputtanggalawal" placeholder="Kemasan" value="<?php echo $kemasan ?>">
                </div>
                <div class="col mb-2">
                    <label for="inputTanggalAkhir" class="form-label fw-bold">
                        Harga
                    </label>
                    <input type="text" class="form-control" name="harga" id="inputTanggalAkhir" placeholder="Harga" value="<?php echo $harga ?>">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
                </div>
            </form>
            
    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Obat</th>
            <th scope="col">Kemasan</th>
            <th scope="col">Harga</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $result = mysqli_query($mysqli,"SELECT * FROM obat ORDER BY nama_obat");
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <th scope="row"><?php echo $no++ ?></th>
                <td><?php echo $data['nama_obat'] ?></td>
                <td><?php echo $data['kemasan'] ?></td>
                <td><?php echo $data['harga'] ?></td>
                <td>
                    <a class="btn btn-info rounded-pill px-3" href="index.php?id=<?php echo $data['id'] ?>&page=obat">Ubah
                    </a>
                    <a class="btn btn-danger rounded-pill px-3" href="index.php?id=<?php echo $data['id'] ?>&aksi=hapus&page=obat">Hapus
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
        $ubah = mysqli_query($mysqli, "UPDATE obat SET 
                                        nama_obat = '" . $_POST['nama_obat'] . "',
                                        kemasan = '" . $_POST['kemasan'] . "',
                                        harga = '" . $_POST['harga'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO obat(nama_obat,kemasan,harga) 
                                        VALUES ( 
                                            '" . $_POST['nama_obat'] . "',
                                            '" . $_POST['kemasan'] . "',
                                            '" . $_POST['harga'] . "'
                                            )");
    }
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=obat'>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM obat WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($mysqli, "UPDATE obat SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERES
                                        id = '" . $_GET['id'] . "'");
    }
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=obat'>";
}
?>