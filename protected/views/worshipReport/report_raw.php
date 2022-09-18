<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<style>
    .shttitle td {
        font-size: 16px;
        font-weight: bold;
    }

    .pcode {
        font-size: 10px;
    }

    .tbltitle td {
        border: 2px solid #000;
        font-weight: bold;
        font-size: 12px;
    }

    .tblcontent td {
        border: 1px solid #000;
        font-weight: normal;
        font-size: 12px;
    }
</style>
<table border=0 cellpadding=0 cellspacing=0 id='tblMain'>
    <tr class="subtitle">
        <?php foreach ($title as $t) : ?>
            <td><?php echo $t; ?></td>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($data as $row) : ?>
        <tr class="tblcontent">
            <td><?php echo $row['code']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['weekno']; ?></td>
            <td><?php echo $row['attendance_date']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>