# Job Listing

A web-based Job Listing and Recruitment Management System built using Laravel. The application connects job seekers with recruiters and provides job posting, candidate search, job applications, and email notifications.

## Features

### 1. Job Seeker Portal

* Job seeker registration and login.
* Profile information:

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

* Recruiter registration and login.
* Company profile management:

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
* View candidate details and download resumes.
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

## Technology Stack

* **Backend:** Laravel
* **Programming Language:** PHP
* **Database:** MySQL / MariaDB
* **Frontend:** Blade templates, HTML, CSS
* **Authentication:** Laravel session-based authentication
* **Database Management:** Laravel migrations and seeders
* **Background Processing:** Laravel Jobs and Queues
* **Email Notifications:** Laravel Mail
* **File Storage:** Laravel public storage

## Technical Implementation

The application uses:

* Laravel migrations to create and manage database tables.
* A location seeder to populate the location dropdown with 10 cities.
* Middleware to restrict recruiter and job seeker routes based on user roles.
* Form validation to validate registration, profile updates, job postings, and candidate search filters.
* Eloquent relationships to connect users, recruiters, job seekers, locations, jobs, and applications.
* Laravel Jobs and Queues to process application email notifications.
* A custom helper function for generating file URLs.

## Database Structure

The main database tables are:

| Table              | Purpose                                                             |
| ------------------ | ------------------------------------------------------------------- |
| `users`            | Stores login credentials and user roles                             |
| `locations`        | Stores available job locations                                      |
| `job_seekers`      | Stores job seeker profile information                               |
| `recruiters`       | Stores recruiter and company information                            |
| `job_posts`        | Stores job postings created by recruiters                           |
| `job_applications` | Stores job application records                                      |
| `jobs`             | Laravel database queue table, if enabled by the queue configuration |

The application uses Eloquent relationships to associate each job with its recruiter and each application with the corresponding job and job seeker.

## Requirements

Ensure the following are installed:

* PHP version compatible with the installed Laravel version
* Composer
* MySQL or MariaDB
* Node.js and npm
* A configured SMTP email account for sending notifications

## Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd job-listing
```

Replace `<repository-url>` with your Git repository URL.

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Configure Environment Variables

Create the environment file:

```bash
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Configure the Database

Create a database named `job_listing` in MySQL or MariaDB.

Update the following settings in `.env`:

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

Update the database username and password according to your local environment.

### 5. Run Database Migrations

```bash
php artisan migrate
```

### 6. Seed Locations

If the location seeder is configured in `DatabaseSeeder.php`, run:

```bash
php artisan db:seed
```

Alternatively, run the location seeder directly:

```bash
php artisan db:seed --class=LocationSeeder
```

Run only the appropriate command to avoid inserting duplicate location records.

### 7. Configure File Storage

Create the public storage link:

```bash
php artisan storage:link
```

Uploaded photos and resumes can then be served through Laravel's public storage disk.

### 8. Install Frontend Dependencies

```bash
npm install
```

Build frontend assets:

```bash
npm run build
```

For frontend development, if the project supports the Vite development server:

```bash
npm run dev
```

### 9. Configure Email

Update the SMTP settings in `.env` using the credentials supplied by your email provider.

Example for Gmail:

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

Use a valid Gmail App Password or the credentials required by your SMTP provider. Do not commit real credentials to Git.

Clear the configuration cache after updating the settings:

```bash
php artisan config:clear
```

### 10. Configure the Queue

Set the queue connection in `.env`:

```env
QUEUE_CONNECTION=database
```

Ensure the database queue migration exists. If it does not, create it using the queue-table command supported by your Laravel installation, then run:

```bash
php artisan migrate
```

Start the queue worker in a separate terminal:

```bash
php artisan queue:work
```

The queue worker must be running for queued application email notifications to be processed.

### 11. Start the Application

Run the Laravel development server:

```bash
php artisan serve
```

Open the application:

http://127.0.0.1:8000

## Main Application Routes

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

Routes are protected by authentication and role-based middleware where required.

## Usage

### For Job Seekers

1. Register using the Job Seeker registration page.
2. Upload a resume and profile photo.
3. Log in to the application.
4. Browse and filter active jobs.
5. Apply for jobs that match your experience and skills.
6. View submitted applications in My Applications.

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

* Passwords are stored using Laravel's password hashing.
* Form inputs are validated before database operations.
* Resume and photo uploads are restricted by file type and size.
* Recruiters can manage only their own job postings.
* Role-based middleware protects recruiter and job seeker pages.
* Duplicate job applications are checked before inserting new records.
* Environment secrets and SMTP credentials should not be committed to version control.

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

Verify that the uploaded files exist in the `storage/app/public` directory.

### Application Email Not Received

Check the SMTP configuration and ensure the queue worker is running:

```bash
php artisan queue:work
```

Inspect failed queued jobs if the application uses the database queue:

```bash
php artisan queue:failed
```

Review Laravel logs in `storage/logs/laravel.log` for additional details.

### Route Changes Not Appearing

Clear the route cache:

```bash
php artisan route:clear
php artisan route:list
```

## Development Notes

* Use migrations to maintain database schema changes.
* Run seeders to populate required location data.
* Keep SMTP credentials in environment variables.
* Test both recruiter and job seeker workflows.
* Verify that application emails are delivered before deploying to production.
* Configure a production-ready queue worker when deploying the application.

## License

This project is developed as a Job Listing Panel application. The Laravel framework is open-source software licensed under the MIT License.
