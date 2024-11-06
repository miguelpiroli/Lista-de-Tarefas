CREATE TABLE `lista` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `checado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `lista`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;