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
                <li><a href="agenda.php"><span class="menu-icon"><i class="fas fa-toolbox"></i></span> <span class="menu-teks">Agenda Service</span></a></li>
                <li><a href="laporan.php" class="aktif"><span class="menu-icon"><i class="fas fa-list"></i></span> <span class="menu-teks">Laporan</span></a></li>
                <li><a href="logout.php"><span class="menu-icon"><i class="fas fa-power-off"></i></span> <span class="menu-teks">Keluar</span></a></li>
            </ul>
        </nav>
    </aside>

    <!--Artikel untuk konten-->
    <article id="article">
        <section>
            <div id="filterbulanan">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    Filter bulan: <br>
                    <select name="bulan" class="form-control" style="width:90%; float:left;" required>
                        <?php
                            for($a=01;$a<=12;$a++) {
                                echo "<option>$a</option>";
                            }
                        ?>
                    </select>
                        &nbsp;<button class="btn btn-primary" type="submit" name="caribulan">Filter</button>
                </form>
            </div>

            <p>&nbsp;
            <div class="table-responsive">
                <table class="table table_striped table-hover">
                    <thead>
                        <tr>
                        <th colspan="10" style="text-align:center; font-size: 1.5em;">LAPORAN INVENTARIS</th>
                        </tr>
                        <tr>
                            <th>NO</th>
                            <th>KODE BARANG</th>
                            <th>NAMA BARANG</th>
                            <th>JUMLAH</th>
                            <th>KONDISI</th>
                            <th>RUANG</th>
                            <th>JURUSAN</th>
                            <th>TANGGAL AGENDA</th>
                            <th>JENIS AGENDA</th>
                            <th>KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "koneksi.php";
                            if(isset($_POST['caribulan'])) {
                                $bulan=$_POST['bulan'];
                                echo "<tr>
                                    <td colspan='10' style='text-align:left;'>
                                        <a href='cetak-laporan.php?bulan=$bulan' target='_blank'><button class='btn btn-success' type='button'>Cetak Laporan</button></a>
                                    </td>
                                </tr>";
                                $sql=mysqli_query($koneksi,"CALL filter_laporan('$bulan')");
                                $no=1;
                                while($row=mysqli_fetch_array($sql)) {
                                    echo "<tr>
                                        <td>".
                                        $no++
                                        ."</td>
                                        <td>$row[barang_kode]</td>
                                        <td>$row[barang_nama]</td>
                                        <td>$row[barang_jumlah]</td>
                                        <td>$row[barang_keterangan]</td>
                                        <td>$row[ruang_nama]</td>
                                        <td>$row[jurusan_nama]</td>
                                        <td>$row[tgl_agenda]</td>
                                        <td>$row[jenis_agenda]</td>
                                        <td>$row[keterangan_agenda]</td>
                                    </tr>
                                    ";
                                }
                            } else {
                                $sql=mysqli_query($koneksi,"CALL laporan_inventaris()");
                                $no=1;
                                while($row=mysqli_fetch_array($sql)) {
                                    echo "<tr>
                                        <td>".
                                        $no++
                                        ."</td>
                                        <td>$row[barang_kode]</td>
                                        <td>$row[barang_nama]</td>
                                        <td>$row[barang_jumlah]</td>
                                        <td>$row[barang_keterangan]</td>
                                        <td>$row[ruang_nama]</td>
                                        <td>$row[jurusan_nama]</td>
                                        <td>$row[tgl_agenda]</td>
                                        <td>$row[jenis_agenda]</td>
                                        <td>$row[keterangan_agenda]</td>
                                    </tr>
                                    ";
                                }
                            }
                        ?>
                    </tbody>
                </table>
                </div>
            </p>
        </section>
    </article>

    <!--Footer berisi pembuat atau tim pengembang-->
    <footer>
        <p style="text-align: center;">Copyright &copy; <?php echo date('Y'); ?> Barokah Jaya Rizki All Reserved</p>
    </footer>

    <script src="jquery.min.js"></script>
    <script src="all.min.js"></script>
    <script src="bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#harian").click(function() {
                $("#harian").hide("slow");
                $("#filterbulanan").hide("slow");
                $("#bulanan").show("slow");
                $("#filterharian").show("slow");
            });
            $("#bulanan").click(function() {
                $("#harian").show("slow");
                $("#filterbulanan").show("slow");
                $("#bulanan").hide("slow");
                $("#filterharian").hide("slow");
            });
        });
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

</body>
</html>