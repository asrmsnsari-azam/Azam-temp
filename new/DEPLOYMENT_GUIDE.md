# Deployment Guide: Student Registration Website to Live Hosting

## Step 1: Get Web Hosting & Domain
1. Purchase web hosting from providers like:
   - Hostinger
   - Namecheap
   - Bluehost
   - GoDaddy
   - SiteGround
2. Purchase/register a domain name (e.g., `yourdomain.com`)
3. Point your domain to your hosting server (nameservers)

## Step 2: Prepare Database on Live Server
1. Log in to your hosting **cPanel** (or equivalent control panel)
2. Open **phpMyAdmin**
3. Create a new database (e.g., `yourusername_student_db`)
4. Create a database user with a strong password
5. Grant the user ALL PRIVILEGES to the database
6. Note down:
   - Database Name
   - Database Username
   - Database Password
   - Host (usually `localhost`)

## Step 3: Import Database
1. In cPanel phpMyAdmin, select your new database
2. Click **Import** tab
3. Choose the `database.sql` file from this project
4. Click **Go** to import the tables

## Step 4: Update Database Configuration
1. Open `config.php` in a text editor
2. Comment out the localhost settings
3. Uncomment and update the LIVE HOSTING SETTINGS:

```php
// Localhost (XAMPP) Settings - Default
// $host = 'localhost';
// $username = 'root';
// $password = '';
// $database = 'student_db';

// LIVE HOSTING SETTINGS
$host = 'localhost';
$username = 'YOUR_HOSTING_DB_USERNAME';
$password = 'YOUR_HOSTING_DB_PASSWORD';
$database = 'YOUR_HOSTING_DB_NAME';
```

## Step 5: Upload Files to Live Server
### Method A: Using cPanel File Manager
1. Log in to cPanel
2. Open **File Manager**
3. Navigate to `public_html/` (or `htdocs/` depending on host)
4. Create a new folder (e.g., `student-registration`) or upload directly to root
5. Upload all project files:
   - `index.html`
   - `about.html`
   - `register.php`
   - `display.php`
   - `config.php`
   - `script.js`
   - `style.css`
   - `database.sql` (optional, not needed on server)
6. Create an `uploads/` folder and set permissions to **755** or **777**

### Method B: Using FTP Client (FileZilla)
1. Download and install **FileZilla**
2. Get FTP credentials from your hosting control panel:
   - Host/IP Address
   - FTP Username
   - FTP Password
   - Port (usually 21)
3. Connect to your server
4. Navigate to `public_html/`
5. Upload all project files
6. Create `uploads/` folder on server

## Step 6: Set Folder Permissions
1. In cPanel File Manager or FTP, right-click the `uploads/` folder
2. Set permissions to **755** (or **777** if uploads fail)
3. This allows the server to save uploaded pictures

## Step 7: Access Your Live Website
- If uploaded to root: `http://yourdomain.com`
- If uploaded to subfolder: `http://yourdomain.com/student-registration/`

## Troubleshooting

### Database Connection Error
- Double-check `config.php` credentials
- Ensure database user has proper privileges
- Check if hosting uses a different database host (some use `127.0.0.1` or custom host)

### File Upload Not Working
- Check `uploads/` folder permissions (should be 755 or 777)
- Check PHP `upload_max_filesize` in hosting settings
- Ensure file type matches allowed types in PHP code

### Pages Not Loading
- Ensure all files are uploaded correctly
- Check that PHP is enabled on your hosting (most shared hosting supports PHP)
- Check file paths are correct (use relative paths like `register.php`, not absolute)

### 500 Internal Server Error
- Check `.htaccess` file (if exists) for conflicting rules
- Contact hosting support if error persists

## Free Hosting Options (for testing)
If you want to test deployment without purchasing:
- **InfinityFree** (infinityfree.net) - Free hosting with PHP & MySQL
- **000webhost** - Free tier available
- **AwardSpace** - Free hosting option

## Important Security Notes for Live Deployment
1. **Change default admin credentials** - Never use weak passwords
2. **Use HTTPS** - Install SSL certificate (most hosts provide free Let's Encrypt SSL)
3. **Sanitize inputs** - Already implemented in the code using `real_escape_string`
4. **Password hashing** - Already implemented using `password_hash()`
5. **Hide errors in production** - Add `error_reporting(0);` at top of PHP files for live sites

## Need Help?
If your hosting provider has specific requirements, check their documentation or contact their support for:
- Database connection details
- FTP/cPanel access instructions
- PHP version compatibility (this project requires PHP 7.0+)

