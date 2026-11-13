# Barangay Alert and Rescue System (BARS)

Laravel mini-capstone prototype for emergency reporting, response coordination, and alert tracking.

## GitHub
Repository: https://github.com/opelobello68/barangay-alert-rescue-system

## Local development

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan serve
```

## Demo accounts

- Admin: `admin@bars.test` / `password`
- Responder: `responder@bars.test` / `password`
- Resident: `resident@bars.test` / `password`

Change these credentials before any real-world deployment.

## Render deployment

This repository includes `Dockerfile`, `render.yaml`, and `docker/entrypoint.sh` for deployment on Render.

1. Push this project to GitHub.
2. In Render, create a Blueprint from this repository, or create a Docker Web Service using the repository.
3. Use the `main` branch.
4. The Blueprint creates a free PostgreSQL database and a free Docker web service.
5. Render supplies the database environment variables and generates `APP_KEY`.
6. The container runs `php artisan migrate --force` and `php artisan storage:link` on startup.

**Free-tier note:** Render's free web service can spin down after 15 minutes of inactivity, and the free PostgreSQL database expires after 30 days. Uploaded files on the free web service are also ephemeral. This configuration is intended for classroom/capstone demonstration and testing, not production emergency services.
