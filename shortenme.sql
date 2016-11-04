
CREATE TABLE `shortenme_urls` (
  `id` int(255) NOT NULL,
  `url` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_redirected` int(11) DEFAULT '0',
  `shorturl` text NOT NULL
) 
