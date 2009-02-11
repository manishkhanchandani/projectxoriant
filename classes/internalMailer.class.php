<?php

require "../Connections/conn_adodb.php";

//This class is for internal mailing system for a community site
class internalMailer{

	private $userId;
	private $objDb;
	private $arrTables;
	
	//Initialise 
	public function __construct($userId){
	
		global $objDb;
		
		$this->userId = $userId;
		$this->objDb = $objDb;
		$this->arrTables = array("inbox"=>"mail_inbox", "sent"=>"mail_sent", "saved"=>"mail_saved", "trash"=>"mail_trash");
		
	}
	
	//Sent internal mail
	public function sendMail($toId, $subj, $message){

		try{
		
			//Adding to inbox
			$addMailSql = "INSERT INTO ".$this->arrTables["inbox"]." VALUES('','".$this->userId."','$toId','$subj','$message','".date("Y-m-d H:i:s")."')";
			$this->objDb->Execute($addMailSql);
			
			//Adding to sent items
			$addMailSql = "INSERT INTO ".$this->arrTables["sent"]." VALUES('','".$this->userId."','$toId','$subj','$message','".date("Y-m-d H:i:s")."')";
			$this->objDb->Execute($addMailSql);
			
		}catch(Exception $e){
		
			return false;
		
		}	
	
	}
	
	//Get all mails in user's inbox
	public function getInbox($start = 0, $recsPerPage = 10){

		try{
		
			$selMailSql = "SELECT * FROM ".$this->arrTables["inbox"]." WHERE mail_to='".$this->userId."' LIMIT $start, $recsPerPage";
			$result = $this->objDb->Execute($selMailSql);
	
			return $this->bulidResultArray($result);
			
		}catch(Exception $e){
		
			return false;
		
		}
	}
	
	//Get all mails in user's sent box
	public function getSent($start = 0, $recsPerPage = 10){

		try{
	
			$selMailSql = "SELECT * FROM ".$this->arrTables["sent"]." WHERE mail_from='".$this->userId."' LIMIT $start, $recsPerPage";
			$result = $this->objDb->Execute($selMailSql);
		
			return $this->bulidResultArray($result);
			
		}catch(Exception $e){
		
			return false;
		
		}
	}
	
	//Get all mails in user's saved box
	public function getSaved($start = 0, $recsPerPage = 10){

		try{

			$selMailSql = "SELECT * FROM ".$this->arrTables["saved"]." WHERE mail_saved_by='".$this->userId."' LIMIT $start, $recsPerPage";
			$result = $this->objDb->Execute($selMailSql);
		
			return $this->bulidResultArray($result);
		
		}catch(Exception $e){
		
			return false;
		
		}
	}
	
	//Get all mails in user's trash box
	public function getTrash($start = 0, $recsPerPage = 10){

		try{

			$selMailSql = "SELECT * FROM ".$this->arrTables["trash"]." WHERE mail_trashed_by='".$this->userId."' LIMIT $start, $recsPerPage";
			$result = $this->objDb->Execute($selMailSql);
		
			return $this->bulidResultArray($result);
		
		}catch(Exception $e){
		
			return false;
		
		}
	}
	
	//Get a particular mail
	public function getMail($mailId, $from){

		try{

			$selMailSql = "SELECT * FROM ".$this->arrTables[$from]." WHERE mail_id='".$mailId."' LIMIT 1";
			$result = $this->objDb->Execute($selMailSql);
		
			return $this->bulidResultArray($result);
		
		}catch(Exception $e){
		
			return false;
		
		}
	}
	
	
	//Save a particular mail
	public function saveMail($mailId, $from){
	
		try{
	
			$selMailSql = "SELECT * FROM ".$this->arrTables[$from]." WHERE mail_id='".$mailId."' LIMIT 1";
			$result = $this->objDb->Execute($selMailSql);
			
			if(!$result->EOF){
			
				//Transfer the entry to saved list
				$addMailSql = "INSERT INTO ".$this->arrTables["saved"]." VALUES('','".$this->userId."','".$result->fields['mail_from']."','".$result->fields['mail_to']."','".$result->fields['mail_subject']."','".$result->fields['mail_body']."','".$result->fields['mail_createddate']."')";
				$this->objDb->Execute($addMailSql);
				
				//Delete the transfered mail
				$delMailSql = "DELETE FROM ".$this->arrTables[$from]." WHERE mail_id='".$mailId."'";
				$this->objDb->Execute($delMailSql);
		
			}
		
		}catch(Exception $e){
		
			return false;
		
		}

	}
	
	//Trash a particular mail
	public function trashMail($mailId, $from){
	
		try{
	
			$selMailSql = "SELECT * FROM ".$this->arrTables[$from]." WHERE mail_id='".$mailId."' LIMIT 1";
			$result = $this->objDb->Execute($selMailSql);
			
			if(!$result->EOF){
			
				//Transfer the entry to trash list
				$addMailSql = "INSERT INTO ".$this->arrTables["trash"]." VALUES('','".$this->userId."','".$result->fields['mail_from']."','".$result->fields['mail_to']."','".$result->fields['mail_subject']."','".$result->fields['mail_body']."','".$result->fields['mail_createddate']."')";
				$this->objDb->Execute($addMailSql);
				
				//Delete the transfered mail
				$delMailSql = "DELETE FROM ".$this->arrTables[$from]." WHERE mail_id='".$mailId."'";
				$this->objDb->Execute($delMailSql);
		
			}
			
		}catch(Exception $e){
		
			return false;
		
		}	

	}
	
	
	//Permanently delete a particular mail
	public function deleteMail($mailId, $from){
		
		try{
		
			//Delete the transfered mail
			$delMailSql = "DELETE FROM ".$this->arrTables[$from]." WHERE mail_id='".$mailId."'";
			$this->objDb->Execute($delMailSql);
			
		}catch(Exception $e){
		
			return false;
		
		}	

	}
	
	//Bulid the result array
	public function bulidResultArray($result){
	
		try{
	
			$arrResult = array();
			$countRes = 0;
			while(!$result->EOF){
				
				$arrResult[$countRes]['mail_id'] = $result->fields['mail_id'];
				$arrResult[$countRes]['mail_from'] = $result->fields['mail_from'];
				$arrResult[$countRes]['mail_to'] = $result->fields['mail_to'];
				$arrResult[$countRes]['mail_subject'] = $result->fields['mail_subject'];
				$arrResult[$countRes]['mail_body'] = $result->fields['mail_body'];
				$arrResult[$countRes]['mail_createddate'] = $result->fields['mail_createddate'];
				
				$result->MoveNext();
				$countRes++;
			}
			
			return $arrResult;
			
		}catch(Exception $e){
		
			return false;
		
		}	
		
	}
	
}
?>