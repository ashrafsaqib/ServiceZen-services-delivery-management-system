# ServiceZen - Services Delivery Management System Cloud Developed With Assistance Of ChatGPT

Our Solution helps organizations manage the delivery of their services to customers. It provides end-to-end visibility into the service delivery process, from service request to delivery and ongoing support. The system allows organizations to streamline their service delivery operations, improve efficiency, and enhance customer satisfaction.

## Key Features of a Service Delivery Management System  
Automated workflows  
Resource allocation  
Scheduling and dispatching  
Real-time tracking and monitoring of service delivery  
Customer communication and feedback  
Reporting and analytics  
Integration with other business systems  

The system is typically used by service providers across various industries, including IT, telecommunications, healthcare, transportation, and facilities management, among others. By implementing a service delivery management system, organizations can ensure that their services are delivered on time, within budget, and to the satisfaction of their customers.

## Key Entities In Service Delivery Management System 
The key entities or objects in a service delivery management system will depend on the specific requirements of the system and the industry it serves. However, some common entities or objects in such a system include:

Service requests: This entity represents the requests made by customers for a particular service.

Service tasks: This entity represents the individual tasks or activities required to complete the service request.

Service resources: This entity represents the resources required to complete the service tasks, such as personnel, equipment, and materials.

Service schedules: This entity represents the schedule for completing the service tasks, including start and end times, dependencies, and constraints.

Service delivery status: This entity represents the current status of the service delivery process, including progress, delays, and issues.

Service delivery reports: This entity represents the reports generated by the system to provide insights into the service delivery process, including performance metrics, service level agreements, and customer feedback.

Customer data: This entity represents the customer data required to manage the service delivery process, including contact information, service history, and preferences.

Business systems: This entity represents the integration points with other business systems, such as billing, inventory, and CRM systems.


## Command to run this project
composer install

create database with name 'chatgpt_services_delivery_management_system' then

php artisan migrate

php artisan db:seed

php artisan key:generate

php artisan serve

login with

email: admin@gmail.com

psw: admin1234

## Admin and Store Demo Links

Store link: https://services.upgradeopencart.com/

## Test Customer User for Store
User: test@customer.com
Password: testcustomer

Admin panel link: https://services.upgradeopencart.com/admin

## Test Admin User
User: admin@gmail.com
Password: admin1234

## ChatGPT Prompts and Assistance
1. The first help taken from ChatGPT is to write description / Readme for this Project 
2. Second tasks done by ChatGPT is identifiying main Entities / Objects
3. We asked ChatGPT to write Object Relation ORM Classes In laravel
4. Asked ChatGPT to write Migrations for objects
5. Write bootstrap html for services appointment form 
6. Write Laravel controller to save service appointment
7. Write laravel controller and view to show list of service appointments
8. Write Laravel factory for these objects service, service staff, customer 
9. Write Laravel seeder for these objects service, service staff, customer
10. write laravel controller code to find an image in storage and delete if it exists
11. write migration to add image field to service object
12. write laravel view and controller function to save image for a service object
13. write code to delete previously uploaded image in laravel controller
14. write simple navbar in bootstrap 
15. write minimal footer in bootstrap 
