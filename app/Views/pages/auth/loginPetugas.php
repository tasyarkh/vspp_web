<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?= $title; ?></title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="../../assets/css/core/libs.min.css" />
      
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="../../assets/css/hope-ui.min.css?v=2.0.0" />
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="../../assets/css/custom.min.css?v=2.0.0" />
      
      <!-- Dark Css -->
      <link rel="stylesheet" href="../../assets/css/dark.min.css"/>
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="../../assets/css/customizer.min.css" />
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="../../assets/css/rtl.min.css"/>
      
      
  </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
    
      <div class="wrapper">
      <section class="login-content">
         <div class="row m-0 align-items-center bg-white vh-100">            
            <div class="col-md-6">
               <div class="row justify-content-center">
                  <div class="col-md-10">
                     <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                        <div class="card-body">
                           <h2 class="mb-2 text-left text-primary">Login Petugas</h2>
                           <p class="text-left mb-4">Selamat Datang di V-SPP</p>
                           <form role="form" action="<?= base_url('check'); ?>" method="POST">
                           <?= csrf_field(); ?>
                              <div class="row">
                                 <div class="col-lg-12">
                                 <div class="form-group">
                                       <label for="username" class="form-label">Username</label>
                                       <input type="text" class="form-control" id="username" aria-describedby="username" name="username">
                                    </div>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="password" class="form-label">Password</label>
                                       <input type="password" class="form-control" id="password" aria-describedby="password" name="password">
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex justify-content-left gap-3 mt-5">
                                 <button type="submit" class="btn btn-primary">Login</button>
                                 <a type="submit" class="btn btn-secondary" href="/loginSiswa">Siswa</a>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
               <img src="../../assets/images/auth/logomini.png" class="img-fluid gradient-main " alt="images">
            </div>
         </div>
      </section>
      </div>
    
    <!-- Library Bundle Script -->
    <script src="../../assets/js/core/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="../../assets/js/core/external.min.js"></script>
    
    <!-- Widgetchart Script -->
    <script src="../../assets/js/charts/widgetcharts.js"></script>
    
    <!-- mapchart Script -->
    <script src="../../assets/js/charts/vectore-chart.js"></script>
    <script src="../../assets/js/charts/dashboard.js" ></script>
    
    <!-- fslightbox Script -->
    <script src="../../assets/js/plugins/fslightbox.js"></script>
    
    <!-- Settings Script -->
    <script src="../../assets/js/plugins/setting.js"></script>
    
    <!-- Slider-tab Script -->
    <script src="../../assets/js/plugins/slider-tabs.js"></script>
    
    <!-- Form Wizard Script -->
    <script src="../../assets/js/plugins/form-wizard.js"></script>
    
    <!-- AOS Animation Plugin-->
    
    <!-- App Script -->
    <script src="../../assets/js/sweetalert.js" defer></script>
    <script src="../../assets/js/hope-ui.js" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert"></script>
    <script src="<?= base_url(); ?>/assets/js/sweetalert.js"></script>
    <script src="<?= base_url(); ?>//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (session()->getFlashdata('gagal')) { ?>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Username atau Password Salah !'
            })

        <?php } ?>
        <?php if (session()->getFlashdata('tidakAktif')) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: 'Maaf Akun Tidak Aktif, Segera Hubungi Administrator',
                timer: 3500,
                showConfirmButton: false,

            })

        <?php } ?>
        <?php if (session()->getFlashdata('belum')) { ?>
            Swal.fire({
                icon: 'warning',
                title: 'Anda Belum Login',
                text: 'Silahkan Login Terlebih Dahulu',
                timer: 3500,
                showConfirmButton: false,

            })

        <?php } ?>
    </script>
  </body>
</html>