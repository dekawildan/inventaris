<?php
if(empty($_POST['barang_id'])) {
    echo '<script>alert("Maaf kolom wajib diisi");</script>
    <meta http-equiv="refresh" content="0, barang.php">';
} else {
    include "koneksi.php";
    $idbrg=strip_tags($_POST['barang_id']);

    $sql="CALL hapus_barang('$idbrg')";

    if(mysqli_query($koneksi,$sql)) {
        echo '<script>alert("Data telah dihapus");</script>
        <meta http-equiv="refresh" content="0, barang.php">';
    } else {
        echo '<script>alert("Gagal menghapus data");</script>
        <meta http-equiv="refresh" content="0, barang.php">';
    }
}