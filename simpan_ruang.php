<?php
if(empty($_POST['nama_ruang']) || empty($_POST['jurusan_id'])) {
    echo '<script>alert("Maaf kolom wajib diisi");</script>
    <meta http-equiv="refresh" content="0, ruang.php">';
} else {
    include "koneksi.php";
    $namaruang=strip_tags($_POST['nama_ruang']);
    $jurusan=explode("-",$_POST['jurusan_id']);
    $idjurusan=$jurusan[0];

    $sql="CALL tambah_ruang('$namaruang','$idjurusan')";

    if(mysqli_query($koneksi,$sql)) {
        echo '<script>alert("Data telah ditambahkan");</script>
        <meta http-equiv="refresh" content="0, ruang.php">';
    } else {
        echo '<script>alert("Gagal menambahkan data");</script>
        <meta http-equiv="refresh" content="0, ruang.php">';
    }
}