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
                <h5 class="my-2">Bölümler</h5>
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-sm my-2">Bölüm Ekle</a>
              </div>
              <table class="faculty-table table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Bölüm Kodu</th>
                        <th scope="col">fakülte adı</th>
                        <th scope="col">bölüm adı</th>
                        <th scope="col">Sil</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($departments as $department) { ?>
                    <tr>
                        <td><?php echo $department->departmentCode ?></td>
                        <td><?php echo $department->facultyName ?></td>
                        <td><?php echo $department->departmentName ?></td>
                        <td><a href="#" type="button" data-id="<?php echo $department->departmentCode ?>" class="department-delete btn btn-danger btn-sm">Sil</a></td>
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
            <label for="select">Fakülte Seçiniz</label>
            <select class="form-select faculty-select" aria-label="Fakülte Seçin">
                <?php foreach ($faculties as $faculty) { ?>
                    <option data-id="<?php echo $faculty->facultyCode ?>"><?php echo $faculty->facultyName ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="faculty-name">Bölüm Adı</label>
            <input type="text" class="form-control" id="department-name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="faculty-modal-close btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="department-add btn btn-primary">Ekle</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function () {
  $('.faculty-select').select2({
        dropdownParent: $('#exampleModal')
  });
  $(".faculty-table").DataTable();
})
$(".department-add").on("click",function () {
    if ($("#department-name").val() !== "") {
        let department = {
            facultyCode : "",
            name : ""
        }
        department.facultyCode = $(".faculty-select :selected").attr("data-id")
        department.name = $("#department-name").val();  
        $.ajax({
            type : "post",
            url: "<?php echo base_url("admin/adminPanel/departmentAdd") ?>",
            data: {data : department},
            success: function (response) {
                if (response === "1") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Bölüm Eklendi'
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

$(".department-delete").on("click",function (e) {
    let data = $(e.currentTarget).attr("data-id");
    $.ajax({
      type : "post",
      url: "<?php echo base_url("admin/adminPanel/departmentDelete") ?>",
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