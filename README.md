# SalonManager

Sistema de Gestão para Salão de Beleza + Site Público Administrável

## Visão Geral

SalonManager é um sistema web desenvolvido em PHP puro (arquitetura Mini MVC) e banco de dados SQLite para gerenciar operações de um salão de beleza e oferecer um site público dinâmico para clientes.

O sistema integra:
- Gestão interna do salão (Dashboard, Agendamentos, Clientes, Profissionais, Serviços, Produtos)
- Catálogo público de serviços e produtos
- Agendamento online pelo site
- Carrinho de compras integrado com WhatsApp
- Formulário de contato via WhatsApp

## Arquitetura

- **Backend**: PHP 8+ com arquitetura Mini MVC (`core/`, `app/controllers/`, `app/models/`, `app/views/`)
- **Banco de Dados**: SQLite (`database/database.sqlite`)
- **Frontend Admin**: Tailwind CSS, AlpineJS e FullCalendar (Agendamentos)
- **Frontend Público**: Tailwind CSS, AlpineJS (Lógica de Carrinho e Formulários)

## Requisitos

- PHP 8.0 ou superior (extensões PDO e SQLite habilitadas)

## Instalação e Execução (Local)

1. **Configurar o banco de dados e dados iniciais (Seed)**
   No terminal, na raiz do projeto, execute o script de migração:
   ```bash
   php database/migrate.php
   ```
   *Isso criará o arquivo `database.sqlite` e populará o banco com usuários, clientes, serviços e produtos de teste.*

2. **Iniciar o servidor PHP embutido**
   Ainda na raiz do projeto, inicie o servidor rodando a partir da pasta pública:
   ```bash
   php -S localhost:8000 -t public
   ```

3. **Acessar o sistema**
   - **Site Público**: [http://localhost:8000](http://localhost:8000)
   - **Admin / Login**: [http://localhost:8000/login](http://localhost:8000/login)

## Credenciais de Acesso (Teste)

- **Email**: `admin@email.com`
- **Senha**: `admin123`

## Estrutura do Projeto

```text
salonmanager/
├── app/
│   ├── controllers/   # Controladores (Admin e Público)
│   ├── models/        # Modelos (ORM abstrato)
│   └── views/         # Interfaces (Admin, Auth, Public)
├── config/            # Configurações gerais (App, Database)
├── core/              # Classes base (Router, Controller, Model, Auth, Validator, DB)
├── database/          # Arquivos SQL, SQLite e script de migração/seed
├── public/            # Ponto de entrada (index.php) e assets (js, css, img)
├── routes/            # Definição de rotas (web.php)
└── README.md
```

## Recursos Destacados

- **FullCalendar**: Gerenciamento visual da agenda. Arraste e visualize horários facilmente.
- **WhatsApp Checkout**: O carrinho de compras e os pedidos de contato geram uma URL `wa.me` com o texto devidamente formatado contendo o resumo ou mensagem.
- **Micro-MVC**: Framework criado do zero, sem dependências do Composer para rodar localmente de forma extremamente rápida.

## Roadmap de Evolução

- Sistema Multi-tenant (SaaS para múltiplos salões).
- Integração com Gateways de Pagamento (Stripe, MercadoPago).
- Transformação em um App Mobile (PWA/React Native).
