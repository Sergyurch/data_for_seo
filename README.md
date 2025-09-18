How to run the project.

1. Clone the repository to the destination folder:

    git clone https://github.com/Sergyurch/data_for_seo.git

2. Enter project folder:

   cd <project_folder_path>

3. Install dependencies:

   composer install

4. Install node modules and build the project:

    npm install

    npm run build

6. Copy .env.example to .env and update it with your DataForSEO credentials:

   DATAFORSEO_LOGIN=your_login@email.com

   DATAFORSEO_PASSWORD=your_api_password

   DATAFORSEO_API_BASE=https://api.dataforseo.com

8. Start the development server:

    php artisan serve
