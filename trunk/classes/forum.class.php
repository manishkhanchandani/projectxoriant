<?php

require "../Connections/conn_adodb.php";

class forum{

	private $userId;
	private $objDb;
	private $arrTables;
	private $arrHirResult;

	//Initialise 
	public function __construct($userId = NULL){
	
		global $objDb;
		
		$this->userId = $userId;
		$this->objDb = $objDb;
		$this->arrTables = array("categories"=>"forum_cat", "topics"=>"forum_topics", "comments"=>"forum_comments");
		
	}
	
	
	//Get a particular forum category
	public function getForumCategory($catId){
	
		try{
		
			//Adding category
			$getCatSql = "SELECT fcat_id, fcat_name, fcat_desc FROM ".$this->arrTables["categories"]." WHERE fcat_id='$catId' LIMIT 1";
			$result = $this->objDb->Execute($getCatSql);
			
			$arrResult = array();
			$countRes = 0;
			while(!$result->EOF){
				
				$arrResult[$countRes]['fcat_id'] = $result->fields['fcat_id'];
				$arrResult[$countRes]['fcat_name'] = $result->fields['fcat_name'];
				$arrResult[$countRes]['fcat_desc'] = $result->fields['fcat_desc'];

				
				$result->MoveNext();
				$countRes++;
			}
			
			return $arrResult;
			
		}catch(Exception $e){
		
			return false;
		
		}	
	
	}
	
	
	//Get all forum categories
	public function getForumCategories($start = 0, $recsPerPage = 10){
	
		try{
		
			//Adding category
			$getCatSql = "SELECT * FROM ".$this->arrTables["categories"]." LIMIT $start,$recsPerPage";
			$result = $this->objDb->Execute($getCatSql);
			
			$arrResult = array();
			$countRes = 0;
			while(!$result->EOF){
				
				$arrResult[$countRes]['fcat_id'] = $result->fields['fcat_id'];
				$arrResult[$countRes]['fcat_name'] = $result->fields['fcat_name'];
				$arrResult[$countRes]['fcat_desc'] = $result->fields['fcat_desc'];

				
				$result->MoveNext();
				$countRes++;
			}
			
			return $arrResult;
			
		}catch(Exception $e){
		
			return false;
		
		}	
	
	}
	
	
	//Add forum topic
	public function addForumTopic($topic, $topicDesc, $catId=0){
	
		try{
		
			//Add only if user is logged in
			if($this->userId){
		
				//Adding topic
				$addTopicSql = "INSERT INTO ".$this->arrTables["topics"]." VALUES('','$catId','$topic','$topicDesc','".$this->userId."','".date("Y-m-d H:i:s")."')";
				$this->objDb->Execute($addTopicSql);
				
			} else {
			
				return false;
			
			}	
			
		}catch(Exception $e){
		
			return false;
		
		}	
		
	}
	
	
	//Get a particular forum topic
	public function getForumTopic($topicId){
	
		try{
		
			//Get topic
			$getTopicSql = "SELECT frt_catid, frt_topic, frt_desc, frt_userid FROM ".$this->arrTables["topics"]." WHERE frt_id='$topicId' LIMIT 1";
			$result = $this->objDb->Execute($getTopicSql);
			
			$arrResult = array();
			$countRes = 0;
			while(!$result->EOF){
				
				$arrResult[$countRes]['frt_catid'] = $result->fields['frt_catid'];
				$arrResult[$countRes]['frt_topic'] = $result->fields['frt_topic'];
				$arrResult[$countRes]['frt_desc'] = $result->fields['frt_desc'];
				$arrResult[$countRes]['frt_userid'] = $result->fields['frt_userid'];

				
				$result->MoveNext();
				$countRes++;
			}
			
			return $arrResult;
			
		}catch(Exception $e){
		
			return false;
		
		}	
		
	}
	
	
	//Get all/user forum topics
	public function getForumTopics($onlyUserForums = false, $start = 0, $recsPerPage = 10){
	
		try{
		
			//Get all topics
			if($onlyUserForums){// Get only user's topics
			
				if($this->userId){//This option will be successful only if user is logged in
			
					$getTopicSql = "SELECT frt_catid, frt_topic, frt_desc, frt_userid FROM ".$this->arrTables["topics"]." WHERE frt_userid='".$this->userId."' LIMIT $start,$recsPerPage";
				 
				} else {
				
					return false;
				
				}
				
			} else {
			
				$getTopicSql = "SELECT frt_catid, frt_topic, frt_desc, frt_userid FROM ".$this->arrTables["topics"]." LIMIT $start,$recsPerPage";
				
			}	
			$result = $this->objDb->Execute($getTopicSql);
			
			$arrResult = array();
			$countRes = 0;
			while(!$result->EOF){
				
				$arrResult[$countRes]['frt_catid'] = $result->fields['frt_catid'];
				$arrResult[$countRes]['frt_topic'] = $result->fields['frt_topic'];
				$arrResult[$countRes]['frt_desc'] = $result->fields['frt_desc'];
				$arrResult[$countRes]['frt_userid'] = $result->fields['frt_userid'];

				
				$result->MoveNext();
				$countRes++;
			}
			
			return $arrResult;
			
		}catch(Exception $e){
		
			return false;
		
		}	
		
	}
	
	
	//Add forum topic comment
	public function addForumComment($topicId, $comment, $parentTopicId = 0){
	
		try{
		
			//Add only if user is logged in
			if($this->userId){
			
				//Adding comment
				$addCommSql = "INSERT INTO ".$this->arrTables["comments"]." VALUES('','$topicId','$comment','".$this->userId."','$parentTopicId','".date("Y-m-d H:i:s")."')";
				$this->objDb->Execute($addCommSql);
			
			} else {
			
				return false;
			
			}	
			
		}catch(Exception $e){
		
			return false;
		
		}	
		
	}
	
	
	//Get forum comments for particular topic
	public function getForumComments($topicId, $start = 0, $recsPerPage = 10){
	
		try{
		
			//Get topic comments
			$getCommSql = "SELECT frc_id, frc_comments, frc_userid, frc_parent_id, frc_createddate FROM ".$this->arrTables["comments"]." WHERE frc_topic_id='$topicId' ORDER BY frc_parent_id LIMIT $start,$recsPerPage";
			$result = $this->objDb->Execute($getCommSql);
			
			$arrResult = array();
			$countRes = 0;
			while(!$result->EOF){
				
				$arrResult[$countRes]['frc_id'] = $result->fields['frc_id'];
				$arrResult[$countRes]['frc_comments'] = $result->fields['frc_comments'];
				$arrResult[$countRes]['frc_userid'] = $result->fields['frc_userid'];
				$arrResult[$countRes]['frc_parent_id'] = $result->fields['frc_parent_id'];
				$arrResult[$countRes]['frc_createddate'] = $result->fields['frc_createddate'];
				
				$result->MoveNext();
				$countRes++;
			}

			//Get an array of comments with parent and childs hirarically arranged 
			$this->arrHirResult = array();
			$this->prepareHiraricalResult($arrResult);
			
			return $this->arrHirResult;
			
		}catch(Exception $e){
		
			return false;
		
		}	
		
	}
	
	
	//This is to prepare a hirarical result array of comments
	private function prepareHiraricalResult(&$arrResult){
	
		$this->prepareResult($arrResult);
		
		$arrHirResultTemp = array();
		for($i=0;$i<count($this->arrHirResult);$i++){
		
			if($this->arrHirResult[$i]['frc_parent_id']==0){
				
				$arrHirResultTemp[] = $this->arrHirResult[$i];
				$arr[$this->arrHirResult[$i]['frc_id']] = (count($arrHirResultTemp) - 1);
				
			}else{
			
				$index = $arr[$this->arrHirResult[$i]['frc_parent_id']];

				if(is_numeric($index)){
				
					$arrHirResultTemp[$index]["childs"][] = $this->arrHirResult[$i];
					$arr[$this->arrHirResult[$i]['frc_id']] = '['.(count($arrHirResultTemp) - 1).']["childs"]['.(count($arrHirResultTemp[$index]["childs"]) - 1).']';
					
				}else{
				
					eval('$arrHirResultTemp'.$index.'["childs"][] = $this->arrHirResult[$i];');
					eval('$childNo = (count($arrHirResultTemp'.$index.'["childs"]) - 1);');
					$arr[$this->arrHirResult[$i]['frc_id']] = $index.'["childs"]['.$childNo.']';
					
				}
			}
		
		}
		
		//Assign the temporary result array main result array
		$this->arrHirResult = $arrHirResultTemp;
		
	}
	
	
	//This is to prepare a result array of comments
	private function prepareResult(&$arrResult){
	
		$arrTemp = $arrResult;
		
		//Finding all parents
		if(is_array($arrResult)){
		
			for($i=0;$i<count($arrResult);$i++){
			
				//if($arrResult[$i]!=NULL && $arrResult[$i]['frc_parent_id']==0){
				if($arrResult[$i]!=NULL){
				
					//Get this node
					$this->arrHirResult[] = $arrResult[$i];
					
					//Set the node to NULL in the original array	
					$nodeCommentId = $arrResult[$i]['frc_id'];		
					$arrResult[$i] = NULL;	
					
					//Find the childs
					$this->findChilds($nodeCommentId, $arrResult);

				}
			
			}
			
		}
			
	}
	
	
	//This function is to find all childs of a parent recursively
	private function findChilds($parentId, &$arrResult){
	
		//Finding all parents
		if(is_array($arrResult)){
		
			for($i=0;$i<count($arrResult);$i++){
			
				if($arrResult[$i]!=NULL && $arrResult[$i]['frc_parent_id']==$parentId){
				
					//Get this node
					$this->arrHirResult[] = $arrResult[$i];

					//Set the node to NULL in the original array
					$nodeCommentId = $arrResult[$i]['frc_id'];		
					$arrResult[$i] = NULL;	
					
					//Find the sub childs
					$this->findChilds($nodeCommentId, $arrResult);
					
				}
			
			}
			
		}	
	
	}
	

}
?>