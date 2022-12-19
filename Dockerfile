FROM ubuntu:latest
ARG DEBIAN_FRONTEND=noninteractive
#se anyade usuario y contrasenya
RUN useradd -d /home/jesus jesus
RUN echo "jesus:jesus" | chpasswd
#se actualiza el sistema
RUN apt update
#instalamos los programas que necesitan
RUN apt install -y apache2 
RUN apt install -y php
RUN apt install -y redis 
RUN apt install -y php-redis
RUN apt install -y openssh-server
#se exponen los puertos 80 y 22
EXPOSE 80
EXPOSE 22
#al arrancar el contenedor se arranca el servico
CMD service ssh start && \
service apache2 start && \
service redis-server start && \
bash