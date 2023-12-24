<?php
session_start();
if(isset($_SESSION['login'])){
    include "koneksi.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cetak Daftar Gaji Pegawai</title>
        <style type="text/css">
            body{
                font-family: Arial;
            }
            @media print{
                .no-print{
                    display: none;
                }
            }

            table{
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
    <h3>PT. APA SAJA<br>DAFTAR GAJI PEGAWAI</h3>
    <hr>
    <?php

    session_start();

    // Mengakses nilai bulantahun dari session
    if (isset($_SESSION['bulantahun'])) {
        $bulantahun = $_SESSION['bulantahun'];
        echo "Nilai bulan dan tahun dari session: " . $bulantahun;
    }

    ?>

    <table>
        <tr>
            <td>Bulan</td>
            <td>:</td>
            <td><?php echo $bulan; ?></td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td><?php echo $tahun; ?></td>
        </tr>
    </table>
    <hr>

    <table border="1" cellpadding="4" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Gol</th>
                <th>Status</th>
                <th>Jumlah Anak</th>
                <th>Gapok</th>
                <th>Tj. Jabatan</th>
                <th>Tj. S/I</th>
                <th>Tj. Anak</th>
                <th>Uang Makan</th>
                <th>Uang Lembur</th>
                <th>Askes</th>
                <th>Pendapatan</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = mysqli_query($konek, "SELECT pegawai.nip, pegawai.nama_pegawai, jabatan.nama_jabatan, golongan.nama_golongan,
                            pegawai.status, pegawai.jumlah_anak, jabatan.gapok, jabatan.tunjangan_jabatan,
                            IF(pegawai.status='Menikah', tunjangan_suami_istri, 0) AS tjsi,
                            IF(pegawai.status='Menikah', tunjangan_anak, 0) AS tjanak,
                            uang_makan AS uangmakan,
                            master_gaji.lembur * uang_lembur AS uanglembur,
                            askes,
                            (gapok + tunjangan_jabatan + (SELECT tjsi) + (SELECT tjanak) + (SELECT uangmakan) + (SELECT uanglembur) + askes) AS pendapatan,
                            potongan,
                            (SELECT pendapatan) - potongan AS totalgaji
                    FROM pegawai
                    INNER JOIN master_gaji ON master_gaji.nip = pegawai.nip
                    INNER JOIN golongan ON golongan.kode_golongan = pegawai.kode_golongan
                    INNER JOIN jabatan ON jabatan.kode_jabatan = pegawai.kode_jabatan
                    WHERE master_gaji.bulan = '$bulantahun'
                    ORDER BY pegawai.nip ASC");
            $no=1;

            while($d=mysqli_fetch_assoc($sql)){
                echo "<tr>
                    <td width='40px' align='center'>$no</td>
                    <td>$d[nip]</td>
                    <td>$d[nama_pegawai]</td>
                    <td>$d[nama_jabatan]</td>
                    <td>$d[nama_golongan]</td>
                    <td>$d[status]</td>
                    <td>$d[jumlah_anak]</td>
                    <td>$d[gapok]</td>
                    <td>$d[tunjangan_jabatan]</td>
                    <td>$d[tjsi]</td>
                    <td>$d[tjanak]</td>
                    <td>$d[uangmakan]</td>
                    <td>$d[uanglembur]</td>
                    <td>$d[askes]</td>
                    <td>$d[pendapatan]</td>
                    <td>$d[potongan]</td>
                    <td>$d[totalgaji]</td>
                </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>

    </body>
    </html>
    <?php
    }else{
        header('location:login.php');
    }
    ?>