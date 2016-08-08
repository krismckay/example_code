__Code Example: Problem 2__

--Description--
Slot Machine Spin Results is our server end point that updates all player data and features when a spin is completed on the client. We do hundreds of millions of these requests per day, and we would like to see you make a very basic MySQL driven version.

--DB Schema--
  CREATE TABLE `player` (
    `player_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(64),
    `credits` int(11) unsigned NOT NULL default 0,
    `lifetime_spins` int(11) unsigned NOT NULL default 0,
    `salt_value` varchar(32), -- expectant 128bit SHA-256 salt as a 32-char hex
    PRIMARY KEY (`player_id`)
  ) Engine=InnoDB;

  INSERT INTO `player` (`player_id`, `name`, `credits`, `lifetime_spins`, `salt_value`)
  VALUES
    (1, 'Bill Smith', 0, 0, 'SXAxxiym9QmjodB6JzSghJ2vy8SlJqWP'),
    (2, 'Nancy Drew', 0, 0, 'mjBCha6aCgRZ9KdUMxUckKQbYoHCawg6'),
    (3, 'Bethany Barry', 0, 0, 'Yl3KTogIw2tLW4q3KojXsQ7J6UnTI6TJ');


