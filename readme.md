# xMeeting Scheduling

Este projeto consiste em conjunto de API REST com o objetivo de realizar agendamento para utilização de salas de reuniões.

# Tecnologias

O mesmo foi desenvolvido utilizando o framework php Lumen, banco de dados Mysql.

# Instruções para utilização

Para rodar o projeto, você tem duas opções:

## Utilizando docker
Configure/crie o arquivo .env na raiz do projeto seguindo o modelo do arquivo .env.exemple

Rode do composer install

Rode o docker-composer no arquivo docker-composer.yml da pasta docker;

Rode o php artisam migrate para criar as tabelas;

Rode o php artisam db:seed para popular o banco com dados iniciais;

Pronto, as APIs estarão disponível na porta 8000 de sua maquina (localhost:8000)

## Manualmente

Crie um banco mysql:5.7

Configure/crie o arquivo .env na raiz do projeto seguindo o modelo do arquivo .env.exemple

Rode do composer install

Rode o php artisam migrate para criar as tabelas;

Rode o php artisam db:seed para popular o banco com dados iniciais;

Acesse a pasta public e rode o servidor php (php -S 127.0.0.1:8000);

Pronto, as APIs estarão disponível na porta 8000 de sua maquina (localhost:8000)


# Documentação da API

# Criar um agendamento

```http
POST /salas/{sala}/agendar
```
## Request
| Parameter | Type | Description |
| :--- | :--- | :--- |
| `{sala}` | `int` | **Required**. id da sala |

```javascript
{
  "descricao" : string,
  "solicitante_email" : email,
  "inicio"    : dateTime('d/m/Y H:i'),
  "fim"    : dateTime('d/m/Y H:i'),  
  "sala_id" : int
}
```
## Responses
## Sucess
```http
    201 | `Criado com sucesso`
```

## Error

```http
    422 | `Erro em um dos campos enviados`
```
```javascript
{
    "descricao": [
        "Por favor preencher a descrição."
    ],
    "solicitante_email": [
        "Por favor informe o e-mail do solicitante"
    ],
    "inicio": [
        "O inicio da reunião deve ser informado"
    ],
    "fim": [
        "O fim da reunião deve ser informado"
    ],
    "sala_id": [
        "Por favor informar o id da sala."
    ],
    "disponibilidade": [
        "O horário solicitado não esta disponível."
    ]
}
```

# Cancelar um agendamento

```http
POST /agendamentos/{id}/cancelar
```
## Request
| Parameter | Type | Description |
| :--- | :--- | :--- |
| `{id}` | `int` | **Required**. id do agendamento |

```javascript
{
  "id" : int
}
```
## Responses
## Sucess
```http
    200 | `sucesso`
```

## Error

```http
    422 | `Erro em um dos campos enviados`
```
```javascript
{
    "id": [
        "Por favor informar o id do agendamento.",
        "O agendamento informado não ativo no sistema"
    ],
}
```

# Pegar agendamentos to dia

```http
GET /agendamentos/{id}/hoje
```

## Responses
## Sucess
```http
    200 | `sucesso`
```
```javascript
[
    {
        "id": 3,
        "descricao": "Asda",
        "sala_id": 1,
        "solicitante_email": "silva.evecimar@gmail.com",
        "inicio": "18/10/2019 18:30",
        "fim": "25/10/2019 19:00",
        "status_id": 1,
        "created_at": "2019-10-18 10:20:46",
        "updated_at": "2019-10-18 10:20:46",
        "sala": {
            "id": 1,
            "nome": "Sala 1",
            "descricao": "Sala de reunião 1",
            "created_at": null,
            "updated_at": null
        },
        "status": {
            "id": 1,
            "nome": "Ativo",
            "descricao": "Ativo",
            "created_at": null,
            "updated_at": null
        }
    }
]
```

## Status Codes

| Status Code | Description |
| :--- | :--- |
| 200 | `OK` |
| 201 | `CREATED` |
| 422 | `Unprocessable Entity` |
| 404 | `NOT FOUND` |
| 500 | `INTERNAL SERVER ERROR` |
