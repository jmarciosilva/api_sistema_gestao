# Api Sistema de Gestão
## Requisitos

* PHP 8.2 ou superior
* MySql 8 ou superior
* Composer 2.0 ou superior

### Ambiente Docker PHP, Apache, MySql e PHP MyAdmin
### Como Gerar ambiente de desenvolvimento com PHP, MySql, Apache, Composer e PHP MyAdmin

Criar uma pasta com direitos administrativos (root ou similar)
- Dentro desta pasta criar o arquivo de configuração Dockerfile para configurar o PHP
### Arquido Dockerfile
```
  # Use a imagem base do PHP com Apache
  FROM php:8.2-apache
  
  # Instala dependências necessárias
  RUN apt-get update && apt-get install -y \
      libpng-dev \
      libjpeg-dev \
      libfreetype6-dev \
      zip \
      unzip \
      && docker-php-ext-configure gd --with-freetype --with-jpeg \
      && docker-php-ext-install gd \
      && docker-php-ext-install pdo pdo_mysql \
      && apt-get install -y curl git \
      && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
  
  # Ajuste as permissões da pasta html
  RUN chown -R www-data:www-data /var/www/html \
      && chmod -R 777 /var/www/html
  
  
  # Exponha a porta 8080
  EXPOSE 8080 # a porta do apache foi configurada para http://localhost:8080
  
  # Inicie o servidor Apache
  CMD ["apache2-foreground"]
```
### Criar o arquivo docker-compose.yml
```
version: '3.9'

services:
  # Serviço PHP
  php:
    build:
      context: .  # Diretório onde está o Dockerfile
      dockerfile: Dockerfile  # Nome do Dockerfile
    container_name: php-container_8_2 # nesta linha você define o nome do container PHP
    ports:
      - "8080:80" # a porta do apache foi configurada para http://localhost:8080
    volumes:
      - ./www:/var/www/html
    depends_on:
      - db
    environment:
      COMPOSER_ALLOW_SUPERUSER: 1

  # Serviço MySQL
  db:
    image: mysql:8.0
    container_name: mysql_8_0-container # nesta linha você define o nome do container MySQL
    environment:
      MYSQL_ROOT_PASSWORD: 12345678 # defina sua senha
      MYSQL_DATABASE: my_database # defina seu nome de banco de dados
      MYSQL_USER: user # usuario criado la no arquivo docker-compose.yml
      MYSQL_PASSWORD: 12345678 # defina a senha
    ports:
      - "3406:3306" # a porta do mySql no lado da máquina host (sua máquina ficou com 3406 - esta configuração foi feita pois já tenho mySql instalado na minha máquina
    volumes:
      - db_data:/var/lib/mysql

  # Serviço phpMyAdmin
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: phpmyadmin-container_8_2 # nesta linha você define o nome do container phpMyAdmin
    depends_on:
      - db
    environment:
      PMA_HOST: db
      MYSQL_ROOT_PASSWORD: 12345678 # sua senha definida
    ports:
      - "8081:80" 

# Definição dos volumes
volumes:
  db_data:
```


### Como criar os containers Docker do projeto

Após criar os arquivos Dockerfile e docker-compose executar o comando :
```
docker compose up --build -d
```

Depois verifique se os containers foram criados e estão UP
```
docker ps 
```
### Criando o projeto Laravel dentro do container

Agora precisa entrar dentro do container que está instalado o PHP e o Apache

```
docker exec -it php-container_8_2 /bin/bash
```
Dentro do container volte uma pasta atrás:

```
cd ..
```

agora vc esta na pasta /var/www portanto de permissão total na pasta html

```
chmod 777 -R /var/www/html
```
Volte para a pasta html 

```
cd html
```
Dentro da pasta /var/www/html execute o comando para criar o projeto Laravel

```
composer create-project laravel/laravel .
```

Após o Laravel baixar todas as dependências e os seus arquivos 

Dentro do container volte uma pasta atrás:

```
cd ..
```

agora vc esta na pasta /var/www portanto de permissão total na pasta html

```
chmod 777 -R /var/www/html
```

Sair do container 

```
exit
```
### configurar arquivo .env para se conectar com o banco de dados

Abra o visual studio code ou a sua ide preferida para configurar o arquivo .env do projeto

Seu Arquivo .env deve estar com a configuracao de mysql
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=gestao
DB_USERNAME=root
DB_PASSWORD=marcio1015
```

Feito essas configurações no arquivo .env volte ao prompt de comando

### Rodando as migrations 

Agora precisa entrar dentro do container que está instalado o PHP e o Apache

```
docker exec -it php-container_8_2
```
Dentro do container rode as migrations 

```
php artisan migrate  
```

### Testando no navegador

Após isso abra seu navegador o laravel estará no endereço http://localhost:8080/public/

O phpMyAdmin estará no endereço http://localhost:8081

### Instalando rotas para API

No prompt de comando você precisa entrar no container

```
docker exec -it php-container_8_2
```
Dentro do container rode o comando 

```
php artisan install:api  
```



