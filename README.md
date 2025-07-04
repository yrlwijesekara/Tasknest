# TaskNest - PHP Backend with MySQL

A modern task management application built with PHP and MySQL backend.
![image](https://github.com/user-attachments/assets/f8a1468d-fe5c-4bee-9520-3abb1d3a4100)


## 🚀 Features

- ✅ **Add Tasks**: Create new tasks with title and description
- ✅ **View Tasks**: Display all tasks on the right side
- ✅ **Complete Tasks**: Click "Done" to mark tasks as completed (removes from list)
- ✅ **Database Storage**: All tasks are stored in MySQL database
- ✅ **Responsive Design**: Works on desktop and mobile devices
- ✅ **Security**: Input sanitization and XSS protection

## 📁 Project Structure

```
TaskNest/
├── config/
│   └── database.php       # Database connection configuration
├── models/
│   └── Task.php           # Task model for database operations
├── database/
│   └── setup.sql          # Database schema
├── index.php              # Main application file
├── style.css              # Application styles
├── setup.php              # Database setup script
└── README.md              # This file
```

## 🛠️ Installation Steps

### Step 1: Install Prerequisites

1. **Install PHP** (7.4 or higher)
   - Download from: https://www.php.net/downloads
   - Or use XAMPP: https://www.apachefriends.org/

2. **Install MySQL** (5.7 or higher)
   - Download from: https://dev.mysql.com/downloads/
   - Or use XAMPP which includes MySQL

### Step 2: Setup Database

#### Option A: Using the setup script (Recommended)
1. Place the TaskNest folder in your web server directory
2. Open your browser and go to: `http://localhost/TaskNest/setup.php`
3. Follow the setup instructions

#### Option B: Manual setup
1. Open MySQL command line or phpMyAdmin
2. Run the SQL commands from `database/setup.sql`

### Step 3: Configure Database Connection

1. Open `config/database.php`
2. Update the database credentials:
   ```php
   private $host = "localhost";
   private $db_name = "tasknest_db";
   private $username = "root";
   private $password = "your_password";
   ```

### Step 4: Run the Application

1. Start your web server (Apache/Nginx) or use PHP built-in server:
   ```bash
   php -S localhost:8000
   ```
2. Open your browser and go to: `http://localhost:8000/index.php`

## 💡 How to Use

1. **Add a Task**: 
   - Enter task title and description in the left form
   - Click "Add Task" button
   - Task will appear on the right side

2. **Complete a Task**:
   - Click the "Done" button on any task
   - Confirm the action in the popup
   - Task will be removed from the list

3. **View Tasks**:
   - All tasks are displayed on the right side
   - Shows title, description, and creation date
   - Tasks are ordered by newest first

## 🔧 Database Schema

The application uses a single `tasks` table:

```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## 🛡️ Security Features

- **Input Sanitization**: All user input is sanitized using `htmlspecialchars()`
- **Prepared Statements**: All database queries use prepared statements to prevent SQL injection
- **XSS Protection**: HTML entities are escaped to prevent cross-site scripting
- **CSRF Protection**: Forms use POST method with proper validation

## 🎨 Customization

You can customize the application by:

1. **Styling**: Edit `style.css` to change colors, fonts, and layout
2. **Database**: Modify `models/Task.php` to add new fields or methods
3. **Features**: Add new functionality to `index.php`

## 📱 Responsive Design

The application is fully responsive and works on:
- Desktop computers
- Tablets
- Mobile phones

## 🔍 Troubleshooting

### Common Issues:

1. **Database Connection Error**
   - Check MySQL is running
   - Verify database credentials in `config/database.php`
   - Ensure database `tasknest_db` exists

2. **Tasks Not Appearing**
   - Check if tasks table exists
   - Verify database connection
   - Check PHP error logs

3. **Form Not Submitting**
   - Ensure form method is POST
   - Check if all required fields are filled
   - Verify PHP is processing POST data

### Debug Steps:

1. Check PHP error logs
2. Verify database connection in `config/database.php`
3. Test database setup with `setup.php`
4. Check browser console for JavaScript errors

## 🚀 Production Deployment

For production use:

1. Update database credentials
2. Set proper file permissions
3. Enable HTTPS
4. Configure proper error handling
5. Add logging functionality

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is open source and available under the MIT License.

## 🎉 Enjoy TaskNest!

Your tasks are now managed with a professional PHP backend and MySQL database. Happy task management! 🎯
