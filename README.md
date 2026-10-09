# Job Listing Panel

A web-based Job Listing and Recruitment Management System built using Laravel. This application connects job seekers with recruiters and provides job posting, candidate search, job applications, profile management, and email notifications.

**GitHub Repository:** https://github.com/KarthiKDev00/job_listing

## Features

### 1. Job Seeker Portal

* Job seeker registration, login, and logout.
* Manage profile information:

  * Name
  * Email
  * Phone
  * Experience in years
  * Notice period in days
  * Skills
  * Job location
  * Resume upload
  * Profile photo upload
* View active job openings.
* Search and filter jobs by:

  * Skills
  * Company name
  * Minimum experience
  * Maximum experience
  * Location
* Apply for available jobs.
* View submitted job applications.
* View and update profile information.

### 2. Recruiter Portal

* Recruiter registration, login, and logout.
* Manage company profile information:

  * Company name
  * Email
  * Phone
  * Address
* Create, view, update, and delete job postings.
* Activate or deactivate job postings.
* Search candidates using:

  * Skills
  * Notice period (less than or equal to the specified days)
  * Minimum experience (greater than or equal to the specified years)
  * Maximum experience (less than or equal to the specified years)
  * Location
* View candidates who applied for the recruiter's jobs.
* View candidate details.
* Download candidate resumes.
* Receive email notifications when candidates apply for jobs.

### 3. Job Application Workflow

1. A recruiter creates a job posting.
2. The recruiter sets the job status to Active.
3. Job seekers browse and filter active jobs.
4. A job seeker applies for a suitable job.
5. The application is saved in the database.
6. A Laravel queued job processes the email notification.
7. The recruiter receives an email containing the candidate's details.
8. The recruiter views the application in the Applied Jobs section.

Duplicate applications for the same job are prevented by the application logic.

## Technology Stack and Versions

The following versions are based on the project environment information currently available. Verify the installed package versions before deploying or reproducing the project on another machine.

| Technology                     | Purpose                                 | Version                  |
| ------------------------------ | --------------------------------------- | ------------------------ |
| Laravel                        | Backend framework                       | 13.35.0                  |
| PHP                            | Backend programming language            | 8.4.24                   |
| MySQL / MariaDB                | Relational database                     | Verify installed version |
| Composer                       | PHP dependency management               | Verify installed version |
| Node.js                        | JavaScript runtime and frontend tooling | Verify installed version |
| npm                            | Frontend package management             | Verify installed version |
| Blade                          | Server-side templating                  | Included with Laravel    |
| HTML5                          | Page structure                          | HTML5                    |
| CSS3                           | Page styling                            | CSS3                     |
| Laravel session authentication | User authentication                     | Laravel-integrated       |
| Eloquent ORM                   | Database queries and relationships      | Laravel-integrated       |
| Laravel Migrations and Seeders | Database schema and initial data        | Laravel-integrated       |
| Laravel Mail                   | Email notifications                     | Laravel-integrated       |
| Laravel Jobs and Queues        | Background email processing             | Laravel-integrated       |
| Laravel Public Storage         | Uploaded resumes and profile photos     | Laravel-integrated       |
| Laravel Breeze                 | Authentication scaffolding              | Verify `composer.json`   |
| Vite                           | Frontend asset development and building | Verify `package.json`    |
| Tailwind CSS                   | Utility-based styling                   | Verify `package.json`    |

**Version verification commands:**

```bash
php artisan --version
php -v
composer --version
node -v
npm -v
```

To check the database version, run the following query in MySQL or MariaDB:

```sql
SELECT VERSION();
```

To verify the installed Laravel and frontend packages:

```bash
composer show laravel/framework
composer show laravel/breeze
npm list vite laravel-vite-plugin tailwindcss
```

A package should only be listed as an installed dependency if it is present in the project.

## Technical Implementation

The application uses the following Laravel features and implementation practices:

* **Migrations:** Create and manage database tables.
* **Seeders:** Populate the location dropdown with 10 cities.
* **Middleware:** Restrict recruiter and job seeker routes according to user roles.
* **Form validation:** Validate registration, profile updates, job postings, and candidate search filters.
* **Eloquent relationships:** Connect users, recruiters, job seekers, locations, job postings, and applications.
* **Jobs and Queues:** Process application email notifications in the background.
* **Laravel Mail:** Send job application notifications to recruiters.
* **Custom helper function:** Generate file URLs for uploaded documents and profile photos.
* **Public storage:** Store and serve uploaded resumes and profile photos.

## Database Structure

The main database tables are:

| Table              | Purpose                                                           |
| ------------------ | ----------------------------------------------------------------- |
| `users`            | Stores user account details, login credentials, and roles         |
| `locations`        | Stores available job locations                                    |
| `job_seekers`      | Stores job seeker profile information                             |
| `recruiters`       | Stores recruiter and company information                          |
| `job_posts`        | Stores job postings created by recruiters                         |
| `job_applications` | Stores job application records                                    |
| `jobs`             | Used for queued jobs when the database queue driver is configured |

The `jobs` table is used for Laravel's database queue only if that queue configuration and migration are present. It is separate from the application's `job_posts` table.

Eloquent relationships associate each job posting with its recruiter and each application with the corresponding job and job seeker.

## Requirements

Ensure the following are installed:

* PHP compatible with the installed Laravel version
* Composer
* MySQL or MariaDB
* Node.js and npm
* Git
* A configured SMTP email account for sending notifications

## Installation and Setup

### 1. Clone the Repository

```bash
git clone https://github.com/KarthiKDev00/job_listing.git
cd job_listing
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Configure Environment Variables

Create your local environment file.

**Windows PowerShell:**

```powershell
Copy-Item .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Configure the Database

Create a database named `job_listing` in MySQL or MariaDB.

Update the database settings in `.env`:

```env
APP_NAME="Job Listing Panel"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_listing
DB_USERNAME=root
DB_PASSWORD=
```

Adjust the database username and password according to your local environment.

Do not use `APP_DEBUG=true` in production.

### 5. Run Database Migrations

```bash
php artisan migrate
```

This creates the database tables defined by the project's migrations.

### 6. Seed Locations

If `DatabaseSeeder.php` is configured to call `LocationSeeder`, run:

```bash
php artisan db:seed
```

Alternatively, run the location seeder directly:

```bash
php artisan db:seed --class=LocationSeeder
```

Use the appropriate command for your project configuration. Avoid running non-idempotent seeders repeatedly, as they may insert duplicate locations.

### 7. Configure File Storage

Create the public storage symbolic link:

```bash
php artisan storage:link
```

Uploaded photos and resumes stored on Laravel's public disk can then be accessed through the storage link, subject to the application's file access and validation rules.

### 8. Install Frontend Dependencies

Install the Node.js dependencies:

```bash
npm install
```

Build the frontend assets:

```bash
npm run build
```

For development, if the project has a Vite development script:

```bash
npm run dev
```

Check `package.json` to confirm the available npm scripts.

### 9. Configure Email

Update the SMTP settings in `.env` using credentials from your email provider.

Example Gmail configuration:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=angayarkanni.nplus23@gmail.com
MAIL_PASSWORD=hsdwgpizavzdezed
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=angayarkanni.nplus23@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

Replace the example values with valid SMTP credentials. For Gmail, use an App Password where required.

**Security requirements:**

* Never commit real email passwords or App Passwords to Git.
* Keep credentials in the local `.env` file or a secure deployment secret store.
* Ensure `.env` is excluded from version control.
* If a credential has already been exposed, revoke it and generate a replacement.

Clear the configuration cache after changing environment variables:

```bash
php artisan config:clear
```

### 10. Configure the Queue

Set the queue connection in `.env`:

```env
QUEUE_CONNECTION=database
```

Check whether the database queue migration exists. If it does not, create it using the queue migration command supported by the installed Laravel version. For Laravel installations that provide it, the command is:

```bash
php artisan make:queue-table
```

Then run:

```bash
php artisan migrate
```

Do not create a duplicate queue migration if one already exists.

Start the queue worker in a separate terminal:

```bash
php artisan queue:work
```

The queue worker must remain running for queued application email notifications to be processed.

### 11. Start the Application

Start the Laravel development server:

```bash
php artisan serve
```

Open the application in your browser:

http://127.0.0.1:8000

## Main Application Routes

The following are the expected application routes. Confirm the registered routes using `php artisan route:list`.

### Public Routes

| Page                    | URL                    |
| ----------------------- | ---------------------- |
| Home                    | `/`                    |
| Job Seeker Registration | `/register/job-seeker` |
| Recruiter Registration  | `/register/recruiter`  |
| Login                   | `/login`               |

### Recruiter Routes

| Page              | URL                       |
| ----------------- | ------------------------- |
| Dashboard         | `/recruiter/dashboard`    |
| Manage Jobs       | `/recruiter/jobs`         |
| Create Job        | `/recruiter/jobs/create`  |
| Find Candidates   | `/recruiter/candidates`   |
| Applied Jobs      | `/recruiter/applications` |
| Recruiter Profile | `/recruiter/profile`      |

### Job Seeker Routes

| Page               | URL                        |
| ------------------ | -------------------------- |
| Dashboard          | `/job-seeker/dashboard`    |
| Find Jobs          | `/job-seeker/jobs`         |
| My Applications    | `/job-seeker/applications` |
| Job Seeker Profile | `/job-seeker/profile`      |

Routes that require authentication or a specific role are protected by the corresponding middleware.

## Usage

### For Job Seekers

1. Register using the Job Seeker registration page.
2. Upload a resume and profile photo.
3. Log in to the application.
4. Browse and filter active jobs.
5. Apply for jobs that match your skills and experience.
6. View submitted applications in My Applications.
7. Update profile information when required.

### For Recruiters

1. Register using the Recruiter registration page.
2. Log in to the application.
3. Create and manage job postings.
4. Set suitable job postings to Active.
5. Search for candidates using the available filters.
6. View applicants under Applied Jobs.
7. Download candidate resumes.
8. Receive email notifications for new applications.

## Security and Validation

* Passwords are stored using Laravel's password hashing mechanisms.
* Form inputs are validated before database operations.
* Resume and photo uploads are subject to file type and size validation.
* Recruiters should only be able to manage their own job postings.
* Role-based middleware protects recruiter and job seeker pages.
* Duplicate job applications are checked before inserting new records.
* Environment secrets and SMTP credentials must not be committed to version control.
* Production deployments should use secure environment settings and disable debug output.

## Troubleshooting

### Database Connection Error

Check the database service, database name, port, username, and password in `.env`.

Run:

```bash
php artisan config:clear
php artisan migrate:status
```

### Uploaded Photos or Resumes Not Displaying

Run:

```bash
php artisan storage:link
```

Verify that the uploaded files exist on the configured storage disk and that the public storage link is working.

### Application Email Not Received

Check the SMTP configuration and confirm that the queue worker is running:

```bash
php artisan queue:work
```

If the application uses the database queue, inspect failed jobs:

```bash
php artisan queue:failed
```

Review Laravel logs in:

```text
storage/logs/laravel.log
```

### Route Changes Not Appearing

Clear the route cache and list the registered routes:

```bash
php artisan route:clear
php artisan route:list
```

### Frontend Assets Not Loading

Install dependencies and rebuild the assets:

```bash
npm install
npm run build
```

Confirm that `package.json` contains the expected build scripts.

## Development Notes

* Use migrations to manage database schema changes.
* Run the appropriate seeders to populate location data.
* Keep SMTP credentials in environment variables.
* Test both recruiter and job seeker workflows.
* Verify email delivery before deployment.
* Keep dependencies and runtime versions compatible with the Laravel version used.
* Configure a production-ready queue worker when deploying the application.

## License

This project was developed as a Job Listing Panel application. The Laravel framework is open-source software distributed under the MIT License.

The licensing terms for this application and its third-party dependencies should be confirmed before redistribution.
