CREATE TABLE `admin` (  
  `id` CHAR(36) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_super_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `post` (
  `id` CHAR(36) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `date_posted` datetime DEFAULT NULL,
  `category_id` CHAR(36) DEFAULT NULL,
  `parent_id` CHAR(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `category` (
  `id` CHAR(36) NOT NULL,
  `NAME` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `comment` (
  `id` CHAR(36) NOT NULL,
  `content` text DEFAULT NULL,
  `user_id` CHAR(36) DEFAULT NULL,
  `post_id` CHAR(36) DEFAULT NULL,
  `image_id` CHAR(36) DEFAULT NULL,
  `parent_comment_id` CHAR(36) DEFAULT NULL,
  `date_posted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `image` (
  `id` CHAR(36) NOT NULL,
  `image_location` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_uploaded` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `likes` (
  `id` CHAR(36) NOT NULL,
  `user_id` CHAR(36) DEFAULT NULL,
  `post_id` CHAR(36) DEFAULT NULL,
  `image_id` CHAR(36) DEFAULT NULL,
  `comment_id` CHAR(36) DEFAULT NULL,
  `video_id` CHAR(36) DEFAULT NULL,
  `translation_id` CHAR(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `post_image` (
  `id` CHAR(36) NOT NULL,
  `post_id` CHAR(36) DEFAULT NULL,
  `image_id` CHAR(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `product` (
  `id` CHAR(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `purchase` (
  `id` CHAR(36) NOT NULL,
  `user_id` CHAR(36) DEFAULT NULL,
  `date_purchased` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `purchase_item` (
  `id` CHAR(36) NOT NULL,
  `purchase_id` CHAR(36) DEFAULT NULL,
  `product_id` CHAR(36) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `story` (
  `id` CHAR(36) NOT NULL,
  `post_id` CHAR(36) DEFAULT NULL,
  `content_1` text DEFAULT NULL,
  `content_2` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `translation` (
  `id` CHAR(36) NOT NULL,
  `post_id` CHAR(36) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/* Parent */
CREATE TABLE `account` (
  `id` CHAR(36) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `message_amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/* Child */
CREATE TABLE `users` (
  `id` CHAR(36) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `parent_account_id` CHAR(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `video` (
  `id` CHAR(36) NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `post_id` CHAR(36) DEFAULT NULL,
  `image_id` CHAR(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `comment`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `parent_comment_id` (`parent_comment_id`);

ALTER TABLE `likes`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `video_id` (`video_id`),
  ADD KEY `translation_id` (`translation_id`);

ALTER TABLE `post_image`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `image_id` (`image_id`);

ALTER TABLE `purchase`
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `purchase_item`
  ADD KEY `purchase_id` (`purchase_id`),
  ADD KEY `product_id` (`product_id`);

ALTER TABLE `translation`
  ADD KEY `post_id` (`post_id`);

ALTER TABLE `users`
  ADD KEY `parent_account_id` (`parent_account_id`);

ALTER TABLE `story`
  ADD KEY `post_id` (`post_id`);

ALTER TABLE `video`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `image_id` (`image_id`);

ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `comment_ibfk_4` FOREIGN KEY (`parent_comment_id`) REFERENCES `comment` (`id`);

ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `likes_ibfk_3` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `likes_ibfk_4` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`),
  ADD CONSTRAINT `likes_ibfk_5` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`),
  ADD CONSTRAINT `likes_ibfk_6` FOREIGN KEY (`translation_id`) REFERENCES `translation` (`id`);

ALTER TABLE `post_image`
  ADD CONSTRAINT `post_image_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `post_image_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);

ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `post` (`id`);

ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `purchase_item`
  ADD CONSTRAINT `purchase_item_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`),
  ADD CONSTRAINT `purchase_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

ALTER TABLE `story`
  ADD CONSTRAINT `story_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

ALTER TABLE `translation`
  ADD CONSTRAINT `translation_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`parent_account_id`) REFERENCES `account` (`id`);

ALTER TABLE `video`
ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
ADD CONSTRAINT `video_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);
