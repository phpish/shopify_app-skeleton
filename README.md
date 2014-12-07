1. Clone the repo and get dependencies via composer

	```
	git clone --depth 1 --branch master https://github.com/phpish/shopify_app-skeleton.git new_prj
	cd new_prj
	rm -rf .git
	rm README.md
	curl -sS https://getcomposer.org/installer | php
	php composer.phar install
	```

2. [Create your app](http://docs.shopify.com/api/introduction/getting-started#create-app). Use http://path-to-new_prj/oauth.php as the Callback URL
3. [Get the app's credentials](http://docs.shopify.com/api/authentication/oauth#get-the-client-redentials) and update conf.php
4. Intall the app on a store by visiting http://path-to-new_prj/install.php?shop=example-shop.myshopify.com
5. An OAuth token for the shop should now be stored in the session. Check out the other .php files and see how they work.