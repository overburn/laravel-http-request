<?php

namespace Overburn\HttpRequest;


class HttpRequest {

	public static function get($url, $params = []) {
		$ch = curl_init();

		if(count($params) > 0) {
			$url .= "?".http_build_query($params);
		}

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output = curl_exec($ch);

		curl_close($ch);

		return $output;
	}

	public static function post($url, $params = [], $files = []) {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_POST, 1);

		if(count($files)) {
			array_walk($files, function($file) {
				$file = "@".$file;
			});
			
			$params = array_merge($params, $files);
		}

		if(count($params) > 0) {			
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		}

		curl_setopt($ch, CURLOPT_URL, $url);

		$output = curl_exec($ch);

		curl_close($ch);

		return $output;
	}

	
}
