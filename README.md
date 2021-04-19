# react-rss-reader
RSS News Reader build with Symfony 5, API Plateform and React

🚨 Still in development 🚨

## Installation

Start docker
```bash
docker-compose up -d
```

Install vendors with composer
```bash
composer install
```

Build assets with yarn
```bash
yarn build
```

Create the database and create the tables
```bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
```

Load fixtures
```bash
php bin/console doctrine:fixtures:load
```

Fetch feeds
```bash
php bin/console app:feed:fetch
```

Open your browser
```bash
firefox http://localhost:8000/
```