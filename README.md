API para prover os dados do Wordpress

# Servidor de desenvolvimento 🚀🚀

Clonando o projeto

```
git clone https://github.com/EscolaDeSaudePublica/isus-api.git
```


Entrar o diretório

```
cd isus-api
```

Em seguida executar o comando

```
docker-compose up
```

Ao executar o comando acima, será criado 3 containers
- anticorona-corcel-php-fpm
- isusapi_db_1
- anticorona-corcel-webserver

Acessar o container 'cearacoronaapi_php-fpm'
```
docker exec -it cearacoronaapi_php-fpm bash
```

Dentro do container acessar o diretório o /application
```
cd /application
```

Instalar dependência do Laravel
```
composer install
```

Configurar os parametros no arquivo .env (banco [WP_*], token) https://laravel.com/docs/7.x#configuration

```
cp .env.example .env
```

Gerar Application Key
```
php artisan key:generate
```

O banco será criado vazio, nesse caso é necessário solicitar o backup do banco ao responsável pela aplicação

Em seguida com backup, simplismente realizar o backup

Em seguida acessar http://localhost:7000/api/categorias
```json
    {
        "categoria": {
          "term_id": 5,
          "name": "Vídeos",
          "slug": "videos",
          "term_group": 0,
          "subcategorias": [
            {
              "term_id": 206,
              "name": "Pronunciamentos",
              "slug": "pronunciamentos",
              "term_group": 0
            }
          ]
        }
    },
```
