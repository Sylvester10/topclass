<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* ===== Documentation ===== 
Name: Constants::General
Role: Include
Description: Holds all the constants used by the app. Required in the construct of the core controller, MY_Controller, which makes it global to the entire application.
Author: Nwankwo Ikemefuna
Date Created: 23rd November, 2018
*/


$school_name = 'Top Class Montessori';
$school_initials = 'TCM';
$school_phone_number = ' +234(0)8098797292';
$school_phone_number2 = ' +234(0)8053658429';
$school_address = '5 Atimbo Road, Calabar';
$school_contact_email = 'contact@topclassmontessori.com';
$sub_tagline = 'The Top - our ultimate our message-raising Godly seed, that will reign as kings on Earth';
$school_keywords = 'Top Class Montessori, Top Class School, Schools in Calabar, Schools in Nigeria, Schools in Africa, Nursery Schools in Calabar, Primary School in Calabar, ICT-Compliant Schools in Calabar';
$school_description = "TOP CLASS MONTESSORI is a family and learner-friendly school based on the montessori and UBE Education. It offers our children the opportunity to develop their potentials as they step out into the world as engaged, responsible and respectful citizens, with an understanding and appreciation that learning is life.";


//Software Info
define('school_name', $school_name);
define('school_initials', $school_initials);
define('school_phone_number', $school_phone_number);
define('school_phone_number2', $school_phone_number2);
define('school_address', $school_address);
define('school_contact_email', $school_contact_email);
define('school_keywords', $school_keywords);
define('school_description', $school_description);
define('school_website', base_url());
define('school_logo', base_url('assets/images/logo/11.jpg'));
define('school_favicon', base_url('assets/images/favicon.ico'));


//vendor
define('software_vendor_site', 'http://q2rweb.com');
define('software_vendor', 'Q2R');


//MySQL-PHP server time difference. Change to zero if both are on same server
define('mysql_time_difference', 0); //if negative, write as -x, else, x


//Email config
define('school_web_mail', school_contact_email); 


//defaults
define('default_admin_password', 'tcmadmin255');


//Portal links
define('portal_admin_staff_login', 'https://qschoolmanager.com/login');
define('portal_student_parent_login', 'https://qschoolmanager.com/user_login');


//Others
define('pdf_icon', base_url('assets/images/icons/pdf_icon.png'));
define('user_avatar', base_url('assets/images/avatar/user.png'));