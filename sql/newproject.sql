-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 11, 2009 at 05:04 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `newproject`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `mail_inbox`
-- 

CREATE TABLE `mail_inbox` (
  `mail_id` int(11) NOT NULL auto_increment,
  `mail_from` int(11) default NULL,
  `mail_to` int(11) default NULL,
  `mail_subject` varchar(255) default NULL,
  `mail_body` text,
  `mail_createddate` timestamp NULL default NULL,
  PRIMARY KEY  (`mail_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `mail_saved`
-- 

CREATE TABLE `mail_saved` (
  `mail_id` int(11) NOT NULL auto_increment,
  `mail_saved_by` int(11) default NULL,
  `mail_from` int(11) default NULL,
  `mail_to` int(11) default NULL,
  `mail_subject` varchar(255) default NULL,
  `mail_body` text,
  `mail_createddate` timestamp NULL default NULL,
  PRIMARY KEY  (`mail_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `mail_sent`
-- 

CREATE TABLE `mail_sent` (
  `mail_id` int(11) NOT NULL auto_increment,
  `mail_from` int(11) default NULL,
  `mail_to` int(11) default NULL,
  `mail_subject` varchar(255) default NULL,
  `mail_body` text,
  `mail_createddate` timestamp NULL default NULL,
  PRIMARY KEY  (`mail_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `mail_trash`
-- 

CREATE TABLE `mail_trash` (
  `mail_id` int(11) NOT NULL auto_increment,
  `mail_trashed_by` int(11) default NULL,
  `mail_from` int(11) default NULL,
  `mail_to` int(11) default NULL,
  `mail_subject` varchar(255) default NULL,
  `mail_body` text,
  `mail_createddate` timestamp NULL default NULL,
  PRIMARY KEY  (`mail_id`)
) ENGINE=MyISAM;
