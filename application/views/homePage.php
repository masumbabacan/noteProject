<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php $this->load->view("dependencies/style") ?>
</head>
<body class="bg-dark">
    <div class="container d-flex justify-content-center align-items-center" style="height:100vh">
        <div class="buttons d-flex justify-content-center align-items-center flex-column">
            <a href="<?php echo base_url("student/student") ?>" class="btn btn-success mb-2" style="width:150px">Öğrenci</a>
            <a href="<?php echo base_url("academician/academician") ?>" class="btn btn-primary mb-2" style="width:150px">Akademisyen</a>
            <a href="<?php echo base_url("admin/admin") ?>" class="btn btn-danger" style="width:150px">Yönetici</a>
        </div>
    </div>

    <?php $this->load->view("dependencies/scripts") ?>
</body>
</html>