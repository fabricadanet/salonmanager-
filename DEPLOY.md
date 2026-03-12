# 🚀 Guia de Deploy — SalonManager

Este guia cobre o deploy do SalonManager em um servidor de hospedagem compartilhada (cPanel/Plesk) ou VPS Linux com Apache/Nginx.

---

## ✅ Pré-requisitos do Servidor

| Requisito | Versão mínima | Verificar |
|---|---|---|
| PHP | 8.0+ | `php -v` |
| Extensão PDO | ✓ | `php -m \| grep pdo` |
| Extensão PDO SQLite | ✓ | `php -m \| grep sqlite` |
| Extensão Fileinfo | ✓ | `php -m \| grep fileinfo` |
| Extensão GD | ✓ | `php -m \| grep gd` |
| mod_rewrite (Apache) | habilitado | Obrigatório para as rotas |

---

## 📁 Estrutura de Arquivos no Servidor

O projeto usa o padrão **Document Root apontando para `/public`**. Isso é fundamental para a segurança.

```
/home/usuario/                   ← fora do document root (seguro)
├── salonmanager/
│   ├── app/
│   ├── config/
│   ├── core/
│   ├── database/
│   │   └── database.sqlite      ← banco de dados (protegido)
│   ├── public/                  ← document root do domínio
│   │   ├── index.php
│   │   ├── .htaccess
│   │   ├── assets/
│   │   └── uploads/             ← imagens enviadas (precisa de permissão de escrita)
│   └── routes/
```

---

## 🛠️ Passo a Passo — Hospedagem Compartilhada (cPanel)

### 1. Upload dos arquivos

Envie todos os arquivos do projeto para o servidor via **FTP (Filezilla)** ou pelo **Gerenciador de Arquivos** do cPanel:

```
Destino recomendado: /home/usuario/salonmanager/
```

> ⚠️ **NÃO coloque o projeto dentro de `public_html` diretamente.** Coloque a pasta raiz fora e aponte o domínio apenas para `/public`.

### 2. Apontar o domínio para `/public`

No cPanel, vá em **Domínios → Domínios** (ou **Subdomínios**) e configure o **Document Root** para:

```
/home/usuario/salonmanager/public
```

Para um subdomínio como `salon.seudominio.com.br`:
1. Adicione o subdomínio
2. Document Root: `/home/usuario/salonmanager/public`

### 3. Criar o banco de dados

Acesse o servidor via **SSH** ou pelo **Terminal do cPanel** e execute:

```bash
cd /home/usuario/salonmanager
php database/migrate.php
```

Isso criará o arquivo `database/database.sqlite` com a estrutura e os dados iniciais.

### 4. Permissões de escrita

O servidor web precisa ter permissão de escrita na pasta de uploads e no banco de dados:

```bash
chmod 755 public/uploads
chmod 664 database/database.sqlite
chmod 755 database/
```

### 5. Verificar o `.htaccess`

O arquivo `public/.htaccess` já está configurado para redirecionar tudo para `index.php`. Confirme que o `mod_rewrite` está ativo.

Conteúdo esperado do `public/.htaccess`:
```apache
Options -MultiViews
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
```

---

## 🖥️ Deploy em VPS Linux (Apache)

### 1. Instalar dependências

```bash
sudo apt update
sudo apt install php8.2 php8.2-sqlite3 php8.2-gd php8.2-cli apache2 -y
sudo a2enmod rewrite
```

### 2. Criar o VirtualHost

```bash
sudo nano /etc/apache2/sites-available/salonmanager.conf
```

```apache
<VirtualHost *:80>
    ServerName seudominio.com.br
    ServerAlias www.seudominio.com.br
    DocumentRoot /var/www/salonmanager/public

    <Directory /var/www/salonmanager/public>
        AllowOverride All
        Require all granted
        Options -Indexes
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/salonmanager_error.log
    CustomLog ${APACHE_LOG_DIR}/salonmanager_access.log combined
</VirtualHost>
```

```bash
sudo a2ensite salonmanager.conf
sudo systemctl reload apache2
```

### 3. Clonar e configurar

```bash
cd /var/www
git clone <url-do-repositório> salonmanager
cd salonmanager
php database/migrate.php
chmod 755 public/uploads
chmod 664 database/database.sqlite
sudo chown -R www-data:www-data /var/www/salonmanager
```

---

## 🖥️ Deploy em VPS Linux (Nginx)

### Configuração do bloco Nginx

```nginx
server {
    listen 80;
    server_name seudominio.com.br www.seudominio.com.br;
    root /var/www/salonmanager/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\. {
        deny all;
    }

    # Bloquear acesso direto ao banco de dados
    location ~* \.(sqlite|sql)$ {
        deny all;
    }
}
```

---

## 🐳 Deploy com Docker Swarm + Portainer + Traefik

Este é o método recomendado se você já possui a infraestrutura com **Portainer**, **Traefik** e **Docker Swarm**.

### Arquivos incluídos

| Arquivo | Descrição |
|---|---|
| `Dockerfile` | Build da imagem PHP 8.2 + Apache + SQLite + GD |
| `docker-compose.yml` | Stack Swarm compatível com Traefik e Portainer |

### 1. Criar os volumes externos (no VPS)

Antes de fazer o deploy, crie os volumes persistentes onde o banco de dados e os uploads ficarão armazenados:

```bash
docker volume create salonmanager_db
docker volume create salonmanager_uploads
```

### 2. Build e push da imagem

No seu ambiente local (ou no VPS):

```bash
# Build da imagem
docker build -t salonmanager:latest .

# Se usar um registry privado (ex: Docker Hub, GitLab Registry):
docker tag salonmanager:latest seu-usuario/salonmanager:latest
docker push seu-usuario/salonmanager:latest
```

> **Dica:** Se não usar registry, pode fazer o build direto no VPS via SSH: `git clone` + `docker build`.

### 3. Configurar o domínio no docker-compose.yml

Edite `docker-compose.yml` e substitua o placeholder pelo seu domínio real:

```yaml
# Antes:
- traefik.http.routers.salonmanager.rule=Host(`seudominio.com.br`)

# Depois:
- traefik.http.routers.salonmanager.rule=Host(`salon.seudominio.com.br`)
```

### 4. Inicializar o banco de dados

Após o primeiro deploy, execute a migração dentro do container:

```bash
# Descubra o ID do container
docker ps | grep salonmanager

# Execute a migração
docker exec -it <container_id> php database/migrate.php
```

### 5. Deploy via Portainer

1. Acesse o Portainer em `https://portainer.seudominio.com.br`
2. Vá em **Stacks → Add Stack**
3. Cole o conteúdo do `docker-compose.yml` ou aponte para o repositório Git
4. Clique em **Deploy the stack**

Ou via CLI diretamente no VPS:

```bash
docker stack deploy -c docker-compose.yml salonmanager
```

### 6. Verificar o deploy

```bash
# Status dos serviços
docker stack services salonmanager

# Logs em tempo real
docker service logs -f salonmanager_salonmanager
```

### Estrutura de volumes no VPS

```
/var/lib/docker/volumes/
├── salonmanager_db/        ← database/database.sqlite
└── salonmanager_uploads/   ← public/uploads/*
```

> ⚠️ Faça backup periódico dos volumes `salonmanager_db` e `salonmanager_uploads`.

---

## 🔒 HTTPS com Let's Encrypt

```bash
sudo apt install certbot python3-certbot-apache -y
sudo certbot --apache -d seudominio.com.br -d www.seudominio.com.br
```

Para Nginx:
```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d seudominio.com.br
```

---

## 🔑 Primeiro Acesso em Produção

1. Acesse `https://seudominio.com.br/login`
2. Use as credenciais padrão:  
   - Email: `admin@email.com`  
   - Senha: `admin123`
3. ⚠️ **Altere a senha imediatamente** em Configurações → Usuários.

---

## ⚙️ Configurações Pós-Deploy

### Alterar URL base (se necessário)

Edite `config/app.php` se o sistema não estiver na raiz do domínio:

```php
define('BASE_URL', 'https://seudominio.com.br');
```

### Pasta de Uploads

Confirme que `public/uploads/` existe e tem permissão de escrita. Se não existir:

```bash
mkdir -p public/uploads
chmod 755 public/uploads
chown www-data:www-data public/uploads
```

---

## 🔍 Checklist Final

- [ ] PHP 8.0+ instalado com extensões PDO, SQLite e GD
- [ ] Document Root apontando para `/public`
- [ ] `mod_rewrite` habilitado (Apache) ou `try_files` configurado (Nginx)
- [ ] `php database/migrate.php` executado com sucesso
- [ ] Pasta `public/uploads/` com permissão de escrita (`755`)
- [ ] `database/database.sqlite` com permissão de leitura e escrita (`664`)
- [ ] Senha do admin alterada no primeiro acesso
- [ ] HTTPS configurado com Let's Encrypt
- [ ] Google Tag Manager configurado em Admin → SEO & Rastreamento

---

## 🐛 Troubleshooting

| Problema | Causa provável | Solução |
|---|---|---|
| Página em branco | Erro PHP sem exibição | Verifique os logs em `/var/log/apache2/` |
| 404 em todas as rotas | `mod_rewrite` desativado | `sudo a2enmod rewrite` |
| Upload de imagem falha | Falta permissão na pasta | `chmod 755 public/uploads` |
| Erro de banco de dados | SQLite não encontrado ou sem permissão | Verifique extensão pdo_sqlite e permissão do arquivo |
| Rota `/admin` redireciona para login | Sessão expirada ou cookies bloqueados | Checar configuração de `session.save_path` no PHP |
