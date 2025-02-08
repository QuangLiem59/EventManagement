# Event Management System

This repository contains the source code for an Event Management System. The system is built with a Laravel Apiato backend and a ReactJS frontend. TailwindCSS and ShadCN are used for styling, and MySQL is used as the database.

## Technologies Used

- **Backend:** Laravel Apiato
- **Frontend:** ReactJS
- **Styling:** TailwindCSS, ShadCN
- **Database:** MySQL

## Getting Started

### Prerequisites

- PHP 8
- Node.js 20
- NPM or Yarn
- MySQL

### Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/QuangLiem59/EventManagement.git
   cd EventManagement
   ```

2. **Backend Setup:**

   - Navigate to the backend directory:

     ```bash
     cd be
     ```

   - Install dependencies:

     ```bash
     composer install
     ```

   - Copy the `.env.example` file to `.env` and configure your environment variables:

     ```bash
     cp .env.example .env
     ```

   - Generate an application key:

     ```bash
     php artisan key:generate
     ```

   - Run the migrations:

     ```bash
     php artisan migrate --seed
     ```

3. **Frontend Setup:**

   - Navigate to the frontend directory:

     ```bash
     cd ../fe
     ```

   - Install dependencies:

     ```bash
     npm install
     # or
     yarn install
     ```

   - Start the development server:

     ```bash
     npm start
     # or
     yarn start
     ```

## Usage

- Access the frontend application at `http://localhost:5173`.
- The backend API will be available at `http://localhost:8000`.

## Contact

For any inquiries, please contact [liemh172@gmail.com](mailto:liemh172@gmail.com).
