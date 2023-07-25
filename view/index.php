<?php
include '../handle/category.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <!-- Title Page-->
    <title>Category</title>
    <?php include 'css.php'; ?>
</head>
<body class="animsition">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row m-t-25">
                <?php
                if (isset($flag)) {
                ?>
                    <div class="card-body">
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            <span class="badge badge-pill badge-success">Success</span>
                            <strong id="flag">
                                <?php
                                    print_r($flag);
                                ?>
                            </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Categories</strong>
                            <button type="button" data-toggle="modal" data-target="#add_category" class=" float-right btn btn-primary btn-sm "><i class="fa fa-plus-circle"></i>&nbsp;</button>
                            <div class="row my-3">
                                <div class="col-12">
                                    <form class="form-header" action="" method="POST">
                                        <input class="" type="hidden" name="form_name" value="search_category" />
                                        <input require class="au-input col-11 au-input--xl" type="text" value="<?php echo !empty($keyword) ?  $keyword : '' ?>" name="search_cate" placeholder="Search for datas..." />
                                        <button class=" col-1  au-btn--submit" type="submit">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th> #</th>
                                        <th width="">Category Name </th>
                                        <th> Operations </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($keyword)) {
                                        $result = $category->read_search($keyword);
                                        // print_r($result); 
                                        $num = $result->rowCount();
                                        if ($num > 0) {
                                            $rows = $result->fetchAll();
                                            $i = 1;
                                            $categories = $rows;
                                            // echo '<pre>';
                                            // print_r($categories);
                                            foreach ($categories as $row) {
                                    ?>
                                                <tr>
                                                    <td> <?php echo $i++ ?> </td>
                                                    <td> <?php echo $row['name'] ?></td>
                                                    <td>
                                                        <button type="button" data-toggle="modal" data-target="#edit_category<?php echo $row['id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-lightbulb-o"></i>&nbsp;Edit</button>
                                                        <button type="button" data-toggle="modal" data-target="#copy_category<?php echo $row['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa fa-magic"></i>&nbsp;Copy</button>
                                                        <button type="button" data-toggle="modal" data-target="#delete_category<?php echo $row['id'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-star"></i>&nbsp;Delete</button>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        }
                                    } else {
                                        $result = $category->read();
                                        // print_r($result); 
                                        $num = $result->rowCount();
                                        if ($num > 0) {
                                            $rows = $result->fetchAll();
                                            $i = 1;
                                            $categories = $category->data_tree($rows, 0);
                                            // echo '<pre>';
                                            // print_r($categories);
                                            foreach ($categories as $row) {
                                            ?>
                                                <tr>
                                                    <td> <?php echo $i++ ?> </td>
                                                    <td> <?php echo str_repeat('&nbsp;', $row['level'] * 15) . ($row['level'] > 0 ?  str_repeat('---', 1) : '') .  $row['name'] ?></td>
                                                    <td>
                                                        <button type="button" data-toggle="modal" data-target="#edit_category<?php echo $row['id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-lightbulb-o"></i>&nbsp;Edit</button>
                                                        <button type="button" data-toggle="modal" data-target="#copy_category<?php echo $row['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa fa-magic"></i>&nbsp;Copy</button>
                                                        <button type="button" data-toggle="modal" data-target="#delete_category<?php echo $row['id'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-star"></i>&nbsp;Delete</button>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- create -->

    <div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Add new category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" name="frm_edit">
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Category name</label>
                            </div>
                            <div class="col-12 col-md-12">
                                <input value="" type="text" id="text-input" name="name" placeholder="" class="form-control">
                                <small class="form-text text-muted">We'll never share your email wiith anyone else </small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="select" class=" form-control-label">Parent category</label>
                            </div>
                            <div class="col-12 col-md-12">
                                <select name="parent_id" id="select" class="form-control">
                                    <option disabled selected value="">Option Categories</option>
                                    <?php
                                    $options = $category->read();
                                    while ($rs = $options->fetch()) {
                                    ?>
                                        <option  
                                        value="<?php echo $rs['id'] ?>">
                                        <?php echo $rs['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="float-start ">
                            <input type="hidden" name="form_name" value="add_category">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- create -->
    <?php
    $result = $category->read();
    $num = $result->rowCount();
    if ($num > 0) {
        while ($rows = $result->fetch()) {
    ?>
            <div class="modal fade" id="edit_category<?php echo $rows['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Edit category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" name="frm_edit">
                            <div class="modal-body">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Category name</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input value="<?php echo $rows['name'] ?>" type="text" id="text-input" name="name" placeholder="" class="form-control">
                                        <small class="form-text text-muted">We'll never share your email wiith anyone else </small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Parent category</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <select name="parent_id" id="select" class="form-control">
                                            <option disabled selected value="">Option Categories</option>
                                            <?php
                                            $options = $category->read();
                                            while ($rs = $options->fetch()) {
                                            ?>
                                                <option 
                                                <?php 
                                                if ($rs['id'] == $rows['parent_id'])
                                                echo 'selected';
                                                if($rs['id'] == $rows['id'])
                                                echo 'disabled';
                                                ?> 
                                                value="<?php echo $rs['id'] ?>">
                                                <?php echo $rs['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class=" float-start ">
                                    <input type="hidden" name="form_name" value="edit_category">
                                    <input type="hidden" name="id" value="<?php echo $rows['id'] ?>">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit -->

            <!-- Copy -->
            <div class="modal fade" id="copy_category<?php echo $rows['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Copy category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" name="frm_edit">
                            <div class="modal-body">
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Category name</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <input value="<?php echo $rows['name'] ?>" type="text" id="text-input" name="name" placeholder="" class="form-control">
                                        <small class="form-text text-muted">We'll never share your email wiith anyone else </small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="select" class=" form-control-label">Parent Category</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <select name="parent_id" id="select" class="form-control">
                                            <option disabled selected value="">Option Categories</option>
                                            <?php
                                            $options = $category->read();
                                            while ($rs = $options->fetch()) {
                                            ?>
                                                <option 
                                                <?php 
                                                if ($rs['id'] == $rows['parent_id'])
                                                echo 'selected';
                                                if($rs['id'] == $rows['id'])
                                                echo 'disabled';
                                                 ?> 
                                                value="<?php echo $rs['id'] ?>">
                                                <?php echo $rs['name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class=" float-start ">
                                    <input type="hidden" name="form_name" value="add_category">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete -->
            <div class="modal fade" id="delete_category<?php echo $rows['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <form method="POST" action="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Delete Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Are you sure that you want to delete this category?
                                </p>
                            </div>
                            <div class="d-block float-left modal-footer ">
                                <input type="hidden" name="form_name" value="delete_category">
                                <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    <?php
        }
    }
    ?>
    </div>
    </div>
    <?php include 'js.php'; ?>
</body>
</html>