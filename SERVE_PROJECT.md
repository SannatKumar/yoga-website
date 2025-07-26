# How to Serve the Yoga App Project

## Prerequisites
- PHP (8.1 or newer recommended)
- Composer
- Node.js & npm

## 1. Install Dependencies

```
composer install
npm install
```

## 2. Serve the Backend (Laravel)

```
php artisan serve
```
- This will start the backend at: http://127.0.0.1:8000

## 3. Serve the Frontend (Vite)

```
npm run dev
```
- By default, this starts the frontend at: http://localhost:5173/
- If you see a 'cannot be reached' error, try:
  - Running on a different port: `npm run dev -- --port=5174`
  - Checking for errors in the terminal
  - Ensuring no firewall or antivirus is blocking the port

## 4. Access the App
- Open your browser and go to: http://localhost:5173/
- The backend API is available at: http://127.0.0.1:8000

## Troubleshooting
- If you see errors about missing dependencies, re-run `npm install` and `composer install`.
- If the port is in use, try a different port as shown above.
- If you are on a different network or using a VM, use the network address shown in the terminal output. 