INSERT INTO users (name, email, password, role) VALUES ('Admin', 'admin@email.com', 'to_be_hashed', 'admin');
INSERT INTO users (name, email, password, role) VALUES ('Ana Recepcionista', 'recepcao@email.com', 'to_be_hashed', 'reception');
INSERT INTO users (name, email, password, role) VALUES ('Carlos Profissional', 'carlos@email.com', 'to_be_hashed', 'professional');

-- Professionals
INSERT INTO professionals (user_id, name, specialty, commission_percentage) VALUES (3, 'Carlos', 'Cabelo', 0.40);
INSERT INTO professionals (name, specialty, commission_percentage) VALUES ('Julia', 'Manicure', 0.50);
INSERT INTO professionals (name, specialty, commission_percentage) VALUES ('Roberto', 'Barbeiro', 0.35);

-- Customers
INSERT INTO customers (name, phone, email) VALUES ('Marina Oliveira', '11999999991', 'marina@test.com');
INSERT INTO customers (name, phone, email) VALUES ('Fernando Souza', '11999999992', '');
INSERT INTO customers (name, phone, email) VALUES ('Camila Costa', '11999999993', 'camila@test.com');
INSERT INTO customers (name, phone, email) VALUES ('Lucas Lima', '11999999994', '');
INSERT INTO customers (name, phone, email) VALUES ('Beatriz Santos', '11999999995', '');
INSERT INTO customers (name, phone, email) VALUES ('Renata Alves', '11999999996', '');
INSERT INTO customers (name, phone, email) VALUES ('Diego Martins', '11999999997', '');
INSERT INTO customers (name, phone, email) VALUES ('Tatiana Dias', '11999999998', '');
INSERT INTO customers (name, phone, email) VALUES ('Joao Pedro', '11999999999', '');
INSERT INTO customers (name, phone, email) VALUES ('Sofia Mendes', '11999999990', '');

-- Services
INSERT INTO services (name, description, price, duration) VALUES ('Corte Feminino', 'Corte completo com lavagem', 90.00, 60);
INSERT INTO services (name, description, price, duration) VALUES ('Corte Masculino', 'Corte máquina e tesoura', 45.00, 30);
INSERT INTO services (name, description, price, duration) VALUES ('Pé e Mão', 'Manicure e pedicure', 60.00, 60);
INSERT INTO services (name, description, price, duration) VALUES ('Coloração', 'Pintura completa', 150.00, 120);
INSERT INTO services (name, description, price, duration) VALUES ('Escova Progressiva', 'Alisamento térmico', 250.00, 180);

-- Products
INSERT INTO products (name, description, price, image) VALUES ('Shampoo Profissional', 'Shampoo para cabelos coloridos', 45.00, '/assets/images/shampoo.jpg');
INSERT INTO products (name, description, price, image) VALUES ('Condicionador Reparador', 'Condicionador pós química', 50.00, '/assets/images/condicionador.jpg');
INSERT INTO products (name, description, price, image) VALUES ('Máscara de Hidratação', 'Indicado para cabelos ressecados', 80.00, '/assets/images/mascara.jpg');
INSERT INTO products (name, description, price, image) VALUES ('Óleo de Argan', 'Sérum finalizador', 35.00, '/assets/images/oleo.jpg');
INSERT INTO products (name, description, price, image) VALUES ('Pomada Modeladora', 'Estilo matte', 40.00, '/assets/images/pomada.jpg');

-- Website Content
INSERT INTO website_content (section, title, subtitle, content, image) VALUES ('hero', 'Salão Beleza Pura', 'O salão perfeito para o seu estilo.', 'Você em primeiro lugar.', '');
INSERT INTO website_content (section, title, subtitle, content, image) VALUES ('who_we_are', 'Quem Somos', '', 'Temos os melhores profissionais.', '');
INSERT INTO website_content (section, title, subtitle, content, image) VALUES ('whatsapp_number', '', '', '5511999999999', '');
