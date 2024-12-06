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

-- Дамп структуры для таблица yii.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Описание',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT 'Статус',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Группы пользователей';

-- Дамп данных таблицы yii.groups: ~5 rows (приблизительно)
INSERT INTO `groups` (`id`, `title`, `description`, `status`) VALUES
	(1, 'Группа 1', 'Velit aspernatur quod dolorem. Quia distinctio sint voluptas deleniti odio necessitatibus. Aliquid hic ipsum quia et nemo.', 2),
	(2, 'Группа 2', 'Aliquam natus illo veniam et nam. Architecto dolores eum possimus totam.', 2),
	(3, 'Группа 3', 'Iusto sed nobis quisquam cupiditate quos eos quis. Aspernatur voluptatum perspiciatis consequatur ea et eligendi velit et. Ullam et doloribus et laborum.', 1),
	(4, 'Группа 4', 'Dolores sit aspernatur sunt non. Qui odit odit sunt quod eligendi rerum quae. Explicabo vel sunt officia non et consequatur laborum.', 1);

-- Дамп структуры для таблица yii.group_password
CREATE TABLE IF NOT EXISTS `group_password` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password_id` int(11) NOT NULL COMMENT 'Пароль',
  `group_id` int(11) NOT NULL COMMENT 'Группа',
  PRIMARY KEY (`id`),
  KEY `password_id` (`password_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `fk_group_password_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `fk_group_password_password_id` FOREIGN KEY (`password_id`) REFERENCES `passwords` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Группы-пароли';

-- Дамп данных таблицы yii.group_password: ~8 rows (приблизительно)
INSERT INTO `group_password` (`id`, `password_id`, `group_id`) VALUES
	(1, 1, 2),
	(2, 1, 3),
	(3, 2, 3),
	(4, 2, 4),
	(9, 3, 1),
	(10, 3, 2),
	(11, 3, 3),
	(12, 3, 4);

-- Дамп структуры для таблица yii.group_user
CREATE TABLE IF NOT EXISTS `group_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `group_id` int(11) NOT NULL COMMENT 'Группа',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `fk_group_user_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `fk_group_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Группы-пользователи';

-- Дамп данных таблицы yii.group_user: ~4 rows (приблизительно)
INSERT INTO `group_user` (`id`, `user_id`, `group_id`) VALUES
	(1, 2, 1),
	(2, 3, 4),
	(3, 1, 3),
	(5, 4, 1);

-- Дамп структуры для таблица yii.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Дамп данных таблицы yii.migration: ~17 rows (приблизительно)
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1733387806),
	('m241022_065421_create_table_users', 1733401581),
	('m241022_070932_seed_user', 1733401583),
	('m241022_082101_create_table_projects', 1733401583),
	('m241022_084833_seed_projects_table', 1733401584),
	('m241123_125706_add_users_role_field', 1733401584),
	('m241124_113935_add_users_ip_field', 1733401584),
	('m241124_141539_create_table_organizations', 1733401584),
	('m241124_141936_create_table_organization_user', 1733401584),
	('m241124_142842_create_seed_organizations', 1733401584),
	('m241126_142909_add_users_avatar_field', 1733401585),
	('m241127_115533_create_table_password', 1733401585),
	('m241203_134038_create_table_service', 1733401585),
	('m241205_081052_create_table_user_group', 1733401585),
	('m241205_081723_create_table_password_group', 1733401586),
	('m241205_121357_add_password_service_field', 1733401586),
	('m241206_070444_create_table_group_user', 1733468913);

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
	(1, 'ЗАО Хоз', 'Est eum nobis quis. Ratione facilis numquam ipsa ab accusamus. Et quam totam dolores voluptates ut ipsum.', 1733401584, NULL),
	(2, 'ЗАО ТрансТрансЭлектро-H', 'Nemo ducimus voluptatibus incidunt dignissimos atque et blanditiis. Amet placeat eum consequatur maiores minus at.', 1733401584, NULL),
	(3, 'ЗАО РадиоБашкирТомск', 'Quidem aliquid quae maiores saepe et voluptas nam vero. Expedita aut quia fugit quis suscipit inventore. Aut perspiciatis ut dolor voluptates.', 1733401584, NULL),
	(4, 'МФО ФлотСтройСервис', 'Et sit sint qui at veritatis. Perspiciatis quaerat culpa quia perspiciatis. Et possimus omnis beatae nostrum non error quas.', 1733401584, NULL),
	(5, 'ОАО ТекстильРосУрал', 'Nesciunt laudantium sit eos minus. Quia est occaecati atque sed debitis.', 1733401584, NULL),
	(6, 'ЗАО Монтаж', 'Corrupti animi ex consectetur quisquam quo nam. Dolorum et tenetur velit sed ab ullam distinctio.', 1733401584, NULL),
	(7, 'МКК Хмель', 'Veritatis iusto dolorem nisi. Optio inventore perspiciatis molestiae vel provident. Omnis distinctio nam quia deleniti.', 1733401584, NULL),
	(8, 'ОАО ЦементМясТекстильТрест', 'Quaerat omnis ut omnis mollitia. Perspiciatis dolore voluptatem excepturi quas sapiente quo molestiae. Qui suscipit vitae aut aut qui.', 1733401584, NULL),
	(9, 'ОАО ГазЮпитерРыбСбыт', 'Cum vitae et quia labore beatae perspiciatis dolores. Vel qui ipsum aut facilis aut. Odit officiis quas et excepturi dicta quisquam totam.', 1733401584, NULL),
	(10, 'ОАО ФинансIT', 'Autem explicabo eum culpa blanditiis. Deleniti sint molestiae et perspiciatis. Voluptatem ratione vitae ab.', 1733401584, NULL);

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

-- Дамп структуры для таблица yii.passwords
CREATE TABLE IF NOT EXISTS `passwords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sault` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Создан',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'password',
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'hash',
  `organization_id` int(11) NOT NULL COMMENT 'ID организации',
  `created_at` int(11) DEFAULT NULL COMMENT 'Создан',
  `updated_at` int(11) DEFAULT NULL COMMENT 'Изменен',
  `ip` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Ip',
  `service_id` int(11) DEFAULT NULL COMMENT 'Сервис',
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `fk_passwords_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`),
  CONSTRAINT `fk_passwords_service_id` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Пароли';

-- Дамп данных таблицы yii.passwords: ~3 rows (приблизительно)
INSERT INTO `passwords` (`id`, `sault`, `password`, `hash`, `organization_id`, `created_at`, `updated_at`, `ip`, `service_id`) VALUES
	(1, 'B2-UvsmbVgPPowPP6Q-vdLFUiWloMLqo', '93pKaFrLpMC3bgKlCJ0Ykh3pxK9yc87B31ulnfHOkQ2cu8+E5U62J4sYvsyOvzXPIp+iYkTOPIMmQXE+Evc2oQ==', '85d3f91d128176b8aa85720ed786eb12', 2, 1733401940, 1733401940, NULL, 3),
	(2, 'B2-UvsmbVgPPowPP6Q-vdLFUiWloMLqo', '3WFw6udO3gotSQ4ZmGUWa6kyjXjKTlSCZpGvxAzsiPVdIZjyEGpICYA07Y4f5dWyVmfCl9P5riHDnKarfnYZ7w==', '954213986835f7c187bf6a98af057a5c', 4, 1733401969, 1733401969, NULL, 4),
	(3, 'B2-UvsmbVgPPowPP6Q-vdLFUiWloMLqo', '2AtRFebL0GY2f8eQispYZ10rQXVJ/BEniTyk3rv9wrVzWcUdEF+6lHcUdLPS1c++ColdwtCMYu9Cd8aBUiJEIw==', '34e0f90c5f4c9805344127a43feb3025', 2, 1733401995, 1733402011, NULL, 5);

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
	(1, 'Team-oriented homogeneous solution', 'Ab doloribus rerum eos a earum. Voluptas enim sed expedita debitis.', 53974, 1733401583, 1733401583, 1, 2),
	(2, 'Organic impactful ability', 'Sit qui autem explicabo aspernatur totam soluta. Et et error voluptatibus at velit.', 79687, 1733401583, 1733401583, 1, 3),
	(3, 'Enterprise-wide optimal support', 'Quo consectetur et labore consequuntur odio praesentium. Natus sit quo cum illo voluptate et.', 44216, 1733401583, 1733401583, 1, 2),
	(4, 'Networked discrete solution', 'Soluta aut quod voluptatem asperiores. Velit et ut ratione rerum sapiente animi sit et.', 63706, 1733401583, 1733401583, 1, 2),
	(5, 'Grass-roots homogeneous framework', 'Sed dolor dignissimos voluptate voluptate. Corporis optio expedita et explicabo. Sunt suscipit nulla saepe nam.', 88060, 1733401583, 1733401583, 1, 0),
	(6, 'Re-engineered secondary definition', 'Voluptatum neque reiciendis quo velit nostrum. Et blanditiis labore quos et.', 51200, 1733401583, 1733401583, 1, 3),
	(7, 'Total holistic collaboration', 'Asperiores et quo eaque dolores officia placeat est quis. Quaerat illum doloremque illum alias. Fugiat non hic ratione ut quis sequi.', 78895, 1733401583, 1733401583, 1, 4),
	(8, 'Secured exuding paradigm', 'Eum dolor explicabo quibusdam. Cumque qui eveniet recusandae in. Est quos quae sed aperiam. Voluptas ut facilis sed ea sit non ab.', 30053, 1733401583, 1733401583, 1, 1),
	(9, 'User-centric didactic definition', 'Non placeat omnis qui nulla exercitationem. Cum quia quam natus. Et a accusamus maxime aliquid.', 43587, 1733401583, 1733401583, 1, 2),
	(10, 'Future-proofed 5thgeneration benchmark', 'Amet iure ab rerum eaque qui. Voluptates et exercitationem aliquid cum. Aut aut aspernatur tempore aut.', 27585, 1733401583, 1733401583, 1, 2),
	(11, 'Multi-layered 24/7 task-force', 'Eveniet error sit maxime numquam quos fugit eaque. Repellat sed voluptate sed voluptas quam rerum.', 62474, 1733401583, 1733401583, 1, 0),
	(12, 'Versatile coherent hierarchy', 'Unde voluptas et molestias sunt nostrum ab porro. Cum explicabo nam tempore hic dolores illo. Temporibus laboriosam nesciunt in temporibus sint ut.', 55523, 1733401583, 1733401583, 1, 2),
	(13, 'Intuitive empowering analyzer', 'Cupiditate cumque velit consequuntur iure rerum. Quidem veniam dolore praesentium rerum quo ab.', 60701, 1733401583, 1733401583, 1, 0),
	(14, 'Function-based systemic capability', 'Ipsa reiciendis quis aut. Non nemo et cumque enim omnis est. Non et saepe quidem laboriosam dolorem ut alias. Laborum nihil autem sint nihil eligendi quo.', 73523, 1733401583, 1733401583, 1, 4),
	(15, 'Implemented well-modulated ability', 'Eaque a non dolores iure magni consequatur. Voluptatum beatae repudiandae cum quibusdam nobis facilis corporis. Iusto fugiat porro modi consequatur officia quas.', 71507, 1733401583, 1733401583, 1, 4),
	(16, 'Organized attitude-oriented capability', 'Cum architecto expedita esse voluptatem. Nihil aut rerum animi iusto iusto cum.', 77515, 1733401583, 1733401583, 1, 3),
	(17, 'Organic neutral openarchitecture', 'Quod et modi eos possimus. Et accusamus eligendi quia et sunt.', 48835, 1733401583, 1733401583, 1, 1),
	(18, 'Versatile 4thgeneration portal', 'Sed cum id ut enim ab voluptatem. Reprehenderit ratione veniam et dolores. Eaque id vero est ut. Quae nisi quas recusandae illo eum veritatis sed.', 37111, 1733401583, 1733401583, 1, 1),
	(19, 'Polarised tangible database', 'Harum quia unde eum ut ducimus aliquam nihil. Autem et iusto perferendis.', 25287, 1733401583, 1733401583, 1, 0),
	(20, 'Reactive bifurcated application', 'Eius dignissimos quis et. Sint laudantium suscipit quaerat voluptatum. Laboriosam minima id iure eos tempore aut.', 23217, 1733401583, 1733401583, 1, 2),
	(21, 'Fundamental foreground instructionset', 'Earum consequatur ut atque animi et. Assumenda sed id et sequi voluptatum. Numquam odio dolores doloremque voluptates aut.', 39263, 1733401583, 1733401583, 1, 3),
	(22, 'Robust responsive project', 'Placeat consequatur aperiam sit laudantium. Tempora non repellat perferendis culpa laborum.', 37801, 1733401583, 1733401583, 1, 2),
	(23, 'Re-contextualized eco-centric internetsolution', 'At repudiandae deleniti dignissimos. Magnam aut corporis distinctio nulla suscipit corporis. Temporibus qui voluptatem in aperiam qui. Qui perferendis et minus qui.', 20738, 1733401583, 1733401583, 1, 4),
	(24, 'Networked systematic attitude', 'Est aliquid expedita ut in odit laborum. Doloremque voluptatem assumenda iusto. Quae nobis et modi sapiente.', 57066, 1733401583, 1733401583, 1, 2),
	(25, 'Inverse client-server migration', 'Molestias ad labore dolorem. Numquam reiciendis perferendis ad quaerat optio est quia. Iste quidem aut dolorem non.', 26242, 1733401583, 1733401583, 1, 3),
	(26, 'Fully-configurable methodical core', 'Numquam repudiandae est fugiat voluptatum quas. Eos eos possimus rerum quos quis. Nulla amet enim officia voluptatum.', 27094, 1733401583, 1733401583, 1, 2),
	(27, 'Proactive high-level analyzer', 'Sit et rerum consequatur. Fugit sed alias sed quos qui non quo. Quidem dicta enim quae.', 61858, 1733401583, 1733401583, 1, 1),
	(28, 'Implemented tangible database', 'A pariatur enim modi. Doloremque dolores incidunt est. Omnis explicabo veritatis qui ut.', 35263, 1733401583, 1733401583, 1, 1),
	(29, 'Cross-platform intangible portal', 'Quis ut quos qui. Et ut inventore in vel. Sed adipisci ut quos laborum ut molestiae et excepturi. Voluptatem in voluptatem non qui.', 67327, 1733401583, 1733401583, 1, 1),
	(30, 'Object-based client-server toolset', 'Ipsa quibusdam rerum accusantium consectetur quam libero dolorem. Officiis totam ipsa amet nulla et. Ullam nihil reiciendis deleniti.', 52525, 1733401583, 1733401583, 1, 4),
	(31, 'Configurable motivating attitude', 'Laboriosam aut iure sunt pariatur officiis tempora. Enim et rem hic beatae sit. Laudantium in facilis voluptas ut corrupti. Atque fugiat qui assumenda alias nesciunt qui.', 47134, 1733401583, 1733401583, 1, 3),
	(32, 'Organic methodical initiative', 'Numquam rerum incidunt sapiente tenetur autem. Ut pariatur voluptate ut. Qui dicta cumque qui iure sint.', 43616, 1733401583, 1733401583, 1, 3),
	(33, 'Persevering logistical throughput', 'Ullam vel in rem. Id deleniti magnam exercitationem aut et. Nihil voluptatibus id sed animi repellat.', 30371, 1733401583, 1733401583, 1, 3),
	(34, 'Re-contextualized responsive implementation', 'Dolorum nobis quam error aut. Numquam officiis minima quia placeat dolores fugit.', 54161, 1733401583, 1733401583, 1, 1),
	(35, 'Reverse-engineered hybrid attitude', 'Molestias veritatis ea ab necessitatibus. Fuga placeat ad quia qui. Earum ut voluptatem officia dolores quasi cupiditate et.', 53168, 1733401583, 1733401583, 1, 0),
	(36, 'Reverse-engineered neutral workforce', 'Tempora tempora id consectetur eum eaque. Et qui fugiat autem ab ut. Quis et doloremque iusto sunt. Consectetur nesciunt distinctio optio non.', 85003, 1733401583, 1733401583, 1, 1),
	(37, 'Customer-focused multi-tasking functionalities', 'Est est nesciunt ratione id aut omnis. Est sapiente magnam magnam molestias. Quibusdam cumque necessitatibus est aut totam harum et et.', 59887, 1733401583, 1733401583, 1, 4),
	(38, 'Optimized static installation', 'Dolorem quos rerum rem eum. Maiores velit quos natus blanditiis qui consequatur accusantium. Culpa maxime labore amet nihil.', 79682, 1733401583, 1733401583, 1, 3),
	(39, 'Organic eco-centric framework', 'Alias perferendis ipsa est et officia. Alias consequuntur tempora non quisquam necessitatibus beatae saepe qui.', 48088, 1733401583, 1733401583, 1, 0),
	(40, 'Up-sized homogeneous infrastructure', 'Voluptatem in in veritatis. In molestiae aut sunt animi vel.', 48604, 1733401583, 1733401583, 1, 4),
	(41, 'Visionary stable flexibility', 'Harum odio ex eligendi porro odio ex. Explicabo sunt voluptate enim esse sint expedita ipsum.', 83144, 1733401583, 1733401583, 1, 1),
	(42, 'Cross-group eco-centric superstructure', 'Magni odit corrupti mollitia voluptate voluptatem est. Ullam dolore voluptatum ad quaerat ducimus. Nemo occaecati architecto quasi est.', 35541, 1733401583, 1733401583, 1, 0),
	(43, 'Multi-lateral optimal intranet', 'Est sed non quod eligendi. Dolorum qui eius eveniet. Doloremque optio ipsum laboriosam atque sed. Sed perspiciatis fugiat voluptas suscipit.', 51286, 1733401583, 1733401583, 1, 2),
	(44, 'Implemented content-based synergy', 'Necessitatibus animi rem libero eaque. Dolore commodi id consequatur voluptates.', 46871, 1733401583, 1733401583, 1, 0),
	(45, 'Assimilated nextgeneration capability', 'Voluptas ipsam quis et. Incidunt blanditiis et officiis nisi at. Exercitationem ducimus atque eveniet eos. Omnis enim et est delectus omnis.', 28221, 1733401583, 1733401583, 1, 2),
	(46, 'Exclusive systematic approach', 'Dolores sit dolorem fuga ut ut aut. Quis id voluptas quasi a sequi et temporibus. Veniam quisquam et dignissimos odit aut aliquam.', 31315, 1733401583, 1733401583, 1, 1),
	(47, 'Diverse holistic algorithm', 'Et ut qui eos autem. Illum molestiae non dolores ut. Aut libero quasi qui dolor.', 45142, 1733401583, 1733401583, 1, 2),
	(48, 'Fundamental analyzing access', 'Aut in aut earum atque iure voluptates reiciendis. At exercitationem illo earum minus voluptates.', 70748, 1733401583, 1733401583, 1, 2),
	(49, 'Team-oriented demand-driven data-warehouse', 'Numquam suscipit cupiditate magni veritatis dolorem numquam veritatis. Inventore perspiciatis amet omnis cumque. Nisi sit voluptas similique dolor consequatur omnis pariatur sunt.', 50256, 1733401583, 1733401583, 1, 1),
	(50, 'Operative systematic solution', 'In quod culpa fuga ex ea dicta. Rerum magnam dolores doloribus. Consequuntur sint nam sint qui est quas quam. Officia maiores sed quia quidem.', 60165, 1733401583, 1733401583, 1, 0);

-- Дамп структуры для таблица yii.service
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Сервис';

-- Дамп данных таблицы yii.service: ~5 rows (приблизительно)
INSERT INTO `service` (`id`, `title`) VALUES
	(1, 'Сервис 1'),
	(2, 'Сервис 2'),
	(3, 'Сервис 3'),
	(4, 'Сервис 4'),
	(5, 'Сервис 5'),
	(6, 'Сервис 6');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Пользователи';

-- Дамп данных таблицы yii.users: ~4 rows (приблизительно)
INSERT INTO `users` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `last_name`, `first_name`, `patronymic`, `verification_token`, `status`, `created_at`, `updated_at`, `role`, `ip`, `avatar`) VALUES
	(1, 'admin', 'B2-UvsmbVgPPowPP6Q-vdLFUiWloMLqo', '$2y$13$ssWzX1Bl7vB9Z3IUUn.4/.ml5YuPrCQePIkQt9lzydqK9u2qpeZJm', '6t0zMpEctNt1zztSwenx7HPtlrZ1Ls6X_1733401582', 'sukina.tatana@martynova.com', 'Аксёнов', 'Марта', 'Борисовна ', 'GAr59HGalZW4Dzlqg3wldOhBU_ZVluSZ_1733401582', 1, 1733401581, 1733473743, 'admin', '172.20.0.1', NULL),
	(2, 'test', 'lOUEjxnUAikJBzSEUcJTkBNzMl52pmtc', '$2y$13$cnsyljPpbcXMttwCJug3POIN45XL0osjAsxg8SGcvzmiVUIxFAsqG', 'N1a24evJHeZWFVNwBXscRrct_ETM-t1Q_1733401582', 'malvina.ponomarev@aleksandrova.com', 'Королёва', 'Марина', 'Фёдоровна ', '7_NMX-_gpsjbDsU74qciV2BSxZkMF0Eg_1733401582', 1, 1733401581, 1733470795, 'user', '172.20.0.1', NULL),
	(3, 'user', 'Ysrcb1e8lcq3VEKCNazAShGV_wF5hSZa', '$2y$13$8Fvfo8E3aOmj/WuUAKggNOGmORRnXlMkc3ajcZoeBWVMXgz2eR72.', 'IaAQJadwnVcT0zn7Dh31Bo4BIPBOWbUW_1733401583', 'mdavydova@savelev.ru', 'Герасимов', 'Михаил', 'Максимовмч', 'x0ebH9H1CJLUXCe3355FFtnUK2eiYpfU_1733401583', 1, 1733401581, 1733473735, 'user', NULL, NULL),
	(4, 'ivan', 'Sugum3G0PGAqdssCnvzLCzHzIvDQNCfM', '$2y$13$Me2oHkldFx9JLQoxSjsYM./Nr.P58vSWocqUezcAa34utyErkwZYq', 'gK53dMPTKwE2rCcARN-64tODE7W78Yy8_1733473789', 'ivan@rr.ru', 'Иванов', 'Иван', 'Иванович', NULL, 1, 1733473789, 1733473950, 'user', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
