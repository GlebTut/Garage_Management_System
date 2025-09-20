# AutoSphere - Garage Management System

A comprehensive web-based garage management system for automotive service centers, providing complete workflow management from booking to payment.

## 🚗 About AutoSphere

AutoSphere is a full-featured garage management ecosystem designed to streamline operations for automotive service centers. The system handles customer bookings, job management, inventory control, supplier relationships, and financial transactions in one integrated platform.

## 👥 Team

This project was developed as a collaborative effort by:

- **Adam Dowling** (C00298483) - Stock Management & Database Design
- **Muhammad Fahad** (C00311349) - Booking System & Supplier Management  
- **Gleb Tutubalin** (C00290944) - Invoice Management & Payment Processing
- **Taemour Basharat** (C00295140) - System Architecture & Integration
- **Emoshoke Saliu** (C00297032) - Job Type Management & Job Completion

**Project Supervisor:** Aine Byrne  
**Programme:** CW_KCSOF_B, Year 2  
**Module:** Project SEM 2

## ✨ Features

### 🎯 Core Functionality
- **Customer Management** - Add, edit, delete, and view customer records
- **Booking System** - Schedule and manage service appointments
- **Job Management** - Track jobs from commencement to completion
- **Stock Control** - Inventory management with automatic reorder alerts
- **Supplier Management** - Maintain supplier relationships and process invoices
- **Payment Processing** - Handle job payments and supplier payments
- **Reporting** - Generate various business reports

### 📊 Dashboard Features
- Real-time income tracking with visual graphs
- Booking overview and management
- Service statistics and analytics
- Recent activity monitoring

### 🔧 Technical Features
- Responsive web design
- AJAX-powered dynamic forms
- Real-time data validation
- PDF job card generation
- Automated reorder notifications

## 🛠️ Technology Stack

- **Backend:** PHP 7.4+
- **Database:** MySQL 8.0+
- **Frontend:** HTML5, CSS3, JavaScript (ES6+)
- **Styling:** Custom CSS with CSS Grid & Flexbox
- **Charts:** Syncfusion EJ2 Charts
- **Icons:** Font Awesome
- **Architecture:** MVC Pattern

## 📋 Requirements

- PHP 7.4 or higher
- MySQL 8.0 or higher
- Apache/Nginx web server
- Modern web browser (Chrome, Firefox, Safari, Edge)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/GlebTut/Garage_Management_System.git
   cd Garage_Management_System
   ```

2. **Database Setup**
   ```sql
   CREATE DATABASE garage_system;
   CREATE USER 'garageuser'@'localhost' IDENTIFIED BY 'garageUserPass4';
   GRANT ALL PRIVILEGES ON garage_system.* TO 'garageuser'@'localhost';
   FLUSH PRIVILEGES;
   ```

3. **Import Database Schema**
   - Import the provided SQL schema file into your `garage_system` database
   - Ensure all tables are created with proper relationships

4. **Configure Database Connection**
   - Update `code/DBconnection.php` with your database credentials if needed
   - Default configuration:
     ```php
     $hostName = "localhost";
     $userName = "garageuser"; 
     $password = "garageUserPass4";
     $dbName = "garage_system";
     ```

5. **Web Server Setup**
   - Place project files in your web server document root
   - Ensure PHP has read/write permissions to the project directory
   - Configure virtual host (optional but recommended)

6. **Access the Application**
   - Navigate to `http://localhost/Garage_Management_System/code/AdminDashboard.php`
   - Or your configured domain/path

## 📁 Project Structure

```
Garage_Management_System/
├── Assets/
│   ├── css/                 # Stylesheets
│   ├── js/                  # JavaScript files
│   └── images/              # Image assets
├── code/                    # PHP application files
│   ├── AdminDashboard.php   # Main dashboard
│   ├── DBconnection.php     # Database configuration
│   ├── Add*.php             # Add functionality files
│   ├── Delete*.php          # Delete functionality files
│   ├── Amend*.php           # Edit functionality files
│   └── *Form.php            # Form UI files
└── docs/                    # Documentation
```

## 🎨 Key Components

### Dashboard (AdminDashboard.php)
- Central hub with navigation sidebar
- Real-time business metrics
- Quick access to all system functions

### Database Layer (DBconnection.php)
- PDO-based database abstraction
- Prepared statements for security
- Error handling and logging

### JavaScript Framework (admin_dashboard.js)
- Dynamic form loading via AJAX
- Real-time validation
- Chart generation and data visualization

### CSS Architecture
- Modular stylesheet organization
- CSS Grid for responsive layouts
- Custom color scheme and theming

## 🔒 Security Features

- **SQL Injection Protection** - All queries use prepared statements
- **Input Validation** - Client-side and server-side validation
- **Error Handling** - Comprehensive error logging
- **Session Management** - Secure session handling

## 🧪 Usage Examples

### Adding a New Customer
1. Navigate to File Maintenance Menu → Add a New Customer
2. Fill in customer details with validation
3. Submit to create customer record

### Creating a Booking
1. Go to Booking Menu → Make a Booking
2. Select customer and job types
3. Set booking date and vehicle details
4. System validates and creates booking

### Processing Payments
1. Use Supplier Accounts Menu → Payment to Suppliers
2. Select supplier to view unpaid invoices
3. Process payment and generate payment letter

## 📊 Database Schema

The system uses a comprehensive relational database with the following key entities:
- Customer, Booking, Job, Job_Type
- Stock_Item, Supplier, Invoice, Payment
- Order, Job_Parts, Mechanics

## 🤝 Contributing

While this was an academic project, contributions are welcome:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support & Contact

For questions or support regarding this project:

- **Project Repository:** [GitHub](https://github.com/GlebTut/Garage_Management_System)
- **Issues:** [GitHub Issues](https://github.com/GlebTut/Garage_Management_System/issues)

## 🙏 Acknowledgments

- **Aine Byrne** - Project Supervisor for guidance and support
- **Cork Institute of Technology** - Educational institution
- **Syncfusion** - For chart components
- **Font Awesome** - For iconography
- All team members for their dedicated contributions

## 📅 Project Timeline

- **Development Period:** Academic Year 2024-2025
- **Submission Date:** March 27, 2025
- **Status:** Academic Project Complete

---

**Built with ❤️ by the AutoSphere Development Team**
