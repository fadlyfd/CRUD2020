<?php
//koneksi database
$server = "localhost";
$user = "root";
$pass = "";
$database = "dblatihan";

$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

// jika tombol simpan di klik 

if(isset($_POST['bsimpan]'])) 
{
    $simpan = mysqli_query($koneksi, "INSERT INTO tmhs (nim, nama, alamat, prodi)
                                        VALUES  ('$_POST[tnim]', 
                                                '$_POST[tnama]', 
                                                '$_POST[talamat]',
                                                '$_POST[tprodi]')
                                                ");
    if($simpan) 
    {                           // jika simpan sukses
        echo "<script>  
            alert('Simpan Data Sukses');
            document.location='index.php';
        </script>";
    }
    else
    {                              // jika simpan gagal
        echo "<script>
            alert('Simpan Data Gagal');
            document.location='index.php';
        </script>";
    };

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD 2020 PHP MYSQL + BOOTSTRAP 4</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<div class="container" >
    <h1 class="text-center">CRUD 2020 PHP MYSQL + BOOTSTRAP 4</h1>
    <h2 class="text-center">Ngoding Pintar</h2>

<!-- Awal Card Form -->
<div class="card mt-3">
        <div class="card-header bg-primary text-white" >
            Form Input Data Mahasiswa
        </div>

        <div class="card-body">
            <form method="post" action="">

            <div class="form-group mt-3">
                <label">Nim</label>
                <input type="text" name="tnim" class="form-control mt-2" 
                placeholder="Input Nim Anda disini!" required>
            </div>
            <div class="form-group mt-3">
                <label">Nama</label>
                <input type="text" name="tnama" class="form-control mt-2" 
                placeholder="Input Nama Anda disini!" required>
            </div>
            <div class="form-group mt-3">
                <label">Alamat</label>
                <textarea class="form-control mt-2" name="talamat" 
                placeholder="Input Alamat Anda disini!" required></textarea>
            </div>
            <div class="form-group mt-3">
                <label">Program Studi</label>
                <select class="form-control mt-2" name="tprodi">
                    <option></option>
                    <option value="D3-MI">D3-MI</option>
                    <option value="S1-SI">S1-SI</option>
                    <option value="S1-TI">S1-TI</option>
                </select>
            </div>


            <button type="submit" class="btn-success mt-3" name="bsimpan" >Simpan</button>
            <button type="reset" class="btn-danger mt-3" name="breset" >Kosongkan</button>

            </form>
        </div>
    </div>

<!-- Akhir Card Form -->

<!-- Awal Card Tabel -->
<div class="card mt-3">
        <div class="card-header bg-success text-white" >
            Daftar Mahasiswa
        </div>

        <div class="card-body">

        <table class="table table-bordered table-striped">
            <tr>
                <th>No.</th>
                <th>Nim</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Program Studi</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;
            $tampil = mysqli_query($koneksi, "SELECT * from tmhs order by id_mhs desc");
            while($data = mysqli_fetch_array($tampil)) :

            ?>

            <tr>
                <td><?=$no++;?></td>
                <td><?=$data['nim']?></td>
                <td><?=$data['nama']?></td>
                <td><?=$data['alamat']?></td>
                <td><?=$data['prodi']?></td>
                <td>
                    <a href="#" class="btn btn-warning"> Edit </a>
                    <a href="#" class="btn btn-danger"> Hapus </a>
                </td>
            </tr>

            <?php endwhile; //penutup perulangan while ?>

        </table>

        </div>
    </div>

<!-- Akhir Card Tabel --> 


</div>


<script  type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>