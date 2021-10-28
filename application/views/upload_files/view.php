<div class="content-main">
    <div class="content-main__inner">

        <div class="upload-div">

            <form action="<?php echo base_url('dropzone/dragDropUpload/'); ?>" method="post" enctype="multipart/form-data" class="dropzone">
                <div class="col-12">
                    <div class="input-field">
                        <label>Product Name</label>
                        <select name="product_id" id="product_id" type="number">
                            <option value="">Select</option>
                            <?php foreach ($products as $product) : ?>
                                <option value="<?php echo $product['p_id'] ?>"><?php echo $product['product_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </form>
            <div class="col-12">
                <button class="btn btn-primary" id="startUpload">UPLOAD</button>
            </div>

        </div>
        <div class="gallery">
            <h3>uploaded files:</h3>

            <?php
            if (!empty($files)) {

                foreach ($files as $row) {

                    $filePath = 'uploads/admin/' . $row["file_name"];
                    $fileMime = mime_content_type($filePath);
            ?>

                    <embed src="<?php echo base_url('uploads/admin/' . $row["file_name"]); ?>" type="<?php echo $fileMime; ?>" width="200px" height="200px" />

                <?php
                }
            } else {
                ?>
                <p>No file(s) found...</p>

            <?php } ?>
        </div>
    </div>
</div>