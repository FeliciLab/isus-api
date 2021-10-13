# iSUS API

Projeto destinado a implementar as regras de negócio que envolvem o aplicativo
do iSUS, vai desde a autenticação com o projeto ID Saúde a sincronização de dados
com o Wordpress

# Dependências

- Docker
- PHP 7.4 (FPM)
- Laravel 7

# Instalação

## Servidor de desenvolvimento 🚀🚀

### 1. Clone o projeto na branch develop

```bash
$ git clone https://github.com/EscolaDeSaudePublica/isus-api.git -b develop
```

### 2. Inicialize a infra com o docker

```sh
# Acesse a pasta
$ cd isus-api

# Inicialize os containeres
$ docker-compose up
```

Serão criados 3 containeres:

- **api-isus-web**: nginx
- **api-isus-fpm**: php-fpm onde o código é executado
- **api-isus-db**: Mysql database

### 3. Configurações da API

Faça uma cópia do arquivo .env.example para `.env`.

Altere as configurações no arquivo `.env` de acordo com a necessidade do projeto, como configurações de banco de dados para o isus e o banco de dados do wordpress.

### 4. Instalando dependências

Execute o comando abaixo para instalar as dependencias e executar as *migrations* e os *seeds*

```bash
$ docker exec -it api-isus-fpm composer install 
$ docker exec -it api-isus-fpm php artisan key:generate
$ docker exec -it api-isus-fpm php artisan migrate --seed
```

Libere permissão para as views acessarem os storage

```bash
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```

> Para realizar os testes automatizados será preciso criar o banco de teste e executar a migration para banco de teste

### 4.1. Configurando para testes automatizados

> As configurações abaixo são necessária caso seja desejado não utilizar das mesmas
> configurações usadas nos testes manuais ou de produção/homologação.
> Desta forma, os testes irão ser executados utilizando uma base de dados isolada, já que os testes que utilizam banco, apagam suas alterações a cada teste.

1. Copie o arquivo `.env` para `.env.testing`
2. Altere o banco de dados na variável `DB_DATABASE` para `isus_testing`
3. Crie o banco de dados de teste

```bash
$ docker exec -it api-isus-db mysql -uroot -p12345678 -e "create database isus_testing"
```

### 4.2. Teste

1. Acesse [http://localhost:7000/](http://localhost:7000/) se tudo ocorrer bem irá ter API-ISUS.
2. Execute os testes automatizados

```bash
$ docker exec -it api-isus-fpm php artisan test
```
