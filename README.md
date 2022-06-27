![alt text](https://github.com/llcoollasa/sduinews/blob/main/public/images/logo.png?raw=true)

## Sdui News

Manage user based News using Laravel inbuilt authentication system.

- Laravel user registration and authentication
- Sqlite database (Added to the Repo under database directory)
- News management using CRUD

  
## Project Setup

```
composer install

cp .env.example .env

php artisan key:generate

php artisan serve
```

*If styles not working in dashboard, please run below*

```
npm install && npm run dev
```

## Tests

```
php artisan test
```

## Cron Job

Created Command `news:cron` and assigned it to run daily as a cron job

Start the cron job
```
php artisan schedule:work
```

List the scheduled jobs
```
php artisan schedule:list
```

Run the command directly from CLI
```
php artisan news:cron 
```

## Application walkthrough

- Main page (ex: http://127.0.0.1:8000) will contain all the news posted by all the Users.
- Please use following user details to logged in to the dashboard and use existing data
- Logged in Users can add new News items and view them
- Logged in Users can Edit/Delete News items only belongs to the current user
- Creating new post will trigger `NewsCreated` event and listener will just logging the event details in `SendNewsCreatedNotification`
- Used soft delete in models
- Running the cron job will delete News older than 14 days

## Users

Sqlite database already has following users with the news records.

| User Email                    | Password  |
| ------------------------------|-----------|
| caterina.berge@example.net    | password  |
| tschmeler@example.com         | password  |
| user1@somewhere.de	        | 123456789 |
