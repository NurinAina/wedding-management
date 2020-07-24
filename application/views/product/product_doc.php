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
    <h2>Product List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>ProImg</th>
            <th>ProPrice</th>
            <th>DesId</th>

        </tr><?php
                foreach ($product_data as $product) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $product->proImg ?></td>
                <td><?php echo $product->proPrice ?></td>
                <td><?php echo $product->desId ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>