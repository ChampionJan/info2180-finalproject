DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;

USE dolphin_crm;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
);

-- --------------------------------------------------------

--
-- Table structure for table `Contacts`
--


CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `telephone` varchar(250) NOT NULL,
  `company` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
);


-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `comment` TEXT,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
);


--
-- Indexes for table `Contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

 ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


--
-- Indexes for table `Users`
--

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
  
 ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Indexes for table `Notes`
--

ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

 ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO `users` (`firstname`, `lastname`, `password`, `email`,`role` ,`created_at`) VALUES ('admin', 'admin', '$2y$10$J32K.bB0.0s/PUfcrTN/OOzkdUpG3Jwl8uml/QrejVAGkIiMzb5O.', 'admin@project2.com','admin', current_timestamp());
INSERT INTO `users` (`firstname`, `lastname`, `password`, `email`,`role` ,`created_at`) VALUES ('Jan', 'Levinson', '$2y$10$J32K.bB0.0s/PUfcrTN/OOzkdUpG3Jwl8uml/QrejVAGkIiMzb5O.', 'jan.levinson@paper.co','Member', current_timestamp());
INSERT INTO `users` (`firstname`, `lastname`, `password`, `email`,`role` ,`created_at`) VALUES ('David', 'Wallace', '$2y$10$J32K.bB0.0s/PUfcrTN/OOzkdUpG3Jwl8uml/QrejVAGkIiMzb5O.', 'david.wallace@paper.co','admin', current_timestamp());
INSERT INTO `users` (`firstname`, `lastname`, `password`, `email`,`role` ,`created_at`) VALUES ('Andy', 'Bernard', '$2y$10$J32K.bB0.0s/PUfcrTN/OOzkdUpG3Jwl8uml/QrejVAGkIiMzb5O.', 'andy.bernard@paper.co','Member', current_timestamp());
INSERT INTO `users` (`firstname`, `lastname`, `password`, `email`,`role` ,`created_at`) VALUES ('Darryl', 'Philbin', '$2y$10$J32K.bB0.0s/PUfcrTN/OOzkdUpG3Jwl8uml/QrejVAGkIiMzb5O.', 'darryl.philbin@paper.co','Member', current_timestamp());
INSERT INTO `users` (`firstname`, `lastname`, `password`, `email`,`role` ,`created_at`) VALUES ('Erin', 'Hannon', '$2y$10$J32K.bB0.0s/PUfcrTN/OOzkdUpG3Jwl8uml/QrejVAGkIiMzb5O.', 'erin.hannon@paper.co','Member', current_timestamp());

INSERT INTO `contacts` (`title`, `firstname`, `lastname`, `email`, `telephone`, `company`, `type`, `assigned_to`, `created_by`, `created_at`) VALUES ('Mr.', 'Michael', 'Scott', 'michael.scott@paper.co', '876-564-6842', 'The Paper Company', 'Sales Lead', 2, 2, current_timestamp());
INSERT INTO `contacts` (`title`, `firstname`, `lastname`, `email`, `telephone`, `company`, `type`, `assigned_to`, `created_by`, `created_at`) VALUES ('Mr.', 'Dwight', 'Shrute', 'dwight.schrute@paper.co','876-426-6801', 'The Paper Company', 'Support', 4, 5, current_timestamp());
INSERT INTO `contacts` (`title`, `firstname`, `lastname`, `email`, `telephone`, `company`, `type`, `assigned_to`, `created_by`, `created_at`) VALUES ('Ms.', 'Pam', 'Beesley', 'pam.beesley@dunder.co','876-426-5423', 'Dunder Mifflin', 'Support', 3, 6, current_timestamp());
INSERT INTO `contacts` (`title`, `firstname`, `lastname`, `email`, `telephone`, `company`, `type`, `assigned_to`, `created_by`, `created_at`) VALUES ('Ms.', 'Angela', 'Martin', 'angela.martin@vance.co','876-412-9862', 'Vance Refrigeration', 'Sales Lead', 5, 6, current_timestamp());
INSERT INTO `contacts` (`title`, `firstname`, `lastname`, `email`, `telephone`, `company`, `type`, `assigned_to`, `created_by`, `created_at`) VALUES ('Ms.', 'Kelly', 'Kapoor', 'kelly.kapoor@vance.co','876-541-5301', 'Vance Refrigeration', 'Support', 2, 4, current_timestamp());
INSERT INTO `contacts` (`title`, `firstname`, `lastname`, `email`, `telephone`, `company`, `type`, `assigned_to`, `created_by`, `created_at`) VALUES ('Mr.', 'Jim', 'Halpert', 'jim.halpert@dunder.co','876-603-6258', 'Dunder Mifflin', 'Sales Lead', 4, 3, current_timestamp());

