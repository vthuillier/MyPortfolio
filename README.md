# Professional DevOps Portfolio - Valentin Thuillier

Modern, high-performance dynamic portfolio built with PHP 8.2 and SQLite. Optimized for DevOps engineers and tech professionals.

## 🚀 Quick Start (Docker Compose)

The recommended way to deploy with a persistent database (PostgreSQL or MariaDB) is using Docker Compose:

```bash
# Start the services
docker-compose up -d

# Initialize the database (first-time only)
docker-compose exec app php init_db.php
```

Access the site at `http://localhost:8080`.

## 🛠 Tech Stack

- **Core**: PHP 8.2 (Custom MVC Routing)
- **Database**: SQLite 3, **PostgreSQL**, or **MariaDB/MySQL** (PDO)
- **Frontend**: Tailwind CSS, Google Fonts (Outfit)
- **Server**: Apache with `mod_rewrite` enabled
- **DevOps**: Docker & Docker Compose with persistent backup volumes

## 🔧 Manual Installation

1. **DB Init**: Ensure `php-sqlite3` is installed, then run:
   ```bash
   php init_db.php
   ```
2. **Local Server**:
   ```bash
   php -S localhost:8080 -t public/
   ```

## 🔐 Administration

- **Route**: `/login`
- **Identity**: `admin`
- **Key**: `admin123`

## 📁 Repository Structure

- `src/` : Application logic (Controllers, Models, Helpers).
- `public/` : Web root (index.php, CSS, Uploads).
- `database/` : Persistence layer.
- `Dockerfile` : Production-ready container config.
