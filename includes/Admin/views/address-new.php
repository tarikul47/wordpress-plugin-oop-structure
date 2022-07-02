<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('New Address Book', 'wecoder-academy');?></h1>

    <?php var_dump($this->has_error('name'));?>
    <?php var_dump($this->get_error('name'));?>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="form-required<?php echo $this->has_error( 'name' ) ? ' form-invalid' : '' ;?>">    
                    <th scope="row">
                        <label for="name"><?php _e('Name', 'wecoder_academy');?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="">
                    </td>
                    <?php if ( $this->has_error( 'name' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'name' ); ?></p>
                    <?php } ?>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="address"><?php _e('Address', 'wecoder_academy');?></label>
                    </th>
                    <td>
                        <textarea class="regular-text" name="address" id="address"></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="phone"><?php _e('Phone', 'wecoder_academy');?></label>
                    </th>
                    <td>
                        <input type="text" name="phone" id="phone" class="regular-text" value="">
                        <?php if ( $this->has_error( 'phone' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'phone' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php wp_nonce_field('new-address')?>
        <?php submit_button(__('Add Address', 'wecoder_academy'), 'primary', 'submit_address', )?>
    </form>

</div>