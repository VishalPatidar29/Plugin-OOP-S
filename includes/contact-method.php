<?php

function new_contact_methods($contactmethods)
    {
        $contactmethods['phone'] = 'Phone Number';
        $contactmethods['address'] = 'Address';

        return $contactmethods;
    }

    function new_modify_user_table($column)
    {
        $column['phone'] = 'Phone';
        $column['address'] = 'Address';
        $column['display_as'] = 'Approve';
        return $column;
    }


    function new_modify_user_table_row($val, $column_name, $user_id)
    {
        switch ($column_name) {
            case 'phone':
                return get_the_author_meta('phone', $user_id);
            case 'address':
                return get_the_author_meta('address', $user_id);

            default:
        }
        return $val;
    }



?>