
<!-- header -->
<?php $this->load->view("student/include/header") ?> 
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
                                        <h1 class="h4 text-gray-900 mb-4">Öğrenci Girişi</h1>
                                    </div>
                                    <form class="user" method="post" action="<?php echo base_url("student/student/login") ?>">
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
                                        <a href="#" data-toggle="modal" data-target="#forgotPassword">Şifremi Unuttum</a>
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
<div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
            <label for="faculty-name">Email Adresinizi Giriniz</label>
            <input type="text" class="form-control" id="forgotPasswordInput">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="faculty-modal-close btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="send-password btn btn-primary">Şifremi Gönder</button>
      </div>
    </div>
  </div>
</div>
  <!-- footer -->
  <?php $this->load->view("student/include/footer") ?> 
  <!-- /footer -->
<script>
$(".send-password").on("click",function () {
    let data = $("#forgotPasswordInput").val();
    $.ajax({
        type : "post",
        url: "<?php echo base_url("student/student/forgotPassword/") ?>",
        data: {data : data},
        success: function (response) {
            if (response == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Böyle Bir Email Bulunmamaktadır'
                })
            }else if(response == 1){
                Swal.fire({
                    icon: 'success',
                    title: 'Şifreniz Mail Adresinize Gönderildi'
                })
            }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Mail gönderilirken hata oluştu'
                }) 
            }
        },
    })
});
</script>