

CREATE TABLE `academics` (
  `academic_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `academic_name` varchar(100) NOT NULL,
  `academic_code` varchar(100) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`academic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO academics VALUES("0","Management","S1","0","2022-01-10 13:47:51");
INSERT INTO academics VALUES("1","sa34s","S2","0","2022-01-10 13:49:54");
INSERT INTO academics VALUES("2","asdas","asdds","0","2022-05-03 21:31:50");



CREATE TABLE `announcement` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `body` varchar(225) NOT NULL,
  `file` varchar(200) NOT NULL,
  `date` varchar(225) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

INSERT INTO announcement VALUES("46","Mass Hiring 2022","We are looking for aspiring candidate for the position for IT Head Department.","file_name","","0");
INSERT INTO announcement VALUES("50","3","","file_name","","0");



CREATE TABLE `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(6) NOT NULL,
  `employee_id` int(3) unsigned zerofill NOT NULL,
  `department_id` char(3) NOT NULL,
  `shift_id` int(1) NOT NULL,
  `location_id` int(1) NOT NULL,
  `in_time` int(11) NOT NULL,
  `notes` varchar(120) NOT NULL,
  `image` varchar(50) NOT NULL,
  `lack_of` varchar(11) NOT NULL,
  `in_status` varchar(15) NOT NULL,
  `out_time` int(11) NOT NULL,
  `out_status` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `employee_id` (`employee_id`),
  KEY `department_id` (`department_id`),
  KEY `shift_id` (`shift_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

INSERT INTO attendance VALUES("45","ADM011","011","ADM","1","1","0","sdf","item-200511-8f5d7be1a1.jpg","None","Late","0","Early");
INSERT INTO attendance VALUES("48","ADM011","011","ADM","1","1","0","","item-200513-ad6953a07e.jpg","Notes","Late","0","Over Time");
INSERT INTO attendance VALUES("49","PCD010","010","PCD","2","1","0","asdasd","","None,image","Late","0","Over Time");
INSERT INTO attendance VALUES("50","ADM011","011","ADM","1","1","0","","","Notes,image","On Time","0","Early");
INSERT INTO attendance VALUES("51","PCD010","010","PCD","3","1","0","testing","item-210601-3946bb00df.png","None","Late","0","Over Time");
INSERT INTO attendance VALUES("52","PCD010","010","PCD","3","2","0","none","","None,image","Late","0","Over Time");
INSERT INTO attendance VALUES("53","STD026","026","STD","1","1","0","none","","None,image","Late","0","Over Time");
INSERT INTO attendance VALUES("54","ADM011","011","ADM","1","2","0","demo","","None,image","Late","0","Over Time");
INSERT INTO attendance VALUES("55","QCD027","027","QCD","6","2","0","none..","","None,image","Late","0","Early");
INSERT INTO attendance VALUES("56","QCD027","027","QCD","6","2","0","none","","None,image","Late","0","Early");
INSERT INTO attendance VALUES("58","QCD027","027","QCD","6","1","0","none","","None,image","Late","0","Early");
INSERT INTO attendance VALUES("59","QCD027","027","QCD","6","4","0","none","","None,image","Late","0","Early");
INSERT INTO attendance VALUES("60","QCD027","027","QCD","6","1","0","none","","None,image","Late","0","Over Time");
INSERT INTO attendance VALUES("61","STD026","026","STD","1","2","0","none","","None,image","On Time","0","Over Time");
INSERT INTO attendance VALUES("62","ADM011","011","ADM","1","1","0","none","","None,image","Late","0","Over Time");
INSERT INTO attendance VALUES("63","QCD027","027","QCD","6","2","0","this is a demo note!","","None,image","Late","0","Early");
INSERT INTO attendance VALUES("64","ACD002","002","ACD","2","3","0","demo demo","","None,image","On Time","0","Early");
INSERT INTO attendance VALUES("65","STD026","026","STD","1","2","0","test","","None,image","Late","0","Early");
INSERT INTO attendance VALUES("66","SCD004","004","SCD","3","1","0","dito me sa bahay","","None,image","Late","0","Over Time");
INSERT INTO attendance VALUES("110","STD009","009","STD","2","1","0","","","Notes,image","On Time","0","Early");
INSERT INTO attendance VALUES("119","ACD036","036","ACD","1","1","1646036340","","","Notes,image","Late","1646036340","Over Time");
INSERT INTO attendance VALUES("126","STD009","009","STD","2","1","1646701068","","","Notes,image","On Time","1646701165","Early");
INSERT INTO attendance VALUES("127","PLD007","007","PLD","2","2","1650877866","","","Notes,image","Late","1650877870","Over Time");
INSERT INTO attendance VALUES("128","PLD007","007","PLD","2","1","1665501012","","","Notes,image","Late","1665501016","Early");



CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` char(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO department VALUES("1","ACD","Accounting Department2","0");
INSERT INTO department VALUES("2","ADM","Admin Department","0");
INSERT INTO department VALUES("3","FGY","dsfgdsafgdsgsd","0");
INSERT INTO department VALUES("4","HRD","Human Resource Department","0");
INSERT INTO department VALUES("5","PCD","Production Controller Department","0");
INSERT INTO department VALUES("6","PLD","Planner Department","0");
INSERT INTO department VALUES("7","QCD","Quality Control Department","0");
INSERT INTO department VALUES("8","SCD","Security Department","0");
INSERT INTO department VALUES("9","STD","Store Department1","0");
INSERT INTO department VALUES("10","fgb","asdasdsa","0");
INSERT INTO department VALUES("17","try","yrt","1");



CREATE TABLE `educational_info` (
  `educ_id` bigint(20) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `bachelor_degree` varchar(100) NOT NULL,
  `bs_year` varchar(100) NOT NULL,
  `bs_school` varchar(100) NOT NULL,
  `is_master` tinyint(4) NOT NULL,
  `is_doctorate` tinyint(4) NOT NULL,
  `is_other_degree` tinyint(4) NOT NULL,
  `master_degree` varchar(100) NOT NULL,
  `md_with` varchar(100) NOT NULL,
  `md_year` varchar(100) NOT NULL,
  `md_school` varchar(100) NOT NULL,
  `doctorate` varchar(100) NOT NULL,
  `d_with` varchar(100) NOT NULL,
  `d_year` varchar(100) NOT NULL,
  `d_school` varchar(100) NOT NULL,
  `other_degree` varchar(100) NOT NULL,
  `od_year` varchar(100) NOT NULL,
  `od_school` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO educational_info VALUES("0","1","BS CS","2019","CVSU","0","0","0","","","","","","","","","","","","2022-01-11 17:31:56");
INSERT INTO educational_info VALUES("0","30","","","","0","0","0","","","","","","","","","","","","2022-01-11 17:35:16");
INSERT INTO educational_info VALUES("0","31","","","","0","0","0","","","","","","","","","","","","2022-01-13 10:16:05");
INSERT INTO educational_info VALUES("0","32","asdasd","232","123asdfas","0","0","0","","","","","","","","","","","","2022-01-13 12:19:42");
INSERT INTO educational_info VALUES("0","33","asdasd","232","asdasd","0","0","0","","","","","","","","","","","","2022-01-13 12:20:58");
INSERT INTO educational_info VALUES("0","34","","","","0","0","0","","","","","","","","","","","","2022-01-15 23:17:26");
INSERT INTO educational_info VALUES("0","35","","","","0","0","0","","","","","","","","","","","","2022-01-16 16:57:02");
INSERT INTO educational_info VALUES("0","36","CVSU","2019","cabvitye","0","0","0","","","","","","","","","","","","2022-02-28 11:27:43");
INSERT INTO educational_info VALUES("0","37","Bachelors Of Science in Information Technology","2018-2022","Cavite State University, Bacoor Campus City","0","0","0","","","","","","","","","","","","2022-05-05 20:52:16");
INSERT INTO educational_info VALUES("0","38","BSCS","2020","cvsu","0","0","0","","","","","","","","","","","","2022-10-08 11:32:52");
INSERT INTO educational_info VALUES("0","39","test","2020","test","0","0","0","","","","","","","","","","","","2022-10-14 08:41:32");



CREATE TABLE `employee` (
  `id` int(1) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `image` varchar(128) NOT NULL,
  `birth_date` date NOT NULL,
  `hire_date` date NOT NULL,
  `shift_id` int(1) NOT NULL,
  `position_id` int(1) NOT NULL,
  `department_id` int(1) NOT NULL,
  `academic_id` int(1) NOT NULL,
  `place_birth` text NOT NULL,
  `type_emp` varchar(100) NOT NULL,
  `status_emp` varchar(100) NOT NULL,
  `plantilla` varchar(50) NOT NULL,
  `eligibility` varchar(50) NOT NULL,
  `tin_no` varchar(100) NOT NULL,
  `gsis_no` varchar(100) NOT NULL,
  `pagibig_no` varchar(100) NOT NULL,
  `bacherlor_degree` varchar(100) NOT NULL,
  `bs_year` varchar(100) NOT NULL,
  `bs_school` varchar(100) NOT NULL,
  `is_master` int(1) NOT NULL,
  `is_doctorate` int(1) NOT NULL,
  `is_other_degree` int(1) NOT NULL,
  `master` varchar(100) NOT NULL,
  `md_with` varchar(100) NOT NULL,
  `md_year` varchar(100) NOT NULL,
  `md_school` varchar(100) NOT NULL,
  `doctorate` varchar(100) NOT NULL,
  `dd_with` varchar(100) NOT NULL,
  `dd_year` varchar(100) NOT NULL,
  `dd_school` varchar(100) NOT NULL,
  `other_degree` int(11) NOT NULL,
  `other_year` int(11) NOT NULL,
  `other_school` int(11) NOT NULL,
  `created_att` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

INSERT INTO employee VALUES("25","Admin ","","","admin","","","Male","default.png","0000-00-00","0000-00-00","0","0","0","0","","","","","","","","","","","","0","0","0","","","","","","","","","0","0","0","2022-10-15 09:21:59","1");
INSERT INTO employee VALUES("44","test","test","test","admin@admin.com","09788888888","test","Male","442edca5a5128931d0005d1045d1fff2_1665932191.jpg","2202-05-09","2000-04-05","0","4","8","0","test","Full-time","Single","asdf","asdf","asdf","sadf","asdf","bscs","2020","cvsu","0","0","0","","","","","","","","","0","0","0","2022-10-16 22:56:31","1");



CREATE TABLE `employee_department` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `employee_id` int(3) unsigned zerofill NOT NULL,
  `department_id` char(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_department_ibfk_1` (`employee_id`),
  KEY `employee_department_ibfk_2` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

INSERT INTO employee_department VALUES("1","001","HRD");
INSERT INTO employee_department VALUES("2","002","ACD");
INSERT INTO employee_department VALUES("3","003","QCD");
INSERT INTO employee_department VALUES("4","004","SCD");
INSERT INTO employee_department VALUES("5","005","STD");
INSERT INTO employee_department VALUES("6","006","ACD");
INSERT INTO employee_department VALUES("7","007","PLD");
INSERT INTO employee_department VALUES("8","008","STD");
INSERT INTO employee_department VALUES("9","009","STD");
INSERT INTO employee_department VALUES("10","010","PCD");
INSERT INTO employee_department VALUES("21","011","ADM");
INSERT INTO employee_department VALUES("25","024","HRD");
INSERT INTO employee_department VALUES("26","026","STD");
INSERT INTO employee_department VALUES("27","027","QCD");
INSERT INTO employee_department VALUES("28","029","QCD");
INSERT INTO employee_department VALUES("29","030","QCD");
INSERT INTO employee_department VALUES("30","031","PLD");
INSERT INTO employee_department VALUES("33","034","PCD");
INSERT INTO employee_department VALUES("34","035","PCD");
INSERT INTO employee_department VALUES("35","036","ACD");
INSERT INTO employee_department VALUES("36","037","ADM");
INSERT INTO employee_department VALUES("37","038","ACD");
INSERT INTO employee_department VALUES("38","039","STD");



CREATE TABLE `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(20) NOT NULL,
  `notes` text NOT NULL,
  `file` varchar(200) CHARACTER SET latin1 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4;

INSERT INTO files VALUES("60","0","dasdasasas","","1","2022-05-10 13:05:17");
INSERT INTO files VALUES("61","2","sdsdsdsd","","1","2022-05-10 13:05:59");
INSERT INTO files VALUES("62","1","asaasas","default.png","1","2022-05-10 13:20:43");
INSERT INTO files VALUES("63","3","sdssd","default.png","1","2022-05-10 14:19:05");
INSERT INTO files VALUES("64","1","sasasa","DTR5.docx","1","2022-05-12 01:13:25");
INSERT INTO files VALUES("65","1","asasasas","default.png","1","2022-05-12 01:17:57");
INSERT INTO files VALUES("66","2","asasas","INTERNETAPPLICATION.docx","1","2022-05-13 13:29:30");
INSERT INTO files VALUES("67","3","","Rosemarie_samson_ojt_resume.docx","1","2022-05-13 13:30:45");
INSERT INTO files VALUES("68","5","","FLOWCHART.docx","1","2022-05-13 13:32:00");
INSERT INTO files VALUES("69","5","","Rosemarie_samson_ojt_resume1.docx","1","2022-05-13 13:34:57");
INSERT INTO files VALUES("70","3","","CV-SAMSON.docx","1","2022-05-13 13:38:08");
INSERT INTO files VALUES("71","5","","Evaluation-for-OJT-Practicum-2nd-SEM.docx","1","2022-05-13 20:17:52");
INSERT INTO files VALUES("72","3","","SAMSON_DTR_(1).docx","1","2022-05-13 20:23:11");



CREATE TABLE `location` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO location VALUES("1","Home","1");
INSERT INTO location VALUES("2","Office","1");
INSERT INTO location VALUES("3","Store","1");
INSERT INTO location VALUES("4","Site","1");
INSERT INTO location VALUES("6","Field","1");
INSERT INTO location VALUES("7","test","1");
INSERT INTO location VALUES("8","locationtest","1");
INSERT INTO location VALUES("9","locationtest1","1");
INSERT INTO location VALUES("10","locationtest","1");
INSERT INTO location VALUES("11","locationtest3","1");



CREATE TABLE `position` (
  `position_id` int(20) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(100) NOT NULL,
  `position_code` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO position VALUES("1","Sample12341","S1","0");
INSERT INTO position VALUES("2","kool12344","F123","0");
INSERT INTO position VALUES("3","test","zx","0");
INSERT INTO position VALUES("4","asdasd","w2esd","1");
INSERT INTO position VALUES("5","sadsa","sadasd","1");
INSERT INTO position VALUES("7","try","try","1");
INSERT INTO position VALUES("8","test","test","1");
INSERT INTO position VALUES("9","qwer","rewq","1");
INSERT INTO position VALUES("10","zxcv","vczx","1");



CREATE TABLE `schedule` (
  `sched_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(20) NOT NULL,
  `day` varchar(150) NOT NULL,
  `meridian` varchar(100) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `schedule_start` longtext NOT NULL,
  `schedule_end` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`sched_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;

INSERT INTO schedule VALUES("26","1","","","00:00:00","00:00:00","[{"Monday":"04:15","Tuesday":"","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","[{"Monday":"02:36","Tuesday":"","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","0","2022-10-11 22:28:05");
INSERT INTO schedule VALUES("27","3","","","00:00:00","00:00:00","[{"Monday":"12:21","Tuesday":"","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","[{"Monday":"","Tuesday":"","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","0","2022-05-12 23:39:34");
INSERT INTO schedule VALUES("45","9","","","00:00:00","00:00:00","[{"Monday":"22:05","Tuesday":"19:05","Wednesday":"09:05","Thursday":"12:05","Friday":"11:05","Saturday":"09:50"}]","[{"Monday":"22:05","Tuesday":"23:05","Wednesday":"14:05","Thursday":"18:05","Friday":"14:06","Saturday":"17:06"}]","0","2022-05-12 23:39:42");
INSERT INTO schedule VALUES("46","6","","","00:00:00","00:00:00","[{"Monday":"10:14","Tuesday":"","Wednesday":"","Thursday":"","Friday":"07:09","Saturday":"12:14"}]","[{"Monday":"13:14","Tuesday":"","Wednesday":"","Thursday":"","Friday":"07:09","Saturday":"15:14"}]","0","2022-05-12 23:39:38");
INSERT INTO schedule VALUES("48","36","","","00:00:00","00:00:00","[{"Monday":"08:55","Tuesday":"09:55","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","[{"Monday":"13:55","Tuesday":"13:55","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","0","2022-10-11 22:26:42");
INSERT INTO schedule VALUES("49","7","","","00:00:00","00:00:00","[{"Monday":"12:00","Tuesday":"08:10","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","[{"Monday":"17:00","Tuesday":"23:15","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","0","2022-10-11 23:08:57");
INSERT INTO schedule VALUES("50","38","","","00:00:00","00:00:00","[{"Monday":"06:00","Tuesday":"","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","[{"Monday":"05:00","Tuesday":"","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","0","2022-10-13 00:37:24");
INSERT INTO schedule VALUES("51","2","","","00:00:00","00:00:00","[{"Monday":"08:08","Tuesday":"08:08","Wednesday":"08:08","Thursday":"08:08","Friday":"08:08","Saturday":"08:08"}]","[{"Monday":"20:08","Tuesday":"20:08","Wednesday":"20:08","Thursday":"20:08","Friday":"20:08","Saturday":"20:08"}]","0","2022-10-11 23:49:29");
INSERT INTO schedule VALUES("52","0","","","00:00:00","00:00:00","[{"Monday":"","Tuesday":"","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","[{"Monday":"","Tuesday":"","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","0","2022-10-13 00:57:05");
INSERT INTO schedule VALUES("53","39","","","00:00:00","00:00:00","[{"Monday":"01:00","Tuesday":"","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","[{"Monday":"12:00","Tuesday":"","Wednesday":"","Thursday":"","Friday":"","Saturday":""}]","0","2022-10-14 08:49:18");



CREATE TABLE `schedules` (
  `sched_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `mon_bill` int(5) DEFAULT NULL,
  `mon_start` varchar(25) DEFAULT NULL,
  `mon_end` varchar(25) DEFAULT NULL,
  `tue_bill` int(5) DEFAULT NULL,
  `tue_start` varchar(25) DEFAULT NULL,
  `tue_end` varchar(25) DEFAULT NULL,
  `wed_bill` int(5) DEFAULT NULL,
  `wed_start` varchar(25) DEFAULT NULL,
  `wed_end` varchar(25) DEFAULT NULL,
  `thu_bill` int(5) DEFAULT NULL,
  `thu_start` varchar(25) DEFAULT NULL,
  `thu_end` varchar(25) DEFAULT NULL,
  `fri_bill` int(5) DEFAULT NULL,
  `fri_start` varchar(25) DEFAULT NULL,
  `fri_end` varchar(25) DEFAULT NULL,
  `sat_bill` int(5) NOT NULL,
  `sat_start` varchar(25) DEFAULT NULL,
  `sat_end` varchar(25) DEFAULT NULL,
  `week` varchar(25) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL,
  PRIMARY KEY (`sched_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

INSERT INTO schedules VALUES("19","44","8","07:00","19:00","0","","","0","","","0","","","0","","","0","","","2022-W47","2022-10-21 03:17:21","1");
INSERT INTO schedules VALUES("20","44","0","","","8","08:02","20:02","0","","","0","","","0","","","0","","","2022-W48","2022-10-21 03:17:00","1");
INSERT INTO schedules VALUES("23","44","8","08:00","18:00","0","","","0","","","0","","","0","","","0","","","2022-W51","2022-10-21 03:41:02","1");



CREATE TABLE `shift` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO shift VALUES("1","08:00:00","16:00:00","1");
INSERT INTO shift VALUES("2","13:00:00","21:00:00","1");
INSERT INTO shift VALUES("3","18:00:00","02:00:00","1");
INSERT INTO shift VALUES("4","03:15:02","02:05:05","1");
INSERT INTO shift VALUES("5","07:00:00","18:25:00","1");
INSERT INTO shift VALUES("6","01:00:00","12:00:00","1");



CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `role` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL,
  `has_account` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO user VALUES("1","admin@admin.com","Password@123","25","Admin","2022-10-16 22:02:23","1","1");
INSERT INTO user VALUES("3","elvin@elvin.com","testing","43","Employee","2022-10-16 23:07:42","1","1");



CREATE TABLE `user_access` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `role_id` int(1) NOT NULL,
  `menu_id` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO user_access VALUES("1","1","1");
INSERT INTO user_access VALUES("2","1","2");
INSERT INTO user_access VALUES("3","2","3");
INSERT INTO user_access VALUES("4","2","4");
INSERT INTO user_access VALUES("5","1","5");
INSERT INTO user_access VALUES("6","2","6");
INSERT INTO user_access VALUES("7","1","7");
INSERT INTO user_access VALUES("10","2","9");



CREATE TABLE `user_menu` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `menu` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO user_menu VALUES("1","Admin");
INSERT INTO user_menu VALUES("2","Master");
INSERT INTO user_menu VALUES("3","Attendance");
INSERT INTO user_menu VALUES("4","Files");
INSERT INTO user_menu VALUES("5","Report");
INSERT INTO user_menu VALUES("6","Profile");
INSERT INTO user_menu VALUES("7","Announcement");
INSERT INTO user_menu VALUES("9","Emp_Announcement");



CREATE TABLE `user_role` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO user_role VALUES("1","Admin");
INSERT INTO user_role VALUES("2","Employee");



CREATE TABLE `user_submenu` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `menu_id` int(2) NOT NULL,
  `title` varchar(20) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO user_submenu VALUES("1","1","Dashboard","admin","fas fa-fw fa-tachometer-alt","1");
INSERT INTO user_submenu VALUES("2","2","Department","master","fas fa-fw fa-building","1");
INSERT INTO user_submenu VALUES("3","2","Schedule","master/shift","fas fa-fw fa-exchange-alt","1");
INSERT INTO user_submenu VALUES("4","2","Employee","master/employee","fas fa-fw fa-id-badge","1");
INSERT INTO user_submenu VALUES("5","2","Location","master/location","fas fa-fw fa-map-marker-alt","1");
INSERT INTO user_submenu VALUES("6","3","Attendance Form","attendance","fas fa-fw fa-clipboard-list","1");
INSERT INTO user_submenu VALUES("7","3","Statistics","attendance/stats","fas fa-fw fa-chart-pie","0");
INSERT INTO user_submenu VALUES("8","4","My Files","files","fa fa-files-o","1");
INSERT INTO user_submenu VALUES("9","2","Designation","master/designation","fa fa-suitcase","1");
INSERT INTO user_submenu VALUES("11","5","Files","report/file","fa fa-file","1");
INSERT INTO user_submenu VALUES("12","2","Users","master/users","fas fa-fw fa-users","1");
INSERT INTO user_submenu VALUES("13","5","Print Report","report","fas fa-fw fa-paste","1");
INSERT INTO user_submenu VALUES("14","2","Academic Rank","master/academic","fa fa-industry","1");
INSERT INTO user_submenu VALUES("15","5","Database Backup","report/database","fa fa-database","1");
INSERT INTO user_submenu VALUES("16","6","My Profile","profile","fas fa-fw fa-id-card","1");
INSERT INTO user_submenu VALUES("18","7","Announcement","announcement","fa fa-bullhorn","1");
INSERT INTO user_submenu VALUES("21","9","Emp_Announcement","emp_announcement","fa fa-bullhorn","1");



CREATE TABLE `users` (
  `username` char(6) NOT NULL,
  `password` varchar(128) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `role_id` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`username`),
  KEY `employee_id` (`employee_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("ACD002","$2y$10$5nv5ehyMVdljfKJ6izsOqOimsbv.cbzU.XLB9ji9zbA.eICdSrNvO","2","2","2021-09-11 17:47:23","1");
INSERT INTO users VALUES("ACD006","$2y$10$ZtCSdxUEx2iUSL1TAly7luba6d/XHEyX752FvzXuCBn4hNMbMaKZi","6","2","2022-05-05 20:47:26","1");
INSERT INTO users VALUES("ACD036","$2y$10$cGi/yj5QRL72Br67JQBtQOuPYcGwt/31PMekjOLMUEjVN.LkstG2W","36","2","2022-02-28 11:56:38","1");
INSERT INTO users VALUES("ADM011","$2y$10$BKpQcs4XKavCcYdFWujzx.Xqb7r9eNkDrOYss2VNXrMJUUpm1agUC","11","2","2021-01-11 17:47:23","1");
INSERT INTO users VALUES("ADM037","$2y$10$ZTIB1t.5t4ERIH1ECOmeb.p7ks1n08vydFUURlQObtDD1b942FoZq","37","1","2022-05-05 20:52:58","1");
INSERT INTO users VALUES("ADM038","$2y$10$qzqd9/H/cAK/7alZQV5nGelXYwzaYpqaSN0rtI60TbORzedQtVxiS","38","1","2022-10-08 13:27:36","1");
INSERT INTO users VALUES("admin","$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6","25","1","2021-10-11 17:47:23","1");
INSERT INTO users VALUES("HRD001","$2y$10$s9d3si8KzkXwKGpDoqwE5.S6sn563Zirrns6oe7U0KborVKtMFuEW","1","2","2021-04-11 17:47:23","0");
INSERT INTO users VALUES("HRD024","$2y$10$eB5hs1eJ0vhV//mIFTV.TuhUt/i82PSwKZqCPEBJ6JjwoqqzenjsK","24","2","2022-05-03 23:14:55","1");
INSERT INTO users VALUES("PCD010","$2y$10$IEOvsQXHKIA8qePv64e7L./m5qh18ND/uZVik8Nt.m7nwW1s.uCAG","10","2","2021-08-11 17:47:23","1");
INSERT INTO users VALUES("PLD007","$2y$10$Ln.oC3A/cQSYSanOSvt15epZJ82t9ojIiG6N2PSJUKsHDl3jIxh7S","7","2","2022-04-25 17:09:51","1");
INSERT INTO users VALUES("QCD00A","$2y$10$zbdQvXLFHoujaUsl0P3sUOScu23p.bwho2KTZbEacIdpKhPhqErl.","3","2","2022-02-17 18:06:25","1");
INSERT INTO users VALUES("QCD027","$2y$10$peALJo.JKZyD6uMBd41UfuHGQSJe7ExOfDhPITvDbSRRXeWUGY9xy","27","2","2022-01-11 17:47:23","1");
INSERT INTO users VALUES("QCD029","$2y$10$rMuNYiFgLnhB7gX/m1A63ekGA8MI51nqYc.3xeL4zLEKMXgUdKiKK","29","2","2022-05-05 20:55:34","1");
INSERT INTO users VALUES("rosesa","zxcvbn","0","0","2022-05-05 21:05:34","1");
INSERT INTO users VALUES("SCD004","$2y$10$es7Ni7mlMM5Zdr3yF6JWd.dRck8He67VO.TSWXyw25GHkbYf/s7WG","4","2","2022-01-11 17:47:23","1");
INSERT INTO users VALUES("STD005","$2y$10$hr35h1fIySFYCSRVL2jRD.RuYa9WtJCEJkkqvQfPboYK7VwURpLim","5","2","2022-01-11 17:47:23","1");
INSERT INTO users VALUES("STD008","$2y$10$8PGnFaiZPYtcIGrwzMmVZuNKbUb/A88f0NZOA9QVgHaUIJ6ddg.Si","8","2","2022-01-11 17:47:23","1");
INSERT INTO users VALUES("STD009","$2y$10$Ba3xjuhrprakPHwwW7FZK./OK6/KcPiR2BNXGKQ5/PAqnl.WAJStS","9","2","2022-02-17 23:55:08","1");
INSERT INTO users VALUES("STD026","$2y$10$8WNMvEEgNPWyRuSeeLDE1uXwnBkYNJE/heLT1zWbsUfYb/wKFyYIy","26","2","2022-01-11 17:47:23","1");

