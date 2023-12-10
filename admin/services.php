<?php
include('includes/header.php')
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Services 
                    <a href="services-create.php" class="btn btn-primary float-end">Add Services</a>
                </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                <table class="table table-bordered table-striped">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            
                            <th>Status</th>
                            <th>action</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        $services = getall('services');
                        if ($services) {
                            if (mysqli_num_rows($services) > 0) {
                                foreach ($services as $servicesItem) {
                        ?>
                                    <tr>
                                        
                                        <td><?= $servicesItem['id'] ?></td>
                                        <td><?= $servicesItem['name'] ?></td>
                                        <td>
                                            <?php
                                            if ($servicesItem['status'] == 1) {
                                                echo '<span class="badge bg-danger text-white">Hidden</span>';
                                            } else {
                                                echo '<span class="badge bg-success text-white">Visible</span>';
                                            }
                                            
                                            ?>
                                        </td>

                                        <td>
                                            <a href="services-edit.php?id=<?= $servicesItem['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="services-delete.php?id=<?= $servicesItem['id'] ?>" class="btn btn-danger btn-sm mx-2" onclick="return confirm('Are You Sure You Want to Delete This Data? ')" ;>

                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No Record Found</td>
                                </tr>
                        <?php
                            }
                        } else {
                            ?>
                                <tr>
                                    <td colspan="5">Something Went Wrong</td>
                                </tr>
                        <?php
                        }


                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php')
?>