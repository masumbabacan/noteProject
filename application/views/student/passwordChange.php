<!-- header -->
<?php $this->load->view("student/include/header") ?> 
<!-- /header -->
<?php $info = $this->session->userdata("info"); ?>
<body id="page-top">
    <div id="wrapper">
      <!-- sidebar -->
      <?php $this->load->view("student/include/sidebar") ?> 
      <!-- /sidebar -->
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container my-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="my-2">Şifremi Değiştir</h5>
                </div>
                <div class="password-div">
                    <div class="form-group">
                        <label>Eski Şifre</label>
                        <input type="password" class="form-control" id="oldPassword">
                    </div>
                    <div class="form-group">
                        <label>Yeni Şifre</label>
                        <input type="password" class="form-control" id="newPassword">
                    </div>
                    <div class="form-group">
                        <label>Şifre Tekrar</label>
                        <input type="password" class="form-control" id="confirmPassword">
                    </div>
                </div>
                <button disabled class="passwordChangeAdd btn btn-success">İşlemi Tamamla</button>
            </div>
        </div>
      </div>
    </div>
  <!-- footer -->
<?php $this->load->view("student/include/footer") ?> 
  <!-- /footer -->
<script>
$("#confirmPassword").on("keyup",function (e) {
   $(".passwordMessage").remove();
   if ($("#newPassword").val() === $(e.currentTarget).val()) {
       $(".password-div").after("<p class='passwordMessage text-success'>Şifreler Aynı</p>")
        $(".passwordChangeAdd").removeAttr("disabled");
   }else{
       $(".password-div").after("<p class='passwordMessage text-danger'>Şifreler Uyumsuz</p>")
       $(".passwordChangeAdd").attr("disabled","true");
   }
});
$(".passwordChangeAdd").on("click",function () {
    let password = {
        oldPassword : "",
        newPassword : ""
    };
    password.oldPassword = $("#oldPassword").val();
    password.newPassword = $("#newPassword").val();
    $.ajax({
        type : "post",
        url: "<?php echo base_url("student/studentPanel/passwordChangeAdd/$info->studentNumber") ?>",
        data: {data : password},
        success: function (response) {
            console.log(response);
          if (response == 1) {
            Swal.fire({
                icon: 'success',
                title: 'Şifre Değişikliği Başarılı'
            })
          }else{
            Swal.fire({
                icon: 'error',
                title: 'Eski Şifreniz Yanlış'
            })
          }
        },
    })
})
</script>