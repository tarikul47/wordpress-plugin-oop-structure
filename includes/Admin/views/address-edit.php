<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Edit Address Book', 'wecoder-academy');?></h1>

    <?php 
    if(isset($_GET['address-updated'])){?>
        <div class="notice notice-success">
            <?php _e('Address has been updated successfully!','wecoder-academy');?>
        </div>
    <?php }?>

    <?php var_dump($address);?>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="form-required<?php echo $this->has_error('name') ? ' form-invalid' : ''; ?>">
                    <th scope="row">
                        <label for="name"><?php _e('Name', 'wecoder_academy');?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="<?php echo esc_attr($address->name);?>">
                    </td>
                    <?php if ($this->has_error('name')) {?>
                            <p class="description error"><?php echo $this->get_error('name'); ?></p>
                    <?php }?>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="address"><?php _e('Address', 'wecoder_academy');?></label>
                    </th>
                    <td>
                        <textarea class="regular-text" name="address" id="address">
                        <?php echo esc_textarea($address->address);?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="phone"><?php _e('Phone', 'wecoder_academy');?></label>
                    </th>
                    <td>
                        <input type="text" name="phone" id="phone" class="regular-text" value="<?php echo esc_attr($address->phone);?>">
                        <?php if ($this->has_error('phone')) {?>
                            <p class="description error"><?php echo $this->get_error('phone'); ?></p>
                        <?php }?>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" name="id" value="<?php echo esc_attr($address->id);?>">
        <?php wp_nonce_field('new-address')?>
        <?php submit_button(__('Update Address', 'wecoder_academy'), 'primary', 'submit_address', )?>
    </form>

</div>