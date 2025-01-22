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
header('Content-Disposition: attachment;filename="Lang-Message_(' . date('Y-m-d') . ').xls"');
?>
<table cellpadding="0" cellspacing="0" border="1" class="table table-bordered">
    <thead>
        <tr>
            <td colspan="2" align="center">
                <font size="6">Message List</font>
            </td>
        </tr>

        <tr>
            <th>Title</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($language_lines)) {
            foreach ($language_lines as $key => $row) {
        ?>
                <tr class="gradeX odd">
                    <td><?php echo $key; ?></td>
                    <td><?php echo $row; ?></td>
                </tr>
        <?php }
        } ?>
    </tbody>
</table>