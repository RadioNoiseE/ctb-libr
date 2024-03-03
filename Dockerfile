FROM alpine:latest

RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.tuna.tsinghua.edu.cn/g' /etc/apk/repositories

RUN apk update

RUN apk add --no-cache lighttpd \
    php7-common php7-iconv php7-json php7-gd php7-curl \ 
    php7-xml php7-mysqli php7-imap php7-cgi fcgi \
    php7-pdo php7-pdo_mysql php7-soap php7-xmlrpc php7-posix \
    php7-mcrypt php7-gettext php7-ldap php7-ctype php7-dom

COPY lighttpd.conf /etc/lighttpd/lighttpd.conf

RUN mkdir -p /var/www/localhost/htdocs
RUN mkdir /var/www/localhost/htdocs/upload
RUN mkdir /var/www/localhost/htdocs/annotations

COPY index.html /var/www/localhost/htdocs/index.html
COPY style.css /var/www/localhost/htdocs/style.css

COPY reader-entr.html /var/www/localhost/htdocs/reader-entr.html
COPY librarian-entr.html /var/www/localhost/htdocs/librarian-entr.html

COPY annotate-image.php /var/www/localhost/htdocs/annotate-image.php
COPY save-annotations.php /var/www/localhost/htdocs/save-annotations.php

COPY upload.php /var/www/localhost/htdocs/upload.php

EXPOSE 80

CMD ["lighttpd", "-D", "-f", "/etc/lighttpd/lighttpd.conf"]
