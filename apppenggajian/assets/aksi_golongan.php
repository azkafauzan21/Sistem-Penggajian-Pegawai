<?php

session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header('locaion:login.php');
}

// jika ada get act
if(isset($_GET['act'])){

    //act insert
    if($_GET['act']=='insert'){
        //proses penyimpanan data
        //menyimpan kiriman form ke variable
        $kode = $_POST['kodegolongan'];
        $nama = $_POST['namagolongan'];
        $tunjsi = $_POST['tunjangansuamiistri'];
        $tunja = $_POST['tunjangananak'];
        $makan = $_POST['uangmakan'];
        $lembur = $_POST['uanglembur'];
        $askes = $_POST['asuransikesehatan'];

        if($kode=='' || $nama=='' || $tunjsi=='' || $tunja=='' || $makan=='' || $lembur=='' || $askes==''){
            header('location:data_golongan.php?view=tambah&e=bl');
        }else{
            //proses query simpan data
            $simpan = mysqli_query($konek, "INSERT INTO golongan(kode_golongan,nama_golongan,tunjangan_suami_istri,tunjangan_anak,uang_makan,uang_lembur,askes)
             VALUES ('$kode','$nama','$tunjsi','$tunja','$makan','$lembur','$askes')");
            if($simpan){
                header('location:data_golongan.php?e=sukses');
            }else{
                header('location:data_golongan.php?e=gagal');
            }
        }

    }

    //jika act update
    elseif($_GET['act']=='update'){
        //menyimpan kiriman form ke variable
        $kode = $_POST['kodegolongan'];
        $nama = $_POST['namagolongan'];
        $tunjsi = $_POST['tunjangansuamiistri'];
        $tunja = $_POST['tunjangananak'];
        $makan = $_POST['uangmakan'];
        $lembur = $_POST['uanglembur'];
        $askes = $_POST['asuransikesehatan'];

        if($kode=='' || $nama=='' || $tunjsi=='' || $tunja=='' || $makan=='' || $lembur=='' || $askes==''){
            header('location:data_golongan.php?view=tambah&e=bl');
        }else{
            //proses query update data
            $update = mysqli_query($konek, "UPDATE golongan SET nama_golongan='$nama',tunjangan_suami_istri='$tunjsi',tunjangan_anak='$tunja',uang_makan='$makan',uang_lembur='$lembur',askes='$askes' WHERE kode_golongan='$kode'");

            if($update){
                header('location:data_golongan.php?e=sukses');
            }else{
                header('location:data_golongan.php?e=gagal');
            }
        }
    }
    
    //jika act del
    elseif($_GET['act']=='del'){
        $hapus = mysqli_query($konek, "DELETE FROM golongan WHERE kode_golongan='$_GET[id]'");

        if($hapus){
            header('location:data_golongan.php?e=sukses');
        }else{
            header('location:data_golongan.php?e=gagal');
        }
    }
}

?>
