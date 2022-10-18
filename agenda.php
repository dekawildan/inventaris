<?php
 include "cek-sesi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Inventaris</title>
    <link href="desain.css" rel="stylesheet">
    <link href="all.min.css" rel="stylesheet">
    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!--Header aplikasi-->
    <header>
        <div class="header1">
            <h3 style="text-align: center;">ADMIN</h3>
        </div>
        <div class="header2">
            <button type="button" class="ham" id="ham" onclick="sembunyi()">
                <div class="burger"></div>
                <div class="burger"></div>
                <div class="burger"></div>
            </button>
            <button type="button" class="ham" id="burger" onclick="tampil()" style="display: none;">
                <p style="margin: 0; padding: 0; font-weight: bolder; font-size: 12pt; color: white;">&times;</p>
            </button>
            <h3>APLIKASI INVENTARIS</h3>
            <div class="user">
            <h4><?php $pengguna=strtoupper($_SESSION['username']); echo "HALO, $pengguna"; ?></h4>
            </div>
        </div>
    </header>

    <!--Sidebar sebelah kiri-->
    <aside id="aside">
        <nav>
            <ul>
                <li><a href="index.php"><span class="menu-icon"><i class="fas fa-home"></i></span> <span class="menu-teks">Dashboard</span></a></li>
                <li><a href="jurusan.php"><span class="menu-icon"><i class="fas fa-users-cog"></i></span> <span class="menu-teks">Jurusan</span></a></li>
                <li><a href="ruang.php"><span class="menu-icon"><i class="fas fa-sitemap"></i></span> <span class="menu-teks">Ruang</span></a></li>
                <li><a href="barang.php"><span class="menu-icon"><i class="fas fa-toolbox"></i></span> <span class="menu-teks">Barang</span></a></li>
                <li><a href="rusak.php"><span class="menu-icon"><i class="fas fa-tools"></i></span> <span class="menu-teks">Rusak</span></a></li>
                <li><a href="agenda.php" class="aktif"><span class="menu-icon"><i class="fas fa-toolbox"></i></span> <span class="menu-teks">Agenda Service</span></a></li>
                <li><a href="laporan.php"><span class="menu-icon"><i class="fas fa-list"></i></span> <span class="menu-teks">Laporan</span></a></li>
                <li><a href="logout.php"><span class="menu-icon"><i class="fas fa-power-off"></i></span> <span class="menu-teks">Keluar</span></a></li>
            </ul>
        </nav>
    </aside>

    <!--Artikel untuk konten-->
    <article id="article">
        <section>
            <p>&nbsp; <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahagenda">+ Tambah agenda</button></p>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    Cari : <br>
                    <input type="text" name="cari_data" placeholder="Masukkan data yang dicari..." class="form-control" style="width:85%; float:left;" required>&nbsp;<button class="btn btn-primary" type="submit" name="cari">Cari</button>
                </form>
            <p>&nbsp;
            <div class="table-responsive">
                <table class="table table_striped table-hover">
                    <thead>
                        <tr>
                        <th colspan="7" style="text-align:center; font-size: 1.5em;">DATA AGENDA</th>
                        </tr>
                        <tr>
                            <th>NO</th>
                            <th>KODE BARANG</th>
                            <th>NAMA BARANG</th>
                            <th>TANGGAL AGENDA</th>
                            <th>JENIS AGENDA</th>
                            <th>KETERANGAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "koneksi.php";
                            if(!isset($_POST['cari'])) {
                                $sql=mysqli_query($koneksi,"CALL tampil_agenda()");
                                $no=1;
                                while($row=mysqli_fetch_array($sql)) {
                                    echo "<tr>
                                        <td>".
                                        $no++
                                        ."</td>
                                        <td>$row[barang_kode]</td>
                                        <td>$row[barang_nama]</td>
                                        <td>$row[tgl_agenda]</td>
                                        <td>$row[jenis_agenda]</td>
                                        <td>$row[keterangan_agenda]</td>
                                        <td>
                                        <button class='btn btn-info' type='button' title='Edit $row[barang_nama]' data-bs-toggle='modal' data-bs-target='#edit$row[agenda_id]'>Edit</button>
                                        <button class='btn btn-warning' type='button' title='Hapus $row[barang_nama]' data-bs-toggle='modal' data-bs-target='#hapus$row[agenda_id]'>Hapus</button>
                                        </td>
                                    </tr>
                                    <div class='modal fade' id='edit$row[agenda_id]'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h4>Edit agenda barang $row[barang_nama]</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'>&nbsp;</button>
                        </div>
                        <div class='modal-body'>
                            <form method='post' action='update_agenda.php'>
                                <input type='hidden' name='agenda_id' value='$row[agenda_id]'>
                                Barang : <select name='barang_kode' class='form-control' required>
                                <option selected>$row[barang_kode]-$row[barang_nama]</option>";
                                include "koneksi.php";
                                $sqlbarang=mysqli_query($koneksi,"CALL tampil_barang()");
                                while($r=mysqli_fetch_array($sqlbarang)) {
                                    echo "<option>$r[barang_kode]-$r[barang_nama]</option>";
                                }
                                echo "</select>
                                Tanggal Agenda : <input type='date' name='tgl_agenda' value='$row[tgl_agenda]' class='form-control' required>
                                Jenis Agenda : <select name='jenis_agenda' class='form-control' required>
                                    <option selected>$row[jenis_agenda]</option>
                                    <option>PERBAIKAN</option>
                                    <option>PERAWATAN</option>
                                    <option>PENGGANTIAN</option>
                                </select>
                                Keterangan Agenda : <select name='keterangan_agenda' class='form-control' required>
                                    <option selected>$row[keterangan_agenda]</option>
                                    <option>BELUM DILAKSANAKAN</option>
                                    <option>PROSES DILAKSANAKAN</option>
                                    <option>SELESAI DILAKSANAKAN</option>
                                </select>
                                <br>
                                <button type='submit' class='btn btn-success'>Perbarui</button>
                                <button type='reset' class='btn btn-default' data-bs-dismiss='modal'>Batal</button>
                            </form>
                        </div>
                        <div class='modal-footer'>
                            <p>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class='modal fade' id='hapus$row[agenda_id]'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h4>Hapus agenda barang $row[barang_nama]</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'>&nbsp;</button>
                        </div>
                        <div class='modal-body'>
                            <form method='post' action='hapus_agenda.php'>
                                <input type='hidden' name='agenda_id' value='$row[agenda_id]'>
                                Anda yakin menghapus data ini ? <br>
                                <button type='submit' class='btn btn-danger'>Ya</button>
                                <button type='reset' class='btn btn-default' data-bs-dismiss='modal'>Batal</button>
                            </form>
                        </div>
                        <div class='modal-footer'>
                            <p>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
                                    ";
                                }
                            } else {
                                $caridata=$_POST['cari_data'];
                                $sql=mysqli_query($koneksi,"CALL cari_agenda('$caridata')");
                                $no=1;
                                while($row=mysqli_fetch_array($sql)) {
                                    echo "<tr>
                                        <td>".
                                        $no++
                                        ."</td>
                                        <td>$row[barang_kode]</td>
                                        <td>$row[barang_nama]</td>
                                        <td>$row[tgl_agenda]</td>
                                        <td>$row[jenis_agenda]</td>
                                        <td>$row[keterangan_agenda]</td>
                                        <td>
                                        <button class='btn btn-info' type='button' title='Edit $row[barang_nama]' data-bs-toggle='modal' data-bs-target='#edit$row[agenda_id]'>Edit</button>
                                        <button class='btn btn-warning' type='button' title='Hapus $row[barang_nama]' data-bs-toggle='modal' data-bs-target='#hapus$row[agenda_id]'>Hapus</button>
                                        </td>
                                    </tr>
                                    <div class='modal fade' id='edit$row[agenda_id]'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h4>Edit agenda barang $row[barang_nama]</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'>&nbsp;</button>
                        </div>
                        <div class='modal-body'>
                            <form method='post' action='update_agenda.php'>
                                <input type='hidden' name='agenda_id' value='$row[agenda_id]'>
                                Barang : <select name='barang_kode' class='form-control' required>
                                <option selected>$row[barang_kode]-$row[barang_nama]</option>";
                                include "koneksi.php";
                                $sqlbarang=mysqli_query($koneksi,"CALL tampil_barang()");
                                while($r=mysqli_fetch_array($sqlbarang)) {
                                    echo "<option>$r[barang_kode]-$r[barang_nama]</option>";
                                }
                                echo "</select>
                                Tanggal Agenda : <input type='date' name='tgl_agenda' value='$row[tgl_agenda]' class='form-control' required>
                                Jenis Agenda : <select name='jenis_agenda' class='form-control' required>
                                    <option selected>$row[jenis_agenda]</option>
                                    <option>PERBAIKAN</option>
                                    <option>PERAWATAN</option>
                                    <option>PENGGANTIAN</option>
                                </select>
                                Keterangan Agenda : <select name='keterangan_agenda' class='form-control' required>
                                    <option selected>$row[keterangan_agenda]</option>
                                    <option>BELUM DILAKSANAKAN</option>
                                    <option>PROSES DILAKSANAKAN</option>
                                    <option>SELESAI DILAKSANAKAN</option>
                                </select>
                                <br>
                                <button type='submit' class='btn btn-success'>Perbarui</button>
                                <button type='reset' class='btn btn-default' data-bs-dismiss='modal'>Batal</button>
                            </form>
                        </div>
                        <div class='modal-footer'>
                            <p>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class='modal fade' id='hapus$row[agenda_id]'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h4>Hapus agenda barang $row[barang_nama]</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'>&nbsp;</button>
                        </div>
                        <div class='modal-body'>
                            <form method='post' action='hapus_agenda.php'>
                                <input type='hidden' name='agenda_id' value='$row[agenda_id]'>
                                Anda yakin menghapus data ini ? <br>
                                <button type='submit' class='btn btn-danger'>Ya</button>
                                <button type='reset' class='btn btn-default' data-bs-dismiss='modal'>Batal</button>
                            </form>
                        </div>
                        <div class='modal-footer'>
                            <p>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
                                    ";
                                }
                            }
                        ?>
                    </tbody>
                </table>
                </div>
            </p>
            <div class="modal fade" id="tambahagenda">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Tambah agenda</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">&nbsp;</button>
                        </div>
                        <div class="modal-body">
                        <form method='post' action='simpan_agenda.php'>
                                Barang : <select name='barang_kode' class='form-control' required>
                                <?php
                                include "koneksi.php";
                                $sqlbarang=mysqli_query($koneksi,"CALL tampil_barang()");
                                while($r=mysqli_fetch_array($sqlbarang)) {
                                    echo "<option>$r[barang_kode]-$r[barang_nama]</option>";
                                }
                                ?>
                                </select>
                                Tanggal Agenda : <input type='date' name='tgl_agenda' class='form-control' required>
                                Jenis Agenda : <select name='jenis_agenda' class='form-control' required>
                                    <option>PERBAIKAN</option>
                                    <option>PERAWATAN</option>
                                    <option>PENGGANTIAN</option>
                                </select>
                                Keterangan Agenda : <select name='keterangan_agenda' class='form-control' required>
                                    <option>BELUM DILAKSANAKAN</option>
                                    <option>PROSES DILAKSANAKAN</option>
                                    <option>SELESAI DILAKSANAKAN</option>
                                </select>
                                <br>
                                <button type='submit' class='btn btn-success'>Tambahkan</button>
                                <button type='reset' class='btn btn-default' data-bs-dismiss='modal'>Batal</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <p>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>

    <!--Footer berisi pembuat atau tim pengembang-->
    <footer>
        <p style="text-align: center;">Copyright &copy; <?php echo date('Y'); ?> Barokah Jaya Rizki All Reserved</p>
    </footer>


    <script>
        function sembunyi() {
            document.getElementById("aside").style.display="none";
            document.getElementById("article").style.width="100%";
            document.getElementById("ham").style.display="none";
            document.getElementById("burger").style.display="block";
        }
        function tampil() {
            document.getElementById("aside").style.display="block";
            document.getElementById("article").style.width="80%";
            document.getElementById("ham").style.display="block";
            document.getElementById("burger").style.display="none";
        }
    </script>

    <!-- Library Javascript -->
    <script src="jquery.min.js"></script>
    <script src="all.min.js"></script>
    <script src="bootstrap.min.js"></script>
</body>
</html>