<?php
	session_start();

	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;

	require __DIR__.'/conf.php';

	$shopify = shopify\client($_SESSION['shop'], SHOPIFY_APP_API_KEY, $_SESSION['oauth_token']);

	try
	{
		# Making an API request can throw an exception
		$product = $shopify('POST /admin/products.json', array(), array
		(
			'product' => array
			(
				"title" => "Burton Custom Freestlye 151",
				"body_html" => "<strong>Good snowboard!</strong>",
				"vendor" => "Burton",
				"product_type" => "Snowboard",
				"variants" => array
				(
					array
					(
						"option1" => "First",
						"price" => "10.00",
						"sku" => 123,
					),
					array (
						"option1" => "Second",
						"price" => "20.00",
						"sku" => "123"
					)
				)
			)
		));

		print_r($product);
	}
	catch (shopify\ApiException $e)
	{
		# HTTP status code was >= 400 or response contained the key 'errors'
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
	catch (shopify\CurlException $e)
	{
		# cURL error
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
