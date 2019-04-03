<?php


    function lang( $phrase ){
        static $lang = array (
            // Page Login To Admin Area  Words
            'AdminLogin' => 'Admin Login ', 
            'userName' => 'userName', 
            'password' => 'password', 
            'login' => 'login' , 
            'Sorry' => 'Sorry',
            'YouAreNotAdmin' => 'You Are Not Admin',
            'YouHaveFillAllFields' => 'You Have Fill All Fields',

            // Page Admin Words 

            'AdminArea' => 'Admin Area',
            'TotalMember' => 'Total Member',
            'PendingMember' => 'Pending Member' , 
            'TotalItems' => 'Total Items',
            'TotalComment' => 'Total Comment',
            'LatestRegistredMmebers' => 'Latest  Registred Mmebers',
            'Edit' => 'Edit',
            'Activate' => 'Activate',
            'LatestRegistredItems' => 'Latest  Registred Items' , 
            'Approve' => 'Approve',
            'There"sNoItemToShow' => 'There is  No Item To Show',
            'LatestRegistredComment' => 'Latest Registred Comment' , 
            'There"sNoCommentToShow' => 'There is  No Comment To Show',

        	// NAVBAR ADMIN PAGE WORDS 
            'Home_Area' => 'Home',
            'Categories' => 'Categories',
            'Items' => 'Items',
            'Members' => 'Members',

            'Edit Profile' => 'visit Shope',
            'Comments' => 'Comments',
            'Settings' => 'Settings',
            'Log Out' => 'visit Shope',
            // Page Members  [All Word ]  
            'ManageMember' => 'Manage Member' , 
            'id' => 'id',
            'userName' => 'userName' , 
            'Email' => 'Email' , 
            'fullName' => 'fullName' , 
            'DateRigestred' => 'Date Rigestred' , 
            'Control' => 'Control' ,
            'Delete' => 'Delete' , 
            'AddNewMember' => 'Add New Member',
            'thereisNoMemberToShow' => 'there is No Member To Show ',
            // Words Activate Member  [New Word]
            // Words  Add New Member  [New Word]
            'AddMember' => 'Add Member',
            'password' => 'password',
            // Words  Edit Member [New Word]
            'EditMember' => 'Edit Member',
            'Save' => 'Save',
            'ThatIdIsNotExist' => 'That Id Is Not Exist',
            // Words Update Member 
            'UpdateMember' => 'Update Member',
            'newPasswordcantBe<strong>LessThan8Charecter' => 'new Password cant Be <strong> Less Than 8 Charecter',
            'userNamecantBe<strong>Empty</strong>' => 'userName cant Be <strong> Empty </strong>',
            'userNamecantBe<strong>lessThan4Charecter</strong>' => 'userName cant Be <strong> less Than 4 Charecter </strong>',
            'userNamecantBe<strong>MoreThan25Charecter</strong>' => 'userName cantBe <strong> More Than 25 Charecter </strong>',
            'EmailcantBe<strong>Empty</strong>' => 'Email cant Be <strong> Empty </strong> ',
            'fullNamecantBe<strong>Empty</strong>' => 'fullName cant Be <strong> Empty </strong>',
            'fullNamecantBe<strong>lessThan4Charecter</strong>' => 'fullName cant Be <strong> less Than 4 Charecter </strong>',
            'fullNamecantBe<strong>MoreThan25Charecter</strong>' => 'fullName cant Be <strong> More Than 25 Charecter </strong>',
            '<strong>Sorry:(</strong>youMustBeTryAgain' => '<strong> Sorry:( </strong> you Must Be Try Again',
            'RecordUpdated' => 'Record Updated',
            '<strong>Sorry:(</strong>youCantBrowsThisPageDirect' => '<strong> Sorry :( </strong> you Cant Brows This Page Direct',

            // PAGE FUNCTION WORDS 

            'YouWillBeRedirect' => 'You Will Be Redirect ',
            'PageAfter<Strong>' => 'Page After <Strong>',
            'Second' => 'Second',
            'Home' => 'Home',
            'Previous'  => 'Previous'


        );
        return $lang[$phrase];
    }