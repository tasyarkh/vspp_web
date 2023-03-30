<?= $this->include('layout/siswa/header') ?> 
      <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <div class="header-title">
                  <h4 class="card-title">Transaksi SPP</h4>
                  <a type="button" class="btn btn-soft-info btn-sm mt-4" href="<?= base_url('riwayat/cetakSiswa'); ?>" target="_blank">Cetak</a>
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

                        </tr>
                     </thead>
                     <tbody>
                     <?php 
                           $no = 1;
                           foreach ($result as $r) :
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

      <?= $this->include('layout/footer') ?>
      <script src="../../assets/js/core/libs.min.js"></script>
