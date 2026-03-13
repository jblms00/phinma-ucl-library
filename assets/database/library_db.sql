-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2026 at 12:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `total_copies` int(11) DEFAULT 1,
  `available_copies` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `category`, `description`, `cover_image`, `total_copies`, `available_copies`, `created_at`) VALUES
(1, 'Fortress Blood', 'L.D. Goffigan', 'Fantasy', 'Noli Me Tángere (Latin for \"Touch Me Not\") is a novel by Filipino writer and activist José Rizal and was published during the Spanish colonial period of the Philippines. It explores inequities in law and practice in terms of the treatment by the ruling government and the Spanish Catholic friars of the resident peoples in the late 19th century.\n\nOriginally written by Rizal in Spanish, the book has since been more commonly published and read in the Philippines in either Tagalog (the major indigenous language), or English. The Rizal Law requires Noli, published in 1887, and its 1891 sequel, El filibusterismo, to be read by all high school students throughout the country. Noli is studied in Grade 9 and El filibusterismo in Grade 10. The two novels are widely considered to be the national epic of the Philippines. They have been adapted in many forms, such as operas, musicals, plays, and other forms of art.\n\nThe title originates from the Biblical passage John 20:13-17. In Rizal\'s time, it also referred to cancers that occurred on the face, particularly cancers of the eyelid; touching such lesions irritated them, causing pain.[1] As an ophthalmologist, Rizal was familiar with the cancer and the name.[2] He is explicit about the connection in the novel\'s dedication, which begins: A mi patria (\'To my country\')[3]: 26  and continues with \"...a cancer of so malignant a character that the least touch irritates it and awakens in it the sharpest pains.\"[a] Rizal probes the cancers of Filipino society.[4] Early English translations of the novel used different titles, such as An Eagle Flight (1900) and The Social Cancer (1912), but more recent English translations use the original title.', '../assets/img/bookCovers/fortress.jpg', 5, 4, '2026-03-03 04:57:51'),
(2, 'Noli Me Tangere', 'Jose Rizal', 'Fiction', 'Noli Me Tángere (Latin for \"Touch Me Not\") is a novel by Filipino writer and activist José Rizal and was published during the Spanish colonial period of the Philippines. It explores inequities in law and practice in terms of the treatment by the ruling government and the Spanish Catholic friars of the resident peoples in the late 19th century.\n\nOriginally written by Rizal in Spanish, the book has since been more commonly published and read in the Philippines in either Tagalog (the major indigenous language), or English. The Rizal Law requires Noli, published in 1887, and its 1891 sequel, El filibusterismo, to be read by all high school students throughout the country. Noli is studied in Grade 9 and El filibusterismo in Grade 10. The two novels are widely considered to be the national epic of the Philippines. They have been adapted in many forms, such as operas, musicals, plays, and other forms of art.\n\nThe title originates from the Biblical passage John 20:13-17. In Rizal\'s time, it also referred to cancers that occurred on the face, particularly cancers of the eyelid; touching such lesions irritated them, causing pain.[1] As an ophthalmologist, Rizal was familiar with the cancer and the name.[2] He is explicit about the connection in the novel\'s dedication, which begins: A mi patria (\'To my country\')[3]: 26  and continues with \"...a cancer of so malignant a character that the least touch irritates it and awakens in it the sharpest pains.\"[a] Rizal probes the cancers of Filipino society.[4] Early English translations of the novel used different titles, such as An Eagle Flight (1900) and The Social Cancer (1912), but more recent English translations use the original title.', '../assets/img/bookCovers/noli.jpg', 10, 0, '2026-03-03 04:57:51'),
(3, 'Dune', 'Frank Herbert', 'Science', 'Dune is a 1965 epic science fiction novel by American author Frank Herbert, originally published as two separate serials (1963–64 novel Dune World and 1965 novel Prophet of Dune) in Analog magazine. It tied with Roger Zelazny\'s This Immortal for the Hugo Award for Best Novel and won the inaugural Nebula Award for Best Novel in 1966. It is the first installment of the Dune Chronicles. It is one of the world\'s best-selling science fiction novels.[4]\n\nDune is set in the distant future in a feudal interstellar society, descended from terrestrial humans, in which various noble houses control planetary fiefs. It tells the story of young Paul Atreides, whose family reluctantly accepts the stewardship of the planet Arrakis. While the planet is an inhospitable and sparsely populated desert wasteland, it is the only source of melange or \"spice\", an enormously valuable drug that extends life and enhances mental abilities. Melange is also necessary for space navigation, which requires a kind of multidimensional awareness and foresight that only the drug provides. As melange can only be produced on Arrakis, control of the planet is a coveted and dangerous undertaking. The story explores the multilayered interactions of politics, religion, ecology, technology, and human emotion as the factions of the empire confront each other in a struggle for the control of Arrakis and its spice.\n\nHerbert wrote five sequels: Dune Messiah, Children of Dune, God Emperor of Dune, Heretics of Dune, and Chapterhouse: Dune. Following Herbert\'s death in 1986, his son Brian Herbert and author Kevin J. Anderson continued the series in over a dozen additional novels since 1999.\n\nAdaptations of the novel to cinema have been notoriously difficult and complicated. In the 1970s, cult filmmaker Alejandro Jodorowsky attempted to make a film based on the novel. After three years of development, the project was canceled due to a constantly growing budget. In 1984, a film adaptation directed by David Lynch was released to mostly negative responses from critics and failure at the box office, although it later developed a cult following. The book was also adapted into the 2000 Sci-Fi Channel miniseries Frank Herbert\'s Dune and its 2003 sequel, Frank Herbert\'s Children of Dune (the latter of which combines the events of Dune Messiah and Children of Dune). A second film adaptation, directed by Denis Villeneuve, was released on October 21, 2021, to positive reviews. It went on to be nominated for ten Academy Awards, including Best Picture, ultimately winning six. Villeneuve\'s film covers roughly the first half of the original novel; a sequel, which covers the second half, was released on March 1, 2024, to critical acclaim.\n\nThe series has also been used as the basis for several board, role-playing, and video games.\n\nSince 2009, the names of planets from the Dune novels have been adopted for the real-life nomenclature of plains and other features on Saturn\'s moon Titan.', '../assets/img/bookCovers/dune.jpg', 6, 2, '2026-03-03 04:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrowed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date DEFAULT NULL,
  `returned_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrowed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL,
  `returned_at` datetime DEFAULT NULL,
  `status` enum('borrowed','returned','overdue') DEFAULT 'borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`id`, `user_id`, `book_id`, `borrowed_at`, `due_date`, `returned_at`, `status`) VALUES
(7, 14, 1, '2026-03-07 03:24:32', '2026-03-14', '2026-03-10 17:48:14', 'returned'),
(8, 14, 3, '2026-03-07 03:29:05', '2026-03-14', '2026-03-10 17:51:28', 'returned');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `book_id` int(11) NOT NULL,
  `status` enum('pending','approved','cancelled') DEFAULT 'pending',
  `reserved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `book_id`, `status`, `reserved_at`) VALUES
(1, 14, 2, 'cancelled', '2026-03-07 03:16:18'),
(2, 14, 2, 'cancelled', '2026-03-07 03:24:23'),
(3, 14, 2, 'approved', '2026-03-07 03:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(250) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL,
  `user_type` enum('admin','librarian','student','') NOT NULL,
  `datetime_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `status`, `user_type`, `datetime_created`) VALUES
(13, 'John Doe', 'jd123', 'jd@gmail.com', 'MTIzMTIz', 1, 'librarian', '2026-03-02 23:23:48'),
(14, 'Kharen Fuji', 'kfuji_', 'kf@gmail.com', 'MTIzMTIz', 1, 'student', '2026-03-03 09:39:27'),
(15, 'Administrator', 'admin', 'admin@admin.com', 'MTIzMTIz', 1, 'admin', '2026-03-03 09:39:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
