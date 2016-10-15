-- Створюємо DB 
-- DROP DATABASE IF EXISTS complaintbook;
CREATE DATABASE IF NOT EXISTS complaintbook;

-- ##############################################
-- Структура таблиці users
-- DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL DEFAULT 'Admin' COMMENT 'user name',
	login VARCHAR(50) NOT NULL COMMENT 'user login',
	pass VARCHAR(255) NOT NULL COMMENT 'user password',
    user_hash VARCHAR(255) COMMENT 'user hash',
	CONSTRAINT pkey_users PRIMARY KEY (id),
	CONSTRAINT ixLogin UNIQUE KEY (login)
)
    ENGINE=InnoDB
    CHARACTER SET utf8
	COLLATE utf8_general_ci
	COMMENT 'Модератор';

-- Дамп даних таблиці `users`
-- DELETE IGNORE FROM  users;1234
INSERT IGNORE INTO `users` (`id`, `name`, `login`, `pass`) VALUES
(1,'Admin', 'admin','$2a$13$va0r2JOjPHbUitpDf04aw.bqhuSZsH9TRx6fANmmxTFyDcVnawB9W');


-- ##############################################
-- Структура таблиці complaints
-- DROP TABLE IF EXISTS complaints;
CREATE TABLE IF NOT EXISTS complaints
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL COMMENT 'Name user',
	email VARCHAR(50) NOT NULL  COMMENT 'Email Users',
	site VARCHAR(50)  DEFAULT NULL COMMENT 'Site',
    country CHAR(3) DEFAULT NULL COMMENT 'Country user',
    complaint TEXT NOT NULL COMMENT 'Text complaint',
    adddate DATETIME DEFAULT NOW() COMMENT 'Date creation',
    browser VARCHAR(50) NOT NULL DEFAULT '' COMMENT '',
    ipaddress VARCHAR(50) NOT NULL DEFAULT '' COMMENT '',
	CONSTRAINT pkey_complaints PRIMARY KEY (id),
	INDEX ixNamee (username),
    INDEX ixEmail (email),
    INDEX ixDate (adddate)
)
    ENGINE=InnoDB
    CHARACTER SET utf8
	COLLATE utf8_general_ci
	COMMENT 'Таблиця скарг';

-- #######################################################
-- Структура таблиці `countriescodes`
-- DROP TABLE IF EXISTS countriescodes;

CREATE TABLE IF NOT EXISTS `countriescodes` (
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Трёх символьные коды стран (ISO) с их названияме на русско  ';

-- Дамп даних таблиці `countries_codes`
-- DELETE IGNORE FROM countriescodes

INSERT INTO `countriescodes` (`code`, `title`) VALUES
('AFG', 'Афганистан'),
('ALB', 'Албания'),
('DZA', 'Алжир'),
('AND', 'Андорра'),
('AGO', 'Ангола'),
('ATG', 'Антигуа и Барбуда'),
('ARG', 'Аргентина'),
('ARM', 'Армения'),
('AUS', 'Австралия'),
('AUT', 'Австрия'),
('AZE', 'Азербайджан'),
('BHS', 'Багамы'),
('BHR', 'Бахрейн'),
('BGD', 'Бангладеш'),
('BRB', 'Барбадос'),
('BLR', 'Беларусь'),
('BEL', 'Бельгия'),
('BLZ', 'Белиз'),
('BEN', 'Бенин'),
('BTN', 'Бутан'),
('BOL', 'Боливия'),
('BIH', 'Босния и Герцеговина'),
('BWA', 'Ботсвана'),
('BRA', 'Бразилия'),
('BRN', 'Бруней-Даруссалам'),
('BGR', 'Болгария'),
('BFA', 'Буркина-Фасо'),
('BDI', 'Бурунди'),
('KHM', 'Камбоджа'),
('CMR', 'Камерун'),
('CAN', 'Канада'),
('CPV', 'Кабо-Верде'),
('CAF', 'Центрально-Африканская Республика'),
('TCD', 'Чад'),
('CHL', 'Чили'),
('CHN', 'Китай'),
('COL', 'Колумбия'),
('COM', 'Коморы'),
('COD', 'Конго, Демократическая Республика'),
('COG', 'Конго'),
('CRI', 'Коста-Рика'),
('CIV', 'Кот д''Ивуар'),
('HRV', 'Хорватия'),
('CUB', 'Куба'),
('CYP', 'Кипр'),
('CZE', 'Чешская Республика'),
('DNK', 'Дания'),
('DJI', 'Джибути'),
('DMA', 'Доминика'),
('DOM', 'Доминиканская Республика'),
('ECU', 'Эквадор'),
('EGY', 'Египет'),
('SLV', 'Эль-Сальвадор'),
('GNQ', 'Экваториальная Гвинея'),
('ERI', 'Эритрея'),
('EST', 'Эстония'),
('ETH', 'Эфиопия'),
('FJI', 'Фиджи'),
('FIN', 'Финляндия'),
('FRA', 'Франция'),
('GAB', 'Габон'),
('GMB', 'Гамбия'),
('GEO', 'Грузия'),
('DEU', 'Германия'),
('GHA', 'Гана'),
('GRC', 'Греция'),
('GRD', 'Гренада'),
('GTM', 'Гватемала'),
('GIN', 'Гвинея'),
('GNB', 'Гвинея-Бисау'),
('GUY', 'Гайана'),
('HTI', 'Гаити'),
('HND', 'Гондурас'),
('HUN', 'Венгрия'),
('ISL', 'Исландия'),
('IND', 'Индия'),
('IDN', 'Индонезия'),
('IRN', 'Иран, Исламская Республика'),
('IRQ', 'Ирак'),
('IRL', 'Ирландия'),
('ISR', 'Израиль'),
('ITA', 'Италия'),
('JAM', 'Ямайка'),
('JPN', 'Япония'),
('JOR', 'Иордания'),
('KAZ', 'Казахстан'),
('KEN', 'Кения'),
('KIR', 'Кирибати'),
('PRK', 'Северная Корея'),
('KOR', 'Южная Корея'),
('KWT', 'Кувейт'),
('KGZ', 'Киргизия'),
('LAO', 'Лаос'),
('LVA', 'Латвия'),
('LBN', 'Ливан'),
('LSO', 'Лесото'),
('LBR', 'Либерия'),
('LBY', 'Ливийская Арабская Джамахирия'),
('LIE', 'Лихтенштейн'),
('LTU', 'Литва'),
('LUX', 'Люксембург'),
('MKD', 'Республика Македония'),
('MDG', 'Мадагаскар'),
('MWI', 'Малави'),
('MYS', 'Малайзия'),
('MDV', 'Мальдивы'),
('MLI', 'Мали'),
('MLT', 'Мальта'),
('MHL', 'Маршалловы острова'),
('MRT', 'Мавритания'),
('MUS', 'Маврикий'),
('MEX', 'Мексика'),
('FSM', 'Микронезия, Федеративные Штаты'),
('MDA', 'Молдова, Республика'),
('MCO', 'Монако'),
('MNG', 'Монголия'),
('MNE', 'Черногория'),
('MAR', 'Марокко'),
('MOZ', 'Мозамбик'),
('MMR', 'Мьянма'),
('NAM', 'Намибия'),
('NRU', 'Науру'),
('NPL', 'Непал'),
('NLD', 'Нидерланды'),
('NZL', 'Новая Зеландия'),
('NIC', 'Никарагуа'),
('NER', 'Нигер'),
('NGA', 'Нигерия'),
('NOR', 'Норвегия'),
('OMN', 'Оман'),
('PAK', 'Пакистан'),
('PLW', 'Палау'),
('PAN', 'Панама'),
('PNG', 'Папуа-Новая Гвинея'),
('PRY', 'Парагвай'),
('PER', 'Перу'),
('PHL', 'Филиппины'),
('POL', 'Польша'),
('PRT', 'Португалия'),
('QAT', 'Катар'),
('ROU', 'Румыния'),
('RUS', 'Россия'),
('RWA', 'Руанда'),
('KNA', 'Сент-Китс и Невис'),
('LCA', 'Сент-Люсия'),
('VCT', 'Сент-Винсент и Гренадины'),
('WSM', 'Самоа'),
('SMR', 'Сан-Марино'),
('STP', 'Сан-Томе и Принсипи'),
('SAU', 'Саудовская Аравия'),
('SEN', 'Сенегал'),
('SRB', 'Сербия'),
('SYC', 'Сейшелы'),
('SLE', 'Сьерра-Леоне'),
('SGP', 'Сингапур'),
('SVK', 'Словакия'),
('SVN', 'Словения'),
('SLB', 'Соломоновы острова'),
('SOM', 'Сомали'),
('ZAF', 'Южная Африка'),
('ESP', 'Испания'),
('LKA', 'Шри-Ланка'),
('SDN', 'Судан'),
('SUR', 'Суринам'),
('SWZ', 'Свазиленд'),
('SWE', 'Швеция'),
('CHE', 'Швейцария'),
('SYR', 'Сирийская Арабская Республика'),
('TJK', 'Таджикистан'),
('TZA', 'Танзания, Объединенная Республика'),
('THA', 'Таиланд'),
('TLS', 'Тимор-Лесте'),
('TGO', 'Того'),
('TON', 'Тонга'),
('TTO', 'Тринидад и Тобаго'),
('TUN', 'Тунис'),
('TUR', 'Турция'),
('TKM', 'Туркмения'),
('TUV', 'Тувалу'),
('UGA', 'Уганда'),
('UKR', 'Украина'),
('ARE', 'Объединенные Арабские Эмираты'),
('GBR', 'Великобритания'),
('USA', 'США'),
('URY', 'Уругвай'),
('UZB', 'Узбекистан'),
('VUT', 'Вануату'),
('VAT', 'Папский Престол (Государство &mdash; город Ватикан)'),
('VEN', 'Венесуэла'),
('VNM', 'Вьетнам'),
('YEM', 'Йемен'),
('ZMB', 'Замбия'),
('ZWE', 'Зимбабве'),
('SGS', 'Южная Джорджия и Южные Сандвичевы острова'),
('ALA', 'Эландские острова'),
('SJM', 'Шпицберген и Ян Майен'),
('ATF', 'Французские Южные территории'),
('PYF', 'Французская Полинезия'),
('GUF', 'Французская Гвиана'),
('FLK', 'Фолклендские острова (Мальвинские)'),
('FRO', 'Фарерские острова'),
('WLF', 'Уоллис и Футуна'),
('TKL', 'Токелау'),
('TWN', 'Тайвань (Китай)'),
('SPM', 'Сен-Пьер и Микелон'),
('MNP', 'Северные Марианские острова'),
('SHN', 'Святая Елена'),
('REU', 'Реюньон'),
('PRI', 'Пуэрто-Рико'),
('PCN', 'Питкерн'),
('PSE', 'Палестинская территория, оккупированная'),
('TCA', 'Острова Теркс и Кайкос'),
('COK', 'Острова Кука'),
('CYM', 'Острова Кайман'),
('HMD', 'Остров Херд и острова Макдональд'),
('CXR', 'Остров Рождества'),
('NFK', 'Остров Норфолк'),
('BVT', 'Остров Буве'),
('NCL', 'Новая Каледония'),
('NIU', 'Ниуэ'),
('ANT', 'Нидерландские Антилы'),
('MSR', 'Монтсеррат'),
('MTQ', 'Мартиника'),
('UMI', 'Малые Тихоокеанские отдаленные острова Соединенных Штатов'),
('MYT', 'Майотта'),
('MAC', 'Макао'),
('CCK', 'Кокосовые (Килинг) острова'),
('ESH', 'Западная Сахара'),
('GUM', 'Гуам'),
('GRL', 'Гренландия'),
('HKG', 'Гонконг'),
('GIB', 'Гибралтар'),
('GLP', 'Гваделупа'),
('VIR', 'Виргинские острова, США'),
('VGB', 'Виргинские острова, Британские'),
('IOT', 'Британская территория в Индийском океане'),
('BMU', 'Бермуды'),
('ABW', 'Аруба'),
('ATA', 'Антарктида'),
('AIA', 'Ангилья'),
('ASM', 'Американское Самоа');
