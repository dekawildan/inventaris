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
    <link href="select2.min.css" rel="stylesheet">
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
                <li><a href="barang.php" class="aktif"><span class="menu-icon"><i class="fas fa-toolbox"></i></span> <span class="menu-teks">Barang</span></a></li>
                <li><a href="rusak.php"><span class="menu-icon"><i class="fas fa-tools"></i></span> <span class="menu-teks">Rusak</span></a></li>
                <li><a href="agenda.php"><span class="menu-icon"><i class="fas fa-toolbox"></i></span> <span class="menu-teks">Agenda Service</span></a></li>
                <li><a href="laporan.php"><span class="menu-icon"><i class="fas fa-list"></i></span> <span class="menu-teks">Laporan</span></a></li>
                <li><a href="logout.php"><span class="menu-icon"><i class="fas fa-power-off"></i></span> <span class="menu-teks">Keluar</span></a></li>
            </ul>
        </nav>
    </aside>

    <!--Artikel untuk konten-->
    <article id="article">
        <section>
            <p>&nbsp; <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahbarang">+ Tambah Barang</button> 
            </p>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    Cari : <br>
                    <input type="text" name="cari_data" placeholder="Masukkan data yang dicari..." class="form-control" style="width:85%; float:left;" required>&nbsp;<button class="btn btn-primary" type="submit" name="cari">Cari</button>
                </form>
                <p>&nbsp;</p>
            <p>&nbsp;
            <a href='kartu-all.php' target='_blank' class='btn btn-success'>Generate Kartu</a>
                <div class="table-responsive">
                <table class="table table_striped table-hover">
                    <thead>
                        <tr>
                        <th colspan="10" style="text-align:center; font-size: 1.5em;">DATA BARANG</th>
                        </tr>
                        <tr>
                            <th>NO</th>
                            <th>KODE BARANG</th>
                            <th>NAMA BARANG</th>
                            <th>TANGGAL MASUK</th>
                            <th>JUMLAH</th>
                            <th>SPESIFIKASI</th>
                            <th>KETERANGAN</th>
                            <th>FOTO</th>
                            <th>RUANG</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "koneksi.php";
                            if(!isset($_POST['cari'])) {
                                $sql=mysqli_query($koneksi,"CALL tampil_barang()");
                                $no=1;
                                while($row=mysqli_fetch_array($sql)) {
                                    echo "<tr>
                                        <td>".
                                        $no++
                                        ."</td>
                                        <td>$row[barang_kode]</td>
                                        <td>$row[barang_nama]</td>
                                        <td>$row[tgl_masuk]</td>
                                        <td>$row[barang_jumlah]</td>
                                        <td>$row[barang_spesifikasi]</td>
                                        <td>$row[barang_keterangan]</td>
                                        <td><img src='gambar/$row[barang_foto]' width='80' height='100'></td>
                                        <td>$row[ruang_nama]</td>
                                        <td>
                                        <button class='btn btn-info' type='button' title='Edit $row[barang_nama]' data-bs-toggle='modal' data-bs-target='#edit$row[barang_id]'>Edit</button>
                                        <button class='btn btn-warning' type='button' title='Hapus $row[barang_nama]' data-bs-toggle='modal' data-bs-target='#hapus$row[barang_id]'>Hapus</button>
                                        <button class='btn btn-primary' type='button' title='Tambah $row[barang_nama]' data-bs-toggle='modal' data-bs-target='#tambahrusak$row[barang_id]'>Tambahkan Kerusakan</button>
                                        <a href='kartu.php?cetak=$row[barang_kode]' target='_blank' class='btn btn-success'>Cetak Kartu</a>
                                        </td>
                                    </tr>
                                    <div class='modal fade' id='edit$row[barang_id]'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h4>Edit Barang $row[barang_nama]</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'>&nbsp;</button>
                        </div>
                        <div class='modal-body'>
                            <form method='post' action='update_barang.php' enctype='multipart/form-data'>
                                <input type='hidden' name='barang_id' value='$row[barang_id]'>
                                Kode Barang : <input type='text' name='barang_kode' class='form-control' value='$row[barang_kode]' maxlength='20' placeholder='Masukkan kode...' required>
                                Nama Barang : <input type='text' name='nama_barang' value='$row[barang_nama]' placeholder='Tambahkan data barang...' class='form-control' required>
                                Tanggal Masuk : <input type='date' name='tglmasuk' value='$row[tgl_masuk]' class='form-control' required>
                                Jumlah Barang : <input type='number' name='jumlah_barang' value='$row[barang_jumlah]' placeholder='Tambahkan jumlah...' class='form-control' required>
                                Spesifikasi : <textarea name='barang_spesifikasi' class='form-control' placeholder='Spesifikasi...' required>$row[barang_spesifikasi]</textarea>
                                Keterangan : <select name='barang_keterangan' class='form-control' required>
                                    <option selected>$row[barang_keterangan]</option>
                                    <option>NYALA SEBAGIAN</option>
                                    <option>NYALA NORMAL</option>
                                </select>
                                Foto : <input type='file' name='barang_foto' accept='.jpg,.png,.bmp,.gif' required><br>
                                <img src='gambar/$row[barang_foto]' width='350' height='400'><br>
                                Ruang : <select name='ruang_id' class='form-control' required>
                                        <option selected>$row[ruang_id]-$row[ruang_nama]</option>";
                                        include "koneksi.php";
                                        $sqlruang=mysqli_query($koneksi,"CALL tampil_ruang()");
                                        while($ruang=mysqli_fetch_array($sqlruang)) {
                                            echo "<option>$ruang[ruang_id]-$ruang[ruang_nama]</option>";
                                        }
                                echo "</select>
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

            <div class='modal fade' id='tambahrusak$row[barang_id]'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4>Tambah Rusak Barang $row[barang_nama]</h4>
                        <button type='button' class='btn-close' data-bs-dismiss='modal'>&nbsp;</button>
                    </div>
                    <div class='modal-body'>
                        <form method='post' action='simpan_rusak.php' enctype='multipart/form-data'>
                            <input type='hidden' name='barang_kode' value='$row[barang_kode]'>
                            <input type='hidden' name='nama_barang' value='$row[barang_nama]'>
                            Jumlah Barang : <input type='number' name='jumlah_barang' value='$row[barang_jumlah]' placeholder='Tambahkan jumlah...' class='form-control' required>
                            <input type='hidden' name='barang_spesifikasi' value='$row[barang_spesifikasi]'>
                            <br>
                            <button type='submit' class='btn btn-success'>Tambahkan</button>
                            <button type='reset' class='btn btn-default' data-bs-dismiss='modal'>Batal</button>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>

            <div class='modal fade' id='hapus$row[barang_id]'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h4>Hapus Barang $row[barang_nama]</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'>&nbsp;</button>
                        </div>
                        <div class='modal-body'>
                            <form method='post' action='hapus_barang.php'>
                                <input type='hidden' name='barang_id' value='$row[barang_id]'>
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
                                $sql=mysqli_query($koneksi,"CALL cari_barang('$caridata')");
                                $no=1;
                                while($row=mysqli_fetch_array($sql)) {
                                    echo "<tr>
                                        <td>".
                                        $no++
                                        ."</td>
                                        <td>$row[barang_kode]</td>
                                        <td>$row[barang_nama]</td>
                                        <td>$row[tgl_masuk]</td>
                                        <td>$row[barang_jumlah]</td>
                                        <td>$row[barang_spesifikasi]</td>
                                        <td>$row[barang_keterangan]</td>
                                        <td><img src='gambar/$row[barang_foto]' width='80' height='100'></td>
                                        <td>$row[ruang_nama]</td>
                                        <td>
                                        <button class='btn btn-info' type='button' title='Edit $row[barang_nama]' data-bs-toggle='modal' data-bs-target='#edit$row[barang_id]'>Edit</button>
                                        <button class='btn btn-warning' type='button' title='Hapus $row[barang_nama]' data-bs-toggle='modal' data-bs-target='#hapus$row[barang_id]'>Hapus</button>
                                        <button class='btn btn-primary' type='button' title='Tambah $row[barang_nama]' data-bs-toggle='modal' data-bs-target='#tambahrusak$row[barang_id]'>Tambahkan Kerusakan</button>
                                        <a href='kartu.php?cetak=$row[barang_kode]' target='_blank' class='btn btn-success'>Cetak Kartu</a>
                                        </td>
                                    </tr>
                                    <div class='modal fade' id='edit$row[barang_id]'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h4>Edit Barang $row[barang_nama]</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'>&nbsp;</button>
                        </div>
                        <div class='modal-body'>
                            <form method='post' action='update_barang.php' enctype='multipart/form-data'>
                                <input type='hidden' name='barang_id' value='$row[barang_id]'>
                                Kode Barang : <input type='text' name='barang_kode' class='form-control' value='$row[barang_kode]' maxlength='20' placeholder='Masukkan kode...' required>
                                Nama Barang : <input type='text' name='nama_barang' value='$row[barang_nama]' placeholder='Tambahkan data barang...' class='form-control' required>
                                Tanggal Masuk : <input type='date' name='tglmasuk' value='$row[tgl_masuk]' class='form-control' required>
                                Jumlah Barang : <input type='number' name='jumlah_barang' value='$row[barang_jumlah]' placeholder='Tambahkan jumlah...' class='form-control' required>
                                Spesifikasi : <textarea name='barang_spesifikasi' class='form-control' placeholder='Spesifikasi...' required>$row[barang_spesifikasi]</textarea>
                                Keterangan : <select name='barang_keterangan' class='form-control' required>
                                    <option selected>$row[barang_keterangan]</option>
                                    <option>NYALA SEBAGIAN</option>
                                    <option>NYALA NORMAL</option>
                                </select>
                                Foto : <input type='file' name='barang_foto' accept='.jpg,.png,.bmp,.gif' required><br>
                                <img src='gambar/$row[barang_foto]' width='350' height='400'><br>
                                Ruang : <select name='ruang_id' class='form-control' required>
                                        <option selected>$row[ruang_id]-$row[ruang_nama]</option>";
                                        include "koneksi.php";
                                        $sqlruang=mysqli_query($koneksi,"CALL tampil_ruang()");
                                        while($ruang=mysqli_fetch_array($sqlruang)) {
                                            echo "<option>$ruang[ruang_id]-$ruang[ruang_nama]</option>";
                                        }
                                echo "</select>
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

            <div class='modal fade' id='tambahrusak$row[barang_id]'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4>Tambah Rusak Barang $row[barang_nama]</h4>
                        <button type='button' class='btn-close' data-bs-dismiss='modal'>&nbsp;</button>
                    </div>
                    <div class='modal-body'>
                        <form method='post' action='simpan_rusak.php' enctype='multipart/form-data'>
                            <input type='hidden' name='barang_kode' value='$row[barang_kode]'>
                            <input type='hidden' name='nama_barang' value='$row[barang_nama]'>
                            Jumlah Barang : <input type='number' name='jumlah_barang' value='$row[barang_jumlah]' placeholder='Tambahkan jumlah...' class='form-control' required>
                            <input type='hidden' name='barang_spesifikasi' value='$row[barang_spesifikasi]'>
                            <br>
                            <button type='submit' class='btn btn-success'>Tambahkan</button>
                            <button type='reset' class='btn btn-default' data-bs-dismiss='modal'>Batal</button>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>

            <div class='modal fade' id='hapus$row[barang_id]'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h4>Hapus Barang $row[barang_nama]</h4>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'>&nbsp;</button>
                        </div>
                        <div class='modal-body'>
                            <form method='post' action='hapus_barang.php'>
                                <input type='hidden' name='barang_id' value='$row[barang_id]'>
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
            <div class="modal fade" id="tambahbarang">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Tambah Barang</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">&nbsp;</button>
                        </div>
                        <div class="modal-body">
                        <form method='post' action='simpan_barang.php' enctype='multipart/form-data'>
                                Kode Barang : <input type='text' name='barang_kode' class='form-control' maxlength='20' placeholder='Masukkan kode...' required>
                                Nama Barang : <input type='text' name='nama_barang' placeholder='Tambahkan data barang...' class='form-control' required>
                                Tanggal Masuk : <input type='date' name='tglmasuk'  class='form-control' required>
                                Jumlah Barang : <input type='number' name='jumlah_barang' placeholder='Tambahkan jumlah...' class='form-control' required>
                                Spesifikasi : <textarea name='barang_spesifikasi' class='form-control' placeholder='Spesifikasi...' required></textarea>
                                Keterangan : <select name='barang_keterangan' class='form-control' required>
                                    <option>NYALA SEBAGIAN</option>
                                    <option>NYALA NORMAL</option>
                                </select>
                                Foto : <input type='file' name='barang_foto' accept='.jpg,.png,.bmp,.gif' required><br>
                                Ruang : <select name='ruang_id' class='form-control' required>
                                    <?php
                                        include "koneksi.php";
                                        $sqlruang=mysqli_query($koneksi,"CALL tampil_ruang()");
                                        while($ruang=mysqli_fetch_array($sqlruang)) {
                                            echo "<option>$ruang[ruang_id]-$ruang[ruang_nama]</option>";
                                        }
                                        ?>
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
    <script src="select2.min.js"></script>
    <script src="all.min.js"></script>
    <script src="bootstrap.min.js"></script>
</body>
</html>