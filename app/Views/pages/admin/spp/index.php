<?= $this->include('layout/admin/header') ?> 
      <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Data SPP</h4>
                  <a type="button" class="btn btn-soft-success btn-sm mt-4" data-bs-target="#tambah" data-bs-toggle="modal">Tambah</a>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Tahun</th>
                           <th>Bulan</th>
                           <th>Nominal</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php 
                           $no = 1;
                           foreach ($spp as $s) :
                    ?>
                        <tr>
                           <td> <?= $s['tahun']; ?></td>
                           <td> <?= $s['bulan']; ?></td>
                           <td> <?= $s['nominal']; ?></td>
                           <td><a type="button" class="btn btn-soft-warning btn-sm spp" data-bs-toggle="modal" data-bs-target="#editSpp" data-id="<?= $s['id']; ?>" data-tahun="<?= $s['tahun']; ?>" data-bulan="<?= $s['bulan']; ?>" data-nominal="<?= $s['nominal']; ?>" href="#">Edit</a> <a type="button" class="btn btn-soft-danger btn-sm" data-href="<?= base_url('admin/hapusSpp') . '/' . $s['id']; ?>" data-bs-toggle="modal" data-bs-target="#konfirmasi_hapus">Hapus</a></td>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data SPP</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('spp/tambah'); ?>">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun" required placeholder="tahun">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Bulan</label>
                        <input type="text" class="form-control" id="bulan" name="bulan" required placeholder="bulan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nominal</label>
                        <input type="text" class="form-control" id="nominal" name="nominal" required placeholder="nominal">
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
  <div class="modal fade" id="editSpp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data SPP</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('spp/edit'); ?>">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="id" class="form-label">ID SPP</label>
                                    <input type="text" class="form-control" id="id_u" name="id" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input type="text" class="form-control" id="tahun_u" name="tahun" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bulan" class="form-label">Bulan</label>
                                    <input type="text" class="form-control" id="bulan_u" name="bulan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nominal" class="form-label">Nominal</label>
                                    <input type="text" class="form-control" id="nominal_u" name="nominal" required>
                                </div>
                          </div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <input type="submit" class="btn btn-primary" name="editSpp">
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
                            <h5 class="modal-title"><i class="fa fa-trash"></i> Yakin ingin menghapus SPP ?</h5>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <a type="submit" class="btn btn-danger btn-ok" href="admin/hapusSpp/<?= $s['id'] ?>">Hapus</a> 
                        </div>
                    </div>
                </div>
              </div>   
      <?= $this->include('layout/footer') ?>
      <script src="../../assets/js/core/libs.min.js"></script>