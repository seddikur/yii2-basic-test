-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.34 - MySQL Community Server (GPL)
-- Операционная система:         Linux
-- HeidiSQL Версия:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица yii.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Дамп данных таблицы yii.migration: ~9 rows (приблизительно)
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1729581787),
	('m241022_065421_create_table_users', 1732627193),
	('m241022_070932_seed_user', 1732627195),
	('m241022_082101_create_table_projects', 1732627195),
	('m241022_084833_seed_projects_table', 1732627196),
	('m241123_125706_add_users_role_field', 1732627196),
	('m241124_113935_add_users_ip_field', 1732627196),
	('m241124_141539_create_table_organizations', 1732627196),
	('m241124_141936_create_table_organization_user', 1732627196),
	('m241124_142842_create_seed_organizations', 1732627196),
	('m241126_142909_add_users_avatar_field', 1732631764);

-- Дамп структуры для таблица yii.organizations
CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Описание',
  `created_at` int(11) DEFAULT NULL COMMENT 'Создана',
  `updated_at` int(11) DEFAULT NULL COMMENT 'Изменена',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Организации';

-- Дамп данных таблицы yii.organizations: ~10 rows (приблизительно)
INSERT INTO `organizations` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'ОАО ГазБашкирЖелДорПроф', 'Voluptatibus quibusdam exercitationem optio quaerat dolores. Voluptas officia nobis et similique. Et culpa qui magni et. Facere fugiat in ipsum ipsam voluptate.', 1732627196, NULL),
	(2, 'МКК Мобайл', 'Distinctio fuga magni quod est sunt. Aliquid repellat dicta dolore dolor. Dolore quia eos maiores aut provident hic. Non deserunt quidem reiciendis iure et non.', 1732627196, NULL),
	(3, 'МКК CибБухСтрой', 'Et dicta repudiandae omnis sed eveniet ea id repellat. Ut consequatur non vel consequatur ut. Et excepturi soluta explicabo reiciendis doloremque maxime.', 1732627196, NULL),
	(4, 'ЗАО МикроСантехБухЛизинг', 'Sed deleniti excepturi rerum sunt qui. Laboriosam tempore rerum quod impedit qui. Ut architecto deserunt aspernatur hic consequatur. Et similique sit alias.', 1732627196, NULL),
	(5, 'МКК Нефть', 'Quis accusantium repudiandae voluptatem ratione odit dolorem. Rerum quod itaque dolores porro est qui fugit.', 1732627196, NULL),
	(6, 'ЗАО ГорВод', 'Maiores et eaque qui. In eos itaque laudantium perspiciatis cum incidunt quia. Fugiat officiis et odio atque dicta est est.', 1732627196, NULL),
	(7, 'ЗАО ГлавГлавРыбЭкспедиция', 'Voluptatem sunt beatae provident atque eveniet. Eaque non tempora pariatur. Quis est maiores repellat tempore.', 1732627196, NULL),
	(8, 'МФО УралITРосКомплекс', 'Eos eos rerum voluptatem. In a libero sed quisquam. Maxime quidem est qui eius consectetur non.', 1732627196, NULL),
	(9, 'ООО Компания РечСофтЭлектроКомплекс', 'Odit similique et cumque quam. Aut voluptate repellat omnis rerum.', 1732627196, NULL),
	(10, 'МФО РыбТранс', 'Ut dolorem ut repellat hic dignissimos facilis rerum. Ad et facilis aut sit deleniti. Itaque suscipit hic dolorum at unde.', 1732627196, NULL);

-- Дамп структуры для таблица yii.organization_user
CREATE TABLE IF NOT EXISTS `organization_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'ID пользователя',
  `organization_id` int(11) NOT NULL COMMENT 'ID организации',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `fk_organization_user_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`),
  CONSTRAINT `fk_organization_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Организации-Пользователь';

-- Дамп данных таблицы yii.organization_user: ~0 rows (приблизительно)

-- Дамп структуры для таблица yii.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Описание',
  `price` int(11) DEFAULT NULL COMMENT 'Цена',
  `created_at` int(11) DEFAULT NULL COMMENT 'Дата создания',
  `data_result` int(11) DEFAULT NULL COMMENT 'Дата сдачи',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT 'Статус',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_projects_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Проекты';

-- Дамп данных таблицы yii.projects: ~50 rows (приблизительно)
INSERT INTO `projects` (`id`, `title`, `description`, `price`, `created_at`, `data_result`, `user_id`, `status`) VALUES
	(1, 'Front-line well-modulated definition', 'Minus eos eum et autem quod eveniet tenetur. Id soluta adipisci optio repellat et sed. Deserunt tenetur quasi sunt quaerat nam voluptas voluptate.', 62400, 1732627195, 1732627195, 1, 4),
	(2, 'Re-engineered heuristic GraphicInterface', 'Ad quo nisi rem sit neque. Commodi facere hic quae ullam ipsa. Voluptatibus sit vel magni id harum.', 88592, 1732627195, 1732627195, 1, 2),
	(3, 'Adaptive fault-tolerant service-desk', 'Vero quaerat suscipit voluptatum culpa quia aliquid rerum. Illum quod quidem sapiente perspiciatis in quis. Blanditiis eaque est hic eos et. Et nam aut excepturi excepturi.', 47486, 1732627195, 1732627195, 1, 4),
	(4, 'Persistent modular toolset', 'Quod vitae reiciendis ut voluptas. Commodi a voluptas occaecati enim quam harum. Tempore est fuga aspernatur rerum illo.', 41491, 1732627195, 1732627195, 1, 2),
	(5, 'Public-key user-facing standardization', 'Consequatur ducimus itaque et fuga earum in. Id nesciunt non laboriosam doloremque quia minus. Et minus quas facilis qui et eos.', 30577, 1732627195, 1732627195, 1, 1),
	(6, 'Re-engineered empowering processimprovement', 'Dolorem id nihil optio non quas facere et. Distinctio aut totam minus. Aut perspiciatis qui iure.', 86769, 1732627195, 1732627195, 1, 2),
	(7, 'Multi-channelled motivating leverage', 'Rem cum doloribus voluptas omnis. Et natus et harum mollitia unde. Placeat qui aut nihil qui.', 36315, 1732627195, 1732627195, 1, 2),
	(8, 'Networked upward-trending productivity', 'Corrupti aliquid itaque qui occaecati ut modi dolorem. Et ullam sapiente sit qui animi eos atque molestiae.', 81280, 1732627195, 1732627195, 1, 0),
	(9, 'Total heuristic groupware', 'Est enim laborum nam beatae voluptatibus temporibus facere. Inventore omnis optio dolorem ut.', 52007, 1732627195, 1732627195, 1, 1),
	(10, 'Stand-alone 5thgeneration blockchain', 'Dolores hic qui vel voluptates fugiat consectetur ipsa et. Omnis maiores dolorem est velit voluptatem.', 51754, 1732627195, 1732627195, 1, 1),
	(11, 'Programmable transitional model', 'At cum sapiente et qui nihil dolores necessitatibus. Et fugiat quasi unde minima. Aliquid quo suscipit neque earum.', 84324, 1732627195, 1732627195, 1, 4),
	(12, 'Adaptive stable task-force', 'Voluptas quia dignissimos perspiciatis nisi eum. Placeat magnam molestiae iusto nisi et ipsum porro. Earum voluptas aut est.', 59813, 1732627195, 1732627195, 1, 2),
	(13, 'Multi-lateral eco-centric toolset', 'Eius recusandae dolores et reiciendis exercitationem. Et quos eaque ut fugit. Recusandae dolorem deleniti ut optio culpa distinctio dolorum. Quam fuga ullam et dolor omnis et debitis.', 89824, 1732627195, 1732627195, 1, 3),
	(14, 'Public-key multimedia leverage', 'Aut quidem ad sit id delectus facilis. In qui iure quam sed excepturi ab maxime. Rerum quia commodi et enim quod omnis magni neque.', 23026, 1732627195, 1732627195, 1, 1),
	(15, 'Robust foreground localareanetwork', 'Molestiae incidunt saepe beatae. Molestias voluptas ipsum totam rerum natus maxime beatae aut.', 31188, 1732627195, 1732627195, 1, 2),
	(16, 'Cross-platform high-level framework', 'Et nihil molestias sint tenetur. Minima possimus harum voluptatem et. Ex saepe qui ducimus et quidem. Unde non ex voluptas iste et.', 52897, 1732627195, 1732627195, 1, 1),
	(17, 'Profit-focused impactful methodology', 'Sequi sunt molestiae rerum aut. Est est quia officiis sequi et. Perferendis illum voluptatem optio voluptates. Vitae iusto nulla consequuntur occaecati consequatur.', 41138, 1732627195, 1732627195, 1, 2),
	(18, 'Open-architected well-modulated structure', 'Et est libero quia fugiat qui aut incidunt. Cupiditate aspernatur aut minima et distinctio eius earum.', 33388, 1732627195, 1732627195, 1, 0),
	(19, 'Function-based empowering forecast', 'Dolorem qui dolor odio sit aperiam. Et sed est neque voluptates sed exercitationem. Debitis non architecto nihil perspiciatis nihil rerum. Et sint odio inventore.', 78478, 1732627195, 1732627195, 1, 3),
	(20, 'Monitored non-volatile utilisation', 'Alias voluptas saepe omnis. Laborum est ex corrupti culpa nisi velit id itaque.', 59511, 1732627195, 1732627195, 1, 2),
	(21, 'Focused bifurcated functionalities', 'Et sit quo quia nam vel provident in. Itaque minus maiores iure fugiat ut.', 87120, 1732627195, 1732627195, 1, 0),
	(22, 'Switchable asynchronous application', 'Eos voluptas sunt voluptatum ut omnis et. Id est accusamus odio. Tempore ipsum doloribus labore pariatur non fugiat. Fugit impedit placeat nihil temporibus.', 76912, 1732627195, 1732627195, 1, 3),
	(23, 'Ameliorated modular alliance', 'Aut laborum asperiores et harum et. Dolor fugiat et consequatur. Sapiente illo occaecati voluptas. Aliquid aut culpa at aperiam facilis.', 66138, 1732627195, 1732627195, 1, 1),
	(24, 'Horizontal client-driven flexibility', 'Impedit soluta perspiciatis voluptas ducimus. Quia suscipit eum sequi qui aliquid.', 62891, 1732627195, 1732627195, 1, 0),
	(25, 'Networked clear-thinking encoding', 'Molestiae eveniet sunt eum fuga architecto. Repellendus eum alias excepturi aut id. Corrupti error sapiente sunt ab.', 29388, 1732627195, 1732627195, 1, 2),
	(26, 'Implemented intermediate array', 'Distinctio quia voluptatem aut. Blanditiis qui voluptatem et voluptatibus autem.', 89571, 1732627195, 1732627195, 1, 3),
	(27, 'Visionary foreground info-mediaries', 'Quos odit hic ad et praesentium velit. Magni eos ducimus sint deserunt maiores et.', 45090, 1732627195, 1732627195, 1, 3),
	(28, 'Re-engineered solution-oriented interface', 'Temporibus hic et ex culpa earum hic et. Eligendi ab in accusamus dolores debitis.', 81186, 1732627195, 1732627195, 1, 3),
	(29, 'Devolved even-keeled customerloyalty', 'Voluptas nihil quisquam ex assumenda eaque. Odit quaerat sint veniam quisquam quod porro. Eum iusto totam dolorum ratione rerum omnis.', 45859, 1732627195, 1732627195, 1, 4),
	(30, 'Cross-platform 3rdgeneration algorithm', 'Et dicta adipisci quo dolores cumque. Qui fugit sit distinctio occaecati. Et veniam omnis exercitationem quod nemo fugit eius.', 45631, 1732627195, 1732627195, 1, 3),
	(31, 'Expanded 24/7 strategy', 'Eum non soluta et. Sint est et nesciunt nihil recusandae et ut. Asperiores magni quia porro suscipit sed id in. Quibusdam officia est est eius totam. Nam eveniet ut laboriosam ratione doloremque.', 74694, 1732627195, 1732627195, 1, 2),
	(32, 'Switchable full-range contingency', 'Enim esse quae quia molestiae facere enim. Blanditiis eveniet possimus dicta aut nulla. Recusandae rerum optio cum occaecati commodi dolorem. Rem rerum quo consectetur.', 77963, 1732627195, 1732627195, 1, 3),
	(33, 'Grass-roots homogeneous paradigm', 'Ullam consequatur provident necessitatibus et cupiditate. Nostrum similique a et quia quia. Omnis quod debitis quidem aliquid quia qui expedita.', 73627, 1732627195, 1732627195, 1, 1),
	(34, 'Public-key coherent firmware', 'Tempore aut cumque laudantium omnis consequatur et. Accusamus sit beatae iste voluptatem illum enim autem. Alias quisquam reiciendis laborum et.', 74878, 1732627195, 1732627195, 1, 4),
	(35, 'Switchable dynamic service-desk', 'Est dolorum perferendis iusto sunt. Aut quis quis officiis velit quidem eaque. Dolore aliquid sit nemo libero ipsum.', 49408, 1732627195, 1732627195, 1, 0),
	(36, 'Mandatory multi-tasking openarchitecture', 'Esse vel repellendus omnis modi. Totam eveniet aut praesentium sequi tempora. Inventore alias et est iusto est.', 27081, 1732627195, 1732627195, 1, 3),
	(37, 'Exclusive uniform hub', 'Rerum voluptatem ut ad sed distinctio qui voluptatibus. Repellendus quo dolor optio vero commodi vel et. Dolores eum odio et sit consequatur.', 35695, 1732627195, 1732627195, 1, 0),
	(38, 'Diverse client-server GraphicInterface', 'Mollitia ipsa a ut error. Culpa temporibus rerum facere alias.', 54571, 1732627195, 1732627195, 1, 2),
	(39, 'Synergistic modular internetsolution', 'Repellendus iste quia omnis amet. Tempora in earum dolorum autem et. Dolorum aut dolor maiores itaque recusandae. Enim sint enim sed at ipsam velit quisquam.', 75265, 1732627195, 1732627195, 1, 3),
	(40, 'Future-proofed zeroadministration info-mediaries', 'Adipisci atque beatae voluptatem. Nulla fuga et repudiandae qui. Atque ipsa facere voluptate vel.', 39950, 1732627195, 1732627195, 1, 2),
	(41, 'Object-based methodical throughput', 'Dolorum vel delectus consequatur. Ducimus qui eos ab eum. Tempore veritatis similique non saepe autem sint ut. Laborum animi quis voluptate.', 79430, 1732627195, 1732627195, 1, 1),
	(42, 'Robust zerotolerance artificialintelligence', 'Aperiam aliquam rerum et sint. Autem unde quisquam a voluptatem. Modi ad velit eos et quos error et inventore. Sed consequatur velit eos labore.', 82134, 1732627195, 1732627195, 1, 3),
	(43, 'Organic client-driven orchestration', 'Vel aperiam voluptatibus vel alias nostrum est rerum. Explicabo perspiciatis quisquam ipsa ut. Tenetur sed voluptatem asperiores quaerat minus non sequi.', 89022, 1732627195, 1732627195, 1, 0),
	(44, 'Open-source multi-state conglomeration', 'Aut velit harum blanditiis maiores reiciendis est. Nihil dicta sunt nisi molestiae. Enim facilis quam odio numquam.', 23495, 1732627195, 1732627195, 1, 4),
	(45, 'Operative 24/7 data-warehouse', 'Voluptas impedit dolor enim. Quisquam voluptates est odit magni minus similique rem. Et cum aliquid non a atque. Voluptas explicabo fugiat provident odio et.', 29922, 1732627195, 1732627195, 1, 2),
	(46, 'Implemented contextually-based customerloyalty', 'Non tenetur dolores voluptatibus ut. Ab dicta natus distinctio saepe velit. Quaerat et aut molestiae accusamus enim.', 75664, 1732627195, 1732627195, 1, 4),
	(47, 'Vision-oriented bottom-line firmware', 'Rerum fuga ut et qui odio autem. Eius voluptates quia aspernatur quibusdam ea non. Consequatur in labore officia quos culpa minima.', 44992, 1732627195, 1732627195, 1, 2),
	(48, 'Self-enabling methodical ability', 'Vel deleniti et dolorum quia sit. Ut ut tenetur aut ad pariatur. Voluptas tempore autem velit voluptatem laboriosam.', 52924, 1732627195, 1732627195, 1, 2),
	(49, 'Organized real-time info-mediaries', 'Ex quaerat aliquid amet expedita sint aut. Autem doloremque ut quas ut corporis.', 43275, 1732627195, 1732627195, 1, 4),
	(50, 'User-centric stable projection', 'Dolore et facere eos. Nihil optio aut rem quia qui. Aut aut quidem culpa quo.', 70631, 1732627195, 1732627195, 1, 4);

-- Дамп структуры для таблица yii.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Логин',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'E-mail',
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Фамилия',
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Имя',
  `patronymic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Отчество',
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT 'Статус',
  `created_at` int(11) NOT NULL COMMENT 'Создан',
  `updated_at` int(11) NOT NULL COMMENT 'Изменен',
  `role` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Роль пользователя',
  `ip` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Ip',
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Аватарка',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Пользователи';

-- Дамп данных таблицы yii.users: ~3 rows (приблизительно)
INSERT INTO `users` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `last_name`, `first_name`, `patronymic`, `verification_token`, `status`, `created_at`, `updated_at`, `role`, `ip`, `avatar`) VALUES
	(1, 'admin', 'W9HirRe4pdCMSTMWE9_xof5ifsDXWVFA', '$2y$13$Jmu9Ogc3BGVOTfXys/nULe.r1jRd5Rujyfp8fl3spO9fdRpZG/7Eu', 'MBmLeNvhXe3-qdmaSwbJsutyD4OSMAXN_1732627194', 'galina80@narod.ru', 'Орлов', 'Даниил', 'Евгеньевич', 'CkCJIUBDLpRLBiacnzziR0owsbrl5tXi_1732627194', 1, 1732627194, 1732627194, 'admin', '172.20.0.1', NULL),
	(2, 'test', 'rL8vnvDsW4nWAcYWs0BGae6XSrTPvjW1', '$2y$13$jfi8qV.8f7n6Js7ik8yQFuLvIMQKuLdihBuegenn6xmVubUscUDSi', 'gerpDVG0jTV30JCQZXHtIfBjqUEbpLwM_1732627195', 'donat.ponomarev@mail.ru', 'Бобылёв', 'Валерия', 'Виктор Львович Яковлев', 'ktrHgssqbTcnVqaBxEZjAt0Z6OxjyvuH_1732627195', 1, 1732627194, 1732686087, 'user', '172.20.0.1', NULL),
	(3, 'user', 'r34dlBq5zlv8er7hI7Owp9UXOduIHF3G', '$2y$13$X7Y.D/VJ4UXhaEYScrO08u9kWTewtUGG58X5H57B3b.7lPV378.PG', 'h7zhp7BEOnw8ms0JCojl_HBHcaP8UOJR_1732627195', 'klim.birukov@mail.ru', 'Ефимова', 'Лада', 'Артём Фёдорович Мартынов', 'UQTJd2KqsRQygWEXPbEEH3Q23aNBHd9O_1732627195', 1, 1732627194, 1732627194, 'admin', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
