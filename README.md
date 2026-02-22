# Professional DevOps Portfolio - Valentin Thuillier

Modern, high-performance dynamic portfolio built with PHP 8.2 and SQLite. Optimized for DevOps engineers and tech professionals.

## 🚀 Quick Start (Docker)

The fastest way to deploy this portfolio is using Docker:

```bash
# Build the image
docker build -t portfolio-devops .

# Run the container
docker run -d -p 8080:80 --name portfolio portfolio-devops
```

Access the site at `http://localhost:8080`.

## 🛠 Tech Stack

- **Core**: PHP 8.2 (Custom MVC Routing)
- **Database**: SQLite 3 (PDO)
- **Frontend**: Tailwind CSS, Google Fonts (Outfit), Lucide-like icons
- **Server**: Apache with `mod_rewrite` enabled
- **Deployment**: Ready-to-use Dockerfile

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
