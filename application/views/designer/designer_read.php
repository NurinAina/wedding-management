<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>IT'S WEDDING</title>
    <!--bootstrap files-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--bootstrap files-->

    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">

    <style>
        body {
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }

        ul li {
            list-style: none;
        }

        ul li a {
            color: black;
            font-weight: bold;
        }

        ul li a:hover {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        #social-fb,
        #social-tw,
        #social-gp,
        #social-em {
            color: blue;
        }

        #social-fb:hover {
            color: #4267B2;
        }

        #social-tw:hover {
            color: #1DA1F2;
        }

        #social-gp:hover {
            color: #D0463B;
        }

        #social-em:hover {
            color: #D0463B;
        }
    </style>
</head>

<body>
    <div id="result" style="position:fixed;top:300; right:500;z-index: 3000;width:350px;background:white;"></div>
    <div id="resulthotel" style=" margin:0px auto; position:fixed; top:150px;right:750px; background:white;  z-index: 3000;"></div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

        <a class="navbar-brand" href="<?= base_url('admindash'); ?>"><span style="color:white;font-family: cursive;">Wedding Time!</span></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('staff'); ?>">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('designer'); ?>">Designer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('login/logout'); ?>">LOGOUT</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--menu ends-->

    <br><br><br><br>
    <!--details section-->

    <div class="container">

        <table class="table table-bordered" style="margin-bottom: 10px"">
            <tr>
                <td>Designer Name</td>
                <td><?php echo $desName; ?></td>
            </tr>
            <tr>
                <td>Designer Phone</td>
                <td><?php echo $desPhone; ?></td>
            </tr>
            <tr>
                <td>Designer Address</td>
                <td><?php echo $desAdd; ?></td>
            </tr>
            <tr>
                <td></td>
                <td style=" text-align:right"><a href="<?php echo site_url('designer') ?>" class="btn btn-dark">Cancel</a></td>
            </tr>
        </table>
    </div>
</body>

</html>