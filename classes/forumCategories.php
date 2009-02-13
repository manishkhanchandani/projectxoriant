<?php

require "../Connections/conn_adodb.php";

class forumCategory{

	private $objDb;
	private $arrTables;

	//Initialize 
	public function __construct(){
	
		global $objDb;

		$this->objDb = $objDb;
		$this->arrTables = array("categories"=>"forum_cat");
		
	}
	

	//Add forum category
	public function addForumCategory($catName, $catDesc){
	
		try{
		
			//Adding category
			$addCatSql = "INSERT INTO ".$this->arrTables["categories"]." VALUES('','$catName','$catDesc','".date("Y-m-d H:i:s")."')";
			$this->objDb->Execute($addCatSql);
			
		}catch(Exception $e){
		
			return false;
		
		}	
	
	}	
	
	
	//Add forum categories
	public function addForumCategories($arrForumCats){
	
		try{
		
			for($i=0;$i<count($arrForumCats);$i++){
				
				//Adding category
				$addCatSql = "INSERT INTO ".$this->arrTables["categories"]." VALUES('','".$arrForumCats[$i]['catName']."','".$arrForumCats[$i]['catDesc']."','".date("Y-m-d H:i:s")."')";
				$this->objDb->Execute($addCatSql);
				
			}
			
		}catch(Exception $e){
		
			return false;
		
		}	
	
	}
	
	
	//Get a particular forum category
	public function getForumCategory($catId){
	
		try{
		
			//Adding category
			$getCatSql = "SELECT * FROM ".$this->arrTables["categories"]." WHERE fcat_id='$catId' LIMIT 1".;
			$result = $this->objDb->Execute($getCatSql);
			
			return $this->bulidResultArray($result);
			
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
			
			return $this->bulidResultArray($result);
			
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
				
				$arrResult[$countRes]['fcat_id'] = $result->fields['fcat_id'];
				$arrResult[$countRes]['fcat_name'] = $result->fields['fcat_name'];
				$arrResult[$countRes]['fcat_desc'] = $result->fields['fcat_desc'];
				$arrResult[$countRes]['fcat_createddate'] = $result->fields['fcat_createddate'];

				
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