FROM ubuntu:latest
#se anyade usuario y contrasenya
RUN useradd -d /home/jesus jesus
RUN echo "jesus:jesus" | chpasswd
#se actualiza el sistema
RUN apt-get update
RUN apt update && apt install -y apache2 php redis php-redis openssh-server 
#se exponen los puertos 80 y 22
EXPOSE 80
EXPOSE 22
#al arrancar el contenedor se arranca el servico
CMD service apache2 start && service redis-server start && bash