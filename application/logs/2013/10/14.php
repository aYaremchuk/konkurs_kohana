<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-10-14 13:53:14 --- EMERGENCY: Database_Exception [ 1044 ]: Access denied for user ''@'localhost' to database 'kohana' ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 108 ] in /home/victor/projects/kohana/www/modules/database/classes/Kohana/Database/MySQL.php:75
2013-10-14 13:53:14 --- DEBUG: #0 /home/victor/projects/kohana/www/modules/database/classes/Kohana/Database/MySQL.php(75): Kohana_Database_MySQL->_select_db('kohana')
#1 /home/victor/projects/kohana/www/modules/database/classes/Kohana/Database/MySQL.php(171): Kohana_Database_MySQL->connect()
#2 /home/victor/projects/kohana/www/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT * FROM a...', false, Array)
#3 /home/victor/projects/kohana/www/application/classes/Model/Article.php(16): Kohana_Database_Query->execute()
#4 /home/victor/projects/kohana/www/application/classes/Controller/Static.php(12): Model_Article->get_all()
#5 /home/victor/projects/kohana/www/system/classes/Kohana/Controller.php(84): Controller_Static->action_index()
#6 [internal function]: Kohana_Controller->execute()
#7 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Static))
#8 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /home/victor/projects/kohana/www/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#10 /home/victor/projects/kohana/www/index.php(118): Kohana_Request->execute()
#11 {main} in /home/victor/projects/kohana/www/modules/database/classes/Kohana/Database/MySQL.php:75
2013-10-14 15:05:17 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Model_Article::get_all() ~ APPPATH/classes/Controller/Static.php [ 12 ] in file:line
2013-10-14 15:05:17 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-14 15:07:01 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '.', expecting function (T_FUNCTION) ~ APPPATH/classes/Model/Article.php [ 7 ] in file:line
2013-10-14 15:07:01 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-14 16:02:21 --- EMERGENCY: View_Exception [ 0 ]: The requested view /pages/articles1 could not be found ~ SYSPATH/classes/Kohana/View.php [ 257 ] in /home/victor/projects/kohana/www/system/classes/Kohana/View.php:137
2013-10-14 16:02:21 --- DEBUG: #0 /home/victor/projects/kohana/www/system/classes/Kohana/View.php(137): Kohana_View->set_filename('/pages/articles...')
#1 /home/victor/projects/kohana/www/system/classes/Kohana/View.php(30): Kohana_View->__construct('/pages/articles...', NULL)
#2 /home/victor/projects/kohana/www/application/classes/Controller/Articles.php(8): Kohana_View::factory('/pages/articles...')
#3 /home/victor/projects/kohana/www/system/classes/Kohana/Controller.php(84): Controller_Articles->action_index()
#4 [internal function]: Kohana_Controller->execute()
#5 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Articles))
#6 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /home/victor/projects/kohana/www/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#8 /home/victor/projects/kohana/www/index.php(118): Kohana_Request->execute()
#9 {main} in /home/victor/projects/kohana/www/system/classes/Kohana/View.php:137
2013-10-14 18:13:55 --- EMERGENCY: ErrorException [ 1 ]: Class 'Model_Comment' not found ~ SYSPATH/classes/Kohana/Model.php [ 26 ] in file:line
2013-10-14 18:13:55 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line