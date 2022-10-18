
# colors
color="\033[33m"
nc="\033[0m"

clear
echo "\n==> You wish :" \
    "\n$color [1]$nc Run PHP_CodeSniffer" \
    "\n$color [2]$nc Run PHPStan" \
    "\n$color [ ]$nc Use the docker terminal"

read -p "Choose a number [ ] : " response

clear
# api
if [ -n $0 ] && [ "$response" = 1 ]; then
    ./vendor/bin/phpcs -v --standard=PSR12 --ignore=./src/Kernel.php ./src
elif [ -n $0 ] && [ "$response" = 2 ]; then
    ./vendor/bin/phpstan analyse ./src
else
    bash
fi

# read
