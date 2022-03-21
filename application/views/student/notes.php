<!-- header -->
<?php $this->load->view("student/include/header") ?> 
<!-- /header -->
<body id="page-top">
    <div id="wrapper">
      <!-- sidebar -->
      <?php $this->load->view("student/include/sidebar") ?> 
      <!-- /sidebar -->
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container my-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="my-2">Notlarım</h5>
                </div>
                <table class="note-table table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Ders Kodu</th>
                            <th scope="col">Ders Adı</th>
                            <th scope="col">Vize</th>
                            <th scope="col">Final</th>
                            <th scope="col">Ortalama</th>
                            <th scope="col">Harf Notu</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($notes as $note) { ?>
                        <tr>
                            <td><?php echo $note->lessonCode ?></td>
                            <td><?php echo $note->lessonName ?></td>
                            <td><?php echo $note->vize ?></td>
                            <td><?php echo $note->final ?></td>
                            <td><?php echo $note->average ?></td>
                            <td><?php 
                            if ($note->average > 0 && $note->average <= 35) {
                                echo "aaa";
                            }elseif ($note->average >= 36 && $note->average <= 45) {
                                echo "DD";
                            }elseif ($note->average >= 46 && $note->average <= 50) {
                                echo "DC";
                            }elseif ($note->average >= 51 && $note->average <= 55) {
                                echo "CC";
                            }elseif ($note->average >= 56 && $note->average <= 63) {
                                echo "CB";
                            }elseif ($note->average >= 64 && $note->average <= 71) {
                                echo "BB";
                            }elseif ($note->average >= 72 && $note->average <= 80) {
                                echo "BA";
                            }elseif ($note->average >= 81 && $note->average <= 100) {
                                echo "AA";
                            }elseif (empty($note->average)) {
                                echo "";
                            }
                            ?></td>
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
    $(document).ready(function () {
        $(".note-table").dataTable();
    })
</script>