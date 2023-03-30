<?= $this->include('layout/admin/header') ?> 
      <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <div class="header-title">
                  <h4 class="card-title">Data Siswa</h4>
                  <a type="button" class="btn btn-soft-success btn-sm mt-4" data-bs-target="#tambah" data-bs-toggle="modal">Tambah</a>
               </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>NISN</th>
                           <th>NIS</th>
                           <th>Nama</th>
                           <th>Kelas</th>
                           <th>Alamat</th>
                           <th>Telp</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php 
                           $no = 1;
                           foreach ($siswa as $s) :
                    ?>
                        <tr>
                           <td><?= $s['nisn']; ?></td>
                           <td><?= $s['nis']; ?></td>
                           <td><?= $s['nama']; ?></td>
                           <td><?= $s['nama_kelas']; ?> | <?= $s['jurusan']; ?> </td>
                           <td><?= $s['alamat']; ?></td>
                           <td><?= $s['telp']; ?></td>
                           <td><a type="button" class="btn btn-soft-warning btn-sm siswa" data-bs-toggle="modal" data-bs-target="#editSis" data-nisn="<?= $s['nisn']; ?>" data-nis="<?= $s['nis']; ?>" data-nama="<?= $s['nama']; ?>" data-kelas_id="<?= $s['kelas_id']; ?>" data-alamat="<?= $s['alamat']; ?>" data-telp="<?= $s['telp']; ?>" data-level="<?= $s['level']; ?>" href="#">Edit</a> <a type="button" class="btn btn-soft-danger btn-sm" data-href="<?= base_url('admin/hapussis') . '/' . $s['nisn']; ?>" data-bs-toggle="modal" data-bs-target="#konfirmasi_hapus">Hapus</a></td>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('siswa/tambah'); ?>">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis" required >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required >
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kelas</label>
                    <select class="form-select form-select-md mb-3 shadow-none text-primary" name="kelas_id" id="kelas_id">
                    <?php foreach ($kelas as $k): ?>
                        <option value="<?php echo $k['id']; ?>"><?php echo $k['nama_kelas']; ?> | <?php echo $k['jurusan']; ?></option>
                    <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">No Telpon</label>
                        <input type="text" class="form-control" id="telp" name="telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <input type="text" class="form-control text-primary" id="level" name="level" value="SISWA" readonly>
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
  <div class="modal fade" id="editSis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data Siswa</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('siswa/edit'); ?>">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="nisn" class="form-label">NISN</label>
                                    <input type="text" class="form-control" id="nisn_u" name="nisn" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" class="form-control" id="nis_u" name="nis" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama_u" name="nama" required>
                                </div>
                                <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kelas</label>
                                <select class="form-select form-select-md mb-3 shadow-none text-primary" name="kelas_id" id="kelas_id_u">
                                <?php foreach ($kelas as $k): ?>
                                    <option value="<?php echo $k['id']; ?>"><?php echo $k['nama_kelas']; ?> | <?php echo $k['jurusan']; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat_u" name="alamat" required placeholder="alamat">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">No Telpon</label>
                                <input type="text" class="form-control" id="telp_u" name="telp" required placeholder="telp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Status</label>
                                <input type="text" class="form-control text-primary" id="level" name="level" value="SISWA" readonly>
                            </div>
                          </div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <input type="submit" class="btn btn-primary" name="editSiswa">
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
                            <h5 class="modal-title"><i class="fa fa-trash"></i> Yakin ingin menghapus Siswa ?</h5>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <a type="submit" class="btn btn-danger btn-ok" href="admin/hapusSis/<?= $s['nisn'] ?>">Hapus</a> 
                        </div>
                    </div>
                </div>
              </div>   

      <?= $this->include('layout/footer') ?>
            <script src="../../assets/js/core/libs.min.js"></script>
