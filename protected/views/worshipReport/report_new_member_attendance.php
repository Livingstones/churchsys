
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<style>
.shttitle td {
	font-size: 16px;
	font-weight: bold;
}

.pcode {
	font-size: 12px;
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
<table border=1 cellpadding=0 cellspacing=0 id='tblMain'>
	<tr class="shttitle">
		<td colspan="9" style="font-size: 14px;">
			<?php $target = strtotime($year . "-01-01") + (60*60*24*7*($week)); ?>
			臨時會友崇拜出席紀錄 (<?php echo date("Y-m-d", $target-(60*60*24*(date("N", $target)-1))); ?> - <?php echo date("Y-m-d", $target+(60*60*24*(7-date("N", $target)))); ?>)
		</td>
		<td align="right" class="pcode">R1002</td>
	</tr>
	<tr class="tbltitle">
		<td style="font-size: 14px;">
			崇拜</td>
		<td style="font-size: 14px;">
			會友編號</td>
		<td style="font-size: 14px;">
			簽到次數</td>
		<td style="font-size: 14px;">
			姓名</td>
		<td style="font-size: 14px;">*</td>
<?php foreach ($worship_list as $worship) : ?>
		<td style="font-size: 14px;">
			<?php echo $worship['name']; ?></td>
<?php endforeach; ?>
	</tr>
<?php if (count($data) > 0) : ?>
<?php foreach ($data as $member) : ?>
<?php 
	$bgcolor = "none";
	if ($member["is_new"]) $bgcolor= "green"; 
	elseif ($member["has_new_card"]) $bgcolor= "red"; 
	elseif ($member["need_form"]) $bgcolor= "yellow"; 
?>
	<tr class="tblcontent">
		<td style="font-size: 14px;">
			<?php echo $member["worship"]; ?></td>
		<td style="font-size: 14px;">
			<?php echo $member["member_code"]; ?></td>
		<td style="font-size: 14px;">
			<?php echo $member["sign_in_counts"]; ?></td>
		<td style="font-size: 14px;">
			<?php echo $member["name"]; ?></td>
		<td style='font-size:14px;background-color:<?php echo $bgcolor; ?>;'>
			<?php 
				if ($member["is_new"]) echo "N"; 
				elseif ($member["has_new_card"]) echo "C";
				elseif ($member["need_form"]) echo "F"; 
				else echo "&nbsp;";
			?>
		</td>
<?php foreach ($worship_list as $worship) : ?>
		<td<?php if ($member["has_new_card"] || $member["need_form"]) echo " style='font-size:14px;background-color:" . $bgcolor . ";'"; ?>>&nbsp;</td>
<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
<?php endif; ?>
</table>