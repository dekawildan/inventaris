<?php
$koneksi=mysqli_connect("localhost","root","","inventaris_bhinus") or die("Gagal mengkoneksikan dbms");
$selectdb=mysqli_select_db($koneksi,"inventaris_bhinus") or die("Gagal memilih database");