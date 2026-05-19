# 🛒 OMS (Order Management System) – Laravel Project

A professional, developer-focused, and production-ready **Order Management System (OMS)** web application built on the Laravel framework. This system streamlines order workflows, inventory awareness, shipment tracking, and customer support, providing a seamless interface for both clients and administrators.

---

## 📌 Project Overview
The **OMS (Order Management System)** is designed to simplify and automate e-commerce operations. It bridges the gap between storefront customers placing orders and administrators managing fulfillment, payment statuses, and logistics. 

### Key Business Use Cases
* **Storefront Management:** Enables customers to browse products, view details, manage a persistent shopping cart, and place orders.
* **Fulfillment Pipeline:** Guides administrators through order approval, payment verification, shipment routing, and delivery.
* **Customer Relations:** Integrates a basic support ticket system to handle customer inquiries directly from the portal.

---

## 🚀 Features

### 👤 Authentication & Profiles
* **Secure Auth Gateway:** Built-in registration, login, logout, and password recovery systems.
* **Profile Management:** Allows administrators (and users) to update their profiles, including uploading profile photos.

### 📦 Customer E-Commerce Suite
* **Interactive Storefront:** A clean catalog page showing available products with category filters.
* **Persistent Cart Management:** Add, update quantities, or remove products smoothly before proceeding to checkout.
* **Checkout Pipeline:** Simple form inputs to finalize order details, capture shipping addresses, and place orders.
* **Customer Dashboard:** Dedicated client panel to review order history, check current order status, and inspect specific orders.

### 🛡️ Admin Management Suite
* **Central Dashboard:** Provides overview metrics and quick action pipelines.
* **Order Administration:** Track and modify order lifecycle states (Pending, Paid, Shipped, Delivered, Cancelled).
* **Product CRUD Operations:** Administrators can add, edit, or delete products, assign them to categories, and manage multi-image attachments.
* **Shipment & Logistics Tracking:** Record shipment dispatches and mark them as delivered when they arrive at their destinations.
* **Payment Lifecycle Auditing:** Monitor and verify transaction records linked directly to active orders.
* **Support Ticket Hub:** View and resolve customer support queries from a unified control panel.

---

## 🛠️ Tech Stack

* **Backend Framework:** Laravel `^12.0` (PHP `^8.2`)
* **Frontend UI Engine:** Laravel Blade Templates
* **Styling Framework:** Bootstrap (CSS layouts utilizing containers, rows, grid columns)
* **API Integration & Auth:** Laravel Sanctum (for stateless API token handling)
* **Asset Compilation:** Vite (NPM asset bundler)
* **Database Driver:** SQLite (default configuration), easily switchable to MySQL / PostgreSQL
* **Local Environment Orchestration:** Laravel Sail (Docker-based developer environment support)

---

## 📂 Project Structure

A high-level map of the codebase architecture:

```text
OMS/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/         # Handles Admin dashboards, products, orders, payments, shipments
│   │   │   ├── Auth/          # Handles standard registration, login, and forgot-password flows
│   │   │   ├── Customer/      # Customer order tracking and control panel
│   │   │   └── ...            # Storefront controllers (Cart, Checkout, Home)
│   │   └── Requests/          # Custom validation rules (e.g., StoreProductRequest)
│   ├── Models/                # Database models (Product, Order, OrderItem, Payment, Shipment, SupportTicket)
│   └── Helpers/               # Global helper logic (e.g., helpers.php autoloaded via composer)
├── database/
│   ├── migrations/            # Migration files defining database schemas and relations
│   └── seeders/               # Seeders for populating initial categories, roles, and dummy products
├── resources/
│   ├── views/                 # Blade views organized by modules
│   │   ├── admin/             # Layouts for admin dashboard and resource CRUDs
│   │   ├── auth/              # Login, Register, Forgot Password blade templates
│   │   ├── customer/          # Customer dashboard and order status check templates
│   │   ├── layouts/           # Standard HTML frames and master layouts
│   │   ├── partials/          # Reusable fragments (Header, Sidebar, Footer)
│   │   ├── store/             # Storefront catalog, product view, cart, and checkout
│   │   └── support/           # Customer support ticket interfaces
├── routes/
│   ├── web.php                # Web routes for users, admin panels, and shop workflows
│   └── api.php                # RESTful API endpoints secured via Sanctum middleware
└── config/                    # Global app configurations
```

---

## ⚙️ Installation & Setup

Ensure you have **PHP >= 8.2**, **Composer**, and **Node.js** installed locally.

### 1. Clone the Repository
```bash
git clone <repository-url>
cd oms
```

### 2. Install Backend & Frontend Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
Copy the `.env.example` file to create your local `.env`:
```bash
cp .env.example .env
```
Open the `.env` file. The database is pre-configured and saved inside the `db/` folder in the project root. If you are using SQLite, make sure your `.env` references the correct path:
```env
DB_CONNECTION=mysql
DB_DATABASE=oms.sql
```
*(You can find the oms.sql file in the root db folder)*

### 4. Application Key Generation
```bash
php artisan key:generate
```

### 5. Database Setup (Migrations & Seeders)
Ensure the database file exists in the `db/` directory, then run the migrations and seeds to populate the database and create test users:
```bash
php artisan migrate --seed
```

### 6. Generate Storage Link
Create a symlink from `public/storage` to `storage/app/public` so product images are accessible:
```bash
php artisan storage:link
```

### 7. Compile Assets & Launch Development Server
In a terminal, start the asset compilation:
```bash
npm run dev
```
In another terminal, start the PHP development server:
```bash
php artisan serve
```
The application will now be running at `http://127.0.0.1:8000`.

---

## 🔑 Test Credentials

After completing the database seeding, you can log in using the following test accounts:

### 🛡️ Admin Role
* **Email:** `admin@oms.com`
* **Password:** `12345678`

### 👤 Customer Role
* **Email:** `test@example.com` / `rohit.mishra@codeclouds.com`
* **Password:** `12345678`

---

## 🚀 Deployment Instructions

When deploying this Laravel app to a production server (Nginx/Apache):

1. **Environment Tweaks:** Update your `.env` to production settings:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```
2. **Optimize Configurations & Routing:** Cache configurations and routes to boost performance:
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
3. **Build Frontend Assets:**
   ```bash
   npm run build
   ```
4. **Permissions:** Ensure the web server (e.g., `www-data`) has write permissions to:
   * `storage/`
   * `bootstrap/cache/`

---

## 🔐 Security Features

* **CSRF (Cross-Site Request Forgery) Protection:** Handled transparently by Laravel middleware for all state-changing requests.
* **Role-Based Authorization:** Custom route middlewares prevent standard customer accounts from visiting `/admin/*` directories.
* **Input Sanitization & Validation:** Structured via dedicated Form Requests (e.g. `StoreProductRequest`) to prevent malicious injection or payload pollution.
* **Secure Password Hashing:** Uses secure bcrypt hashing by default for credential storage.
* **SQL Injection Mitigation:** Managed using Eloquent parameter binding and PDO safety standards.

---

## 👥 User Roles

The system operates under a clear, role-based boundary:

| Role | Access Level | Responsibilities |
| :--- | :--- | :--- |
| **Admin** | Full Access | Manage products, alter order statuses, manage payments, record shipments, handle support tickets. |
| **Customer** | Client Portal | Browse store catalog, manage cart, place orders, track orders, view order history. |

---

## 📈 Future Improvements

* **Stripe/PayPal Integration:** Upgrade checkout with live credit card processing integrations.
* **Advanced Analytics Engine:** Track sales trends, visual profit graphs, and popular stock items.
* **Real-time Order Alerts:** Add automated Email/SMS updates through queue workers when an order's status changes.
* **Advanced Inventory Control:** Add warning thresholds for low stock limits.

---

## 📸 Screenshots

### Storefront Catalog
*(Placeholder for Storefront Screenshot)*

### Admin Dashboard Overview
*(Placeholder for Admin Panel Screenshot)*

---

## 🤝 Contribution Guidelines

1. **Fork** the project repository.
2. Create a new feature branch (`git checkout -b feature/amazing-feature`).
3. Commit your changes with clear descriptions (`git commit -m 'feat: Add some amazing feature'`).
4. Push to your branch (`git push origin feature/amazing-feature`).
5. Open a **Pull Request** detailing your modifications.

---

## 🏷️ Tags

`#Laravel` `#PHP` `#OrderManagement` `#Bootstrap` `#MVC` `#Ecommerce` `#MYSQL` `#Backend`

---

## 👨‍💻 Author

**Rohit**
*Full-stack Developer*

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
