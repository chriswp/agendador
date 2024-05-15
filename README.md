## Teste Backend


## Resumo
O teste foi realizado, porém ainda está incompleto. Falta adicionar a segurança de acesso via token e gerar a documentação da API



## Tecnologias Usadas

- Docker
- PHP 8.1
- [Laravel 11.x](https://laravel.com/docs/11.x)
- Postgres 12


## Executando o projeto
Para iniciar o projeto, é necessário ter o docker em sua máquina instalado.

execute pela primeira vez o comando:

```bash
docker-compose up -d 
```

caso seja necessário destruir as imagens e recriar execute:
```bash
docker-compose down
docker-compose up -d 
```

após criado o build da aplicação, para acessar o container da aplicação, execute o comando:
```bash
docker exec -it app_codesh bash
```

## Acessando o Projeto
O projeto será executado na porta `8080`, para acessar através do navegador pela url `http://localhost:8000`

O banco de dados, caso seja necessário usar uma gerenciador de banco de dados, para ter acesso aos
dados, utilize as seguintes credenciais
```
host: localhost
database: agendador
porta: 15432
usuario: easyjur
senha: K7IzU5VvO6QfDy1DJp
```

## Entrypoint
Ao realizar o build da aplicação, existe um arquivo chamado `entrypoint.sh` que executa todos
os comandos necessários que a aplicação depende para iniciar.

Esse arquivo só é executado no momento que faz o build.

Caso seja necessário adicionar outros comandos para o funcionamento da aplicação, é necessário adicionar nesse arquivo


## Postman
Para facilitar alguns testes na API eu gerei uma documentação simples no postman
```
https://api.postman.com/collections/2645059-6bd5ff6c-6064-4fb8-833a-16c4b458b28b?access_key=PMAT-01HXY9E7ZVQDNCQQN3JWDP8TR2
```
