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
    <h2>Cus_staff List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>StaffId</th>
            <th>CusId</th>

        </tr><?php
                foreach ($cus_staff_data as $cus_staff) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $cus_staff->staffId ?></td>
                <td><?php echo $cus_staff->cusId ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>