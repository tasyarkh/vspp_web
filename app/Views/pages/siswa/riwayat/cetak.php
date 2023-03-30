<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?= $title; ?></title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../assets/images/favicon.ico" />
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="../assets/css/core/libs.min.css" />
      
      <!-- Aos Animation Css -->
      <link rel="stylesheet" href="../assets/vendor/aos/dist/aos.css" />
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="../assets/css/hope-ui.min.css?v=2.0.0" />
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="../assets/css/custom.min.css?v=2.0.0" />
      
      <!-- Dark Css -->
      <link rel="stylesheet" href="../assets/css/dark.min.css"/>
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="../assets/css/customizer.min.css" />
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="../assets/css/rtl.min.css"/>
      
      <link rel="stylesheet" href="../assets/fa/css/all.min.css"/>
      
  </head>
  <body class="  ">
  <div class="container-scroller">
        <!-- partial -->
          <div class="content-wrapper">
            <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">                 
                  <hr/>
                   <!-- Kita tambilkan Biodata Siswa -->
                   <h4 class="card-title">Data Siswa</h4>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                         <td>NISN</td>
                         <td>:</td>
                         <td><?= session('nisn'); ?></td>
                        </tr>

                        <tr>
                          <td>Nama</td>
                          <td>:</td>
                          <td><?= session('nama'); ?></td>
                        </tr>
                        </thead>
                        </table>
                        <hr/>
                    </div>
                    </div>
                    </div>
                    </div>   
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   <!--Sekarang kita tampilkan history pembayarannya-->
                   <h4 class="card-title">Laporan Pemabayaran SPP</h4>
                  <div class="table-responsive pt-3">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Tanggal Bayar</th>
                           <th>Bulan Bayar</th>
                           <th>Tahun Bayar</th>
                           <th>Nominal SPP</th>
                           <th>Bln | Th</th>
                           <th>Bayar</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php 
                           $no = 1;
                           foreach ($result as $r) :
                    ?>
                        <tr>
                           <td><?= $r['tgl_bayar']; ?></td>
                           <td><?= $r['bln_bayar']; ?></td>
                           <td><?= $r['th_bayar']; ?></td>
                           <td><?= $r['nominal']; ?></td>
                           <td><?= $r['bulan']; ?> | <?= $r['tahun']; ?></td>
                           <td><?= $r['jml_bayar']; ?></td>
                           <td><?= $r['ket']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
                    </div>
                  </div>
                </div>
              </div>
                <script>
                    window.print();
                </script>
            </body>
          </html>