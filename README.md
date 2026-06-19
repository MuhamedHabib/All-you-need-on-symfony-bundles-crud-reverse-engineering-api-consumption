# Symfony Essentials — Bundles, CRUD, Reverse Engineering & API Consumption

> A hands-on Symfony 4.4 reference project covering bundles, Doctrine CRUD, database reverse engineering, forms & validation, and entities prepared for mobile/API consumption.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Symfony](https://img.shields.io/badge/Symfony-000000?style=for-the-badge&logo=symfony&logoColor=white)
![Doctrine](https://img.shields.io/badge/Doctrine-FC6A31?style=for-the-badge&logo=doctrine&logoColor=white)
![Twig](https://img.shields.io/badge/Twig-3776AB?style=for-the-badge&logo=twig&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

## Overview

This repository is a learning and reference project built on **Symfony 4.4 LTS**. It walks through the everyday building blocks of a Symfony web application: registering and using bundles, modelling entities with Doctrine ORM, generating full CRUD interfaces, reverse-engineering a database through migrations, handling forms with validation, sending emails, rendering charts, and shaping entities so they can later be exposed to and consumed by API/mobile clients.

It is intentionally small and readable — a place to study how the pieces fit together rather than a production application.

## Topics Covered

Each topic below is grounded in the actual code in this repository.

### Bundles
The project assembles a real-world bundle stack (see `config/bundles.php`):
- **FrameworkBundle**, **TwigBundle** — core HTTP, routing, and templating.
- **DoctrineBundle** + **DoctrineMigrationsBundle** — ORM and schema versioning.
- **SecurityBundle** — security/firewall configuration.
- **MakerBundle** — scaffolding entities, CRUD, and forms via the CLI.
- **SwiftmailerBundle** — sending emails from controllers.
- **SensioFrameworkExtraBundle** — annotation-based routing and conventions.
- **ChartjsBundle** (Symfony UX) and **CMENGoogleChartsBundle** — rendering charts in Twig.
- **MonologBundle**, **DebugBundle**, **WebProfilerBundle**, **DoctrineFixturesBundle** (dev/test).

### CRUD
Full create / read / update / delete flows wired through controllers, forms, repositories, and Twig templates:
- `FormController` — CRUD over the `Formulaire` entity (`/form`), plus a pie chart of records grouped by `Sexe`.
- `QuestionsController` — CRUD over the `Questionss` entity (`/questions`), including CSRF-protected delete actions.
- Matching Twig templates under `templates/form/` and `templates/questions/` (`index`, `new`, `edit`, `show`, `_form`, `_delete_form`).

### Database Reverse Engineering
The `migrations/` folder shows schema evolution driven by Doctrine migrations (`Version2021…`), including `ALTER TABLE` operations such as adding/dropping columns and adjusting character sets/collation. Combined with `bin/console doctrine:mapping:import` / `make:entity`, this illustrates the round-trip between an existing database schema and annotated Doctrine entities (`src/Entity/`).

### Forms & Validation
Symfony Form types in `src/Form/` (`ContactType`, `FormulaireType`, `QuestionssType`) bound to entities, with validation constraints declared as annotations on the entities (e.g. `@Assert\NotBlank`, `@Assert\Length`, `@Assert\Positive` on `Formulaire`).

### Email
`ContactController` builds and sends messages via Swift Mailer, rendering the body from Twig email templates under `templates/emails/` and `templates/emailTemplate/`.

### Charts
`FormController` uses a custom repository query (`FormulaireRepository::filter()`) to aggregate data and feed a Google `PieChart`, rendered in the form index view.

### API / Mobile Consumption
The entities and CRUD layer are structured so they can be exposed to API/mobile clients. Doctrine entities (`Contact`, `Formulaire`, `Questionss`) provide clean getters/setters, and the `symfony/serializer` component is available in the stack — the foundation for serving JSON to a mobile front-end.

## Tech Stack

| Layer | Technology |
|-------|------------|
| Language | PHP `>= 7.1.3` |
| Framework | Symfony `4.4.*` (LTS) |
| ORM | Doctrine ORM `^2.10` + Doctrine Migrations |
| Templating | Twig `^2.12 \|\| ^3.0` |
| Database | MySQL (migrations use MySQL DDL); PostgreSQL available via the bundled Docker Compose |
| Mailing | Swift Mailer |
| Charts | Symfony UX Chart.js + CMEN Google Charts |
| Tooling | Composer, Symfony CLI, Symfony Maker, PHPUnit `^9.5` |

## Project Structure

```
.
├── bin/                     # Symfony console entry point
├── config/
│   ├── bundles.php          # Registered bundles
│   ├── packages/            # Per-bundle configuration (doctrine, twig, security, mailer…)
│   └── routes/              # Routing (annotations + YAML)
├── migrations/              # Doctrine migration versions (schema evolution)
├── public/                  # Web root (index.php, assets)
├── src/
│   ├── Controller/          # Admin, Base, Contact, Fin, Form, Questions, Salutation
│   ├── Entity/              # Contact, Formulaire, Questionss
│   ├── Form/                # Form types (Contact, Formulaire, Questionss)
│   ├── Repository/          # Doctrine repositories (custom queries, e.g. filter())
│   └── Kernel.php
├── templates/               # Twig views (CRUD, emails, admin, base layouts)
├── tests/                   # PHPUnit test scaffold
├── translations/            # Translation catalog directory
├── composer.json            # Dependencies & autoload
├── docker-compose.yml       # Database (+ mailcatcher in override)
└── phpunit.xml.dist
```

## Getting Started

### Prerequisites
- PHP `>= 7.1.3` (with `ctype`, `iconv` extensions)
- [Composer](https://getcomposer.org/)
- [Symfony CLI](https://symfony.com/download)
- MySQL (or PostgreSQL) — optionally via Docker

### 1. Clone & install dependencies
```bash
git clone https://github.com/MuhamedHabib/All-you-need-on-symfony-bundles-crud-reverse-engineering-api-consumption.git
cd All-you-need-on-symfony-bundles-crud-reverse-engineering-api-consumption
composer install
```

### 2. Configure environment
Copy `.env` to `.env.local` and set your own values (never commit real credentials):
```bash
cp .env .env.local
```
Then edit `.env.local` to provide your `DATABASE_URL`, `MAILER_URL`, and `APP_SECRET`. A MySQL URL takes the form:
```
DATABASE_URL="mysql://user:password@127.0.0.1:3306/dbname?serverVersion=…"
```

> Optionally start a database (and a Mailcatcher inbox) with Docker:
> ```bash
> docker compose up -d
> ```

### 3. Create the schema & run migrations
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 4. Run the application
```bash
symfony serve
# or
php bin/console server:run
```
Then visit `http://localhost:8000`.

### 5. (Optional) Run tests
```bash
php bin/phpunit
```

## Notes

- This is an educational/reference project on **Symfony 4.4 LTS** — expect older patterns compared to newer Symfony (e.g. Swift Mailer instead of Symfony Mailer, annotation routing instead of PHP attributes).
- No secrets are included here. The `.env` file ships only placeholder keys; always set real values in `.env.local`, which is gitignored.
- Some entity properties and UI strings are in French (the project's original language); the surrounding code and this guide are in English.
- Console helpers behind the topics above: `php bin/console make:entity`, `make:crud`, and `doctrine:mapping:import`.

---
<p align="center">Built by <b>Mohamed Habib Khattat</b> — <a href="https://github.com/MuhamedHabib">GitHub (@MuhamedHabib)</a> · <a href="https://www.linkedin.com/in/mohamed-habib-khattat-2b206a173">LinkedIn</a></p>
