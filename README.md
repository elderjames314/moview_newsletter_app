# Movie Newsletter App

This is a platform that sends favorite movies to movie newsletter subscribers. It sends a newsletter to users showing the list of recommended movies (title, excerpts, and little description) to the user’s email.
To subscribe to the Movie Newsletter application, the user needs to do one-time signup by entering the full name, email, and password and upon successful operation, the application will intelligently send 5-digit OTP (one-time-password) to the user email. The next page will be the confirmation page where the user will enter 5-digit sent to their registered email, this is to confirm that the email belongs to the user. 
Lastly, the last page will be unsubscribing page where users will have the opportunity to unsubscribe in case they choose to.
## Development
Framework/Language: Laravel v7.0 (PHP v7.4.0)
Database: MYSQL
Frontend: Bootstrap 4
IDE: Visual studio
Movie data Api:
 https://api.themoviedb.org/3/movie/top_rated?api_key=<<api_key>>&language=en-US&page=1
Guzzle package(preinstalled with Laravel) will be used to consumed the REST Api.
Database used for testing: InMemory SQLite database.

## Deployment
1.	Clone Movie_Newsletter_app repo on 
https://github.com/elderjames314/moview_newsletter_app
2.	Composer install
3.	Npm install (this will install missing perquisites)
4.	Composer install
5.	Cp .env.examp .env
6.	Php artisan key:generate
7.	Php artisan migrate (this will create database schema)  : please from .env file, create your config your database(host, database, username, password) accordingly

8.	Npm run dev  : this will compile the boostrap(html & css)
9.	Php artisan serve : to run the application
10.	php artisan schedule:work     :- this will make the cron jobs to start running and send email at 9:00pm daily

