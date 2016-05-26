<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-09-14 20:58:37 --- EMERGENCY: ErrorException [ 4096 ]: Argument 1 passed to Kohana_Arr::is_assoc() must be of the type array, integer given, called in /home/victor/projects/kohana/www/system/classes/Kohana/Arr.php on line 433 and defined ~ SYSPATH/classes/Kohana/Arr.php [ 30 ] in /home/victor/projects/kohana/www/system/classes/Kohana/Arr.php:30
2013-09-14 20:58:37 --- DEBUG: #0 /home/victor/projects/kohana/www/system/classes/Kohana/Arr.php(30): Kohana_Core::error_handler(4096, 'Argument 1 pass...', '/home/victor/pr...', 30, Array)
#1 /home/victor/projects/kohana/www/system/classes/Kohana/Arr.php(433): Kohana_Arr::is_assoc(1)
#2 /home/victor/projects/kohana/www/system/classes/Kohana/Config/File/Reader.php(49): Kohana_Arr::merge(Array, 1)
#3 /home/victor/projects/kohana/www/system/classes/Kohana/Config.php(130): Kohana_Config_File_Reader->load('mysite')
#4 /home/victor/projects/kohana/www/application/classes/Controller/Welcome.php(14): Kohana_Config->load('mysite')
#5 /home/victor/projects/kohana/www/system/classes/Kohana/Controller.php(84): Controller_Welcome->action_test()
#6 [internal function]: Kohana_Controller->execute()
#7 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Welcome))
#8 /home/victor/projects/kohana/www/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /home/victor/projects/kohana/www/system/classes/Kohana/Request.php(986): Kohana_Request_Client->execute(Object(Request))
#10 /home/victor/projects/kohana/www/index.php(118): Kohana_Request->execute()
#11 {main} in /home/victor/projects/kohana/www/system/classes/Kohana/Arr.php:30
2013-09-14 21:15:17 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Config_Group::load() ~ APPPATH/classes/Controller/Welcome.php [ 13 ] in file:line
2013-09-14 21:15:17 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line