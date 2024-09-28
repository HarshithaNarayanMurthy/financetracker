SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DELIMITER $$
DROP PROCEDURE IF EXISTS `tbud`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `tbud` (IN `userid` INT(10))  select sum(BudgetCost)  as totalbudget from tblbudget where UserId=userid$$

DROP PROCEDURE IF EXISTS `texp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `texp` (IN `userid` INT(10))  select sum(ExpenseCost)  as totalexpense from tblexpense where UserId=userid$$

DROP PROCEDURE IF EXISTS `tinc`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `tinc` (IN `userid` INT(10))  select sum(IncomeCost)  as totalincome from tblincome where UserId= userid$$

DROP PROCEDURE IF EXISTS `tlon`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `tlon` (IN `userid` INT)  select sum(LoanCost)  as totalloan from tblloan where UserId=userid$$

DELIMITER ;

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `ID` int(10) NOT NULL,
  `type` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `cost` int(10) NOT NULL,
  `action` varchar(10) NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(150) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `tbladmin` (`ID`, `FullName`, `Email`, `MobileNumber`, `Password`, `RegDate`) VALUES
(16, 'demoadmin', 'demoadmin@gmail.com', 1234567890, '61152c80d1514e22fba66002597d0104', '2019-11-10 14:12:56');



DROP TABLE IF EXISTS `tblexpense`;
CREATE TABLE IF NOT EXISTS `tblexpense` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `ExpenseDate` date DEFAULT NULL,
  `ExpenseItem` varchar(200) DEFAULT NULL,
  `ExpenseCost` varchar(200) DEFAULT NULL,
  `NoteDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=latin1;


DROP TRIGGER IF EXISTS expdeletelog;
DELIMITER $$
CREATE TRIGGER expdeletelog BEFORE DELETE ON tblexpense FOR EACH ROW
BEGIN
    DECLARE log_time DATE;
    SELECT ExpenseDate INTO log_time FROM tblexpense WHERE ID = OLD.ID;
    INSERT INTO log (UserId, ID, type, name, cost, action, time) VALUES (OLD.UserId, OLD.ID, 'expense', OLD.ExpenseItem, OLD.ExpenseCost, 'deleted', log_time);
END$$
DELIMITER ;

DROP TRIGGER IF EXISTS expinsertlog;
DELIMITER $$
CREATE TRIGGER expinsertlog AFTER INSERT ON tblexpense FOR EACH ROW
BEGIN
    INSERT INTO log(UserId, ID, type, name, cost, action,time) VALUES(NEW.UserId, NEW.ID, 'expense',NEW.ExpenseItem,NEW.ExpenseCost,'inserted',NEW.ExpenseDate);
END$$
DELIMITER ;

DROP TABLE IF EXISTS `tblincome`;
CREATE TABLE IF NOT EXISTS `tblincome` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `IncomeDate` date DEFAULT NULL,
  `IncomeItem` varchar(200) DEFAULT NULL,
  `IncomeCost` varchar(200) DEFAULT NULL,
  `NoteDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


DROP TRIGGER IF EXISTS incdeletelog;
DELIMITER $$
CREATE TRIGGER incdeletelog BEFORE DELETE ON tblincome FOR EACH ROW
BEGIN
    DECLARE log_time DATE;
    SELECT IncomeDate INTO log_time FROM tblincome WHERE ID = OLD.ID;
    INSERT INTO log (UserId, ID, type, name, cost, action, time) VALUES (OLD.UserId, OLD.ID, 'income', OLD.IncomeItem, OLD.IncomeCost, 'deleted', log_time);
END$$
DELIMITER ;

DROP TRIGGER IF EXISTS incinsertlog;
DELIMITER $$
CREATE TRIGGER incinsertlog AFTER INSERT ON tblincome FOR EACH ROW
BEGIN
    INSERT INTO log (UserId, ID, type, name, cost, action, time) VALUES(NEW.UserId, NEW.ID, 'income',NEW.IncomeItem, NEW.IncomeCost, 'inserted', NEW.IncomeDate);
END$$
DELIMITER ;

DROP TABLE IF EXISTS `tblloan`;
CREATE TABLE IF NOT EXISTS `tblloan` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `LoanDate` date DEFAULT NULL,
  `LoanItem` varchar(200) DEFAULT NULL,
  `LoanCost` varchar(200) DEFAULT NULL,
  `NoteDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;


DROP TRIGGER IF EXISTS loaninsertlog;
DELIMITER $$
CREATE TRIGGER loaninsertlog AFTER INSERT ON tblloan FOR EACH ROW
BEGIN
    INSERT INTO log (UserId, ID, type, name, cost, action, time) VALUES (NEW.UserId, NEW.ID, 'loan', NEW.LoanItem, NEW.LoanCost, 'inserted', NEW.LoanDate);
END$$
DELIMITER ;

DROP TRIGGER IF EXISTS londeletelog;
DELIMITER $$
CREATE TRIGGER londeletelog BEFORE DELETE ON tblloan FOR EACH ROW
BEGIN
    DECLARE log_time DATE;
    SELECT LoanDate INTO log_time FROM tblloan WHERE ID = OLD.ID;
    INSERT INTO log (UserId, ID, type, name, cost, action, time) VALUES (OLD.UserId, OLD.ID, 'loan', OLD.LoanItem, OLD.LoanCost, 'deleted', log_time);
END$$
DELIMITER ;

DROP TABLE IF EXISTS `tblbudget`;
CREATE TABLE IF NOT EXISTS `tblbudget` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserId` int(10) NOT NULL,
  `BudgetDate` date DEFAULT NULL,
  `BudgetItem` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `BudgetCost` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `NoteDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

DROP TRIGGER IF EXISTS buddeletelog;
DELIMITER $$
CREATE TRIGGER buddeletelog BEFORE DELETE ON tblbudget FOR EACH ROW
BEGIN
    DECLARE log_time DATE;
    SELECT BudgetDate INTO log_time FROM tblbudget WHERE ID = OLD.ID;
    INSERT INTO log (UserId, ID, type, name, cost, action, time) VALUES (OLD.UserId, OLD.ID, 'budget', OLD.BudgetItem, OLD.BudgetCost, 'deleted', log_time);
END$$
DELIMITER ;

DROP TRIGGER IF EXISTS budinsertlog;
DELIMITER $$
CREATE TRIGGER budinsertlog AFTER INSERT ON tblbudget FOR EACH ROW
BEGIN
    INSERT INTO log (UserId, ID, type, name, cost, action, time) VALUES (NEW.UserId, NEW.ID, 'budget', NEW.BudgetItem, NEW.BudgetCost, 'inserted', NEW.BudgetDate);
END$$
DELIMITER ;




DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(150) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;


INSERT INTO `tbluser` (`ID`, `FullName`, `Email`, `MobileNumber`, `Password`, `RegDate`) VALUES
(14, 'demouser', 'demouser@gmail.com', 8957611111, '91017d590a69dc49807671a51f10ab7f', '2019-11-10 10:04:49');
COMMIT;


