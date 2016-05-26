<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-09-20 11:33:21 --- EMERGENCY: ErrorException [ 1 ]: Class 'Controller_Common' not found ~ APPPATH/classes/Controller/Page.php [ 3 ] in file:line
2013-09-20 11:33:21 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-09-20 11:33:36 --- EMERGENCY: ErrorException [ 1 ]: Class 'Controller_Common' not found ~ APPPATH/classes/Controller/Page.php [ 3 ] in file:line
2013-09-20 11:33:36 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-09-20 11:34:04 --- EMERGENCY: ErrorException [ 1 ]: Class 'Controller_Common' not found ~ APPPATH/classes/Controller/Page.php [ 3 ] in file:line
2013-09-20 11:34:04 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-09-20 11:34:05 --- EMERGENCY: ErrorException [ 1 ]: Class 'Controller_Common' not found ~ APPPATH/classes/Controller/Page.php [ 3 ] in file:line
2013-09-20 11:34:05 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-09-20 11:34:07 --- EMERGENCY: ErrorException [ 1 ]: Class 'Controller_Common' not found ~ APPPATH/classes/Controller/Page.php [ 3 ] in file:line
2013-09-20 11:34:07 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-09-20 11:45:39 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: title ~ APPPATH/views/template.php [ 6 ] in /home/victor/projects/kohana/www/application/views/template.php:6
2013-09-20 11:45:39 --- DEBUG: #0 /home/victor/projects/kohana/www/application/views/template.php(6): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/victor/pr...', 6, Array)
#1 /home/victor/projects/kohana/www/system/classes/Kohana/View.php(61): include('/home/victor/pr...')
#2 /home/victor/projects/kohana/www/system/classes/Kohana/View.php(348): Kohana_View::capture('/home/victor/pr...', Array)
#3 /home/victor/projects/kohana/www/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#4 /home/victor/projects/kohana/www/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#5 [internal function]: Kohana_Controller->execute()
#6 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Welcome))
#7 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 /home/victor/projects/kohana/www/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#9 /home/victor/projects/kohana/www/index.php(118): Kohana_Request->execute()
#10 {main} in /home/victor/projects/kohana/www/application/views/template.php:6