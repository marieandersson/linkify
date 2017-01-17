-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:8889
-- Tid vid skapande: 17 jan 2017 kl 22:15
-- Serverversion: 5.6.33
-- PHP-version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `linkify`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment` varchar(255) NOT NULL,
  `published` datetime NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `edited` tinyint(1) NOT NULL,
  `edit_date` datetime NOT NULL,
  `reply_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`id`, `comment`, `published`, `user_id`, `post_id`, `edited`, `edit_date`, `reply_to`) VALUES
(251, 'Nice!', '2017-01-03 22:31:42', 3, 188, 0, '0000-00-00 00:00:00', NULL),
(340, 'I like this link!', '2017-01-17 20:00:26', 1, 189, 0, '0000-00-00 00:00:00', NULL),
(341, 'Nice!', '2017-01-17 20:00:51', 1, 258, 1, '2017-01-17 20:45:20', NULL),
(342, 'Thanks :)', '2017-01-17 20:01:30', 4, 258, 0, '0000-00-00 00:00:00', 341),
(353, 'Interesting!', '2017-01-17 21:33:35', 1, 256, 1, '2017-01-17 21:33:51', NULL),
(354, 'I think so to!', '2017-01-17 21:35:21', 1, 188, 0, '0000-00-00 00:00:00', 251);

-- --------------------------------------------------------

--
-- Tabellstruktur `cookies`
--

CREATE TABLE `cookies` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expire` datetime NOT NULL,
  `first` varchar(128) NOT NULL,
  `second` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `published` datetime NOT NULL,
  `edited` tinyint(1) DEFAULT NULL,
  `edit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `subject`, `url`, `description`, `published`, `edited`, `edit_date`) VALUES
(188, 1, 'My most favorite talks in 2016.', 'https://fettblog.eu/top-talks-to-watch-2016/', 'Let’s make this a tradition! I love to watch conference talks. Be it live or on tape. And just like last year I try to collect the talks that I loved most.', '2017-01-03 22:29:40', 1, '2017-01-16 11:15:05'),
(189, 3, 'Vanilla is the best flavour', 'https://medium.com/@aliafshar/vanilla-is-the-best-flavour-c1765729a06a#.roa0dubhc', 'This is a little story about how and why I learned to love the web platform.', '2017-01-03 22:31:23', NULL, '0000-00-00 00:00:00'),
(198, 1, 'How tabs should work', 'https://24ways.org/2015/how-tabs-should-work/', 'This post is my definition of how a tabbing system should work, and one approach of implementing that.', '2017-01-05 22:27:34', 1, '2017-01-16 11:16:31'),
(210, 1, '3 New CSS Features to Learn in 2017', 'https://bitsofco.de/3-new-css-features-to-learn-in-2017/', 'With the new year, we have a whole new set of things to learn. Although there are many new features, these are 3 new CSS features I\'m most excited about adopting this year.', '2017-01-11 22:21:31', 1, '2017-01-16 11:16:24'),
(243, 1, 'Master web dev with these 9,985 weird tricks', 'https://hackernoon.com/master-web-development-with-these-9-985-weird-tricks-77c71d1d96f3#.2bdg2hu1o', 'Ladies and gentleman, I would like to introduce you to Know It All, a tool to help you discover what you don’t yet know about web development.', '2017-01-16 11:15:43', 1, '2017-01-16 11:15:54'),
(244, 6, 'The best new portfolio sites', 'http://www.webdesignerdepot.com/2017/01/the-best-new-portfolio-sites-january-2017/', 'Start the year right by ignoring your resolutions, and focusing on this latest installment of awesome portfolios.', '2017-01-16 13:51:58', NULL, '0000-00-00 00:00:00'),
(245, 3, '30 days vanilla JS coding challange', 'https://javascript30.com/', 'Bulid 30 things in 30 days with 30 tutorials', '2017-01-16 20:15:00', NULL, '0000-00-00 00:00:00'),
(246, 1, 'Writing HTML with accessibility in mind', 'https://medium.com/@matuzo/writing-html-with-accessibility-in-mind-a62026493412#.8hqitlmwj', 'An introduction to web accessibility. Tips on how to improve your markup and provide users with more and betters ways to navigate and interact with your site.', '2017-01-16 21:27:39', NULL, '0000-00-00 00:00:00'),
(247, 4, '12 UX rules every designer should know', 'http://www.webdesignerdepot.com/2016/12/26-ux-rules-every-designer-should-know/', 'UX has a huge impact on what web designers do. You can create the best design in the world, but it won’t succeed if it’s not usable.', '2017-01-16 21:51:06', NULL, '0000-00-00 00:00:00'),
(248, 4, 'Tilt hover effects', 'https://tympanus.net/codrops/2016/11/23/tilt-hover-effects/', 'Some ideas for hover animations with a fancy tilt effect.', '2017-01-16 22:09:02', NULL, '0000-00-00 00:00:00'),
(249, 6, '100+ Awesome Web Development Tools and Resources', 'https://www.keycdn.com/blog/web-development-tools/', 'A comprehensive list of web development tools and resources that can help you be more productive, stay informed, and become a better developer.', '2017-01-16 22:12:29', NULL, '0000-00-00 00:00:00'),
(250, 6, 'Get inspired by Site Inspire', 'https://www.siteinspire.com/', 'A showcase of the finest web and interactive design.', '2017-01-16 22:14:16', 1, '2017-01-16 22:14:28'),
(251, 6, '40+ Best Web Development Blogs of 2016', 'https://www.keycdn.com/blog/web-development-blogs/', 'Reading and following the right web development blogs makes it much easier to get a solid education.', '2017-01-17 11:03:49', NULL, '0000-00-00 00:00:00'),
(252, 6, 'Mistakes Developers Make When Learning Design', 'https://www.smashingmagazine.com/2016/12/mistakes-developers-make-when-learning-design/', 'Can developers who are used to working within the logical constructs of Boolean logic and number theory master the seemingly arbitrary rules of design?', '2017-01-17 11:09:21', NULL, '0000-00-00 00:00:00'),
(253, 3, 'How to develop a chat bot with Node.js', 'https://www.smashingmagazine.com/2016/10/how-to-develop-a-chat-bot-with-node-js/', 'In the past few months, chat bots have become very popular, thanks to Slack, Telegram and Facebook Messenger. But the chat bot idea is not new at all.', '2017-01-17 11:21:29', 1, '2017-01-17 11:26:12'),
(254, 3, 'Three new tools for your design toolbox', 'http://www.noupe.com/development/css-logos-colors-three-new-tools-design-toolbox.html', 'Over the weekend, I stumbled across a bunch of new services and tools that could help ease the life of designers and developers.', '2017-01-17 11:25:54', NULL, '0000-00-00 00:00:00'),
(255, 3, 'How to Create Mobile Web Apps', 'http://www.noupe.com/design/html5-javascript-mobile-web-apps-98364.html', 'Mobile apps don’t always have to come as native apps. We can also use HTML5 and the JavaScript APIs it introduced, to develop mobile web apps that are (almost) equal to the natively programmed apps.', '2017-01-17 11:28:13', 1, '2017-01-17 11:28:44'),
(256, 4, 'A brief history of JavaScript', 'https://auth0.com/blog/a-brief-history-of-javascript/?utm_source=frontendfront&amp;utm_medium=sc&amp;utm_campaign=javascript_history', 'JavaScript is arguably one of the most important languages today. The rise of the web has taken JavaScript places it was never conceived to be.', '2017-01-17 11:32:18', 1, '2017-01-17 11:33:59'),
(257, 4, 'Understanding Flexbox: Everything you need to know', 'https://medium.freecodecamp.com/understanding-flexbox-everything-you-need-to-know-b4013d4dc9af#.l62dt7ejc', 'This article will cover all the fundamental concepts you need to get good with the CSS Flexbox model. It’s a long one, so I hope you’re ready for it.', '2017-01-17 11:44:58', NULL, '0000-00-00 00:00:00'),
(258, 4, 'Startups of 2017', 'https://stories.betalist.com/startups-of-2017-971d3aecd96#.2cppew2mn', 'At the beginning of the year we like to look forward and share the startups we have high hopes for the coming year.', '2017-01-17 11:46:29', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `about` varchar(500) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `about`, `avatar`) VALUES
(1, 'Marie Eriksson', 'Marie', 'eriksson.km@gmail.com', '$2y$10$CTbprQw/pzKIaXhKbAC/zu2fzVELozBw8GYLLstu/Vio6SuuEQbn6', 'My name is Marie and this is my Linkify project.', '5874d973beece.jpg'),
(3, 'Andreas Andersson', 'andreas', 'andreas@herrandersson.se', '$2y$10$0Vby0PfinQDYcwsog264Ru.4y0pqALKCO7uM1MjKZ/pbb.Qdnp0ka', 'Hi! I\'m Andreas and I like to share all kinds of  links.', '586c186b9b35b.jpg'),
(4, 'Leon Andersson', 'Leon', 'leon@herrandersson.se', '$2y$10$pc7eSaxDz7agAhOmBvBYROBYmtr3TuDnquF7y0JTUN.xCFO6rlcEm', NULL, NULL),
(6, 'Holly Andersson', 'Holly', 'holly@herrandersson.se', '$2y$10$gMFyub4hvJ3bc/bgMrv7MuFpr3lFlEiuCAojeQKxZ0DQTnXuIjy42', 'My name is Holly and I\'m new to Linkify.', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `votes`
--

CREATE TABLE `votes` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `votes`
--

INSERT INTO `votes` (`id`, `post_id`, `user_id`, `vote`) VALUES
(23, 188, 3, -1),
(25, 188, 4, -1),
(26, 189, 4, 1),
(28, 189, 6, 1),
(29, 189, 1, 1),
(30, 244, 1, 1),
(31, 248, 6, 1),
(32, 248, 3, 1),
(33, 247, 3, 1),
(34, 247, 1, 1),
(35, 258, 1, 1),
(36, 257, 1, 1),
(37, 251, 1, 1),
(38, 256, 1, 1),
(39, 258, 6, 1);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;
--
-- AUTO_INCREMENT för tabell `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;
--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;
--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT för tabell `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
