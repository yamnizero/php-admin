<?php
include('includes/header.php')
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Social Media Lists
                    <a href="social-media-create.php" class="btn btn-primary float-end">Add Social Media</a>
                </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                <table class="table table-bordered table-striped">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        $socialMedias = getall('social_medias');
                        if ($socialMedias) {
                            if (mysqli_num_rows($socialMedias) > 0) {
                                foreach ($socialMedias as $socialItem) {
                        ?>
                                    <tr>
                                        <td><?= $socialItem['id'] ?></td>
                                        <td><?= $socialItem['name'] ?></td>
                                        <td><?= $socialItem['url'] ?></td>
                                        <td><?= $socialItem['status'] == 1 ? 'Hidden' : 'Shown' ?></td>

                                        <td>
                                            <a href="social-media-edit.php?id=<?= $socialItem['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="social-media-delete.php?id=<?= $socialItem['id'] ?>" class="btn btn-danger btn-sm mx-2" onclick="return confirm('Are You Sure You Want to Delete This Data? ')" ;>

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