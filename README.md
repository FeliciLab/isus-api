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

# Mapeamento dos endpoints
Endpoint: http://localhost:7000/api/categorias
```javascript
    {
        "categoria": { 
          "term_id": 5, // id da categoria
          "name": "Vídeos", // nome da categoria
          "slug": "videos", // slug subcategoria
          "term_group": 0, // termos
          "subcategorias": [ // subcategoria
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

Endpoint: http://localhost:7000/api/projetosPorCategoria/[ID DA CATEGORIA]
```javascript
    {
        "id": 1908,
        "data": "2020-03-24T16:35:01.000000Z",
        "post_title": "Fluxo de Atendimento às Gestantes com suspeita de Covid-19",
        "slug": "fluxos-de-atendimento-as-gestantes-com-suspeita-de-covid-19",
        "content": "Confira o fluxo de atendimento às gestantes com suspeita de infecção pelo Coronavírus (Covid-19) nas Unidades de Atenção Primária à Saúde (UAPS) e em maternidades.\r\n\r\n<img class=\"aligncenter wp-image-1914 size-full\" src=\"https://coronavirus.ceara.gov.br/wp-content/uploads/2020/03/covid19_espce_Fluxo-de-Atendimento-à-Gestantes-parte-1.jpeg\" alt=\"\" width=\"905\" height=\"1280\" />\r\n\r\n<img class=\"alignnone wp-image-1915 size-full\" src=\"https://coronavirus.ceara.gov.br/wp-content/uploads/2020/03/covid19_espce_Fluxo-de-Atendimento-à-Gestantes-parte-2.jpeg\" alt=\"\" width=\"1280\" height=\"720\" />\r\n\r\nPrefere baixar o pdf? Clique <a href=\"https://coronavirus.ceara.gov.br/wp-content/uploads/2020/03/covid19_espce_Fluxo-de-Atendimento-à-Gestante.pdf\" target=\"_blank\" rel=\"noopener noreferrer\">aqui.</a>",
        "image": "https://coronavirus.ceara.gov.br/wp-content/uploads/2020/03/covd19_espce_destaquefluxogestantes.png",
        "terms": {
            "project_category": {
                "fluxogramas": "Fluxogramas"
            },
            "project_tag": {
                "coronavirus": "Coronavírus",
                "fluxograma": "Fluxograma",
                "atendimento-gestantes": "Atendimento gestantes",
                "suspeitos": "Suspeitos",
                "unidade-basica-de-saude": "Unidade Básica de Saúde"
            }
        },
        "keywords": [
            "Fluxogramas",
            "Coronavírus",
            "Fluxograma",
            "Atendimento gestantes",
            "Suspeitos",
            "Unidade Básica de Saúde"
        ]
    },
```


Endpoint: http://localhost:7000/api/categoriasArquitetura
```javascript
{
    "Educação": [
        [{
            "term_taxonomy_id": 451,
            "term_id": 451,
            "taxonomy": "project_category",
            "description": "",
            "parent": 7,
            "count": 8,
            "term": {
                "term_id": 451,
                "name": "Cursos on-line",
                "slug": "cursos-on-line",
                "term_group": 0
            }
         }],
        [{
                "term_taxonomy_id": 452,
                "term_id": 452,
                "taxonomy": "project_category",
                "description": "",
                "parent": 7,
                "count": 5,
                "term": {
                    "term_id": 452,
                    "name": "Tutoriais",
                    "slug": "tutoriais",
                    "term_group": 0
                }
        }]
    ],
    "Pesquisa Científica": [...],
    "Minha Saúde": [...]
}
```



