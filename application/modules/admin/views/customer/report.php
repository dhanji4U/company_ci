<?php
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
//header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
//header("Content-Type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Type: application/download");
// header("Content-Disposition: attachment; filename=".date('Y-m-d')."_Customer_list.xls");
header('Content-Disposition: attachment;filename="Customer-Report_(' . date('Y-m-d') . ').xls"');
?>
<table cellpadding="0" cellspacing="0" border="1" class="table table-bordered">
    <thead>
        <tr>
            <td colspan="11" align="center">
                <font size="6">Customer List</font>
            </td>
        </tr>

        <tr>
            <th>Sr. No.</th>
            <th>Unique ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Language</th>
            <th>License Plate Number</th>
            <th>Local Resident Status</th>
            <th>Last Login</th>
            <th>Login Status</th>
            <th>Created Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($data_list)) {
            foreach ($data_list as $key => $row) {
        ?>
                <tr class="gradeX odd">
                    <td><strong><?php echo $key + 1; ?></strong></td>
                    <td><?php echo $row['unique_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['language']; ?></td>
                    <td><?php echo $row['license_plate_number']; ?></td>
                    <td><?php echo $row['local_resident_status']; ?></td>
                    <td><?php echo $row['last_login'] == '0000-00-00 00:00:00' ? '' : $this->common_model->dateConvertToTimezone($row['last_login'], ADMIN_LONGDATE, $this->session->userdata(ADMIN_TIMEZONE)); ?></td>
                    <td><?php echo $row['login_status']; ?></td>
                    <td><?php echo $row['is_active'] == '0' ? 'Blocked' : 'Unblocked'; ?></td>
                    <td><?php echo $this->common_model->dateConvertToTimezone($row['insert_datetime'], ADMIN_LONGDATE, $this->session->userdata(ADMIN_TIMEZONE)); ?></td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>