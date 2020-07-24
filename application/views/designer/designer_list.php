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

        <!--tab 1 starts-->
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="ManageDesigner" role="tabpanel" aria-labelledby="ManageDesigner-tab">
                <div class="container">
                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-md-4">
                            <?php echo anchor(site_url('designer/create'), 'Create', 'class="btn btn-dark"'); ?>
                        </div>
                        <div class="col-md-4 text-center">
                            <div style="margin-top: 8px" id="message">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                            </div>
                        </div>
                        <div class="col-md-1 text-right">
                        </div>
                        <div class="col-md-3 text-right">
                            <form action="<?php echo site_url('designer/index'); ?>" class="form-inline" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                    <span class="input-group-btn">
                                        <?php
                                        if ($q <> '') {
                                        ?>
                                            <a href="<?php echo site_url('designer'); ?>" class="btn btn-dark">Reset</a>
                                        <?php
                                        }
                                        ?>
                                        <button class="btn btn-dark" type="submit">Search</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table" table-bordered" style="margin-bottom: 10px">

                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Designer Name</th>
                            <th scope="col">Designer Phone</th>
                            <th scope="col">Option</th>
                        </tr>
                        <?php
                        foreach ($designer_data as $designer) {
                        ?> <tr>

                                <td width="80px"><?php echo ++$start ?></td>
                                <td><?php echo $designer->desName ?></td>
                                <td><?php echo $designer->desPhone ?></td>
                                <td style="text-align:center" width="200px">
                                    <?php
                                    echo anchor(site_url('designer/read/' . $designer->desId), 'Read');
                                    echo ' | ';
                                    echo anchor(site_url('designer/update/' . $designer->desId), 'Update');
                                    echo ' | ';
                                    echo anchor(site_url('designer/delete/' . $designer->desId), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo anchor(site_url('designer/word'), 'Word', 'class="btn btn-dark"'); ?>
                            <p>Total Record : <?php echo $total_rows ?>
                        </div>
                        <div class="col-md-6 text-right">
                            <?php echo $pagination ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!--tab 1 ends-->
</body>

</html>