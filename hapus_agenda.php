<?php
if(empty($_POST['agenda_id'])) {
    echo '<script>alert("Maaf kolom wajib diisi");</script>
    <meta http-equiv="refresh" content="0, agenda.php">';
} else {
    include "koneksi.php";
    $idagenda=strip_tags($_POST['agenda_id']);

    $sql="CALL hapus_agenda('$idagenda')";

    if(mysqli_query($koneksi,$sql)) {
        echo '<script>alert("Data telah dihapus");</script>
        <meta http-equiv="refresh" content="0, agenda.php">';
    } else {
        echo '<script>alert("Gagal menghapus data");</script>
        <meta http-equiv="refresh" content="0, agenda.php">';
    }
}