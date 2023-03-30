<?= $this->include('layout/admin/header') ?> 
      <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data Kelas</h4>
                  <a type="button" class="btn btn-soft-success btn-sm mt-4" data-bs-target="#tambah" data-bs-toggle="modal">Tambah</a>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Nama Kelas</th>
                           <th>Jurusan</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php 
                           $no = 1;
                           foreach ($kelas as $k) :
                    ?>
                        <tr>
                           <td> <?= $k['nama_kelas']; ?></td>
                           <td> <?= $k['jurusan']; ?></td>
                           <td><a type="button" class="btn btn-soft-warning btn-sm kelas" data-bs-toggle="modal" data-bs-target="#editkel" data-id="<?= $k['id']; ?>" data-nama_kelas="<?= $k['nama_kelas']; ?>" data-jurusan="<?= $k['jurusan']; ?>" href="#">Edit</a> <a type="button" class="btn btn-soft-danger btn-sm" data-href="<?= base_url('admin/hapusKel') . '/' . $k['id']; ?>" data-bs-toggle="modal" data-bs-target="#konfirmasi_hapus">Hapus</a></td>
                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
      </div>
      <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('kelas/tambah'); ?>">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required placeholder="kelas">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" required placeholder="jurusan">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <input type="submit" class="btn btn-primary" name="Simpan" value="Simpan">
            </div>
            </form>
        </div>
    </div>
  </div>

  <!-- section edit data -->
  <div class="modal fade" id="editkel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data Kelas</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('kelas/edit'); ?>">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="id" class="form-label">ID Kelas</label>
                                    <input type="text" class="form-control" id="id_u" name="id" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="nama_kelas_u" name="nama_kelas" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <input type="text" class="form-control" id="jurusan_u" name="jurusan" required>
                                </div>
                          </div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <input type="submit" class="btn btn-primary" name="editKelas">
                        </div>
                      </form>
                    </div>
                </div>
             </div>     
             <!-- section hapus data -->
             <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi_hapus">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa fa-trash"></i> Yakin ingin menghapus Kelas ?</h5>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <a type="submit" class="btn btn-danger btn-ok" href="admin/hapuskel/<?= $k['id'] ?>">Hapus</a> 
                        </div>
                    </div>
                </div>
              </div>   
      <?= $this->include('layout/footer') ?>
      <script src="../../assets/js/core/libs.min.js"></script>
    
