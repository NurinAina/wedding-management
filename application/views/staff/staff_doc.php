<!doctype html>
<html>

<head>
    <title>IT'S WEDDING</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
    <style>
        .word-table {
            border: 1px solid black !important;
            border-collapse: collapse !important;
            width: 100%;
        }

        .word-table tr th,
        .word-table tr td {
            border: 1px solid black !important;
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <h2>Staff List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>StaffPass</th>
            <th>StaffName</th>
            <th>StaffAdd</th>
            <th>StaffPhone</th>
            <th>IsActive</th>
            <th>RoleId</th>

        </tr><?php
                foreach ($staff_data as $staff) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $staff->staffPass ?></td>
                <td><?php echo $staff->staffName ?></td>
                <td><?php echo $staff->staffAdd ?></td>
                <td><?php echo $staff->staffPhone ?></td>
                <td><?php echo $staff->isActive ?></td>
                <td><?php echo $staff->roleId ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>