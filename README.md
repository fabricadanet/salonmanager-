# SalonManager

> Sistema de Gestão para Salões de Beleza com Site Público Administrável

[![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat-square&logo=php)](https://php.net)
[![SQLite](https://img.shields.io/badge/SQLite-3-003B57?style=flat-square&logo=sqlite)](https://sqlite.org)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-06B6D4?style=flat-square&logo=tailwindcss)](https://tailwindcss.com)

---

## 📋 Visão Geral

**SalonManager** é uma plataforma completa para salões de beleza, desenvolvida em PHP puro com arquitetura MVC personalizada e banco de dados SQLite — sem dependências do Composer. O sistema combina uma **área administrativa completa** com um **site público dinâmico e personalizável**, tudo gerenciável via painel admin.

---

## ✨ Funcionalidades

### Painel Administrativo
| Módulo | Descrição |
|---|---|
| 📊 **Dashboard** | Resumo financeiro, agendamentos do dia e métricas |
| 📅 **Agenda (FullCalendar)** | Visualização e gestão visual de horários com drag-and-drop |
| 👥 **Clientes** | Cadastro e histórico de clientes |
| 💇 **Profissionais** | Gestão de equipe e especialidades |
| ✂️ **Serviços** | CRUD de serviços com imagens e preços |
| 🛍️ **Produtos** | Catálogo de produtos para venda |
| 💰 **Financeiro** | Controle de receitas e despesas |
| 📦 **Estoque** | Controle de inventário |
| 🎨 **Conteúdo do Site** | CMS completo com seleção de template e edição de todos os textos/imagens |
| 🔍 **SEO & Rastreamento** | Injeção de Google Tag Manager e scripts de cabeçalho personalizados |

### Site Público
| Funcionalidade | Descrição |
|---|---|
| 🎭 **3 Templates Exclusivos** | Noir & Gold, Modern Clarity, Vintage Chic — 100% personalizáveis |
| 🛒 **Carrinho + WhatsApp** | Checkout de produtos via link `wa.me` formatado |
| 📅 **Agendamento Online** | Formulário de agendamento de serviços |
| 🔒 **Política & Termos** | Páginas de privacidade e termos de uso com editor rich text |
| 📱 **Redes Sociais** | Exibição condicional de Instagram, Facebook e TikTok |
| 🔎 **SEO** | Meta tags, scripts de rastreamento e Google Analytics configuráveis |

---

## 🏗️ Arquitetura

```
salonmanager/
├── app/
│   ├── controllers/       # Lógica de negócio (Admin, Público, Auth)
│   ├── models/            # Modelos de dados (ORM abstrato)
│   └── views/
│       ├── admin/         # Interface do painel administrativo
│       ├── auth/          # Telas de login e autenticação
│       ├── layouts/       # Layouts reutilizáveis (Admin, Public)
│       └── templates/     # Templates públicos (noir, modern, vintage)
│           ├── noir/
│           ├── modern/
│           └── vintage/
├── config/                # Configuração da aplicação e banco de dados
├── core/                  # Classes base do mini-framework
│   ├── Router.php         # Roteamento
│   ├── Controller.php     # Controlador base
│   ├── Model.php          # ORM base
│   ├── Auth.php           # Autenticação e sessões
│   ├── Validator.php      # Sanitização de dados
│   ├── ImageHandler.php   # Upload e gerenciamento de imagens
│   └── Database.php       # Conexão SQLite via PDO
├── database/
│   ├── database.sqlite    # Banco de dados (gerado pelo migrate.php)
│   ├── schema.sql         # Definição de tabelas
│   ├── seed.sql           # Dados iniciais de teste
│   └── migrate.php        # Script de migração e seed
├── public/                # Document root do servidor web
│   ├── index.php          # Front controller (ponto de entrada único)
│   ├── assets/            # CSS, JS, imagens estáticas
│   └── uploads/           # Imagens enviadas via upload
└── routes/
    └── web.php            # Definição de todas as rotas da aplicação
```

**Stack Técnica:**
- **Backend:** PHP 8.0+ (PDO, SQLite, Sessions)
- **Banco de Dados:** SQLite 3 (arquivo único, sem servidor)
- **CSS:** Tailwind CSS (via CDN)
- **JS:** Alpine.js (interatividade), FullCalendar (agenda)
- **Uploads:** Sistema de upload de imagens com validação de MIME type

---

## ⚙️ Instalação Local

### Pré-requisitos
- PHP 8.0 ou superior
- Extensões PHP: `pdo`, `pdo_sqlite`, `fileinfo`, `gd`

### Passos

```bash
# 1. Clonar o repositório
git clone <url-do-repositório> salonmanager
cd salonmanager

# 2. Rodar as migrações (cria o banco de dados e popula com dados de teste)
php database/migrate.php

# 3. Iniciar o servidor de desenvolvimento
php -S localhost:8000 -t public
```

### Acessar
- **Site Público:** http://localhost:8000
- **Admin:** http://localhost:8000/login

### Credenciais de Teste
| Campo | Valor |
|---|---|
| Email | `admin@email.com` |
| Senha | `admin123` |

---

## 🎨 Templates Disponíveis

| Template | Estilo | Paleta |
|---|---|---|
| **Noir & Gold** | Luxo e elegância com tipografia dramática | Preto, dourado |
| **Modern Clarity** | Minimalismo e precisão contemporânea | Branco, slate |
| **Vintage Chic** | Tradição e acolhimento com toque clássico | Âmbar, creme |

A troca de template é feita em **Admin → Conteúdo do Site → Template do Site Público** — sem necessidade de alterar código.

---

## 🔧 Personalização via Admin

Todo o conteúdo do site público é gerenciável sem tocar em código:

- ✅ Nome do sistema e do site público
- ✅ Favicon e logomarca  
- ✅ Imagem, título, subtítulo e texto do Hero
- ✅ Seção "Quem Somos"
- ✅ Cabeçalhos das seções de Serviços e Produtos
- ✅ Call to Action (CTA)
- ✅ Redes sociais (Instagram, Facebook, TikTok)
- ✅ Política de Privacidade e Termos de Uso (rich text)
- ✅ Textos do rodapé
- ✅ Google Tag Manager e scripts de SEO

---

## 📄 Licença

Desenvolvido sob medida. Todos os direitos reservados.
