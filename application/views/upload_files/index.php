<div class="content-main">
    <div class="content-main__inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="card-box__header">
                        <h5>Images For Products</h5>
                        <?php echo !empty($statusMsg) ? '<p class="status-msg">' . $statusMsg . '</p>' : ''; ?>
                    </div>
                    <div class="card-box__content">
                       
                        <form id="upload" method="post" action="<?php echo base_url('upload_files'); ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-field">
                                        <label>Product Name</label>
                                        <select name="product_id" type="number">
                                            <option value="">Select</option>
                                            <?php foreach ($products as $product) : ?>
                                                <option value="<?php echo $product['p_id'] ?>"><?php echo $product['product_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-field">
                                        <label>Choose file</label>
                                        <input type="file" class="form-control" name="files[]" multiple />
                                    </div>
                                </div>
                               
                                <div class="col-2 mt-2">
                                    <input class="btn btn-success" type="submit" name="fileSubmit" value="UPLOAD" />
                                </div>


                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>