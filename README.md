```
git clone --depth 1 --branch master https://github.com/phpish/shopify-skeleton.git new_prj
cd new_prj
rm -rf .git
rm README.md
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```