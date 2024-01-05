//wachtwoord = test
INSERT INTO `account` (`id`, `first_name`, `last_name`, `date_of_birth`, `country`, `password`, `email`, `language`) 
 VALUES ('8647f3ca-f3ce-11ed-8823-900f0c0524ce', 'Piet', 'Hein', '2023-05-10', 'NL', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', 'Dat@dit.nl', 'nl');

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `language`, `password`, `date_of_birth`, `country`, `bio`, `profile_picture`, `parent_account_id`)
 VALUES ('b08c6f58-f3ce-11ed-8823-900f0c0524ce', 'Kees', 'Klasen', 'KEESKLAAS', 'nl', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', '2023-05-10', 'NL', 'HALLO IK BEN KEES', 'Mooie foto', '8647f3ca-f3ce-11ed-8823-900f0c0524ce');

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `language`, `password`, `date_of_birth`, `country`, `bio`, `profile_picture`, `parent_account_id`) 
 VALUES ('cb9a6871-f3ce-11ed-8823-900f0c0524ce', 'jan ', 'jansen', 'JANSENJAN', 'NL', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', '2023-05-23', 'BE', 'MOOI', 'MOOIE FOTO', '8647f3ca-f3ce-11ed-8823-900f0c0524ce');