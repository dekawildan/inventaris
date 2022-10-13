<?php
if(empty($_POST['ruang_id'])) {
    echo '<script>alert("Maaf kolom wajib diisi");</script>
    <meta http-equiv="refresh" content="0, ruang.php">';
} else {
    include "koneksi.php";
    $idruang=$_POST['ruang_id'];

    $sql="CALL hapus_ruang('$idruang')";

    if(mysqli_query($koneksi,$sql)) {
        echo '<script>alert("Data telah dihapus");</script>
        <meta http-equiv="refresh" content="0, ruang.php">';
    } else {
        echo '<script>alert("Gagal menghapus data");</script>
        <meta http-equiv="refresh" content="0, ruang.php">';
    }
}