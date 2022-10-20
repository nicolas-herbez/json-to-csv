
# colors
color="\033[33m"
nc="\033[0m"

clear
echo "\n==> You wish :" \
    "\n$color [1]$nc Run PHP_CodeSniffer" \
    "\n$color [2]$nc Run PHPStan" \
    "\n$color [3]$nc Run tests" \
    "\n$color [4]$nc Run coverage test" \
    "\n$color [ ]$nc Use the docker terminal"

read -p "Choose a number [ ] : " response

clear
# api
if [ -n $0 ] && [ "$response" = 1 ]; then
    ./vendor/bin/phpcs -v --standard=PSR12 --ignore=./src/Kernel.php ./src
elif [ -n $0 ] && [ "$response" = 2 ]; then
    ./vendor/bin/phpstan analyse ./src
elif [ -n $0 ] && [ "$response" = 3 ]; then
    php bin/phpunit --testdox
elif [ -n $0 ] && [ "$response" = 4 ]; then
    php bin/phpunit --coverage-html var/log/test/test-coverage
    echo "\n==> You can see the result with$color /api/var/log/test/test-coverage/index.html$nc"
else
    bash
fi

# read
