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
                <h5 class="my-2">Dersler</h5>
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-sm my-2">Ders Ekle</a>
              </div>
              <table class="lesson-table table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Ders Kodu</th>
                        <th scope="col">Bölüm adı</th>
                        <th scope="col">Ders adı</th>
                        <th scope="col">Ders dönemi</th>
                        <th scope="col">Sil</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lessons as $lesson) { ?>
                    <tr>
                        <td><?php echo $lesson->lessonCode ?></td>
                        <td><?php echo $lesson->departmentName ?></td>
                        <td><?php echo $lesson->lessonName ?></td>
                        <td><?php echo $lesson->lessonPeriod ?></td>
                        <td><a href="#" type="button" data-id="<?php echo $lesson->lessonCode ?>" class="lesson-delete btn btn-danger btn-sm">Sil</a></td>
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
            <label for="select">Bölüm Seçiniz</label>
            <select class="form-select lesson-select" aria-label="ders Seçin">
                <?php foreach ($departments as $department) { ?>
                    <option data-id="<?php echo $department->departmentCode ?>"><?php echo $department->departmentName ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="faculty-name">Ders Adı</label>
            <input type="text" class="form-control" id="lesson-name">
        </div>
        <div class="form-group">
            <label for="faculty-name">Ders Dönemi</label>
            <input type="text" class="form-control" id="lesson-period">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="faculty-modal-close btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="lesson-add btn btn-primary">Ekle</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function () {
  $('.lesson-select').select2({
        dropdownParent: $('#exampleModal')
  });
  $(".lesson-table").DataTable();
})
$(".lesson-add").on("click",function () {
    if ($("#lesson-name").val() !== "" && $("#lesson-period").val() !== "") {
        let lesson = {
            departmentCode : "",
            name : "",
            period : ""
        }
        lesson.departmentCode = $(".lesson-select :selected").attr("data-id")
        lesson.name = $("#lesson-name").val();  
        lesson.period = $("#lesson-period").val();
        $.ajax({
            type : "post",
            url: "<?php echo base_url("admin/adminPanel/lessonAdd") ?>",
            data: {data : lesson},
            success: function (response) {
                if (response === "1") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ders Eklendi'
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

$(".lesson-delete").on("click",function (e) {
       let data = $(e.currentTarget).attr("data-id");
       $.ajax({
          type : "post",
          url: "<?php echo base_url("admin/adminPanel/lessonDelete") ?>",
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