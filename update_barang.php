<?php
if(empty($_POST['barang_id']) || empty($_POST['barang_kode']) || empty($_POST['nama_barang']) || empty($_POST['tglmasuk']) || empty($_POST['jumlah_barang']) || empty($_POST['barang_keterangan']) || empty($_FILES['barang_foto']) || empty($_POST['ruang_id'])) {
    echo '<script>alert("Maaf kolom wajib diisi");</script>
    <meta http-equiv="refresh" content="0, barang.php">';
} else {
    include "koneksi.php";
    $idbrg=strip_tags($_POST['barang_id']);
    $kodebrg=strip_tags($_POST['barang_kode']);
    $namabrg=strip_tags($_POST['nama_barang']);
    $tglmasuk=strip_tags($_POST['tglmasuk']);
    $jmlbrg=strip_tags($_POST['jumlah_barang']);
    $spek=strip_tags($_POST['barang_spesifikasi']);
    $ket=strip_tags($_POST['barang_keterangan']);
    $ambilruang=explode("-",$_POST['ruang_id']);
    $idruang=$ambilruang[0];
    
    //upload gambar
    $foto=$_FILES['barang_foto']['name'];
    $folder="gambar/";
    $upload=$folder.$foto;
    if(move_uploaded_file($_FILES['barang_foto']['tmp_name'], $upload)) {
        $sql="CALL update_barang('$idbrg','$kodebrg','$namabrg','$tglmasuk','$jmlbrg','$ket','$spek','$foto','$idruang')";

        if(mysqli_query($koneksi,$sql)) {
            echo '<script>alert("Data telah diedit");</script>
            <meta http-equiv="refresh" content="0, barang.php">';
        } else {
            echo '<script>alert("Gagal mengedit data");</script>
            <meta http-equiv="refresh" content="0, barang.php">';
        }
    } else {
        echo '<script>alert("Gagal mengedit atau mengupload data");</script>
            <meta http-equiv="refresh" content="0, barang.php">';
    }
    
}