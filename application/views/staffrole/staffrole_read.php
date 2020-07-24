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
    <h2 style="margin-top:0px">Staffrole Read</h2>
    <table class="table">
        <tr>
            <td>Role</td>
            <td><?php echo $role; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><a href="<?php echo site_url('staffrole') ?>" class="btn btn-default">Cancel</a></td>
        </tr>
    </table>
</body>

</html>