<?php include "header.php"; ?>

<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f0f0f0; /* Warna latar belakang */
    }

    .panel-body {
        position: relative;
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .img-container {
        position: relative;
        display: inline-block;
        overflow: hidden;
        border-radius: 5px;
    }

    img.img-thumbnail {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 100%;
    }

    .caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%; /* Sesuaikan lebar caption sesuai kebutuhan */
        color: white;
        font-size: 2rem;
        font-weight: bold;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }

    .display-1 {
        font-size: 3rem;
        font-weight: bold;
        text-align: center;
        line-height: 1.5;
        margin-bottom: 20px;
        color: whitesmoke;
    }
</style>

    <!-- Begin page content -->
    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Halaman Utama Aplikasi Penggajian</h3>
        </div>
        <div class="panel-body">
          <div class="img-container">
              <img src="img/latar2.jpeg" alt="Gambar" class="img-thumbnail">
              <div class="caption">
                  <h1 class="display-1">SELAMAT DATANG DISISTEM PENGGAJIAN PEGAWAI<br>UNTUK MELANJUTKAN SILAHKAN MEMILIH PADA MENU NAVIGASI !!!</h1>
              </div>
          </div>
        </div>
      </div>

    </div>

<?php include "footer.php"; ?>
