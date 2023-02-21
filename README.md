## 1. Endpoints

### Rotas e Endpoints

-   [Team](#1-team)
-   [POST - api/teams](#11-criação-de-times)
-   [GET - api/teams](#12-listando-times)
-   [GET - api/teams/:id](#13-listar-time-por-id)
-   [PATCH - api/teams/:id](#14-atualizar-os-dados-do-time)
-   [DELETE - api/teams/:id](#15-deletando-time)

## 1. **Team**

[ Voltar para os Endpoints ](#1-endpoints)

O objeto Team é definido como:

| Campo      | Tipo    | Descrição                              |
| ---------- | ------- | -------------------------------------- |
| id         | integer | Identificador único do usuário         |
| name       | string  | O nome do time.                        |
| titles     | integer | Numero de títulos.                     |
| top_scorer | string  | O nome do jogador com maior pontuação. |
| fifa_code  | string  | Código da fifa.                        |
| first_cup  | date    | Data de participação da primeira copa. |
| createdAt  | date    | Data de criação do time             |
| updatedAt  | date    | Data que o time atualizou       |

### Endpoints

| Método | Rota           | Descrição                                  |
| ------ | -------------- | ------------------------------------------ |
| POST   | /api/teams     | Criação de um time.                        |
| GET    | /api/teams     | Lista todos os times.                      |
| GET    | /api/teams/:id | Lista um time usando seu ID como parâmetro |
| PATCH  | /api/teams/:id | Atualização dos dados do time.             |
| DELETE | /api/teams/:id | Deleta o time passando o ID                |

### 1.1 **Criação de Times**

[ Voltar para os Endpoints ](#1-endpoints)

### `POST /api/teams`

### Body para a requisição:

```json
{
    "name": "Argentina",
    "titles": 2,
    "top_scorer": "Maradona",
    "fifa_code": "ARG",
    "first_cup": "1930-07-13"
}
```

### Exemplo de Response:

```
STATUS: 201 Created
```

```json
{
    "name": "Argentina",
    "titles": 2,
    "top_scorer": "Maradona",
    "fifa_code": "ARG",
    "first_cup": "1930-07-13T00:00:00.000000Z",
    "updated_at": "2023-02-20T22:10:02.000000Z",
    "created_at": "2023-02-20T22:10:02.000000Z",
    "id": 9
}
```

### Possíveis Erros:

| Código do Erro  | Descrição                                          |
| --------------- | -------------------------------------------------- |
| 409 Conflict    | The fifa code has already been taken.              |
| 400 Bad Request | titles cannot be negative.                         |
| 400 Bad Request | there was no world cup this year.                  |
| 400 Bad Request | impossible to have more titles than disputed cups. |

---

### 1.2. **Listando Times**

[ Voltar aos Endpoints ](#1-endpoints)

### `GET /api/teams`

### Body para a requisição:

```json
No-Body
```

### Exemplo de Response:

```
STATUS: 200 OK
```

```json
[
    {
        "id": 9,
        "name": "Argentina",
        "titles": 2,
        "top_scorer": "Maradona",
        "fifa_code": "ARG",
        "first_cup": "1930-07-13T00:00:00.000000Z",
        "created_at": "2023-02-20T22:10:02.000000Z",
        "updated_at": "2023-02-20T22:10:02.000000Z"
    },
    {
        "id": 10,
        "name": "Brasil",
        "titles": 5,
        "top_scorer": "Pelé",
        "fifa_code": "BRA",
        "first_cup": "1930-07-13T00:00:00.000000Z",
        "created_at": "2023-02-20T22:15:31.000000Z",
        "updated_at": "2023-02-20T22:15:31.000000Z"
    }
]
```

---

### 1.3. **Listar time por ID**

[ Voltar aos Endpoints ](#1-endpoints)

### `GET /api/teams:id`

### Parâmetros da Requisição:

| Parâmetro | Tipo    | Descrição         |
| --------- | ------- | ----------------- |
| id        | integer | ID do time (Team) |

### Body para a Requisição:

```json
No-Body
```

### Exemplo de Response:

```
200 OK
```

```json
{
    "id": 9,
    "name": "Argentina",
    "titles": 3,
    "top_scorer": "Lionel Messi",
    "fifa_code": "ARG",
    "first_cup": "1930-07-13T00:00:00.000000Z",
    "created_at": "2023-02-20T22:10:02.000000Z",
    "updated_at": "2023-02-20T22:21:59.000000Z"
}
```

### Possíveis Erros:

| Código do Erro | Descrição       |
| -------------- | --------------- |
| 404 Not Found  | Team not found. |

---

### 1.4 **Atualizar os dados do time**

[ Voltar aos Endpoints ](#1-endpoints)

### `PATCH /api/teams:id`

### Parâmetros da Requisição:

| Parâmetro | Tipo    | Descrição  |
| --------- | ------- | ---------- |
| id        | integer | ID do time |

### Body para a requisição:

```json
{
    "top_scorer": "Lionel Messi",
    "titles": 3
}
```

### Exemplo de Response:

```
STATUS: 200 OK
```

```json
{
    "id": 9,
    "name": "Argentina",
    "titles": 3,
    "top_scorer": "Lionel Messi",
    "fifa_code": "ARG",
    "first_cup": "1930-07-13T00:00:00.000000Z",
    "created_at": "2023-02-20T22:10:02.000000Z",
    "updated_at": "2023-02-20T22:21:59.000000Z"
}
```

### Possíveis Erros:

| Código do Erro  | Descrição                                          |
| --------------- | -------------------------------------------------- |
| 404 Not Found   | Team not found.                                    |
| 409 Conflict    | The fifa code has already been taken.              |
| 400 Bad Request | titles cannot be negative.                         |
| 400 Bad Request | there was no world cup this year.                  |
| 400 Bad Request | impossible to have more titles than disputed cups. |

---

### 1.5 **Deletando time**

[ Voltar aos Endpoints ](#1-endpoints)

### `DELETE /api/teams:id`

### Parâmetros da Requisição:

| Parâmetro | Tipo    | Descrição  |
| --------- | ------- | ---------- |
| id        | integer | ID do time |

### Body para a requisição:

```json
No-Body
```

### Exemplo de Response:

```
STATUS: 204 - No Content
```

### Possíveis Erros:

| Código do Erro | Descrição       |
| -------------- | --------------- |
| 404 Not Found  | Team not found. |
