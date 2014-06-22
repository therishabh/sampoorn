

CREATE TABLE `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_number` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `discount_per_item` varchar(255) NOT NULL,
  `discount_amount_per_item` varchar(255) NOT NULL,
  `amount_per_item` varchar(255) NOT NULL,
  `total_item` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `main_discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `pay` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

INSERT INTO bill VALUES("1","AWC_1","2","*2*/*8*/*6*","*2*/*12*/*3*","1.8/10.5/5","14.36/137.34/89.85","783.64/1170.66/1707.15","17","3661.45","5.6","3456.00","3000","456.00","2013-09-28 23:24:57","1");
INSERT INTO bill VALUES("2","AWC_2","1","*3*/*2*/*1*","*7*/*1*/*1*","15/0/0","105.00/0.00/0.00","595.00/399.00/122.00","9","1116.00","12","982.00","1000","0.00","2013-09-28 23:28:44","1");
INSERT INTO bill VALUES("3","AWC_3","1","*8*/*6*","*1*/*3*","0/0","0.00/0.00","109.00/1797.00","4","1906.00","12","1677.00","1000","677.00","2013-09-28 23:30:48","1");
INSERT INTO bill VALUES("4","AWC_4","5","*8*","*2*","0","0.00","218.00","2","218.00","0","218.00","1000","0.00","2013-09-28 23:32:27","1");
INSERT INTO bill VALUES("5","AWC_5","1","*3*/*5*/*2*","*3*/*8*/*2*","10/3/2.8","30.00/71.76/22.34","270.00/2320.24/775.66","13","3365.90","10.9","2999.00","0","2999.00","2013-09-28 23:37:12","1");
INSERT INTO bill VALUES("6","AWC_6","1","*4*","*1*","0","0.00","200.00","1","200.00","20","160.00","100","60.00","2013-09-29 11:48:45","1");
INSERT INTO bill VALUES("7","AWC_7","1","*2*/*3*","*2*/*5*","10/13","79.80/65.00","718.20/435.00","7","1153.20","12.9","1004.00","1000","4.00","2013-09-29 12:43:42","1");
INSERT INTO bill VALUES("8","AWC_8","8","*5*/*1*","*15*/*10*","2/0","89.70/0.00","4395.30/1220.00","25","5615.30","10.5","5026.00","6000","0.00","2013-09-29 12:45:52","1");
INSERT INTO bill VALUES("9","AWC_9","1","*2*/*3*","*2*/*10*","15/5","119.70/50.00","678.30/950.00","12","1628.30","10","1465.00","1000","465.00","2013-09-29 14:47:36","1");
INSERT INTO bill VALUES("10","AWC_10","1","*3*/*1*/*5*","*3*/*5*/*1*","2.6/2.8/5.1","7.80/17.08/15.25","292.20/592.92/283.75","9","1168.87","10","1052.00","1000","52.00","2013-09-29 16:24:49","1");
INSERT INTO bill VALUES("11","AWC_11","1","*1*/*2*","*1*/*1*","0/0","0.00/0.00","122.00/399.00","2","521.00","0","521.00","1000","0.00","2013-09-29 16:51:01","1");
INSERT INTO bill VALUES("23","AWC_23","1","*1*/*2*","*5*/*6*","1.8/5.6","10.98/134.06","599.02/2259.94","11","2858.96","5","2716.00","0","2716.00","2013-09-29 18:23:45","1");
INSERT INTO bill VALUES("24","AWC_24","1","*1*","*5*","0","0.00","610.00","5","610.00","5","580.00","150","430.00","2013-09-29 18:25:03","1");
INSERT INTO bill VALUES("25","AWC_25","1","*2*/*3*/*4*","*1*/*1*/*1*","0/3/0","0.00/3.00/0.00","399.00/97.00/200.00","3","696.00","2","682.00","150","532.00","2013-09-29 18:28:22","1");
INSERT INTO bill VALUES("26","AWC_26","10","*5*/*3*","*1*/*2*","25/10.85","74.75/21.70","224.25/178.30","3","402.55","10.8.","359.00","1000","0.00","2013-09-29 18:31:17","1");
INSERT INTO bill VALUES("27","AWC_27","1","*3*/*4*/*3*","*5*/*8*/*2*","15/0/5","75.00/0.00/10.00","425.00/1600.00/190.00","15","2215.00","5.6","2091.00","2000","91.00","2013-10-02 13:01:55","1");
INSERT INTO bill VALUES("28","AWC_28","13","*3*/*4*/*1*","*5*/*3*/*50*","5/3/2","25.00/18.00/122.00","475.00/582.00/5978.00","58","7035.00","10.6","6289.00","5000","1289.00","2013-10-02 13:05:42","1");
INSERT INTO bill VALUES("29","AWC_29","13","*8*/*6*","*15*/*3*","5/0","81.75/0.00","1553.25/1797.00","18","3350.25","12.6","2928.00","1000","1928.00","2013-10-02 13:09:23","1");
INSERT INTO bill VALUES("30","AWC_30","13","*8*/*6*","*15*/*3*","5/0","81.75/0.00","1553.25/1797.00","18","3350.25","12.6","2928.00","1000","1928.00","2013-10-02 13:12:52","1");
INSERT INTO bill VALUES("31","AWC_31","1","*5*/*6*","*3*/*2*","1.6/0","14.35/0.00","882.65/1198.00","5","2080.65","2","2039.00","2000","39.00","2013-10-03 19:30:56","1");
INSERT INTO bill VALUES("32","AWC_32","14","*2*/*3*","*15*/*5*","15/5","897.75/25.00","5087.25/475.00","20","5562.25","15.5","4700.00","5000","0.00","2013-10-03 20:08:56","1");
INSERT INTO bill VALUES("33","AWC_33","14","*8*/*3*","*5*/*4*","2/2","10.90/8.00","534.10/392.00","9","926.10","14.5","792.00","500","292.00","2013-10-03 20:11:58","1");
INSERT INTO bill VALUES("34","AWC_34","15","*1*/*2*","*3*/*5*","5/5","18.30/99.75","347.70/1895.25","8","2242.95","10.5","2007.00","2000","7.00","2013-10-03 20:17:46","1");
INSERT INTO bill VALUES("35","AWC_35","1","*6*/*5*","*4*/*3*","1/0","23.96/0.00","2372.04/897.00","7","3269.04","10.6","2923.00","3000","0.00","2013-10-03 20:21:48","1");
INSERT INTO bill VALUES("36","AWC_36","17","*5*","*1*","2","5.98","293.02","1","293.02","2","287.00","300","0.00","2013-10-03 21:10:06","1");
INSERT INTO bill VALUES("37","AWC_37","1","*1*/*2*","*2*/*3*","3/2","7.32/23.94","236.68/1173.06","5","1409.74","5","1339.00","1000","339.00","2013-10-03 21:13:28","1");
INSERT INTO bill VALUES("38","AWC_38","19","*1*/*2*","*2*/*3*","3/2","7.32/23.94","236.68/1173.06","5","1409.74","5","1339.00","1000","339.00","2013-10-03 21:50:09","1");
INSERT INTO bill VALUES("40","AWC_40","1","*1*/*2*","*2*/*3*","3/2","7.32/23.94","236.68/1173.06","5","1409.74","5","1339.00","1000","339.00","2013-10-03 21:52:18","1");
INSERT INTO bill VALUES("41","AWC_41","1","*5*/*2*/*5*","*3*/*2*/*1*","2.5/1.5/3","22.43/11.97/8.97","874.57/786.03/290.03","6","1950.63","0.6","1939.00","2000","0.00","2013-10-03 21:57:51","1");
INSERT INTO bill VALUES("42","AWC_42","1","*1*/*6*","*3*/*1*","6.6/0","24.16/0.00","341.84/599.00","4","940.84","6.66","878.00","300","578.00","2013-10-03 22:12:38","1");
INSERT INTO bill VALUES("43","AWC_43","10","*8*/*6*","*2*/*1*","3/2","6.54/11.98","211.46/587.02","3","798.48","5","759.00","1000","0.00","2013-10-03 22:32:56","1");
INSERT INTO bill VALUES("44","AWC_44","19","*4*/*3*","*3*/*2*","2.6/3.6","15.60/7.20","584.40/192.80","5","777.20","3.6","749.00","1000","0.00","2013-10-03 22:37:33","1");
INSERT INTO bill VALUES("45","AWC_45","19","*5*/*6*","*3*/*1*","5.6/2.6","50.23/15.57","846.77/583.43","4","1430.20","3.6","1379.00","1500","0.00","2013-10-03 22:38:38","1");
INSERT INTO bill VALUES("46","AWC_46","15","*7*/*3*","*2*/*2*","10.6/3.6","212.00/7.20","1788.00/192.80","4","1980.80","0.6","1969.00","1500","469.00","2013-10-03 22:42:07","1");
INSERT INTO bill VALUES("47","AWC_47","1","*3*/*5*","*3*/*2*","12/5","36.00/29.90","264.00/568.10","5","832.10","0","832.00","500","332.00","2013-10-04 05:49:15","1");
INSERT INTO bill VALUES("48","AWC_48","1","*1*","*1*","0","0.00","122.00","1","122.00","0","122.00","0","122.00","2013-10-04 05:50:21","1");
INSERT INTO bill VALUES("49","AWC_49","20","*10*/*5*/*1*","*5*/*3*/*5*","3.9/8.6/2.9","73.13/77.14/17.83","1801.87/819.86/597.17","13","3218.90","10.6","2878.00","2000","878.00","2013-10-05 00:48:23","1");
INSERT INTO bill VALUES("50","AWC_50","20","*8*/*9*","*2*/*4*","0.9/0","1.96/0.00","216.04/2608.00","6","2824.04","5.78","2661.00","3000","0.00","2013-10-05 00:50:24","1");
INSERT INTO bill VALUES("51","AWC_51","1","*1*/*6*","*25*/*6*","0/25","0.00/898.50","3075.00/2695.50","31","5770.50","12","5078.00","5000","78.00","2013-10-09 17:50:17","1");
INSERT INTO bill VALUES("52","AWC_52","1","*1*/*5*","*7*/*2*","5/0","43.05/0.00","817.95/5000.00","9","5817.95","50","2909.00","2000","909.00","2013-10-10 18:46:06","1");
INSERT INTO bill VALUES("53","AWC_53","1","*1*","*5*","0","0.00","615.00","5","615.00","10","554.00","500","54.00","2013-10-14 19:25:15","1");
INSERT INTO bill VALUES("54","AWC_54","15","*1*","*200*","0","0.00","24600.00","200","24600.00","10","22140.00","2000","20140.00","2013-10-14 19:26:36","1");
INSERT INTO bill VALUES("55","AWC_55","15","*13*","*2*","5.6","5.71","96.29","2","96.29","10","87.00","50","37.00","2013-10-16 14:46:34","1");
INSERT INTO bill VALUES("56","AWC_56","3","*8*/*4*","*1*/*2*","0/10","0.00/40.00","109.00/360.00","3","469.00","0","469.00","100","369.00","2013-10-24 22:10:48","1");
INSERT INTO bill VALUES("57","AWC_57","21","*8*/*9*/*2*","*2*/*3*/*1*","1.6/2/3.66","3.49/39.12/14.60","214.51/1916.88/384.40","6","2515.79","5","2390.00","2000","390.00","2013-10-24 22:15:24","1");
INSERT INTO bill VALUES("58","AWC_58","21","*2*","*3*","0","0.00","1197.00","3","1197.00","0","1197.00","100","1097.00","2013-10-24 22:18:53","1");
INSERT INTO bill VALUES("59","AWC_59","21","*2*","*3*","0","0.00","1197.00","3","1197.00","0","1197.00","100","1097.00","2013-10-24 22:18:54","1");
INSERT INTO bill VALUES("60","AWC_60","22","*6*","*5*","2","59.90","2935.10","5","2935.10","1.66","2886.00","2000","886.00","2013-10-24 22:21:13","1");
INSERT INTO bill VALUES("61","AWC_61","21","*8*","*2*","02.3","5.01","212.99","2","212.99","0","213.00","100","113.00","2013-10-24 22:25:30","1");
INSERT INTO bill VALUES("62","AWC_62","1","*2*/*3*/*4*/*6*","*1*/*1*/*1*/*1*","0/0/0/0","0.00/0.00/0.00/0.00","399.00/100.00/200.00/599.00","4","1298.00","0","1298.00","0","1298.00","2013-10-26 00:57:46","1");
INSERT INTO bill VALUES("63","AWC_63","1","*4*","*1*","0","0.00","200.00","1","200.00","0","200.00","0","200.00","2013-10-26 01:14:06","1");





CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO brand VALUES("1","Misc","1");
INSERT INTO brand VALUES("2","BlackBerrey","1");
INSERT INTO brand VALUES("3","versace","1");
INSERT INTO brand VALUES("4","zodiac","1");
INSERT INTO brand VALUES("5","AllenSolly","1");
INSERT INTO brand VALUES("6","Levis","1");
INSERT INTO brand VALUES("7","Lee","1");
INSERT INTO brand VALUES("8","Ralph Lauren","1");
INSERT INTO brand VALUES("9","Nike","1");
INSERT INTO brand VALUES("10","Armani","1");
INSERT INTO brand VALUES("11","Lacoste","1");
INSERT INTO brand VALUES("12","Gucci","1");
INSERT INTO brand VALUES("13","abercrombie & fitch ","1");
INSERT INTO brand VALUES("14","Louis Vuitton","1");
INSERT INTO brand VALUES("15","Hugo Boss","1");
INSERT INTO brand VALUES("16","sleepwell","1");
INSERT INTO brand VALUES("17","Golu","0");





CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO category VALUES("1","Misc","1");
INSERT INTO category VALUES("2","Pajama","1");
INSERT INTO category VALUES("3","Kurta","1");
INSERT INTO category VALUES("4","Kamiz","1");
INSERT INTO category VALUES("5","Tiger","1");
INSERT INTO category VALUES("6","Fancy Shirts","1");
INSERT INTO category VALUES("7","nightwear","1");
INSERT INTO category VALUES("8","swimwear","1");
INSERT INTO category VALUES("9","top","1");
INSERT INTO category VALUES("10","Mapleton","1");
INSERT INTO category VALUES("11","Authentic","1");
INSERT INTO category VALUES("12","Hamilton","1");
INSERT INTO category VALUES("13","Arrows Stormy","1");
INSERT INTO category VALUES("14","bed sheets","1");
INSERT INTO category VALUES("15","tshirt x","1");





CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `total_due` varchar(255) NOT NULL DEFAULT '0',
  `paid_due` varchar(255) NOT NULL,
  `total_paid_due` varchar(255) NOT NULL DEFAULT '0',
  `paid_due_date` varchar(2000) NOT NULL,
  `created_date` datetime NOT NULL,
  `notification_status` char(1) NOT NULL DEFAULT '1',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO customer VALUES("1","Misc","0000000000","Misc","Misc","AWC_9/AWC_10/AWC_7/AWC_35/AWC_27/AWC_62/AWC_63","465.00/52.00/4.00/0.00/91.00/1298.00/200.00","2110.00","200.00/2.00/319.00","521.00","2013-10-04 04:43:42/2013-10-04 04:44:27/2013-10-15 21:29:36","2013-09-28 21:30:18","1","1");
INSERT INTO customer VALUES("2","Rohan Garg","9874563210","rohan@gmail.com","","AWC_1","456.00","456","400.00","400.00","2013-10-16 14:59:47","2013-09-28 23:24:57","1","1");
INSERT INTO customer VALUES("3","Rishabh kumar","8010979311","rishabh@yahoo.com","Lucknow","AWC_2/AWC_6/AWC_31/AWC_41/AWC_51/AWC_52/AWC_56","0.00/60.00/39.00/0.00/78.00/909.00/369.00","1455.00","50.00/27.00/50.00/500.00/400.00","1027","2013-10-04 04:46:42/2013-10-09 17:53:31/2013-10-09 17:53:48/2013-10-10 18:47:50/2013-10-10 18:48:16","2013-09-28 23:28:44","1","1");
INSERT INTO customer VALUES("4","Rishabh Mittal","8010979318","rishabh@outlook.com","Sitapur","AWC_3/AWC_40","677.00/339.00","1016","500.00","500","2013-10-04 04:09:02","2013-09-28 23:30:48","1","1");
INSERT INTO customer VALUES("5","Sohan Gupta","9864949849","sohan@gmail.com","-","AWC_4","0.00","0","","0","","2013-09-28 23:32:27","1","1");
INSERT INTO customer VALUES("6","Gungun Tayal","8010979794","","","AWC_5/AWC_53","2999.00/54.00","3053","","0","","2013-09-28 23:37:12","1","1");
INSERT INTO customer VALUES("7","Sachin Yadav","9874555828","","","AWC_7","4.00","4","2.00","2","2013-10-04 04:44:27","2013-09-29 12:43:42","1","0");
INSERT INTO customer VALUES("8","Mayank Agrawal","9874569778","mayank@yahoo.com","","AWC_8","0.00","0","","0","","2013-09-29 12:45:52","1","1");
INSERT INTO customer VALUES("9","Gungun Garg","8015564944","","","AWC_9/AWC_10","465.00/52.00","517","200.00","200","2013-10-04 04:43:42","2013-09-29 14:47:36","1","0");
INSERT INTO customer VALUES("10","Rishabh Gupta","9877784548","rishabh@gmail.com","check","AWC_26/AWC_43","0.00/0.00","0","","0","","2013-09-29 18:31:17","1","1");
INSERT INTO customer VALUES("12","Azeem Khan","9879999887","azeemkhan@kasovious.com","Delhi India","AWC_27","91.00","91","","0","","2013-10-02 13:01:55","1","0");
INSERT INTO customer VALUES("13","Hello","9888888888","hello@gmail.com","","AWC_28/AWC_29/AWC_30","1289.00/1928.00/1928.00","5145","","0","","2013-10-02 13:05:42","0","1");
INSERT INTO customer VALUES("14","Rishabh Agrawal","9555801040","rishabh@kasovious","Delhi","AWC_32/AWC_33","0.00/292.00","292","","0","","2013-10-03 20:08:56","1","1");
INSERT INTO customer VALUES("15","Karan Magan","8010979312","karan@yahoo.com","Bhopal","AWC_34/AWC_46/AWC_54/AWC_55","7.00/469.00/20140.00/37.00","20653.00","100.00/500.00/20000.00/16.00/10.00/27.00","20653.00","2013-10-04 04:00:05/2013-10-15 11:42:38/2013-10-15 11:42:47/2013-10-15 11:42:53/2013-10-16 14:57:30/2013-10-24 23:43:30","2013-10-03 20:17:46","0","1");
INSERT INTO customer VALUES("16","Karan Magan","8010979355","contact@karan.com","-","AWC_35","0.00","0","","0","","2013-10-03 20:21:48","1","0");
INSERT INTO customer VALUES("17","Rishabh Mittal","8010979666","rishabh@gmail.com","Sitapur","AWC_36","0.00","0","","0","","2013-10-03 21:10:06","1","1");
INSERT INTO customer VALUES("18","Rakesh Mittal","8010979688","rishabh@gmail.com","Sitapur","AWC_37","339.00","339","","0","","2013-10-03 21:13:28","1","1");
INSERT INTO customer VALUES("19","Rishabh Mittal","8010979663","rishabh@contact.com","Maholi","AWC_38/AWC_44/AWC_45","339.00/0.00/0.00","339","100.00/200.00/39.00","339","2013-10-04 04:41:20/2013-10-04 04:51:33/2013-10-15 10:47:46","2013-10-03 21:50:09","1","1");
INSERT INTO customer VALUES("20","Tiger Tayal","9899979745","tiger@yahoo.com","Shamli","AWC_49/AWC_50","878.00/0.00","878","500.00/78.00/200.00/100.00","878","2013-10-05 00:58:08/2013-10-05 01:02:38/2013-10-12 15:50:52/2013-10-15 10:42:43","2013-10-05 00:48:23","1","1");
INSERT INTO customer VALUES("21","Somya Gupta","8010998756","somya_gupta@yahoo.com","Delhi, India","AWC_57/AWC_58/AWC_59/AWC_61","390.00/1097.00/1097.00/113.00","2697.00","200.00/500.00/1.00/50.00","751.00","2013-10-24 23:42:39/2013-10-24 23:43:08/2013-10-24 23:44:59/2013-10-25 00:51:40","2013-10-24 22:15:24","1","1");
INSERT INTO customer VALUES("22","Somya Gupta","","","","AWC_60","886.00","886.00","1.00/400.00/2.00/50.00/50.00/50.00/10.00","563.00","2013-10-24 23:24:44/2013-10-24 23:25:26/2013-10-24 23:38:30/2013-10-24 23:42:03/2013-10-24 23:42:16/2013-10-24 23:42:25/2013-10-25 18:40:33","2013-10-24 22:21:13","1","1");





CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `rating` varchar(20) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO feedback VALUES("1","Rishabh","rishabh_agr@yahoo.com","Awesome Software","5","1");
INSERT INTO feedback VALUES("2","Azeem Khan","azeem@yahoo.com","Mindblowing... :)","5","1");
INSERT INTO feedback VALUES("3","","","","3","1");
INSERT INTO feedback VALUES("4","","","","5","1");
INSERT INTO feedback VALUES("5","","","","5","1");
INSERT INTO feedback VALUES("6","","","","5","1");





CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(20) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'misc',
  `product_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `sell_qty` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notification_status` char(1) NOT NULL DEFAULT '1',
  `status` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO product VALUES("1","00001","8","shirt","750","246","123","8","Gray","42","M","1","1");
INSERT INTO product VALUES("2","00002","4","Trousers","960","10","399","5","Green","38","M","1","1");
INSERT INTO product VALUES("3","00003","3","abcd","510","8","100","12","Yellow","42","M","1","1");
INSERT INTO product VALUES("4","00004","7","tshirt","150","7","200","6","White","38","F","1","1");
INSERT INTO product VALUES("5","00005","2","Lee511","720","14","2500","10","Red","40","F","1","1");
INSERT INTO product VALUES("6","00006","12","hello","215","15","599","10","Orange","42","M","1","1");
INSERT INTO product VALUES("7","00007","14","omega","610","2","775","4","Orange","XL","M","1","1");
INSERT INTO product VALUES("8","00008","12","bellbottom","820","9","109","15","Purple","M","M","1","1");
INSERT INTO product VALUES("9","00009","13","Shirt","603","503","652","6","Black","35","M","1","1");
INSERT INTO product VALUES("10","00010","14","green bed","310","5","375","6","mixed","","","1","1");
INSERT INTO product VALUES("11","00011","misc","Best shirts","500","0","285","1","Black","36","","1","1");
INSERT INTO product VALUES("12","00012","14","Testing","155","0","500","10","Black","32","M","1","1");
INSERT INTO product VALUES("13","00013","4","sachin","215","2","51","5","red","32","M","1","1");





CREATE TABLE `sam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `command` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO sam VALUES("1","Home Page","index.php","1");
INSERT INTO sam VALUES("2","dashboard","dashboard.php","1");
INSERT INTO sam VALUES("3","stock","stock.php","1");





CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privileges` varchar(255) NOT NULL,
  `notification` char(1) NOT NULL DEFAULT '0',
  `due_day` int(11) NOT NULL DEFAULT '7',
  `stock_item` int(11) NOT NULL DEFAULT '10',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO user VALUES("1","admin","202cb962ac59075b964b07152d234b70","billing.php/new_bill.php/manage_bill.php/stock.php/addstock.php/viewstock.php/system_wizard.php/change_password.php/manage_user.php/customer.php/dues.php/dashboard.php/notification.php","1","33","10","1");
INSERT INTO user VALUES("3","rishabh_agr","c4ca4238a0b923820dcc509a6f75849b","addstock.php/system_wizard.php/change_password.php/manage_user.php/customer.php/dues.php/dashboard.php/stock.php/system_wizard.php","0","7","10","1");
INSERT INTO user VALUES("4","rishabh","698d51a19d8a121ce581499d7b701668","billing.php/new_bill.php/manage_bill.php/dues.php/dashboard.php","0","7","10","1");
INSERT INTO user VALUES("5","rishabh_123","202cb962ac59075b964b07152d234b70","manage_bill.php/stock.php/addstock.php/viewstock.php/change_password.php/dashboard.php/billing.php/system_wizard.php","0","7","10","1");
INSERT INTO user VALUES("6","kasovious","202cb962ac59075b964b07152d234b70","stock.php/addstock.php/viewstock.php/dues.php/dashboard.php","0","7","10","1");
INSERT INTO user VALUES("7","user_102","202cb962ac59075b964b07152d234b70","system_wizard.php/change_password.php/manage_user.php/dashboard.php","0","7","10","1");
INSERT INTO user VALUES("8","rishabh111","202cb962ac59075b964b07152d234b70","billing.php/new_bill.php/manage_bill.php/dashboard.php","0","7","10","1");
INSERT INTO user VALUES("9","user_101","c4ca4238a0b923820dcc509a6f75849b","billing.php/new_bill.php/manage_bill.php/dashboard.php","0","7","10","1");
INSERT INTO user VALUES("10","testing","c4ca4238a0b923820dcc509a6f75849b","new_bill.php/dashboard.php/billing.php","0","7","10","1");
INSERT INTO user VALUES("11","12333","c81e728d9d4c2f636f067f89cc14862c","billing.php/new_bill.php/manage_bill.php/system_wizard.php/change_password.php/manage_user.php/dues.php/notification.php/dashboard.php","0","7","10","1");
INSERT INTO user VALUES("12","123","c4ca4238a0b923820dcc509a6f75849b","billing.php/new_bill.php/manage_bill.php/change_password.php/notification.php/dashboard.php/system_wizard.php","1","21","10","1");
INSERT INTO user VALUES("13","111","5058f1af8388633f609cadb75a75dc9d","billing.php/new_bill.php/manage_bill.php/notification.php/dashboard.php/system_wizard.php","0","7","10","1");
INSERT INTO user VALUES("14","1111","c81e728d9d4c2f636f067f89cc14862c","billing.php/new_bill.php/manage_bill.php/notification.php/dashboard.php/billing.php/system_wizard.php","0","7","10","1");
INSERT INTO user VALUES("15","11","c4ca4238a0b923820dcc509a6f75849b","billing.php/new_bill.php/manage_bill.php/dashboard.php","0","7","10","1");
INSERT INTO user VALUES("16","rishabh_1","202cb962ac59075b964b07152d234b70","new_bill.php/addstock.php/notification.php/dashboard.php/billing.php/stock.php/system_wizard.php","1","15","10","1");



