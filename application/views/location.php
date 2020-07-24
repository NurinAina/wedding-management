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
        }


        .mapouter {
            position: relative;
            text-align: right;
            height: 499px;
            width: 466px;
        }

        .gmap_canvas {
            overflow: hidden;
            background: none !important;
            height: 499px;
            width: 466px;
        }
    </style>
</head>

<body>

    <div id="result" style="position:fixed;top:300; right:500;z-index: 3000;width:350px;background:white;"></div>
    <div id="resulthotel" style=" margin:0px auto; position:fixed; top:150px;right:750px; background:white;  z-index: 3000;"></div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

        <a class="navbar-brand" href="<?= base_url('Dashboard'); ?>"><span style="color:white;font-family: cursive;">Wedding Time!</span></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Gmaps'); ?>">Find Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('login'); ?>">LOGIN</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--menu ends-->

    <div class="container">
        <div class="row" style="margin-top:90px">
            <div class="col-md-4 text-left">
                <div id="demo" class="carousel slide" data-ride="carousel">
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe width="466" height="499" id="gmap_canvas" src="https://maps.google.com/maps?q=No.%2042%2C%20Lebuh%20Lapangan%20Siber%202%2C%20Bandar%20Cyber%2C%2031350%20Ipoh%20%2C%20Perak&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">

            </div>

            <div class="col-md-6 text-right" style="margin-top: 100px">
                <table class="table table-hover">
                    <tr>
                        <td style="text-align:left">Name</td>
                        <td style="text-align:center">Redha Bridal Shop</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Address</td>
                        <td style="text-align:center"> No 42, Lebuh Lapangan Siber 2, 31350 Ipoh, Negeri Perak</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Contact</td>
                        <td style="text-align:center">0123456789</td>
                    </tr>
                    <tr>
                        <td style="text-align:left">Email</td>
                        <td style="text-align:center">redha@bridal.com</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>