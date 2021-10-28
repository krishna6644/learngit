<div class="content-main">
    <div class="content-main__inner">
        <div class="table-box">
            <div class="table-box__header table-box__header--button">
                <h4>DataTable</h4>
                <a href="<?php echo base_url('upload_files') ?>" class="button button--left-icon">
                    <i class="fal fa-plus"></i>
                    Add
                </a>
            </div>
            <div class="table-main  table-responsive">
                <table id="first-table" class="table table-bordered ">
                    <thead>

                        <tr>
                        <th>Product Name</th>
                        <th>Multi-Images</th>
                        

                        </tr>

                    </thead>
                    <tbody>
                        
                        <?php foreach ($data as $key) : ?>
                            <tr>
                            <td><?php echo $key['product_id'] ?></td>
                            <td><img class="img-avatar"  src="<?php echo (!empty($key['file_name']))  ? base_url('uploads/admin/'.$key['file_name'].' ') : base_url('assets/images/user.png') ?> " height="100px" width="100px" /></td>
                           
                                
                              
                            </tr>
                          
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>