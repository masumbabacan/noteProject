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
                    <h5 class="my-2">Ders Seçimi</h5>
                </div>
                <table class="lesson-table table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Ders Kodu</th>
                            <th scope="col">Ders Adı</th>
                            <th scope="col">Dersi Seç</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($lessons as $lesson) { ?>
                        <tr>
                            <td><?php echo $lesson->lessonCode ?></td>
                            <td><?php echo $lesson->lessonName ?></td>
                            <td><a href="#" data-id="<?php echo $lesson->lessonCode ?>" class="lessonSelectionBtn btn btn-success">Seç</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  <!-- footer -->
<?php $this->load->view("student/include/footer") ?> 
  <!-- /footer -->
<script>
$(".lesson-table").DataTable();
$(".lessonSelectionBtn").on("click",function (e) {
    let data = {
        lessonNumber : $(e.currentTarget).attr("data-id"),
        studentNumber : <?php echo $info->studentNumber ?>,
    }
    $.ajax({
        type : "post",
        url: "<?php echo base_url("student/studentPanel/lessonSelection/") ?>",
        data: {data : data},
        success: function (response) {
            if (response == 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Dersi Başarıyla Seçtiniz'
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Bu Dersi Zaten Aldın'
                })
            }
        },
    })
})
</script>