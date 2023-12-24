<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header('locaion:login.php');
}

// jika ada get act
if(isset($_GET['act'])){

    //act insert
    if($_GET['act']=='insert'){
        //menyimpan kiriman form ke variable
        $bulan = $_POST['bulan'];
        $nip = $_POST['nip'];
        $masuk = $_POST['masuk'];
        $sakit = $_POST['sakit'];
        $izin = $_POST['izin'];
        $alpha = $_POST['alpha'];
        $lembur = $_POST['lembur'];
        $potongan = $_POST['potongan'];

        $count = count($nip);

        $sql = "INSERT INTO master_gaji(bulan,nip,masuk,sakit,izin,alpha,lembur,potongan) VALUES ";

        for($i=0; $i < $count; $i++){
            $sql .= "('{$bulan[$i]}','{$nip[$i]}','{$masuk[$i]}','{$sakit[$i]}','{$izin[$i]}','{$alpha[$i]}','{$lembur[$i]}','{$potongan[$i]}')";
            $sql .= " , ";
        }

        $sql = rtrim($sql," , ");

        $simpan = mysqli_query($konek, $sql);
        

            if($simpan){
                header('location:data_kehadiran.php?e=sukses');
            }else{
                header('location:data_kehadiran.php?e=gagal');
            }
        }

    }

    //jika act update    
    if (isset($_SESSION['bulan'])) {
        $bulan = $_SESSION['bulan'];
    }
    if (isset($_SESSION['tahu'])) {
        $tahun = $_SESSION['tahun'];
    }

    elseif($_GET['act']=='update'){
        //menyimpan kiriman form ke variable
        $bulan = $_POST['bulan'];
        $nip = $_POST['nip'];
        $masuk = $_POST['masuk'];
        $sakit = $_POST['sakit'];
        $izin = $_POST['izin'];
        $alpha = $_POST['alpha'];
        $lembur = $_POST['lembur'];
        $potongan = $_POST['potongan'];

        $count = count($nip);

        for($i=0; $i < $count; $i++){
            $update = mysqli_query($konek, "UPDATE master_gaji SET masuk='$masuk[$i]', sakit='$sakit[$i]', izin='$izin[$i]',
            alpha='$alpha[$i]', lembur='$lembur[$i]', potongan='$potongan[$i]'
            WHERE bulan='$bulan[$i]' AND nip='$nip[$i]'");
        }

        if($update){
            header('location:data_kehadiran.php?e=sukses');
        }else{
            header('location:data_kehadiran.php?e=gagal');
        }

        if (!$update) {
            printf("Error: %s\n", mysqli_error($konek));
        }        
    }
    
    
    //jika act del
    elseif($_GET['act']=='del'){
        $hapus = mysqli_query($konek, "DELETE FROM master_gaji WHERE nip='$_GET[id]'");

        if($hapus){
            header('location:data_kehadiran.php?e=sukses');
        }else{
            header('location:data_kehadiran.php?e=gagal');
        }
    }


?>
