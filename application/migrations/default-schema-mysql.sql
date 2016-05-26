CREATE DATABASE IF NOT EXISTS `konkurs_dlyanee` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE `konkurs_dlyanee`;

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `roles` (`id`, `name`, `description`) VALUES(1, 'login', 'Login privileges, granted after account confirmation');
INSERT INTO `roles` (`id`, `name`, `description`) VALUES(2, 'admin', 'Administrative user, has access to everything.');

CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `logins` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last_login` int(10) UNSIGNED,
  `sum_likes` int(11) DEFAULT '0',
  `phone` varchar(45) DEFAULT NULL,
  `town` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_code_id` int(45) DEFAULT NULL,
  `slogan` TEXT NULL,
  `status` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`,`email`,`username`,`password`,`logins`,`last_login`,`sum_likes`,`phone`,`town`,`date`,`user_code_id`,`slogan`,`status`) 
VALUES (1,'admin@admin.ua','admin','ffacdca3acf960a344d6a69c399d7f3d4f3f75a0c78ca06bb12237145a1b99a3', 0, 0, 0,'','','2013-11-01 00:00:00',1,'',0);
INSERT INTO `roles_users` (`user_id`,`role_id`) VALUES (1,2);
INSERT INTO `roles_users` (`user_id`,`role_id`) VALUES (1,1);

CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  KEY `expires` (`expires`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `roles_users`
  ADD CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

CREATE TABLE `likes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `cookie` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE  TABLE `temp_users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `ip_addr` VARCHAR(45) NULL ,
  `date_first_reg` DATETIME NULL DEFAULT NULL ,
  `cookie` VARCHAR(45) NULL ,
  `mobile` VARCHAR(1) NULL ,
  `robot` VARCHAR(1) NULL ,
  `info` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `cookie_UNIQUE` (`cookie` ASC)
  )ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE  TABLE `gifts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `url` VARCHAR(255) NULL ,
  `date_created` DATETIME NULL DEFAULT NULL ,
  `priority` int(11) UNSIGNED NOT NULL ,
  `status` int(11) UNSIGNED NOT NULL,
   
   PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE  TABLE `gifts_photo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_gift` int(11) UNSIGNED NOT NULL ,
  `date_created` DATETIME NULL DEFAULT NULL ,
  `path` VARCHAR(45) NULL ,
  `status` int(11) UNSIGNED NOT NULL,
  
   PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE  TABLE `winners` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` int(11) UNSIGNED NOT NULL ,
  `date_of_win` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
   UNIQUE KEY `uniq_date_of_win` (`date_of_win`)
   )ENGINE=InnoDB DEFAULT CHARSET=utf8;

   CREATE  TABLE `photos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` int(11) UNSIGNED NOT NULL ,
  `photo_name` VARCHAR(256) NULL  ,
   `date_add` DATETIME NULL DEFAULT NULL ,
    `date_edit` DATETIME NULL DEFAULT NULL ,
    `status` int(11) UNSIGNED NOT NULL ,
    `using_photo` VARCHAR(15) NULL,
  PRIMARY KEY (`id`)  
   )ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE  TABLE `pages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `path_name` VARCHAR(90) NULL,
  `title` VARCHAR(90) NULL,
  `text` VARCHAR(90) NULL,
  `meta_description` VARCHAR(90) NULL,
  `meta_keywords` VARCHAR(90) NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_path_name` (`path_name`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE  TABLE `page_blocks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `page_id` VARCHAR(90) NULL,
  `title` VARCHAR(90) NULL,
  `text` VARCHAR(90) NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE  TABLE `codes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(45) NULL ,
  `date_used` VARCHAR(45) NULL , 
   PRIMARY KEY (`id`) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE  TABLE `options` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `value` VARCHAR(255) NULL ,
  `name_ru` VARCHAR(255) NULL , 
  `description_ru` TEXT NULL,  
   PRIMARY KEY (`id`), 
   UNIQUE KEY `uniq_path_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `options` (`id`,`name`,`value`,`name_ru`,`description_ru`) VALUES (1,'DAYS_TO_EDIT_USER','10','Редактирование профиля','Количество дней после регистрации, в которые уасница сможет редактировать свой профиль');
INSERT INTO `options` (`id`,`name`,`value`,`name_ru`,`description_ru`) VALUES (2,'DAYS_TO_EDIT_USER_TEXT','Изменение данных доступно 10 дней после регистрации','Сообщение об изменении данных пользователя','Сообщение, которое показывает сколько времени пользователь может менять свои данные');

