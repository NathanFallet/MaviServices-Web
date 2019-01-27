# MaviServices-Web

## Repository content

Here is the Mavi Services' website!

[Check it out online!](https://www.mavi-lh-services.com/)

## MySQL database

```sql
CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL
);

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL
);

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL
);

CREATE TABLE `shop_cats` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL
);

CREATE TABLE `shop_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `description_little` varchar(255) NOT NULL,
  `prix` double NOT NULL,
  `parent` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
);

CREATE TABLE `vars` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL
);

INSERT INTO `menu` (`id`, `label`, `link`, `parent`) VALUES
(1, 'Accueil', 'https://www.mavi-lh-services.com/', 0),
(2, 'Boutique', 'https://www.mavi-lh-services.com/shop', 0),
(3, 'Contact', 'https://www.mavi-lh-services.com/contact', 0);

INSERT INTO `pages` (`id`, `name`, `content`) VALUES
(1, 'Accueil', '<p>Accueil</p>\r\n'),
(2, 'Erreur 404 - Not found', '<p>La page que vous cherchez n&#39;existe pas ou plus.</p>\r\n');

INSERT INTO `vars` (`name`, `value`) VALUES
('main_page', '1'),
('404_page', '2'),
('logo', 'https://www.mavi-lh-services.com/images/logo.png'),
('background', 'https://www.mavi-lh-services.com/images/fond_d_ecan_informatique.jpg'),
('footer', '<p>Footer</p>');
```
