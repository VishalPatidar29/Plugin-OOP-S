<?php

function add_display_value($value, $column_name, $user_id)
{
    $user = get_userdata($user_id);
    switch ($column_name) {
        case 'display_as':
            $buttons = '<label><input type="radio" class="save_display" name="display_as-' . $user_id . '" value="approve" ' . checked('approve' == $user->display_as, true, false) . '>Approve</label><br />' .
                '<label><input type="radio" class="save_display" name="display_as-' . $user_id . '" value="notapprove" ' . checked('notapprove' == $user->display_as, true, false) . '>Not Approve</label>';
            return $buttons;
            break;
        default:
    }

    return $value;
}

function save_display_value()
{
    $value = $_POST['value'];
    $user_id = $_POST['userid'];
    update_usermeta($user_id, 'display_as', $value);
    exit();
}


function save_display_value_javascript()
    {
        global $current_screen;
        if ($current_screen->id != 'users')
            return; ?>
        <script type="text/javascript">
            jQuery('.save_display').click(function () {
                var value = jQuery(this).val();
                var userid = jQuery(this).attr('name').split('-')[1];
                jQuery.post('<?php echo admin_url("admin-ajax.php") ?>', { action: 'save_display_value', userid: userid, value: value }, function (response) { console.log('successfull add by me'); });
            });
        </script>

        <?php
    }


?>