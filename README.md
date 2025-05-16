# Laravel Task Manager

A simple task management application built with Laravel.

## Laravel Version

- Laravel 12.x 

## Features

- User authentication (register/login/logout)
- Create, edit, delete, and list tasks
- Filter tasks by status and priority
- Responsive UI with blue-lavender theme
- Modal forms for task creation and editing

## Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/your-repo.git](https://github.com/DevarshThacker/Laravel_TaskManager)
   cd Laravel_TaskMaager
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Copy `.env` file**
   ```bash
   cp .env.example .env
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Configure your database**  
   Edit `.env` and set your DB credentials.

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **(Optional) Seed the database**
   ```bash
   php artisan db:seed
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

## Database

- See `/database/migrations` for table structure.
- Use the provided SQL dump or run migrations.

## App Structure

- `app/Http/Controllers/TaskApiController.php` - Task CRUD logic
- `resources/views/` - Blade templates for UI
- `routes/web.php` - Web routes
- `public/` - Public assets

## License

MIT
