<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-10-17 12:47:59 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: styles ~ APPPATH/classes/Controller/Static.php [ 18 ] in /home/victor/projects/konkurs.dlyanee.loc/www/application/classes/Controller/Static.php:18
2013-10-17 12:47:59 --- DEBUG: #0 /home/victor/projects/konkurs.dlyanee.loc/www/application/classes/Controller/Static.php(18): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/victor/pr...', 18, Array)
#1 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Controller.php(84): Controller_Static->action_index()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Static))
#4 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /home/victor/projects/konkurs.dlyanee.loc/www/index.php(118): Kohana_Request->execute()
#7 {main} in /home/victor/projects/konkurs.dlyanee.loc/www/application/classes/Controller/Static.php:18
2013-10-17 12:48:12 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: styles ~ APPPATH/classes/Controller/Static.php [ 18 ] in /home/victor/projects/konkurs.dlyanee.loc/www/application/classes/Controller/Static.php:18
2013-10-17 12:48:12 --- DEBUG: #0 /home/victor/projects/konkurs.dlyanee.loc/www/application/classes/Controller/Static.php(18): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/victor/pr...', 18, Array)
#1 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Controller.php(84): Controller_Static->action_index()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Static))
#4 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 /home/victor/projects/konkurs.dlyanee.loc/www/index.php(118): Kohana_Request->execute()
#7 {main} in /home/victor/projects/konkurs.dlyanee.loc/www/application/classes/Controller/Static.php:18
2013-10-17 12:50:35 --- EMERGENCY: ErrorException [ 8 ]: Array to string conversion ~ APPPATH/views/template.php [ 12 ] in /home/victor/projects/konkurs.dlyanee.loc/www/application/views/template.php:12
2013-10-17 12:50:35 --- DEBUG: #0 /home/victor/projects/konkurs.dlyanee.loc/www/application/views/template.php(12): Kohana_Core::error_handler(8, 'Array to string...', '/home/victor/pr...', 12, Array)
#1 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/View.php(61): include('/home/victor/pr...')
#2 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/View.php(348): Kohana_View::capture('/home/victor/pr...', Array)
#3 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#4 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#5 [internal function]: Kohana_Controller->execute()
#6 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Static))
#7 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#9 /home/victor/projects/konkurs.dlyanee.loc/www/index.php(118): Kohana_Request->execute()
#10 {main} in /home/victor/projects/konkurs.dlyanee.loc/www/application/views/template.php:12
2013-10-17 13:09:00 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: js ~ APPPATH/views/template.php [ 20 ] in /home/victor/projects/konkurs.dlyanee.loc/www/application/views/template.php:20
2013-10-17 13:09:00 --- DEBUG: #0 /home/victor/projects/konkurs.dlyanee.loc/www/application/views/template.php(20): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/victor/pr...', 20, Array)
#1 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/View.php(61): include('/home/victor/pr...')
#2 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/View.php(348): Kohana_View::capture('/home/victor/pr...', Array)
#3 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#4 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#5 [internal function]: Kohana_Controller->execute()
#6 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Static))
#7 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#9 /home/victor/projects/konkurs.dlyanee.loc/www/index.php(118): Kohana_Request->execute()
#10 {main} in /home/victor/projects/konkurs.dlyanee.loc/www/application/views/template.php:20
2013-10-17 14:38:03 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: res_folder ~ APPPATH/views/pages/vote.php [ 8 ] in /home/victor/projects/konkurs.dlyanee.loc/www/application/views/pages/vote.php:8
2013-10-17 14:38:03 --- DEBUG: #0 /home/victor/projects/konkurs.dlyanee.loc/www/application/views/pages/vote.php(8): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/victor/pr...', 8, Array)
#1 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/View.php(61): include('/home/victor/pr...')
#2 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/View.php(348): Kohana_View::capture('/home/victor/pr...', Array)
#3 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/View.php(228): Kohana_View->render()
#4 /home/victor/projects/konkurs.dlyanee.loc/www/application/views/template.php(59): Kohana_View->__toString()
#5 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/View.php(61): include('/home/victor/pr...')
#6 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/View.php(348): Kohana_View::capture('/home/victor/pr...', Array)
#7 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Controller.php(87): Kohana_Controller_Template->after()
#9 [internal function]: Kohana_Controller->execute()
#10 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Static))
#11 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#12 /home/victor/projects/konkurs.dlyanee.loc/www/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#13 /home/victor/projects/konkurs.dlyanee.loc/www/index.php(118): Kohana_Request->execute()
#14 {main} in /home/victor/projects/konkurs.dlyanee.loc/www/application/views/pages/vote.php:8
2013-10-17 17:10:29 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '[', expecting ',' or ';' ~ APPPATH/views/template.php [ 27 ] in file:line
2013-10-17 17:10:29 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2013-10-17 17:10:55 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '[', expecting ',' or ';' ~ APPPATH/views/template.php [ 27 ] in file:line
2013-10-17 17:10:55 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line