# PRD — SalonManager
Sistema de Gestão para Salão de Beleza + Site Público Administrável

---

# 1. Visão Geral

SalonManager é um sistema web desenvolvido para gerenciar operações de um salão de beleza e oferecer um site público para clientes.

O sistema integra:

- gestão interna do salão
- catálogo público de serviços
- catálogo público de produtos
- agendamento online
- carrinho de compras enviado para WhatsApp
- formulário de contato via WhatsApp

Inicialmente o sistema será **single-tenant (um único salão)**, mas a arquitetura deverá permitir futura evolução para SaaS.

---

# 2. Objetivos do Produto

## Objetivos principais

- Digitalizar a gestão do salão
- Permitir agendamentos online
- Expor serviços e produtos no site público
- Facilitar pedidos via WhatsApp
- Melhorar organização de clientes e profissionais

## Objetivos secundários

- Automatizar cálculo de comissões
- Criar relatórios financeiros
- Permitir gestão simples do conteúdo do site

---

# 3. Stakeholders

## Dono do salão
Responsável pela gestão geral.

## Recepcionista
Gerencia clientes e agenda.

## Profissionais
Executam serviços.

## Clientes
Acessam o site público para ver serviços, comprar produtos ou agendar horários.

---

# 4. Funcionalidades do Sistema

---

# 4.1 Autenticação

Sistema de login com perfis:

- Admin
- Recepção
- Profissional

Funcionalidades:

- login
- logout
- proteção de sessão
- hash de senha

---

# 4.2 Dashboard Administrativo

Indicadores principais:

- agendamentos do dia
- faturamento do dia
- total de clientes
- serviços realizados hoje

---

# 4.3 Gestão de Clientes

Cadastro de clientes com:

- nome
- telefone
- email
- observações

Funcionalidades:

- criar cliente
- editar cliente
- excluir cliente
- listar clientes
- histórico de serviços

---

# 4.4 Gestão de Profissionais

Cadastro contendo:

- nome
- especialidade
- percentual de comissão

Funcionalidades:

- criar profissional
- editar profissional
- excluir profissional

---

# 4.5 Gestão de Serviços

Cada serviço possui:

- nome
- descrição
- preço
- duração
- ativo/inativo

Funcionalidades:

- criar serviço
- editar serviço
- excluir serviço

---

# 4.6 Gestão de Produtos

Cada produto possui:

- nome
- descrição
- preço
- imagem
- ativo/inativo

Funcionalidades:

- criar produto
- editar produto
- excluir produto

---

# 4.7 Sistema de Agendamento

Calendário visual baseado em agenda.

Fluxo:

1. selecionar serviço  
2. selecionar profissional  
3. escolher data  
4. escolher horário  
5. confirmar  

Estados do agendamento:

- agendado
- em atendimento
- concluído
- cancelado

---

# 4.8 Sistema de Pagamentos

Formas suportadas:

- dinheiro
- pix
- cartão crédito
- cartão débito

---

# 4.9 Sistema de Comissões

Comissão calculada automaticamente após conclusão do serviço.

Fórmula: 
comissão = valor_serviço × percentual profissional


---

# 4.10 Relatórios

Relatórios disponíveis:

- faturamento diário
- faturamento mensal
- faturamento por profissional
- serviços mais realizados

---

# 5. Site Público do Salão

O sistema terá um site público integrado.

Rotas principais:
/
/servicos
/produtos
/agendar
/contato


---

# 6. Conteúdo Administrável do Site

O administrador pode editar:

- seção Hero
- Quem somos
- Serviços
- Produtos
- Informações de contato
- Número do WhatsApp
- Horário de funcionamento
- Galeria

Esses conteúdos ficam na tabela:
website_content

Campos:
section
title
subtitle
content
image


---

# 7. Página Inicial

Seções:

- Hero
- Quem Somos
- Serviços em destaque
- Produtos em destaque
- Call to action para agendamento
- Contato

---

# 8. Página de Serviços

Lista de serviços com:

- nome
- descrição
- preço
- duração

---

# 9. Página de Produtos

Catálogo de produtos com:

- imagem
- nome
- preço
- descrição

Inclui carrinho de compras.

---

# 10. Carrinho com Envio para WhatsApp

O carrinho **não processa pagamento online**.

Fluxo:

1. cliente adiciona produtos  
2. abre carrinho  
3. informa nome e telefone  
4. envia pedido  

O sistema gera uma mensagem formatada.

Exemplo:
Olá! Gostaria de comprar:

Shampoo Profissional - 2
Máscara Capilar - 1

Total: R$120

Nome: Maria
Telefone: 519999999


Mensagem enviada para:
https://wa.me/{numero}?text={mensagem}


---

# 11. Agendamento Online

Fluxo público:

1. cliente seleciona serviço  
2. seleciona profissional  
3. escolhe data  
4. escolhe horário  
5. informa nome e telefone  
6. confirma  

O agendamento é salvo no sistema.

---

# 12. Formulário de Contato

Campos:

- nome
- telefone
- mensagem

Mensagem enviada ao WhatsApp do salão.

---

# 13. Requisitos Técnicos

## Backend
PHP 8+

## Arquitetura
Mini MVC

## Banco de dados
SQLite

## Frontend
TailwindCSS  
AlpineJS

## Calendário
FullCalendar

---

# 14. Segurança

Requisitos:

- prepared statements
- validação de inputs
- CSRF protection
- hash de senha

---

# 15. Estrutura do Projeto
salon-manager/

app/
controllers/
models/
views/

core/

config/

routes/

database/

public/

storage/

tests/

README.md


---

# 16. Dados Iniciais (Seed)

Criar:

- 1 admin
- 5 serviços
- 5 produtos
- 3 profissionais
- 10 clientes

Login padrão:
admin@admin.com

senha: admin123


---

# 17. Critérios de Sucesso

O sistema será considerado funcional quando:

- admin conseguir gerenciar serviços, produtos e agenda
- clientes conseguirem agendar pelo site
- pedidos de produtos forem enviados ao WhatsApp
- conteúdo do site puder ser alterado pelo admin

---

# 18. Roadmap Futuro

Possíveis evoluções:

- versão SaaS multi-salões
- pagamento online
- aplicativo mobile
- integração com gateways de pagamento
