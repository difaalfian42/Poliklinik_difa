<form class="row" method="POST" action="" name="myForm" onSubmit="validate()">
    <?php
    $pasien = '';
    $dokter = '';
    $tgl_periksa = '';
    $catatan = '';
    if (isset($_GET['id'])) {
        $ambil = mysqli_query($mysqli, "SELECT * FROM periksa WHERE id='" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $id_pasien = $row['id_pasien'];
            $id_dokter = $row['id_dokter'];
            $tgl_periksa = $row['tgl_periksa'];
            $catatan = $row['catatan'];
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
            <div class="form-group mx-sm-3 mb-2">
                <select class="form-control" name="id_pasien">
                    <?php
                    $selected = '';
                    $pasien = mysqli_query($mysqli, "SELECT * FROM pasien");
                    while ($data = mysqli_fetch_array($pasien)) {
                        if ($data['id'] == $id_pasien) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        }
                    ?>
                        <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col">
            <label for="inputalamat" class="form-label fw-bold">
                Dokter
            </label>
            <div class="form-group mx-sm-3 mb-2">
                <select class="form-control" name="id_dokter">
                    <?php
                    $selected = '';
                    $dokter = mysqli_query($mysqli, "SELECT * FROM dokter");
                    while ($data = mysqli_fetch_array($dokter)) {
                        if ($data['id'] == $id_dokter) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        }
                    ?>
                        <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col mb-2">
            <label for="inputTanggalAkhir" class="form-label fw-bold">
                Tanggal Periksa
            </label>
            <input type="datetime-local" class="form-control" name="tgl_periksa" placeholder="Tanggal Periksa" value="<?php echo $tgl_periksa ?>">
        </div>
        <div class="col">
            <label for="inputIsi" class="form-label fw-bold">
                Catatan
            </label>
            <input type="text" class="form-control" name="catatan" placeholder="Catatan" value="<?php echo $catatan ?>">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
        </div>
</form>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Pasien</th>
            <th scope="col">Dokter</th>
            <th scope="col">Tanggal periksa</th>
            <th scope="col">catatan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $result = mysqli_query($mysqli, "SELECT pr.*,d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter=d.id) LEFT JOIN pasien p ON (pr.id_pasien=p.id) ORDER BY pr.tgl_periksa DESC");
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <th scope="row"><?php echo $no++ ?></th>
                <td><?php echo $data['nama_pasien'] ?></td>
                <td><?php echo $data['nama_dokter'] ?></td>
                <td><?php echo $data['tgl_periksa'] ?></td>
                <td><?php echo $data['catatan'] ?></td>
                <td>
                    <a class="btn btn-info rounded-pill px-3" href="index.php?id=<?php echo $data['id'] ?>&page=periksa">Ubah
                    </a>
                    <a class="btn btn-danger rounded-pill px-3" href="index.php?id=<?php echo $data['id'] ?>&aksi=hapus&page=periksa">Hapus
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
        $ubah = mysqli_query($mysqli, "UPDATE periksa SET 
                                        id_pasien = '" . $_POST['id_pasien'] . "',
                                        id_dokter = '" . $_POST['id_dokter'] . "',
                                        tgl_periksa = '" . $_POST['tgl_periksa'] . "',
                                        catatan = '" . $_POST['catatan'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO periksa(id_pasien,id_dokter,tgl_periksa,catatan) 
                                        VALUES ( 
                                            '" . $_POST['id_pasien'] . "',
                                            '" . $_POST['id_dokter'] . "',
                                            '" . $_POST['tgl_periksa'] . "',
                                            '" . $_POST['catatan'] . "'
                                            )");
    }
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=periksa'>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM periksa WHERE id = '" . $_GET['id'] . "'");
    }
    echo "<meta http-equiv='refresh' content='0; url=index.php?page=periksa'>";
}
?>