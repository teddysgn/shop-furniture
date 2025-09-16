<?php
error_reporting(0);
date_default_timezone_set('Asia/Ho_Chi_Minh');
$link = mysqli_connect('193.203.166.146', 'u580409902_nguyenhoangvu', 'Nguyenhoangvu@123', 'u580409902_shop');
if(!$link) {
    die('Connect failed!'.mysqli_error());
}
$output = '';
if(isset($_POST)) {
    $query = "SELECT `o`.`id`, `o`.`username`, `o`.`products`, `o`.`names`, `o`.`quantities`, `o`.`totalPrice`, `o`.`payment`, `o`.`invoice`, `o`.`status`, `o`.`completed`, `o`.`date`, `c`.`name` FROM `order` AS `o` JOIN `coupon` AS `c` ON `o`.`coupon_id` = `c`.`id` ORDER BY `o`.`date`";
    $res = mysqli_query($link, $query);


    if (mysqli_num_rows($res) > 0) {
        $output .= '
                <table border="1">
                    <tr>
                       <th width="1%">No.</th>
                       <th width="1%">ID</th>
                       <th width="10%">Username</th>
                       <th width="8%">Product ID</th>
                       <th width="8%">Product Name</th>
                       <th width="10%">Quantity</th>
                       <th width="10%">Total</th>
                       <th width="10%">Coupon</th>
                       <th width="10%">Method</th>
                       <th width="10%">Invoice</th>
                       <th width="6%">Status</th>
                       <th width="6%">Completed</th>
                       <th width="6%">Date</th>
                    </tr>';

        while ($row = mysqli_fetch_all($res)) {
            $i = 1;
            foreach ($row as $key => $value) {
                $status = $value[8] == 1 ? 'Approved' : 'Pending';
                $completed = $value[9] == 1 ? 'Shipped' : 'Shipping';
                $output .= '
                            <tr style="text-align: center">
                                <td width="1%">' . $i . '</td>
                                <td width="1%">' . $value[0] . '</td>
                                <td width="10%">' . $value[1] . '</td>
                                <td width="8%">' . str_replace(array('"', '[', ']'), ' ', $value[2]) . '</td>
                                <td width="10%">' . str_replace(array('"', '[', ']'), ' ', $value[3]) . '</td>
                                <td width="10%">' . str_replace(array('"', '[', ']'), ' ', $value[4]) . '</td>
                                <td width="10%">' .number_format(intval( $value[5])) . '</td>
                                <td width="10%">' . $value[11] . '</td>
                                <td width="10%">' . $value[6] . '</td>
                                <td width="10%">' . $value[7] . '</td>
                                <td width="6%">' . $status . '</td>
                                <td width="6%">' . $completed . '</td>
                                <td width="6%">' . $value[10] . '</td>
                            </tr>
                ';
                $i++;
            }

            $output .= '</table>';

            $string = date("YmdHis");

            $year = substr($string, 0, 4);
            $month = substr($string, 4, 2);
            $day = substr($string, 6, 2);
            $hour = substr($string, 8, 2);
            $minute = substr($string, 10, 2);
            $second = substr($string, 12, 2);

            $time = $hour . $minute . $second . '_' . $day . $month . $year;

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename = report_' . $time . '.xls');
            echo $output;
        }
    } else {
        echo 'No data found!';
    }
}
?>