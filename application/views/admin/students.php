<!-- header -->
<?php $this->load->view("admin/include/header") ?> 
<!-- /header -->
<body id="page-top">
    <div id="wrapper">
      <!-- sidebar -->
      <?php $this->load->view("admin/include/sidebar") ?> 
      <!-- /sidebar -->
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <div class="container my-5">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="my-2">Öğrenciler</h5>
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-sm my-2">Öğrenci Ekle</a>
              </div>
              <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Öğrenci Numarası</th>
                        <th scope="col">Adı</th>
                        <th scope="col">Soyadı</th>
                        <th scope="col">Telefon Numarası</th>
                        <th scope="col">Email</th>
                        <th scope="col">Sil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) { ?>
                    <tr>
                        <td><?php echo $student->studentNumber ?></td>
                        <td><?php echo $student->firstName ?></td>
                        <td><?php echo $student->lastName ?></td>
                        <td><?php echo $student->phoneNumber ?></td>
                        <td><?php echo $student->email ?></td>
                        <td><a href="#" data-id="<?php echo $student->studentNumber ?>" class="student-delete btn btn-danger">Sil</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <!-- footer -->
<?php $this->load->view("admin/include/footer") ?> 
  <!-- /footer -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="faculty-name">Adı</label>
            <input type="text" class="form-control" id="student-name">
        </div>
        <div class="form-group">
            <label for="faculty-name">Soyadı</label>
            <input type="text" class="form-control" id="student-lastName">
        </div>
        <div class="form-group">
            <label for="faculty-name">Telefon Numarası</label>
            <input type="text" class="form-control" id="student-phone">
        </div>
        <div class="form-group">
            <label for="faculty-name">Email</label>
            <input type="text" class="form-control" id="student-email">
        </div>
        <div class="form-group">
            <label for="faculty-name">Şifre</label>
            <input type="text" class="form-control" id="student-password">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="student-modal-close btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="student-add btn btn-primary">Ekle</button>
      </div>
    </div>
  </div>
</div>

<script>
$(".table").DataTable();
$(".student-add").on("click",function () {
    if ($("#student-name").val() !== "" && $("#student-lastName").val() !== "") {
        let student = {
            name : "",
            lastName : "",
            phone : "",
            email : "",
            password : ""
        }
        student.name = $("#student-name").val();
        student.lastName = $("#student-lastName").val();
        student.phone = $("#student-phone").val();
        student.email = $("#student-email").val();
        student.password = $("#student-password").val();
        console.log(student)
        $.ajax({
            type : "post",
            url: "<?php echo base_url("admin/adminPanel/studentAdd") ?>",
            data: {data : student},
            success: function (response) {
                if (response === "1") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Öğrenci Eklendi'
                    })
                    $(".student-modal-close").trigger("click");
                    $(".swal2-confirm").on("click",function () {
                        location.reload();
                    })
                }
            },
        })
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Hata',
            text: 'Lütfen Alanları Boş Bırakmayınız.'
        })
    }
})

$(".student-delete").on("click",function (e) {
    let data = $(e.currentTarget).attr("data-id");
    $.ajax({
        type : "post",
        url: "<?php echo base_url("admin/adminPanel/studentDelete") ?>",
        data: {data : data},
        success: function (response) {
        console.log(response);
            if (response == 1) {
            Swal.fire({
                icon: 'success',
                title: 'Başarıyla Silindi'
            })
            $(".swal2-confirm").on("click",function () {
                location.reload();
            })
            }
        },
    })
});
    
</script>