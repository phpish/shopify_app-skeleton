<?php

	session_start();

	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;

	require __DIR__.'/conf.php';

	# Guard: http://docs.shopify.com/api/authentication/oauth#verification
	shopify\is_valid_request($_GET, SHOPIFY_APP_SHARED_SECRET) or die('Invalid Request! Request or redirect did not come from Shopify');


	# Step 2: http://docs.shopify.com/api/authentication/oauth#asking-for-permission
	if (!isset($_GET['code']))
	{
		$permission_url = shopify\authorization_url($_GET['shop'], SHOPIFY_APP_API_KEY, array('read_content', 'write_content', 'read_themes', 'write_themes', 'read_products', 'write_products', 'read_customers', 'write_customers', 'read_orders', 'write_orders', 'read_script_tags', 'write_script_tags', 'read_fulfillments', 'write_fulfillments', 'read_shipping', 'write_shipping'));
		die("<script> top.location.href='$permission_url'</script>");
	}


	# Step 3: http://docs.shopify.com/api/authentication/oauth#confirming-installation
	try
	{
		# shopify\access_token can throw an exception
		$oauth_token = shopify\access_token($_GET['shop'], SHOPIFY_APP_API_KEY, SHOPIFY_APP_SHARED_SECRET, $_GET['code']);

		$_SESSION['oauth_token'] = $oauth_token;
		$_SESSION['shop'] = $_GET['shop'];

		echo 'App Successfully Installed!';
	}
	catch (shopify\ApiException $e)
	{
		# HTTP status code was >= 400 or response contained the key 'errors'
		echo $e;
		print_R($e->getRequest());
		print_R($e->getResponse());
	}
	catch (shopify\CurlException $e)
	{
		# cURL error
		echo $e;
		print_R($e->getRequest());
		print_R($e->getResponse());
	}


?>