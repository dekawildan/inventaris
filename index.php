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
                <li><a href="index.php" class="aktif">Dashboard</a></li>
                <li><a href="jurusan.php">Jurusan</a></li>
                <li><a href="ruang.php">Ruang</a></li>
                <li><a href="barang.php">Barang</a></li>
                <li><a href="rusak.php">Rusak</a></li>
                <li><a href="agenda.php">Agenda Service</a></li>
                <li><a href="laporan.php">Laporan</a></li>
                <li><a href="logout.php">Keluar</a></li>
            </ul>
        </nav>
    </aside>

    <!--Artikel untuk konten-->
    <article id="article">
        <section>
            <div class="petugas">
                <?php
                    include "koneksi.php";
                    $totaljurusan=mysqli_query($koneksi,"CALL tampil_jurusan()");
                    $hitungjurusan=mysqli_num_rows($totaljurusan);
                    echo "<h3>Total Jurusan : </h3><h2>$hitungjurusan</h2>";
                ?>
            </div>
            <div class="pelanggan">
                <?php
                    include "koneksi.php";
                    $totalruang=mysqli_query($koneksi,"CALL tampil_ruang()");
                    $hitungruang=mysqli_num_rows($totalruang);
                    echo "<h3>Total Ruang : </h3><h2>$hitungruang</h2>";
                ?>
            </div>
            <div class="obat">
                <?php
                    include "koneksi.php";
                    $totalbrgmati=mysqli_query($koneksi,"CALL tampil_barang_mati()");
                    $hitungbrgmati=mysqli_num_rows($totalbrgmati);
                    echo "<h3>Total Barang Rusak/Mati : </h3><h2>$hitungbrgmati</h2>";
                ?>
            </div>
            <div class="obat">
                <?php
                    include "koneksi.php";
                    $totalbrgsebagian=mysqli_query($koneksi,"CALL tampil_barang_sebagian()");
                    $hitungbrgsebagian=mysqli_num_rows($totalbrgsebagian);
                    echo "<h3>Total Barang Semi Rusak/Mati : </h3><h2>$hitungbrgsebagian</h2>";
                ?>
            </div>
            <div class="mapel">
                <?php
                    include "koneksi.php";
                    $totalnormal=mysqli_query($koneksi,"CALL tampil_barang_normal()");
                    $hitungnormal=mysqli_num_rows($totalnormal);
                    echo "<h3>Total Barang Normal : </h3><h2>$hitungnormal</h2>";
                ?>
            </div>
            <div class="jadwal">
                <?php
                    include "koneksi.php";
                    $totalperbaikan=mysqli_query($koneksi,"CALL tampil_agenda_belum()");
                    $hitungperbaikan=mysqli_num_rows($totalperbaikan);
                    echo "<h3>Total Agenda Belum Proses : </h3><h2>$hitungperbaikan</h2>";
                ?>
            </div>
            <div class="transaksi">
                <?php
                    include "koneksi.php";
                    $totalperawatan=mysqli_query($koneksi,"CALL tampil_agenda_proses()");
                    $hitungperawatan=mysqli_num_rows($totalperawatan);
                    echo "<h3>Total Agenda Proses : </h3><h2>$hitungperawatan</h2>";
                ?>
            </div>
            <div class="absen">
                <?php
                    include "koneksi.php";
                    $totalpenggantian=mysqli_query($koneksi,"CALL tampil_agenda_selesai()");
                    $hitungpenggantian=mysqli_num_rows($totalpenggantian);
                    echo "<h3>Total Agenda Selesai : </h3><h2>$hitungpenggantian</h2>";
                ?>
            </div>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
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
</body>
</html>