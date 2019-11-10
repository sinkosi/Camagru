CREATE TABLE `images` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `uploaded_on` datetime NOT NULL,
 `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
 #`userid` int(6) UNSIGNED NOT NULL,
 #FOREIGN KEY (userid) REFERENCES user(id),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;