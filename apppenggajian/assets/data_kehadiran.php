<?php include "header.php"; ?>

 <!-- Begin page content -->
 <div class="container">
  <?php
    $view = isset($_GET['view']) ? $_GET['view'] : null;
    switch($view){
        default:
        ?>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Kehadiran Pegawai</h3>
                </div>
                <div class="panel-body">
                    <form action="" class="form-inline" method="get">
                        <div class="form-group">
                            <label for="Bulan"></label>
                            <select name="bulan" class="form-control" id="">
                                <option value="">- Pilih -</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select name="tahun" class="form-control" id="">
                                <option value="">- Pilih -</option>
                                <?php
                                $y = date('Y');
                                for($i=2023;$i<=$y+2;$i++){
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan Data</button>
                        <a href="data_kehadiran.php?view=tambah" class="btn btn-primary">Input Kehadiran Pegawai</a>
                    </form>
                    <br>
                    <?php
                    if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
                        $bulan = $_GET['bulan'];
                        $tahun = $_GET['tahun'];
                        $bulantahun = $bulan.$tahun;
                    }else{
                        $bulan = date('m');
                        $tahun = date('Y');
                        $bulantahun = $bulan . $tahun;
                    }
                    ?>
                    <div class="alert alert-info"><strong>Bulan : <?php echo $bulan; ?>, Tahun : <?php echo $tahun; ?></strong></div>
                </div>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Masuk</th>
                        <th>Izin</th>
                        <th>Alpha</th>
                        <th>Lembur</th>
                        <th>potongan</th>
                    </tr>
                    <?php
                    $sql = mysqli_query($konek, "SELECT master_gaji.*, pegawai.nama_pegawai, pegawai.kode_jabatan,
                            jabatan.nama_jabatan
                        FROM master_gaji
                        INNER JOIN pegawai ON master_gaji.nip=pegawai.nip
                        INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
                        WHERE master_gaji.bulan=$bulantahun 
                        ORDER BY pegawai.nip ASC");
                    $no=1;
                    while($d=mysqli_fetch_array($sql)){
                        echo "<tr>
                            <td>$no</td>
                            <td>$d[nip]</td>
                            <td>$d[nama_pegawai]</td>
                            <td>$d[nama_jabatan]</td>
                            <td>$d[masuk]</td>
                            <td>$d[izin]</td>
                            <td>$d[alpha]</td>
                            <td>$d[lembur]</td>
                            <td>$d[potongan]</td>
                        </tr>";
                        $no++;
                    }

                    if(mysqli_num_rows($sql) > 0){
                        echo "<tr>
                            <td colspan='9' text-align='center'>
                            <a class='btn btn-warning' href='data_kehadiran.php?view=edit&bulan=$bulan&tahun=$tahun'>
                            Edit Data Kehadiran</a>
                            </td>
                        </tr>";
                    }else{
                        echo "<tr>
                            <td colspan='9' text-align='center'>
                                Belum ada data pada bulan dan tahun yang anda pilih...!!!
                            </td>
                        </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        <?php
 
        break;
        case "tambah":

            ?>

            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tambah Data Kehadiran Pegawai</h3>
                    </div>
                </div>
                    <div class="panel-body">
                    <form action="" class="form-inline" method="post">
                        <input type="hidden" name="view" value="tambah">
                        <div class="form-group">
                            <label for="Bulan"></label>
                            <select name="bulan" class="form-control" id="">
                                <option value="">- Pilih -</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select name="tahun" class="form-control" id="">
                                <option value="">- Pilih -</option>
                                <?php
                                $y = date('Y');
                                for($i=2023;$i<=$y+2;$i++){
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Generate Form</button>
                    </form>
                    <br>

                    <?php
                    if((isset($_POST['bulan']) && $_POST['bulan']!='' && (isset($_POST['tahun']) && $_POST['tahun']!=''))){
                        $bulan = $_POST['bulan'];
                        $tahun = $_POST['tahun'];
                        $bulantahun = $bulan.$tahun;
                    }else{
                        $bulan = date('m');
                        $tahun = date('Y');
                        $bulantahun = $bulan . $tahun;
                    }
                    ?>

                    <div class="alert alert-info">
                        <strong>Bulan : <?php echo $bulan; ?>, Tahun : <?php echo $tahun; ?></strong>
                    </div>

                    <form action="aksi_kehadiran.php?act=insert" method="post">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Jabatan</th>
                                <th>Masuk</th>
                                <th>Sakit</th>
                                <th>Izin</th>
                                <th>Alpha</th>
                                <th>Lembur</th>
                                <th>Potongan</th>
                            </tr>

                            <?php
                            $no=1;
                            $query=mysqli_query($konek, "SELECT pegawai.*, jabatan.nama_jabatan FROM pegawai 
                            INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan 
                            WHERE NOT EXISTS (SELECT * FROM master_gaji WHERE bulan='$bulantahun' AND 
                                pegawai.nip=master_gaji.nip) 
                            ORDER BY pegawai.nip ASC");
                            $jmlPegawai=mysqli_num_rows($query);
                            while($d=mysqli_fetch_array($query)){
                                ?>
                                    <input type="hidden" name="bulan[]" value="<?php echo $bulantahun; ?>" />
                                    <input type="hidden" name="nip[]" value="<?php echo $d['nip']; ?>" />
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $d['nip']; ?></td>
                                        <td><?php echo $d['nama_pegawai']; ?></td>
                                        <td><?php echo $d['nama_jabatan']; ?></td>
                                        <td>
                                            <input type="number" name="masuk[]" class="form-control" value="0" required />
                                        </td>
                                        <td>
                                            <input type="number" name="sakit[]" class="form-control" value="0" required />
                                        </td>
                                        <td>
                                            <input type="number" name="izin[]" class="form-control" value="0" required />
                                        </td>
                                        <td>
                                            <input type="number" name="alpha[]" class="form-control" value="0" required />
                                        </td>
                                        <td>
                                            <input type="number" name="lembur[]" class="form-control" value="0" required />
                                        </td>
                                        <td>
                                            <input type="number" name="potongan[]" class="form-control" value="0" required />
                                        </td>
                                    </tr>
                                    <?php 
                                        $no++;
                                }   
                                
                                if($jmlPegawai > 0){
                                    ?>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="6">
                                                <input class="btn btn-primary" type="submit" value="Simpan">
                                                <a href="data_kehadiran.php" class="btn btn-danger">Kembali</a>
                                            </td>
                                        </tr>
                                <?php
                                }else{
                                ?>
                                    <tr>
                                        <td colspan="10">
                                            <label for="" class="label label-warning">Maaf>>, Bulan dan tahun yang dipilih sudah diproses, 
                                            silahkan lakukan edit data...
                                            </label>
                                        </td>
                                    </tr>
                                <?php
                                }
                                 ?>
                        </table>
                    </form>

                    </div>
                </div>
            </div>

            <?php
 
        break;
        case "edit":
        
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan.$tahun;
        $_SESSION['bulan'] = $bulan;
        $_SESSION['tahun'] = $tahun;
        ?>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Data Kehadiran Pegawai</h3>
                </div>
                <div class="panel-body">
                    <div class="alert alert-info">
                        <strong>Bulan : <?php echo $bulan; ?>, Tahun : <?php echo $tahun; ?></strong>
                    </div>
                    <form action="aksi_kehadiran.php?act=update" method="post">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Jabatan</th>
                                <th>Masuk</th>
                                <th>Sakit</th>
                                <th>Izin</th>
                                <th>Alpha</th>
                                <th>Lembur</th>
                                <th>Potongan</th>
                            </tr>

                            <?php
                            $no=1;
                            $sql=mysqli_query($konek, "SELECT master_gaji.*,pegawai.nama_pegawai,jabatan.nama_jabatan
                                                    FROM master_gaji
                                                    INNER JOIN pegawai ON master_gaji.nip=pegawai.nip
                                                    INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
                                                    WHERE master_gaji.bulan='$bulantahun'
                                                    ORDER BY master_gaji.nip ASC");
                            $jmlPegawai=mysqli_num_rows($sql);
                            while($d=mysqli_fetch_array($sql)){
                                ?>
                                <input type="hidden" name="bulan[]" value="<?php echo $bulantahun; ?>" />
                                <input type="hidden" name="nip[]" value="<?php echo $d['nip']; ?>" />
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $d['nip']; ?></td>
                                        <td><?php echo $d['nama_pegawai']; ?></td>
                                        <td><?php echo $d['nama_jabatan']; ?></td>
                                        <td>
                                            <input type="number" name="masuk[]" class="form-control" value="<?php echo $d['masuk']; ?>" required />
                                        </td>
                                        <td>
                                            <input type="number" name="sakit[]" class="form-control" value="<?php echo $d['sakit']; ?>" required />
                                        </td>
                                        <td>
                                            <input type="number" name="izin[]" class="form-control" value="<?php echo $d['izin']; ?>" required />
                                        </td>
                                        <td>
                                            <input type="number" name="alpha[]" class="form-control" value="<?php echo $d['alpha']; ?>" required />
                                        </td>
                                        <td>
                                            <input type="number" name="lembur[]" class="form-control" value="<?php echo $d['lembur']; ?>" required />
                                        </td>
                                        <td>
                                            <input type="number" name="potongan[]" class="form-control" value="<?php echo $d['potongan']; ?>" required />
                                        </td>
                                    </tr>
                                <?php 
                                    $no++;
                            }   
                                ?>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="6">
                                        <input class="btn btn-primary" type="submit" value="Update">
                                        <a href="data_kehadiran.php" class="btn btn-danger">Kembali</a>
                                    </td>
                                </tr>  
                                
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <?php

        break;
    } 
    ?>
    
 </div>

<?php include "footer.php"; ?>