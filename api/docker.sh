
# colors
color="\033[33m"
nc="\033[0m"

echo -e "\n==>$color Installation of PHP dependencies$nc"
symfony composer install --no-interaction

echo -e "==>$color Update migrations$nc"
symfony console doctrine:migrations:migrate --no-interaction

echo -e "==>$color Load fixtures$nc"
symfony console doctrine:fixtures:load --no-interaction

echo -e "\n==>$color Start server$nc\n"
symfony server:start --no-tls
