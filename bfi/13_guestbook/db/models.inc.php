<?php
    // abbildung der DB Tabellen als Klassen in PHP
    class User {
        public int $id;
        public string $email;
        public string $password;
        public string $name;
        public DateTime $birthdate;
        public bool $admin;
        public bool $newsletter;

        public function __construct(int $id, string $email, string $password, string $name, DateTime $birthdate, bool $admin, bool $newsletter) {
            $this->id = $id;
            $this->email = $email;
            $this->password = $password;
            $this->name = $name;
            $this->birthdate = $birthdate;
            $this->admin = $admin;
            $this->newsletter = $newsletter;
        }
    }

    // id INT AUTO_INCREMENT,
    // user_id INT NOT NULL,
    // title VARCHAR(100) NOT NULL,
    // content TEXT NOT NULL,
    // published_date TIMESTAMP NOT NULL,
    // approved TINYINT(1) NOT NULL DEFAULT 0,
    // PRIMARY KEY(id),
    // FOREIGN KEY(user_id) REFERENCES user(id)
    class Comment {
        public int $id;
        public User $user;
        public string $title;
        public string $content;
        public DateTime $published_date;
        public bool $approved;

        public function __construct(int $id, User $user, string $title, string $content, DateTime $published_date, bool $approved) {
            $this->id = $id;
            $this->user = $user;
            // TODO
        }
    }





?>