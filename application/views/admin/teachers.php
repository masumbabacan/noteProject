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
                <h5 class="my-2">Akademisyenler</h5>
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-sm my-2">Akademisyen Ekle</a>
              </div>
              <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Akademisyen Numarası</th>
                        <th scope="col">Adı</th>
                        <th scope="col">Soyadı</th>
                        <th scope="col">Ünvanı</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ders Ata</th>
                        <th scope="col">Sil</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($teachers as $teacher) { ?>
                    <tr>
                        <td><?php echo $teacher->teacherNumber ?></td>
                        <td><?php echo $teacher->firstName ?></td>
                        <td><?php echo $teacher->lastName ?></td>
                        <td><?php echo $teacher->title ?></td>
                        <td><?php echo $teacher->email ?></td>
                        <td><a href="#" data-toggle="modal" data-target="#dersata" data-id="<?php echo $teacher->teacherNumber ?>" class="teacherlessonbtn btn btn-success btn-xs">Ata</a></td>
                        <td><a href="#" data-id="<?php echo $teacher->teacherNumber ?>" class="teacher-delete btn btn-danger btn-xs">Sil</a></td>
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
            <input type="text" class="form-control" id="teacher-name">
        </div>
        <div class="form-group">
            <label for="faculty-name">Soyadı</label>
            <input type="text" class="form-control" id="teacher-lastName">
        </div>
        <div class="form-group">
            <label for="faculty-name">Ünvanı</label>
            <input type="text" class="form-control" id="teacher-title">
        </div>
        <div class="form-group">
            <label for="faculty-name">Email</label>
            <input type="text" class="form-control" id="teacher-email">
        </div>
        <div class="form-group">
            <label for="faculty-name">Şifre</label>
            <input type="text" class="form-control" id="teacher-password">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="faculty-modal-close btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="teacher-add btn btn-primary">Ekle</button>
      </div>
    </div>
  </div>
</div>
<!-- --------------------------------- -->
<div class="modal fade" id="dersata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label for="cars">Ders Seçimi</label>
        <select id="lessons">
            <?php foreach ($lessons as $lesson) { ?>
                <option value="<?php echo $lesson->lessonCode ?>"><?php echo $lesson->lessonName ?></option>
            <?php } ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="dersata-modal-close btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="teacherlessonadd btn btn-primary">Ekle</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
  $('#lessons').select2({
        dropdownParent: $('#dersata')
  });
  $(".table").DataTable();
})
$(".teacher-add").on("click",function () {
    if ($("#teacher-name").val() !== "" && $("#teacher-lastName").val() !== "") {
        let teacher = {
            name : "",
            lastName : "",
            title : "",
            email : "",
            password : ""
        }
        teacher.name = $("#teacher-name").val();
        teacher.lastName = $("#teacher-lastName").val();
        teacher.title = $("#teacher-title").val();
        teacher.email = $("#teacher-email").val();
        teacher.password = $("#teacher-password").val();
        $.ajax({
            type : "post",
            url: "<?php echo base_url("admin/adminPanel/teacherAdd") ?>",
            data: {data : teacher},
            success: function (response) {
                if (response === "1") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Akademisyen Eklendi'
                    })
                    $(".faculty-modal-close").trigger("click");
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

$(".teacher-delete").on("click",function (e) {
       let data = $(e.currentTarget).attr("data-id");
       $.ajax({
          type : "post",
          url: "<?php echo base_url("admin/adminPanel/teacherDelete") ?>",
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

let teacherNumber = "";
$(".teacherlessonbtn").on("click",function (e) {
    teacherNumber = $(e.currentTarget).attr("data-id");
})
$(".teacherlessonadd").on("click",function () {
    let teacherLesson = {
        teacherNumber : teacherNumber,
        lessonNumber : ""
    }
    teacherLesson.lessonNumber = $("#lessons :selected").attr("value");
    $.ajax({
            type : "post",
            url: "<?php echo base_url("admin/adminPanel/teacherLessonAdd") ?>",
            data: {data : teacherLesson},
            success: function (response) {
                if (response === "1") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ders Ataması Başarılı'
                    })
                    $(".dersata-modal-close").trigger("click");
                    $(".swal2-confirm").on("click",function () {
                        location.reload();
                    })
                }
            },
        })
})
    
</script>