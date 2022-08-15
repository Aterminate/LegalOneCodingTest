---------------------------------------------------------------------------------------------------------------------------

----------------------------                        LEGAL ONE CODING CHALLENGE                       ----------------------

---------------------------------------------------------------------------------------------------------------------------
    
	Overall Process
	
    Steps To Create Project Setup


1.  Run the following command to create a symfony project in version 5.4 or you want to build a tradational web application
    
	composer create-project symfony/skeleton:"^5.4" LegalOneCodingTest
	
	
2.  Go Inside project from

    cd LegalOneCodingTest


3.  Install webapp server in your project directory 
    
	composer require webapp


4.  Just go inside env file and enable mysql connection


5.  To check weather project is working fine or not 
    
	php bin/console server:run
	

6.  Install twig package inside your project
    
	composer require template/twig
	

7.  Install annotaion in your project
     
    composer require annotations
	

8.  Checking ot the project structure


9.  After setup the database environment in your project 
    
    composer require symfony/orm-pack
    composer require --dev symfony/maker-bundle 	
	
10. Configure the database and setup the connection parameter db_url


11. Run the doctrine command that will setup the database for you
    php bin/console doctrine:database:create


12. Create an entity class of service_logs 
    php bin/console make:entity 
  

    Then name it according to your needs  


12. Create Migrations & Database Schema of the table and run the commands sequentially

    - php bin/console make:migration	
	- php bin/console doctrine:migrations:migrate
	

13. You can install Symfony maker and tell symfony to generate a controller class
    
    - php bin/console make:controller ServiceController	
	
	
14. For debugging purpose run the command on terminal
   
     - php bin/console debug:router




----------------------------------------------------------

                    T A S K --- O N E 

----------------------------------------------------------


1.  First of all build the command 

    - php bin/console make:command UpdateServiceLog
	
	After entering it on terminal you will see the result in your project inside command directory 
	
	
2.  Secondly, add / remove all stuff in command related to task. Additionally do some changings in services.yaml in files


3.  Algorithm for task one to follow 

	-  A console command which finds file 
    -  Loops through service csv (I added some restrictions on project and made the logic for csv files. Test the file which is place inside public folder for more records)
    -  Adds new items to DB
    -  Updates data of existing ones in DB
	 
4.  Lastly, run the command for getting output 
  
    -   php bin/console UpdateServiceLog
	
	

----------------------------------------------------------

                    T A S K --- T W O

----------------------------------------------------------

1.  Create an entity class of service_analytics 

    - php bin/console make:entity 
	- php bin/console make:migration	
	- php bin/console doctrine:migrations:migrate

2.  Create controller class ApiController
    
    - php bin/console make:controller ApiController	
	
3.  Run server command 

    - php bin/console server:run

4.  Added all logics in controller and tested through postman



How to execute project:


1.  Check env connections, change it if needed
2.  Create a database name 'legal_one_coding_test'
3.  Migrate all tables 
4.  For Task one run "php bin/console make:command UpdateServiceLog"
5.  For Task two install postman and test url with followig sequence
    localhost:8000/api/fetchapi_count/user-service/200/2022-08-15 09:28:29/2022-08-15 09:28:29
	- first indicate service name , second codestatus, third start datetime , last  enddatetime	
6.  If you need to ask anything email me at: 'helloaysha178@gmail.com'	
	
	 
	 

	
	
	
	

	
	