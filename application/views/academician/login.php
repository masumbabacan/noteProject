
<!-- header -->
<?php $this->load->view("academician/include/header") ?> 
<!-- /header -->
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                        <?php echo validation_errors(); ?>
                                        <?php echo $this->session->flashdata("hata"); ?>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Akademisyen Girişi</h1>
                                    </div>
                                    <form class="user" method="post" action="<?php echo base_url("academician/academician/login") ?>">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email"
                                                name="email"
                                                placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="password" placeholder="Şifre">
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">Giriş Yap</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- footer -->
  <?php $this->load->view("academician/include/footer") ?> 
  <!-- /footer -->