# Yoga Information Sharing Platform

A beautiful Laravel-based platform for sharing yoga-related information, pictures, and videos. This application allows users to create, share, and discover yoga content including poses, routines, meditation guides, and wellness tips.

## Features

- **Content Sharing**: Share yoga information, images, and videos
- **Categories**: Organize content by yoga types (Hatha, Vinyasa, Meditation, etc.)
- **Difficulty Levels**: Content categorized by beginner, intermediate, and advanced
- **User Management**: User registration and authentication
- **Responsive Design**: Beautiful, modern UI that works on all devices
- **File Upload**: Support for images and video uploads
- **Search & Filter**: Find content by category, difficulty, or duration

## Technology Stack

- **Backend**: Laravel 11 (PHP)
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: SQLite (development) / MySQL/PostgreSQL (production)
- **File Storage**: Laravel Storage with local/cloud options
- **Authentication**: Laravel Breeze (optional)

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM (for asset compilation)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd yoga-app
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Storage setup**
   ```bash
   php artisan storage:link
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

The application will be available at `http://127.0.0.1:8000`

## Project Structure

```
yoga-app/
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   └── YogaPost.php          # Yoga content model
│   ├── Http/Controllers/
│   │   └── YogaPostController.php # Yoga content management
│   └── Providers/
├── database/
│   ├── migrations/
│   │   └── create_yoga_posts_table.php
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── yoga/                 # Yoga-specific views
│   │   └── layouts/
│   ├── css/
│   └── js/
├── routes/
│   └── web.php                   # Application routes
├── storage/
│   └── app/public/               # Uploaded files
└── public/
```

## Database Schema

### Yoga Posts Table
- `id` - Primary key
- `title` - Post title
- `content` - Text content/description
- `image_path` - Path to uploaded image
- `video_path` - Path to uploaded video
- `category` - Yoga category (Hatha, Vinyasa, etc.)
- `difficulty_level` - Beginner, Intermediate, Advanced
- `duration` - Session duration in minutes
- `user_id` - Foreign key to users table
- `created_at` - Timestamp
- `updated_at` - Timestamp

## Usage

### For Content Creators
1. Register an account
2. Create new yoga posts with information, images, or videos
3. Categorize your content appropriately
4. Set difficulty levels for accessibility

### For Content Consumers
1. Browse yoga content by category
2. Filter by difficulty level
3. Search for specific poses or routines
4. View detailed information and media

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support, email support@yogaplatform.com or create an issue in the repository.

---

**Namaste** 🙏 - May your yoga journey be filled with peace and wellness.
