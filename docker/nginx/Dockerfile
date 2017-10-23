FROM nginx

ADD nginx.conf /etc/nginx/nginx.conf
ADD file.html /file.html
RUN chmod 777 /file.html
VOLUME /var/log/nginx
