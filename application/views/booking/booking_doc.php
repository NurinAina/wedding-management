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
    <h2>Booking List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>BookDate</th>
            <th>ProId</th>
            <th>PayId</th>

        </tr><?php
                foreach ($booking_data as $booking) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $booking->bookDate ?></td>
                <td><?php echo $booking->proId ?></td>
                <td><?php echo $booking->payId ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>