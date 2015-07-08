<?php
require_once( dirname( __FILE__ ) . '/../wp-load.php' );

$cinema = @$_POST['cinema'];
$date = @$_POST['date'];

if ( $cinema=="" && $date=="" )
{
	return;
}

$ss = object_to_array($wpdb->get_results("
	SELECT * FROM `cgv_sessions` WHERE `cinema_id` = \"$cinema\" AND `date` LIKE \"$date\" ORDER BY LENGTH(`room`), `room`, `time`;
"));

$sortedRooms = array();
foreach ( $ss as $s ) {
	$room = explode( " ", $s['room'] );
	$room = @$room[1];

	$sortedRooms[$room][] = array(
		'id'    => $s['id'],
		'time'  => $s['time'],
		'image' => $s['image'],
		'name'  => $s['name'],
		'url'   => $s['url']
	);
}

$upload_dir = wp_upload_dir();
$roomImageDir = $upload_dir['baseurl'].'/cgv/c';

$html = "";
$cinemaCode = 1000 + intval($cinema);

$bookedUrl = "https://www.cgv.vn/vn/booking/ticket/index/cinema/$cinemaCode/session/";
foreach ( $sortedRooms as $k => $r )
{
	$html .= "<div class=\"room\">";
		$html .= "<div class=\"row\"><span>Cinema&nbsp;$k</span></div>";
		$html .= "<div class=\"row\">";
			$html .= "<div class=\"image\"><img src=\"$roomImageDir.$cinema.$k.png\" /></div>";
			$html .= "<div class=\"session\">";
			foreach ($r as $s)
			{
				$html .= "<div class=\"detail\">";
				$id = @$s['id'];
				$time = @$s['time'];
				$name = @$s['name'];
				$image = @$s['image'];

				if (checkAndroidDevice()) {
					$url = "#";
				} else {
					$url = $bookedUrl . "" . str_replace($cinema, "", $id);
				}
				$html .= "<a target=\"_blank\" href=\"$url\">";
					$html .= "<span class=\"time\">$time</span>";
					$html .= "<img class=\"image\" src=\"$image\" />";
					$html .= "<span class=\"title\">$name</span>";
				$html .= "</a>";
				$html .= "</div>";
			}
			$html .= "</div>";
		$html .= "</div>";
	$html .= "</div>";
}
echo $html;