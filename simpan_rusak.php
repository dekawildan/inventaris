<?php
if(empty($_POST['barang_kode']) || empty($_POST['nama_barang']) || empty($_POST['jumlah_barang']) || empty($_POST['barang_spesifikasi'])) {
    echo '<script>alert("Maaf kolom wajib diisi");</script>
    <meta http-equiv="refresh" content="0, barang.php">';
} else {
    include "koneksi.php";
    $kodebrg=strip_tags($_POST['barang_kode']);
    $namabrg=strip_tags($_POST['nama_barang']);
    $tglrusak=date('Y-m-d');
    $jmlbrg=strip_tags($_POST['jumlah_barang']);
    $spek=strip_tags($_POST['barang_spesifikasi']);
    $ket="RUSAK";
    
    $sql="CALL tambah_rusak('$kodebrg','$namabrg','$tglrusak','$jmlbrg','$ket','$spek')";

        if(mysqli_query($koneksi,$sql)) {
            echo '<script>alert("Data telah ditambahkan");</script>
            <meta http-equiv="refresh" content="0, rusak.php">';
        } else {
            echo '<script>alert("Gagal menambahkan data");</script>
            <meta http-equiv="refresh" content="0, rusak.php">';
        }
    
}