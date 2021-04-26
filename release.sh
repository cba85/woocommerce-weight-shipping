cd ~/Desktop 

name=woocommerce-weight-shipping
url="https://github.com/cba85/$name"

git clone "$url.git"

cd "$name"

composer install --no-dev
rm -rf release.sh
rm -rf composer.lock

cd ..

zip -r "$name.zip" "$name"

rm -rf "$name"
