## Inicializar o projeto

Siga os seguintes passos para setar o projeto

- composer install
- php artisan ui bootstrap --auth
- npm install
- npm run dev
- php artisan migrate
- php artisan db:seed

Para logar no sistema é só utilizar:

- Usuário: teste@teste.com
- Senha: admin123

Para subir uma base de dados é só rodar o comando 

- docker-compose up -d

Isso vai subir um container do docker com a imagem do Mysql 5.7, com as seguintes configurações

- URL: 127.0.0.1
- Senha root: MaYc6PPuqPwwxk2J
- Usuário: cit
- Senha Usuário: njhFjX6j