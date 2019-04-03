<?php 

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
  ** Function Get Caregory and get item  v1.0.0
  ** Get Category From Data Base 
 */
   function getCat($value = 0 ){
   	 global $conn;
   	 $stmt = $conn->prepare("SELECT * FROM categories WHERE parent = $value  ORDER BY id  ");
   	 $stmt->execute();
   	 return $stmt->fetchAll();
   }

    function getItem($value = 0 ){
   	 global $conn;
   	 $stmt = $conn->prepare("SELECT ImagesItem FROM items WHERE item_id = $value");
   	 $stmt->execute();
   	 return $stmt->fetch();
    }

/*

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

/* Function Get Prent Category From DataBase V 1.0.0 */
function gatPrentCategory(){
   	 global $conn;
   	 $stmtItem = $conn->prepare("SELECT * FROM categories WHERE parent = 0    ");
   	 $stmtItem->execute(array());
   	 return $stmtItem->fetchAll();
   }


 /*
-- Function Delete  Old Avatar User V 1.0.0 

 */


function deleteOldAvatar($idUser){
	global $conn;
	$stmt = $conn->prepare("SELECT ImageUser FROM users WHERE userID = ? ");
	$stmt->execute(array($idUser));
	return $stmt->fetch();
}
