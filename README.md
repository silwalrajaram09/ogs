# OGS - Organization & Committee Management System

Welcome to **OGS**, a comprehensive web-based system for managing organizations, committees, and programs. Built with Laravel and Vue.js, this platform enables seamless management of organizational structure, committee hierarchies, and program participation.

## 🎯 Project Overview

OGS is designed to help organizations:
- Manage hierarchical committee structures
- Organize and run multiple programs and events
- Track committee memberships and program participants
- Assign users to committees and programs
- Maintain organizational records and user profiles
- Support multi-level committees with parent-child relationships
- Track program details including location, duration, and country information

## ✨ Core Features

### Committee Management
- **🏢 Committee Hierarchy**: Create and manage nested committee structures with parent-child relationships
- **📋 Committee Organization**: Organize committees by departments and organizational units
- **👥 Committee Members**: Assign users to committees with flexible membership management
- **📍 Committee Tracking**: Track committee creation, ownership, and updates
- **🔄 Recursive Committee Structure**: Support for nested committees with automatic hierarchy traversal

### Program Management
- **📅 Program Organization**: Create and manage multiple programs and events
- **🌍 Global Programs**: Support for programs across different countries
- **📊 Program Details**: Track program type, description, start/end dates, duration, and location
- **👤 Participant Management**: Add and manage program participants
- **📈 Program Hierarchy**: Support for parent-child program relationships
- **🗓️ Timeline Tracking**: Manage program schedules and milestones

### User Management
- **👤 User Profiles**: Comprehensive user profiles with additional information
- **🔐 Authentication**: Secure user authentication with Laravel Fortify
- **🔑 Two-Factor Authentication**: Support for 2FA and passkey authentication
- **📝 User Information**: Store designation, address, profile description, and social links
- **🖼️ Profile Photos**: Upload and manage user profile images
- **🔄 User Status**: Track active status, start dates, and end dates

### Data Organization
- **🎯 User-Committee Relations**: Track user membership across committees
- **🎯 User-Program Relations**: Track user participation in programs
- **📊 Relationship Timestamps**: Automatic tracking of membership dates

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 11
- **Database**: MySQL/PostgreSQL (via Eloquent ORM)
- **Authentication**: Laravel Fortify (with 2FA & Passkey support)
- **Testing**: PHPUnit
- **API**: RESTful API architecture
- **Code Quality**: Laravel Pint (PHP linting)

### Frontend
- **Framework**: Vue.js 3
- **Build Tool**: Vite
- **Language**: TypeScript
- **Component Framework**: Shadcn/ui
- **Styling**: Tailwind CSS
- **Linting**: ESLint

### Development Tools
- **Package Manager**: npm, pnpm
- **Version Control**: Git
- **Code Formatting**: Prettier
- **Editor Config**: EditorConfig

## 📁 Project Structure

```
ogs/
├── app/
│   ├── Models/                  # Eloquent Models
│   │   ├── Committee.php        # Committee model with hierarchy
│   │   ├── Program.php          # Program model
│   │   ├── User.php             # User model with auth
│   │   ├── UserCommittee.php    # User-Committee pivot
│   │   ├── UserProgramm.php     # User-Program pivot
│   │   ├── Country.php          # Country model
│   │   ├── Post.php             # Post/Content model
│   │   └── Page.php             # Page model
│   ├── Http/                    # Controllers, Requests, Middleware
│   ├── Actions/                 # Action classes
│   ├── Concerns/                # Reusable traits
│   └── Providers/               # Service providers
├── bootstrap/                   # Laravel bootstrap files
├── config/                      # Configuration files
├── database/                    # Migrations and seeders
├── resources/                   # Frontend resources
├── routes/                      # API routes
├── storage/                     # File storage
├── tests/                       # PHPUnit tests
├── public/                      # Public assets
├── vite.config.ts              # Vite configuration
├── composer.json               # PHP dependencies
├── package.json                # Node dependencies
└── README.md                   # This file
```

## 📊 Database Models

### Committee Model
```php
Fields: id, name, user_id (creator), parent_id (parent committee), updated_by, timestamps
Relations:
  - belongsTo(User) creator
  - belongsTo(User) updater
  - belongsToMany(User) members via UserCommittee
  - hasMany(UserCommittee) userCommittees
  - hasMany(Committee) children
  - belongsTo(Committee) parent
  - hasMany(Committee) childrenRecursive
```

### Program Model
```php
Fields: id, name, type, description, start_date, end_date, no_of_days, location, country_id, parent_id, timestamps
Relations:
  - belongsTo(Country)
  - belongsToMany(User) participants via UserProgramm
  - hasMany(UserProgramm) userProgramms
  - hasMany(Program) children
  - belongsTo(Program) parent
```

### User Model
```php
Fields: id, user_id (UUID), full_name, email, password, designation, address, profile_description
         social links (fb, youtube, tiktok), photo_path, type, start_date, end_date, is_active, timestamps
Relations:
  - belongsToMany(Committee) committees via UserCommittee
  - hasMany(Committee) ownedCommittees
  - hasMany(UserCommittee) userCommittees
  - belongsToMany(Program) programs via UserProgramm
  - hasMany(UserProgramm) userProgramms
Authentication:
  - 2FA (Two-Factor Authentication)
  - Passkey Authentication
```

### Supporting Models
- **UserCommittee**: Pivot table for user-committee relationships with timestamps
- **UserProgramm**: Pivot table for user-program relationships with timestamps
- **Country**: Countries where programs can be located
- **Post**: Blog posts or content management
- **Page**: Static pages

## 🚀 Getting Started

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js 16+ and npm/pnpm
- MySQL/PostgreSQL database

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/silwalrajaram09/ogs.git
   cd ogs
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   # or
   pnpm install
   ```

4. **Setup environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database** in `.env` file, then run migrations:
   ```bash
   php artisan migrate
   ```

6. **Build frontend assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

The application will be available at `http://localhost:8000`

## 🎨 Key Features in Detail

### Committee Management System
- **Hierarchical Structure**: Committees can have parent-child relationships for multi-level organizational hierarchy
- **Member Assignment**: Assign users to committees with automatic relationship tracking
- **Recursive Traversal**: Automatically retrieve nested committee structures
- **Audit Trail**: Track who created and last updated each committee

### Program Management System
- **Multi-Country Support**: Programs can be organized and located across different countries
- **Flexible Timing**: Support for program scheduling with start dates, end dates, and duration tracking
- **Participant Management**: Track all program participants with automatic relationship management
- **Program Types**: Support for different program types and descriptions

### User Management
- **Rich Profiles**: Comprehensive user profiles with contact information and social links
- **Authentication Security**: Two-factor authentication and passkey support for enhanced security
- **Status Tracking**: Track user activity status and engagement dates
- **Role Management**: Support for different user types and designations

## 📋 Available Routes & APIs

The application provides RESTful API endpoints for:
- Committee CRUD operations and hierarchy management
- Program CRUD operations and scheduling
- User management and profile updates
- Committee member management
- Program participant management
- Authentication and authorization

Run `php artisan route:list` to see all available routes.

## 🧪 Testing

Run tests with:
```bash
php artisan test
```

## 🔒 Security Features

- **Authentication**: Secure user authentication with Laravel Fortify
- **Two-Factor Authentication**: Optional 2FA for enhanced account security
- **Passkey Authentication**: Support for modern passkey-based authentication
- **Authorization**: Role-based access control (in development)
- **Data Validation**: Request validation on all input data
- **CSRF Protection**: Built-in CSRF token protection

## 📝 Development Guidelines

- Follow PSR-12 coding standards (enforced by Laravel Pint)
- Use TypeScript for frontend code
- Write tests for new features
- Follow the existing project structure
- Use meaningful commit messages

## 🐛 Known Issues & TODO

- [ ] Harden authorization: implement authorize() checks in all admin FormRequest classes
- [ ] Add User::isAdmin() helper method for cleaner authorization checks
- [ ] Run sanity checks and ensure full test coverage
- [ ] API documentation and Swagger integration (optional)

## 🤝 Contributing

We welcome contributions! To get started:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📋 Roadmap

- [ ] Advanced authorization and permission management
- [ ] Real-time notifications for committee and program updates
- [ ] Attendance tracking for program events
- [ ] Reporting and analytics dashboard
- [ ] Mobile application
- [ ] Export data functionality (CSV, PDF)
- [ ] Committee meeting scheduling and minutes management
- [ ] Document and file management for committees

## 📝 License

This project is currently unlicensed. Please check the repository for future licensing information.

## 👥 Author

- **silwalrajaram09** - Initial work - [GitHub Profile](https://github.com/silwalrajaram09)

## 📞 Support & Contact

For support, issues, or feature requests:
- Open an issue on [GitHub Issues](https://github.com/silwalrajaram09/ogs/issues)
- Check existing documentation
- Contact the development team

## 🙏 Acknowledgments

Thanks to:
- Laravel community for the excellent framework
- Vue.js team for the progressive framework
- All contributors and community members

---

**Build Better Committees & Programs! 🚀** ✨
