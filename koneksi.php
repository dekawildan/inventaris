<?php
$koneksi=mysqli_connect("localhost","id19702835_smkbhinus","Semarang2022*","id19702835_inventaris") or die("Gagal mengkoneksikan dbms");
$selectdb=mysqli_select_db($koneksi,"id19702835_inventaris") or die("Gagal memilih database");