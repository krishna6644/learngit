<div class="content-main">
    <div class="content-main__inner">
        <div class="row">
            <div class="col-lg-12">
            <?php if($this->session->flashdata('error')): ?>
		<div class="alert alert-danger fade show" role="alert">
			<div class="alert-text"><?php echo $this->session->flashdata('error')?></div>
			<div class="alert-close">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true"><i class="la la-close"></i></span>
				</button>
			</div>
		</div>
		<?php endif; if($this->session->flashdata('success')):?>
			<div class="alert alert-success fade show" role="alert">
				<div class="alert-text"><?php echo $this->session->flashdata('success')?></div>
				<div class="alert-close">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="la la-close"></i></span>
					</button>
				</div>
			</div>
		<?php endif; ?>
                <div class="card-box">
               
                    <div class="card-box__header">
                        <h5>Product</h5>

                    </div>

                    <div class="card-box__content">
                        <form action="<?php echo base_url('product/store') ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-field">
                                        <label>Parent Category Name</label>
                                        <select name="cat_name" type="text" id="parentcat">
                                            <option value="">Select</option>
                                            <?php foreach ($category as $value) : ?>
                                                <option value="<?php echo $value['cat_id'] ?>"><?php echo $value['category_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-field">
                                        <label>Sub Category Name</label>
                                        <select name="sub_cat_name" type="text" id="subcat">
                                            <option value="">Select</option>
                                          
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-field">
                                        <label>Product Name</label>
                                        <input type="text" placeholder="Product Name" name="product_name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-field">
                                        <label>slug</label>
                                        <input type="text" placeholder="Slug" name="slug">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-field">
                                        <label>Price</label>
                                        <input type="number" placeholder="0.00" name="price">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-field">
                                        <label>Selling Price</label>
                                        <input type="number" placeholder="0.00" name="selling_price">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-field">
                                        <label>Stock</label>
                                        <input type="number" placeholder="0.00" name="stock">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-field">
                                    <label for="exampleSelect1">Status:</label>
                                    <select class="form-control" name="status">
                                        <option value="active" >Active</option>
                                        <option value="inactive" >InActive</option>
                                    </select>
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
