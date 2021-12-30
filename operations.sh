#!/bin/bash


COUNTER=1

function f_download_backup(){

    URL=$1

    if [ ! -d site_backup ]
    then
        mkdir site_backup
    fi

    if [[ `wget -S --spider "$URL"  2>&1 | grep 'HTTP/1.1 200 OK'` ]]
    then
        wget -cP ./site_backup -c "$URL"
    fi

    while true
    do
        if [[ `wget -S --spider "$URL.$COUNTER"  2>&1 | grep 'HTTP/1.1 200 OK'` ]]
        then 
            echo "    file exists"
            wget -P ./site_backup -c "$URL.$COUNTER"
        else
            echo "    all files have already been downloaded."
            break
        fi
        
        ((COUNTER=COUNTER+1))
    done
}

function f_unpack_backup(){
    
    echo "    unpacking."

    if [ ! -d ./htdocs ]
    then
        mkdir ./htdocs
        cat *$(ls -v site_backup/*tar.*) | tar zxf - -C ./htdocs
    else
        echo "    directory './htdocs' is exists. unpacking have been skipped."
    fi
    
    
}

function f_create_log_dirs(){
    mkdir -p system/php
    mkdir -p system/nginx
    mkdir -p system/mysql

    ls -l ./system
}

function f_recreate_log_dirs(){
    rm -R ./system
    f_create_log_dirs
}

