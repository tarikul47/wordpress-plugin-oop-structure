<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Address Book list', 'wecoder-academy');?></h1>
    <a href="<?php echo admin_url('admin.php?page=wecoder-academy&action=new') ?>" class="page-title-action"><?php _e('Add New', 'wecoder-academy');?></a>

    <form action="" method="POST">
        <?php
$table = new \Wecoder\Academy\Admin\Address_list();
$table->prepare_items();
$table->display();
?>
    </form>
</div>