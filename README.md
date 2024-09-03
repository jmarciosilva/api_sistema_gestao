# Api Sistema de Gestão para conectar Aplicativo React Native

## Requisitos

* PHP 8.2 ou superior
* MySql 8 ou superior
* Composer 2.0 ou superior

### Como criar os containers Docker do projeto

Após baixar esse repositório executar o comando :
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
docker exec -it php-container_8_2
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

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=gestao
DB_USERNAME=root
DB_PASSWORD=marcio1015

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



