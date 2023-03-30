<?= $this->include('layout/admin/header') ?> 
      <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data Petugas</h4>
                  <a type="button" class="btn btn-soft-success btn-sm mt-4" data-bs-target="#tambah" data-bs-toggle="modal">Tambah</a>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Nama</th>
                           <th>Username</th>
                           <th>Level</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php 
                           $no = 1;
                           foreach ($petugas as $p) :
                    ?>
                        <tr>
                           <td> <?= $p['nama_petugas']; ?></td>
                           <td> <?= $p['username']; ?></td>
                           <td> <?= $p['level']; ?></td>
                           <td><label class="badge rounded-pill bg-<?php if ($p['status'] == 'AKTIF') {
                                                                    echo 'primary';
                                                                } else {
                                                                    echo 'gray';
                                                                } ?> me-1"><?= $p['status']; ?></label></td>
                           <td><a type="button" class="btn btn-soft-warning btn-sm petugas" data-bs-toggle="modal" data-bs-target="#editPet" data-id="<?= $p['id']; ?>" data-nama_petugas="<?= $p['nama_petugas']; ?>" data-username="<?= $p['username']; ?>" data-password="<?= $p['password']; ?>" data-level="<?= $p['level']; ?>" data-status="<?= $p['status']; ?>"   href="#">Edit</a> <a type="button" class="btn btn-soft-danger btn-sm" data-href="<?= base_url('admin/hapusPet') . '/' . $p['id']; ?>" data-bs-toggle="modal" data-bs-target="#konfirmasi_hapus">Hapus</a></td>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Petugas</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('petugas/tambah'); ?>">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Petugas</label>
                        <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Level</label>
                        <select class="form-select form-select-md mb-3 shadow-none text-primary" name="level">
                                <option>Pilih Level</option>
                                <option>ADMIN</option>
                                <option>PETUGAS</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <select class="form-select form-select-md mb-3 shadow-none text-primary" name="status">
                                <option>Pilih Status</option>
                                <option>AKTIF</option>
                                <option>PASIF</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <input type="submit" class="btn btn-primary" name="Simpan" value="Tambah">
            </div>
            </form>
        </div>
    </div>
  </div>

  <!-- section edit data -->
  <div class="modal fade" id="editPet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data Petugas</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('petugas/edit'); ?>">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="id" class="form-label">ID Petugas</label>
                                    <input type="text" class="form-control" id="id_u" name="id" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_petugas" class="form-label">Nama User</label>
                                    <input type="text" class="form-control" id="nama_petugas_u" name="nama_petugas" required>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username_u" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" id="password_u" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <select class="form-control rounded-lg" name="level" id="level_u">
                                        <option>Pilih Level</option>
                                        <option>ADMIN</option>
                                        <option>PETUGAS</option>
                                     </select>
                                </div>
                                <div class="mb-3">
                                    <label for="Status" class="form-label">Status</label>
                                    <select class="form-control rounded-lg" name="status" id="status_u">
                                        <option>Pilih Status</option>
                                        <option>AKTIF</option>
                                        <option>PASIF</option>
                                     </select>
                                </div>
                          </div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <input type="submit" class="btn btn-primary" name="editPetugas">
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
                            <h5 class="modal-title"><i class="fa fa-trash"></i> Yakin ingin menghapus Petugas ?</h5>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <a type="submit" class="btn btn-danger btn-ok" href="admin/hapuspet/<?= $p['id'] ?>">Hapus</a> 
                        </div>
                    </div>
                </div>
              </div>   
      <?= $this->include('layout/footer') ?>
      <script src="../../assets/js/core/libs.min.js"></script>
