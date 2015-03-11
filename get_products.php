<?php 
	session_start();

	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;

	require __DIR__.'/conf.php';

	$shopify = shopify\client($_SESSION['shop'], SHOPIFY_APP_API_KEY, $_SESSION['oauth_token']);

	try
	{
		# Making an API request can throw an exception
		$products = $shopify('GET /admin/products.json', array('published_status'=>'published'));
		print_r($products);
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
