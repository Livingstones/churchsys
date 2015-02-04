<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
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
	font-weight: none;
	font-size: 12px;
}
</style>
<table border=0 cellpadding=0 cellspacing=0 id='tblMain'>
	<tr class="shttitle">
		<td colspan="4">
			<?php $target = strtotime($year . "-01-01") + (60*60*24*7*($week)); ?>
			新增新朋友列表 (<?php echo date("Y-m-d", $target-(60*60*24*(date("N", $target)-1))); ?> - <?php echo date("Y-m-d", $target+(60*60*24*(7-date("N", $target)))); ?>)
		</td>
		<td align="right" class="pcode">R1002</td>
	</tr>
	<tr class="tbltitle">
		<td>
			到達日期</td>
		<td>
			會員編號</td>
		<td>
			崇拜</td>
		<td>
			姓名</td>
		<td>
			備註</td>
	</tr>
<?php if (count($data) > 0) : ?>
<?php foreach ($data as $member) : ?>
	<tr class="tblcontent">
		<td>
			<?php echo date("Y-m-d", strtotime($member["arrived_date"])); ?></td>
		<td>
			<?php echo $member["member_code"]; ?></td>
		<td>
			<?php echo $member["worship"]; ?></td>
		<td>
			<?php echo $member["name"]; ?></td>
		<td>
			<?php echo $member["remarks"]; ?></td>
	</tr>
<?php endforeach; ?>
<?php endif; ?>
</table>