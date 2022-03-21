<!-- header -->
<?php $this->load->view("academician/include/header") ?> 
<!-- /header -->
<body id="page-top">
    <div id="wrapper">
      <!-- sidebar -->
      <?php $this->load->view("academician/include/sidebar") ?> 
      <!-- /sidebar -->
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <div class="container my-5">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="my-2">Dersler</h5>
              </div>
              <table class="lesson-table table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Ders Kodu</th>
                        <th scope="col">Ders Adı</th>
                        <th scope="col">Ders Dönemi</th>
                        <th scope="col">Öğrenciler</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lessons as $lesson) { ?>
                    <tr>
                        <td><?php echo $lesson->lessonNumber ?></td>
                        <td><?php echo $lesson->lessonName ?></td>
                        <td><?php echo $lesson->lessonPeriod ?></td>
                        <td><a href="#" type="button" data-id="<?php echo $lesson->lessonNumber ?>" class="students btn btn-danger btn-sm">Öğrenciler</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <!-- footer -->
<?php $this->load->view("academician/include/footer") ?> 
  <!-- /footer -->
  <div class="modal fade" id="studentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="student-table table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Ders Kodu</th>
                        <th scope="col">Öğrenci Numarası</th>
                        <th scope="col">Adı</th>
                        <th scope="col">Soyadı</th>
                        <th scope="col">Vize</th>
                        <th scope="col">Final</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="faculty-modal-close btn btn-secondary" data-dismiss="modal">Vazgeç</button>
        <button type="button" class="note-add btn btn-primary">Kaydet</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(".lesson-table").DataTable();
  $(".students").on("click",function (e) {
    $(".student-table tbody").html("");
    let lessonCode = $(e.currentTarget).attr("data-id");
    $.ajax({
        type : "post",
        url: "<?php echo base_url("academician/academicianPanel/studentLessons") ?>",
        data: {data : lessonCode},
        success: function (response) {
            response = JSON.parse(response);
            response.forEach(element => {
              $(".student-table tbody").append(`
                  <tr>
                      <td class="lesson-code">${element.lessonCode}</td>
                      <td class="student-code">${element.studentNumber}</td>
                      <td>${element.firstName}</td>
                      <td>${element.lastName}</td>
                      <td><input value="${(element.vize == null) ? "" : element.vize}" class="vize" type="text"></td>
                      <td><input value="${(element.final == null) ? "" : element.final}" class="final" type="text"></td>
                  </tr>
              `)
            });
            $("#studentsModal").modal("show");
        },
    })
  })
  $(".note-add").on("click",function () {
    let students = [];
    for (const iterator of $(".student-table tbody tr")) {
      let studentNote = {
        lessonCode : $(iterator).find(".lesson-code").text(),
        studentCode : $(iterator).find(".student-code").text(),
        vize : $(iterator).find(".vize").val(),
        final : $(iterator).find(".final").val()
      }
      students.push(studentNote);
    }
    $.ajax({
        type : "post",
        url: "<?php echo base_url("academician/academicianPanel/studentNotesAdd") ?>",
        data: {students : students},
        success: function (response) {
          console.log(response);
            if (response.indexOf("0") == -1) {
              Swal.fire({
                icon: 'success',
                title: 'Bütün Notlar Düzenlendi'
              })
              $(".swal2-confirm").on("click",function () {
                $("#studentsModal").modal("hide");
                location.reload();
              })
            }else{
              Swal.fire({
                icon: 'Danger',
                title: 'Bazı Notlar Girilemedi'
              })
              $(".swal2-confirm").on("click",function () {
                $("#studentsModal").modal("hide");
                location.reload();
              })
            }
        },
    })
  });
</script>