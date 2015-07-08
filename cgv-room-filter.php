<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

require_once getcwd().'/wp-load.php';

global $wpdb;

//function object_to_array($obj) {
//	if(is_object($obj)) $obj = (array) $obj;
//	if(is_array($obj)) {
//		$new = array();
//		foreach($obj as $key => $val) {
//			$new[$key] = object_to_array($val);
//		}
//	}
//	else $new = $obj;
//	return $new;
//}

function isJson( $string )
{
	json_decode($string);
	return (json_last_error() == JSON_ERROR_NONE);
}

function getFirstVal( $array )
{
	if ( !sizeof( $array ) ) return null;

	foreach ( $array as $e )
	{
		return $e;
	}
}

function getFirstKey( $array )
{
	if ( !sizeof( $array ) ) return null;

	foreach ( $array as $key => $e )
	{
		return $key;
	}
}

function getData( $wpdb, $sf, &$id, &$early, &$meridiem, &$room, $date, $name, $cinema_id )
{
	$url = $sf['url'];
	$image = $sf['image'];
	foreach ( $sf['session'] as $name => $ss )
	{
		foreach ( $ss as $key => $tmp)
		{
			$time = $key;
			if ( $tmp['id'] ) $id = $tmp['id'];
			if ( $tmp['early'] ) $early = 1;
			if ( $tmp['meridiem'] ) $meridiem = $tmp['meridiem'];
			if ( $tmp['room'] ) $room = $tmp['room'];
			if ( $tmp['theater'] ) $theater = $tmp['theater'];

			// id, early, meridiem, room, theater, time, date, name, url, image, cinema_id
			$wpdb->query("
			INSERT INTO `cgv_sessions` (`id`, `early`, `meridiem`, `room`, `theater`, `time`, `date`, `name`, `url`, `image`, `cinema_id`)
			VALUES ('$id', '$early', '$meridiem', '$room', '$theater', '$time', '$date', '$name', '$url', '$image', '$cinema_id')
			ON DUPLICATE KEY
			UPDATE `early`='$early', `meridiem`='$meridiem', `room`='$room', `theater`='$theater', `time`='$time', `date`='$date', `name`='$name', `url`='$url', `image`='$image', `cinema_id`='$cinema_id';
		");
		}
	}

	return;
}

$cinemas = $wpdb->get_results("SELECT * FROM cgv_cinemas");

if ( sizeof( $cinemas ) )
{
	$ajaxview = "https://www.cgv.vn/vn/theaters/cinema/ajaxview/id/";
	$curl = curl_init();
	foreach ( $cinemas as $c )
	{
		$url = $ajaxview . $c->id;
		curl_setopt_array( $curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
	    		CURLOPT_PROXY => "42.117.1.79",
	    		CURLOPT_PROXYPORT => "3128"
		));

		$resp = curl_exec( $curl );
		if (FALSE === $resp):
        		throw new Exception(curl_error($curl), curl_errno($curl));
        	endif;
		if ( !isJson($resp) )
		{
			continue;
		}
		$resp = json_decode( $resp );
		$sessions = object_to_array( $resp->session );

		if ( !sizeof( $sessions ) ) continue;

		// clear all old sessions
		$wpdb->query("TRUNCATE TABLE `cgv_sessions`;");

		foreach ( $sessions as $date => $s )
		{
			foreach ( $s as $name => $sf )
			{
				// $name, $date
				$id = $meridiem = $room = $theater = $time = $url = $image = "";
				$cinema_id = $c->id;
				$early = 0;

				getData( $wpdb, $sf, $id, $early, $meridiem, $room, $date, $name, $cinema_id );

				$tmp = explode(" ", $room);
				$roomImage = "c.".$cinema_id.".".$tmp[1];
				$wpdb->query("
					INSERT INTO `cgv_rooms` (`image`, `name`, `cinema_id`)
						VALUES ('$roomImage', '$room', '$cinema_id')
						ON DUPLICATE KEY
						UPDATE `name`='$room', `cinema_id`='$cinema_id';
				");
			}
		}
	}
	curl_close( $curl );
}

exit('done');
