# Loan Management API

A API de gerenciamento de empréstimos permite o cadastro, login, logout, refresh de tokens e o gerenciamento de contratos de empréstimos e comissões. Esta API foi desenvolvida utilizando o framework **Laravel** com **JWT (JSON Web Tokens)** para autenticação e **PostgreSQL** como banco de dados.

## Tecnologias Utilizadas

- **Laravel 10.48.29**: Framework PHP utilizado para desenvolvimento da API.
- **PHP 8.1.25**: Versão do PHP utilizada no projeto.
- **PostgreSQL 14.13**: Banco de dados utilizado para armazenar os dados da aplicação.
- **JWT (Tymon\JWTAuth)**: Implementação para autenticação via token JWT.
- **Composer**: Gerenciador de dependências PHP.
- **Git**: Controle de versão.

## Instalação

1. Clone o repositório para sua máquina local:

   ```bash
   git clone https://github.com/luan356/loan-management.git
2. Navegue até o diretório do projeto:
3. ```bash
   cd loan-management
4.php artisan serve

## Endpoints da API

1. Autenticação

-Login: POST /api/login
        {
  "email": "gerente_comercial@email.com",
  "password": "12345678"
}

-Logout: POST /api/logout
    Cabeçalho:
    Refresh Token: POST /api/refresh

Cabeçalho:
    Authorization: Bearer <token>


  
3. Usuários
 -  Registrar novo usuário: POST /api/register
        Corpo da requisição:
            {
          "name": "gerente_comercial23",
          "email": "gerente_comercial23@email.com",
          "password": "12345678"
        }
 


5. Contrato emprestimo
   - Listar contratos: GET /api/contratos
- Deletar contrato: DELETE /api/contratos/{id}


-Atualizar status do contrato: PATCH /api/contratos/{id}/status
    {
  "status": "aprovado"
    }

-Cadastrar contrato de empréstimo: POST /api/contratos
Corpo da requisição:
{
  "cliente_id": 1,
  "valor": 100.00,
  "cargo_id": 1
}

7. Clientes
Obter cliente: GET /api/clientes/{id}




## licença 
1. 
Este é um modelo básico de `README.md`. Ele inclui a configuração do ambiente, instalação das dependências, endpoints da API e instruções para contribuir com o projeto. Pode ser ajustado conforme as necessidades específicas do seu projeto.
