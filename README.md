# LearnHub

## Project Description
LearnHub is a web application designed to facilitate the sharing and management of educational notes. Users can register, log in, upload their notes, browse notes uploaded by others, search and filter notes, and manage their own uploaded and bookmarked notes through a personalized dashboard.

## Features
- User Registration and Login (including Google authentication)
- Secure User Sessions
- Upload Notes (PDF, DOC, DOCX, JPG, JPEG, PNG formats supported, up to 10MB)
- Drag-and-Drop File Upload Interface
- Browse All Notes with Search, Filter by Subject, and Sort Options
- User Dashboard to view Uploaded Notes and Bookmarked Notes
- Like and Bookmark Notes functionality
- Admin Blog/Profile Page
- Responsive Design for various devices (desktops, laptops, tablets, mobile phones)

## Installation
To set up LearnHub on your local machine, follow these steps:

1.  **Clone the repository:**
    ```bash
    git clone <repository_url>
    cd LearnHub
    ```
2.  **Set up your web server:**
    Place the `LearnHub` directory in your web server's document root (e.g., `C:\xampp\htdocs\` for XAMPP).
3.  **Database Setup:**
    *   Create a MySQL database named `learnhub`.
    *   Import the `db_setup.sql` file to create the necessary tables:
        ```bash
        mysql -u your_username -p learnhub < db_setup.sql
        ```
    *   Run `add_bookmarks_table.sql` and `add_college_to_notes.sql` for additional features.
4.  **Configure Database Connection:**
    Edit `config/database.php` with your database credentials.
5.  **Configure Google API (for Google Authentication and Drive Upload):**
    *   Follow the instructions in `config/google_api.php` to set up your Google API credentials.
    *   Ensure `google_api_helper.php` is correctly configured for Google Drive integration.
6.  **Install Composer Dependencies:**
    Navigate to the project root and run:
    ```bash
    composer install
    ```

## Usage
1.  Open your web browser and navigate to `http://localhost/LearnHub` (or your configured URL).
2.  Register a new account or log in with existing credentials.
3.  Explore the dashboard, upload notes, browse other notes, and utilize the search and filter functionalities.

## Technologies Used
-   PHP
-   MySQL (PDO for database interaction)
-   HTML5
-   CSS (Tailwind CSS for styling)
-   JavaScript
-   Google API Client Library for PHP (for Google Authentication and Google Drive integration)

## Contributing
Contributions are welcome! Please feel free to fork the repository, make your changes, and submit a pull request.

## License
This project is open-source and available under the [MIT License](LICENSE). (Note: A `LICENSE` file is not currently present in the provided file list, but this is a common open-source license.)

## Contact
For any inquiries, please contact Durga Vara Prasad Pappuri at pappuridurgavaraprasad4pl@gmail.com or visit [VARA4u-tech on GitHub](https://github.com/VARA4u-tech).