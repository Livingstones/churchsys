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
        <td>&nbsp;</td>
        <?php foreach ($member_list as $member) : ?>
            <td><?php echo $member['code']; ?></td>
        <?php endforeach; ?>
    </tr>
    <tr class="tbltitle">
        <td><?php echo $year; ?></td>
        <?php foreach ($member_list as $member) : ?>
            <td><?php echo $member['name']; ?></td>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($weekno_list as $weekno) : ?>
        <tr class="tblcontent">
            <td>
                <?php echo $weekno; ?></td>
            <?php foreach ($member_list as $member) : ?>
                <td><?php echo $data[$weekno][$member['code']]; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>