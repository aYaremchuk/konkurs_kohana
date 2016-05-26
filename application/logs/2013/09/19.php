<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-09-19 09:32:54 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: index_view ~ APPPATH/views/template.php [ 10 ] in /home/victor/projects/kohana/www/application/views/template.php:10
2013-09-19 09:32:54 --- DEBUG: #0 /home/victor/projects/kohana/www/application/views/template.php(10): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/victor/pr...', 10, Array)
#1 /home/victor/projects/kohana/www/system/classes/Kohana/View.php(61): include('/home/victor/pr...')
#2 /home/victor/projects/kohana/www/system/classes/Kohana/View.php(348): Kohana_View::capture('/home/victor/pr...', Array)
#3 /home/victor/projects/kohana/www/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#4 /home/victor/projects/kohana/www/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#5 [internal function]: Kohana_Controller->execute()
#6 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Welcome))
#7 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 /home/victor/projects/kohana/www/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#9 /home/victor/projects/kohana/www/index.php(118): Kohana_Request->execute()
#10 {main} in /home/victor/projects/kohana/www/application/views/template.php:10
2013-09-19 12:28:41 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: index_view ~ APPPATH/views/template.php [ 11 ] in /home/victor/projects/kohana/www/application/views/template.php:11
2013-09-19 12:28:41 --- DEBUG: #0 /home/victor/projects/kohana/www/application/views/template.php(11): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/victor/pr...', 11, Array)
#1 /home/victor/projects/kohana/www/system/classes/Kohana/View.php(61): include('/home/victor/pr...')
#2 /home/victor/projects/kohana/www/system/classes/Kohana/View.php(348): Kohana_View::capture('/home/victor/pr...', Array)
#3 /home/victor/projects/kohana/www/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#4 /home/victor/projects/kohana/www/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#5 [internal function]: Kohana_Controller->execute()
#6 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Page))
#7 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 /home/victor/projects/kohana/www/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#9 /home/victor/projects/kohana/www/index.php(118): Kohana_Request->execute()
#10 {main} in /home/victor/projects/kohana/www/application/views/template.php:11