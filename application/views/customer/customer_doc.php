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
    <h2>Customer List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>CusName</th>
            <th>CusPhone</th>
            <th>CusAdd</th>
            <th>BookId</th>

        </tr><?php
                foreach ($customer_data as $customer) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $customer->cusName ?></td>
                <td><?php echo $customer->cusPhone ?></td>
                <td><?php echo $customer->cusAdd ?></td>
                <td><?php echo $customer->bookId ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>