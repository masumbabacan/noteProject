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
                <h5 class="my-2">Fakülteler</h5>
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-sm my-2">Fakülte Ekle</a>
              </div>
              <table class="faculty-table table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Fakülte Kodu</th>
                        <th scope="col">Fakülte Adı</th>
                        <th scope="col">Sil</th>
                        <th scope="col">Düzenle</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($faculties as $faculty) { ?>
                    <tr>
                        <td><?php echo $faculty->facultyCode ?></td>
                        <td><?php echo $faculty->facultyName ?></td>
                        <td><a href="#" type="button" data-id="<?php echo $faculty->facultyCode ?>" class="faculty-delete btn btn-danger btn-sm">Sil</a></td>
                        <td><a href="#" type="button" data-id="<?php echo $faculty->facultyCode ?>" class="faculty-edit btn btn-warning btn-sm">Düzenle</a></td>
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
            <label for="faculty-name">Fakülte Adı</label>
            <input type="text" class="form-control" id="faculty-name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="faculty-modal-close btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="faculty-add btn btn-primary">Ekle</button>
      </div>
    </div>
  </div>
</div>
<!-- ------------------------------ -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
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
            <label for="faculty-name">Fakülte Kodu</label>
            <input type="text" disabled class="form-control" id="faculty-edit-code">
        </div>
        <div class="form-group">
            <label for="faculty-name">Fakülte Adı</label>
            <input type="text" class="form-control" id="faculty-edit-name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="faculty-modal-close btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="faculty-edit-completed btn btn-primary">Düzenle</button>
      </div>
    </div>
  </div>
</div>
<script>
$(".faculty-table").DataTable({
    pageLength : 5,
    lengthMenu : [[5, 10, 15, 30, 60, -1],[5, 10, 15, 30, 60, "Tümü"]],
    language:{
        url:"//cdn.datatables.net/plug-ins/1.11.5/i18n/tr.json",
    },
    // processing: true,
    // serverSide: true,
    // ajax: {
    //     url: "<?php echo base_url("admin/adminPanel/faculties") ?>",
    //     type: "post",
    // }
});
    
$(".faculty-add").on("click",function () {
    if ($("#faculty-code").val() !== "" && $("#faculty-name").val() !== "") {
        let faculty = {
            name : "",
        }
        faculty.name = $("#faculty-name").val();  
        $.ajax({
            type : "post",
            url: "<?php echo base_url("admin/adminPanel/facultyAdd") ?>",
            data: {data : faculty},
            success: function (response) {
                if (response === "1") {
                Swal.fire({
                    icon: 'success',
                    title: 'Fakülte Eklendi'
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
$(".faculty-delete").on("click",function (e) {
    let data = $(e.currentTarget).attr("data-id");
    $.ajax({
      type : "post",
      url: "<?php echo base_url("admin/adminPanel/facultyDelete") ?>",
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

$(".faculty-edit").on("click",function (e) {
  let dataId = $(e.currentTarget).attr("data-id");
  $.ajax({
      type : "post",
      url: "<?php echo base_url("admin/adminPanel/getAjaxFaculty") ?>",
      data: {data : dataId},
      success: function (response) {
          response = JSON.parse(response)[0];
          $("#faculty-edit-code").val(response.facultyCode);
          $("#faculty-edit-name").val(response.facultyName);
          $("#editModal").modal("show");
      },
  })
});

$(".faculty-edit-completed").on("click",function () {
  let faculty = {
    code : "",
    name : "",
  }
  faculty.code = $("#faculty-edit-code").val();
  faculty.name = $("#faculty-edit-name").val();
  $.ajax({
      type : "post",
      url: "<?php echo base_url("admin/adminPanel/facultyEdit") ?>",
      data: {data : faculty},
      success: function (response) {
          if (response == 1) {
            Swal.fire({
              icon: 'success',
              title: 'Başarıyla Güncellendi'
            })
            $("#editModal").modal("hide");
            $(".swal2-confirm").on("click",function () {
              location.reload();
          })
          }else{
            Swal.fire({
              icon: 'danger',
              title: 'Güncelleme Başarısız'
            })
          }
      },
  })
})
</script>