<?php

/******************************************************************************	
*
*	This file is part of Perfect Auth Class.
*
*    Perfect Auth Class is free software; you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation; either version 2 of the License, or
*    (at your option) any later version.
*
*    Perfect Auth Class is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with Perfect Auth Class; if not, write to the Free Software
*    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*	
*******************************************************************************/

// +----------------------------------------------------------------------+
// | Perfect Scripts                                       class.auth.php |
// | Brazilian Organization                                               |
// +----------------------------------------------------------------------+
// | Alive Linux!                                                         |
// | Because we love freedom!                                             |
// +----------------------------------------------------------------------+
// | Class Perfect Autentication                                          |
// | Created By Igor Ribeiro de Assis                                     |
// | <igor21@terra.com.br> UIN: 71064682                                  |
// +----------------------------------------------------------------------+
// | http://www.perfectscripts.cjb.net                                    |
// +----------------------------------------------------------------------+

class pauth {

	/*
	| Public Vars
	*/
	
	// main config @array
	var $config = array();
	
	// cookie config @array
	var $cookie = array();
	
	// user info @array
	var $user = array();
	
	/*
	| Constructor: defines $cookie and $config
	|
	| Option $cpath added by Lian Fuentes.
	*/
	
	function pauth($expire, $fpath, $cpath = "/"){
		
		// define $cookie 
		$this-> cookie['expires'] = $expire; //expire time (seconds)
		$this-> cookie['name'] = NULL;
		$this-> cookie['cookiep'] = $cpath; // valid cookie path
		$this-> cookie['cookied'] = $_SERVER['HTTP_HOST']; // host name -- not work yet
		$this-> cookie['cookies'] = 0; //security 1 HTTPS, 0 HTTP -- not work yet
		
		// define $config 
		$this-> config['filet'] = (int)1; //file type
		$this-> config['filep'] = $fpath; //path of the files
		$this-> config['filen'] = "pauth_f"; //file name
		$this-> config['cache'] = "no-cache"; //cache info

		
		return 0;
	}

	/*
	| Define Headers
	*/
	
	function headers(){
		
		// define cache header
		header("Cache-Control: no-cache, must-revalidate");
	}
	
	/*
	| Start User Session
	*/
	
	function startUsession($login,$section){
		
		// define $user
		$this-> user['login'] = $login;
		$this-> user['section'] = $section;
		$this-> user['ip'] = $_SERVER['REMOTE_ADDR'];
		$this-> user['time'] = time();
		$this-> user['id'] = $this-> genId($this-> user['time']);
		$this-> user['pHash'] = $this-> genpHash($this-> user);
				
		return 0;
	}
	
	/*
	| Generate Id
	*/
	
	function genId($time){
		
		//make $id
		$id = $time.mt_rand(substr($time,-4),substr($time,-10));
		
		return $id;
	}
	
	/*
	| Generate the pHash
	*/
	
	function genpHash($user){
		
		//format ip
		$ip = $user['ip'];
		$ip = str_replace(".","",$ip);
		
		//mount pHash
		$pHash = $user['login'].$ip.$user['id'].$user['section'];
		$pHash = md5($pHash);
		
		return $pHash;
	}

	/*
	| SetCookie and Call function authfwrite
	*/

	function setpAuth(){
		
		//set cookie using $user info
		setcookie("id_".$this-> user['section'],$this-> user['id'],$this-> user['time'] + $this-> cookie['expires'],$this-> cookie['cookiep']);
		setcookie("user_".$this-> user['section'],$this-> user['login'],$this-> user['time'] + $this-> cookie['expires'],$this-> cookie['cookiep']);
		setcookie("section_".$this-> user['section'],$this-> user['section'],$this-> user['time'] + $this-> cookie['expires'],$this-> cookie['cookiep']);
		
		//call function authfwrite
		$this-> authfwrite($this-> config['filen'].$this-> user['id']);

		return 0;
	}

	/*
	| Create the Auth File in Server
	*/
	
	function authfwrite($file){
		
		//create the file
		$authf = fopen($this-> config['filep'].".".$file,"w+");
		
		//writes in file
		$authw = fwrite($authf,$this-> user['id']."::".$this-> user['pHash']);
		fclose($authf); //close file
		chmod($this-> config['filep'].".".$file,0666);
		
		return 0;
	}

	/*
	| Validate access
	*/
	
	function valAuth($section){
		
		//verify if cookie exists
		if(!isset($_COOKIE['id_'.$section]) or !isset($_COOKIE['user_'.$section]) or !isset($_COOKIE['section_'.$section])){
			
			//error
			$this-> error("You Are Not Logged In <br> (No Cookies)");
		}
		//if exists...
		else{
			//verify if file exists
			if(!file_exists($this-> config['filep'].".".$this-> config['filen'].$_COOKIE['id_'.$section])){
				
				//error
				$this-> error("You Are Not Logged In <br> (No Files)");
			}
		}

		//verify section information
		if($section != $_COOKIE['section_'.$section]){
			$this-> error("You Don't Have Permission");
		}

		$file = $this-> config['filep'].".".$this-> config['filen'].$_COOKIE['id_'.$section];
		
		//test cookie ID with server ID
		
		$authf = fopen($file,"r");
		$authr = fread($authf,filesize($file));
		$authi = explode("::",trim($authr)); //separe id from pHash
		
		//test id
		if($_COOKIE['id'] == $authi[0]){
			//id ok, now test pHash
			$user = array('login' => $_COOKIE['user_'.$section],
				      'ip' => $_SERVER['REMOTE_ADDR'],
				      'time' => time(),
				      'id' => $_COOKIE['id_'.$section],
				      'section' => $_COOKIE['section_'].$section); //create array $user
			
			$pHash = $this-> genpHash($user);
			
			if($authi[1] != $pHash){
				$this-> error("Information Problem");
			}
		}
		
		$this-> authfdel($this-> config['filep'].".".$this-> config['filen'].$_COOKIE['id_'.$section]);

		return 0;
		
	}

	/*
	| Delete the AuthFile
	*/
	
	function authfdel($file){
		
		//unlink file
		if(file_exists($this-> config['filep'].$file)){
			
			unlink($this-> config['filep'].$file);
		}
		
		return 0;
	}
	
	/*
	| Error Function
	*/

	function error($message){
		
		//print error message
		echo "<strong>Debug</strong> - Error: <br> ".$message;
		exit;
		
	}
	
	/*
	| Validate the Expires Time
	*/
	
	function valExp($id,$section){
		
		//select time from id
		$ftime = substr($id,0,10);
		$time = time();

		//verify time
		if($ftime + $this-> cookie['expires'] < $time){
			
			//delete cookies
			setcookie("id_".$section,"",time()-3600,$this-> cookie['cookiep']);
			setcookie("user_".$section,"",time()-3600,$this-> cookie['cookiep']);
			setcookie("section_".$section,"",time()-3600,$this-> cookie['cookiep']);
			
			//remove auth file
			$this-> authfdel(".".$this-> config['filen'].$id);
		
			$this-> error("Session Expired");
			
		}

		return 0;
		
	}
	
	/*
	| Remove Old auth files
	*/
	
	function remOld(){
		
		//private vars
		$authf = $this-> config['filen'];
		
		//list the files in array
		if($dir = opendir($this-> config['filep'])){
    		
			while(($file = readdir($dir)) !== FALSE){ 
        		
				if(substr($file,1,strlen($authf)) == $authf){ 
            			
					//file in array
					$files[] = $file;
				
				} 
    			}
    		
			closedir($dir); 
		}
		
		//remove Old Files
		if(is_array($files)){
		
			foreach($files as $value){
			
				//verify file
				$ftime = substr($value,strlen($authf)+1,10); //file create time
				$time = time(); //actual time

				if($ftime + $this-> cookie['expires'] < $time){
				
					//delete file
					$this-> authfdel($value);
				}
			
			}
		}
		
		return 0;
	}
	
	/*
	| Test If user is logged
	*/
	
	function testLogin($section){
		
		//remove Old Files
		$this-> remOld();
		
		//update session
		if(!empty($_COOKIE['user_'.$section]) and !empty($_COOKIE['id_'.$section]) and !empty($_COOKIE['section_'.$section])){

			$this-> startUsession($_COOKIE['user_'.$section],$_COOKIE['section_'.$section]);
			$this-> setpAuth();
		
		}
		
		return 0;

	}
	
	/*
	| Join the Login Functions
	*/
	
	function login($user,$section){
		
		//starts session
		$this-> startUsession($user,$section);
		$this-> setpAuth();

		return 0;

		
	}

	/*
	| Validate
	*/
	
	function validate($section){
		
		//validate login
		$this-> remOld();
		$this-> valAuth($section);
		$this-> valExp($_COOKIE['id_'.$section],$section);
		
		//update session
		$this-> startUsession($_COOKIE['user_'.$section],$_COOKIE['section_'.$section]);
		$this-> setpAuth();
	
		return 0;
	}

	/*
	| Logout: Delete Cookies and Files
	*/

	function logout($section){
		
		if(!empty($_COOKIE['id_'.$section]) and !empty($_COOKIE['user_'.$section]) and !empty($_COOKIE['section_'.$section])){
		
			//delete files
			$this-> authfdel(".".$this-> config['filen'].$_COOKIE['id_'.$section]);

			//delete cookies
			setcookie("id_".$section,"",time()-3600,$this-> cookie['cookiep']);
			setcookie("user_".$section,"",time()-3600,$this-> cookie['cookiep']);
			setcookie("section_".$section,"",time()-3600,$this-> cookie['cookiep']);
		}
		
		return 0;
	}
	
//end class
}

?>
