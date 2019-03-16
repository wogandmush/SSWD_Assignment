---Read Me---

I guess we can list who does what on this page

    ----Web Application Requirements----

 - Handle form data in a secure mannger e.g. use HTML and PHP validation techniques when handling user input

 - Make the website look professional by using good CSS techniques (frameworks) and appropriate content

 - Your HTML, CSS, and PHP code should be original and commented. You may be asked to explain any piece of code. Failure to understand and explain code may be taken as evidence of plagarism. You may use frameworks such as bootstrap. All HTML and CSS should be validated

 - PHP code should be modular e.g. include several header and footer files as opposed to copying and pasting the same code to several pages

 - The home page of the site should be called index.php

 - Your website should follow best practice in terms of security
 
 - Store its data in a MySQL database

 - Connection to the database should be made using one file (e.g. connect.php)
 
 - Database table names shoudl be singular e.g. user not users.

 
    ----Pages----

		(Key)
 - P = Public
 - M = Member
 - A = Admin

<pagename> : (db) <tablename> : P M A (access level)

index : page : P M A
 - Basic information about fitness center, plus 2 feature boxes.
 - A feature box should highlight new classes, events, special offers etc. 
 - Each feature should contain a title, detail, an image, and an optional link to another page in the website ( for more information )

index_edit : page : - - A
 - Allows the editing of the feature information presented on the homepage


registration : user & fee : P M A
 - Displays fee information and allows member to register.
 - There should be 3 fees levels with differing title, benefits, and price
 - Member must choose which classes they are registering for

registration_edit : fee : - - A
 - Allows the fee information to be updated


class : class : P M A
 - Displays a list of class summaries, and their associated photo, and link
 - All photos should be stored in a folder - not on the database
 - The link brings the logged in user to the relevent class page (using GET) and sends them to the login page

class_details : class : - M A
 - Show 1 attractively formatted row from the 'class' table.
 - This is shown when a link is clicked on the class page.
 - This should display a class title, detailed description, and a link to some document

class_details_edit : class : - - A
 - Allows the editing of the class information


testimonial : testimonial : P M A
 - Shows a list of admin approved testimonials given by members

testimonial_add : testimonial : - M A
 - Allows a logged in member to give a testimonial about a class. 
 - Each testimonial should contain:
   * the class name, 
   * the date, 
   * the member's first name, 
   * and their comment

tesimonial_manage : testimonial : - - A
 - Allows the admin to decide which testimonials are displayed


contact_us : contact_us : P M A
 - Form enabling members of the public to leave a message, which should contain
   * Name
   * Email
   * Phone no
   * Message

contact_us_manage : contact_us : - M A
 - Allows the reading of the messages


header : n/a : P M A
 - Session start, connect.php, links to all pages appropriate to the user level.
 - Prevent unauthenticated users from accessing inappropriate content
 - The header should contain the navigation bar
 - A user login box supporting both member and admin login 
 - The header should query the page table to populate a dropdown with the name of all accessible pages 
 - You can choose to have one header which programmatically adapts to who is logged in, or have 3 different header files

logout : n/a : P M A
 - A user should be able to access a logout script from a link in the header.
 - When this logout script executes, the session should be destroyed and the user should recieve a logout confirmation message, before being return to the index page

