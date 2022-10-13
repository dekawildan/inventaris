<?php
if(empty($_POST['agenda_id']) || empty($_POST['barang_kode']) || empty($_POST['tgl_agenda']) || empty($_POST['jenis_agenda']) || empty($_POST['keterangan_agenda'])) {
    echo '<script>alert("Maaf kolom wajib diisi");</script>
    <meta http-equiv="refresh" content="0, agenda.php">';
} else {
    include "koneksi.php";
    $idagenda=strip_tags($_POST['agenda_id']);
    $barang=explode("-",$_POST['barang_kode']);
    $kodebrg=$barang[0];
    $tgl_agenda=strip_tags($_POST['tgl_agenda']);
    $jenis_agenda=strip_tags($_POST['jenis_agenda']);
    $ket=strip_tags($_POST['keterangan_agenda']);

    $sql="CALL update_agenda('$idagenda','$kodebrg','$tgl_agenda','$jenis_agenda','$ket')";

    if(mysqli_query($koneksi,$sql)) {
        echo '<script>alert("Data telah diedit");</script>
        <meta http-equiv="refresh" content="0, agenda.php">';
    } else {
        echo '<script>alert("Gagal mengedit data");</script>
        <meta http-equiv="refresh" content="0, agenda.php">';
    }
}