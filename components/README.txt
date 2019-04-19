---Overview of components and classes---

The classes in this directory can be broken down into three main categories

1 - Form-related classes:
  * For creating forms
  * Have bootstrap classes built in
  * Form-element classes auto-sanitize input when setData method is called


2 - Content-related classes
  * For dealing with content drawn from database
  * Map data to html using the getHTMLString and render methods

3 - Stand-alone helper classes
  * Used to group (static) methods by functionality

There are also two interfaces which these classes implement
 - Component:
   * for classes which can render HTML to the page
	 methods: getHTMLString(), render();
 - Crudable:
   * for classes which interact with database (dynamic, admin-managed content);
     methods: create(), read() (static), update(), delete()

---List of classes by category---

1. Form-related classes: (All implement Component)
 - Form.php
 - Button.php
 - Field.abs.php (abstract)
 |_ Input.php
 |_ TextArea.php
 |_ OptionField.abs.php (abstract)
  |_ Select.php 
  |_ Radio.php
  |_ CheckBox.php

2. Content-related classes: (Implement Component, Crudable);
 - Feature.php
 - Testimonial.php

3. Stand-alone helper classes:
 - PathHelper
   * for getting the absolute path/root regardless of path of current file
 - IOHelper
   * for dealing with file-system related tasks (clearing directories, listing files, etc)
 - DBConnect
   * For getting a database connection (DBConnect::getConnection());
 - Validator
   * Contains a group of methods for validating user input


Refer to individual php files for more detailed explanations/lists of methods
