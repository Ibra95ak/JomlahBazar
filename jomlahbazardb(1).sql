-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 14, 2020 at 06:21 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jomlahbazardb`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `GetWishlistCount`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetWishlistCount` (IN `usrId` BIGINT(100))  NO SQL
SELECT COUNT(wishlistId) AS countw FROM wishlists INNER JOIN products ON wishlists.productId=products.productId WHERE userId=usrId$$

DROP PROCEDURE IF EXISTS `sp_ActivateAAA`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActivateAAA` (IN `id` BIGINT(100))  NO SQL
UPDATE aaa SET activation_code=1,activation_salt=1 WHERE aaaId=id$$

DROP PROCEDURE IF EXISTS `sp_ActivateAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActivateAdmin` (IN `id` INT(11))  NO SQL
UPDATE admins SET active=1 WHERE adminId=id$$

DROP PROCEDURE IF EXISTS `sp_AddAAA`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddAAA` (IN `aaa_email` VARCHAR(50), IN `aaa_password` VARCHAR(50), IN `aaa_salt` VARCHAR(10), IN `aaa_actcode` VARCHAR(50), IN `aaa_actsalt` VARCHAR(10))  NO SQL
BEGIN
SET @orderId = '';
INSERT INTO aaa(aaaId, email, encrypted_password, salt, activation_code, activation_salt, otp, addressId,login) VALUES (NULL,aaa_email,aaa_password,aaa_salt,aaa_actcode,aaa_actsalt,0,0,0);
SELECT LAST_INSERT_ID() AS 'insertId';
END$$

DROP PROCEDURE IF EXISTS `sp_AddAboutus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddAboutus` (IN `abtus` TEXT)  NO SQL
INSERT INTO settings(settingsId,aboutus) VALUES (NULL,abtus)$$

DROP PROCEDURE IF EXISTS `sp_AddAddress`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddAddress` (IN `ipadd` VARCHAR(30), IN `adr1` VARCHAR(100), IN `adr2` VARCHAR(50), IN `ct` VARCHAR(20), IN `st` VARCHAR(20), IN `pc` VARCHAR(15), IN `con` VARCHAR(20), IN `lat` DECIMAL, IN `lon` DECIMAL)  NO SQL
BEGIN
	INSERT INTO address(addressId,ipaddress,address1,address2,city,state,postalcode,country,latitude,
longitude)
 VALUES (NULL,ipadd,adr1,adr2,ct,st,pc,con,lat,lon);
END$$

DROP PROCEDURE IF EXISTS `sp_AddAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddAdmin` (IN `username` VARCHAR(30), IN `encrypted_password` VARCHAR(50), IN `salt` VARCHAR(10), IN `act` TINYINT)  NO SQL
BEGIN
	INSERT INTO admins(adminId, username, encrypted_password, salt, active, login, created_date) VALUES (NULL,username,encrypted_password,salt,act,0,CURDATE());
END$$

DROP PROCEDURE IF EXISTS `sp_AddAdminpriviledge`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddAdminpriviledge` (IN `adid` INT(11), IN `prid` BIGINT(50))  NO SQL
INSERT INTO adminpriviledges(adminpriviledgeId,adminId,priviledgeId
) VALUES (NULL,adid,prid)$$

DROP PROCEDURE IF EXISTS `sp_AddBrand`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddBrand` (IN `cid` BIGINT(100), IN `bn` VARCHAR(30), IN `picid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO brands(brandId,brandcategoryId,brand_name,pictureId,active) VALUES (NULL,cid,bn,picid,act)$$

DROP PROCEDURE IF EXISTS `sp_AddBuyer`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddBuyer` (IN `aaid` BIGINT(100), IN `fn` VARCHAR(50), IN `ln` VARCHAR(50), IN `addrid` BIGINT(100), IN `roid` BIGINT(100), IN `wid` BIGINT(100), IN `idenid` BIGINT(100), IN `bid` BIGINT(100))  NO SQL
INSERT INTO users(userId,aaaId,first_name,last_name,addressId,reachoutId,walletId,identityId,blockId) VALUES (NULL,aaid,fn,ln,addrid,roid,wid,idenid,bid)$$

DROP PROCEDURE IF EXISTS `sp_AddCart`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddCart` (IN `uid` BIGINT(100), IN `pid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO carts(cartId,userId,productId,created_date,updated_date,active) VALUES (NULL,uid,pid,CURRENT_DATE(),CURRENT_DATE(),act)$$

DROP PROCEDURE IF EXISTS `sp_AddCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddCategory` (IN `nm` VARCHAR(30), IN `ic` VARCHAR(30), IN `act` TINYINT(4))  NO SQL
INSERT INTO categories(categoryId,name,icon,active) VALUES (NULL,nm,ic,act)$$

DROP PROCEDURE IF EXISTS `sp_Addcreditcard`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Addcreditcard` (IN `wid` BIGINT(100), IN `ccn` BIGINT(50), IN `expm` INT(2), IN `expy` INT(4))  NO SQL
INSERT INTO creditcards(creditcardId,walletId,card_number,card_expMO,card_expYR,creditcarddetailId) VALUES (NULL,wid,ccn,expm,expy,0)$$

DROP PROCEDURE IF EXISTS `sp_AddCreditcarddetail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddCreditcarddetail` (IN `tp` VARCHAR(30), IN `act` TINYINT(4))  NO SQL
INSERT INTO creditcarddetails(creditcarddetailId,type,active) VALUES (NULL,tp,act)$$

DROP PROCEDURE IF EXISTS `sp_AddDiscounttype`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddDiscounttype` (IN `tp` VARCHAR(20), IN `act` TINYINT(4))  NO SQL
INSERT INTO discounttypes(discounttypeId,type,active) VALUES (NULL,tp,act)$$

DROP PROCEDURE IF EXISTS `sp_AddFaq`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddFaq` (IN `ques` VARCHAR(200), IN `ans` TEXT, IN `pos` INT(11), IN `act` TINYINT(4))  NO SQL
INSERT INTO faq(faqId,question,answer,position,active) VALUES (NULL,ques,ans,pos,act)$$

DROP PROCEDURE IF EXISTS `sp_AddInventory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddInventory` (IN `innum` VARCHAR(30), IN `sid` TINYINT(4), IN `bid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO inventory(inventoryId,inventorynumber,statusId,
blockId,active) VALUES (NULL,innum,sid,bid,act)$$

DROP PROCEDURE IF EXISTS `sp_AddOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddOrder` (IN `uid` BIGINT(100), IN `ordn` BIGINT(100), IN `purid` BIGINT(100), IN `statid` BIGINT(100), IN `bid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO orders(orderId,userId,ordernumber,purchaseId,order_date,statusId,blockId,active) VALUES (NULL,uid,ordn,purid,CURDATE(),statid,bid,act)$$

DROP PROCEDURE IF EXISTS `sp_AddOrderdetail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddOrderdetail` (IN `oid` BIGINT(100), IN `pid` BIGINT(100), IN `ordn` BIGINT(100), IN `dis` INT(11), IN `tp` INT(11), IN `sid` BIGINT(100), IN `statid` TINYINT(4), IN `bloid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO orderdetails(orderdetailid,orderId,productId,ordernumber,discount,totalprice,
shipperId,ship_date,statusId,blockId,active) VALUES (NULL,oid,pid,ordn,dis,tp,sid,CURDATE(),statid,bloid,act)$$

DROP PROCEDURE IF EXISTS `sp_AddPaypal`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddPaypal` (IN `wid` BIGINT(100), IN `em` VARCHAR(50))  NO SQL
INSERT INTO paypal(paypalId,walletId,email) VALUES (NULL,wid,em)$$

DROP PROCEDURE IF EXISTS `sp_AddPicture`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddPicture` (IN `nm` VARCHAR(20), IN `pth` VARCHAR(50), IN `act` TINYINT(4))  NO SQL
INSERT INTO pictures(pictureId,name,path,active) VALUES (NULL,nm,pth,act)$$

DROP PROCEDURE IF EXISTS `sp_AddPriviledge`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddPriviledge` (IN `nm` VARCHAR(20), IN `cc` TINYINT(4), IN `rr` TINYINT(4), IN `uu` TINYINT(4), IN `dd` TINYINT(4), IN `ext` TINYINT(4), IN `act` TINYINT(4))  NO SQL
INSERT INTO priviledges(priviledgeId,name,c,r,u,d,extra,active) VALUES (NULL,nm,cc,rr,uu,dd,ext,act)$$

DROP PROCEDURE IF EXISTS `sp_AddProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddProduct` (IN `sid` INT, IN `pdid` BIGINT(100), IN `iid` INT, IN `nm` VARCHAR(50), IN `qt` INT(11), IN `mo` INT(11), IN `up` INT(11), IN `dis` INT(11), IN `rank` DECIMAL, IN `bid` BIGINT(100), IN `bloid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO products(productId,supplierId,productdetailId,inventoryId,name,quantity,min_order,unitprice,discount,ranking,brandId,blockId,active) VALUES (NULL,sid,pdid,iid,nm,qt,mo,up,dis,rank,bid,bloid,act)$$

DROP PROCEDURE IF EXISTS `sp_AddProductdetail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddProductdetail` (IN `des` VARCHAR(200), IN `sz` VARCHAR(15), IN `col` VARCHAR(20), IN `wt` INT(11), IN `bc` VARCHAR(30))  NO SQL
INSERT INTO productdetails(productdetailId,description,size,color,weight,barcode) VALUES (NULL,des,sz,col,wt,bc)$$

DROP PROCEDURE IF EXISTS `sp_AddPurchase`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddPurchase` (IN `pd` TINYINT(4), IN `pud` DATE, IN `tp` TINYINT(11))  NO SQL
INSERT INTO purchases(purchaseId,paid,purchase_date,total_price) VALUES (NULL,pd,pud,tp)$$

DROP PROCEDURE IF EXISTS `sp_AddReachout`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddReachout` (IN `uid` BIGINT(100), IN `ph` VARCHAR(15), IN `wa` VARCHAR(15), IN `tele` VARCHAR(15), IN `mss` VARCHAR(20), IN `skp` VARCHAR(20), IN `smss` VARCHAR(15))  NO SQL
INSERT INTO reachout(reachoutId,userId,phone,whatsapp,telegram,messenger,skype,sms) VALUES (NULL,uid,ph,wa,tele,mss,skp,smss)$$

DROP PROCEDURE IF EXISTS `sp_AddRegisteredsupplier`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddRegisteredsupplier` (IN `rn` VARCHAR(30), IN `ccid` BIGINT(100))  NO SQL
INSERT INTO registeredsuppliers(registeredsupplierId,registered_name,creditcardId) VALUES (NULL,rn,ccid)$$

DROP PROCEDURE IF EXISTS `sp_AddReview`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddReview` (IN `pid` BIGINT(100), IN `uid` BIGINT(100), IN `star` INT(11), IN `ttl` VARCHAR(30), IN `des` VARCHAR(200), IN `picid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO reviews(reviewId,productId,userId,stars,title,description,posted_date,
                    pictureId,active) VALUES (NULL,pid,uid,star,ttl,des,CURRENT_DATE(),picid,act)$$

DROP PROCEDURE IF EXISTS `sp_AddShipper`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddShipper` (IN `aaid` BIGINT(100), IN `addrid` BIGINT(100), IN `ro` BIGINT(100), IN `sdid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO shippers(shipperId,aaaId,addressId,reachoutId,shipperdetailsId,active) VALUES (NULL,aaid,addrid,ro,sdid,act)$$

DROP PROCEDURE IF EXISTS `sp_AddShipperdetail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddShipperdetail` (IN `nm` VARCHAR(30), IN `des` VARCHAR(255))  NO SQL
INSERT INTO shipperdetails(shipperdetailId,name,description) VALUES (NULL,nm,des)$$

DROP PROCEDURE IF EXISTS `sp_AddStatus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddStatus` (IN `stat` VARCHAR(20), IN `act` TINYINT(4))  NO SQL
INSERT INTO status(statusId,status.status,active) VALUES (NULL,stat,act)$$

DROP PROCEDURE IF EXISTS `sp_AddStore`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddStore` (IN `sid` BIGINT(100), IN `addrid` BIGINT(100), IN `roid` BIGINT(100), IN `nm` VARCHAR(30), IN `des` VARCHAR(200), IN `thm` TINYINT(4), IN `bid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO stores(storeId,supplierId,addressId,reachoutId,name,description,theme,blockId,active) VALUES (NULL,sid,addrid,roid,nm,des,thm,bid,act)$$

DROP PROCEDURE IF EXISTS `sp_AddSubcategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddSubcategory` (IN `cid` BIGINT(100), IN `nm` VARCHAR(30), IN `ic` VARCHAR(30), IN `act` TINYINT(4))  NO SQL
INSERT INTO subcategories(subcategoryId,categoryId,name,icon,active) VALUES (NULL,cid,nm,ic,act)$$

DROP PROCEDURE IF EXISTS `sp_AddSubscriptionplan`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddSubscriptionplan` (IN `pid` BIGINT(100), IN `nm` VARCHAR(20))  NO SQL
INSERT INTO subscriptionplans(subscriptionplanId,purchaseId,name) VALUES (NULL,pid,nm)$$

DROP PROCEDURE IF EXISTS `sp_AddSupplier`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddSupplier` (IN `aaid` BIGINT(20), IN `subpid` BIGINT(20), IN `dt` TINYINT(4), IN `regsid` BIGINT(100), IN `bid` BIGINT(100))  NO SQL
INSERT INTO suppliers(supplierId,aaaId,subscriptionplanId,discount_type,registeredsupplierId,
                   blockId) VALUES (NULL,aaid,subpid,dt,regsid,bid)$$

DROP PROCEDURE IF EXISTS `sp_AddTestimonial`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddTestimonial` (IN `nm` VARCHAR(20), IN `des` VARCHAR(255), IN `picid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO testimonials(testimonialId,name,description,pictureId,active) VALUES (NULL,nm,des,picid,act)$$

DROP PROCEDURE IF EXISTS `sp_AddWallet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddWallet` (IN `wtpid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO wallets(walletId,wallettypeId,active) VALUES (NULL,wtpid,act)$$

DROP PROCEDURE IF EXISTS `sp_AddWalletType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddWalletType` (IN `type` VARCHAR(20), IN `act` TINYINT)  NO SQL
INSERT INTO wallettype(wallettypeId,wallettype,active) VALUES (NULL,type,act)$$

DROP PROCEDURE IF EXISTS `sp_AddWishlist`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddWishlist` (IN `uid` BIGINT(100), IN `pid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
INSERT INTO wishlists(wishlistId,userId,productId,created_date,updated_date,active) VALUES (NULL,uid,pid,CURRENT_DATE(),CURRENT_DATE(),act)$$

DROP PROCEDURE IF EXISTS `sp_DeleteAAAbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteAAAbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM aaa WHERE aaaId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteAddressbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteAddressbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM address WHERE addressId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteAdminbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteAdminbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM admins WHERE adminId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteAdminpriviledgebyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteAdminpriviledgebyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM adminpriviledges WHERE adminpriviledgeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteBrandbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteBrandbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM brands WHERE brandId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteBuyerbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteBuyerbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM users WHERE userId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteCartbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteCartbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM carts WHERE cartId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteCategorybyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteCategorybyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM categories WHERE categoryId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteCreditCardbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteCreditCardbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM creditcards WHERE creditcardId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteCreditcarddetailbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteCreditcarddetailbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM creditcarddetails WHERE creditcarddetailId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteDiscounttypebyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteDiscounttypebyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM discounttypes WHERE discounttypeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteFaqbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteFaqbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM faq WHERE faqId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteInventorybyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteInventorybyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM inventory WHERE inventoryId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteOrderbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteOrderbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM orders WHERE orderId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteOrderdetailbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteOrderdetailbyId` (IN `id` BIGINT(100))  NO SQL
DELETE FROM orderdetails WHERE orderdetailId=id$$

DROP PROCEDURE IF EXISTS `sp_DeletePaypalbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeletePaypalbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM paypal WHERE paypalId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeletePicturebyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeletePicturebyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM pictures WHERE pictureId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeletePriviledgebyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeletePriviledgebyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM priviledges WHERE priviledgeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteProductbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteProductbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM products WHERE productId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteProductdetailbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteProductdetailbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM productdetails WHERE productdetailId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteReachoutbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteReachoutbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM reachout WHERE reachoutId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteRegisteredsupplierbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteRegisteredsupplierbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM registeredsuppliers WHERE registeredsupplierId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteReviewbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteReviewbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM reviews WHERE reviewId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteShipperbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteShipperbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM shippers WHERE shipperId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteShipperdetailbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteShipperdetailbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM shipperdetails WHERE shipperdetailId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteStorebyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteStorebyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM stores WHERE storeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteSubcategorybyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteSubcategorybyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM subcategories WHERE subcategoryId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteSubscriptionplanbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteSubscriptionplanbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM subscriptionplans WHERE subscriptionplanId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteSupplierbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteSupplierbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM suppliers WHERE supplierId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteTestimonialbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteTestimonialbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM testimonials WHERE testimonialId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteWalletbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteWalletbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM wallets	WHERE walletId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_DeleteWalletTypebyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteWalletTypebyId` (IN `id` BIGINT(100))  NO SQL
DELETE FROM wallettype WHERE wallettypeId=id$$

DROP PROCEDURE IF EXISTS `sp_DeleteWishlistbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteWishlistbyId` (IN `id` INT)  NO SQL
BEGIN
	DELETE FROM wishlists WHERE wishlistId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditAAA`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditAAA` (IN `id` INT)  NO SQL
BEGIN
	UPDATE aaa SET email=mail, encrypted_password=pass, salt=slt, activation_code=act where aaaId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditAboutus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditAboutus` (IN `abtus` TEXT)  NO SQL
UPDATE settings SET aboutus=abtus$$

DROP PROCEDURE IF EXISTS `sp_EditAddress`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditAddress` (IN `id` BIGINT(100), IN `ip` VARCHAR(30), IN `addr1` VARCHAR(100), IN `addr2` VARCHAR(50), IN `citys` VARCHAR(20), IN `states` VARCHAR(20), IN `poscode` VARCHAR(15), IN `cont` VARCHAR(20), IN `lat` DECIMAL, IN `lon` DECIMAL)  NO SQL
BEGIN
	UPDATE address SET ipaddress=ip, address1=addr1, address2=addr2, city=citys, state=states, postalcode=poscode, country=cont ,latitude=lat, longitude=lon where addressId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditAdmin` (IN `id` BIGINT(100), IN `usrnm` VARCHAR(30), IN `pass` VARCHAR(50), IN `slt` VARCHAR(10), IN `act` TINYINT)  NO SQL
BEGIN
	UPDATE admins SET username=usrnm, encrypted_password=pass, salt=slt, active=act where adminId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditAdminpriviledge`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditAdminpriviledge` (IN `id` INT, IN `adid` INT(11), IN `privid` BIGINT(50))  NO SQL
BEGIN
	UPDATE adminpriviledges SET adminId=adid, priviledgeId=privid where  adminpriviledgeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditBrand`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditBrand` (IN `id` BIGINT(100), IN `cid` BIGINT(100), IN `bname` VARCHAR(30), IN `picid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE brands SET brandcategoryId=cid, brand_name=bname, pictureId=picid, active=act where brandId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditBuyer`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditBuyer` (IN `id` BIGINT(100), IN `aaid` BIGINT(100), IN `fname` VARCHAR(50), IN `lname` VARCHAR(50), IN `aid` BIGINT(100), IN `rid` BIGINT(100), IN `wid` BIGINT(100), IN `iid` BIGINT(100), IN `bid` BIGINT(100))  NO SQL
BEGIN
	UPDATE users SET aaaId=aaid, first_name=fname, last_name=lname, addressId=aid, reachoutId=rid, walletId=wid, identityId=iid, blockId=bid where userId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditCart`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditCart` (IN `id` BIGINT(100), IN `uid` BIGINT(100), IN `pid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE carts SET productId=pid, userId=uid, updated_date=CURDATE(), active=act where cartId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditCategory` (IN `id` INT, IN `nm` VARCHAR(30), IN `ic` VARCHAR(30), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE categories SET name=nm, icon=ic, active=act where categoryId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditCreditcard`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditCreditcard` (IN `id` INT, IN `wid` BIGINT(100), IN `cn` VARCHAR(50), IN `cxm` VARCHAR(2), IN `cxy` VARCHAR(4))  NO SQL
BEGIN
	UPDATE creditcards SET card_number=cn, card_expMO=cxm, card_expYR=cxy, walletId=wid where creditcardId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditCreditcarddetail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditCreditcarddetail` (IN `id` INT, IN `tp` VARCHAR(30), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE creditcarddetails SET type=tp, active=act where creditcarddetailId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditDiscounttype`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditDiscounttype` (IN `id` INT, IN `tp` VARCHAR(20), IN `act` INT(4))  NO SQL
BEGIN
	UPDATE discounttypes SET type=tp, active=act where discounttypeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditFaq`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditFaq` (IN `id` INT, IN `qs` VARCHAR(200), IN `ans` TEXT, IN `pos` INT(11), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE faq SET question=qs, answer=ans, position=pos, active=act where faqId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditInventory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditInventory` (IN `id` BIGINT(100), IN `invn` VARCHAR(30), IN `sid` BIGINT(100), IN `bid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE inventory SET inventorynumber=invn, statusId=sid, blockId=bid, active=act where inventoryId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditOrder` (IN `id` BIGINT(100), IN `uid` BIGINT(100), IN `ordn` BIGINT(100), IN `pid` BIGINT(100), IN `sid` BIGINT(100), IN `bid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE orders SET ordernumber=ordn, userId=uid, purchaseId=pid, statusId=sid, blockId=bid, order_date=CURDATE(), active=act where orderId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditOrderdetail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditOrderdetail` (IN `id` BIGINT(100), IN `oid` BIGINT(100), IN `pid` BIGINT(100), IN `ordn` BIGINT(100), IN `dis` INT(11), IN `tp` INT(11), IN `sid` BIGINT(100), IN `staid` BIGINT(100), IN `bid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE orderdetails SET orderId=oid, productId=pid, ordernumber=ordn, discount=dis, totalprice=tp, shipperId=sid, ship_date=CURDATE(), statusId=staid, blockId=bid, active=act where orderdetailId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditPaypal`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditPaypal` (IN `id` BIGINT(100), IN `wid` BIGINT, IN `mail` VARCHAR(50))  NO SQL
BEGIN
	UPDATE paypal SET walletId=wid, email=mail where paypalId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditPicture`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditPicture` (IN `id` INT, IN `nm` VARCHAR(20), IN `pth` VARCHAR(50), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE pictures SET name=nm, path=pth,  active=act where pictureId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditPriviledge`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditPriviledge` (IN `id` INT, IN `nm` VARCHAR(20), IN `cc` TINYINT(4), IN `rr` TINYINT(4), IN `uu` TINYINT(4), IN `dd` TINYINT(4), IN `ext` TINYINT(4), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE priviledges SET name=nm, c=cc, r=rr, u=uu, d=dd, extra=ext, active=act where priviledgeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditProduct` (IN `id` INT, IN `supid` BIGINT, IN `proid` BIGINT, IN `iid` BIGINT, IN `nm` VARCHAR(50), IN `quan` INT(11), IN `mino` INT(11), IN `unitp` INT(11), IN `disc` INT(11), IN `rank` DECIMAL, IN `bid` BIGINT, IN `bloid` BIGINT, IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE products SET supplierId=supid, productdetailid=proid, inventoryid=iid, name=nm, quantity=quan, min_order=mino,unitprice=unitp ,discount=disc, ranking=rank, brandid=bid, blockid=bloid, active=act where productId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditProductdetail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditProductdetail` (IN `id` INT, IN `des` VARCHAR(200), IN `sz` VARCHAR(15), IN `col` VARCHAR(20), IN `wgt` INT(11), IN `bc` VARCHAR(30))  NO SQL
BEGIN
	UPDATE productdetails SET description=des, size=sz, color=col, weight=wgt, barcode=bc where productdetailId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditPurchases`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditPurchases` (IN `id` INT, IN `paidd` TINYINT(4), IN `pd` DATE, IN `tp` INT(11))  NO SQL
BEGIN
	UPDATE purchases SET paid=paidd, purchase_date=pd, total_price=tp, active=act where purchaseId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditReachout`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditReachout` (IN `id` INT, IN `uid` BIGINT, IN `phn` VARCHAR(15), IN `wapp` VARCHAR(15), IN `tele` VARCHAR(15), IN `mssg` VARCHAR(20), IN `skp` VARCHAR(20), IN `smss` VARCHAR(15))  NO SQL
BEGIN
	UPDATE reachout SET userId=uid, phone=phn, whatsapp=wapp, telegram=tele, messenger=mssg , skype=skp ,sms=smss where reachoutId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditRegisteredsupplier`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditRegisteredsupplier` (IN `id` BIGINT, IN `rn` VARCHAR(30), IN `ccid` BIGINT(100))  NO SQL
BEGIN
	UPDATE registeredsuppliers SET registered_name=rn, creditcardId=ccid where registeredsupplierId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditReview`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditReview` (IN `id` INT, IN `picid` BIGINT, IN `uid` BIGINT, IN `star` INT(11), IN `titles` VARCHAR(30), IN `des` VARCHAR(200), IN `pid` BIGINT, IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE reviews SET productId=pid, userId=uid, stars=star, title=titles, description=des, posted_date=CURDATE(), pictureId=picid, active=act where reviewId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditShipper`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditShipper` (IN `id` INT(100), IN `aaid` BIGINT(100), IN `adrid` BIGINT(100), IN `rid` BIGINT(100), IN `sid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE shippers SET aaaId=aaid, addressId=adrid, reachoutId=rid, shipperdetailsId=sid, active=act where shipperId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditShipperdetail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditShipperdetail` (IN `id` BIGINT, IN `nm` VARCHAR(30), IN `des` VARCHAR(255))  NO SQL
BEGIN
	UPDATE shipperdetails SET name=nm, description=des where shipperdetailId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditStatus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditStatus` (IN `id` INT, IN `stat` VARCHAR(20), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE admins SET status.status=stat, active=act where statusId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditStore`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditStore` (IN `id` BIGINT, IN `sid` BIGINT, IN `aid` BIGINT, IN `rid` BIGINT, IN `nm` VARCHAR(30), IN `des` VARCHAR(200), IN `thm` TINYINT(4), IN `bid` BIGINT, IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE stores SET supplierId=sid, addressId=aid, reachoutId=rid, name=nm, description=des, theme=thm, blockId=bid, active=act where storeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditSubcategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditSubcategory` (IN `id` BIGINT(100), IN `cid` BIGINT(100), IN `nm` VARCHAR(30), IN `ic` VARCHAR(30), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE subcategories SET categoryId=cid, name=nm, icon=ic, active=act where subcategoryId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditSubscriptionplan`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditSubscriptionplan` (IN `id` INT, IN `nm` VARCHAR(20))  NO SQL
BEGIN
	UPDATE subscriptionplans SET name=nm where subscriptionplanId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditSupplier`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditSupplier` (IN `id` BIGINT(100), IN `aaid` BIGINT(20), IN `spid` BIGINT(20), IN `dt` TINYINT(4), IN `rsid` BIGINT(100), IN `bid` BIGINT(100))  NO SQL
BEGIN
	UPDATE suppliers SET aaaId=aaid, subscriptionplanId=spid, discount_type=dt, registeredsupplierId=rsid, blockId=bid where supplierId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditTestimonial`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditTestimonial` (IN `id` BIGINT(100), IN `nm` VARCHAR(20), IN `des` VARCHAR(255), IN `pid` BIGINT(100), IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE testimonials SET name=nm, description=des, pictureId=pid, active=act where testimonialId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditWallet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditWallet` (IN `id` INT, IN `wtpid` INT, IN `act` TINYINT(4))  NO SQL
BEGIN
	UPDATE wallets SET wallettypeId=wtpid, active=act where walletId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_EditWalletType`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditWalletType` (IN `id` BIGINT(100), IN `type` VARCHAR(20), IN `act` TINYINT)  NO SQL
UPDATE wallettype SET wallettype=type,active=act WHERE wallettypeId=id$$

DROP PROCEDURE IF EXISTS `sp_EditWishlist`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditWishlist` (IN `id` INT, IN `act` TINYINT(4), IN `pid` BIGINT(100), IN `uid` BIGINT(100))  NO SQL
BEGIN
	UPDATE wishlists SET productId=pid, userId=uid, updated_date=CURDATE(), active=act where wishlistId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_FilterSearchProductsCategories`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_FilterSearchProductsCategories` (IN `keyword` VARCHAR(300))  NO SQL
SELECT DISTINCT categories.categoryId, categories.name FROM categories INNER join products ON categories.categoryId=products.categoryId WHERE products.name LIKE keyword and categories.active=1 AND products.active=1$$

DROP PROCEDURE IF EXISTS `sp_GetAAA`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAAA` ()  NO SQL
BEGIN
	SELECT *  FROM aaa;
END$$

DROP PROCEDURE IF EXISTS `sp_GetAAAByEmail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAAAByEmail` (IN `aaa_email` VARCHAR(30))  NO SQL
SELECT * FROM aaa WHERE email = aaa_email$$

DROP PROCEDURE IF EXISTS `sp_GetAAAById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAAAById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM aaa WHERE aaaId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetAddressbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAddressbyId` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM address WHERE addressId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetAddressBySupplierId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAddressBySupplierId` (IN `supId` BIGINT(100))  NO SQL
SELECT address.addressId, ipaddress, address1, address2, city, state, postalcode, country, latitude, longitude FROM address INNER JOIN aaa ON address.addressId= aaa.addressId INNER JOIN suppliers ON aaa.aaaId=suppliers.aaaId WHERE supplierId=supId$$

DROP PROCEDURE IF EXISTS `sp_GetAddresses`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAddresses` ()  NO SQL
BEGIN
SELECT * FROM address;
END$$

DROP PROCEDURE IF EXISTS `sp_GetAdminbyId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAdminbyId` (IN `id` BIGINT(100))  NO SQL
BEGIN
	SELECT * FROM admins WHERE adminId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetAdminByUsername`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAdminByUsername` (IN `admin_username` VARCHAR(30))  NO SQL
SELECT * FROM admins WHERE username = admin_username$$

DROP PROCEDURE IF EXISTS `sp_GetAdminpriviledgeById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAdminpriviledgeById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM adminpriviledges WHERE adminpriviledgeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetAdminpriviledges`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAdminpriviledges` ()  NO SQL
SELECT adminpriviledges.adminpriviledgeId,username,name, priviledges.c, priviledges.r, priviledges.u, priviledges.d,admins.adminId,priviledges.priviledgeId FROM adminpriviledges INNER join admins ON adminpriviledges.adminId=admins.adminId INNER JOIN priviledges ON priviledges.priviledgeId=adminpriviledges.adminpriviledgeId$$

DROP PROCEDURE IF EXISTS `sp_GetAdminpriviledgespriv`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAdminpriviledgespriv` (IN `adid` BIGINT(100))  NO SQL
SELECT priviledges.priviledgeId, adminpriviledges.adminpriviledgeId, priviledges.name, priviledges.c, priviledges.r, priviledges.u, priviledges.d, priviledges.extra, priviledges.active FROM priviledges INNER JOIN adminpriviledges ON priviledges.adminpriviledgeId=adminpriviledges.adminpriviledgeId WHERE adminpriviledges.adminpriviledgeId=adid$$

DROP PROCEDURE IF EXISTS `sp_GetAdmins`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAdmins` ()  NO SQL
BEGIN
	SELECT *  FROM admins;
END$$

DROP PROCEDURE IF EXISTS `sp_GetBestSellerProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetBestSellerProducts` ()  NO SQL
SELECT products.productId, products.name, products.quantity, products.min_order, products.unitprice, products.discount, products.ranking, products.blockId, products.active, productdetails.description,productdetails.size,productdetails.color,productdetails.weight,
productdetails.barcode,inventory.inventorynumber,brands.brand_name, products.productdetailId, products.inventoryId, products.brandId FROM products INNER join productdetails ON products.productdetailId=productdetails.productdetailId INNER join inventory ON inventory.inventoryId=products.inventoryId INNER join brands ON brands.brandId=products.brandId WHERE bestseller=1 LIMIT 8$$

DROP PROCEDURE IF EXISTS `sp_GetBrandById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetBrandById` (IN `id` BIGINT)  NO SQL
BEGIN
	SELECT * FROM brands WHERE brandId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetBrands`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetBrands` ()  NO SQL
SELECT brands.brandId, categories.name,brands.brand_name,pictures.name,categories.categoryId,pictures.pictureId AS picname,pictures.pictureId ,brands.active FROM brands INNER join categories ON brands.brandcategoryId=categories.categoryId INNER JOIN pictures ON pictures.pictureId=brands.pictureId$$

DROP PROCEDURE IF EXISTS `sp_GetBuyerById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetBuyerById` (IN `id` INT)  NO SQL
BEGIN
SELECT * FROM users WHERE userId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetBuyers`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetBuyers` ()  NO SQL
SELECT users.userId, users.first_name, users.last_name, aaa.email, address.address1,address.address2,address.city,address.state,address.country, reachout.phone,reachout.whatsapp, reachout.telegram,reachout.messenger,reachout.skype,reachout.sms,users.identityId,users.blockId FROM users INNER join aaa ON users.aaaId=aaa.aaaId INNER JOIN address ON address.addressId=users.addressId INNER JOIN reachout ON reachout.reachoutId = users.reachoutId$$

DROP PROCEDURE IF EXISTS `sp_GetCartById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCartById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM carts WHERE cartId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetCartByUserId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCartByUserId` (IN `usrId` BIGINT(100))  NO SQL
SELECT cartId, products.productId, name, quantity, unitprice, created_date FROM carts INNER JOIN products ON carts.productId=products.productId WHERE userId=usrId$$

DROP PROCEDURE IF EXISTS `sp_GetCartCount`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCartCount` (IN `usrId` BIGINT(100))  NO SQL
SELECT COUNT(cartId) as countc FROM carts INNER JOIN products ON carts.productId=products.productId WHERE userId=usrId$$

DROP PROCEDURE IF EXISTS `sp_GetCartProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCartProducts` (IN `cId` BIGINT(100))  NO SQL
SELECT products.productId, carts.cartId, productdetailId, inventoryId, name, quantity, min_order, unitprice, discount, ranking, brandId, products.blockId, carts.active FROM products INNER JOIN carts ON products.cartId=carts.cartId WHERE carts.cartId=1$$

DROP PROCEDURE IF EXISTS `sp_GetCarts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCarts` ()  NO SQL
SELECT carts.cartId, users.first_name, products.name, carts.created_date, carts.updated_date, carts.active, users.userId,products.productId FROM carts INNER join users ON users.userId=carts.userId INNER join products ON products.productId=carts.productId$$

DROP PROCEDURE IF EXISTS `sp_GetCategories`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCategories` ()  BEGIN
	SELECT *  FROM categories;
END$$

DROP PROCEDURE IF EXISTS `sp_GetCategoryById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCategoryById` (IN `CatId` BIGINT(100))  BEGIN
	SELECT *  FROM categories WHERE categoryId=CatId;
END$$

DROP PROCEDURE IF EXISTS `sp_GetCreditcardById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCreditcardById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM creditcards WHERE creditcardId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetCreditcarddetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCreditcarddetails` ()  NO SQL
BEGIN
SELECT * FROM creditcarddetails;
END$$

DROP PROCEDURE IF EXISTS `sp_GetCreditcarddetailsById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCreditcarddetailsById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM creditcarddetails WHERE creditcarddetailId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetCreditcards`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetCreditcards` ()  NO SQL
BEGIN
SELECT * FROM creditcards;
END$$

DROP PROCEDURE IF EXISTS `sp_GetDiscounttypeById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetDiscounttypeById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM discounttypes WHERE discounttypeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetDiscounttypes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetDiscounttypes` ()  NO SQL
BEGIN
SELECT * FROM discounttypes;
END$$

DROP PROCEDURE IF EXISTS `sp_GetFaqById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetFaqById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM faq WHERE faqId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetFaqs`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetFaqs` ()  NO SQL
BEGIN
SELECT * FROM faq;
END$$

DROP PROCEDURE IF EXISTS `sp_GetFeaturedProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetFeaturedProducts` ()  NO SQL
SELECT products.productId, products.name, products.quantity, products.min_order, products.unitprice, products.discount, products.ranking, products.blockId, products.active, productdetails.description,productdetails.size,productdetails.color,productdetails.weight,
productdetails.barcode,inventory.inventorynumber,brands.brand_name, products.productdetailId, products.inventoryId, products.brandId FROM products INNER join productdetails ON products.productdetailId=productdetails.productdetailId INNER join inventory ON inventory.inventoryId=products.inventoryId INNER join brands ON brands.brandId=products.brandId WHERE featured=1 LIMIT 8$$

DROP PROCEDURE IF EXISTS `sp_GetInventory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetInventory` ()  NO SQL
SELECT inventory.inventoryId, inventory.inventorynumber,status.status AS stat, inventory.blockId,inventory.active, status.statusId FROM inventory INNER join status ON status.statusId=inventory.inventoryId$$

DROP PROCEDURE IF EXISTS `sp_GetInventoryById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetInventoryById` (IN `id` BIGINT)  NO SQL
BEGIN
	SELECT * FROM inventory WHERE inventoryId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetLatestProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetLatestProducts` ()  NO SQL
SELECT products.productId, products.name, products.quantity, products.min_order, products.unitprice, products.discount, products.ranking, products.blockId, products.active, productdetails.description,productdetails.size,productdetails.color,productdetails.weight,
productdetails.barcode,inventory.inventorynumber,brands.brand_name, products.productdetailId, products.inventoryId, products.brandId FROM products INNER join productdetails ON products.productdetailId=productdetails.productdetailId INNER join inventory ON inventory.inventoryId=products.inventoryId INNER join brands ON brands.brandId=products.brandId ORDER BY products.productId DESC LIMIT 8$$

DROP PROCEDURE IF EXISTS `sp_GetOrderById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetOrderById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM orders WHERE orderId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetOrderdetailById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetOrderdetailById` (IN `id` BIGINT(100))  NO SQL
BEGIN
	SELECT * FROM orderdetails WHERE orderdetailId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetOrderdetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetOrderdetails` ()  NO SQL
SELECT orderdetails.orderdetailId, orderdetails.orderId, name, orderdetails.ordernumber, orderdetails.discount, status.status AS stat, orderdetails.totalprice, orderdetails.shipperId, orderdetails.ship_date, orderdetails.blockId, orderdetails.active,status.statusId,products.productId, orders.orderId FROM orderdetails INNER join status ON status.statusId=orderdetails.statusId INNER join products ON products.productId=orderdetails.orderdetailId INNER join orders ON orders.orderId=orderdetails.orderId$$

DROP PROCEDURE IF EXISTS `sp_GetOrders`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetOrders` ()  NO SQL
SELECT orders.orderId, users.first_name,users.last_name, orders.ordernumber, orders.active, orders.order_date, status.status AS stat, orders.blockId, purchases.paid, purchases.purchase_date, purchases.total_price, users.userId, purchases.purchaseId, status.statusId FROM orders INNER join users ON users.userId=orders.userId INNER join purchases ON purchases.purchaseId=orders.purchaseId INNER join status ON status.statusId=orders.statusId$$

DROP PROCEDURE IF EXISTS `sp_GetPaypal`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPaypal` ()  NO SQL
BEGIN
SELECT * FROM paypal;
END$$

DROP PROCEDURE IF EXISTS `sp_GetPaypalById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPaypalById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM paypal WHERE paypalId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetPictureById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPictureById` (IN `id` BIGINT)  NO SQL
BEGIN
	SELECT * FROM pictures WHERE pictureId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetPictures`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPictures` ()  NO SQL
BEGIN
SELECT * FROM pictures;
END$$

DROP PROCEDURE IF EXISTS `sp_GetPriviledgeById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPriviledgeById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM priviledges WHERE priviledgeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetPriviledges`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPriviledges` ()  NO SQL
BEGIN
SELECT * FROM priviledges;
END$$

DROP PROCEDURE IF EXISTS `sp_GetProductById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetProductById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM products WHERE productId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetProductdetailById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetProductdetailById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM productdetails WHERE productdetailId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetProductdetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetProductdetails` ()  NO SQL
BEGIN
SELECT * FROM productdetails;
END$$

DROP PROCEDURE IF EXISTS `sp_GetProductPic`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetProductPic` (IN `pid` BIGINT(100))  NO SQL
SELECT path from product_pictures WHERE productId=pid AND active=1$$

DROP PROCEDURE IF EXISTS `sp_GetProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetProducts` ()  NO SQL
SELECT products.productId, products.name, products.quantity, products.min_order, products.unitprice, products.discount, products.ranking, products.blockId, products.active, productdetails.description,productdetails.size,productdetails.color,productdetails.weight,
productdetails.barcode,inventory.inventorynumber,brands.brand_name, products.productdetailId, products.inventoryId, products.brandId FROM products INNER join productdetails ON products.productdetailId=productdetails.productdetailId INNER join inventory ON inventory.inventoryId=products.inventoryId INNER join brands ON brands.brandId=products.brandId$$

DROP PROCEDURE IF EXISTS `sp_GetReachout`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetReachout` ()  NO SQL
SELECT reachout.reachoutId, users.first_name, reachout.phone, reachout.whatsapp, reachout.telegram, reachout.messenger, reachout.skype, reachout.sms, users.userId FROM reachout INNER join users ON users.userId=reachout.reachoutId$$

DROP PROCEDURE IF EXISTS `sp_GetReachoutById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetReachoutById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM reachout WHERE reachoutId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetRegisteredsupplierById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetRegisteredsupplierById` (IN `id` BIGINT)  NO SQL
BEGIN
	SELECT * FROM registeredsuppliers WHERE registeredsupplierId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetRegisteredsuppliers`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetRegisteredsuppliers` ()  NO SQL
BEGIN
SELECT * FROM registeredsuppliers;
END$$

DROP PROCEDURE IF EXISTS `sp_GetReviewById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetReviewById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM reviews WHERE reviewId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetReviews`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetReviews` ()  NO SQL
SELECT reviews.reviewId, products.name AS proname, users.first_name,reviews.stars, reviews.title,reviews.active , reviews.description,reviews.posted_date, pictures.name AS picname, pictures.path, products.productId, users.userId, pictures.pictureId FROM reviews INNER join products ON products.productId=reviews.productId INNER join users ON users.userId=reviews.userId INNER join pictures ON pictures.pictureId=reviews.pictureId$$

DROP PROCEDURE IF EXISTS `sp_GetSettings`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetSettings` ()  NO SQL
SELECT * FROM settings$$

DROP PROCEDURE IF EXISTS `sp_GetShipperById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetShipperById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM shippers WHERE shipperId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetShipperdetailById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetShipperdetailById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM shipperdetails WHERE shipperdetailId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetShipperdetails`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetShipperdetails` ()  NO SQL
BEGIN
SELECT * FROM shipperdetails;
END$$

DROP PROCEDURE IF EXISTS `sp_GetShippers`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetShippers` ()  NO SQL
SELECT shippers.shipperId,email,phone,name,shippers.active,aaa.aaaId,address.address1, address.address2,address.city,address.country,reachout.phone,reachout.whatsapp,reachout.telegram,reachout.skype, reachout.messenger,reachout.sms,shipperdetails.shipperdetailId, address.addressId,reachout.reachoutId FROM shippers INNER join aaa ON shippers.aaaId=aaa.aaaId INNER JOIN reachout ON reachout.reachoutId=shippers.reachoutId INNER JOIN shipperdetails ON shippers.shipperdetailsId=shipperdetails.shipperdetailId INNER JOIN address ON shippers.addressId=address.addressId$$

DROP PROCEDURE IF EXISTS `sp_GetStatus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetStatus` ()  NO SQL
BEGIN
SELECT * FROM status;
END$$

DROP PROCEDURE IF EXISTS `sp_GetStatusById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetStatusById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM status WHERE statusId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetStoreById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetStoreById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM stores WHERE storeId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetStoreBySupplierId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetStoreBySupplierId` (IN `supId` BIGINT(100))  NO SQL
SELECT stores.storeId, stores.name, stores.description, address.address1 FROM stores INNER JOIN address ON stores.addressId = address.addressId WHERE supplierId=supId AND stores.active=1$$

DROP PROCEDURE IF EXISTS `sp_GetStores`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetStores` ()  NO SQL
SELECT storeId,supplierId,stores.addressId,address1,city,country,stores.reachoutId,name,description,theme,blockId,active,reachout.phone FROM stores INNER JOIN  address ON stores.addressId=address.addressId INNER JOIN reachout ON stores.reachoutId=reachout.reachoutId$$

DROP PROCEDURE IF EXISTS `sp_GetSubcategories`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetSubcategories` ()  NO SQL
BEGIN
SELECT subcategoryId,categories.name as category_name,subcategories.name,subcategories.icon,subcategories.active FROM subcategories INNER JOIN categories ON subcategories.categoryId=categories.categoryId;
END$$

DROP PROCEDURE IF EXISTS `sp_GetSubcategoriesById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetSubcategoriesById` (IN `id` BIGINT)  NO SQL
SELECT * FROM subcategories WHERE subcategoryId=id AND active=1$$

DROP PROCEDURE IF EXISTS `sp_GetSubcategoryByCategoryId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetSubcategoryByCategoryId` (IN `catId` BIGINT(100))  NO SQL
SELECT * FROM subcategories WHERE categoryId=catId AND active=1$$

DROP PROCEDURE IF EXISTS `sp_GetSubscriptionplanById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetSubscriptionplanById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM subscriptionplans WHERE subscriptionplanId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetSubscriptionplans`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetSubscriptionplans` ()  NO SQL
SELECT subscriptionplans.subscriptionplanId, purchases.purchaseId, subscriptionplans.name, purchases.paid, purchases.purchase_date, purchases.total_price FROM subscriptionplans INNER join purchases ON purchases.purchaseId=subscriptionplans.purchaseId$$

DROP PROCEDURE IF EXISTS `sp_GetSupplierById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetSupplierById` (IN `id` INT)  NO SQL
BEGIN
	SELECT supplierId, subscriptionplanId, discount_type, registeredsupplierId,first_name  FROM suppliers INNER JOIN users ON suppliers.aaaId=users.aaaId WHERE supplierId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetSupplierProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetSupplierProducts` (IN `supId` BIGINT(100))  NO SQL
SELECT productId, suppliers.supplierId, productdetailId, inventoryId, name, quantity, min_order, unitprice, discount, ranking, brandId, products.blockId, active FROM products INNER JOIN suppliers ON products.supplierId=suppliers.supplierId WHERE suppliers.supplierId=supId$$

DROP PROCEDURE IF EXISTS `sp_GetSuppliers`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetSuppliers` ()  NO SQL
BEGIN
	SELECT suppliers.supplierId,aaa.aaaId,email,name,type,registered_name,suppliers.blockId, subscriptionplans.subscriptionplanId, registeredsuppliers.registeredsupplierId FROM suppliers INNER join aaa ON suppliers.aaaId=aaa.aaaId INNER JOIN subscriptionplans ON subscriptionplans.subscriptionplanId=suppliers.subscriptionplanId INNER JOIN discounttypes ON discounttypes.discounttypeId = suppliers.discount_type INNER JOIN registeredsuppliers ON registeredsuppliers.registeredsupplierId = suppliers.registeredsupplierId;
END$$

DROP PROCEDURE IF EXISTS `sp_GetTestimonialById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetTestimonialById` (IN `id` BIGINT)  NO SQL
BEGIN
	SELECT * FROM testimonials WHERE testimonialId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetTestimonials`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetTestimonials` ()  NO SQL
SELECT testimonials.testimonialId, pictures.name AS picname, pictures.path, testimonials.name, testimonials.active, testimonials.description, pictures.pictureId FROM testimonials INNER join pictures ON pictures.pictureId=testimonials.testimonialId$$

DROP PROCEDURE IF EXISTS `sp_GetWallet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetWallet` ()  NO SQL
SELECT wallets.walletId, wallettype.wallettype, wallets.active FROM wallets INNER join wallettype ON wallettype.wallettypeId=wallets.wallettypeId$$

DROP PROCEDURE IF EXISTS `sp_GetWalletById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetWalletById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM wallets WHERE walletId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetWalletTypeById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetWalletTypeById` (IN `id` BIGINT(100))  NO SQL
SELECT * FROM wallettype WHERE wallettypeId=id$$

DROP PROCEDURE IF EXISTS `sp_GetWalletTypes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetWalletTypes` ()  NO SQL
SELECT * FROM wallettype$$

DROP PROCEDURE IF EXISTS `sp_GetWishlistById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetWishlistById` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM wishlists WHERE wishlistId=id;
END$$

DROP PROCEDURE IF EXISTS `sp_GetWishlistByUserId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetWishlistByUserId` (IN `usrId` BIGINT(100))  NO SQL
SELECT wishlistId, products.productId, name, quantity, unitprice, created_date FROM wishlists INNER JOIN products ON wishlists.productId=products.productId WHERE userId=usrId$$

DROP PROCEDURE IF EXISTS `sp_GetWishlists`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetWishlists` ()  NO SQL
SELECT wishlists.wishlistId, users.first_name, products.name, wishlists.created_date, wishlists.updated_date, wishlists.active, users.userId,products.productId FROM wishlists INNER join users ON users.userId=wishlists.userId INNER join products ON products.productId=wishlists.productId$$

DROP PROCEDURE IF EXISTS `sp_IsExistAAA`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_IsExistAAA` (IN `aaa_email` VARCHAR(50))  NO SQL
SELECT aaaId FROM aaa WHERE email=aaa_email$$

DROP PROCEDURE IF EXISTS `sp_IsExistCart`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_IsExistCart` (IN `usrId` BIGINT(100), IN `proId` BIGINT(100))  NO SQL
SELECT * FROM carts WHERE userId=usrId and productId=proId$$

DROP PROCEDURE IF EXISTS `sp_IsExistWishlist`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_IsExistWishlist` (IN `usrId` BIGINT(100), IN `proId` BIGINT(100))  NO SQL
SELECT * FROM wishlists WHERE userId=usrId and productId=proId$$

DROP PROCEDURE IF EXISTS `sp_IsLoginAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_IsLoginAdmin` (IN `id` INT(11))  NO SQL
SELECT login FROM admins WHERE adminId=id AND login=1$$

DROP PROCEDURE IF EXISTS `sp_LoginAAA`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_LoginAAA` (IN `id` BIGINT(100))  NO SQL
UPDATE aaa SET login=1 WHERE aaa=id$$

DROP PROCEDURE IF EXISTS `sp_LoginAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_LoginAdmin` (IN `id` INT(11))  NO SQL
UPDATE admins SET login=1 WHERE adminId=id$$

DROP PROCEDURE IF EXISTS `sp_LogoutAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_LogoutAdmin` (IN `id` INT(11))  NO SQL
UPDATE admins SET login=0 WHERE adminId=id$$

DROP PROCEDURE IF EXISTS `sp_SearchBrand`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SearchBrand` (IN `keyword` VARCHAR(300))  NO SQL
SELECT brands.brandId, categories.name,brands.brand_name,pictures.name,categories.categoryId,pictures.pictureId AS picname,pictures.pictureId ,brands.active FROM brands INNER join categories ON brands.brandcategoryId=categories.categoryId INNER JOIN pictures ON pictures.pictureId=brands.pictureId WHERE brands.brand_name LIKE keyword$$

DROP PROCEDURE IF EXISTS `sp_SearchProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SearchProducts` (IN `keyword` VARCHAR(300))  NO SQL
SELECT products.productId, products.name, products.quantity, products.min_order, products.unitprice, products.discount, products.ranking, products.blockId, products.active, productdetails.description,productdetails.size,productdetails.color,productdetails.weight,
productdetails.barcode,inventory.inventorynumber,brands.brand_name, products.productdetailId, products.inventoryId, products.brandId FROM products INNER join productdetails ON products.productdetailId=productdetails.productdetailId INNER join inventory ON inventory.inventoryId=products.inventoryId INNER join brands ON brands.brandId=products.brandId WHERE products.name LIKE keyword$$

DROP PROCEDURE IF EXISTS `sp_SearchSuppliers`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SearchSuppliers` (IN `keyword` VARCHAR(300))  NO SQL
SELECT suppliers.supplierId,aaa.aaaId,email,name,type,registered_name,suppliers.blockId, subscriptionplans.subscriptionplanId, registeredsuppliers.registeredsupplierId FROM suppliers INNER join aaa ON suppliers.aaaId=aaa.aaaId INNER JOIN subscriptionplans ON subscriptionplans.subscriptionplanId=suppliers.subscriptionplanId INNER JOIN discounttypes ON discounttypes.discounttypeId = suppliers.discount_type INNER JOIN registeredsuppliers ON registeredsuppliers.registeredsupplierId = suppliers.registeredsupplierId WHERE email LIKE keyword$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aaa`
--

DROP TABLE IF EXISTS `aaa`;
CREATE TABLE IF NOT EXISTS `aaa` (
  `aaaId` bigint(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `encrypted_password` varchar(50) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `activation_code` varchar(50) NOT NULL,
  `activation_salt` varchar(10) NOT NULL,
  `otp` bigint(100) NOT NULL,
  `addressId` bigint(100) NOT NULL,
  `login` tinyint(4) NOT NULL,
  PRIMARY KEY (`aaaId`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aaa`
--

INSERT INTO `aaa` (`aaaId`, `email`, `encrypted_password`, `salt`, `activation_code`, `activation_salt`, `otp`, `addressId`, `login`) VALUES
(1, 'ibrahim@gmail.com', 'UsMEORAaRIM/cCShROaTUX1dIndkODJiNGI1M2Nl', 'd82b4b53ce', '1', '1', 0, 1, 0),
(2, 'ibra@test.com', 'CiGi6mSsVaQvQVaSmSTETGq8t1JiYjViZThmY2Ey', 'bb5be8fca2', '1', '1', 0, 0, 0),
(47, 'ibra@test11.com', '4wcFUBD6Zvlt10iQbhbPkjTuL6owYjZkOGIzYzY3', '0b6d8b3c67', '1', '1', 0, 0, 0),
(48, 'sup1@jb.com', '147147', '147', '147147', '147', 1, 1, 0),
(49, 'sup2@jb.com', '147147', '147', '147147', '147', 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `addressId` bigint(100) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(30) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `postalcode` varchar(15) NOT NULL,
  `country` varchar(20) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  PRIMARY KEY (`addressId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `ipaddress`, `address1`, `address2`, `city`, `state`, `postalcode`, `country`, `latitude`, `longitude`) VALUES
(1, '192.168.0.123', 'adr11', 'adr12', 'city1', 'state1', '111', 'cont1', 25.0687, 55.1451),
(2, '192.168.0.121', 'ads21', 'ads22', 'city2', 'state2', '222', 'contry2', 25.0688, 55.1561);

-- --------------------------------------------------------

--
-- Table structure for table `adminpriviledges`
--

DROP TABLE IF EXISTS `adminpriviledges`;
CREATE TABLE IF NOT EXISTS `adminpriviledges` (
  `adminpriviledgeId` bigint(100) NOT NULL AUTO_INCREMENT,
  `adminId` int(11) NOT NULL,
  `priviledgeId` bigint(50) NOT NULL,
  PRIMARY KEY (`adminpriviledgeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `encrypted_password` varchar(50) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `login` tinyint(4) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminId`, `username`, `encrypted_password`, `salt`, `active`, `login`, `created_date`) VALUES
(11, 'Ibra', '46KmhM/qbzvHinl72Yo66qnvLY80ZGQ0ZWI2NWVk', '4dd4eb65ed', 1, 1, '2020-05-16'),
(14, 'adminjb', 'vxnJhLSSGxPvwGKYD1+QEbAMfUI2MGEzNmEzYzg1', '60a36a3c85', 1, 1, '2020-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `brandcategory`
--

DROP TABLE IF EXISTS `brandcategory`;
CREATE TABLE IF NOT EXISTS `brandcategory` (
  `brandcategoryId` bigint(100) NOT NULL AUTO_INCREMENT,
  `categoryId` bigint(100) NOT NULL,
  `brandId` bigint(100) NOT NULL,
  PRIMARY KEY (`brandcategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `brandId` bigint(100) NOT NULL AUTO_INCREMENT,
  `brandcategoryId` bigint(20) NOT NULL,
  `brand_name` varchar(30) NOT NULL,
  `pictureId` bigint(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`brandId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brandId`, `brandcategoryId`, `brand_name`, `pictureId`, `active`) VALUES
(1, 1, 'DIOR', 1, 1),
(2, 2, 'HUGO BOSS', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `cartId` bigint(100) NOT NULL AUTO_INCREMENT,
  `userId` bigint(100) NOT NULL,
  `productId` bigint(100) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`cartId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cartId`, `userId`, `productId`, `created_date`, `updated_date`, `active`) VALUES
(6, 1, 1, '2020-06-10', '2020-06-10', 1),
(7, 1, 3, '2020-06-13', '2020-06-13', 1),
(8, 1, 6, '2020-06-13', '2020-06-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categoryId` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `active` tinytext NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `name`, `icon`, `active`) VALUES
(1, 'Beauty', 'icon.png', '1'),
(2, 'Care', 'icon.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `creditcarddetails`
--

DROP TABLE IF EXISTS `creditcarddetails`;
CREATE TABLE IF NOT EXISTS `creditcarddetails` (
  `creditcarddetailId` bigint(100) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`creditcarddetailId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `creditcards`
--

DROP TABLE IF EXISTS `creditcards`;
CREATE TABLE IF NOT EXISTS `creditcards` (
  `creditcardId` bigint(100) NOT NULL AUTO_INCREMENT,
  `walletId` bigint(100) NOT NULL,
  `card_number` bigint(50) NOT NULL,
  `card_expMO` int(2) NOT NULL,
  `card_expYR` int(4) NOT NULL,
  `creditcarddetailId` bigint(100) NOT NULL,
  PRIMARY KEY (`creditcardId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discounttypes`
--

DROP TABLE IF EXISTS `discounttypes`;
CREATE TABLE IF NOT EXISTS `discounttypes` (
  `discounttypeId` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`discounttypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discounttypes`
--

INSERT INTO `discounttypes` (`discounttypeId`, `type`, `active`) VALUES
(1, 'distype1', 1),
(2, 'distype2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `faqId` bigint(100) NOT NULL AUTO_INCREMENT,
  `question` varchar(200) NOT NULL,
  `answer` text NOT NULL,
  `position` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`faqId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faqId`, `question`, `answer`, `position`, `active`) VALUES
(1, 'qwe1asd1', 'sdddsdd', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `inventoryId` bigint(100) NOT NULL AUTO_INCREMENT,
  `inventorynumber` varchar(30) NOT NULL,
  `statusId` tinyint(4) NOT NULL,
  `blockId` bigint(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`inventoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventoryId`, `inventorynumber`, `statusId`, `blockId`, `active`) VALUES
(1, '1', 1, 1, 1),
(2, '2', 1, 1, 1),
(3, '3', 1, 1, 1),
(4, '4', 1, 1, 1),
(5, '5', 1, 1, 1),
(6, '6', 1, 1, 1),
(7, '7', 1, 1, 1),
(8, '8', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE IF NOT EXISTS `orderdetails` (
  `orderdetailId` bigint(100) NOT NULL AUTO_INCREMENT,
  `orderId` bigint(100) NOT NULL,
  `productId` bigint(100) NOT NULL,
  `ordernumber` bigint(100) NOT NULL,
  `discount` int(11) NOT NULL,
  `totalprice` int(11) NOT NULL,
  `shipperId` bigint(100) NOT NULL,
  `ship_date` date NOT NULL,
  `statusId` tinyint(4) NOT NULL,
  `blockId` bigint(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`orderdetailId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` bigint(100) NOT NULL AUTO_INCREMENT,
  `userId` bigint(100) NOT NULL,
  `ordernumber` bigint(100) NOT NULL,
  `purchaseId` bigint(100) NOT NULL,
  `order_date` date NOT NULL,
  `statusId` tinyint(4) NOT NULL,
  `blockId` bigint(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `paypal`
--

DROP TABLE IF EXISTS `paypal`;
CREATE TABLE IF NOT EXISTS `paypal` (
  `paypalId` bigint(100) NOT NULL AUTO_INCREMENT,
  `walletId` bigint(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`paypalId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `pictureId` bigint(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `path` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`pictureId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`pictureId`, `name`, `path`, `active`) VALUES
(1, 'brand-dior', 'brands/dior.png', 1),
(2, 'brand-higoboss', 'brands/hugoboss.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `priviledges`
--

DROP TABLE IF EXISTS `priviledges`;
CREATE TABLE IF NOT EXISTS `priviledges` (
  `priviledgeId` bigint(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `c` tinyint(4) NOT NULL,
  `r` tinyint(4) NOT NULL,
  `u` tinyint(4) NOT NULL,
  `d` tinyint(4) NOT NULL,
  `extra` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `adminpriviledgeId` bigint(100) NOT NULL,
  PRIMARY KEY (`priviledgeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

DROP TABLE IF EXISTS `productdetails`;
CREATE TABLE IF NOT EXISTS `productdetails` (
  `productdetailId` bigint(100) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) NOT NULL,
  `size` varchar(15) NOT NULL,
  `color` varchar(20) NOT NULL,
  `weight` int(11) NOT NULL,
  `barcode` varchar(30) NOT NULL,
  PRIMARY KEY (`productdetailId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`productdetailId`, `description`, `size`, `color`, `weight`, `barcode`) VALUES
(1, 'Blend of mandarin orange, orange blossom, night blooming cereus notes ', '50 ml', '0', 0, '3348901206167'),
(2, 'A floral fruity fragrance for young women Crisp, sweet, creamy, delectable & enchanting Top notes of cranberry, bergamot, cherry & orange Heart notes of jasmine from India & Egypt, ylang-ylang, rose & bitter almond Base notes of cedar, vanilla & white musk Launched in 2013 Perfect for all occasions ', '50ml', '0', 0, '3348901135092'),
(3, 'Launched by the design house of Christian Dior in the year 1956 \r\nThis floral fragrance has a blend of jasmine, lily of the valley, ylang-ylang, amaryllis, and boronia notes \r\nIt is recommended for daytime wear ', '100ml', '0', 0, '3348900314290'),
(4, 'Launched by the design house of Christian Dior in the year 1966. This floral fragrance has a blend of lemon, basil, bergamot, cumin, lavender, jasmine, rose, carnation, iris root, coriander, patchouli, sandalwood, oak moss, musk, and amber notes. ', '100ml', '0', 0, '3348900627499'),
(5, 'Inspired by the professional illuminating techniques and expertise of its makeup artists, Dior invents Diorskin Star, its 1st brightening foundation: a weightless fluid capable of instantly and lastingly recreating the spectacular and perfecting light of Dior studios.', '30ml', '0', 0, '0'),
(6, 'For 24 hours,* complexion coverage remains flawless. The skin\'s texture appears tightened and refined, with a velvety matte finish without a mask-like effect. \r\nThis foundation works like a skincare cream, protecting from drying and shielding the skin against exterior aggressors and UVA and UVB rays with SPF 35 PA+++ protection.\r\n\r\nDior Forever provides the skin with a velvety matte finish. Dior Forever is also available in Dior Forever Skin Glow for a radiant finish. \r\n', '30ml', '0', 0, '0'),
(7, 'For 24 hours,* complexion coverage remains flawless. The complexion is radiant and even. The skin appears plumped and its texture tightened. From morning to night, the perfect water-oil balance delivers a naturally vibrant, shine-free glow. The skin is protected from exterior aggressors and UVA and UVB rays with SPF 35 PA++ protection.', '30ml', '0', 0, '0'),
(8, 'Full coverage\r\n24-hour* wear\r\nSecond-skin matte finish', '40ml', '0', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productId` bigint(100) NOT NULL AUTO_INCREMENT,
  `categoryId` bigint(100) NOT NULL,
  `subcategoryId` bigint(100) NOT NULL,
  `supplierId` bigint(100) NOT NULL,
  `productdetailId` bigint(100) NOT NULL,
  `inventoryId` bigint(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `min_order` int(11) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `discount` tinyint(4) NOT NULL,
  `ranking` decimal(10,0) NOT NULL,
  `brandId` bigint(100) NOT NULL,
  `blockId` bigint(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `bestseller` tinyint(4) NOT NULL,
  `featured` tinyint(4) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `categoryId`, `subcategoryId`, `supplierId`, `productdetailId`, `inventoryId`, `name`, `quantity`, `min_order`, `unitprice`, `discount`, `ranking`, `brandId`, `blockId`, `active`, `bestseller`, `featured`) VALUES
(1, 1, 1, 1, 1, 1, 'DIOR ADDICT (W) EDT 50ML', 300, 15, 25, 0, '4', 1, 1, 1, 0, 1),
(2, 1, 2, 1, 2, 2, 'DIOR ADDICT EAU DELICE EDT 50ML (D)', 50, 5, 30, 0, '5', 1, 1, 1, 0, 1),
(3, 1, 1, 1, 3, 3, 'DIOR DIORISSIMO (W) EDT 100ML', 1000, 100, 23, 1, '2', 1, 1, 1, 1, 0),
(4, 2, 3, 1, 4, 4, 'DIOR EAU SAUVAGE (M) EDT 100ML', 500, 10, 12, 1, '5', 1, 1, 1, 1, 0),
(5, 2, 3, 2, 5, 5, 'DIORSKIN STAR', 120, 5, 20, 0, '4', 1, 1, 1, 1, 0),
(6, 1, 1, 2, 6, 6, 'DIORSKIN FOREVER FLUIDE ', 1000, 10, 15, 0, '5', 2, 1, 1, 1, 0),
(7, 1, 2, 2, 7, 7, 'DIORSKIN FOREVER GLOW', 1000, 10, 10, 1, '2', 2, 1, 1, 0, 1),
(8, 1, 2, 2, 8, 8, 'DIORSKIN FOREVER UNDERCOVER', 1500, 15, 15, 1, '1', 2, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_pictures`
--

DROP TABLE IF EXISTS `product_pictures`;
CREATE TABLE IF NOT EXISTS `product_pictures` (
  `product_pictureId` bigint(100) NOT NULL AUTO_INCREMENT,
  `productId` bigint(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`product_pictureId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_pictures`
--

INSERT INTO `product_pictures` (`product_pictureId`, `productId`, `name`, `path`, `active`) VALUES
(1, 1, 'DIOR ADDICT (W) EDT 50ML', 'products/3348901206167.jpg', 1),
(2, 2, 'DIOR ADDICT EAU DELICE EDT 50ML (D)', 'products/3348901135092.jpg', 1),
(3, 3, 'DIOR DIORISSIMO (W) EDT 100ML', 'products/3348900314290.jpg', 1),
(4, 4, 'DIOR EAU SAUVAGE (M) EDT 100ML', 'products/3348900627499.jpg', 1),
(5, 5, 'DIORSKIN STAR', 'products/B00NHOR85G.jpg', 1),
(6, 6, 'DIORSKIN FOREVER FLUIDE ', 'products/3348901326155.jpg', 1),
(7, 7, 'DIORSKIN FOREVER GLOW', 'products/3348901326162.jpg', 1),
(8, 8, 'DIORSKIN FOREVER UNDERCOVER', 'products/3348901341165.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchaseId` bigint(100) NOT NULL AUTO_INCREMENT,
  `paid` tinyint(4) NOT NULL,
  `purchase_date` date NOT NULL,
  `total_price` int(11) NOT NULL,
  PRIMARY KEY (`purchaseId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchaseId`, `paid`, `purchase_date`, `total_price`) VALUES
(1, 1, '2020-05-18', 50);

-- --------------------------------------------------------

--
-- Table structure for table `reachout`
--

DROP TABLE IF EXISTS `reachout`;
CREATE TABLE IF NOT EXISTS `reachout` (
  `reachoutId` bigint(100) NOT NULL AUTO_INCREMENT,
  `userId` bigint(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `whatsapp` varchar(15) NOT NULL,
  `telegram` varchar(15) NOT NULL,
  `messenger` varchar(20) NOT NULL,
  `skype` varchar(20) NOT NULL,
  `sms` varchar(15) NOT NULL,
  PRIMARY KEY (`reachoutId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reachout`
--

INSERT INTO `reachout` (`reachoutId`, `userId`, `phone`, `whatsapp`, `telegram`, `messenger`, `skype`, `sms`) VALUES
(1, 1, '148', '248', '348', '548', '648', '748'),
(2, 2, '149', '249', '349', '449', '549', '649');

-- --------------------------------------------------------

--
-- Table structure for table `registeredsuppliers`
--

DROP TABLE IF EXISTS `registeredsuppliers`;
CREATE TABLE IF NOT EXISTS `registeredsuppliers` (
  `registeredsupplierId` bigint(100) NOT NULL AUTO_INCREMENT,
  `registered_name` varchar(30) NOT NULL,
  `creditcardId` bigint(100) NOT NULL,
  PRIMARY KEY (`registeredsupplierId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registeredsuppliers`
--

INSERT INTO `registeredsuppliers` (`registeredsupplierId`, `registered_name`, `creditcardId`) VALUES
(1, 'regsub1', 1),
(2, 'regsub2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `reviewId` bigint(100) NOT NULL AUTO_INCREMENT,
  `productId` bigint(100) NOT NULL,
  `userId` bigint(100) NOT NULL,
  `stars` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `posted_date` date NOT NULL,
  `pictureId` bigint(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`reviewId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `settingsId` bigint(50) NOT NULL AUTO_INCREMENT,
  `aboutus` text NOT NULL,
  PRIMARY KEY (`settingsId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settingsId`, `aboutus`) VALUES
(1, 'Tyna Giang\'s integrated agro-forestry farming model is the first project in Vietnam to achieve the highest ranking in the \"100 projects to combat climate change\" by the Ministry of Environment, Energy and Sea. France organized in 2016 ...\r\n\r\nNemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Neque porro quisquam est, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem\r\n\r\nNemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Neque porro quisquam est');

-- --------------------------------------------------------

--
-- Table structure for table `shipperdetails`
--

DROP TABLE IF EXISTS `shipperdetails`;
CREATE TABLE IF NOT EXISTS `shipperdetails` (
  `shipperdetailId` bigint(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`shipperdetailId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shippers`
--

DROP TABLE IF EXISTS `shippers`;
CREATE TABLE IF NOT EXISTS `shippers` (
  `shipperId` bigint(100) NOT NULL AUTO_INCREMENT,
  `aaaId` bigint(100) NOT NULL,
  `addressId` bigint(100) NOT NULL,
  `reachoutId` bigint(100) NOT NULL,
  `shipperdetailsId` bigint(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`shipperId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `statusId` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`statusId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusId`, `status`, `active`) VALUES
(1, 'status1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `storeId` bigint(100) NOT NULL AUTO_INCREMENT,
  `supplierId` bigint(100) NOT NULL,
  `addressId` bigint(100) NOT NULL,
  `reachoutId` bigint(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `theme` tinyint(4) NOT NULL,
  `blockId` bigint(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`storeId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`storeId`, `supplierId`, `addressId`, `reachoutId`, `name`, `description`, `theme`, `blockId`, `active`) VALUES
(1, 1, 1, 1, 'Store1', 'Store description', 1, 1, 1),
(2, 1, 2, 2, 'Store2', 'Store description 2', 1, 1, 1),
(3, 1, 1, 1, 'Store 3', 'Store 3 description', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE IF NOT EXISTS `subcategories` (
  `subcategoryId` bigint(100) NOT NULL AUTO_INCREMENT,
  `categoryId` bigint(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`subcategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcategoryId`, `categoryId`, `name`, `icon`, `active`) VALUES
(1, 1, 'perfume', 'icon.png', 1),
(2, 1, 'cosmatics', 'icon.png', 1),
(3, 2, 'SKIN', 'icon.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionplans`
--

DROP TABLE IF EXISTS `subscriptionplans`;
CREATE TABLE IF NOT EXISTS `subscriptionplans` (
  `subscriptionplanId` bigint(100) NOT NULL AUTO_INCREMENT,
  `purchaseId` bigint(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`subscriptionplanId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriptionplans`
--

INSERT INTO `subscriptionplans` (`subscriptionplanId`, `purchaseId`, `name`) VALUES
(1, 1, 'subp1'),
(2, 2, 'subplan2');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplierId` bigint(100) NOT NULL AUTO_INCREMENT,
  `aaaId` bigint(20) NOT NULL,
  `subscriptionplanId` bigint(20) NOT NULL,
  `discount_type` tinyint(4) NOT NULL,
  `registeredsupplierId` bigint(100) NOT NULL,
  `blockId` bigint(100) NOT NULL,
  PRIMARY KEY (`supplierId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplierId`, `aaaId`, `subscriptionplanId`, `discount_type`, `registeredsupplierId`, `blockId`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `testimonialId` bigint(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `pictureId` bigint(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`testimonialId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` bigint(100) NOT NULL AUTO_INCREMENT,
  `aaaId` bigint(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `addressId` bigint(100) NOT NULL,
  `reachoutId` bigint(100) NOT NULL,
  `walletId` bigint(100) NOT NULL,
  `identityId` bigint(100) NOT NULL,
  `blockId` bigint(100) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `aaaId`, `first_name`, `last_name`, `addressId`, `reachoutId`, `walletId`, `identityId`, `blockId`) VALUES
(1, 1, 'user1', 'buyer', 1, 1, 1, 1, 1),
(2, 2, 'user2 ', 'supplier', 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
CREATE TABLE IF NOT EXISTS `wallets` (
  `walletId` bigint(100) NOT NULL AUTO_INCREMENT,
  `wallettypeId` bigint(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`walletId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wallettype`
--

DROP TABLE IF EXISTS `wallettype`;
CREATE TABLE IF NOT EXISTS `wallettype` (
  `wallettypeId` bigint(100) NOT NULL AUTO_INCREMENT,
  `wallettype` varchar(20) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`wallettypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `wishlistId` bigint(100) NOT NULL AUTO_INCREMENT,
  `userId` bigint(100) NOT NULL,
  `productId` bigint(100) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`wishlistId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`wishlistId`, `userId`, `productId`, `created_date`, `updated_date`, `active`) VALUES
(4, 1, 1, '2020-06-10', '2020-06-10', 1),
(6, 1, 6, '2020-06-13', '2020-06-13', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
