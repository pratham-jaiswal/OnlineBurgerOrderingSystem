# Online Burger Ordering System

The Online Burger Ordering System is a web application designed to facilitate seamless burger (or any food) ordering and delivery management. It offers a user-friendly interface for customers to browse the menu, add items to their cart, make payments, and track their orders. Administrators can manage menu items, update prices, and oversee the status of orders.


## File Descriptions

- **Assets/**: Images used in web
- **account.php**: Users can view their details, and customers can see their bookings.
- **cart.php**: Users can see items added to their cart, including tax and net amount, and then proceed to payment.
- **config.php**: Configures the database connection for the website.
- **delivered.php**: Updates the status of an order to delivered.
- **index.php**: Welcome page of the application.
- **login.php**: Allows users to log in using their username and password.
- **logout.php**: Allows users to log out.
- **outForDelivery.php**: Updates the status of an order to out for delivery.
- **payment.php**: [Dummy payment] Enables users to pay for their orders using a card.
- **register.php**: Allows users to create an account.
- **sales.php**: Manages orders within the system.
- **store.php**: Users can select items and add them to their cart.
- **style.css**: Contains the stylesheet for the entire project.
- **success.php**: Displays a payment successful page.

## Admin Credentials

- **Username:** admin
- **Password:** admin@123

## Getting Started

### Step 1: Download & Install XAMPP

1. Download XAMPP from [Apache Friends](https://www.apachefriends.org/).
2. Install XAMPP in the default directory: `C:\xampp`.

### Step 2: Clone the Repository

1. Clone the project repository to the `C:\xampp\htdocs\`:
    ```sh
    git clone https://github.com/pratham-jaiswal/OnlineBurgerOrderingSystem.git
    ```

### Step 3: Start XAMPP

1. Open XAMPP.
2. Start the **Apache** and **MySQL** services by clicking the respective "Start" buttons.

### Step 4: Setup the Database

1. Open your web browser and go to:
    ```
    localhost/phpmyadmin/
    ```
2. In the sidebar, click on "New" to create a new database.
3. Name the database **burgerorderingsystem**.
4. After creating the database, click on the database name to open it.
5. Go to the "Import" tab and import the `burgerorderingsystem.sql` file.

### Step 5: Launch the Application

1. Open your web browser and go to:
    ```
    localhost/OnlineBurgerOrderingSystem/
    ```
2. Register a new account and log in to start using the Online Burger Ordering System.

## License

This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/pratham-jaiswal/OnlineBurgerOrderingSystem/blob/main/LICENSE) file for details.
