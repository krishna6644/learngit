<footer>
  <div class="footer">
    <p>Copyright 2020 <a href="https://fivesmarket.com/" class="link">Fives Market</a> </p>
  </div>
</footer>
</div>
</div>
<!-- wrapper end -->



<!-- Jquery Library File -->
<!-- <script src="<?php echo base_url() ?>/assets/js/jquery-3.4.1.min.js"></script> 
<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/popper.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

<script type="application/javascript">
/** After windod Load */
$(window).bind("load", function() {
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 5000);
});
</script>


<script src="<?php echo base_url() ?>/assets/js/datatable/datatables.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/script.js"></script>
<script src="<?php echo base_url() ?>/assets/js/datatable/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/datatable/buttons.flash.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/datatable/jszip.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/datatable/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/datatable/vfs_fonts.js"></script>
<script src="<?php echo base_url() ?>/assets/js/datatable/buttons.html5.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/datatable/buttons.print.min.js"></script>
<script src="<?php echo base_url() ?>/assets/category.js"></script>
<?php if (!empty($page && $page == 'category_list')) { ?>
  <script src="<?php echo base_url() ?>/assets/categoryindex.js"></script>
<?php } ?>
<?php if (!empty($page && $page == 'product_list')) { ?>
  <script src="<?php echo base_url() ?>/assets/product.js"></script>
  <script type="text/javascript" src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/productindex.js"></script>
  <script src="<?php echo base_url() ?>/assets/ajax.js"></script>
  <script src="<?php echo base_url() ?>/assets/js/dropzone.min.js"></script>

  <script src="<?php echo base_url() ?>/assets/dropzoneip.js"></script>
<?php } ?>




<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="<?php echo base_url() ?>/assets/payment.js"></script>



</body>

</html>