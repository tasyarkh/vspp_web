<?= $this->include('layout/admin/header') ?> 
      <div class="conatiner-fluid content-inner mt-n5 py-0">
       <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <div class="header-title">
                  <h4 class="card-title">Riwayat Transaksi SPP</h4>
                  <a type="button" class="btn btn-soft-info btn-sm mt-4" href="<?= base_url('riwayat/cetakAdmin'); ?>" target="_blank">Cetak</a>
               </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Nama Siswa</th>
                           <th>NISN</th>
                           <th>Tanggal</th>
                           <th>Bulan</th>
                           <th>Tahun</th>
                           <th>SPP</th>
                           <th>Jumlah</th>
                           <th>Status</th>
                           <th>Nama Petugas</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php 
                           $no = 1;
                           foreach ($riwayat as $r) :
                    ?>
                        <tr>
                           <td><?= $r['nama']; ?></td>
                           <td><?= $r['nisn']; ?></td>
                           <td><?= $r['tgl_bayar']; ?></td>
                           <td><?= $r['bln_bayar']; ?></td>
                           <td><?= $r['th_bayar']; ?></td>
                           <td><?= $r['tahun']; ?> | <?= $r['bulan']; ?> | <?= $r['nominal']; ?></td>
                           <td><?= $r['jml_bayar']; ?></td>
                           <td><?= $r['ket']; ?></td>
                           <td><?= $r['nama_petugas']; ?></td>
                           <td><a type="button" class="btn btn-soft-danger btn-sm" data-href="<?= base_url('admin/hapusTrans') . '/' . $r['id']; ?>" data-bs-toggle="modal" data-bs-target="#konfirmasi_hapus">Hapus</a></td>
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

<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Status Transaksi</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('transaksi/edit'); ?>">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="id" class="form-label">ID</label>
                                    <input type="text" class="form-control" id="id_u" name="id" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama_petugas_u" name="nama_petugas" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="nisn" class="form-label">NISN</label>
                                    <input type="text" class="form-control" id="nisn_u" name="nisn" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_bayar" class="form-label">Tanggal</label>
                                    <input type="text" class="form-control" id="tgl_bayar_u" name="tgl_bayar" disabled>
                                </div>
                                 <div class="mb-3">
                                    <label for="bln_bayar" class="form-label">Bulan</label>
                                    <input type="text" class="form-control" id="bln_bayar_u" name="bln_bayar" disabled>
                                 </div>
                                 <div class="mb-3">
                                    <label for="th_bayar" class="form-label">Tahun</label>
                                    <input type="text" class="form-control" id="th_bayar_u" name="th_bayar" disabled>
                                 </div>
                                 <div class="mb-3">
                                       <label for="exampleInputEmail1" class="form-label">SPP</label>
                                       <select class="form-select form-select-md mb-3 shadow-none text-primary" name="spp_id" id="spp_id_u" disabled>
                                       <?php foreach ($spp as $b): ?>
                                       <option value="<?php echo $b['id']; ?>"><?php echo $b['tahun']; ?> | <?php echo $b['bulan']; ?> | <?php echo $b['nominal']; ?></option>
                                       <?php endforeach; ?>
                                       </select>
                                 
                                 </div>
                                 <div class="mb-3">
                                    <label for="jml_bayar" class="form-label">Jumlah</label>
                                    <input type="text" class="form-control" id="jml_bayar_u" name="jml_bayar">
                                 </div>
                                 <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select form-select-md mb-3 shadow-none text-primary" name="ket" id="ket_u" require>
                                       <option>Lunas</option>
                                       <option>Tertunda</option>
                                    </select>
                                 </div>
                                 <div class="mb-3">
                                    <label for="nama_petugas" class="form-label">Nama Petugas</label>
                                    <select type="text" id="petugas_id_u" class="form-select form-select-md mb-3 shadow-none text-primary" required name="petugas_id">
                                <?php foreach ($petugas as $p): ?>
                                 <option value="<?php echo $p['id']; ?>"><?php echo $p['nama_petugas']; ?></option>
                                 <?php endforeach; ?>
                                </select>
                                 </div>
                          </div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <input type="submit" class="btn btn-primary" name="editTrans">
                        </div>
                      </form>
                    </div>
                </div>
             </div>     
             <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi_hapus">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa fa-trash"></i> Yakin ingin menghapus Siswa ?</h5>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-secondary close" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <a type="submit" class="btn btn-danger btn-ok" href="admin/hapusTrans/<?= $r['id'] ?>">Hapus</a> 
                        </div>
                    </div>
                </div>
              </div>   

      <?= $this->include('layout/footer') ?>
      <script src="../../assets/js/core/libs.min.js"></script>                        