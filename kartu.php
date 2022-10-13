<?php
 include "cek-sesi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Barang</title>

    <style>
        body {
            text-align: center;
        }
        .body {
            width: 400px;
            margin: 1% 25% 10% 25%;
            padding: 5px;
            float: left;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            color: black;
            border:1px solid black;
        }
        .body h3 {
            margin: 0;
            padding: 5px;
        }
        .body h4 {
            margin: 0;
            padding: 5px;
        }
        .konten {
            margin: 0;
            padding: 5px 5px 20px 5px;
            float: left;
            width: 97%;
            text-align: left;
            color: black;
            border:1px solid black;
        }

        .gambar {
            width: 60% !important;
            height: 80px !important;
        }

    </style>
</head>
<body onload="javascript:window.print()">
    <div class="body">
        <h3>KARTU INVENTARIS</h3>
        <h4>SMK BHAKTI NUSANTARA BOJA</h4>
        <div class="konten">
            <?php
                include "koneksi.php";
                $sqlbrg=mysqli_query($koneksi,"CALL tampil_barang()");
                while($brg=mysqli_fetch_array($sqlbrg)) {
                    if(!empty($_GET['cetak'])) {
                        if($_GET['cetak'] == $brg['barang_kode']) {
                            echo "<table width='100%'>
                                <tr>
                                    <td>Kode Barang</td>
                                    <td>: $brg[barang_kode]</td>
                                </tr>
                                <tr>
                                    <td>Nama Barang</td>
                                    <td>: $brg[barang_nama]</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Masuk</td>
                                    <td>: $brg[tgl_masuk]</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>: $brg[barang_keterangan]</td>
                                </tr>
                                <tr>
                                    <td>Ruang</td>
                                    <td>: $brg[ruang_nama]</td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                    <img src='barcode.php?text=$brg[barang_kode]&print=true&size=40&codetype=code128' class='gambar' />
                                    </td>
                                </tr>
                            </table>";
                        }
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>