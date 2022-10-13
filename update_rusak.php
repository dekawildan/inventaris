<?php
if(empty($_POST['rusak_id']) || empty($_POST['jumlah_barang'])) {
    echo '<script>alert("Maaf kolom wajib diisi");</script>
    <meta http-equiv="refresh" content="0, rusak.php">';
} else {
    include "koneksi.php";
    $idrusak=strip_tags($_POST['rusak_id']);
    $jmlbrg=strip_tags($_POST['jumlah_barang']);

    $sql="CALL update_rusak('$idrusak','$jmlbrg')";

        if(mysqli_query($koneksi,$sql)) {
            echo '<script>alert("Data telah diedit");</script>
            <meta http-equiv="refresh" content="0, rusak.php">';
        } else {
            echo '<script>alert("Gagal mengedit data");</script>
            <meta http-equiv="refresh" content="0, rusak.php">';
        }
    
}