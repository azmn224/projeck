<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "toko_thrift";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
  die("tidak bisa terkoneksi ke database");
}
$id_pembeli= "";
$nama_pembeli = "";
$alamat_pembeli = "";
$merek_barang = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
  $op = $_GET['op'];
} else {
  $op = "";
}

if ($op == 'delete') {
  $id = $_GET['id'];
  $sql1 = "delete from data_user where id = '$id_pembeli'";
  $q1 = mysqli_query($koneksi, $sql1);
  if ($q1) {
    $sukses = "Berhasil hapus data";
  } else {
    $error = "Gagal melakukan delete data";
  }
}

if ($op == 'edit') {
  $id_pembeli = $_GET['id'];
  $sql1 = "select * from data_user where id_pembeli = '$id_pembeli'";
  $q1 = mysqli_query($koneksi, $sql1);
  $r1 = mysqli_fetch_array($q1);
  $nama_pembeli = $r1['nama_pembeli'];
  $alamat_pembeli = $r1['alamat_pembeli'];
  $no_ktp = $r1['no_ktp'];
  $merek_barang = $r1['merek_barang'];

  if ($nama_pembeli == '') {
    $error = "Data tidak ditemukan";
  }
}
if (isset($_POST['simpan'])) { //untuk create
  $nama_pembeli = $_POST['nama_pembeli'];
  $alamat_pembeli = $_POST['alamat_pembeli'];
  $no_ktp = $_POST['no_ktp'];
  $merek_barang = $_POST['merek_barang'];

  if ($nama_pembeli && $alamat_pembeli && $no_ktp && $merek_barang) {
    if ($op == 'edit') { //untuk update
      $sql1 = "update data_user set nama_pembeli = '$nama_pembeli', alamat_pembeli = '$alamat_pembeli', no_ktp = '$no_ktp', merek_motor = '$merek_barang' where id_pembeli = '$id_pembeli'";
      $q1 = mysqli_query($koneksi, $sql1);
      if ($q1) {
        $sukses = "Data berhasil diupdate";
      } else {
        $error = "Data gagal diupdate";
      }
    } else { //untuk insert
      $sql1 = "insert into data_user(nama_pembeli,alamat_pembeli,no_ktp,merek_motor) values ('$nama_pembeli','$alamat_pembeli','$no_ktp','$merek_barang')";
      $q1 = mysqli_query($koneksi, $sql1);
      if ($q1) {
        $sukses = "Berhasil memasukkan data baru";
      } else {
        $error = "Gagal memasukkan data";
      }
    }
  } else {
    $error = "Silahkan masukkan semua data";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data pembeli</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <style>
    .mx-auto {
      width: 800px;
    }

    .card {
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="mx-auto">
    <!----untuk memasukan data---->
    <div class="card">
      <div class="card-header">
        Create / edit data
      </div>
      <div class="card-body">
        <?php
        if ($error) {
          ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $error ?>
          </div>
          <?php
          header("refresh:3;url=index.php"); //5 : detik
        }
        ?>
        <?php
        if ($sukses) {
          ?>
          <div class="alert alert-success" role="alert">
            <?php echo $sukses ?>
          </div>
          <?php
          header("refresh:3;url=index.php"); //5 : detik
        }
        ?>
        <form action="" method="POST">
          <div class="mb-3 row">
            <label for="nama_pembeli" class="col-sm-2 col-form-label">nama_pembeli</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama pembeli" name="nama_pembeli" value="<?php echo $nama_pembeli ?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">alamat_pembeli</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="alamat pembeli" name="alamat_pembeli" value="<?php echo $alamat_pembeli ?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="alamat" class="col-sm-2 col-form-label">no_ktp</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="ktp" name="no_ktp" value="<?php echo $no_ktp ?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="merek_motor" class="col-sm-2 col-form-label">merek_barang</label>
            <div class="col-sm-10">
              <select class="form-control" name="merek_motor" id="merek_motor">
                <option value="">- pilih merek_motor -</option>
                <option value="burberry" <?php if ($merek_barang == "burberry")
                  echo "selected" ?>>burberry</option>
                  <option value="adidas" <?php if ($merek_barang == "adidas")
                  echo "selected" ?>>adidas</option>
                  <option value="gap" <?php if ($merek_barang == "gap")
                  echo "selected" ?>>gap</option>
                  <option value="dickies" <?php if ($merek_barang == "dickies")
                  echo "selected" ?>>dickies</option>
                  <option value="stussy" <?php if ($merek_barang == "stussy")
                  echo "selected" ?>>stussy</option>
                  <option value="converse" <?php if ($merek_barang == "converse")
                  echo "selected" ?>>converse</option>
                
                </select>
              </div>
            </div>
            <div class="col-12">
              <input type="submit" name="simpan" value="Simpan data" class="btn btn-primary">
            </div>
          </form>
          <!--untuk mengeluarkan data-->

        </div>
      </div>
      <div class="card">
        <div class="card-header text-white bg-secondary">
          data pembeli
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">nama_pembeli</th>
                <th scope="col">alamat_pembeli</th>
                <th scope="col">no_ktp</th>
                <th scope="col">$merek_barang</th>
                <th scope="col">Aksi</th>
              </tr>
            <tbody>
              <?php
                $sql2 = "select * from data_user order by id_pembeli";
                $q2 = mysqli_query($koneksi, $sql2);
                $urut = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                  $nama_pembeli = $r2['nama_pembeli'];
                  $alamat_pembeli = $r2['alamat_pembeli'];
                  $no_ktp = $r2['no_ktp'];
                  $merek_barang = $r2['merek_barang'];
                  

                  ?>
              <tr>
                <th scope="row">
                  <?php echo $urut++ ?>
                </th>
                <td scope="row">
                  <?php echo $nama_pembeli ?>
                </td>
                <td scope="row">
                  <?php echo $alamat_pembeli ?>
                </td>
                <td scope="row">
                  <?php echo $no_ktp ?>
                </td>
                <td scope="row">
                  <?php echo $merek_barang ?>
                </td>
                <td scope="row">
                  <a href="index.php?op=edit&id=<?php echo $id_pembeli ?>"><button type="button"
                      class="btn btn-warning">Edit</button></a>
                  <a href="index.php?op=delete&id=<?php echo $id_pembeli ?>"> <button type="button" class="btn btn-danger"
                      onclick="return confirm('Yakin ingin delete data?')">Delete</button></a>
                </td>
              </tr>
            
              <?php
                }
                ?>
          </tbody>
          </thead>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"></script>
</body>
</html>