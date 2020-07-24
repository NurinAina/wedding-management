<!doctype html>
<html>

<head>
    <title>IT'S WEDDING</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
    <style>
        body {
            padding: 15px;
        }
    </style>
</head>

<body>
    <h2 style="margin-top:0px">Cus_staff <?php echo $button ?></h2>
    <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="int">StaffId <?php echo form_error('staffId') ?></label>
            <input type="text" class="form-control" name="staffId" id="staffId" placeholder="StaffId" value="<?php echo $staffId; ?>" />
        </div>
        <div class="form-group">
            <label for="int">CusId <?php echo form_error('cusId') ?></label>
            <input type="text" class="form-control" name="cusId" id="cusId" placeholder="CusId" value="<?php echo $cusId; ?>" />
        </div>
        <input type="hidden" name="cus_staffId" value="<?php echo $cus_staffId; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('cus_staff') ?>" class="btn btn-default">Cancel</a>
    </form>
</body>

</html>