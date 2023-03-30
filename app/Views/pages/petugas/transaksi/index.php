<?= $this->include('layout/petugas/header') ?> 
      <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <div class="header-title">
                  <h4 class="card-title">Transaksi SPP</h4>
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
                           <th>Transaksi</th>
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
                           <td><?= $s['nama_kelas']; ?> | <?= $s['jurusan']; ?></td>
                           <td><?= $s['alamat']; ?></td>
                           <td><?= $s['telp']; ?></td>
                           <td><a type="button" class="btn btn-info btn-sm bayar" data-bs-toggle="modal" data-bs-target="#bayar" data-nisn="<?= $s['nisn']; ?>" data-nis="<?= $s['nis']; ?>" data-nama="<?= $s['nama']; ?>" data-kelas_id="<?= $s['kelas_id']; ?>" data-telp="<?= $s['telp']; ?>" data-level="<?= $s['level']; ?>" href="#">Bayar</a></td>
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


<div class="modal fade" id="bayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Bayar</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="<?= base_url('transaksiPetugas/tambah'); ?>">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama_u" name="nama" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nisn" class="form-label">NISN</label>
                                    <input type="text" class="form-control" id="nisn_u" name="nisn" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_bayar" class="form-label">Tanggal Bayar</label>
                                    <input type="text" class="form-control" id="tgl_bayar" name="tgl_bayar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bln_bayar" class="form-label">Bulan Bayar</label>
                                    <input type="text" class="form-control" id="bln_bayar" name="bln_bayar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="th_bayar" class="form-label">Tahun Bayar</label>
                                    <input type="text" class="form-control" id="th_bayar" name="th_bayar" required>
                                </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">SPP</label>
                                <select type="text" id="spp_id_u" class="form-select form-select-md mb-3 shadow-none text-primary" required name="spp_id">
                                <?php foreach ($spp as $b): ?>
                                 <option value="<?php echo $b['id']; ?>"><?php echo $b['tahun']; ?> | <?php echo $b['bulan']; ?> | <?php echo $b['nominal']; ?></option>
                                 <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jumlah Bayar</label>
                                <input type="text" class="form-control" id="jml_bayar" name="jml_bayar" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Petugas</label>
                                <select type="text" id="petugas_id_u" class="form-select form-select-md mb-3 shadow-none text-primary" required name="petugas_id">
                                <?php foreach ($petugas as $p): ?>
                                 <option value="<?php echo $p['id']; ?>"><?php echo $p['nama_petugas']; ?></option>
                                 <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Status</label>
                                <input type="text text-primary" class="form-control" id="ket" name="ket" value="Lunas">
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
      <?= $this->include('layout/footer') ?>
      <script src="../../assets/js/core/libs.min.js"></script>     