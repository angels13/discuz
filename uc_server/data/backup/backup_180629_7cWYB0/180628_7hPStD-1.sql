# Identify: MTUzMDIzNzg2MCx1Y2VudGVyLHVjZW50ZXIsbXVsdGl2b2wsMQ==
# <?php exit();?>
# ucenter Multi-Volume Data Dump Vol.1
# Time: 2018-06-28 21:04:20
# Type: ucenter
# Table Prefix: pre_ucenter_
# gbk
# ucenter Home: http://www.comsenz.com
# Please visit our website for newest infomation about ucenter
# --------------------------------------------------------


DROP TABLE IF EXISTS pre_ucenter_admins;
CREATE TABLE pre_ucenter_admins (
  uid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  username char(15) NOT NULL DEFAULT '',
  allowadminsetting tinyint(1) NOT NULL DEFAULT '0',
  allowadminapp tinyint(1) NOT NULL DEFAULT '0',
  allowadminuser tinyint(1) NOT NULL DEFAULT '0',
  allowadminbadword tinyint(1) NOT NULL DEFAULT '0',
  allowadmintag tinyint(1) NOT NULL DEFAULT '0',
  allowadminpm tinyint(1) NOT NULL DEFAULT '0',
  allowadmincredits tinyint(1) NOT NULL DEFAULT '0',
  allowadmindomain tinyint(1) NOT NULL DEFAULT '0',
  allowadmindb tinyint(1) NOT NULL DEFAULT '0',
  allowadminnote tinyint(1) NOT NULL DEFAULT '0',
  allowadmincache tinyint(1) NOT NULL DEFAULT '0',
  allowadminlog tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (uid),
  UNIQUE KEY username (username)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk AUTO_INCREMENT=2;

DROP TABLE IF EXISTS pre_ucenter_applications;
CREATE TABLE pre_ucenter_applications (
  appid smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(16) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  url varchar(255) NOT NULL DEFAULT '',
  authkey varchar(255) NOT NULL DEFAULT '',
  ip varchar(15) NOT NULL DEFAULT '',
  viewprourl varchar(255) NOT NULL,
  apifilename varchar(30) NOT NULL DEFAULT 'uc.php',
  `charset` varchar(8) NOT NULL DEFAULT '',
  dbcharset varchar(8) NOT NULL DEFAULT '',
  synlogin tinyint(1) NOT NULL DEFAULT '0',
  recvnote tinyint(1) DEFAULT '0',
  extra text NOT NULL,
  tagtemplates text NOT NULL,
  allowips text NOT NULL,
  PRIMARY KEY (appid)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk AUTO_INCREMENT=2;

DROP TABLE IF EXISTS pre_ucenter_badwords;
CREATE TABLE pre_ucenter_badwords (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `admin` varchar(15) NOT NULL DEFAULT '',
  find varchar(255) NOT NULL DEFAULT '',
  replacement varchar(255) NOT NULL DEFAULT '',
  findpattern varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY find (find)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

DROP TABLE IF EXISTS pre_ucenter_domains;
CREATE TABLE pre_ucenter_domains (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  domain char(40) NOT NULL DEFAULT '',
  ip char(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk AUTO_INCREMENT=2;

DROP TABLE IF EXISTS pre_ucenter_failedlogins;
CREATE TABLE pre_ucenter_failedlogins (
  ip char(15) NOT NULL DEFAULT '',
  count tinyint(1) unsigned NOT NULL DEFAULT '0',
  lastupdate int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (ip)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_feeds;
CREATE TABLE pre_ucenter_feeds (
  feedid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  appid varchar(30) NOT NULL DEFAULT '',
  icon varchar(30) NOT NULL DEFAULT '',
  uid mediumint(8) unsigned NOT NULL DEFAULT '0',
  username varchar(15) NOT NULL DEFAULT '',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  hash_template varchar(32) NOT NULL DEFAULT '',
  hash_data varchar(32) NOT NULL DEFAULT '',
  title_template text NOT NULL,
  title_data text NOT NULL,
  body_template text NOT NULL,
  body_data text NOT NULL,
  body_general text NOT NULL,
  image_1 varchar(255) NOT NULL DEFAULT '',
  image_1_link varchar(255) NOT NULL DEFAULT '',
  image_2 varchar(255) NOT NULL DEFAULT '',
  image_2_link varchar(255) NOT NULL DEFAULT '',
  image_3 varchar(255) NOT NULL DEFAULT '',
  image_3_link varchar(255) NOT NULL DEFAULT '',
  image_4 varchar(255) NOT NULL DEFAULT '',
  image_4_link varchar(255) NOT NULL DEFAULT '',
  target_ids varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (feedid),
  KEY uid (uid,dateline)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

DROP TABLE IF EXISTS pre_ucenter_friends;
CREATE TABLE pre_ucenter_friends (
  uid mediumint(8) unsigned NOT NULL DEFAULT '0',
  friendid mediumint(8) unsigned NOT NULL DEFAULT '0',
  direction tinyint(1) NOT NULL DEFAULT '0',
  version int(10) unsigned NOT NULL AUTO_INCREMENT,
  delstatus tinyint(1) NOT NULL DEFAULT '0',
  `comment` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (version),
  KEY uid (uid),
  KEY friendid (friendid)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

DROP TABLE IF EXISTS pre_ucenter_mailqueue;
CREATE TABLE pre_ucenter_mailqueue (
  mailid int(10) unsigned NOT NULL AUTO_INCREMENT,
  touid mediumint(8) unsigned NOT NULL DEFAULT '0',
  tomail varchar(32) NOT NULL,
  frommail varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  message text NOT NULL,
  `charset` varchar(15) NOT NULL,
  htmlon tinyint(1) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '1',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  failures tinyint(3) unsigned NOT NULL DEFAULT '0',
  appid smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (mailid),
  KEY appid (appid),
  KEY `level` (`level`,failures)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1;

DROP TABLE IF EXISTS pre_ucenter_memberfields;
CREATE TABLE pre_ucenter_memberfields (
  uid mediumint(8) unsigned NOT NULL,
  blacklist text NOT NULL,
  PRIMARY KEY (uid)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_members;
CREATE TABLE pre_ucenter_members (
  uid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  username char(15) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  email char(32) NOT NULL DEFAULT '',
  myid char(30) NOT NULL DEFAULT '',
  myidkey char(16) NOT NULL DEFAULT '',
  regip char(15) NOT NULL DEFAULT '',
  regdate int(10) unsigned NOT NULL DEFAULT '0',
  lastloginip int(10) NOT NULL DEFAULT '0',
  lastlogintime int(10) unsigned NOT NULL DEFAULT '0',
  salt char(6) NOT NULL,
  secques char(8) NOT NULL DEFAULT '',
  PRIMARY KEY (uid),
  UNIQUE KEY username (username),
  KEY email (email)
) ENGINE=MyISAM AUTO_INCREMENT=275 DEFAULT CHARSET=gbk AUTO_INCREMENT=275;

DROP TABLE IF EXISTS pre_ucenter_mergemembers;
CREATE TABLE pre_ucenter_mergemembers (
  appid smallint(6) unsigned NOT NULL,
  username char(15) NOT NULL,
  PRIMARY KEY (appid,username)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_newpm;
CREATE TABLE pre_ucenter_newpm (
  uid mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (uid)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_notelist;
CREATE TABLE pre_ucenter_notelist (
  noteid int(10) unsigned NOT NULL AUTO_INCREMENT,
  operation char(32) NOT NULL,
  closed tinyint(4) NOT NULL DEFAULT '0',
  totalnum smallint(6) unsigned NOT NULL DEFAULT '0',
  succeednum smallint(6) unsigned NOT NULL DEFAULT '0',
  getdata mediumtext NOT NULL,
  postdata mediumtext NOT NULL,
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  pri tinyint(3) NOT NULL DEFAULT '0',
  app1 tinyint(4) NOT NULL,
  PRIMARY KEY (noteid),
  KEY closed (closed,pri,noteid),
  KEY dateline (dateline)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=gbk AUTO_INCREMENT=15;

DROP TABLE IF EXISTS pre_ucenter_pm_indexes;
CREATE TABLE pre_ucenter_pm_indexes (
  pmid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (pmid),
  KEY plid (plid)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=gbk AUTO_INCREMENT=6;

DROP TABLE IF EXISTS pre_ucenter_pm_lists;
CREATE TABLE pre_ucenter_pm_lists (
  plid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  authorid mediumint(8) unsigned NOT NULL DEFAULT '0',
  pmtype tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(80) NOT NULL,
  members smallint(5) unsigned NOT NULL DEFAULT '0',
  min_max varchar(17) NOT NULL,
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  lastmessage text NOT NULL,
  PRIMARY KEY (plid),
  KEY pmtype (pmtype),
  KEY min_max (min_max),
  KEY authorid (authorid,dateline)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk AUTO_INCREMENT=2;

DROP TABLE IF EXISTS pre_ucenter_pm_members;
CREATE TABLE pre_ucenter_pm_members (
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  uid mediumint(8) unsigned NOT NULL DEFAULT '0',
  isnew tinyint(1) unsigned NOT NULL DEFAULT '0',
  pmnum int(10) unsigned NOT NULL DEFAULT '0',
  lastupdate int(10) unsigned NOT NULL DEFAULT '0',
  lastdateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (plid,uid),
  KEY isnew (isnew),
  KEY lastdateline (uid,lastdateline),
  KEY lastupdate (uid,lastupdate)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_pm_messages_0;
CREATE TABLE pre_ucenter_pm_messages_0 (
  pmid mediumint(8) unsigned NOT NULL DEFAULT '0',
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  authorid mediumint(8) unsigned NOT NULL DEFAULT '0',
  message text NOT NULL,
  delstatus tinyint(1) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (pmid),
  KEY plid (plid,delstatus,dateline),
  KEY dateline (plid,dateline)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_pm_messages_1;
CREATE TABLE pre_ucenter_pm_messages_1 (
  pmid mediumint(8) unsigned NOT NULL DEFAULT '0',
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  authorid mediumint(8) unsigned NOT NULL DEFAULT '0',
  message text NOT NULL,
  delstatus tinyint(1) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (pmid),
  KEY plid (plid,delstatus,dateline),
  KEY dateline (plid,dateline)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_pm_messages_2;
CREATE TABLE pre_ucenter_pm_messages_2 (
  pmid mediumint(8) unsigned NOT NULL DEFAULT '0',
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  authorid mediumint(8) unsigned NOT NULL DEFAULT '0',
  message text NOT NULL,
  delstatus tinyint(1) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (pmid),
  KEY plid (plid,delstatus,dateline),
  KEY dateline (plid,dateline)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_pm_messages_3;
CREATE TABLE pre_ucenter_pm_messages_3 (
  pmid mediumint(8) unsigned NOT NULL DEFAULT '0',
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  authorid mediumint(8) unsigned NOT NULL DEFAULT '0',
  message text NOT NULL,
  delstatus tinyint(1) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (pmid),
  KEY plid (plid,delstatus,dateline),
  KEY dateline (plid,dateline)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_pm_messages_4;
CREATE TABLE pre_ucenter_pm_messages_4 (
  pmid mediumint(8) unsigned NOT NULL DEFAULT '0',
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  authorid mediumint(8) unsigned NOT NULL DEFAULT '0',
  message text NOT NULL,
  delstatus tinyint(1) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (pmid),
  KEY plid (plid,delstatus,dateline),
  KEY dateline (plid,dateline)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_pm_messages_5;
CREATE TABLE pre_ucenter_pm_messages_5 (
  pmid mediumint(8) unsigned NOT NULL DEFAULT '0',
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  authorid mediumint(8) unsigned NOT NULL DEFAULT '0',
  message text NOT NULL,
  delstatus tinyint(1) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (pmid),
  KEY plid (plid,delstatus,dateline),
  KEY dateline (plid,dateline)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_pm_messages_6;
CREATE TABLE pre_ucenter_pm_messages_6 (
  pmid mediumint(8) unsigned NOT NULL DEFAULT '0',
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  authorid mediumint(8) unsigned NOT NULL DEFAULT '0',
  message text NOT NULL,
  delstatus tinyint(1) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (pmid),
  KEY plid (plid,delstatus,dateline),
  KEY dateline (plid,dateline)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_pm_messages_7;
CREATE TABLE pre_ucenter_pm_messages_7 (
  pmid mediumint(8) unsigned NOT NULL DEFAULT '0',
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  authorid mediumint(8) unsigned NOT NULL DEFAULT '0',
  message text NOT NULL,
  delstatus tinyint(1) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (pmid),
  KEY plid (plid,delstatus,dateline),
  KEY dateline (plid,dateline)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_pm_messages_8;
CREATE TABLE pre_ucenter_pm_messages_8 (
  pmid mediumint(8) unsigned NOT NULL DEFAULT '0',
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  authorid mediumint(8) unsigned NOT NULL DEFAULT '0',
  message text NOT NULL,
  delstatus tinyint(1) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (pmid),
  KEY plid (plid,delstatus,dateline),
  KEY dateline (plid,dateline)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_pm_messages_9;
CREATE TABLE pre_ucenter_pm_messages_9 (
  pmid mediumint(8) unsigned NOT NULL DEFAULT '0',
  plid mediumint(8) unsigned NOT NULL DEFAULT '0',
  authorid mediumint(8) unsigned NOT NULL DEFAULT '0',
  message text NOT NULL,
  delstatus tinyint(1) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (pmid),
  KEY plid (plid,delstatus,dateline),
  KEY dateline (plid,dateline)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_protectedmembers;
CREATE TABLE pre_ucenter_protectedmembers (
  uid mediumint(8) unsigned NOT NULL DEFAULT '0',
  username char(15) NOT NULL DEFAULT '',
  appid tinyint(1) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  `admin` char(15) NOT NULL DEFAULT '0',
  UNIQUE KEY username (username,appid)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_settings;
CREATE TABLE pre_ucenter_settings (
  k varchar(32) NOT NULL DEFAULT '',
  v text NOT NULL,
  PRIMARY KEY (k)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_sqlcache;
CREATE TABLE pre_ucenter_sqlcache (
  sqlid char(6) NOT NULL DEFAULT '',
  `data` char(100) NOT NULL,
  expiry int(10) unsigned NOT NULL,
  PRIMARY KEY (sqlid),
  KEY expiry (expiry)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_tags;
CREATE TABLE pre_ucenter_tags (
  tagname char(20) NOT NULL,
  appid smallint(6) unsigned NOT NULL DEFAULT '0',
  `data` mediumtext,
  expiration int(10) unsigned NOT NULL,
  KEY tagname (tagname,appid)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

DROP TABLE IF EXISTS pre_ucenter_vars;
CREATE TABLE pre_ucenter_vars (
  `name` char(32) NOT NULL DEFAULT '',
  `value` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=MEMORY DEFAULT CHARSET=gbk;

INSERT INTO pre_ucenter_admins VALUES ('1',0x6a6f7974616f62616f,'1','1','1','1','1','1','1','1','1','1','1','1');

INSERT INTO pre_ucenter_applications VALUES ('1',0x44495343555a58,0x44697363757a2120426f617264,0x687474703a2f2f7777772e3532646f636b65722e636f6d,0x423669356830343564356864593038616d62473069664a30443556396538703141333232733178663032473059353138656444364965546144646a3469614333,'','',0x75632e706870,'','','1','1','','','');


INSERT INTO pre_ucenter_domains VALUES ('1',0x6262732e3532646f636b65722e636f6d,0x3139382e3235322e39392e313533);

INSERT INTO pre_ucenter_failedlogins VALUES (0x623935613433343836333061346433,'0','1530237735');
INSERT INTO pre_ucenter_failedlogins VALUES (0x306266396564646665353135353535,'1','1530237702');
INSERT INTO pre_ucenter_failedlogins VALUES (0x34352e36342e35322e313234,'1','1530237702');




INSERT INTO pre_ucenter_memberfields VALUES ('1','');
INSERT INTO pre_ucenter_memberfields VALUES ('2','');
INSERT INTO pre_ucenter_memberfields VALUES ('3','');
INSERT INTO pre_ucenter_memberfields VALUES ('70','');
INSERT INTO pre_ucenter_memberfields VALUES ('69','');
INSERT INTO pre_ucenter_memberfields VALUES ('68','');
INSERT INTO pre_ucenter_memberfields VALUES ('67','');
INSERT INTO pre_ucenter_memberfields VALUES ('66','');
INSERT INTO pre_ucenter_memberfields VALUES ('65','');
INSERT INTO pre_ucenter_memberfields VALUES ('64','');
INSERT INTO pre_ucenter_memberfields VALUES ('63','');
INSERT INTO pre_ucenter_memberfields VALUES ('62','');
INSERT INTO pre_ucenter_memberfields VALUES ('61','');
INSERT INTO pre_ucenter_memberfields VALUES ('60','');
INSERT INTO pre_ucenter_memberfields VALUES ('59','');
INSERT INTO pre_ucenter_memberfields VALUES ('58','');
INSERT INTO pre_ucenter_memberfields VALUES ('57','');
INSERT INTO pre_ucenter_memberfields VALUES ('56','');
INSERT INTO pre_ucenter_memberfields VALUES ('55','');
INSERT INTO pre_ucenter_memberfields VALUES ('54','');
INSERT INTO pre_ucenter_memberfields VALUES ('77','');
INSERT INTO pre_ucenter_memberfields VALUES ('76','');
INSERT INTO pre_ucenter_memberfields VALUES ('75','');
INSERT INTO pre_ucenter_memberfields VALUES ('74','');
INSERT INTO pre_ucenter_memberfields VALUES ('73','');
INSERT INTO pre_ucenter_memberfields VALUES ('72','');
INSERT INTO pre_ucenter_memberfields VALUES ('80','');
INSERT INTO pre_ucenter_memberfields VALUES ('79','');
INSERT INTO pre_ucenter_memberfields VALUES ('78','');
INSERT INTO pre_ucenter_memberfields VALUES ('53','');
INSERT INTO pre_ucenter_memberfields VALUES ('52','');
INSERT INTO pre_ucenter_memberfields VALUES ('51','');
INSERT INTO pre_ucenter_memberfields VALUES ('71','');
INSERT INTO pre_ucenter_memberfields VALUES ('49','');
INSERT INTO pre_ucenter_memberfields VALUES ('48','');
INSERT INTO pre_ucenter_memberfields VALUES ('47','');
INSERT INTO pre_ucenter_memberfields VALUES ('82','');
INSERT INTO pre_ucenter_memberfields VALUES ('81','');
INSERT INTO pre_ucenter_memberfields VALUES ('46','');
INSERT INTO pre_ucenter_memberfields VALUES ('83','');
INSERT INTO pre_ucenter_memberfields VALUES ('84','');
INSERT INTO pre_ucenter_memberfields VALUES ('85','');
INSERT INTO pre_ucenter_memberfields VALUES ('86','');
INSERT INTO pre_ucenter_memberfields VALUES ('87','');
INSERT INTO pre_ucenter_memberfields VALUES ('88','');
INSERT INTO pre_ucenter_memberfields VALUES ('89','');
INSERT INTO pre_ucenter_memberfields VALUES ('90','');
INSERT INTO pre_ucenter_memberfields VALUES ('91','');
INSERT INTO pre_ucenter_memberfields VALUES ('92','');
INSERT INTO pre_ucenter_memberfields VALUES ('93','');
INSERT INTO pre_ucenter_memberfields VALUES ('94','');
INSERT INTO pre_ucenter_memberfields VALUES ('95','');
INSERT INTO pre_ucenter_memberfields VALUES ('96','');
INSERT INTO pre_ucenter_memberfields VALUES ('97','');
INSERT INTO pre_ucenter_memberfields VALUES ('98','');
INSERT INTO pre_ucenter_memberfields VALUES ('99','');
INSERT INTO pre_ucenter_memberfields VALUES ('100','');
INSERT INTO pre_ucenter_memberfields VALUES ('101','');
INSERT INTO pre_ucenter_memberfields VALUES ('102','');
INSERT INTO pre_ucenter_memberfields VALUES ('103','');
INSERT INTO pre_ucenter_memberfields VALUES ('104','');
INSERT INTO pre_ucenter_memberfields VALUES ('105','');
INSERT INTO pre_ucenter_memberfields VALUES ('106','');
INSERT INTO pre_ucenter_memberfields VALUES ('107','');
INSERT INTO pre_ucenter_memberfields VALUES ('108','');
INSERT INTO pre_ucenter_memberfields VALUES ('109','');
INSERT INTO pre_ucenter_memberfields VALUES ('110','');
INSERT INTO pre_ucenter_memberfields VALUES ('111','');
INSERT INTO pre_ucenter_memberfields VALUES ('112','');
INSERT INTO pre_ucenter_memberfields VALUES ('113','');
INSERT INTO pre_ucenter_memberfields VALUES ('114','');
INSERT INTO pre_ucenter_memberfields VALUES ('115','');
INSERT INTO pre_ucenter_memberfields VALUES ('116','');
INSERT INTO pre_ucenter_memberfields VALUES ('117','');
INSERT INTO pre_ucenter_memberfields VALUES ('118','');
INSERT INTO pre_ucenter_memberfields VALUES ('119','');
INSERT INTO pre_ucenter_memberfields VALUES ('120','');
INSERT INTO pre_ucenter_memberfields VALUES ('121','');
INSERT INTO pre_ucenter_memberfields VALUES ('122','');
INSERT INTO pre_ucenter_memberfields VALUES ('123','');
INSERT INTO pre_ucenter_memberfields VALUES ('124','');
INSERT INTO pre_ucenter_memberfields VALUES ('125','');
INSERT INTO pre_ucenter_memberfields VALUES ('126','');
INSERT INTO pre_ucenter_memberfields VALUES ('127','');
INSERT INTO pre_ucenter_memberfields VALUES ('128','');
INSERT INTO pre_ucenter_memberfields VALUES ('129','');
INSERT INTO pre_ucenter_memberfields VALUES ('130','');
INSERT INTO pre_ucenter_memberfields VALUES ('131','');
INSERT INTO pre_ucenter_memberfields VALUES ('132','');
INSERT INTO pre_ucenter_memberfields VALUES ('133','');
INSERT INTO pre_ucenter_memberfields VALUES ('134','');
INSERT INTO pre_ucenter_memberfields VALUES ('135','');
INSERT INTO pre_ucenter_memberfields VALUES ('136','');
INSERT INTO pre_ucenter_memberfields VALUES ('137','');
INSERT INTO pre_ucenter_memberfields VALUES ('138','');
INSERT INTO pre_ucenter_memberfields VALUES ('139','');
INSERT INTO pre_ucenter_memberfields VALUES ('140','');
INSERT INTO pre_ucenter_memberfields VALUES ('141','');
INSERT INTO pre_ucenter_memberfields VALUES ('142','');
INSERT INTO pre_ucenter_memberfields VALUES ('143','');
INSERT INTO pre_ucenter_memberfields VALUES ('144','');
INSERT INTO pre_ucenter_memberfields VALUES ('145','');
INSERT INTO pre_ucenter_memberfields VALUES ('146','');
INSERT INTO pre_ucenter_memberfields VALUES ('147','');
INSERT INTO pre_ucenter_memberfields VALUES ('148','');
INSERT INTO pre_ucenter_memberfields VALUES ('149','');
INSERT INTO pre_ucenter_memberfields VALUES ('150','');
INSERT INTO pre_ucenter_memberfields VALUES ('151','');
INSERT INTO pre_ucenter_memberfields VALUES ('152','');
INSERT INTO pre_ucenter_memberfields VALUES ('153','');
INSERT INTO pre_ucenter_memberfields VALUES ('154','');
INSERT INTO pre_ucenter_memberfields VALUES ('155','');
INSERT INTO pre_ucenter_memberfields VALUES ('156','');
INSERT INTO pre_ucenter_memberfields VALUES ('157','');
INSERT INTO pre_ucenter_memberfields VALUES ('158','');
INSERT INTO pre_ucenter_memberfields VALUES ('159','');
INSERT INTO pre_ucenter_memberfields VALUES ('160','');
INSERT INTO pre_ucenter_memberfields VALUES ('161','');
INSERT INTO pre_ucenter_memberfields VALUES ('162','');
INSERT INTO pre_ucenter_memberfields VALUES ('163','');
INSERT INTO pre_ucenter_memberfields VALUES ('164','');
INSERT INTO pre_ucenter_memberfields VALUES ('165','');
INSERT INTO pre_ucenter_memberfields VALUES ('166','');
INSERT INTO pre_ucenter_memberfields VALUES ('167','');
INSERT INTO pre_ucenter_memberfields VALUES ('168','');
INSERT INTO pre_ucenter_memberfields VALUES ('169','');
INSERT INTO pre_ucenter_memberfields VALUES ('170','');
INSERT INTO pre_ucenter_memberfields VALUES ('171','');
INSERT INTO pre_ucenter_memberfields VALUES ('172','');
INSERT INTO pre_ucenter_memberfields VALUES ('173','');
INSERT INTO pre_ucenter_memberfields VALUES ('174','');
INSERT INTO pre_ucenter_memberfields VALUES ('175','');
INSERT INTO pre_ucenter_memberfields VALUES ('176','');
INSERT INTO pre_ucenter_memberfields VALUES ('177','');
INSERT INTO pre_ucenter_memberfields VALUES ('178','');
INSERT INTO pre_ucenter_memberfields VALUES ('179','');
INSERT INTO pre_ucenter_memberfields VALUES ('180','');
INSERT INTO pre_ucenter_memberfields VALUES ('181','');
INSERT INTO pre_ucenter_memberfields VALUES ('182','');
INSERT INTO pre_ucenter_memberfields VALUES ('183','');
INSERT INTO pre_ucenter_memberfields VALUES ('184','');
INSERT INTO pre_ucenter_memberfields VALUES ('185','');
INSERT INTO pre_ucenter_memberfields VALUES ('186','');
INSERT INTO pre_ucenter_memberfields VALUES ('187','');
INSERT INTO pre_ucenter_memberfields VALUES ('188','');
INSERT INTO pre_ucenter_memberfields VALUES ('189','');
INSERT INTO pre_ucenter_memberfields VALUES ('190','');
INSERT INTO pre_ucenter_memberfields VALUES ('191','');
INSERT INTO pre_ucenter_memberfields VALUES ('192','');
INSERT INTO pre_ucenter_memberfields VALUES ('193','');
INSERT INTO pre_ucenter_memberfields VALUES ('194','');
INSERT INTO pre_ucenter_memberfields VALUES ('195','');
INSERT INTO pre_ucenter_memberfields VALUES ('196','');
INSERT INTO pre_ucenter_memberfields VALUES ('197','');
INSERT INTO pre_ucenter_memberfields VALUES ('198','');
INSERT INTO pre_ucenter_memberfields VALUES ('199','');
INSERT INTO pre_ucenter_memberfields VALUES ('200','');
INSERT INTO pre_ucenter_memberfields VALUES ('201','');
INSERT INTO pre_ucenter_memberfields VALUES ('202','');
INSERT INTO pre_ucenter_memberfields VALUES ('203','');
INSERT INTO pre_ucenter_memberfields VALUES ('204','');
INSERT INTO pre_ucenter_memberfields VALUES ('205','');
INSERT INTO pre_ucenter_memberfields VALUES ('206','');
INSERT INTO pre_ucenter_memberfields VALUES ('207','');
INSERT INTO pre_ucenter_memberfields VALUES ('208','');
INSERT INTO pre_ucenter_memberfields VALUES ('209','');
INSERT INTO pre_ucenter_memberfields VALUES ('210','');
INSERT INTO pre_ucenter_memberfields VALUES ('211','');
INSERT INTO pre_ucenter_memberfields VALUES ('212','');
INSERT INTO pre_ucenter_memberfields VALUES ('213','');
INSERT INTO pre_ucenter_memberfields VALUES ('214','');
INSERT INTO pre_ucenter_memberfields VALUES ('215','');
INSERT INTO pre_ucenter_memberfields VALUES ('216','');
INSERT INTO pre_ucenter_memberfields VALUES ('217','');
INSERT INTO pre_ucenter_memberfields VALUES ('218','');
INSERT INTO pre_ucenter_memberfields VALUES ('219','');
INSERT INTO pre_ucenter_memberfields VALUES ('220','');
INSERT INTO pre_ucenter_memberfields VALUES ('221','');
INSERT INTO pre_ucenter_memberfields VALUES ('222','');
INSERT INTO pre_ucenter_memberfields VALUES ('223','');
INSERT INTO pre_ucenter_memberfields VALUES ('224','');
INSERT INTO pre_ucenter_memberfields VALUES ('225','');
INSERT INTO pre_ucenter_memberfields VALUES ('226','');
INSERT INTO pre_ucenter_memberfields VALUES ('227','');
INSERT INTO pre_ucenter_memberfields VALUES ('228','');
INSERT INTO pre_ucenter_memberfields VALUES ('229','');
INSERT INTO pre_ucenter_memberfields VALUES ('230','');
INSERT INTO pre_ucenter_memberfields VALUES ('231','');
INSERT INTO pre_ucenter_memberfields VALUES ('232','');
INSERT INTO pre_ucenter_memberfields VALUES ('233','');
INSERT INTO pre_ucenter_memberfields VALUES ('234','');
INSERT INTO pre_ucenter_memberfields VALUES ('235','');
INSERT INTO pre_ucenter_memberfields VALUES ('236','');
INSERT INTO pre_ucenter_memberfields VALUES ('237','');
INSERT INTO pre_ucenter_memberfields VALUES ('238','');
INSERT INTO pre_ucenter_memberfields VALUES ('239','');
INSERT INTO pre_ucenter_memberfields VALUES ('240','');
INSERT INTO pre_ucenter_memberfields VALUES ('241','');
INSERT INTO pre_ucenter_memberfields VALUES ('242','');
INSERT INTO pre_ucenter_memberfields VALUES ('243','');
INSERT INTO pre_ucenter_memberfields VALUES ('244','');
INSERT INTO pre_ucenter_memberfields VALUES ('245','');
INSERT INTO pre_ucenter_memberfields VALUES ('246','');
INSERT INTO pre_ucenter_memberfields VALUES ('247','');
INSERT INTO pre_ucenter_memberfields VALUES ('248','');
INSERT INTO pre_ucenter_memberfields VALUES ('249','');
INSERT INTO pre_ucenter_memberfields VALUES ('250','');
INSERT INTO pre_ucenter_memberfields VALUES ('251','');
INSERT INTO pre_ucenter_memberfields VALUES ('252','');
INSERT INTO pre_ucenter_memberfields VALUES ('253','');
INSERT INTO pre_ucenter_memberfields VALUES ('254','');
INSERT INTO pre_ucenter_memberfields VALUES ('255','');
INSERT INTO pre_ucenter_memberfields VALUES ('256','');
INSERT INTO pre_ucenter_memberfields VALUES ('257','');
INSERT INTO pre_ucenter_memberfields VALUES ('258','');
INSERT INTO pre_ucenter_memberfields VALUES ('259','');
INSERT INTO pre_ucenter_memberfields VALUES ('260','');
INSERT INTO pre_ucenter_memberfields VALUES ('261','');
INSERT INTO pre_ucenter_memberfields VALUES ('262','');
INSERT INTO pre_ucenter_memberfields VALUES ('263','');
INSERT INTO pre_ucenter_memberfields VALUES ('264','');
INSERT INTO pre_ucenter_memberfields VALUES ('265','');
INSERT INTO pre_ucenter_memberfields VALUES ('266','');
INSERT INTO pre_ucenter_memberfields VALUES ('267','');
INSERT INTO pre_ucenter_memberfields VALUES ('268','');
INSERT INTO pre_ucenter_memberfields VALUES ('269','');
INSERT INTO pre_ucenter_memberfields VALUES ('270','');
INSERT INTO pre_ucenter_memberfields VALUES ('271','');
INSERT INTO pre_ucenter_memberfields VALUES ('272','');
INSERT INTO pre_ucenter_memberfields VALUES ('273','');
INSERT INTO pre_ucenter_memberfields VALUES ('274','');

INSERT INTO pre_ucenter_members VALUES ('1',0x6a6f7974616f62616f,0x3966336438353263346532373530393236316535313163393239663036303933,0x6a6f7974616f62616f40686f746d61696c2e636f6d,'','',0x68696464656e,'1496198369','0','0',0x313862363531,'');
INSERT INTO pre_ucenter_members VALUES ('2',0x6a6f7974616f62616f31,0x3966333231613130363664386138666331306133356666343932376630653130,0x6a6f7974616f62616f403132362e636f6d,'','',0x33392e3130392e3132352e3637,'1496651043','0','0',0x336264356534,'');
INSERT INTO pre_ucenter_members VALUES ('3',0x4d61726961766f696e61,0x6665346135323131306335346130313432323665313664653735383430636134,0x70756e746b6f383040676d61696c2e636f6d,'','',0x3137382e3133372e39322e313239,'1496657435','0','0',0x623738323366,'');
INSERT INTO pre_ucenter_members VALUES ('70',0xb9e2b4e4c8e77274,0x3364323733616236643738393635346437303462373133313764326335363433,0x6a6867716575776f403132362e636f6d,'','',0x3131392e36322e3230342e3739,'1517244913','0','0',0x313664663937,'');
INSERT INTO pre_ucenter_members VALUES ('69',0xbbaab4babdbf786c,0x3263666439326239373062643835323462346233383130633838356434643262,0x6b737a676a677631403132362e636f6d,'','',0x3131392e36322e3230352e3132,'1517220962','0','0',0x323335366262,'');
INSERT INTO pre_ucenter_members VALUES ('68',0x796277686d75696176,0x3733346130656235323137663837356164353239306337353039343632356434,0x6c696d72783333344073696e612e636e,'','',0x3132302e3139342e38302e313530,'1517206021','0','0',0x363234353937,'');
INSERT INTO pre_ucenter_members VALUES ('67',0xe6c2bbd4b6fb7167,0x3365396232356534356132343034623331316630343338393136313131313135,0x306e7075357a7030403132362e636f6d,'','',0x3131392e36322e3230382e323439,'1517195238','0','0',0x363830343730,'');
INSERT INTO pre_ucenter_members VALUES ('66',0xbacdc3f9b0ec6877,0x3034356263653532323436326139656163613530343764346435303832616230,0x757a6731666c6c61403132362e636f6d,'','',0x3131392e36322e3230352e3830,'1517175995','0','0',0x623436333864,'');
INSERT INTO pre_ucenter_members VALUES ('84',0x7869616f68756f6e67353835,0x3231316233653030356264323266656135643731323637386335633337646532,0x67756f7765696e756f343234353334403132362e636f6d,'','',0x3138332e3232372e32352e3736,'1517486327','0','0',0x376264356663,'');
INSERT INTO pre_ucenter_members VALUES ('65',0xcaa5dcddb7e36e72,0x3430626363343537323261643763626230313162333931343638623038333064,0x6a6b783361766b77403132362e636f6d,'','',0x3131392e36322e3230392e3132,'1517158645','0','0',0x353234363733,'');
INSERT INTO pre_ucenter_members VALUES ('83',0xcfd6d4dad5fdd4da383131,0x3939353563303638366534333035663832353761386132396537396632333632,0x6c656966616e6778696538303738303336403136332e636f6d,'','',0x3137312e3231342e3231302e313030,'1517485217','0','0',0x316139646233,'');
INSERT INTO pre_ucenter_members VALUES ('64',0xe1d4b3afceac7564,0x3162643637343131663439316633346333333462323734303337336532343666,0x766e6378776b6e32403132362e636f6d,'','',0x3131392e36322e3230342e3434,'1517139303','0','0',0x376263396432,'');
INSERT INTO pre_ucenter_members VALUES ('63',0xd0c7cab5ccec776b,0x6634303365343334633035333864346439323032303364303961663663346133,0x7673386777396368403132362e636f6d,'','',0x3131392e36322e3230352e3830,'1517119985','0','0',0x313131393638,'');
INSERT INTO pre_ucenter_members VALUES ('62',0x62706b3273646d7766,0x3666666634343761656462326563323335376631656136373264323361663965,0x6b7864707339323932344073696e612e636e,'','',0x3132302e3139342e38302e313530,'1517115180','0','0',0x633862616662,'');
INSERT INTO pre_ucenter_members VALUES ('61',0xb5e4cee4b6ab6f68,0x3765613632656635656334326134663734356636633533666164356665656237,0x3837716973786363403132362e636f6d,'','',0x3131392e36322e3230342e3434,'1517098676','0','0',0x343832373730,'');
INSERT INTO pre_ucenter_members VALUES ('60',0xc0a4b8e7ccda7976,0x3835366537313134336530303832626161376465626566376533396333333131,0x763167767a363162403132362e636f6d,'','',0x3131392e36322e3230342e313438,'1517080026','0','0',0x623064353233,'');
INSERT INTO pre_ucenter_members VALUES ('59',0xe2deb7b2b7c76676,0x3130616562353538393634336130623038626435653765653730323065376432,0x71667433686b616d403132362e636f6d,'','',0x3131392e36322e3230392e323030,'1517060106','0','0',0x613662663661,'');
INSERT INTO pre_ucenter_members VALUES ('58',0x766b6c676b,0x3234653936393336366166313466613634343734336461373963396136616636,0x657431367a6c6463403132362e636f6d,'','',0x3137352e3136342e39332e313532,'1517034003','0','0',0x336264303734,'');
INSERT INTO pre_ucenter_members VALUES ('57',0xd2d2c3d171cea23836343530353835,0x6264386135323764383331316539626266303234633330636333363362313861,0x71713836343530353835403136332e636f6d,'','',0x3132322e3232362e3138352e3730,'1516989923','0','0',0x333239386161,'');
INSERT INTO pre_ucenter_members VALUES ('56',0x6c64727471,0x3761643435373333353235333034356566303461613562363130356636303537,0x7a7272776b796a66403132362e636f6d,'','',0x3131332e3131362e3132302e323230,'1516982883','0','0',0x333166623931,'');
INSERT INTO pre_ucenter_members VALUES ('55',0xbbf0dfd6dfd6c1f8b3f8,0x3837343061616336343464623438396463636264613235623331643661383533,0x7a70736c777a79666e403136332e636f6d,'','',0x3138302e3133382e33302e3738,'1516967297','0','0',0x313835316136,'');
INSERT INTO pre_ucenter_members VALUES ('54',0x6d616e6f71,0x6636373935363037633834373633366265353034623963393934396266343162,0x78696e676c616e343332393940736f68752e636f6d,'','',0x3132312e3232372e38302e313439,'1516964712','0','0',0x386431386234,'');
INSERT INTO pre_ucenter_members VALUES ('78',0x62616979756e35303663,0x3338383538623765636230666230373161313731343865346566333933323265,0x68616e79696e67687569393832363430403132362e636f6d,'','',0x3138332e3232372e32352e3736,'1517446710','0','0',0x363330653564,'');
INSERT INTO pre_ucenter_members VALUES ('77',0xb1f9ecb3b3d06577,0x3932313634376331646337356264326539366463636432663662383836346165,0x7570346b62326d62403132362e636f6d,'','',0x3131392e36322e3230392e323436,'1517434354','0','0',0x326261313061,'');
INSERT INTO pre_ucenter_members VALUES ('76',0xb7a2c6dfece36d74,0x3638333938393462306432633366393235336364666535636466353436386135,0x7a6a753965647778403132362e636f6d,'','',0x3131392e36322e3230382e313033,'1517416770','0','0',0x323431646264,'');
INSERT INTO pre_ucenter_members VALUES ('75',0xd0c2bdaec9e7c7f8b0a26c,0x3032326163636433636433613933386162376630656164663263306461383764,0x7171726f626f7430353433403136332e636f6d,'','',0x3231382e37362e3132322e323338,'1517409351','0','0',0x373639346262,'');
INSERT INTO pre_ucenter_members VALUES ('74',0xcef7b2d8c9fabbeecdf8,0x3339643762313834323866623136613136653539373161633966663037666639,0x7171726f626f7430353635403136332e636f6d,'','',0x3131332e3234352e3136322e3334,'1517403251','0','0',0x333333323563,'');
INSERT INTO pre_ucenter_members VALUES ('73',0x626264396871676a63,0x3536393962623837383730643738346362333230643631316161626436346134,0x6765796771313134344073696e612e636e,'','',0x3132302e3139342e38302e313437,'1517383273','0','0',0x396531636662,'');
INSERT INTO pre_ucenter_members VALUES ('72',0x7575c2dbccb33736,0x3763393439393266386337633335326530343738656138363635623964643164,0x6f7961703432303334403136332e636f6d,'','',0x3132322e3132312e37392e313737,'1517377929','0','0',0x393565366462,'');
INSERT INTO pre_ucenter_members VALUES ('82',0xb1becfe8ceb07370,0x6535633933333230343363303733613164643665396638653961656238303938,0x62687376786d7370403132362e636f6d,'','',0x3131392e36322e3230352e323334,'1517453720','0','0',0x383265373433,'');
INSERT INTO pre_ucenter_members VALUES ('81',0x647467303030303030,0x3236306639626666663731656461353264333635636236363137663039303631,0x727778666b32343435364073696e612e63,'','',0x3132302e3139342e38302e313437,'1517451878','0','0',0x363463376233,'');
INSERT INTO pre_ucenter_members VALUES ('80',0xb7c7d8c5eed5756b,0x3665353932613661376264396631333164376538653665333566373032393663,0x75717a7068316572403132362e636f6d,'','',0x3131392e36322e3230382e323036,'1517450049','0','0',0x313830386238,'');
INSERT INTO pre_ucenter_members VALUES ('79',0xb5eebbddb1fb656d,0x3566393534663538373931633664653237356636633561323462623462653161,0x7877736b6d306d65403132362e636f6d,'','',0x3131392e36322e3230352e313232,'1517448066','0','0',0x323563613832,'');
INSERT INTO pre_ucenter_members VALUES ('88',0x65696c6b6862616265,0x3064356336336239366662306366653836303333656438373865666437663961,0x716c696870393539344073696e612e636e,'','',0x3132302e3139342e38302e313530,'1517815240','0','0',0x386135393466,'');
INSERT INTO pre_ucenter_members VALUES ('53',0x786e7a676d30366962,0x3465613034383636623263323631666163373339353435653631326261353933,0x6c6872787433383337314073696e612e636e,'','',0x3132302e3139342e38302e313531,'1516858117','0','0',0x356561383638,'');
INSERT INTO pre_ucenter_members VALUES ('52',0x6271646975,0x3965613536653833343039343430643036376662333134633931656564653163,0x773464357a7a6a62403132362e636f6d,'','',0x3132352e37392e3134382e3435,'1516737284','0','0',0x346563393263,'');
INSERT INTO pre_ucenter_members VALUES ('51',0x7766666c76,0x3431306534373961613938343162636633626130393634386161353866373038,0x376e643778306869403132362e636f6d,'','',0x3232332e3235352e3132372e3137,'1516696606','0','0',0x656239633931,'');
INSERT INTO pre_ucenter_members VALUES ('71',0xd6c1b6e9c1f9636e,0x3534396364303136643661346435313034306633313831393263346362326465,0x35636869676c7972403132362e636f6d,'','',0x3131392e36322e3230352e3132,'1517262439','0','0',0x376262353333,'');
INSERT INTO pre_ucenter_members VALUES ('49',0x6a6f7974616f62616f34,0x6665323438303436393361383137333864636133653765313530666465333638,0x6a6f7974616f62616f40676d61696c2e636f6d,'','',0x33392e3130392e3132352e3639,'1516612587','0','0',0x623763323536,'');
INSERT INTO pre_ucenter_members VALUES ('48',0x6261746d64,0x3933613030303062343363646463346466656435653063336236383339373535,0x706a766c68756176403132362e636f6d,'','',0x3131332e38382e33362e323233,'1516375174','0','0',0x366439353930,'');
INSERT INTO pre_ucenter_members VALUES ('47',0x6a6f7974616f62616f33,0x3332326662653033373061343966373261323962303834663864383936303531,0x34323234373938374071712e636f6d,'','',0x33392e3130392e3132352e3639,'1516356651','0','0',0x633031326230,'');
INSERT INTO pre_ucenter_members VALUES ('87',0x6767706963,0x6435313563356335323632613265353137613661616435323765353036656633,0x7475696a6965323239363932403136332e636f6d,'','',0x32372e33372e3136372e323236,'1517809134','0','0',0x656263666639,'');
INSERT INTO pre_ucenter_members VALUES ('86',0x6566706271786c7a61,0x3963633939653930346637373337373763656364303366653330303431353161,0x796b6570743539374073696e612e636e,'','',0x3132302e3139342e38302e313536,'1517631351','0','0',0x383037366465,'');
INSERT INTO pre_ucenter_members VALUES ('89',0xcee2e8f7c1ab72766d,0x3732353663313232613139373135626135306238613662616436616166623266,0x67616e6767616e6778753135343331403136332e636f6d,'','',0x3138322e3135302e3133352e3631,'1517853309','0','0',0x643163373835,'');
INSERT INTO pre_ucenter_members VALUES ('85',0x6b6a6665323735,0x6434313338373163346237316434616665653637623637386230366636663761,0x6368656e6269796974616e403136332e636f6d,'','',0x3137312e3231342e3231302e313030,'1517584691','0','0',0x333566616536,'');
INSERT INTO pre_ucenter_members VALUES ('46',0x6a6f7974616f62616f32,0x3862653330313831376230613438393335663137303436396430336663643633,0x7a68616f797537406a642e636f6d,'','',0x33392e3130392e3132352e3638,'1516168998','0','0',0x363363386330,'');
INSERT INTO pre_ucenter_members VALUES ('90',0xbadac1fabdadc2dbccb3,0x3433633232373666386231633763386565623137313666663863316331336564,0x7171726f626f74303533403136332e636f6d,'','',0x3131382e3235332e3235352e313239,'1517890178','0','0',0x323536653461,'');
INSERT INTO pre_ucenter_members VALUES ('91',0x696961713972716636,0x3334396430356164363439353864326536616533386266616561396136666132,0x6c6375666c3934394073696e612e636e,'','',0x3132302e3139342e38302e313438,'1517974902','0','0',0x373330373263,'');
INSERT INTO pre_ucenter_members VALUES ('92',0x616a666a6e38617730,0x3338633761323935313262303932663864663566313666616435666663616637,0x6370666f76343339344073696e612e636e,'','',0x3132302e3139342e38302e313438,'1518066056','0','0',0x383466383430,'');
INSERT INTO pre_ucenter_members VALUES ('93',0x636f79303030303030,0x3336616439616136633939663662353232666265336662346530306236313731,0x627274646f39383334354073696e612e636e,'','',0x3132302e3139342e38302e313530,'1518235167','0','0',0x303139626531,'');
INSERT INTO pre_ucenter_members VALUES ('94',0xd3d7d3d76c756f6c6935,0x3736663365373739383465333436336135333439386531613465336135663462,0x6f7777733630303434403136332e636f6d,'','',0x33362e3233362e3131382e323337,'1518481764','0','0',0x343362663830,'');
INSERT INTO pre_ucenter_members VALUES ('95',0x6870657476626c6e73,0x3962336439363235656239393762373361346266623565346333323832633731,0x656a6c6c6a3439374073696e612e636e,'','',0x3132302e3139342e38302e313530,'1518554453','0','0',0x353232613434,'');
INSERT INTO pre_ucenter_members VALUES ('96',0xd3d7d3d76a6c623134,0x3231663037366336353138663739666332643136363138623636666234303961,0x6a756a697535353466656e6b65403136332e636f6d,'','',0x3132322e3132312e35392e313130,'1518705562','0','0',0x613661653138,'');
INSERT INTO pre_ucenter_members VALUES ('97',0x6a69647574,0x3762613462656530346332393337663438346136383230346563633463373366,0x3931333631333436324071712e636f6d,'','',0x3132322e3232362e3138332e3834,'1519312889','0','0',0x393462373064,'');
INSERT INTO pre_ucenter_members VALUES ('98',0xc7e0baa3c9fabbeecdf8,0x3364346639616231653937363033376562396366396338313366646636316630,0x7171726f626f74303232403136332e636f6d,'','',0x3131332e3234352e3235332e313930,'1519372584','0','0',0x383132316162,'');
INSERT INTO pre_ucenter_members VALUES ('99',0x666864713134666975,0x6366663032393837653566613437663366626262633532326539363262623037,0x6b6f716561373935354073696e612e636e,'','',0x3132302e3139342e38302e313530,'1519397717','0','0',0x353333633061,'');
INSERT INTO pre_ucenter_members VALUES ('100',0xc7e0baa3c2dbccb366,0x3237353937366232336630626339623166646465393436666139616536333662,0x7171726f626f74303036403136332e636f6d,'','',0x3131382e3235332e37362e3237,'1519401081','0','0',0x393662313037,'');
INSERT INTO pre_ucenter_members VALUES ('101',0x757561b5dac8fdb9fabcca,0x3365313736343461653661366535626436386565383039383832613037646466,0x7969343238333234323839313138403136332e636f6d,'','',0x3137312e3232312e3132382e313334,'1519446901','0','0',0x356563643238,'');
INSERT INTO pre_ucenter_members VALUES ('102',0x6169786a7a,0x6130613736396534643162333263623030316563613865313337613165303035,0x3138383235323730383938403136332e636f6d,'','',0x3131332e38352e32392e3534,'1519447484','0','0',0x636163633034,'');
INSERT INTO pre_ucenter_members VALUES ('103',0x69bbcabcd2bcabc6b7c3a8,0x3366383565323437323933383761333364303365383862636539316536326563,0x373036313439323837354071712e636f6d,'','',0x3131342e3235332e3230322e3534,'1519729046','0','0',0x366364623135,'');
INSERT INTO pre_ucenter_members VALUES ('104',0x6d67cbb9cdfeb6fb,0x3932363832633637343466633661356336373835353633363463346162356164,0x333531373236333331334071712e636f6d,'','',0x3131342e3235332e3230322e3534,'1519767609','0','0',0x613066373061,'');
INSERT INTO pre_ucenter_members VALUES ('105',0xd7dfc4cfb4b331353534,0x3037613533616262653539333462353737636432326632303631383062386337,0x333539333939313739314071712e636f6d,'','',0x3131342e3235332e3230322e3534,'1519824004','0','0',0x346630626361,'');
INSERT INTO pre_ucenter_members VALUES ('106',0xc8d5b1beb5d8d5f0b8dfd0cb,0x6563643761623166313633316430396635623761363037613035653163373138,0x363131343932303133344071712e636f6d,'','',0x3131342e3235332e3230322e3534,'1519899761','0','0',0x313531366137,'');
INSERT INTO pre_ucenter_members VALUES ('107',0xd0c7d4c2f0a8bde06439,0x6231316164333664346664393532613539663461353535343865313164306433,0x373531333330313138364071712e636f6d,'','',0x3131342e3235332e3230322e3534,'1519936448','0','0',0x303634363336,'');
INSERT INTO pre_ucenter_members VALUES ('108',0xe5b0d0f9bed3bcd2bedf30,0x3638373439393861303039333939666532396231633539663862623431376635,0x64656c756e30403136332e636f6d,'','',0x3137312e3231342e3231302e313935,'1520005247','0','0',0x666166656634,'');
INSERT INTO pre_ucenter_members VALUES ('109',0x7962696c6d,0x3630363461626361376166303663653065633666323665656637663639626530,0x7368616e7a68697169656b7569626140736f68752e636f6d,'','',0x3131342e3231362e35352e3337,'1520161488','0','0',0x303836643938,'');
INSERT INTO pre_ucenter_members VALUES ('110',0xc0b66f71617163,0x3464333837393731653939633135396230643566646333633737306236353430,0x7062696d363539313430403132362e636f6d,'','',0x3232332e37342e32362e3338,'1520374597','0','0',0x356463323735,'');
INSERT INTO pre_ucenter_members VALUES ('111',0xb3c2b4cac0c4b5f773,0x6332383238333934323161326533626535366164663333616664623131666537,0x7a3933353635316c403136332e636f6d,'','',0x3131342e3235322e3133322e3836,'1520772029','0','0',0x643561623661,'');
INSERT INTO pre_ucenter_members VALUES ('112',0x7779786878,0x3833663035643833333133343934643433303331336163376632323063303037,0x757a34687a736279403132362e636f6d,'','',0x3137312e3131352e3135312e3137,'1520788381','0','0',0x643235383539,'');
INSERT INTO pre_ucenter_members VALUES ('113',0x6a79637470,0x6564376662316337626539313632326165373862656466653037666537363335,0x726468763632403136332e636f6d,'','',0x3131332e3133332e37362e313438,'1520853749','0','0',0x353330333663,'');
INSERT INTO pre_ucenter_members VALUES ('114',0xdfcfdfcfc3c3d7d33436,0x3333353661353765616662376134306433376466306565323066333937346435,0x66656e686569303464696d75403136332e636f6d,'','',0x3132322e3132312e37372e3235,'1520891586','0','0',0x323863306439,'');
INSERT INTO pre_ucenter_members VALUES ('115',0x7575c2dbccb33031,0x6334663266623831343762316561623331613030623534316466336238303532,0x6c61696c696e323963616967656e6735403136332e636f6d,'','',0x3132322e3132312e37372e3235,'1521002814','0','0',0x663130316339,'');
INSERT INTO pre_ucenter_members VALUES ('116',0x7978746e63,0x3233616439626563323366383564663865613564633565366431616439623264,0x67686f73746c71323438403136332e636f6d,'','',0x3232332e37332e3137372e3132,'1521054269','0','0',0x646566333462,'');
INSERT INTO pre_ucenter_members VALUES ('117',0xced2c3c7b6bcd2bbd1f9,0x6337326138353632323637653861626635653133363734613539336433643464,0x666a6b737869706565403136332e636f6d,'','',0x3232322e3231372e3134332e313032,'1521263505','0','0',0x323139616639,'');
INSERT INTO pre_ucenter_members VALUES ('118',0x6f6a786265,0x3664663834643535326661383661613434353633663837613063623864633432,0x3933393431323038324071712e636f6d,'','',0x3131322e3131322e3131312e313930,'1521320853','0','0',0x353831336331,'');
INSERT INTO pre_ucenter_members VALUES ('119',0x6566647778,0x3939323236383736666639326138363561663038316562376238306562666333,0x3267676268747771403132362e636f6d,'','',0x3138302e3130372e33352e313739,'1521697728','0','0',0x306161626532,'');
INSERT INTO pre_ucenter_members VALUES ('120',0xcde6c0d6c3c3d7d33134,0x3662363533663764343666363632656637663737396163363762303337643330,0x6b7a6f72303235303631403136332e636f6d,'','',0x33362e3233392e31372e3534,'1521798363','0','0',0x623361363762,'');
INSERT INTO pre_ucenter_members VALUES ('121',0xbce6d6b0c3c3d7d33734,0x3564393562663033613763653836646634313864613233386530373935356335,0x6d656e7a653031387369626931403136332e636f6d,'','',0x3132322e3132312e37342e3838,'1521975494','0','0',0x363834353939,'');
INSERT INTO pre_ucenter_members VALUES ('122',0xdfcfdfcfd7cad4b43631,0x3733353634346239646236383338633638333064666463623939653864396632,0x6d75796f6e67393674756b616e33403136332e636f6d,'','',0x3132322e3132312e37342e3838,'1522040684','0','0',0x636631626462,'');
INSERT INTO pre_ucenter_members VALUES ('123',0xc5b7c3c0d3d7d3d73337,0x3937613931663764373461623638313539386365356562386230646366626238,0x6f6f747965303332383033403136332e636f6d,'','',0x3131312e3235352e3132312e313232,'1522283443','0','0',0x343039353665,'');
INSERT INTO pre_ucenter_members VALUES ('124',0x75752d7669702e636f6d,0x6334373434623962646261653438613335303563663066643566326361393033,0x6f62627532313637353432403136332e636f6d,'','',0x3131312e3235352e3132312e313232,'1522404736','0','0',0x303532356366,'');
INSERT INTO pre_ucenter_members VALUES ('125',0x756a6f707a,0x6333363639303033336363393832323131353966326134333435383763616535,0x713274616b377237403132362e636f6d,'','',0x3138302e3130372e33332e313437,'1522557804','0','0',0x633435353062,'');
INSERT INTO pre_ucenter_members VALUES ('126',0x67796c6a6e,0x6635383861616161633539336665633135386533313564663531383665383736,0x72343269786c346f403132362e636f6d,'','',0x3132312e3233362e37382e313334,'1522769677','0','0',0x643937626435,'');
INSERT INTO pre_ucenter_members VALUES ('127',0x6a6f7974616f62616f35,0x3961383561343563623661616561663635633634323964303261653662653437,0x3530353236373037324071712e636f6d,'','',0x3130332e36392e3131382e313431,'1524626679','0','0',0x376239303365,'');
INSERT INTO pre_ucenter_members VALUES ('128',0x6e78686176,0x6466646463393534643739373863333333303730653832353262633737303132,0x333430313832353036314071712e636f6d,'','',0x3232332e37342e32362e323430,'1524702293','0','0',0x356431613661,'');
INSERT INTO pre_ucenter_members VALUES ('129',0x6c6d66616f,0x3433646235326331363466643634386266343365356361643637376665336538,0x7468676f3836403136332e636f6d,'','',0x3131332e3134312e32302e323231,'1524908668','0','0',0x643130303364,'');
INSERT INTO pre_ucenter_members VALUES ('130',0x696c706e6b,0x6163363963646637326231383534636438613839353961396135613732366434,0x7a7979653837403136332e636f6d,'','',0x3131332e3134312e32302e323231,'1524946195','0','0',0x333838333931,'');
INSERT INTO pre_ucenter_members VALUES ('131',0x6e6b6b6a76,0x3638343635323139373162313938626431306538653165373033346138623531,0x756277723934403136332e636f6d,'','',0x3131332e3134312e32302e323231,'1524988910','0','0',0x653534316166,'');
INSERT INTO pre_ucenter_members VALUES ('132',0xd0a1b3c7cad0b4f3bba8d4b0,0x3362343832613238656639303531653533303631396262393132643261393331,0x6a66786a6f756e6669403136332e636f6d,'','',0x3232332e37342e32362e313836,'1525286755','0','0',0x333833626536,'');
INSERT INTO pre_ucenter_members VALUES ('133',0xd6b1b9c8cfc97679,0x3564353663613661643566663262656264633231653739663036323735666331,0x6b33687671646d636b6f6273403132362e636f6d,'','',0x3232322e3134302e38362e323235,'1525329634','0','0',0x326334343162,'');
INSERT INTO pre_ucenter_members VALUES ('134',0xb4bacfe9b5db6c71,0x6339323436326365323035666538353261376562303962643833373338346436,0x737964706a37766e616e6363403136332e636f6d,'','',0x3232322e3134302e38342e313630,'1525333268','0','0',0x343562306332,'');
INSERT INTO pre_ucenter_members VALUES ('135',0xbefdb8b6d2e57636,0x6532336362656161643339373434343336626336613137666638653239643131,0x6b617a366d71647174667076403136332e636f6d,'','',0x3232322e3134302e38342e323337,'1525334860','0','0',0x633135616138,'');
INSERT INTO pre_ucenter_members VALUES ('136',0xb2fdbda8b4d26265,0x3637616232313861353961363264633061653832383637353038636364636335,0x6566616b33737968396f7576403136332e636f6d,'','',0x3232322e3134302e38352e3834,'1525335383','0','0',0x376132653738,'');
INSERT INTO pre_ucenter_members VALUES ('137',0xb0b8b9abbfad316d,0x3865363639663163383938643664646334326238323466613066393439383937,0x746438736c6c6c6936767468403132362e636f6d,'','',0x3232322e3134302e38352e313632,'1525335636','0','0',0x343564346139,'');
INSERT INTO pre_ucenter_members VALUES ('138',0xe8afc3c3b0d83666,0x3365336164386666343362326334396532393631633237363032653734366537,0x743377333373346b3471757a403136332e636f6d,'','',0x3232322e3134302e38362e313436,'1525547816','0','0',0x383238366533,'');
INSERT INTO pre_ucenter_members VALUES ('139',0xb3acc6d5cebf7732,0x3163643830383939323265626662616239653333653963636130613933313536,0x72676a38386b68767a6e6434403136332e636f6d,'','',0x3232322e3134302e38372e3236,'1525549156','0','0',0x343764653536,'');
INSERT INTO pre_ucenter_members VALUES ('140',0xc8d8b7d2c1d67a74,0x6264383232663131653638653533623636656433623937663661656535343639,0x727333346c30716b77726e63403136332e636f6d,'','',0x3232322e3134302e38342e313539,'1525550761','0','0',0x393662646163,'');
INSERT INTO pre_ucenter_members VALUES ('141',0xc8f0b0a3b8b66879,0x3638336132363362376631326362366664373836316338643330663131393739,0x686c726e30666d7237626b69403136332e636f6d,'','',0x3232322e3134302e38362e313133,'1525552537','0','0',0x393430653161,'');
INSERT INTO pre_ucenter_members VALUES ('142',0xc7d9e6c3b1a6716c,0x6635363839343639353934633736363331636434643737613638623461613431,0x316a63307278786873727932403132362e636f6d,'','',0x3232322e3134302e38342e3233,'1525556030','0','0',0x653530373963,'');
INSERT INTO pre_ucenter_members VALUES ('143',0x6569707475,0x3538633461633863363864326463613739376365396163373839653030663636,0x6b336566696d7176403132362e636f6d,'','',0x31342e3132302e39302e313534,'1525622445','0','0',0x643332386539,'');
INSERT INTO pre_ucenter_members VALUES ('144',0x7a74616662,0x3961386136396164636332633038373138616636656661616562613530636532,0x65626f69666d3233403132362e636f6d,'','',0x3132312e3233362e37392e3932,'1525645768','0','0',0x386561626266,'');
INSERT INTO pre_ucenter_members VALUES ('145',0xb6acb3ac,0x3130343531376663353532346566613561363630636633343031363965333835,0x776f6a69616f6c69756c61697169616e403136332e636f6d,'','',0x3132332e3138352e3132312e3338,'1525696903','0','0',0x376163306662,'');
INSERT INTO pre_ucenter_members VALUES ('146',0x7278786266,0x3136646335663533356263303935653832373836373939616466373538376432,0x7270306b6f636161403132362e636f6d,'','',0x31342e3132302e38392e323131,'1525761950','0','0',0x656563376335,'');
INSERT INTO pre_ucenter_members VALUES ('147',0xd5c5cec0bda16f,0x6634353935343834306662316461353035313232313332306634363933383565,0x6d31353536373737303534345f31403136332e636f6d,'','',0x3130312e37382e3234322e313434,'1525773207','0','0',0x373930336430,'');
INSERT INTO pre_ucenter_members VALUES ('148',0x6e69ceb4c0b4ced2c0b4,0x3133393661386332356166313339376662363331343338666164306531313465,0x69736b76706c66737266716338343036403136332e636f6d,'','',0x3232332e37342e32362e3134,'1525823360','0','0',0x303263393734,'');
INSERT INTO pre_ucenter_members VALUES ('149',0x7576617975,0x6239616664616639646266303564326538633136633831323963363661313538,0x62737162746d3367403132362e636f6d,'','',0x3131302e39312e3139352e313536,'1525849742','0','0',0x656333623139,'');
INSERT INTO pre_ucenter_members VALUES ('150',0x706575756b,0x6161626633646131666333626663613061326230663438373235663533393736,0x366d677674677471403132362e636f6d,'','',0x3137352e3136382e38362e323534,'1525867101','0','0',0x646132373230,'');
INSERT INTO pre_ucenter_members VALUES ('151',0xc3c3d7d3b2bbb4ed3234,0x3962343139343730623063626434623632336631326532653630646636393461,0x6e65696a6939393174616f68616e403136332e636f6d,'','',0x3231382e3137332e3137302e323335,'1525867176','0','0',0x383261663231,'');
INSERT INTO pre_ucenter_members VALUES ('152',0x63386d6b74357676,0x6561363630646463303562323430373437653061346565336265376164353666,0x6c6974696e6774696e67333232403132362e636f6d,'','',0x3132352e34362e3138392e3838,'1525938428','0','0',0x636138343732,'');
INSERT INTO pre_ucenter_members VALUES ('153',0x6338747273376761,0x3632373433353135343735343163616631376331666366633432316238663234,0x6c6966656e676a75616e636a403132362e636f6d,'','',0x3232312e31352e3134302e313838,'1526021897','0','0',0x396566616338,'');
INSERT INTO pre_ucenter_members VALUES ('154',0xbefdb6fbd7c17666,0x6465656462663234343839353732333066366466636130313837633433376130,0x33626361756c6d626e326f66403132362e636f6d,'','',0x3232322e3134302e38342e35,'1526075934','0','0',0x663063353762,'');
INSERT INTO pre_ucenter_members VALUES ('155',0xeac6c3f7b1f26d7a,0x6534383063383237663632626635623362356631626432303239343037643439,0x613965707765396f69703175403136332e636f6d,'','',0x3232322e3134302e38342e313133,'1526081049','0','0',0x393961353065,'');
INSERT INTO pre_ucenter_members VALUES ('156',0xb5cfc4e1b1df6461,0x6562373363356137623435323465366466656638663733643030646462653239,0x776f6f73356268746b6b6936403132362e636f6d,'','',0x3232322e3134302e38352e323231,'1526082809','0','0',0x393863313965,'');
INSERT INTO pre_ucenter_members VALUES ('157',0xb3cedeb8b6cb6876,0x6331366230313236383766376538313337303631366232386630333166636439,0x33776177746a726479327275403136332e636f6d,'','',0x3232322e3134302e38342e3836,'1526087982','0','0',0x653962306564,'');
INSERT INTO pre_ucenter_members VALUES ('158',0xb4a8c8ddb9a2cda9,0x6164623139396535626336353661333332386238653135303962646666646465,0x696165666e7175797132343839363430403136332e636f6d,'','',0x3232332e37342e32362e37,'1526090144','0','0',0x303863396130,'');
INSERT INTO pre_ucenter_members VALUES ('159',0xdfcfdfcfd7cad4b43533,0x3239663938343437643732653536343066636537636238663561323338356136,0x6c753232373531373339353137726463403136332e636f6d,'','',0x3132322e3132312e36302e323239,'1526133734','0','0',0x366562386263,'');
INSERT INTO pre_ucenter_members VALUES ('160',0x636662716177,0x6430363661636235386464393736613736356262333834326465353937363039,0x69743933363738403132362e636f6d,'','',0x3132332e3135372e3233372e3938,'1526161581','0','0',0x643665376434,'');
INSERT INTO pre_ucenter_members VALUES ('161',0x676a736179,0x3634623562613565363238393963303463666135333862323166346365396566,0x766a39373038343935796f6e677961403136332e636f6d,'','',0x3131362e31362e3132382e3935,'1526174147','0','0',0x336461333635,'');
INSERT INTO pre_ucenter_members VALUES ('162',0xc9e1c9fac8a1d2e5,0x3162306136386236353163363437656534316332323763643736643333343130,0x78333136333130333730306e75403136332e636f6d,'','',0x3131342e3235322e3135362e323431,'1526202226','0','0',0x333037643235,'');
INSERT INTO pre_ucenter_members VALUES ('163',0x6577316131,0x6137396265356631383562376664326335613261616431306561663065366563,0x3934313733363836403136332e636f6d,'','',0x34392e37372e3136332e323135,'1526235478','0','0',0x363863643739,'');
INSERT INTO pre_ucenter_members VALUES ('164',0x713674627038786f,0x3335396432336236666532656562663237323866663238353031333235346239,0x6c6937303134687561403132362e636f6d,'','',0x3132352e34312e39312e313733,'1526282902','0','0',0x363539626537,'');
INSERT INTO pre_ucenter_members VALUES ('165',0xd2bbbed9c1bdb5c3,0x6365313737626264636130373133396238303737396234386132366238333331,0x79616e6b6f6e673639323437383638403136332e636f6d,'','',0x3131342e3234392e33322e313337,'1526292899','0','0',0x336266653038,'');
INSERT INTO pre_ucenter_members VALUES ('166',0xceb4b6febbe1d1ef,0x3232633237613064343961393338653635306433643662353836373766646635,0x6b74636279757874756d72363238403136332e636f6d,'','',0x3131362e31362e3133302e3334,'1526298229','0','0',0x356232623466,'');
INSERT INTO pre_ucenter_members VALUES ('167',0xc3c3d7d3b2bbb4ed3532,0x6531353234373531363634346638383836393639613163373632363938383061,0x6e7672736e333935353137403136332e636f6d,'','',0x3132322e3132312e36302e323239,'1526299142','0','0',0x366137633264,'');
INSERT INTO pre_ucenter_members VALUES ('168',0xd4c0cae7c4dd333436,0x3862356665336263393730623231626632323431393661653830656438323334,0x6134353132313933615f32403136332e636f6d,'','',0x36312e3232312e37352e323032,'1526303281','0','0',0x323032386565,'');
INSERT INTO pre_ucenter_members VALUES ('169',0xb2a9bbc0d3a1,0x6162373533353039383339393331386532396333346631613662346266333865,0x3936343739393232403136332e636f6d,'','',0x34392e37372e3136332e323135,'1526312245','0','0',0x353263346462,'');
INSERT INTO pre_ucenter_members VALUES ('170',0xd2bbb5bdb0e9,0x6534633665343661373037353765396236323831346330646566666165666663,0x736869313431363131323672403136332e636f6d,'','',0x3131342e3234392e33322e313337,'1526344213','0','0',0x353536303262,'');
INSERT INTO pre_ucenter_members VALUES ('171',0xb7efecb3b7a264,0x3837666432336261656263346264613032653165376139666534656364356533,0x3135353234373138403136332e636f6d,'','',0x34392e37372e3136332e323135,'1526348714','0','0',0x613736613539,'');
INSERT INTO pre_ucenter_members VALUES ('172',0xb2c5d3c2b7e936,0x3562383232376264393965613037633031366530623939376261353434653563,0x3031353433363538403132362e636f6d,'','',0x3131342e3232322e3137382e3538,'1526373016','0','0',0x383434623237,'');
INSERT INTO pre_ucenter_members VALUES ('173',0xc5b7c3c0d3d7d3d73631,0x3563343962336230383130333762353764366631316135323738386334623662,0x6d65697a68616f3331346475676f6e67403136332e636f6d,'','',0x33362e3233392e31382e313534,'1526400650','0','0',0x613830393031,'');
INSERT INTO pre_ucenter_members VALUES ('174',0xc1a6cdecbff1c0bd,0x3733396435353463633832666564613234303535343537323336376231313932,0x6875616e67616e3139343231323773403136332e636f6d,'','',0x3131342e3234392e33322e313337,'1526409139','0','0',0x333864663764,'');
INSERT INTO pre_ucenter_members VALUES ('175',0xe7f7b1fb,0x3631353532363435383233663762663761383232343639323736343562363734,0x6c61697169616e776f736869403136332e636f6d,'','',0x3132332e3138352e3132302e313738,'1526494428','0','0',0x636130383937,'');
INSERT INTO pre_ucenter_members VALUES ('176',0xc4fecfc4c9e7c7f8,0x3937383061363333623963623961613138623062313839636261313730623966,0x7171726f626f74303237403136332e636f6d,'','',0x3232332e3134392e3232312e313832,'1526532406','0','0',0x366533303533,'');
INSERT INTO pre_ucenter_members VALUES ('177',0xd5f1b6ab,0x3763613137663030636461376632646439393537623736343964646638323361,0x7169616e6c61696c65776f736869403136332e636f6d,'','',0x3132332e3138352e3132302e313738,'1526547069','0','0',0x646266623930,'');
INSERT INTO pre_ucenter_members VALUES ('178',0x6f77377865,0x3164323065353936333963613331663730336131646233343237396365613433,0x3336373937333634403132362e636f6d,'','',0x3132312e3233372e3234302e313232,'1526569355','0','0',0x623134303139,'');
INSERT INTO pre_ucenter_members VALUES ('179',0xb2e9c2deb3db,0x3334316463373661356566396337613865346166653232316534396139386566,0x3139373434353537403132362e636f6d,'','',0x3138302e3131302e34382e313732,'1526581357','0','0',0x643238666136,'');
INSERT INTO pre_ucenter_members VALUES ('180',0xb3cec0a4b3d036,0x3034363239623731663835616631666231663836356536303162636130363439,0x3635303332383839403132362e636f6d,'','',0x3138302e3131302e35302e3639,'1526589282','0','0',0x323263343766,'');
INSERT INTO pre_ucenter_members VALUES ('181',0xb1eac8aad2af6b,0x3362383163346237336435633232323561333937613737353165633261646561,0x3533363232393833403136332e636f6d,'','',0x3131342e3232322e3137362e313535,'1526593246','0','0',0x656231656232,'');
INSERT INTO pre_ucenter_members VALUES ('182',0xb0a2e8a4b5c735,0x3630336163353039343234336339396664656132373739313937376631663366,0x3038353132313935403132362e636f6d,'','',0x3138302e3131302e34392e36,'1526597211','0','0',0x626234333038,'');
INSERT INTO pre_ucenter_members VALUES ('183',0x6964387169,0x3135316636363831313531303938336235366664346163393362343332343765,0x3233313533363137403132362e636f6d,'','',0x3132312e3233372e3234312e3337,'1526601133','0','0',0x646132386138,'');
INSERT INTO pre_ucenter_members VALUES ('184',0x737265786e6169,0x3739613163373738663064303361353731363136633562646232383138396166,0x6463726a7179796c403132362e636f6d,'','',0x34392e37372e3231372e3837,'1526629627','0','0',0x623239313763,'');
INSERT INTO pre_ucenter_members VALUES ('185',0xb4d4cbb4dded6e,0x6536316436393933333866633932313732343565636165383538636339386437,0x3837363034333738403136332e636f6d,'','',0x3132312e3233372e3234312e3337,'1526653536','0','0',0x303434383131,'');
INSERT INTO pre_ucenter_members VALUES ('186',0x6a74357570,0x3364346163613436636363316265626531663162333761636130303436366636,0x3034333235383232403136332e636f6d,'','',0x34392e37372e3136302e313933,'1526657606','0','0',0x366263653161,'');
INSERT INTO pre_ucenter_members VALUES ('187',0xb7c9bae2b2fd,0x3832373834663439636566363035363565663762666364633066306664616535,0x3330363133333330403136332e636f6d,'','',0x3132312e3233372e3234332e313935,'1526661637','0','0',0x353733353832,'');
INSERT INTO pre_ucenter_members VALUES ('188',0xb0d9c6e4b4ab66,0x3830323237386666306437616132366532386635373038386362623765303530,0x3335323733303135403136332e636f6d,'','',0x34392e37372e3136332e33,'1526665640','0','0',0x386465623838,'');
INSERT INTO pre_ucenter_members VALUES ('189',0x6d68797a77,0x6433383566653139383938633964653161656265633036626436396163643466,0x616263403136332e636f6d,'','',0x3138332e34332e3130342e3239,'1526756744','0','0',0x383565613733,'');
INSERT INTO pre_ucenter_members VALUES ('190',0xb2aec6bdb1fe66,0x3730646635656130633031666636666132356637323232383731333934323264,0x3738313538303732403132362e636f6d,'','',0x3131342e3232322e3137372e323031,'1526872273','0','0',0x316539363639,'');
INSERT INTO pre_ucenter_members VALUES ('191',0xb1a8ccecc1d664,0x6366366464303436613033323062396530313237643239383234373534653439,0x3431393536313634403136332e636f6d,'','',0x3138302e3131302e34392e3939,'1526876337','0','0',0x313535393937,'');
INSERT INTO pre_ucenter_members VALUES ('192',0xb3b1d3bfb7ef76,0x6164323866316433353163613866333139313137303730303430366364356631,0x3333363939333836403132362e636f6d,'','',0x3132312e3233372e3234322e3639,'1526880502','0','0',0x366537326634,'');
INSERT INTO pre_ucenter_members VALUES ('193',0x616573686a,0x6435303730333833636664303739636239353230613535353766326563666136,0x37616e6865756467403132362e636f6d,'','',0x3131302e39312e3230382e3631,'1526880558','0','0',0x653239363037,'');
INSERT INTO pre_ucenter_members VALUES ('194',0xe9f3b1f5b3b5,0x3161396636386535623438366333383333653466626237666232366661336533,0x3137363734353737403136332e636f6d,'','',0x34392e37372e3136312e3733,'1526884556','0','0',0x633764653035,'');
INSERT INTO pre_ucenter_members VALUES ('195',0xe2f99792b1f36b,0x6338393531346630343334303130646566613834666238326661616131613137,0x3238373537363038403132362e636f6d,'','',0x3132312e3233372e3234332e323139,'1526888649','0','0',0x396238663934,'');
INSERT INTO pre_ucenter_members VALUES ('196',0x726d36706b,0x6335623961323632303837663162346232393432303766393563323932633964,0x3132383136353036403132362e636f6d,'','',0x34392e37372e3136302e323531,'1526892742','0','0',0x363733376535,'');
INSERT INTO pre_ucenter_members VALUES ('197',0x626579616b3737,0x3139363330393630373665373535656231633933643332396131633238316630,0x61736438363736323636403136332e636f6d,'','',0x3130332e3231342e3135312e313535,'1526948046','0','0',0x656232663066,'');
INSERT INTO pre_ucenter_members VALUES ('198',0xcfb2b6abd6de,0x3663643133633866373264333735323764616262316539363635346539383063,0x3134383830303534403136332e636f6d,'','',0x3131342e3232322e3137382e3239,'1526981451','0','0',0x623539333662,'');
INSERT INTO pre_ucenter_members VALUES ('199',0xc8cbb4cfbda163,0x6561313236636266383466333933623937333036383766616361383066373639,0x3335353630323935403136332e636f6d,'','',0x34392e37372e3136312e313532,'1527006624','0','0',0x303432373938,'');
INSERT INTO pre_ucenter_members VALUES ('200',0x766935646d,0x3966613432393564666634663166373937653233313661653137386530626231,0x3139323031393939403136332e636f6d,'','',0x3138302e3131302e34392e3936,'1527010656','0','0',0x306534393334,'');
INSERT INTO pre_ucenter_members VALUES ('201',0x6167356176,0x6331356136653562316233626665623266663333383564663339376338363632,0x3033323132333737403136332e636f6d,'','',0x3131342e3232322e3137372e323333,'1527022616','0','0',0x383332633662,'');
INSERT INTO pre_ucenter_members VALUES ('202',0xb1a6c9bab4fa,0x3061386530333238613732363234393531353461333765343530333537626530,0x3739383339303133403132362e636f6d,'','',0x3138302e3131302e35312e38,'1527026589','0','0',0x643535663536,'');
INSERT INTO pre_ucenter_members VALUES ('203',0xb9e2c5e6bdf06d,0x3339306432376166346662306432306235656230383461343838363932616331,0x3232383930363834403136332e636f6d,'','',0x3138302e3131302e35312e3233,'1527045743','0','0',0x663966656563,'');
INSERT INTO pre_ucenter_members VALUES ('204',0xe6e8cfe8b5fb,0x3836666334616137376232663966626563343936653037396566386139376134,0x3834383030353338403132362e636f6d,'','',0x3138302e3131302e34392e313736,'1527053598','0','0',0x656531353064,'');
INSERT INTO pre_ucenter_members VALUES ('205',0xb0b2c4cf,0x3934343339303734386130623537313861666536383934643636623934396338,0x776f7368696c61697169616e77616e67403136332e636f6d,'','',0x3132332e3138352e3132312e313332,'1527054530','0','0',0x326536303337,'');
INSERT INTO pre_ucenter_members VALUES ('206',0xb8a3c3b7b3a4,0x3735306531393232623262326465626364383931313038313964353464373532,0x3030363034303033403132362e636f6d,'','',0x3132312e3233372e3234322e3437,'1527057518','0','0',0x656538393164,'');
INSERT INTO pre_ucenter_members VALUES ('207',0x6c77336365,0x3338643964646539656164373464663732306132353866653630643264626130,0x3638343231383731403136332e636f6d,'','',0x3132312e3233372e3234332e323234,'1527065375','0','0',0x666334613963,'');
INSERT INTO pre_ucenter_members VALUES ('208',0x617a6d6677,0x3239356664333938613263613033373163363061636663396239386364373930,0x736a6a6f62727861403132362e636f6d,'','',0x3131302e39312e3139352e3436,'1527080752','0','0',0x303165313263,'');
INSERT INTO pre_ucenter_members VALUES ('209',0x7871687568,0x6161666337356137353135636261626430356265626637373935323030323066,0x6e7939343330333233356e756f66656e403136332e636f6d,'','',0x3232332e37332e3137372e323533,'1527138989','0','0',0x646432393364,'');
INSERT INTO pre_ucenter_members VALUES ('210',0xb0b5d0c7cbae,0x3830616238636230363834383263653665613732656362626239336665613231,0x3433363530333835403132362e636f6d,'','',0x3132312e3233372e3234332e323234,'1527154284','0','0',0x633935616663,'');
INSERT INTO pre_ucenter_members VALUES ('211',0xb7e7b5bac2c9,0x3933656530613632333334636133303133333661306635323137346566643238,0x3431313232303931403132362e636f6d,'','',0x34392e37372e3136302e3936,'1527158193','0','0',0x316534623564,'');
INSERT INTO pre_ucenter_members VALUES ('212',0x6468336d6d,0x3231333334666533326362666663396639323065383332356537653963346639,0x3231393633313032403136332e636f6d,'','',0x3131342e3232322e3137392e3139,'1527162149','0','0',0x356262353436,'');
INSERT INTO pre_ucenter_members VALUES ('213',0xb7f2d3eee7e975,0x6565393836626661323237383536326634633639646361366461373038666266,0x3036313535333935403136332e636f6d,'','',0x34392e37372e3136322e323535,'1527166078','0','0',0x656366326662,'');
INSERT INTO pre_ucenter_members VALUES ('214',0x7173387179,0x3235616263363630653738323536323265376532336432623231363961353939,0x3436303833373637403132362e636f6d,'','',0x3132312e3233372e3234322e323533,'1527169982','0','0',0x653463303737,'');
INSERT INTO pre_ucenter_members VALUES ('215',0xb4e4c1acb1a330,0x3739353930333138313564343965613263303963646131346630333735666265,0x3337393834353639403132362e636f6d,'','',0x3138302e3131302e35312e313831,'1527173931','0','0',0x623237353532,'');
INSERT INTO pre_ucenter_members VALUES ('216',0xbbddb9d8bba8,0x6637306338366562646663613532356266303166653763623034373130353238,0x3535343930353833403136332e636f6d,'','',0x34392e37372e3136332e3636,'1527181717','0','0',0x353263306336,'');
INSERT INTO pre_ucenter_members VALUES ('217',0x757a376e32,0x6433623764396138343137316433303236346332306530626362663764623363,0x3035303733333835403136332e636f6d,'','',0x3132312e3233372e3234322e34,'1527185666','0','0',0x323361636430,'');
INSERT INTO pre_ucenter_members VALUES ('218',0x736a6967726867,0x3431356431656464346263363033646265613137363837353364373337346530,0x6d796c7779397975403132362e636f6d,'','',0x34392e36352e37312e323437,'1527219325','0','0',0x643764623766,'');
INSERT INTO pre_ucenter_members VALUES ('219',0x6261387433,0x6236646165626331353132373938323837383630626561656538316131396137,0x3138303037373434403136332e636f6d,'','',0x3138302e3131302e35302e3933,'1527227075','0','0',0x333234326531,'');
INSERT INTO pre_ucenter_members VALUES ('220',0xb1a3c1d6b4ba74,0x3266623965646238343862353364663538626633626636656333373235363134,0x3036353932363432403136332e636f6d,'','',0x3132312e3233372e3234302e323435,'1527231003','0','0',0x623435383761,'');
INSERT INTO pre_ucenter_members VALUES ('221',0xbbdbe8a5b8f972,0x3565356334306235303933653135643731663939363031616334376432356162,0x3530323536373337403132362e636f6d,'','',0x34392e37372e3136312e3438,'1527235021','0','0',0x643138613164,'');
INSERT INTO pre_ucenter_members VALUES ('222',0x696f38627a,0x3065363564363965303138363566383863313732363136646331333336383739,0x3333313230363034403136332e636f6d,'','',0x3131342e3232322e3137382e3234,'1527251063','0','0',0x373666636335,'');
INSERT INTO pre_ucenter_members VALUES ('223',0x666971626970,0x6666613533333963316538393062393030643566333464343335333830313237,0x3133353137383735313835403136332e636f6d,'','',0x3130332e3230342e3137392e323433,'1527494192','0','0',0x306262646466,'');
INSERT INTO pre_ucenter_members VALUES ('224',0x6978696661,0x3037613832383835376364323431653163663265646465313265616332376135,0x3971386d6b617879403132362e636f6d,'','',0x3131302e39312e38362e3734,'1527538874','0','0',0x616263663733,'');
INSERT INTO pre_ucenter_members VALUES ('225',0xb5c2b6c8,0x6261623462323033383262323834623139306131396262383731383865643463,0x776a6c6c6361403136332e636f6d,'','',0x3132332e3138352e3132312e313332,'1527583327','0','0',0x663961373737,'');
INSERT INTO pre_ucenter_members VALUES ('226',0xeac9b1cacee9,0x3032383433653866623230663431326339626363643738623934656130343265,0x3331373838303935403132362e636f6d,'','',0x34392e37372e3136312e3438,'1527649083','0','0',0x626261353062,'');
INSERT INTO pre_ucenter_members VALUES ('227',0xc8aab0aeb7e56a,0x3964316437376334333534643434313731316462353665666534343263663765,0x3430313336383139403136332e636f6d,'','',0x3138302e3131302e35302e313330,'1527657074','0','0',0x326236393030,'');
INSERT INTO pre_ucenter_members VALUES ('228',0xbfadbbd8c0f631,0x3763383064363539636265346165623965396663633531616439313836383862,0x3433383037353537403132362e636f6d,'','',0x3132312e3233372e3234332e3434,'1527661094','0','0',0x363264356162,'');
INSERT INTO pre_ucenter_members VALUES ('229',0x69646e7866,0x3262376662363635343533666334313733366635356639616164616333396535,0x6979747268716333403132362e636f6d,'','',0x3131302e39312e38352e3536,'1527702282','0','0',0x616462323739,'');
INSERT INTO pre_ucenter_members VALUES ('230',0x70c3a8d0dcd0dcd0dc,0x3765383034356139633439653532353465303439313534636333643830386164,0x796972756f313033403136332e636f6d,'','',0x3231382e38392e3233362e313436,'1527769777','0','0',0x316535626635,'');
INSERT INTO pre_ucenter_members VALUES ('231',0x6c687373677872,0x3765383237616430633338613135636530313465623639356565393964383830,0x6d68626c6d646271403132362e636f6d,'','',0x3138302e3131312e3133322e313230,'1527819260','0','0',0x643136653132,'');
INSERT INTO pre_ucenter_members VALUES ('232',0xb0d4eeb8caae,0x3562366334353937643835666435663536353064376361323539663236663739,0x3034363435393333403136332e636f6d,'','',0x3132312e3233372e3234332e3933,'1527868746','0','0',0x613261636161,'');
INSERT INTO pre_ucenter_members VALUES ('233',0xb1f6bbf9ecb378,0x3262356562613039303433653739383633616433343162316434363962306136,0x3838333639343435403132362e636f6d,'','',0x34392e37372e3136332e3231,'1527872835','0','0',0x333135656565,'');
INSERT INTO pre_ucenter_members VALUES ('234',0xd6f1c1d6b0cbbde46e7870,0x6135383164333439393530303465306662326134663633373737393466306236,0x79616f726f6e673835403136332e636f6d,'','',0x3231382e38392e3233362e313436,'1528128523','0','0',0x623434326431,'');
INSERT INTO pre_ucenter_members VALUES ('235',0x626d746968,0x6531623666323561386530633733336631346132663431343935343763356631,0x78686f707562306f403132362e636f6d,'','',0x3131302e39312e3231342e37,'1528142533','0','0',0x353136333464,'');
INSERT INTO pre_ucenter_members VALUES ('236',0x66756264777872,0x3163373033303935333865396666663637363664643436323130343962643764,0x7732737836666c6e403132362e636f6d,'','',0x34392e37372e3232372e3731,'1528182938','0','0',0x616161653830,'');
INSERT INTO pre_ucenter_members VALUES ('237',0xcfb0b9dfc1cbbcc5c4afc1cb,0x6662343063376266346633313266393262623138313934643333623338386637,0x6665697a68756f79697368756f32403136332e636f6d,'','',0x3231382e38392e3233362e313436,'1528283789','0','0',0x643265626333,'');
INSERT INTO pre_ucenter_members VALUES ('238',0x786b746c73,0x3931353230666631666634636331363730653466313366653265626363303131,0x73736f6d6d6a696c403132362e636f6d,'','',0x3131302e39312e38302e323238,'1528285330','0','0',0x323533343963,'');
INSERT INTO pre_ucenter_members VALUES ('239',0xb0d8b7e9b4bad1fe,0x3166663361346431313432326436623337616139373237376461373535303266,0x746b796f383531363936403132362e636f6d,'','',0x3232332e37342e32362e313233,'1528326867','0','0',0x333330303536,'');
INSERT INTO pre_ucenter_members VALUES ('240',0x64653465737932,0x6363323733346563343434663165396435353839636137356264353464663563,0x6f6c32306f336d403136332e636f6d,'','',0x3132322e3232352e3131332e313832,'1528331788','0','0',0x633937643232,'');
INSERT INTO pre_ucenter_members VALUES ('241',0xb4b4b8bbb1a66d6466,0x3932333739616239343762363835373565613430363230343163663836626633,0x69663933363738403132362e636f6d,'','',0x3131352e3233382e3139342e3231,'1528734903','0','0',0x373166393862,'');
INSERT INTO pre_ucenter_members VALUES ('242',0xb3afcdf1,0x6636656539373230326161376539623830633264626239333162633464393338,0x646c6b6e6f727272403132362e636f6d,'','',0x3132332e3138352e3132312e3231,'1528779196','0','0',0x636631326330,'');
INSERT INTO pre_ucenter_members VALUES ('243',0x6ab7c5cad6d0d2b8a3,0x6536353931313432363064636461393936666330653066643637633962613634,0x65796f633670706a403132362e636f6d,'','',0x3131342e3232382e3139372e323337,'1528795075','0','0',0x333861366533,'');
INSERT INTO pre_ucenter_members VALUES ('244',0x7770786870,0x6464353830316262343832353636613134363465656436376632373163353038,0x66797a377a766375403132362e636f6d,'','',0x3132302e33332e37392e323037,'1528835108','0','0',0x346465656261,'');
INSERT INTO pre_ucenter_members VALUES ('245',0xcfe3b8dbc9e7c7f8cdf8,0x3631313030363935353965396434613830323235303034363165306565356635,0x7171726f626f74303338403136332e636f6d,'','',0x3232332e3134392e3135302e323034,'1528891896','0','0',0x383834373534,'');
INSERT INTO pre_ucenter_members VALUES ('246',0x6c6478756a,0x3034376332303538623233313035336237343433383833643965373734363533,0x633530393737343634747562403136332e636f6d,'','',0x3232332e37332e3137372e323337,'1528924105','0','0',0x396161663937,'');
INSERT INTO pre_ucenter_members VALUES ('247',0x69763862747530,0x3034353738363266333434373933353139336136653432363761366634363631,0x6b397436723236403136332e636f6d,'','',0x3132322e3232352e3131332e313832,'1528954833','0','0',0x313537356631,'');
INSERT INTO pre_ucenter_members VALUES ('248',0xbca4b6af3431,0x6533666637373237633063393335356231333133373332336333616430663236,0x6f62796930313033403136332e636f6d,'','',0x3132322e3132312e3132322e3830,'1529061813','0','0',0x356632356238,'');
INSERT INTO pre_ucenter_members VALUES ('249',0xd4c2d2b9bff1cfeb7438,0x6335303837313232306663383430333065343265333565653138396564336532,0x727968686e6d6477403132362e636f6d,'','',0x3138302e3131362e3138312e3533,'1529119386','0','0',0x613831616638,'');
INSERT INTO pre_ucenter_members VALUES ('250',0xc0cfccc6f3c6c0cfd1bc31,0x6261613531363430356635316461376433666633303937346237333438323565,0x6c6a35376c7a6233403132362e636f6d,'','',0x3138302e3131362e3138312e3533,'1529158125','0','0',0x653061326636,'');
INSERT INTO pre_ucenter_members VALUES ('251',0xdfcfdfcfd7cad4b43039,0x6536346538626136653038343364663433653839376437353964666531366637,0x6e72626566373431353432403136332e636f6d,'','',0x3132322e3132312e3132322e3830,'1529175901','0','0',0x653038623964,'');
INSERT INTO pre_ucenter_members VALUES ('252',0xcedeceaad6aec8cb323634,0x3039366362616130346534323735323535633036346165373334343432306137,0x3973316673736b30403132362e636f6d,'','',0x3138302e3131362e3138312e323035,'1529193152','0','0',0x303232666561,'');
INSERT INTO pre_ucenter_members VALUES ('253',0xb0efd3f1b9ab78,0x3131383762313366323637313932346162346363336461316364363366323937,0x3134323930343639403132362e636f6d,'','',0x3138302e3131302e34392e313734,'1529270258','0','0',0x323533626635,'');
INSERT INTO pre_ucenter_members VALUES ('254',0x7a6b3463797736,0x3033306434323233653835313931626461396130366230333763303133656164,0x63377071716e69403136332e636f6d,'','',0x3132322e3232352e3131332e313832,'1529397476','0','0',0x343432633563,'');
INSERT INTO pre_ucenter_members VALUES ('255',0xbbd8edf8c8fdc9fae7fae7ea,0x3462306438393533656334383132313666313135356234646337336339356565,0x736966757a68616e676c69616e39403136332e636f6d,'','',0x3231382e38392e3233362e3234,'1529408854','0','0',0x363633306638,'');
INSERT INTO pre_ucenter_members VALUES ('256',0x636662646963,0x6438396535343837343866393563353238393837633632613134393734333632,0x69613933363738403132362e636f6d,'','',0x3131362e3233312e3135312e313937,'1529432307','0','0',0x343035666332,'');
INSERT INTO pre_ucenter_members VALUES ('257',0x7877616577,0x3539656539393466666237633133353664316530326134663763633633656561,0x68616f3463706767403132362e636f6d,'','',0x3131372e36312e3136352e313433,'1529507993','0','0',0x396465306239,'');
INSERT INTO pre_ucenter_members VALUES ('258',0xb4b4b8bbb1a67a6861,0x3165363437373462653230393064333639653966326361316665616166393031,0x7a633933363738403136332e636f6d,'','',0x3130312e38382e3232372e313934,'1529596021','0','0',0x356131366262,'');
INSERT INTO pre_ucenter_members VALUES ('259',0x71656f7777,0x3565666363633030616336666562656530393331323139303966343162386131,0x776b646b6b6e677a403132362e636f6d,'','',0x3132322e39362e31302e3439,'1529778012','0','0',0x636239626338,'');
INSERT INTO pre_ucenter_members VALUES ('260',0x6362626e61,0x6237313839316533323764656162333361393864336463373532366339643532,0x787874746861656e403132362e636f6d,'','',0x3131372e36312e3135382e3336,'1529911132','0','0',0x633138643431,'');
INSERT INTO pre_ucenter_members VALUES ('261',0x686e3163737439,0x3563366638363362336237356231643237663437666132346633383639373335,0x7871736c706f69403136332e636f6d,'','',0x3132322e3232352e3131332e313832,'1529914234','0','0',0x616430656632,'');
INSERT INTO pre_ucenter_members VALUES ('262',0xb4b4b8bbb1a6786a6e,0x6638663734663032626466653936653864376261393039633932376531363339,0x69763933363738403132362e636f6d,'','',0x3138302e3137332e3139382e323532,'1529916587','0','0',0x626161353138,'');
INSERT INTO pre_ucenter_members VALUES ('263',0x7773337a38,0x3937333861323637363534393133306238646138373732646364643366383461,0x3033373837353632403136332e636f6d,'','',0x3138302e3131302e34382e323031,'1529930979','0','0',0x336531303730,'');
INSERT INTO pre_ucenter_members VALUES ('264',0xb5c2c8f8b2ae6e,0x6337376138663966343938646332353634366231393338313461363265363638,0x3633353032333934403136332e636f6d,'','',0x3131342e3232322e3137392e313638,'1529939626','0','0',0x616239323432,'');
INSERT INTO pre_ucenter_members VALUES ('265',0xdfcfdfcfd7cad4b43833,0x6636613036363033633431306637623533383032343465383332346261373862,0x6c616a6961303764616f62693838403136332e636f6d,'','',0x3131312e3235352e3132372e313039,'1529971454','0','0',0x656439626137,'');
INSERT INTO pre_ucenter_members VALUES ('266',0x6c68697264,0x6461333731653836336662623563313965386634336466363365376137306466,0x6e6169353132356c75796963616e6733403136332e636f6d,'','',0x36302e3137362e3233382e313831,'1529996208','0','0',0x303236303666,'');
INSERT INTO pre_ucenter_members VALUES ('267',0xb0d7c2eab6e0bcaa33343734,0x6563333961663138383036653938376236303131623765353933373338636133,0x746661676a7a6d6d403132362e636f6d,'','',0x3138302e3131362e3138312e3934,'1530008337','0','0',0x313761363161,'');
INSERT INTO pre_ucenter_members VALUES ('268',0x72626c6a75,0x6266653839386131386332356338313332306564633437666261303864313134,0x7030306d77786665403132362e636f6d,'','',0x3131372e36312e3136322e323434,'1530053940','0','0',0x346335326638,'');
INSERT INTO pre_ucenter_members VALUES ('269',0xb0f1b0d8d0c5,0x6664643735613732323132343632393531643365306233643839613534323863,0x3835303837393333403132362e636f6d,'','',0x3131342e3232322e3137392e313638,'1530068418','0','0',0x323833653065,'');
INSERT INTO pre_ucenter_members VALUES ('270',0xb3a3d3d0cfb2cac273,0x6331373431323139663261323262333366616132366535623432303534343739,0x746f696c74707275403132362e636f6d,'','',0x3138302e3131362e3137392e3338,'1530079292','0','0',0x633262363766,'');
INSERT INTO pre_ucenter_members VALUES ('271',0xbdadc4cfd2e479,0x6337303034336532366536333039643032386663393830633465643536613662,0x79657368756e79616875616e333039403136332e636f6d,'','',0x3232322e3230392e3138372e313230,'1530119996','0','0',0x633339633233,'');
INSERT INTO pre_ucenter_members VALUES ('272',0xb3c2c3f7beb0323837,0x6331336132306334613662623838383430663465313131383936313130333461,0x3171676f36307773403132362e636f6d,'','',0x3138302e3131362e3137392e3338,'1530122614','0','0',0x366261313061,'');
INSERT INTO pre_ucenter_members VALUES ('273',0x466f7265737432363131,0x6364306438376130346164366361646364643162323832653538353338653164,0x666f726573747368697070696e6740686f746d61696c2e636f6d,'','',0x31342e3135352e3135372e313639,'1530179821','0','0',0x643930353939,'');
INSERT INTO pre_ucenter_members VALUES ('274',0x676e75726f,0x3861653464306565376335653131366332346162323933313335633330643365,0x773063357339716e403132362e636f6d,'','',0x3131372e36312e3135382e313430,'1530184744','0','0',0x386134643361,'');



INSERT INTO pre_ucenter_notelist VALUES ('2',0x64656c65746575736572,'1','1','1',0x6964733d27343427,'','1516174271','0','1');
INSERT INTO pre_ucenter_notelist VALUES ('3',0x64656c65746575736572,'1','1','1',0x6964733d27333427,'','1516174309','0','1');
INSERT INTO pre_ucenter_notelist VALUES ('4',0x64656c65746575736572,'1','1','1',0x6964733d27333427,'','1516174418','0','1');
INSERT INTO pre_ucenter_notelist VALUES ('5',0x64656c65746575736572,'1','1','1',0x6964733d273432272c273433272c27343527,'','1516174453','0','1');
INSERT INTO pre_ucenter_notelist VALUES ('6',0x64656c65746575736572,'1','1','1',0x6964733d2739272c27313127,'','1516174470','0','1');
INSERT INTO pre_ucenter_notelist VALUES ('7',0x64656c65746575736572,'1','1','1',0x6964733d273330272c273331272c273332272c273333272c273335272c273336272c273337272c273338272c273339272c273430272c27343127,'','1516174612','0','1');
INSERT INTO pre_ucenter_notelist VALUES ('8',0x7570646174657077,'1','1','1',0x757365726e616d653d6a6f7974616f62616f312670617373776f72643d,'','1516355693','0','1');
INSERT INTO pre_ucenter_notelist VALUES ('9',0x64656c65746575736572,'1','1','1',0x6964733d273233272c273234272c273235272c273236272c273237272c273238272c273239272c27353027,'','1516930655','0','1');
INSERT INTO pre_ucenter_notelist VALUES ('10',0x64656c65746575736572,'1','1','1',0x6964733d2734272c2735272c2736272c2737272c2738272c273130272c273132272c273133272c273134272c273135272c273136272c273137272c273138272c273139272c273230272c273231272c27323227,'','1516930671','0','1');
INSERT INTO pre_ucenter_notelist VALUES ('11',0x757064617465636c69656e74,'1','4','0','',0x3c3f786d6c2076657273696f6e3d22312e302220656e636f64696e673d2249534f2d383835392d31223f3e0d0a3c726f6f743e0d0a093c6974656d2069643d22616363657373656d61696c223e3c215b43444154415b5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2263656e736f72656d61696c223e3c215b43444154415b5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2263656e736f72757365726e616d65223e3c215b43444154415b5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2264617465666f726d6174223e3c215b43444154415b792d6e2d6a5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d22646f75626c6565223e3c215b43444154415b305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2274696d656f6666736574223e3c215b43444154415b32383830305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2270726976617465706d7468726561646c696d6974223e3c215b43444154415b32355d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2263686174706d7468726561646c696d6974223e3c215b43444154415b33305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2263686174706d6d656d6265726c696d6974223e3c215b43444154415b33355d5d3e3c2f6974656d3e0d0a093c6974656d2069643d22706d666c6f6f646374726c223e3c215b43444154415b31355d5d3e3c2f6974656d3e0d0a093c6974656d2069643d22706d63656e746572223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2273656e64706d736563636f6465223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d22706d73656e6472656764617973223e3c215b43444154415b305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c64656661756c74223e3c215b43444154415b6a6f7974616f62616f40686f746d61696c2e636f6d5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c73656e64223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c736572766572223e3c215b43444154415b736d74702e3231636e2e636f6d5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c706f7274223e3c215b43444154415b32355d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c61757468223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c66726f6d223e3c215b43444154415b5543656e746572203c757365726e616d65403231636e2e636f6d3e5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c617574685f757365726e616d65223e3c215b43444154415b757365726e616d65403231636e2e636f6d5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c617574685f70617373776f7264223e3c215b43444154415b70617373776f72645d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c64656c696d69746572223e3c215b43444154415b305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c757365726e616d65223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c73696c656e74223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226c6f67696e5f6661696c656474696d65223e3c215b43444154415b305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2274696d65666f726d6174223e3c215b43444154415b483a695d5d3e3c2f6974656d3e0d0a3c2f726f6f743e,'1524731839','0','-4');
INSERT INTO pre_ucenter_notelist VALUES ('12',0x757064617465636c69656e74,'1','2','0','',0x3c3f786d6c2076657273696f6e3d22312e302220656e636f64696e673d2249534f2d383835392d31223f3e0d0a3c726f6f743e0d0a093c6974656d2069643d22616363657373656d61696c223e3c215b43444154415b403132362e636f6d0d0a403136332e636f6d0d0a40686f746d61696c2e636f6d5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2263656e736f72656d61696c223e3c215b43444154415b40676d61696c2e636f6d5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2263656e736f72757365726e616d65223e3c215b43444154415b61646d696e5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2264617465666f726d6174223e3c215b43444154415b792d6e2d6a5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d22646f75626c6565223e3c215b43444154415b305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2274696d656f6666736574223e3c215b43444154415b32383830305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2270726976617465706d7468726561646c696d6974223e3c215b43444154415b32355d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2263686174706d7468726561646c696d6974223e3c215b43444154415b33305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2263686174706d6d656d6265726c696d6974223e3c215b43444154415b33355d5d3e3c2f6974656d3e0d0a093c6974656d2069643d22706d666c6f6f646374726c223e3c215b43444154415b31355d5d3e3c2f6974656d3e0d0a093c6974656d2069643d22706d63656e746572223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2273656e64706d736563636f6465223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d22706d73656e6472656764617973223e3c215b43444154415b305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c64656661756c74223e3c215b43444154415b6a6f7974616f62616f40686f746d61696c2e636f6d5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c73656e64223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c736572766572223e3c215b43444154415b736d74702e3231636e2e636f6d5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c706f7274223e3c215b43444154415b32355d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c61757468223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c66726f6d223e3c215b43444154415b5543656e746572203c757365726e616d65403231636e2e636f6d3e5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c617574685f757365726e616d65223e3c215b43444154415b757365726e616d65403231636e2e636f6d5d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c617574685f70617373776f7264223e3c215b43444154415b70617373776f72645d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c64656c696d69746572223e3c215b43444154415b305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c757365726e616d65223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226d61696c73696c656e74223e3c215b43444154415b315d5d3e3c2f6974656d3e0d0a093c6974656d2069643d226c6f67696e5f6661696c656474696d65223e3c215b43444154415b305d5d3e3c2f6974656d3e0d0a093c6974656d2069643d2274696d65666f726d6174223e3c215b43444154415b483a695d5d3e3c2f6974656d3e0d0a3c2f726f6f743e,'1524726186','0','-2');
INSERT INTO pre_ucenter_notelist VALUES ('13',0x757064617465686f737473,'1','2','0','',0x3c3f786d6c2076657273696f6e3d22312e302220656e636f64696e673d2249534f2d383835392d31223f3e0d0a3c726f6f743e0d0a093c6974656d2069643d2230223e0d0a09093c6974656d2069643d226964223e313c2f6974656d3e0d0a09093c6974656d2069643d22646f6d61696e223e6262732e3532646f636b65722e636f6d3c2f6974656d3e0d0a09093c6974656d2069643d226970223e3139382e3235322e39392e3135333c2f6974656d3e0d0a093c2f6974656d3e0d0a3c2f726f6f743e,'1524731750','0','-2');
INSERT INTO pre_ucenter_notelist VALUES ('14',0x7570646174657077,'1','1','1',0x757365726e616d653d6a6f7974616f62616f2670617373776f72643d,'','1526458893','0','1');

INSERT INTO pre_ucenter_pm_indexes VALUES ('1','1');
INSERT INTO pre_ucenter_pm_indexes VALUES ('2','1');
INSERT INTO pre_ucenter_pm_indexes VALUES ('3','1');
INSERT INTO pre_ucenter_pm_indexes VALUES ('4','1');
INSERT INTO pre_ucenter_pm_indexes VALUES ('5','1');

INSERT INTO pre_ucenter_pm_lists VALUES ('1','2','1',0x446f636b6572bcb4d1a7bcb4d3c30ab1e3d2cbb5e3,'2',0x315f32,'1496651309',0x613a333a7b733a31323a226c617374617574686f726964223b733a313a2232223b733a31303a226c617374617574686f72223b733a31303a226a6f7974616f62616f31223b733a31313a226c61737473756d6d617279223b733a31363a22c4e3d2aab6e0c9d9ced2b3f6b6e0c9d9223b7d);

INSERT INTO pre_ucenter_pm_members VALUES ('1','1','0','5','1496651386','1496651401');
INSERT INTO pre_ucenter_pm_members VALUES ('1','2','0','5','1496651401','1496651401');


INSERT INTO pre_ucenter_pm_messages_1 VALUES ('1','1','2',0x5b75726c3d687474703a2f2f7777772e3532646f636b65722e636f6d2f666f72756d2e7068703f6d6f643d76696577746872656164267469643d3626646f3d7472616465696e666f267069643d31395d5b625d446f636b6572bcb4d1a7bcb4d3c35b2f625d5b2f75726c5d0ab1e3d2cbb5e3,'0','1496651309');
INSERT INTO pre_ucenter_pm_messages_1 VALUES ('2','1','1',0xc4e3b3f6b6e0c9d9,'0','1496651339');
INSERT INTO pre_ucenter_pm_messages_1 VALUES ('3','1','2',0xc4e3d2aab6e0c9d9,'0','1496651351');
INSERT INTO pre_ucenter_pm_messages_1 VALUES ('4','1','1',0xc4e3b3f6b6e0c9d9ced2d2aab6e0c9d9,'0','1496651386');
INSERT INTO pre_ucenter_pm_messages_1 VALUES ('5','1','2',0xc4e3d2aab6e0c9d9ced2b3f6b6e0c9d9,'0','1496651401');










INSERT INTO pre_ucenter_settings VALUES (0x616363657373656d61696c,0x403132362e636f6d0d0a403136332e636f6d0d0a40686f746d61696c2e636f6d);
INSERT INTO pre_ucenter_settings VALUES (0x63656e736f72656d61696c,0x40676d61696c2e636f6d);
INSERT INTO pre_ucenter_settings VALUES (0x63656e736f72757365726e616d65,0x61646d696e);
INSERT INTO pre_ucenter_settings VALUES (0x64617465666f726d6174,0x792d6e2d6a);
INSERT INTO pre_ucenter_settings VALUES (0x646f75626c6565,'0');
INSERT INTO pre_ucenter_settings VALUES (0x6e6578746e6f746574696d65,'0');
INSERT INTO pre_ucenter_settings VALUES (0x74696d656f6666736574,0x3238383030);
INSERT INTO pre_ucenter_settings VALUES (0x70726976617465706d7468726561646c696d6974,0x3235);
INSERT INTO pre_ucenter_settings VALUES (0x63686174706d7468726561646c696d6974,0x3330);
INSERT INTO pre_ucenter_settings VALUES (0x63686174706d6d656d6265726c696d6974,0x3335);
INSERT INTO pre_ucenter_settings VALUES (0x706d666c6f6f646374726c,0x3135);
INSERT INTO pre_ucenter_settings VALUES (0x706d63656e746572,0x31);
INSERT INTO pre_ucenter_settings VALUES (0x73656e64706d736563636f6465,0x31);
INSERT INTO pre_ucenter_settings VALUES (0x706d73656e6472656764617973,'0');
INSERT INTO pre_ucenter_settings VALUES (0x6d61696c64656661756c74,0x6a6f7974616f62616f40686f746d61696c2e636f6d);
INSERT INTO pre_ucenter_settings VALUES (0x6d61696c73656e64,0x31);
INSERT INTO pre_ucenter_settings VALUES (0x6d61696c736572766572,0x736d74702e3231636e2e636f6d);
INSERT INTO pre_ucenter_settings VALUES (0x6d61696c706f7274,0x3235);
INSERT INTO pre_ucenter_settings VALUES (0x6d61696c61757468,0x31);
INSERT INTO pre_ucenter_settings VALUES (0x6d61696c66726f6d,0x5543656e746572203c757365726e616d65403231636e2e636f6d3e);
INSERT INTO pre_ucenter_settings VALUES (0x6d61696c617574685f757365726e616d65,0x757365726e616d65403231636e2e636f6d);
INSERT INTO pre_ucenter_settings VALUES (0x6d61696c617574685f70617373776f7264,0x70617373776f7264);
INSERT INTO pre_ucenter_settings VALUES (0x6d61696c64656c696d69746572,'0');
INSERT INTO pre_ucenter_settings VALUES (0x6d61696c757365726e616d65,0x31);
INSERT INTO pre_ucenter_settings VALUES (0x6d61696c73696c656e74,0x31);
INSERT INTO pre_ucenter_settings VALUES (0x6c6f67696e5f6661696c656474696d65,'0');
INSERT INTO pre_ucenter_settings VALUES (0x76657273696f6e,0x312e362e30);
INSERT INTO pre_ucenter_settings VALUES (0x74696d65666f726d6174,0x483a69);



INSERT INTO pre_ucenter_vars VALUES (0x6e6f7465657869737473,'0');
INSERT INTO pre_ucenter_vars VALUES (0x6e6f746565786973747331,'0');

