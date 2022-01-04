<?php

// mengetahui semua error yg terjadi
error_reporting(E_ALL);
ini_set('display_errors', '1');



//koneksi database
$server = "localhost";
$user = "root";
$pass = "";
$database = "dblatihan";

$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

// jika tombol simpan di klik 

if(isset($_POST['bsimpan'])) 
{
    // pengujian apakah data akan  diedit tau disimpan 
        
        if($_GET['hal'] == "edit")
        {
            // data akan diedit
            $edit = mysqli_query($koneksi, "UPDATE tmhs set
                                                nim = '$_POST[tnim]',
                                                nama = '$_POST[tnama]',
                                                alamat = '$_POST[talamat]',
                                                prodi = '$_POST[tprodi]'
                                            WHERE id_mhs = '$_GET[id]'
                                            ");
    
                if($edit) 
                {                           // jika edit sukses
                    echo "<script>  
                    alert('Edit Data Sukses');
                    document.location='index.php';
                    </script>";
                }
                else
                {                              // jika edit gagal
                    echo "<script>
                    alert('Edit Data Gagal');
                    document.location='index.php';
                    </script>";
                };

        } 
        else 
        {
            // data akan disimpan baru
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



    
}

// penguian jka tombol edit dihapus / diklik 
    if(isset($_GET['hal'])) 
    {

        // pemgujian jika edit data 
        if($_GET['hal'] == "edit") 
        {
            // tampilkan data yang akan diedt 
            $tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_mhs = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                // jika data ditemukan, maka tampung ke dalam variabel 
                $vnim = $data['nim'];
                $vnama = $data ['nama'];
                $valamat = $data ['alamat'];
                $vprodi = $data ['prodi'];
            }
        }
        else if ($_GET['hal'] == "hapus")
        {
            // persiapan menghapus data 
            $hapus = mysqli_query($koneksi, "DELETE FROM tmhs WHERE id_mhs = '$_GET[id]' ");
            if($hapus)
            {
                echo "<script>
                    alert('Hapus Data Sukses');
                    document.location='index.php';
                    </script>";
            }
        }
        
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
                <input type="text" name="tnim" value="<?=@$vnim?>" class="form-control mt-2" 
                placeholder="Input Nim Anda disini!" required>
            </div>
            <div class="form-group mt-3">
                <label">Nama</label>
                <input type="text" name="tnama" value="<?=@$vnama?>" class="form-control mt-2" 
                placeholder="Input Nama Anda disini!" required>
            </div>
            <div class="form-group mt-3">
                <label">Alamat</label>
                <textarea class="form-control mt-2" name="talamat" 
                placeholder="Input Alamat Anda disini!" required><?=@$valamat?></textarea>
            </div>
            <div class="form-group mt-3">
                <label">Program Studi</label>
                <select class="form-control mt-2" name="tprodi">
                    <option value="<?=@$vprodi?>"><?=@$vprodi?></option>
                    <option value="D3-MI">D3-MI</option>
                    <option value="S1-SI">S1-SI</option>
                    <option value="S1-TI">S1-TI</option>
                </select>
            </div>


            <button type="submit" class="btn-success mt-3" name="bsimpan" value="bsimpan" >Simpan</button>
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
                    <a href="index.php?hal=edit&id=<?=$data['id_mhs']?>" class="btn btn-warning"> Edit </a>
                    <a href="index.php?hal=hapus&id<?=$data['id_mhs']?>" 
                    onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
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