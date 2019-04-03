<?php 


 /*
  ** Function Get Caregory v1.0.0
  ** Get Category From Data Base 
 */
   function getCat($value = 0 ){
   	 global $conn;
   	 $stmt = $conn->prepare("SELECT * FROM categories WHERE parent = $value  ORDER BY id  ");
   	 $stmt->execute();
   	 return $stmt->fetchAll();
   }

/*

	** Function StatusReg v1.0.0
	** Ccheck If User Activate Or Not 

*/
	function StatusReg($user){
		global $conn;
   	 	$stmt = $conn->prepare("SELECT userName,Regstatus FROM users WHERE userName = ? AND Regstatus = 0 LIMIT 1");
   	 	$stmt->execute(array($user));
   	 	return $stmt->rowCount();
	}



  /*
  ** Function Get Items v1.0.0
  ** Get Items Depend On Category Or IdUser  From Data Base 
 */
   function getItems($where , $value , $approve = null ){
   	 global $conn;
   	 if ($approve == null) {
   	 	$sql = "";
   	 }else{
   	 	$sql = " AND Approve = 1 ";
   	 }
   	 $stmtItem = $conn->prepare("SELECT * FROM items WHERE $where = ?    $sql   ORDER BY item_id DESC  ");
   	 $stmtItem->execute(array($value));
   	 return $stmtItem->fetchAll();
   }

   function getAllItem (){
   	global $conn;
   	$stmtItem = $conn->prepare("SELECT * FROM items WHERE 1    AND Approve = 1    ORDER BY item_id DESC  ");
   	 $stmtItem->execute(array());
   	 return $stmtItem->fetchAll();
   }

   function getSomeItems($catId , $numberLimit = 20 ){
   		global $conn;
   		$stmtSomeItem = $conn->prepare("SELECT * FROM items WHERE Cat_id = $catId  AND Approve = 1    ORDER BY item_id DESC  LIMIT $numberLimit");
   		$stmtSomeItem->execute(array($catId));
   		return $stmtSomeItem->fetchAll();
   }

  

/*
  ** Function Get Category v1.0.0
  ** Get Items Depend On Category Or IdUser  From Data Base 
*/
   function gatCategory($where , $value){
   	 global $conn;
   	 $stmtItem = $conn->prepare("SELECT * FROM categories WHERE $where = ?   ");
   	 $stmtItem->execute(array($value));
   	 return $stmtItem->fetch();
   }






/*
**  Function getTitle 
**		This Function Print NamePage If Exist or default If Page Not Contain Name 
*/
	function getTitle(){

			global $TitlePage;
			
			if (isset($TitlePage)) {
				return  $TitlePage;
			}else{
				return  "Default";
			}
	}

/*
**  Function redirectHome ($masgError,$Second)
**   	this Page redirect In Page Index Case Error Exist 
**	    	$masgError = Text Message Show The Errror  (String)
** 	    	$Second = Number Second waiting before redirect The Index Page (Int) Defualt = 4 s 
** 		    $url = help you what page do you redirect 
*/

	function redirectHome($theMsg , $url = null , $Second = 4 ){

		echo $theMsg;
		if ($url === 'null') {
			$url = 'index.php';
			$link = lang('Home');
		}else{
			if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
				$url = $_SERVER['HTTP_REFERER'];
				$link = lang('Previous');
			}else{
				$url = 'index.php';
				$link = lang('Home');
			}
			
		}
		echo "<div class='alert alert-info'>".lang('YouWillBeRedirect') . $link .lang('PageAfter<Strong>'). $Second. lang('Second') ."</srong> </div>";
		header("refresh:".$Second.";url=".$url);
		exit();
	}

/*
**  Function check Item If Exist Or Not In DataBase  [This function acept 3 paramateres]
**  	all parametre is clear  
** 
*/

	function checkItem($select,$table,$value){
			global $conn;
			$statement = $conn->prepare("SELECT  $select  FROM $table WHERE  $select  = ? ");
			$statement->execute(array($value));
			$row = $statement->rowCount();

			return $row ;  
	}

/*
** Function Calculate Number Items [This function acept 4 paramateres]
*/

	function caclItems($select,$table,$condition = 1 ,$valueCondition = 1){
		global $conn;
		$statement = $conn->prepare("SELECT $select FROM $table WHERE $condition = $valueCondition ");
		$statement->execute(array($valueCondition));
		$row = $statement->rowCount();

		return $row ;  
	}


/*
* 	Function Get Latest Item In My DataBase => getLatest [Accept 4 parametre ]  V 1.0.0
* 	$field = field to select from 
	$table = the table to tchose
	$onder = condition order Items
	$numberTtem = number Items To Show 
*/

	function getLatest($field,$table,$order,$numberTtem = 3){

		global $conn;

		$statement = $conn->prepare("SELECT $field FROM $table  ORDER BY $order DESC  LIMIT $numberTtem ");
		$statement->execute();

		 return $statement->fetchAll();

	}




function deleteOldAvatar($idUser){
	global $conn;
	$stmt = $conn->prepare("SELECT ImageUser FROM users WHERE userID = ? ");
	$stmt->execute(array($idUser));
	return $stmt->fetch();
}

