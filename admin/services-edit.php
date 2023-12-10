<?php
include('includes/header.php')
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Services
                    <a href="services.php" class="btn btn-primary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">

                    <?php
                        $paramResult = checkParamId('id');
                        if (!is_numeric($paramResult)) {
                            echo '<h5>' . $paramResult . '</h5>';
                            return false;
                        }
                        $services = getById('services', $paramResult);
                        if ($services) 
                        {
                            if ($services['status'] == 200) 
                            {
                                ?>   

                                    <input type="hidden" name="servicesId" value="<?=$services['data']['id']?>">
                                    <div class="mb-3">
                                        <label>Services Name</label>
                                        <input type="text" name="name" value="<?=$services['data']['name']?>" require class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Small Description</label>
                                        <textarea name="small_description" require class="form-control" rows="3"><?=$services['data']['small_description']?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Long Description</label>
                                        <textarea name="long_description" require class="form-control" rows="3"><?=$services['data']['long_description']?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Upload Services Image</label>
                                        <input type="file" name="image" require class="form-control">
                                        <img src="<?= '../'.$services['data']['image']?>" style="width:70px; height:70px;" alt="Img">
                                    </div>
                                    <h5>SEO Tags</h5>
                                    <div class="mb-3">
                                        <label>Meta Title</label>
                                        <input type="text" name="meta_title" value="<?=$services['data']['meta_title']?>" require class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Meta Description</label>
                                        <textarea name="meta_description" class="form-control" rows="3"><?=$services['data']['meta_description']?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Meta Keyword</label>
                                        <textarea name="meta_keyword" class="form-control" rows="3"><?=$services['data']['meta_keyword']?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Status (checked=hidden,un-checked=visibke)</label>
                                        <br>
                                        <input type="checkbox" name="status" <?=$services['data']['status'] == 1 ? 'checked': '' ?> style="width: 30px;height:30px">
                                    </div>
                                    <div class="mb-3 text-end">
                                        <button type="submit" class="btn btn-primary" name="updateServices">Update Services</button>
                                    </div>
                                 <?php
                            }
                            else
                            {
                                echo '<h5> No such Data Found </h5>';
                            }
                        }
                        else
                        {
                            echo '<h5> Something Went Wrong </h5>';
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php')
?>