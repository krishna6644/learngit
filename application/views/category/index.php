<div class="content-main">
    <div class="content-main__inner">
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
        <div class="table-box">
            <div class="table-box__header table-box__header--button">
                <h4>DataTable</h4>
                <a href="<?php echo base_url('category/create') ?>" class="button button--left-icon">
                    <i class="fal fa-plus"></i>
                    Add Category
                </a>
            </div>
            <div class="table-main  table-responsive">
                <table id="firsttable" class="table table-bordered ">
                    <thead>

                        <tr>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Parent Category Name</th>
                           
                           
                            <th>Status</th>
                            <th>Action</th>
                            

                        </tr>

                    </thead>
                    <tbody>
                        <!-- <?php $i=0 ?>
                        <?php foreach ($data as $key) : ?>
                            <tr>
                            <td><img class="img-avatar"  src="<?php echo (!empty($key['image']))  ? base_url('uploads/admin/'.$key['image'].' ') : base_url('assets/images/user.png') ?> " height="100px" width="100px" /></td>
                            <td><?php echo $key['category_name'] ?></td>
                            <td><?php echo $cat[$i]['parent_cat'] ?></td>
                            
                            <td><?php echo $key['status'] ?></td>
                                
                                <td>

                                    

                                    <form method="DELETE" action="<?php echo base_url('category/delete/' . $key['cat_id'] . ' ') ?>">
                                    <a class="btn btn-info btn-xs" href="<?php echo base_url('category/edit/' . $key['cat_id'] . ' ') ?>"><i class="la la-edit"><i class="fas fa-edit"></i></a>
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
    </div>
</div>
