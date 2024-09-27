
# Asset Pulse

Just a simple MVP for asset management include: Software, hardware, and peripherals tracking.

## Installation

1. **Clone the repository**:
    ```bash
    https://github.com/AbdelrahmanElalfee/Asset_Pulse.git
    cd Asset_Pulse
    ```

2. **Install dependencies**:
    ```bash
    composer install
    ```

3. **Install node packages**:
    ```bash
    npm install
    ```

4. **Build**:
    ```bash
    npm run build
    ```

5. **Set up the database**:
    - Ensure MySQL is running.
    - Create a database for the system.

6. **Configure environment variables**:
    - Copy `.env.example` to `.env` and update the configuration as needed.

7. **Provide database credentials into `.env` file**:
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=dbname
    DB_USERNAME=root
    DB_PASSWORD=
    ```

8. **Run database migrations**:
    ```bash
    php artisan migrate
    ```

9. **Start the application**:
    ```bash
    php artisan serve
    ```

## Tech Stack

    - FilamentPHP
    - Laravel

