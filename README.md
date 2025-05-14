# 🎯 Desafio Loja de Brinquedos

## 🛠️ Backend – API Laravel

Este projeto implementa uma API RESTful utilizando **Laravel 10** para gerenciar **clientes** e **vendas** de uma loja de brinquedos. Ele atende aos requisitos do desafio técnico, incluindo autenticação, filtros, estatísticas e testes automatizados.

---

## ✅ Funcionalidades Implementadas

- ✅ Autenticação via token (Laravel Sanctum)  
- ✅ CRUD completo de **clientes**  
- ✅ CRUD completo de **vendas**  
- ✅ Filtro de vendas por **data** e por **cliente**  
- ✅ Cálculo de estatísticas:
  - Total vendido  
  - Ticket médio  
  - Quantidade de vendas  
- ✅ Validação de dados e tratamento de erros  
- ✅ Testes automatizados com **PHPUnit**  
- ✅ Documentação da API (Postman ou Swagger)

---

## 🐳 Como Rodar o Backend (com Docker)

**Pré-requisitos:**  
- Docker  
- Docker Compose  

### Passos:

```bash
# Suba os containers
docker compose up -d

# Acesse o container
docker compose exec app bash

# Instale as dependências e rode as migrações
composer install
php artisan migrate --seed
```

---

## 🔐 Autenticação

A API usa **Laravel Sanctum** para autenticação via token.

- **Endpoint:** `POST /api/login`  
- **Body:**
```json
{
  "email": "admin@example.com",
  "password": "password"
}
```

- **Resposta:**
```json
{
  "token": "seu_token_aqui"
}
```

Utilize esse token nos endpoints protegidos:
```
Authorization: Bearer {token}
```

---

## 📊 Filtros e Estatísticas

### Clientes
- Pode ser filtrado por **nome** e **e-mail**

### Estatísticas:
- `GET /api/estatisticas/top-clientes`  
- `GET /api/estatisticas/vendas-por-dia`

---

## 🧪 Testes Automatizados

Execute os testes com:

```bash
docker compose exec app php artisan test
```

---

## 📁 Estrutura de Pastas (principais)

```bash
app/
├── Http/Controllers/
│   ├── AuthController.php
│   ├── ClienteController.php
│   ├── EstatisticasController.php
│   ├── TesteClienteController.php  # Contém os dados com ruído
│   └── VendaController.php
├── Models/
│   ├── User.php
│   ├── Cliente.php
│   └── Venda.php
├── Requests/
│   ├── CustomerRequest.php
│   └── SaleRequest.php

routes/
└── api.php
```

---

## 🧰 Tecnologias Utilizadas

- Laravel 10  
- MySQL  
- Laravel Sanctum (Autenticação)  
- PHPUnit (Testes)  
- Docker & Docker Compose  

---

## 📬 Documentação da API (Postman)

Você pode importar a coleção Postman e testar a API localmente.

- 📁 Arquivo da coleção: [docs/Api_brinquedos.postman_collection.json](./docs/Api_brinquedos.postman_collection.json)

### Como importar:

1. Abra o Postman  git 
2. Vá em **Importar**  
3. Selecione o arquivo `Api_brinquedos.postman_collection.json`  
4. Teste os endpoints disponíveis!

---