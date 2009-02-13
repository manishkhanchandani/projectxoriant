-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 13, 2009 at 12:51 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `newproject`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `forum_cat`
-- 

CREATE TABLE `forum_cat` (
  `fcat_id` int(11) NOT NULL auto_increment,
  `fcat_name` varchar(255) collate latin1_general_ci default NULL,
  `fcat_desc` text collate latin1_general_ci,
  `fcat_createddate` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`fcat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `forum_comments`
-- 

CREATE TABLE `forum_comments` (
  `frc_id` int(11) NOT NULL auto_increment,
  `frc_topic_id` int(11) NOT NULL,
  `frc_comments` text collate latin1_general_ci,
  `frc_userid` int(11) default NULL,
  `frc_parent_id` int(11) NOT NULL default '0',
  `frc_createddate` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`frc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `forum_topics`
-- 

CREATE TABLE `forum_topics` (
  `frt_id` int(11) NOT NULL auto_increment,
  `frt_catid` int(11) default NULL,
  `frt_topic` varchar(255) collate latin1_general_ci default NULL,
  `frt_desc` text collate latin1_general_ci,
  `frt_userid` int(11) default NULL,
  `frt_createddate` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`frt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `mail_inbox`
-- 

CREATE TABLE `mail_inbox` (
  `mail_id` int(11) NOT NULL auto_increment,
  `mail_from` int(11) default NULL,
  `mail_to` int(11) default NULL,
  `mail_subject` varchar(255) collate latin1_general_ci default NULL,
  `mail_body` text collate latin1_general_ci,
  `mail_createddate` timestamp NULL default NULL,
  PRIMARY KEY  (`mail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `mail_saved`
-- 

CREATE TABLE `mail_saved` (
  `mail_id` int(11) NOT NULL auto_increment,
  `mail_saved_by` int(11) default NULL,
  `mail_from` int(11) default NULL,
  `mail_to` int(11) default NULL,
  `mail_subject` varchar(255) collate latin1_general_ci default NULL,
  `mail_body` text collate latin1_general_ci,
  `mail_createddate` timestamp NULL default NULL,
  PRIMARY KEY  (`mail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `mail_sent`
-- 

CREATE TABLE `mail_sent` (
  `mail_id` int(11) NOT NULL auto_increment,
  `mail_from` int(11) default NULL,
  `mail_to` int(11) default NULL,
  `mail_subject` varchar(255) collate latin1_general_ci default NULL,
  `mail_body` text collate latin1_general_ci,
  `mail_createddate` timestamp NULL default NULL,
  PRIMARY KEY  (`mail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `mail_trash`
-- 

CREATE TABLE `mail_trash` (
  `mail_id` int(11) NOT NULL auto_increment,
  `mail_trashed_by` int(11) default NULL,
  `mail_from` int(11) default NULL,
  `mail_to` int(11) default NULL,
  `mail_subject` varchar(255) collate latin1_general_ci default NULL,
  `mail_body` text collate latin1_general_ci,
  `mail_createddate` timestamp NULL default NULL,
  PRIMARY KEY  (`mail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;
