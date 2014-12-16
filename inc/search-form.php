<form role="search" name="search_<?php echo rand ( 0 , 1000 ); ?>" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
    <input type="text" name="s" value="" />
    <input type="submit" alt="Search" value="Search" />
    <?php if( $a['taxid'] ):?>
    <input type="hidden" name="taxid" value="<?php echo $a['taxid']; ?>" />
    <?php endif;?>
</form>