#!/bin/bash
#title           :test.sh
#description     :This script will configure your PHP-Cli correctly in MacOSX
#author          :camille.cimbolini@b-citi.com
#date            :20170710
#version         :0.1
#usage           :./test.sh

php_used="$(which php)";
php_version="$1";

if [ -z $1 ]; 
then 
    echo "You must specify your php version in parameters";
    exit;
fi

mamp_php_path="/Applications/MAMP/bin/php/php$php_version/bin/";
if [[ ! -d $mamp_php_path ]];
then
    echo "MAMP PHP folder not found : $mamp_php_path";
    exit;
fi

if [[ $php_used == "$mamp_php_path"/php ]];
then
    echo 'PHP-Cli is already conrectly configured';
else
    if [[ -f $HOME/.zshrc ]];
    then
        profile="$HOME/.zshrc";
    else
        profile="$HOME/.bash_profile";
    fi
    
    echo "# Add PHP to PATH for Composer" >> $profile;
    echo "export PATH=\"$mamp_php_path:\$PATH\"" >> $profile;

    echo "PHP-Cli have been configured in $profile file";
fi
