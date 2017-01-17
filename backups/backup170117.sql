-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:8889
-- Tid vid skapande: 17 jan 2017 kl 14:57
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
  `id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `published` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `edited` tinyint(1) NOT NULL,
  `edit_date` datetime NOT NULL,
  `reply_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`id`, `comment`, `published`, `user_id`, `post_id`, `edited`, `edit_date`, `reply_to`) VALUES
(251, 'Nice!', '2017-01-03 22:31:42', 3, 188, 0, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `cookies`
--

CREATE TABLE `cookies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expire` datetime NOT NULL,
  `first` varchar(128) NOT NULL,
  `second` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `cookies`
--

INSERT INTO `cookies` (`id`, `user_id`, `expire`, `first`, `second`) VALUES
(229, 1, '2017-02-15 20:47:19', 'd093b7ea584d480a4d1b47d4a685d684af18e431bf954c065015511163e5303eb77a304048b5e4bbea40f9b869f7058d727926b84dbb72c11b199d9014d9ca4b', '21ba6b5de8466903d9141a3aba367d34c47beff94170de5daec4bf5c492ede9f18fc34f50d453454c82b3075c50d37c398d5dcf0d47fcd877a6cb8527d050a49186703d88f40dd5222d37e730054ca649814cf3fe84f6b47b183271b7a87c62d0dc72c0fef53496615012f7573f8a517a61c5475a2e79165ff5d1115b4038ce8'),
(230, 4, '2017-02-15 21:45:06', 'fab8a64f91446dc4051948636c566658b18b0105f839318dafca0e07d98958ecbbad399c8b4d1cbf6fe65a4b0a93d8ce74c2832caf16c2dc24ec318e4418593a', '6c39d95cab70a3ef20e65bfd17f3acb660f0d33f5d45b11dd4f71757b93992e4fca22cdb0138ba1c87015f12fcd5a84c39d55d9ba81c99527e9f391a32b34cf19af5ee6ab9cfa0f2008795ffc8c018fe985a8619aedb300aa13aec583c379b9f128201172e2d824167456b115f12f0fa69009fa1ef6275436c52158774595213'),
(231, 6, '2017-02-15 22:10:15', 'f396a0f9a8b0ff4bea176884b3850a8157196a3d5a532b1bbf03414008303e5845192df02b86c0e78b802bc4d47f1a5137d42e2d715344be2aecc74b62a75e4b', 'a715899040af3aad0817352044fe629415468c59877503312fd9923b620227a28ebd8a14cc387034bfc9252d50a4faa4e51313dad30fc74bc705b7837c28dcb533deba0b02ff721648d7dca1f37f148e26366d7d2e0ff31e6d069aee9279fd900886dc2c576c9c822565802c3014f5bbf1d0a808ddf7fcac5d35f7ce73d3344a'),
(232, 3, '2017-02-16 11:19:47', 'c23bfbe271f7447451b20cba107fd7eba5fe40f292dfcde6c151b4dfdcfc893848cd3582cd957d2aa05a0b75b86d139c6dfe5a7490e4d1d1a27114ac813a25b8', 'e5fc9e534c9044f38b6e932aeda09be1a62592f3a842662e4c9c68a3e7c88d3c6617708735740addc0f1462f424a6a4b00eea25ffe488c7964bb0b41c70a7bf0c57f7a5a0581e13a378f5c1af5d3b33d2de0c12663e920a5462712e1ffb7446546d301b17f41554488571be2fd54bae1f27c287d9dedc6bf5eb0e81f165e07e4'),
(233, 4, '2017-02-16 11:29:26', '645775eedb0870f8abc40c53738e38280e4eaf4a836eec952cab00b2f98e86a3e16308085708b560c866e06f9e8c7e7a9048b858c50efca56a59a036d7a75540', '50fb679e4420248d2d59113f4c6158c9ea28dcdc7e991209039e63a1f77f6b2711a31eb496efe5dbf727258936593c4d1670ec7e4baa9d969a97d56481368a15c0c256b116301346e2ce512e0b4f6fd54d04b9ec69597a0240292b3d99b154831e917b5522f79c267b7bfdce5f11d4d773f2fc62a2cd5d4861b950d02e418043'),
(234, 4, '2017-02-16 11:49:43', '2450862213d95480e187360966686ac90af8c3b775ece894b019ae0463098d753d41ce4bc27457f474a3176fed6d6088ff0ffe1b4045d633f01d3f4a4aa9f9f2', 'dc38962478edff5bbcf0a59a597ec46e91c78c65937034e8426ba365087267f02c3808a1783e0c5a3bb2fdcaeb74b91def1d957942b972e75bf307ecf71f8799822236f3f1a027c5ce2d9278baa00c61d25352e3d46213729d5d90bced0993de6b841645ad68a01a9f34d1b7763f41d08be46c18b73669c9046c8cac55000a1e'),
(235, 1, '2017-02-16 11:50:08', '2b39135729370e9ad7b4f8cbb1867b5daedc890b214afc3b1244afc99e8fbe422a5ed42f88a881c9ee6caa60a7f9aaa883d71ef552528106433964619c0c3995', '3460d9b6a67dd29b5fb129c2d72794311e3af8ad3d672d367f3e7ca79bf868055aba4709c46d60d850cc7049295fb43576b04fd0a887c7e66204267f332f0bbc9041094e8d36a1afe2644011a078d26a678aa14d142c8cefd4617b3d183009926cab7e49c40159c3d9cee6f6942d01e157c38ab89e5e93a2083cadb98abba500'),
(236, 1, '2017-02-16 13:33:56', '55bef351a2afd42973e9c1fa9a78f56960bd0f05f79cded106e2b2d04941c51d6401c7dfd2fe1710cb5e6b4d2cfac168de552736182682e94045aa0a242782d3', '3c034846ebf847d8417c2a331a2ad6a48744ebfe53bb5cee1998f3bb84f10fb95030096bfff96b1173a03b65c700e7d36c6daeb2560dd1f0aae2683be2d22aeb8dbb3fb4bd5202fc2acb3c8efd626eba78d65b2e02d03c4366d346726c0ff539b7f910ee6d4f4275fe7113b7d8caf95bb3398a4ace9c34c8f81ec87b9ad379b4'),
(237, 1, '2017-02-16 13:35:49', 'd7cab10f49dc06940c0ef9d93a12a26afa3e45aa5bf8c7ba7d9ebc6e728d533839a112a63f67703218d66a72b203244416db24490424fce7b5d9298d8998cd0d', 'b8e4e63bae2e155b2e3bc707e7ec7607b313cd217060cad4f26a33a1de2f6fe792d2998fb755549bdf9cb0c50c891699c711a0dbe37493e2a726b48cbd3b859ba2056ba6647a237f11b5625818da480fa77f10ac8c3cd5f6026780c19761f5467e3753af132bf5eb06cefd890f37eda1ed519680962bd14063685676d360b977'),
(238, 1, '2017-02-16 13:36:26', 'fd793b889b795c297704116e5c523f6b03c57663d3ccbdcc06c5d2e0011d27b9f848326fe8992fb6c27e17b177d3eac85dfd51a1902c29df3dbcb14a72ff54dd', '783c5e86761d400fe71bf5a6ca0f33fd3e434315c0736d73438549c275994cfa77c0069a3d0162be03993ae69d5311657222455a6b8d2c85ae1e599a80e59cbae3d51ebcfdf37d210ff9fa0fdfe3aa009cded49a4af9442be01f44e0e5df38e169704018e257ca71a8f4d6d0e44815a659dbdae701ce2085a725a91753cb189a'),
(239, 1, '2017-02-16 13:43:25', 'e0997e995807d736a3fd44e1e63679ab96501f19d027b7ca0982e60949cb891130f7da34662dc0cd5d5a5eb6bf8d05dae9037d1afb8ab978054b486acb48876d', 'de8beb054e9499510aef74f1e02e06fe0b604a201240678afb58d407e5b6faa2e57cc4300907d1f4f25ec61360927c0570c4f75b957774b0dda928c7e836c5411fdaa4ca506a6be6ce564c697e14c329efb6bf26139b52ceefa70a5d5233640e6d9d3f6e30140f34b59650e872252afba25590cdda43afb30f7b7713993453a3'),
(240, 1, '2017-02-16 13:44:54', 'eedab8024831f9df5e65ca5caa45fdfa8a0feec4026dd68bb77394b542da4f26f840ff00cd12b78399dda5464098121eeb00347afb778f978f063aa9def90368', 'e8b4fe8755e382396120152ff1a60c4afb392bdca629fcd3668075e74c85eee8957514936f1008afdf1dd0cc28a8fba0320ad74dbc2153f6e55b2978e039d83126a5a758ab0eb42c2e4eecc75d5679bda84832542dd58c646fb3b3a2954b45b44afcc86b0c7c27547c7ff0cf1653e695e7d2641a1b753d5ce1ece6caf887c2aa'),
(241, 1, '2017-02-16 14:36:47', 'c834345a34f66e3669d3397193e666465369ec0ed915917498ade142e06de68e62df9a17fc7a98c7c8689fc7b12739cddecf522ee8d4d748fcda61a3af9bd03d', '7fa3f5ea80a46421b530259c07ad78d0343ab669e586b8a9f25bd5f713e6adb2117203121739540172e1c47d06262a2cf22427c6adcd6727baba008433c5ffc34118d9d972032104ff99a3a9b7889d072cfad2d52bae1137c5e7d75720150d8b2b6d48513ed4a5890e8bc767dc6d0d8d7bdbae7a5c04a2577183553f67c1b584'),
(242, 1, '2017-02-16 14:39:15', '59b50cea4dbd4b5a74e9f42cee5cd86cbc329f3bc0c6c39cf8efcde8b3ee2b697e8144cc61aa9861245b877dd12091016594de61def0248ec3bdde911b752648', 'f8bfd96ff8d76088b29e6e0b565329313e629f3e43506cfb6a133a982e2eb0831007c4181c39612497641e7f335e2b40408aae30caf08853cbe2565c535d92ba8e1e36420bfbef1da22bbb081d9ff13b3610962e9d7562eaa12feb0aa2f8aaa3e9bd718b96c5986e2cdc38a90daafe5feda937b83152b77e9891bc84b646589b');

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
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
  `id` int(11) NOT NULL,
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
(2, 'Erica Glimsholt', 'ericaglimsholt', 'ericaglimsholt@hotmail.com', '$2y$10$xz6M/RWYVRqEWj0M1nEQcezkToh7Wkxy7qD71ttUX7yJYdJuXC4QC', NULL, NULL),
(3, 'Andreas Andersson', 'andreas', 'andreas@herrandersson.se', '$2y$10$0Vby0PfinQDYcwsog264Ru.4y0pqALKCO7uM1MjKZ/pbb.Qdnp0ka', 'Hi! I\'m Andreas and I like to share all kinds of  links.', '586c186b9b35b.jpg'),
(4, 'Leon Andersson', 'Leon', 'leon@herrandersson.se', '$2y$10$pc7eSaxDz7agAhOmBvBYROBYmtr3TuDnquF7y0JTUN.xCFO6rlcEm', NULL, NULL),
(6, 'Holly Andersson', 'Holly', 'holly@herrandersson.se', '$2y$10$gMFyub4hvJ3bc/bgMrv7MuFpr3lFlEiuCAojeQKxZ0DQTnXuIjy42', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
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
(36, 257, 1, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;
--
-- AUTO_INCREMENT för tabell `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;
--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT för tabell `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
