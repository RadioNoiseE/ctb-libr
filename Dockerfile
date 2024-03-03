FROM alpine:latest

RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.tuna.tsinghua.edu.cn/g' /etc/apk/repositories

RUN apk update

RUN apk add --no-cache lighttpd \
    php83 php83-cgi php83-common

COPY lighttpd.conf /etc/lighttpd/lighttpd.conf

RUN mkdir -p /var/www/localhost/htdocs
RUN mkdir /var/www/localhost/htdocs/upload
RUN mkdir /var/www/localhost/htdocs/annotations

RUN echo "cgi.fix_pathinfo = 1" >> /etc/php.ini
RUN echo "file_uploads = On" >> /etc/php.ini
RUN echo "post_max_size = 100M" >> /etc/php.ini

COPY index.html /var/www/localhost/htdocs/index.html
COPY style.css /var/www/localhost/htdocs/style.css

COPY reader-entr.html /var/www/localhost/htdocs/reader-entr.html
COPY librarian-entr.html /var/www/localhost/htdocs/librarian-entr.html

COPY annotate-image.php /var/www/localhost/htdocs/annotate-image.php
COPY save-annotations.php /var/www/localhost/htdocs/save-annotations.php

COPY upload.php /var/www/localhost/htdocs/upload.php

EXPOSE 80

CMD ["lighttpd", "-D", "-f", "/etc/lighttpd/lighttpd.conf"]
