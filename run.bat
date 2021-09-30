cd ..\nginx-1.15.12
start nginx
tasklist /fi "imagename eq nginx.exe"
php-cgi -b 127.0.0.1:9000