<?php include 't_header.php'?>
<div id="content">
     <h1>Upload a new image</h1>
     <form method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>New image</legend>
            Name: <input type="text" name="name" <?php if(!empty($aErrors)) {?> value="<?php echo $sPostFileName;?>"<?php }?>>
            <br>
            <?php if(isset($aErrors['name'])) {?>
            <p style="color:red;">Please enter a valid <b>Name</b></p>
            <?php }?>
            File: <input type="file" name="image">
            <br>
            <?php if(isset($aErrors['image'])) {?>
            <p style="color:red;">Please make sure you are uploadin an image file</p>
            <?php }?>
            <input type="submit" name="submit" value="Submit form">
            <?php if(isset($bChanged)){?>
            <?php if(!$bChanged){?>
                <p style="color:green;"><?php echo $sFileName;?> image uploaded</p>
            <?php }else{?>
                <p style="color:green;"><?php echo $sFileName;?> image changed</p>
            <?php }?>
                <p><a href="<?php echo $sUrl?>" target="_blank">[View image]</a></p>
         <?php }?>
        </fieldset>
     </form>
     
</div>
<?php include 't_footer.php'?>
