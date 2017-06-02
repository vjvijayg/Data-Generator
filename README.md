# Data-Generator
The purpose of the project is to design and implement Data Generator for SAP solutions, for creating
realistic data sets. Using the meta information of business processes involved in SAP ERP, data types
for the generator are defined. Data can be generated as per user requirement of the data types. This
data can be used for analysis purposes in SAP BW.

Data Generator runs on Xampp server. MySQL workbench acts as a user interface for accessing
the MySQL Database for Data generation.

### Steps for Installing Xampp server: XAMPP is a free and open source cross-platform web server solution stack package. This could be
downloaded [here](https://www.apachefriends.org/download.html).
1. Once downloaded, open the setup file. Click Next.
2. Select Components screen would appear. All the necessary components are already preselected. Now, click Next untill setup process
finishes
3. Open the XAMPP server using the launch icon.
4. On the User Control Panel, Click Start button for Apache server.
5. Make sure to Start with Administrator rights by clicking on the Admin button if needed.
6. Apache server uses Port number 80, 443.

### Steps for Installing MySQL workbench: MySQL workbench can be downloaded [here](https://dev.mysql.com/downloads/workbench/)
1. Open the setup file and select Run.
2. On the User account control, Click Yes.
3. On the MySQL Installer screen, accept the license agreement after reading the instructions.
4. Click Next
5. Select Custom in the Choosing a Setup Type screen. Click Next.
6. On the Select Products and Features, select the MySQL servers and click the transferbutton so that it appears in the Products/
Features to be Installed tab.
7. Select the MySQL server in Products/ Features to be Installed tab so that the Next button is enabled.
8. Click Next.
9. On the Installation screen, click Execute and the installation starts.
10. Once the installation is complete, Next button pops up and select Next.
11. On the Product configuration screen select Next.
12. On the Type and Networking screen, select Development machine for Config type.
13. For Connectivity, select TCP/IP with port number 3306 and Open Firewall port for Network access. Select Next
14. On to the Account and Roles screen, Create a new MySQL Root Password.
15. For MySQL User Accounts, click Add User and MySQL User Details pops up.
16. Create a new Username with Host as All Hosts, Role as DB Admin and Authentication as MySQL. Create a new Password. Confirm by
selecting OK.
17. Then the newly created username appears on the MySQL User accounts. Select Next.
18. Click Next on Windows service screen without changing the default values.
19. Select execute on the Apply Server Configuration screen. Configuration process starts accordingly.
20. Once the configuration is done. Click Finish.
21. Select Next on the Product configuration screen. Click Finish.
22. Now open the MySQL Workbench
23. Select the Username created earlier and enter the password.
24. Once login is successful, MySQL workbench can be used for accessing the Database files.

## EXECUTION INSTRUCTIONS:

1. First run database file using MySQL workbench. This should generate database and tables with default data.
2. Place project in Xampp/htdocs and unzip it.
3. Go to database/ folder and open DBHandler.php file.
4. Enter username and password of your MySQL connection and save the file.
5. Start apache in XAMPP control panel.
6. Open browser and enter localhost/DataGenerator.

#### Steps for data generation:
1. Select the Customer button
2. Select year
3. Type in the fields needed under Column Title and select the corresponding Data type.
4. Select the Add New button for additional rows.
5. Select the format of export data – Excel / CSV / JSON
6. Click on Generate. Export Files are generated.
