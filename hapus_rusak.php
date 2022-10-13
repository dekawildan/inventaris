<?php
if(empty($_POST['rusak_id'])) {
    echo '<script>alert("Maaf kolom wajib diisi");</script>
    <meta http-equiv="refresh" content="0, rusak.php">';
} else {
    include "koneksi.php";
    $idrusak=strip_tags($_POST['rusak_id']);

    $sql="CALL hapus_rusak('$idrusak')";

    if(mysqli_query($koneksi,$sql)) {
        echo '<script>alert("Data telah dihapus");</script>
        <meta http-equiv="refresh" content="0, rusak.php">';
    } else {
        echo '<script>alert("Gagal menghapus data");</script>
        <meta http-equiv="refresh" content="0, rusak.php">';
    }
}