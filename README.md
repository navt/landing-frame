# landing frame

Watching some "developers" use tools to create landing pages,<br>
with which you can create social networking platforms (I mean [InstantCMS](https://github.com/instantsoft/icms2)), involuntarily<br>
I come to the idea of a mismatch between the task and the tools by which this task is solved.<br>
This PHP application provides a minimal basic set for creating a landing page.<br>

The idea of ​​the application is simple, pairs are written to the table: a unique name and a fragment of text<br>
(table blocks). It is important that the unique name begins with a letter. Further information from<br>
the table gets into the array and, then, using `extract()` is extracted into separate variables,<br>
which are displayed in the right places of your template.<br>
The template (`/view/front/tamplates/page.php`) is a regular html+css+js.<br>

The application is intentionally written simply. All constants are defined in `/index.php`.<br>
If you need to expand the functionality of the application, and it will almost certainly be<br>
you need, create your controllers. The PHP code you need can also be written<br>
directly in the template.<br>

### How to deploy the application

Import `/files/data/db.sql` into your database.<br>
Put the contents of this repository at the root of your site.<br>
Enter the values ​​for your database in `/library/config/config.php`.<br>
Go to `yoursite.com/staff/viewForm`, use demo@demo.ru / qwerty<br>
to enter the admin part.
