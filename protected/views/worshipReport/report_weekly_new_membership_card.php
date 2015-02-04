
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
			以下肢體 “個人名牌”已備妥 (<?php echo date("Y-m-d", $target-(60*60*24*(date("N", $target)-1))); ?> - <?php echo date("Y-m-d", $target+(60*60*24*(7-date("N", $target)))); ?>)
		</td>
		<td align="right" class="pcode">R1001</td>
	</tr>
	<tr class="tbltitle">
		<td>
			時段</td>
		<td>
			小組</td>
		<td>
			會友編號</td>
		<td>
			姓名</td>
		<td>
			相片編號</td>
	</tr>
<?php if (count($data) > 0) : ?>
<?php foreach ($data as $member) : ?>
	<tr class="tblcontent">
		<td>
			<?php echo ($member["period"] == "" ? '未入組' : $member["period"]); ?></td>
		<td>
			<?php echo ($member["small_group"] == "" ? '未入組' : $member["small_group"]); ?></td>
		<td>
			<?php echo $member["member_code"]; ?></td>
		<td>
			<?php echo $member["name"]; ?></td>
		<td>&nbsp;</td>
	</tr>
<?php endforeach; ?>
<?php endif; ?>
</table>