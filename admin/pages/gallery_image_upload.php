<?php include 'includes/cypher_log_restrict.php'; ?>

<table id="cypher-store-table">
  <tr>
    <td class="cypher-store-left">
      <div class="v-menu">
        <?php include('includes/cypher_vmenu.php');?>
      </div>
    </td>
    <td class="cypher-store-right">
      <div id="con-admin">
        <h2>Gallery - Images</h2>
        <div id="crudControl">
          <a href="index.php?pg=gallery_image_upload">Add Image</a> |
          <a href="index.php?pg=gallery">Image Listing</a>
        </div>
        <div class="dataForm-wrapper" style="margin-top: 16px;">
          <div class="dataForm">
            <fieldset>
              <legend>Image Upload</legend>
              <div id='crudForm'>
                <?php include('modules/cypher_mod_gallery.php');?>
              </div>
            </fieldset>
          </div>  
        </div>        
      </div>
    </td>
  </tr>
</table>