CREATE TABLE IF NOT EXISTS users
(
    id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username  VARCHAR(255) NOT NULL,
    password  VARCHAR(255) NOT NULL,
    admin     BOOLEAN      NOT NULL DEFAULT '0'
);

CREATE TABLE IF NOT EXISTS posts
(
    id      INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title   TEXT NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL
);

CREATE TABLE IF NOT EXISTS comments_post
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    post_id INT NOT NULL
);

CREATE TABLE IF NOT EXISTS comments_reaction
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    comments_post_id INT NOT NULL
);



ALTER TABLE posts ADD CONSTRAINT posts_user_id_foreign FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);
ALTER TABLE comments_post ADD CONSTRAINT comments_post_user_id_foreign FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);
ALTER TABLE comments_post ADD CONSTRAINT comments_post_post_id_foreign FOREIGN KEY(`post_id`) REFERENCES `posts`(`id`);
ALTER TABLE comments_reaction ADD CONSTRAINT comments_reaction_user_id_foreign FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);
ALTER TABLE comments_reaction ADD CONSTRAINT comments_reaction_post_id_foreign FOREIGN KEY(`comments_post_id`) REFERENCES `comments_post`(`id`);
