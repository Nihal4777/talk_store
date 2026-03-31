# Talk Store

Talk Store is a Laravel-based web application for selling guided conversation content and live expert chat time.

The product has two main experiences:

- Users can buy scripted "talks" and practice them line by line.
- Users can buy minutes and start a real-time chat session with an available expert.

This repository includes the storefront, admin panel, user purchase flow, expert availability flow, and the backend logic for payments and real-time messaging.

## Features

### Public storefront
- Browse all talks from the home page.
- Filter talks by category.
- View talk artwork, title, pricing, and description.

### Scripted talk practice
- Purchase a talk with Razorpay.
- Open a private conversation page after purchase.
- Step through a predefined script stored in the database.
- Compare the user's submitted line with the expected line and return a simple similarity score.
- Track progress per purchased talk.

### Live expert chat
- Purchase chat minutes separately.
- View experts who are currently online and not busy.
- Start a one-to-one real-time chat session with an expert.
- Track active sessions and deduct minutes based on session length.
- Broadcast connection, disconnection, and message events using Pusher presence channels.

### Admin tools
- Manage categories.
- Create, edit, and delete talks.
- Upload talk images.
- Manage expert accounts.
- Review purchased talks.

### Auth and roles
- Laravel Breeze-based authentication.
- Email verification enabled.
- Role-based access with `admin`, `user`, and `expert` using Spatie Laravel Permission.

## Tech stack

- PHP 8+
- Laravel 9
- Blade templates
- Vite
- Tailwind CSS
- Alpine.js
- MySQL
- Razorpay
- Pusher
- Spatie Laravel Permission
- Laravel Sanctum

## Project structure

- `app/Http/Controllers`
  Contains storefront, admin, payment, API, and live chat controllers.
- `app/Models`
  Contains the core domain models such as `Talk`, `Order`, `MinutesPurchase`, `OnlineUser`, and `UserHasExpert`.
- `database/migrations`
  Defines schema for talks, talk script lines, purchases, chat sessions, expert presence, and roles.
- `resources/views`
  Blade views for the public site, auth, admin screens, purchases, and chat pages.
- `routes/web.php`
  Web routes for storefront, admin actions, purchases, and expert chat.
- `routes/api.php`
  API endpoints used for scripted talk progression and live chat messaging.

## Core domain model

### Roles
- `admin`: manages talks, categories, and experts.
- `user`: purchases talks and live chat minutes.
- `expert`: appears online and handles real-time chat sessions.

### Main tables
- `users`
- `categories`
- `talks`
- `talks_messages`
- `orders`
- `chat_messages`
- `minute_purchases`
- `sessions`
- `messages`
- `online_users`

## Key flows

### 1. Buy and practice a talk
1. User browses talks.
2. User creates a Razorpay order for a talk.
3. Payment is verified and stored in `orders`.
4. User opens the conversation page for that purchased talk.
5. The app seeds the first line of the script if the conversation is new.
6. Each submitted message is compared with the expected line and progress is updated.

### 2. Buy minutes and start expert chat
1. User purchases minutes through Razorpay.
2. Verified payment increases the user's minute balance.
3. Experts mark themselves available by joining the waiting presence channel.
4. User chooses an available expert.
5. A session record is created in `sessions` and the expert is marked busy.
6. Messages are exchanged over Pusher channels and stored in the database.
7. When the session ends, minutes are deducted from the user balance.

## Important environment variables

Start from `.env.example` and add the values below.

### Application
- `APP_NAME`
- `APP_ENV`
- `APP_KEY`
- `APP_URL`

### Database
- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

### Mail
Used when the admin adds an expert and the app emails generated credentials.

- `MAIL_MAILER`
- `MAIL_HOST`
- `MAIL_PORT`
- `MAIL_USERNAME`
- `MAIL_PASSWORD`
- `MAIL_FROM_ADDRESS`
- `MAIL_FROM_NAME`

### Pusher
Required for live expert presence and real-time chat.

- `BROADCAST_DRIVER=pusher`
- `PUSHER_APP_ID`
- `PUSHER_APP_KEY`
- `PUSHER_APP_SECRET`
- `PUSHER_HOST`
- `PUSHER_PORT`
- `PUSHER_SCHEME`
- `PUSHER_APP_CLUSTER`
- `VITE_PUSHER_APP_KEY`
- `VITE_PUSHER_HOST`
- `VITE_PUSHER_PORT`
- `VITE_PUSHER_SCHEME`
- `VITE_PUSHER_APP_CLUSTER`

### Razorpay
Required for both talk purchases and minute purchases.

- `RAZORPAY_KEY`
- `RAZORPAY_SECRET`

### Chat billing
- `RATE_PER_MIN`

## Local setup

### 1. Install dependencies
```bash
composer install
npm install
```

### 2. Create environment file
```bash
cp .env.example .env
php artisan key:generate
```

On Windows PowerShell, use:
```powershell
Copy-Item .env.example .env
php artisan key:generate
```

### 3. Configure database and services
Update `.env` with your MySQL, mail, Pusher, Razorpay, and `RATE_PER_MIN` values.

### 4. Run migrations and seed roles
```bash
php artisan migrate
php artisan db:seed
```

The default seed creates:
- Admin email: `admin@example.com`
- Admin password: `admin@123`

Change these credentials immediately outside of local development.

### 5. Build frontend assets
```bash
npm run dev
```

For a production build:
```bash
npm run build
```

### 6. Run the app
```bash
php artisan serve
```

## Default routes

### Public
- `/` - home page
- `/talks` - talk listing page

### User
- `/purchases` - purchased talks
- `/talk/chat/{talk_id}` - scripted talk conversation page
- `/realTimeChat/experts` - available expert list

### Expert
- `/expert/liveChat` - expert waiting/live chat page

### Admin
- `/dashboard`
- `/admin/categories`
- `/admin/talks`
- `/admin/purchases/talks`
- `/admin/experts`

## API endpoints

Authenticated users with `user` or `expert` role can access:

- `POST /api/sendMessage` - continue a scripted talk
- `POST /api/sendChatMessage` - send a live chat message
