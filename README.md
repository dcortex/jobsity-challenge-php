# Jobsity Challenge PHP

**Author:** Diego Cortés

**Framework:** Laravel 5.8

**System:** Ubuntu 18.04 | Apache 2.4.29 | PHP 7.2.15 | MySQL 5.7.25

**Dependencies:** Laravel 5.8 Dependencies, cURL PHP extension

**Description:** This project is designed to test the knowledge of web technologies and assess the ability to create robust PHP web applications with attention to software architecture and security.

## Installation Instructions
1. Create the project directory
    ```sh
        $ mkdir -p /var/www/jobsitychallenge/diego_cortes
        $ cd /var/www/jobsitychallenge/diego_cortes
    ```
2. Clone repository
    ```sh
        $ git clone git@github.com:diegoe87/jobsity-challenge-php.git .
    ```

3. Create **Virtual Host** [diego-cortes.jobsitychallenge.com](http://diego-cortes.jobsitychallenge.com) 
    
    Add the following code in your default configuration file in */etc/apache2/sites-available* or create a new configuration file and enable it.
    
    Restart apache web server to take effect the changes.  
    ```xml
        <VirtualHost *:80>
            ServerName diego-cortes.jobsitychallenge.com
            DocumentRoot /var/www/jobsitychallenge/diego_cortes/public

            <Directory "/var/www/jobsitychallenge/diego_cortes/public">
                    Options -Indexes +FollowSymLinks
                    AllowOverride All
            </Directory>

            ErrorLog ${APACHE_LOG_DIR}/error.log
            CustomLog ${APACHE_LOG_DIR}/access.log combined
        </VirtualHost>
    ```
    **Note:** If you are using a local environment you must add the following line in your */etc/hosts*
    ```
        127.0.0.1       diego-cortes.jobsitychallenge.com
    ```

4. Install packages from Composer
    ```sh
        $ composer install
    ```

5. Create a new database in MySQL (Recommended MySQL v5.7.7 or higher), set the environment variables in *./.env* and run the following command to migrate the DB
    ```sh
        $ php artisan migrate
    ```

6. Create a new Twitter App and set the variables below in *./.env* file. [developer.twitter.com/en/apps](https://developer.twitter.com/en/apps) 
    ```
        TWITTER_CONSUMER_KEY= 
        TWITTER_CONSUMER_SECRET=
        TWITTER_ACCESS_TOKEN=
        TWITTER_ACCESS_TOKEN_SECRET=
    ```

7. Open [diego-cortes.jobsitychallenge.com](http://diego-cortes.jobsitychallenge.com) in a modern browser ;)