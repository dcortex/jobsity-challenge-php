# Jobsity Challenge PHP

**Author:** Diego Cortés

**Framework:** Laravel 5.8

**Description:** This project is designed to test the knowledge of web technologies and assess your ability to create robust PHP web applications with attention to software architecture and security.

## Instalation
1. Create the following directory /var/www/jobsitychallenge/diego_cortes
    ```
        mkdir -p /var/www/jobsitychallenge/diego_cortes
        cd /var/www/jobsitychallenge/diego_cortes
    ```
2. Clone the repository
    ```
        git clone git@github.com:diegoe87/jobsity-challenge-php.git .
    ```

3. Add Virtual Host diegocortes.jobsitychallenge.com
    ```xml
        <VirtualHost *:80>
            ServerName diegocortes.jobsitychallenge.com
            DocumentRoot /var/www/jobsitychallenge/diego_cortes/public

            ErrorLog ${APACHE_LOG_DIR}/error.log
            CustomLog ${APACHE_LOG_DIR}/access.log combined
        </VirtualHost>
    ```
    **Note:** If you are using a local environment you must add the following line in your /etc/hosts 
    ```
        127.0.0.1       diegocortes.jobsitychallenge.com
    ```