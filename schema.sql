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
