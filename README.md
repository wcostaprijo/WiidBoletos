## Sobre o projeto

Está é uma RESTful API para geração e manutenção de pagamentos via Boleto.

`IMPORTANTE:` para uso comercial utilize o comando:
```
php artisan jwt:secret
```
O comando acima criará uma nova chave secreta para o JWT.

## Instalação

`1°:` Clone o repositório em seu ambiente.
`2°:` utilize o comando:
```
composer install
```
`3°:` Adicione as informações do seu projeto no .env [Dados do banco de dados, nome do projeto, url, etc...]
`4°:` utilize o comando:
```
php artisan migrate 
```

## Como utilizar
Para utilizar a API será necessário criar um usuário e realizar o login, após realizar o login será retornado um token válido por 10 minutos, este token deve ser informado no header da requisição através da autenticação Bearer.

#### Demonstração:
Cadastro de usuário:
```
curl --request POST \
  --url https://dominio.com/api/register \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
	"name": "Wanderson",
	"last_name": "Wanderson",
	"email": "wanderson@hotmail.com",
	"password": "123456789"
}'
```
Resposta (Em caso de sucesso, CÓDIGO: 201):
```
{
  "name": "Wanderson",
  "last_name": "Wanderson",
  "email": "wanderson2@hotmail.com",
  "updated_at": "2021-03-12T01:37:16.000000Z",
  "created_at": "2021-03-12T01:37:16.000000Z",
  "id": 1
}
```
Resposta (Em caso de erro, CÓDIGO: 400):
```
{
  "error": "Parâmetros inválidos.",
  "messages": {
    "name": [
      "O parâmetro name é obrigatório."
    ],
    "last_name": [
      "O parâmetro last_name é obrigatório."
    ],
    "email": [
      "O parâmetro email é obrigatório."
    ],
    "password": [
      "O parâmetro password é obrigatório."
    ]
  }
}
```

Autenticação de usuário:
```
curl --request POST \
  --url https://dominio.com/api/login \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
	"email": "wanderson@hotmail.com",
	"password": "123456789"
}'
```
Resposta (Em caso de sucesso, CÓDIGO: 200):
```
{
  "access_token": "{JWTToken}",
  "token_type": "bearer",
  "expires_in": 600
}
```
Resposta (Em caso de erro, CÓDIGO: 401):
```
{
  "error": "E-mail e/ou senha inválidos."
}
```

Recuperando usuário logado:
```
curl --request POST \
  --url https://dominio.com/api/me \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer {JWTToken}'
```
Resposta (Em caso de sucesso, CÓDIGO: 200):
```
{
  "id": 1,
  "name": "Nome",
  "last_name": "Sobrenome",
  "email": "wcostaprijo@hotmail.com",
  "created_at": "2021-03-11T20:39:00.000000Z",
  "updated_at": "2021-03-11T20:39:00.000000Z"
}
```
Resposta (Em caso de erro, CÓDIGO: 401):
```
{
  "error": "Token de autorização inválido."
}
```

## Metódos da API
### [POST] /api/register
Headers:
 - [x] Accept: application/json
 - [x] Content-Type: application/json

Parâmetro | Tipo | Obrigatório
---|---|---
name | string | sim
last_name | string | sim
email | string | sim
password | string | sim

### [POST] /api/login
Headers:
- [x] Accept: application/json
- [x] Content-Type: application/json

Parâmetro | Tipo | Obrigatório
---|---|---
email | string | sim
password | string | sim

### [POST] /api/me
Headers:
- [x] Accept: application/json
- [x] Authorization: Bearer {JWTToken}

### [GET] /api/pagador/me
Headers:
- [x] Accept: application/json
- [x] Authorization: Bearer {JWTToken}

### [POST] /api/pagador/create
Headers:
- [x] Accept: application/json
- [x] Content-Type: application/json
- [x] Authorization: Bearer {JWTToken}

Parâmetro | Tipo | Obrigatório | formato
---|---|---|---
name | string | sim
document | string | sim | **000.000.000-00** ou **00.000.000/0000-00**
phone | string | sim
email | string | sim
birth | string | sim | **YYYY-MM-DD**
address_cep | string | sim | **00 000-000**
address_street | string | sim
address_district | string | sim
address_number | string | não
address_complement | string | não
address_city | string | sim
address_state | string | sim

### [POST] /api/pagador/update/{id_pagador}
Headers:
- [x] Accept: application/json
- [x] Content-Type: application/json
- [x] Authorization: Bearer {JWTToken}

Parâmetro | Tipo | Obrigatório | formato
---|---|---|---
name | string | não
document | string | não | **000.000.000-00** ou **00.000.000/0000-00**
phone | string | não
email | string | não
birth | string | não | **YYYY-MM-DD**
address_cep | string | não | **00 000-000**
address_street | string | não
address_district | string | não
address_number | string | não
address_complement | string | não
address_city | string | não
address_state | string | não

### [POST] /api/pagador/delete/{id_pagador}
Headers:
- [x] Accept: application/json
- [x] Authorization: Bearer {JWTToken}

### [GET] /api/boleto/me
Headers:
- [x] Accept: application/json
- [x] Authorization: Bearer {JWTToken}

### [GET] /api/boleto/pagador/{id_pagador}
Headers:
- [x] Accept: application/json
- [x] Authorization: Bearer {JWTToken}

### [POST] /api/boleto/create
Headers:
- [x] Accept: application/json
- [x] Content-Type: application/json
- [x] Authorization: Bearer {JWTToken}

Parâmetro | Tipo | Obrigatório | formato
---|---|---|---
payer_id | bigint | sim
due_date | date | sim | **YYYY-MM-DD**
value | int | sim | **Centavos** - R$ 1,58 = 158
description | string | sim
fine_type | int | não | [**1**] Valor fixo - [**2**] Porcentagem
fine_value | int | somente se **fine_type** for informado | **Centavos** - R$ 1,58 = 158
fee_type | int | não | [**1**] Valor fixo - [**2**] Porcentagem
fee_value | int | somente se **fee_type** for informado | **Centavos** - R$ 1,58 = 158
discount_type | int | não | [**1**] Valor fixo - [**2**] Porcentagem
discount_value | int | somente se **discount_type** for informado | **Centavos** - R$ 1,58 = 158
discount_date_limit | date | somente se **discount_type** for informado | **YYYY-MM-DD**
reference | string | não
instruction_one | string | não
instruction_two | string | não
instruction_three | string | não

### [POST] /api/boleto/update/{id_boleto}
Headers:
- [x] Accept: application/json
- [x] Content-Type: application/json
- [x] Authorization: Bearer {JWTToken}

Parâmetro | Tipo | Obrigatório | formato
---|---|---|---
payer_id | bigint | não
due_date | date | não | **YYYY-MM-DD**
value | int | não | **Centavos** - R$ 1,58 = 158
description | string | não
fine_type | int | não | [**1**] Valor fixo - [**2**] Porcentagem
fine_value | int | somente se **fine_type** for informado | **Centavos** - R$ 1,58 = 158
fee_type | int | não | [**1**] Valor fixo - [**2**] Porcentagem
fee_value | int | somente se **fee_type** for informado | **Centavos** - R$ 1,58 = 158
discount_type | int | não | [**1**] Valor fixo - [**2**] Porcentagem
discount_value | int | somente se **discount_type** for informado | **Centavos** - R$ 1,58 = 158
discount_date_limit | date | somente se **discount_type** for informado | **YYYY-MM-DD**
reference | string | não
instruction_one | string | não
instruction_two | string | não
instruction_three | string | não

### [POST] /api/boleto/delete/{id_boleto}
Headers:
- [x] Accept: application/json
- [x] Authorization: Bearer {JWTToken}

#### Observação: Tenho ciência dos padrões de verbalização das rotas para RestFul API, porém para atender as necessidades do teste, não utilizei os devidos padrões.

![Créditos a @wssilva.willian, site medium](https://miro.medium.com/max/700/1*FtjrUUGyi92aJGz1kMUfwA.png)

![Créditos a @wssilva.willian, site medium](https://miro.medium.com/max/442/1*ES8Om94ZdBv9dQ1kE0ZqGA.png)