DESAFIO LOJA DE BRINQUEDOS

Backend – API Laravel
Este projeto implementa uma API RESTful utilizando Laravel para gerenciar clientes e vendas de uma loja de brinquedos. Ele atende aos requisitos do desafio técnico, incluindo autenticação, filtros, estatísticas e testes automatizados.

✅ Funcionalidades implementadas
✅ Autenticação via token (sanctum)
✅ CRUD completo de clientes
✅ CRUD completo de vendas
✅ Filtro de vendas por data e por cliente
✅ Cálculo de estatísticas (total vendido, ticket médio, quantidade de vendas)
✅ Validação de dados e tratamento de erros
✅ Testes automatizados com PHPUnit
✅ Documentação da API com exemplo de uso (via Postman ou Swagger)

🧪 Como rodar o backend
O projeto está containerizado com Docker.

Pré-requisitos:
Docker e Docker Compose instalados

Rodando com Docker:
docker compose up -d

Instalar dependências e configurar o projeto:
docker compose exec app bash
composer install
php artisan migrate --seed

Autenticação
O sistema usa tokens via Laravel Sanctum. Para autenticar:

Endpoint: POST /api/login

Body:
{
  "email": "admin@example.com",
  "password": "password"
}

O retorno será um token que deve ser usado em todos os endpoints protegidos via Authorization: Bearer {token}

📊 Filtros e Estatísticas
Listagem de ce clientes pode ser filtrada por Nome, Email

Estatísticas como total de vendas, ticket médio e quantidade são acessíveis no endpoint:
GET api/estatisticas/top-clientes
GET api/estatisticas/vendas-por-dia

🧪 Testes Automatizados
Execute os testes com:
docker compose exec app php artisan test

🔎 Estrutura de pastas principais

app/
├── Http/Controllers/
│   ├── AuthController.php
│   ├── ClienteController.php
│   |── EstadisticasController.php
|   |── TesteClienteController.php (Aqui estao os dados com ruido)
|   └── VendaController.php
├── Models/
│   ├── User.php
│   ├── Cliente.php
│   └── Venda.php
├── Requests/
│   └── CustomerRequest.php
│   └── SaleRequest.php
routes/
└── api.php

Tecnologias Utilizadas:
Laravel 10
MySQL
Laravel Sanctum (auth)
PHPUnit (testes)
Docker / Docker Compose

## 📬 Documentação da API (Postman)

Você pode importar a coleção do Postman para testar a API localmente.
📁 Arquivo da coleção: [`postman_collection.json`](./docs/Api_brinquedos.postman_collection.json)

Ou, se quiser testar diretamente:

1. Abra o [Postman](https://www.postman.com/)
2. Vá em `Import` > selecione o arquivo `Api_brinquedos.postman_collection.json`
3. Teste os endpoints disponíveis (clientes, vendas, estatísticas, etc.)
