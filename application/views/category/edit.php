<div class="content-main">
    <div class="content-main__inner">
        <div class="row">
            <div class="col-lg-12">
            <?php if($this->session->flashdata('errorcat')): ?>
		<div class="alert alert-danger fade show" role="alert">
			<div class="alert-text"><?php echo $this->session->flashdata('errorcat')?></div>
			<div class="alert-close">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true"><i class="la la-close"></i></span>
				</button>
			</div>
		</div>
		<?php endif; if($this->session->flashdata('successcat')):?>
			<div class="alert alert-success fade show" role="alert">
				<div class="alert-text"><?php echo $this->session->flashdata('successcat')?></div>
				<div class="alert-close">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="la la-close"></i></span>
					</button>
				</div>
			</div>
		<?php endif; ?>
                <div class="card-box">
                    <div class="card-box__header">
                        <h5>Category</h5>

                    </div>

                    <div class="card-box__content">
                        <form action="<?php echo base_url('category/update/' . $category->cat_id); ?>" method="post" enctype="multipart/form-data" >

                            <div class="row">
                                <div class="col-12">
                                    <div class="input-field">
                                        <label>Category Name</label>
                                        <input type="text" placeholder="Name" name="category_name" value="<?php echo $category->category_name; ?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-field">
                                        <label>Sub Category</label>
                                        <select name="category_id" type="number">
                                            <option value="">Select</option>
                                            <?php foreach ($subcategory as $value) : ?>
                                                <option value="<?php echo $value['cat_id'] ?>" <?php echo (!empty($category->category_id) && $category->category_id == $value['cat_id']) ? 'selected' : '' ?>><?php echo $value['category_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-field">
                                        <label for="exampleSelect1">Status:</label>
                                        <select class="form-control" name="status">
                                            <option value="active" <?php echo (!empty($category->status) && $category->status == 'active') ? 'selected' : '' ?>>Active</option>
                                            <option value="inactive" <?php echo (!empty($category->status) && $category->status == 'inactive') ? 'selected' : '' ?>>InActive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-field">
                                        <label>Admin image</label>
                                        <div></div>
                                        <div class="col-12">
                                            <div class="input-field">
                                                <label>Choose file</label>
                                                <input type="file" name="image">

                                            </div>
                                            <?php
                                            if (!empty($category->image)) {
                                                echo '<img  src="' . base_url() . 'uploads/admin/' . $category->image . '" height="100px" width="100px" />';
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-field">
                                        <button class="button">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>