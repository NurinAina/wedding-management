<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
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

        <a class="navbar-brand" href="#"><span style="color:white;font-family: cursive;">Wedding Time!</span></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

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
        <!--tab heading-->
        <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:darkgrey ;border-radius:auto;" role="tablist">
            <li class="nav-item">
                <a class="nav-link" style="color:#BDDEFD;" id="ManageDesigner-tab" data-toggle="tab" href="#ManageDesigner" role="tab" aria-controls="ManageDesigner" aria-selected="false">Manage Designer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:#BDDEFD;" id="ManageStaff-tab" data-toggle="tab" href="#ManageStaff" role="tab" aria-controls="ManageStaff" aria-selected="false">Manage Staff</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:#BDDEFD;" id="manageaccount-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="manageaccount" aria-selected="false">Account Settings</a>
            </li>


        </ul>
        <br><br>
        <!--tab 1 starts-->
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="ManageDesigner" role="tabpanel" aria-labelledby="ManageDesigner-tab">
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Designer Id</th>
                                <th scope="col">Designer Name</th>
                                <th scope="col">Designer Phone</th>
                                <th scope="col">Designer Address</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--<?php
                                $query = mysqli_query($connection, "select designer.desId,designer.desName,designer.desPhone,designer.desAdd,
                                                        product.proId,product.proImg,product.proPrice from  designer right join product on designer.desId=product.desId");
                                while ($row = mysqli_fetch_array($query)) {

                                ?>

                                <tr>
                                    <th scope="row"><?php echo $row['desId']; ?></th>
                                    <td><?php echo $row['desName']; ?></td>
                                    <td><?php echo $row['desPhone']; ?></td>
                                    <td><?php echo $row['desAdd']; ?></td>
                                    <form method="post">
                                        <td><a href=""><button type="submit" value="<?php echo $row['desId']; ?>" name="delete" class="btn btn-danger">Remove </button></td>
                                    </form>
                                </tr>
                            <?php
                                }
                            ?>-->
                        </tbody>
                    </table>

                </div>

                <span style="color:green; text-align:centre;"><?php if (isset($success)) {
                                                                    echo $success;
                                                                } ?></span>


            </div>

            <!--tab 1 ends-->

            <!--tab 2-->
            <div class="tab-pane fade show" id="ManageStaff" role="tabpanel" aria-labelledby="ManageStaff-tab">
                <div class="container">

                    <div class="col-md-4">
                        <?php echo anchor(site_url('staff/create'), 'Create', 'class="btn btn-primary"'); ?>
                    </div>

                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
                    </div>

                    <table class="table" style="margin-bottom: 10px">
                        <thead>
                            <tr>
                                <th style="text-align:center">No</th>
                                <th style="text-align:center">StaffPass</th>
                                <th style="text-align:center">StaffName</th>
                                <th style="text-align:center">StaffAdd</th>
                                <th style="text-align:center">StaffPhone</th>
                                <th style="text-align:center">IsActive</th>
                                <th style="text-align:center">RoleId</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($staff_data as $staff) {
                            ?>

                                <tr>

                                    <td style="text-align:center" width="80px"><?php echo ++$start ?></td>
                                    <td style="text-align:center"><?php echo $staff->staffPass ?></td>
                                    <td style="text-align:center"><?php echo $staff->staffName ?></td>
                                    <td style="text-align:center"><?php echo $staff->staffAdd ?></td>
                                    <td style="text-align:center"><?php echo $staff->staffPhone ?></td>
                                    <td style="text-align:center"><?php echo $staff->isActive ?></td>
                                    <td style="text-align:center"><?php echo $staff->roleId ?></td>
                                    <td style="text-align:center" width="200px">
                                        <?php
                                        echo anchor(site_url('staff/read/' . $staff->staffId), 'Read');
                                        echo ' | ';
                                        echo anchor(site_url('staff/update/' . $staff->staffId), 'Update');
                                        echo ' | ';
                                        echo anchor(site_url('staff/delete/' . $staff->staffId), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                            <?php echo anchor(site_url('staff/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                            <?php echo anchor(site_url('staff/word'), 'Word', 'class="btn btn-primary"'); ?>
                        </div>
                        <div class="col-md-6 text-right">
                            <?php echo $pagination ?>
                        </div>
                    </div>
                    <!--tab 2 end-->

                    <!--tab 3 starts-->
                    <div class="tab-pane fade" id="manageaccount" role="tabpanel" aria-labelledby="manageaccount-tab">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="username" value="<?php if (isset($user)) {
                                                                            echo $user;
                                                                        } ?>" class="form-control" name="name" readonly="readonly" />
                            </div>

                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" name="password" class="form-control" value="<?php if (isset($pass)) {
                                                                                                        echo $pass;
                                                                                                    } ?>" id="pwd" required />
                            </div>

                            <button type="submit" name="update" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Update</button>
                            <div class="footer" style="color:red;"><?php if (isset($ermsg)) {
                                                                        echo $ermsg;
                                                                    } ?><?php if (isset($ermsg2)) {
                                                                                    echo $ermsg2;
                                                                                } ?></div>
                        </form>
                    </div>
                    <!--tab 3 ends-->

                    </tbody>
                    </table>

                </div>
            </div>

            </tbody>
            </table>
        </div>


    </div>
    </div>
    <br><br><br>

</body>

</html>