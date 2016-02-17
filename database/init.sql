-- Server version	5.6.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*

TABLE 1
LEADS

Lead Owner
Company
First Name
Last Name
Title
Email
Phone
Fax
Mobile
Website
Lead Source
Lead Status
Industry
No of Employees
Annual Revenue
Rating
Email Opt Out
Skype ID
Twitter
Secondary Email
Street
City
State
Zip Code
Country
Description
*/

/*
TABLE 2
CONTACTS

Contact Owner
Lead Source
First Name
Last Name
Account Name
Vendor Name
Email
Title
Phone
Department
Other Phone
Home Phone
Mobile
Fax
Assistant
DoB
Reports To
Asst Phone
Email Opt Out
Skype ID
Add to QuickBooks
Secondary Email
Twitter
Twitter
Mailing Street
Other Street
Mailing City
Other City
Mailing State
Other State
Mailing Zip
Other Zip
Mailing Country
Other Country
Description
*/

/*
TABLE 3
ACCOUNTS

Account Owner
Rating
Account Name
Phone
Account Site
Fax
Parent Account
Website
Account Number
Ticker Symbol
Account Type
Ownership
Industry
Employees
Annual Revenue
SIC Code
Billing Street
Billing City
Billing State
Billing Code
Billing Country
Shipping Street
Shipping City
Shipping State
Shipping Code
Shipping Country
*/

/*
TABLE 4
TASKS

Task Owner
Subject
Due Date
Contact
Lead
Account
Potential
Campaign
Status
Priority
Send Notification Email
Repeat
Description
*/

/*
TABLE 5
EVENTS

Name
Location
All day
From
To
Host
Participants
Related To
Repeat
Description
*/

/*
TABLE 6
CALLS

Subject
Call Type
Call Purpose
Call From/To
Related To
Call Type
Call Length
Call Start Time
Call Duration
Description
Billable
Call Result
*/

/*
TABLE 7
POTENTIALS

Potential Owner
Amount
Potential Name
Closing Date
Account Name
Stage
Type
Probability
Next Step
Expected Revenue
Lead Source
Campaign Source
Contact Name
Description
*/

/*
TABLE 8
CAMPAIGNS

Campaign Owner
Type
Campaign Name
Status
Start Date
End Date
Expected Revenue
Budgeted Cost
Actual Cost
Expected Response
Num sent
Description
*/

/*
TABLE 9
CASES

Case Number
Product Name
Case Owner
Subject
Priority
Status
Reported By
Related To
Type
Case Origin
Email
Account Name
Potential Name
Phone
Case Reason
Description
Internal Comments
Solution
Add Comment
*/

/*
TABLE 10
SOLUTIONS

Solution Number
Solution Title
Solution Owner
Product Name
Question
Answer
Status
Description
Comments
*/

/*
TABLE 11
PRODUCTS

Product Name
Product Owner
Product Code
Product Active
Vendor Name
Product Category
Sales Start Date
Sales End Date
Commission Rate
Manufacturer
Unit Price
Taxable
Product Category
Support Start Date
Support Expiry Date
Usage Unit
Quantity Ordered
Quantity in Stock
Reorder Level
Handler
Quantity in Demand
Description
*/

/*
TABLE 12
Price book Owner
Price book Name
Active
Pricing Model
Description
From Range Details
To Range Details
Discount
*/

/*
TABLE 13
QUOTES

Quote Owner
Subject
Potential Name
Quote Stage
Valid Till
Contact Name
Account Name
Carrier
Shipping
Inventory Manager
Account Name
Billing Street
Billing City
Billing State
Billing Zip
Billing Country
Shipping Street
Shipping City
Shipping State
Shipping Zip
Shipping Country
Product Name
Quantity in Stock
Quantity
Unit Price
List Price
Total
Terms & Conditions
Description
*/

/*
TABLE 14
SALES ORDERS

Sales Order Owner
SO Number
Subject
Potential Name
Customer No
Purchase Order
Quote Name
Contact Name
Due Date
Carrier
Pending
Status
Sales Commision
Excise Duty
Account Name
Assigned To
Billing Street
Billing City
Billing State
Billing Zip
Billing Country
Shipping Street
Shipping City
Shipping State
Shipping Zip
Shipping Country
Product Name
Quantity in Stock
Quantity
Unit Price
List Price
Tax
Adjustments
Total
Terms & Conditions
Description
*/

/*
TABLE 15
INVOICES

Invoice Owner
Invoice Number
Subject
Sales Order
Purchase Order
Customer No
Excise Duty
Invoice Date
Due Date
Sales Commission
Account Name
Contact Name
Status
*/

/*
TABLE 16
VENDORS

Vendor Owner
Vendor Name
Phone
Email
Website
GL Account
Category
Vendor Street
*/

/*
TABLE 20
USERS

First Name
Last Name
Email
Role
Profile
Language
Country Local
Time Format
Time Zone
Signature

*/

--
-- Table structure for table `codex`
--

DROP TABLE IF EXISTS `codex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codex` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `org` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `updated` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codex`
--

LOCK TABLES `codex` WRITE;
/*!40000 ALTER TABLE `codex` DISABLE KEYS */;
INSERT INTO `codex` VALUES (1,'James Maiangowi','Historian','Portier Prep','Toronto',NULL);
/*!40000 ALTER TABLE `codex` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-04 23:15:40
