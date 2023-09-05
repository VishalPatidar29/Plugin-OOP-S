<?php

function export_user_data()
{
    if (isset($_POST['export_data']) && isset($_POST['alluser'])) {
        global $wpdb;

        $users = get_users();

        $csv_output = "User ID     ||     Username      ||     Email                ||     Number          ||     Address\n"; // CSV header

        foreach ($users as $user) {

            $csv_output .= "{$user->ID}           ||     {$user->user_login}        ||     {$user->user_email}     ||";
            $usermeta = get_user_meta($user->ID);
            $csv_output .= "     {$usermeta['phone'][0]}     ||     {$usermeta['address'][0]}\n";

        }
        // Generate CSV file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="user_data.csv"');
        echo $csv_output;
        exit();
    } else if (isset($_POST['approve'])) {

        global $wpdb;

        $users = get_users();
        $csv_output = "User ID     ||     Username      ||     Email                ||     Number          ||     Address\n"; // CSV header

        foreach ($users as $user) {
            $usermeta = get_user_meta($user->ID);
            $data = $usermeta['display_as'][0];
            if ($data == 'approve') {

                $csv_output .= "{$user->ID}           ||     {$user->user_login}        ||     {$user->user_email}     ||";
                $csv_output .= "     {$usermeta['phone'][0]}     ||     {$usermeta['address'][0]}\n";
            }

        }
        // Generate CSV file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="user_data.csv"');
        echo $csv_output;
        exit();

    }
}



?>