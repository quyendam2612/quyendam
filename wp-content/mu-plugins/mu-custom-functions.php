<?php
/**
 * Plugin Name: CGV Vietnam - Room Filter
 * Plugin URI: http://quyendam.com
 * Description: This plugin will help you go through all CGV sessions filtered by room.
 * Author: Quyen Dam
 * Author URI: http://quyendam.com
 * Version: 0.1.0
 */

/* Place custom code below this line. */

function object_to_array($obj) {
	if(is_object($obj)) $obj = (array) $obj;
	if(is_array($obj)) {
		$new = array();
		foreach($obj as $key => $val) {
			$new[$key] = object_to_array($val);
		}
	}
	else $new = $obj;
	return $new;
}

function getCinemas()
{
	global $wpdb;
	$cities = object_to_array($wpdb->get_results("
		SELECT DISTINCT city from `cgv_cinemas` ORDER BY `id`;
	"));
	$html = "<select id=\"cinema\">";
	$html .= "<option value=\"0\">Hãy chọn rạp</option>";
	foreach ($cities as $city)
	{
		$city = $city['city'];
		$html .= "<optgroup label=\"$city\">";

		$cinemas = object_to_array($wpdb->get_results("
			SELECT name, id from `cgv_cinemas` WHERE `city`=\"$city\" ORDER BY `id`
		"));
		foreach ($cinemas as $cinema)
		{
			$id = $cinema['id'];
			$name = $cinema['name'];
			$html .= "<option value=\"$id\">$name</option>";
		}

		$html .= "</optgroup>";
	}
	$html .= "</select>";
	return $html;
}

function getDates()
{
	global $wpdb;

	$dates = object_to_array($wpdb->get_results("
		SELECT DISTINCT `date` from `cgv_sessions` ORDER BY `date`;
	"));

	$html = "<select id=\"date\">";
	$html .= "<option value=\"0\">Hãy chọn ngày</option>";
	foreach ($dates as $date)
	{
		$date = $date['date'];
		$html .= "<option value=\"$date\">$date</option>";
	}
	$html .= "</select>";
	return $html;
}

function checkAndroidDevice() {
	if($_SERVER['HTTP_X_REQUESTED_WITH']=="com.quyendam.cgvvnroomfilter") return true;
	return false;
}

//add_action('wp_ajax_ACTION_NAME', 'my_AJAX_processing_function');

/* Place custom code above this line. */