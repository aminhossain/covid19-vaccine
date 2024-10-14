<h1 align="center">COVID Vaccine Registration System</h1>
<p align="center"><em>Vaccination is now hassel free</em></p>

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

<p align="left">
This is a COVID vaccine registration system built using Laravel for the backend and React for the frontend. The project leverages Docker for containerization, making it easy to set up and run locally. The functionality includes vaccine registration, center scheduling, and user status lookup.
</p>

## Features
- User registration for vaccination
- Schedule vaccination based on availability (first-come, first-served)
- Email notifications for users before vaccination
- Vaccine center selection with daily limits
- Search functionality to check vaccination status
- Weekday-only vaccination scheduling (Sunday to Thursday)

## Requirements
Before you begin, make sure you have the following installed:
- **Docker** and **Docker Compose**
- **Git**


## Installation Guide

### 1. Clone the Repository
```bash
git clone https://github.com/aminhossain/covid19-vaccine.git
cd covid19-vaccine
```

### 2. Setup Environment Variables
```bash
cp backend/.env.example backend/.env
cp frontend/.env.example frontend/.env
```

### 3. Install The Dependencies
```bash
cd backend && composer install
cd frontend && npm install
```

### 4. Build and Run the Project
```bash
docker-compose up --build
```

### 5. Browse the project
- Frontend: http://localhost:3000
- Backend API: http://localhost:8080

## API Endpoints
- GET /api/vaccine-centers - Fetch all vaccine centers
- POST /api/register - Register a user for vaccination
- GET /api/search - Search user vaccination status by NID

## Performance Optimization
- **Indexing:** Proper database indexing has been applied on fields like nid and vaccine_center_id to optimize search and registration speed.
- **Caching:** Future implementations may include query caching for frequently accessed data such as vaccine centers.

## Future Enhancements (For SMS Notifications)
<p>To add SMS notifications, an additional service like Twilio or Nexmo can be integrated. We'll need:</p>

- Install the relevant packages (e.g., twilio/sdk).
- Update the UserNotificationJob to send SMS along with emails.
- Add necessary configurations for the SMS provider in .env.


