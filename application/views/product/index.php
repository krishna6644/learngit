<div class="content-main">
    <div class="content-main__inner">
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
        <div class="table-box">
            <div class="table-box__header table-box__header--button">
                <h4>DataTable</h4>
                <a href="<?php echo base_url('product/create') ?>" class="button button--left-icon">
                    <i class="fal fa-plus"></i>
                    Add Product
                </a>
            </div>
            <div class="card-box__content">
                <form action="" id="frm_filters" name="frm_filters">
                    <div class="row">
                        <label for=""><b>Product:</b></label>
                        <input type="text" name="filter_title" id="filter_title" class="col-md-2 mr-1" maxlength="128" minlength="1">
                        <label for=""><b> Category:</b></label>
                        <select name="sub_cat_name" type="text" id="subcat" class="col-md-2 mr-1">
                            <option value="">Select</option>
                        </select>
                        <label for=""><b>Parent Category:</b></label>
                        <select name="cat" type="text" id="parentcat" class="col-md-2 mr-1">
                            <option value="">Select</option>
                            <?php foreach ($category as $value) : ?>
                                <option value="<?php echo $value['cat_id'] ?>"><?php echo $value['category_name'] ?></option>
                            <?php endforeach; ?>
                        </select>



                        <label for=""><b>Price:</b></label>
                        <input type="number" name="price_filter" id="price_filter" class="col-md-1" maxlength="128" minlength="1">
                    </div>
                    <br>

                    <div class="row">
                        <input type="submit" name="frm-filter-btn" id="frm-filter-btn" class="col-md-1 btn-warning mr-1" value="Search">

                        <input type="button" class="col-md-1 btn-danger" value="Clear" onclick="window.location.href='<?php echo base_url(); ?>/product/index';">
                    </div>


                </form>

            </div>
            <div class="table-main  table-responsive">
                <table id="rep_news" class="table table-bordered ">
                    <thead>

                        <tr>
                            <th>Product Name</th>
                            <th>Category Name</th>

                            <th>Parent Category Name</th>
                            <th>Slug</th>
                            <th>Price</th>
                            <th>Selling Price</th>
                            <th>Stock</th>
                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>
                    <tbody>
                        <!-- <?php $i = 0 ?>
                        <?php foreach ($data as $key) : ?>

                            <tr>
                                <td><a class="label label-inline label-light-primary font-weight-bolder productimg" style="cursor:pointer" id="<?php echo $key['p_id']; ?>"><?php echo $key['product_name']; ?></a></td>
                                <td><?php echo $key['sub_cate'] ?></td>

                                <td><?php echo $key['parent_cat'] ?></td>
                                <td><?php echo $key['slug'] ?></td>
                                <td><?php echo $key['price'] ?></td>
                                <td><?php echo $key['selling_price'] ?></td>
                                <td><?php echo $key['stock'] ?></td>
                                <td><?php echo $key['status'] ?></td>
                                <td>

                                    <a class="btn btn-info btn-xs" href="<?php echo base_url('product/edit/' . $key['p_id'] . ' ') ?>"><i class="la la-edit"><i class="fas fa-edit"></i></a>

                                    <form method="DELETE" action="<?php echo base_url('product/delete/' . $key['p_id'] . ' ') ?>">

                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                    </form>

                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?> -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card-box">
                <div class="card-box__header">
                    <h5>Show Products Images</h5>
                </div>
                <div class="images_data">
                </div>

            </div>
        </div>
    </div>
</div>