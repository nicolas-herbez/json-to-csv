
# colors
color="\033[33m"
nc="\033[0m"

echo -e "\n==>$color Installation of JS dependencies$nc"
npm i --force

echo -e "\n==>$color Start server$nc\n"
node script
