<form class="row" method="POST" action="" name="myForm" onSubmit="validate()">
            <?php
            $nama = '';
            $alamat = '';
            $no_hp = '';
            if (isset($_GET['id'])) {$ambil = mysqli_query($mysqli,"SELECT * FROM dokter WHERE id='" . $_GET['id'] . "'");
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
                        Dokter
                    </label>
                    <input type="text" class="form-control" name="nama" id="inputIsi" placeholder="dokter" value="<?php echo $nama ?>">
                </div>
                <div class="col">
                    <label for="inputalamat" class="form-label fw-bold">
                        Alamat
                    </label>
                    <input type="text" class="form-control" name="tgl_awal" id="inputtanggalawal" placeholder="Alamat" value="<?php echo $alamat ?>">
                </div>
                <div class="col mb-2">
                    <label for="inputTanggalAkhir" class="form-label fw-bold">
                        No hp
                    </label>
                    <input type="text" class="form-control" name="tgl_akhir" id="inputTanggalAkhir" placeholder="No hp" value="<?php echo $no_hp ?>">
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
            <th scope="col">No HP</th>
            <th scope="col">Akhir</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $result = mysqli_query($mysqli,"SELECT * FROM dokter ORDER BY nama");
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <th scope="row"><?php echo $no++ ?></th>
                <td><?php echo $data['nama'] ?></td>
                <td><?php echo $data['alamat'] ?></td>
                <td><?php echo $data['no_hp'] ?></td>

                <td>
                    <?php
                    if ($data['status'] == '1') {
                    ?>
                        <a class="btn btn-success rounded-pill px-3" type="button" href="index.php?id=<?php echo $data['id'] ?>&aksi=ubah_status&status=0">
                        Sudah
                        </a>
                    <?php
                    } else {
                    ?>
                        <a class="btn btn-warning rounded-pill px-3" type="button" href="index.php?id=<?php echo $data['id'] ?>&aksi=ubah_status&status=1">
                        Belum</a>
                    <?php
                    }
                    ?>
                </td>

                <td>
                    <a class="btn btn-info rounded-pill px-3" href="index.php?id=<?php echo $data['id'] ?>">Ubah
                    </a>
                    <a class="btn btn-danger rounded-pill px-3" href="index.php?id=<?php echo $data['id'] ?>&aksi=hapus">Hapus
                    </a>
                </td>

            </tr>
        <?php
        }
        ?>

    </tbody>
</table>