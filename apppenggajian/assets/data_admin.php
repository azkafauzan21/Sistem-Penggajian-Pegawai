<?php include "header.php"; ?>

 <!-- Begin page content -->
 <div class="container">
  <?php
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $view = isset($_GET['view']) ? $_GET['view'] : null;
    switch($view){
        default:
        //untuk pesan berhasil atau gagal
        if(isset($_GET['e']) && $_GET['e']=='sukses'){
            echo "<center>Proses Berhasil...</center>";
        }elseif(isset($_GET['e']) && $_GET['e']=='gagal'){
            echo "<center>Proses Gagal...</center>";
        }
  ?>
             <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Administrator</h3>
                 </div>
                 <div class="panel-body">
                    <a href="data_admin.php?view=tambah" class="btn btn-primary" style="margin-bottom: 10px">Tabmah Data</a>
                    <table class="table table-boardered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        $sqlAdmin = mysqli_query($konek, "SELECT * FROM admin ORDER BY username ASC");
                        $no = 1;

                        while($data=mysqli_fetch_array($sqlAdmin)){
                            echo "<tr>
                                    <td class='text-center'>$no</td>
                                    <td>$data[idadmin]</td>
                                    <td>$data[username]</td>
                                    <td>$data[namalengkap]</td>
                                    <td class='text-center'>
                                        <a href='data_admin.php?view=edit&id=$data[idadmin]' class='btn btn-warning btn-sm'>Edit</a>
                                        <a href='aksi_admin.php?act=delete&id=$data[idadmin]' class='btn btn-danger btn-sm'>Hapus</a>
                                     </td>
                                 </tr>";
                            $no++;
                        }
                        ?>
                    </table>

                 </div>
             </div>

        <?php
        break;
        case "tambah": 
            
        ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Tambah Data Administrator</h3>
                 </div>
                 <div class="panel-body">
            
                 <form class="form-horizontal" method="POST" action="aksi_admin.php?act=insert">

                    <div class="form-group">
                        <label class="col-md-2">Username</label>
                        <div class="col-md-10">
                            <input type="text" name="username" class="form-control" placeholder="Username" require>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">Password</label>
                        <div class="col-md-10">
                            <input type="password" name="password" class="form-control" placeholder="Password" require>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">Nama Lengkap</label>
                        <div class="col-md-10">
                            <input type="text" name="namalengkap" class="form-control" placeholder="Nama Lengkap" require>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2"></label>
                        <div class="col-md-10">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                            <a href="data_admin.php" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                 </form>

                 </div>
             </div>
        <?php
        break;
        case "edit":

                    
        $sqlEdit = mysqli_query($konek, "SELECT * FROM admin WHERE idadmin='$_GET[id]'");
        $e = mysqli_fetch_array($sqlEdit);
        ?>
             <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Data Administrator</h3>
                 </div>
                 <div class="panel-body">

            
                 <form class="form-horizontal" method="POST" action="aksi_admin.php?act=update">
                    <input type="hidden" name="idadmin" value="<?php echo $e['idadmin']; ?>">
                    <div class="form-group">
                        <label class="col-md-2">Username</label>
                        <div class="col-md-4">
                            <input type="text" name="username" class="form-control" value="<?php echo $e['username']; ?>" require>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">Password</label>
                        <div class="col-md-10">
                            <input type="password" name="password" class="form-control" placeholder="Password" require>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">Nama Lengkap</label>
                        <div class="col-md-4">
                            <input type="text" name="namalengkap" class="form-control" value="<?php echo $e['namalengkap']; ?>" require>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2"></label>
                        <div class="col-md-10">
                            <input type="submit" class="btn btn-primary" value="Update Data">
                            <a href="data_admin.php" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                 </form>

                 </div>
             </div>
        <?php
        break;
    } 
    ?>
    
 </div>

<?php include "footer.php"; ?>
