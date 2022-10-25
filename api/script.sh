
# colors
color="\033[33m"
nc="\033[0m"

installTestDb() {
    APP_ENV=test symfony console doctrine:database:drop --if-exists --force --no-interaction
    APP_ENV=test symfony console doctrine:database:create --no-interaction
    APP_ENV=test symfony console doctrine:migrations:migrate --no-interaction
    APP_ENV=test symfony console doctrine:fixtures:load --no-interaction
}

clear
while :; do
    echo "\n==> You wish :" \
        "\n$color [0]$nc Use the docker terminal" \
        "\n$color [1]$nc Run PHP_CodeSniffer" \
        "\n$color [2]$nc Run PHPStan" \
        "\n$color [3]$nc Run tests" \
        "\n$color [4]$nc Run coverage test"

    read -p "Choose a number [ ] : " response

    if [ -n $0 ] && [ "$response" = 0 ]; then
        clear
        bash
        break

    elif [ -n $0 ] && [ "$response" = 1 ]; then
        clear
        echo "==>$color Run PHP_CodeSniffer$nc\n"
        ./vendor/bin/phpcs -v --standard=PSR12 --ignore=./src/Kernel.php ./src

    elif [ -n $0 ] && [ "$response" = 2 ]; then
        clear
        echo "==>$color Run PHPStan$nc\n"
        ./vendor/bin/phpstan analyse ./src

    elif [ -n $0 ] && [ "$response" = 3 ]; then
        clear
        echo "==>$color Run tests$nc\n"
        installTestDb
        echo "\n"
        php bin/phpunit --testsuite ordered --testdox

    elif [ -n $0 ] && [ "$response" = 4 ]; then
        clear
        echo "==>$color Run coverage test$nc\n"
        installTestDb
        echo "\n"
        php bin/phpunit --testsuite ordered --coverage-html var/log/test/test-coverage
        echo "\n==> You can see the result with$color /api/var/log/test/test-coverage/index.html$nc"

    else
        echo "\n==>$color Thanks see you soon ;)$nc\n"
        break
    fi

done
