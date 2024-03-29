# Hash Wallet</br>

During registration, the user chooses the method of hashing the password: SHA512 or HMAC. Salt and pepper are added to the password. After three failed login attempts from one IP, the account is blocked for a certain period of time. The user panel displays the last login attempts from different IPs. The main function of the application is to store hashed passwords for various user accounts that it can decrypt.

## To run this program:</br>

### 1. Make sure you have the following tools installed on your computer:</br>

PHP (recommended version 7.2 or newer)</br>
Database MySql (recommended version 8.0 or newer)</br>
XAMPP or WAMP will provide you with an Apache server</br>

### 2. Download the code from GitHub:</br>

Using Git repository, you can use this command:

    git clone https://github.com/szymonczopek/hashWallet.git

### 3. Import database:

Import the SQL code from `bsibase.sql` into a MySQL database, you we will call `bsibase`.

### 4. Launching the project:</br>

After configuring the database connection, you can proceed to launch the project. Make sure that the Apache server is running in XAMPP or WAMP. Move the project files to the folder where the Apache server is running (e.g., `htdocs` in XAMPP or `www` in WAMP).

### 5. Open the project in a browser:</br>

Open a web browser and type `localhost/hashWallet-main` in the address bar. The project should now be running, and the website should be visible in the browser.

### 6. Unit Tests:

This command will execute PHPUnit and run the tests located in the tests directory. 

    ./vendor/bin/phpunit --testdox tests
