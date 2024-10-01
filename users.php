<?php
include_once('templates/header.php');
?>
<?php
require_once('function.php');
include_once('templates/header.php');
?>

<?php
if (isset($_SESSION ['role']) && $_SESSION ['role'] != 'admin' ){
            //jika data berhasil di hapus maka akan muncul alert
            echo "<script>alert('Anda Tidak Memiliki Akses')</script>";
            //redirect ke halaman buku-tamu.php
            echo "<script>window.location.href='index.php'</script>";
        }
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Data User</h1>

  <?php
  //jika ada tombol simpan 
  if (isset($_POST['simpan'])) {
    if (tambah_user($_POST) > 0) {
  ?>
      <div class="alert alert-success" role="alert">
        Data berhasil disimpan!
      </div>
    <?php
    } else {
    ?>
      <div class="alert alert-danger" role="alert">
        Data gagal disimpan!
      </div>
  <?php
    }
  } else  if (isset($_POST['ganti_password'])) {
    if (ganti_password($_POST) > 0) {
  ?>
      <div class="alert alert-success" role="alert">
        Password berhasil disimpan!
      </div>
    <?php
    } else {
    ?>
      <div class="alert alert-danger" role="alert">
        Password gagal disimpan!
      </div>
  <?php
    }
  }
  ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">Data User</span>
      </button>


    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>User Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            //penomoran auto increment
            $no = 1;
            //query untuk memanggil semua data dari table buku_tamu
            $users = query("SELECT * FROM users");
            foreach ($users as $user) :
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['user_role'] ?></td>
                <td>
                  <button type="buton" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#gantiPassword" data-id="<?= $user['id_user'] ?>">
                    <span class="text">Ganti Password</span>
                  </button>
                  <a class=" btn btn-success" href="edit-user.php?id=<?= $user['id_user'] ?>">Ubah</a>
                  <a onclick="confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger" href="hapus-user.php?id=<?= $user['id_user'] ?>">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php
  //mengambil data barang dari tabel dengan kode terbesar
  $query = mysqli_query($koneksi, "SELECT max(id_user) as kodeTerbesar FROM users");
  $data = mysqli_fetch_assoc($query);
  $kodeUser = $data['kodeTerbesar'];

  //mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan di ubah ke integer dengan (int)
  $urutan = (int) substr($kodeUser, 3, 2);

  //nomor yang di ambil akan ditambahkan 1 untuk menentukan nomor urut berikutnya
  $urutan++;

  //membuat kode barang baru
  //string sprintf("%03s" $urutan); berfungsi untuk membuat string menjadi 3 karakter

  //angka yang diambil tadi digunakan dengan kode huruf yang kita inginkan, misalnya zt
  $huruf = "usr";
  $kodeUser = $huruf . sprintf("%02s", $urutan)


  ?>

  <!-- Modal tambah user-->
  <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Data User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <input type="hidden" name="id_user" id="id_user" value="<?= $kodeUser ?>">

            <div class="form-group row">
              <label for="username" class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="username" name="username">
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password">
              </div>
            </div>

            <div class="form-group row">
              <label for="user_role" class="col-sm-3 col-form-label">User Role</label>
              <div class="col-sm-8">
                <select class="form-control" name="user_role" id="user_role">
                  <option value="admin">Administrator</option>
                  <option value="operator">Operator</option>
                </select>
              </div>
            </div>

            <div class="modal-footer row">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
              <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal ganti password-->
  <div class="modal fade" id="gantiPassword" tabindex="-1" aria-labelledby="gantiPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="gantiPasswordlLabel">Ganti Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <input type="hidden" name="id_user" id="id_user">
            <div class="form-group row">
              <label for="password" class="col-sm-3 col-form-label">Password Baru</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password">
              </div>
            </div>
            <div class="modal-footer row">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
              <button type="submit" name="ganti_password" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- /.container-fluid -->

  <?php
  include_once('templates/footer.php');
  ?>
  