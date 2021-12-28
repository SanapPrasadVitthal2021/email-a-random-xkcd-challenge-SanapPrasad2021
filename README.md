[![Open in Visual Studio Code](https://classroom.github.com/assets/open-in-vscode-f059dc9a6f8d3a56e377f745f24479a46679e63a5d9fe6f495e02850cd0d8118.svg)](https://classroom.github.com/online_ide?assignment_repo_id=6625827&assignment_repo_type=AssignmentRepo)

Hi, my name is Prasad Sanap.
This is the Email A Random XKCD Challenge assignment.

-----Description-----
This is a simple PHP application that accepts a visitor’s email address and emails them random XKCD comics every five minutes. And every mail contains the unsubscribe link so they can stop the receiving email.

In the email the are receving the information related to xkcd comic.

-----Table-----
In this application I use one table for getting information from the visitors.
 
Table-visitor_det
Fields- 1)fname:For first name.
        2)lname:For last name.
        3)email:For email address.
        4)vkey:For verification key.
        5)verified:For verification.
        6)date_time:For date and time.
        7)action:For start and stop sending mails.

----- Database -----
I use for this assignment mysql database which is virtual.



----- How to run -----
Note: You need to install xampp for run this project.
1.Download this file and paste it into [C:\xampp\htdocs].
2.Create database or import [visitor_det.sql] file into your localhost.
3.Update [databaseConnection.php] with your credentials.
4.Start your xampp.
5.Goto browser and navigate your php script.


----- Cron job -----
Cron job means run your script auto in spacefic time. No need to run it manually.
For offline purpose I create there two file for cron job that are script.bat and shellscript.vbs in that I trigger the php script that is randomMail.php.

----- How to set it for specific time -----
Go to Start >> Control Panel >> Scheduled Tasks >> Add Scheduled Task>>
Add [shellscript.vbs] file as schedular>>Set time in that.

----- Include Credit -----
1.https://www.youtube.com/
2.https://www.google.com/

----- Youtube Channels -----
1.phpBasics
2.programming with vishal
3.Justin Stolpe
4.CodeWithHarry


----- Contact Details -----
Name: Prasad Vitthal Sanap
Mobile: 8149533136
email: fmc202158@zealeducation.com


