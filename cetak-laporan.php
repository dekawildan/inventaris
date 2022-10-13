<?php
    include "cek-sesi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inventaris</title>
</head>
<body onload="javascript:window.print()">
    <h3 align="center">LAPORAN INVENTARIS</h3>
    <h3 align="center">SMK BHAKTI NUSANTARA BOJA</h3>
    <table style="border:1px solid black;" align="center" width="90%" cellpadding="5" cellspacing="0">
                    <thead>
                        <tr style="border:1px solid black;">
                            <th style="border:1px solid black;">NO</th>
                            <th style="border:1px solid black;">KODE BARANG</th>
                            <th style="border:1px solid black;">NAMA BARANG</th>
                            <th style="border:1px solid black;">JUMLAH</th>
                            <th style="border:1px solid black;">KONDISI</th>
                            <th style="border:1px solid black;">SPESIFIKASI</th>
                            <th style="border:1px solid black;">RUANG</th>
                            <th style="border:1px solid black;">JURUSAN</th>
                            <th style="border:1px solid black;">TANGGAL AGENDA</th>
                            <th style="border:1px solid black;">JENIS AGENDA</th>
                            <th style="border:1px solid black;">KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "koneksi.php";
                            if(!empty($_GET['bulan'])) {
                                $laporan=mysqli_query($koneksi,"CALL filter_laporan('$_GET[bulan]')");
                                $no=1;
                                while($cetak=mysqli_fetch_assoc($laporan)) {    
                                    if($_GET['bulan'] == $cetak['bulan']) {
                                        include "koneksi.php";
                                            echo "<tr style='border:1px solid black;'>
                                            <td style='border:1px solid black;'>".
                                            $no++
                                            ."</td>
                                            <td style='border:1px solid black;'>$cetak[barang_kode]</td>
                                            <td style='border:1px solid black;'>$cetak[barang_nama]</td>
                                            <td style='border:1px solid black;'>$cetak[barang_jumlah]</td>
                                            <td style='border:1px solid black;'>$cetak[barang_keterangan]</td>
                                            <td style='border:1px solid black;'>$cetak[barang_spesifikasi]</td>
                                            <td style='border:1px solid black;'>$cetak[ruang_nama]</td>
                                            <td style='border:1px solid black;'>$cetak[jurusan_nama]</td>
                                            <td style='border:1px solid black;'>$cetak[tgl_agenda]</td>
                                            <td style='border:1px solid black;'>$cetak[jenis_agenda]</td>
                                            <td style='border:1px solid black;'>$cetak[keterangan_agenda]</td>
                                            </tr>
                                            ";
                                    }
                                }
                            }
                        ?>
                    </tbody>
    </table>
</body>
</html>