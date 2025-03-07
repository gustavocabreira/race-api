# Grupo Criar Fullstack Challenge

### Candidato: Gustavo de Sousa Cabreira
### Vaga: Pessoa Desenvolvedora PHP (Sênior)

## Sobre o projeto

Uma API para listar as corridas e os pilotos que participaram delas. 

## Tecnologias Utilizadas

- Docker e Docker Compose
- PHP 8.4
- Laravel Framework
- Swoole (Laravel Octane)
- MySQL
- [Nginx](https://www.nginx.com/) (Servidor de aplicações)
- [Pest](https://pestphp.com/) (Testes)
- [Supervisor](https://github.com/ochinchina/supervisord) (Gerenciador de processos)
- [Scramble](https://scramble.dedoc.co/) (Documentação)

## Instalação

### Requisitos

- [Docker](https://docs.docker.com/engine/install/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- Deverá ter as portas 80, 3306, 6379 e 9051 disponíveis.

### Executando o projeto

1. Clone o repositório

```bash
git clone https://github.com/gustavocabreira/race-api.git
```

2. Entre na pasta do projeto

```bash
cd race-api
```

3. Entre na pasta docker/local

```bash
cd docker/local
```

4. Execute o comando para instalar o projeto

```bash
sh install.sh --app-name=races
```

5. Após a instalação, utilize o comando para iniciar o projeto

```bash
sh start.sh
```

6. Acesse a aplicação em http://localhost

7. Você pode acessar a documentação do projeto em http://localhost/docs/api

## Código de respostas HTTP

| Código | Descrição              | Explicação                                                                     | 
|--------|------------------------|--------------------------------------------------------------------------------|
| 200 | OK                        | A requisição performou com sucesso.                                            |
| 201 | Created                   | O recurso foi criado com sucesso.                                              |
| 204 | No Content                | A requisição performou com sucesso, mas não retornou nenhum conteúdo.          |
| 404 | Not Found                 | O recurso não foi encontrado.                                                  |
| 422 | Unprocessable Entity      | O recurso não pode ser processado devido a um erro nas informações fornecidas. |
| 500 | Internal Server Error     | Ocorreu um erro no servidor.                                                   |

## Testes

Os testes do projeto estão no diretório `tests/` e foram desenvolvidos utilizando o pacote [Pest](https://pestphp.com/docs/installation).
Pest é uma biblioteca de testes para PHP que permite escrever testes de forma fácil e rápida.

Para executar os testes, siga os passos abaixo:

1. Acesse o diretório /docker/local
2. Execute o comando para interagir com o container

```bash
docker compose exec -it laravel sh
```

3. Execute o seguinte comando

```bash
php artisan test
```