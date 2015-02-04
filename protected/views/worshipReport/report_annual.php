
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
			全年崇拜出席數據列表 (<?php echo $year; ?>)
		</td>
		<td align="right" class="pcode">R1006</td>
	</tr>
	<tr class="tbltitle">
		<td>
			日期</td>
<?php foreach ($worship_list as $worship) : ?>
		<td>
			<?php echo $worship["name"]; ?></td>
<?php endforeach; ?>
		<td>
			總次數</td>
		<td>
			總人數</td>
		<td>
			新朋友</td>
		<td>
			備註</td>
	</tr>
<?php foreach ($data as $key => $stat) : ?>
	<tr class="tblcontent">
		<td>
			<?php echo $stat["d"]; ?></td>
<?php foreach ($worship_list as $worship) : ?>
		<td>
			<?php $t = 'w' . $worship["id"]; ?>
			<?php echo $stat[$t]; ?></td>
<?php endforeach; ?>
		<td>
			<?php echo $stat["total"]; ?></td>
		<td>
			<?php echo $stat["total_p"]; ?></td>
		<td>
			<?php echo $stat["new_member_count"]; ?></td>
		<td>
			<?php echo $stat["remarks"]; ?></td>
	</tr>
<?php endforeach; ?>
</table>