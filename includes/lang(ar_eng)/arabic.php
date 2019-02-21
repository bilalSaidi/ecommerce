<?php


    function lang( $phrase ){
        static $lang = array (

        	// Page Login To Admin Area 

        	'AdminLogin' => 'تسجيل الدخول' , 
        	'userName' => 'إسم المستخدم', 
        	'password' => 'كلمة المرور', 
        	'login' => 'دخول' , 
        	'Sorry' => 'عذرا',
            'YouAreNotAdmin' => 'أنت لست مستخدم رئيسي',
            'YouHaveFillAllFields' => 'يجب عليك ملأ جميع الحقول ',

            // Page Admin Words 

            'AdminArea' => 'منطقة المشرف',
            'TotalMember' => 'جميع الأعضاء',
            'PendingMember' => 'أعضاء غير مفعلين' , 
            'TotalItems' => 'جميع الأنواع',
            'TotalComment' => 'جميع التعليقات',
            'LatestRegistredMmebers' => 'آخر الأعضاء المسجلين',
            'Edit' => 'تعديل',
            'Activate' => 'تفعيل',
            'LatestRegistredItems' => 'آخر الأنواع المسجلة' , 
            'Approve' => 'قبول',
            'There"sNoItemToShow' => 'لا يوجد أنواع لعرضها',
            'LatestRegistredComment' => 'آخر التعليقات المسجلة' , 
            'There"sNoCommentToShow' => 'لا يوجد تعليقات لعرضها ',

        	// NAVBAR ADMIN PAGE WORDS 
            'Home_Area' => 'الرئيسية',
            'Categories' => 'الاصناف',
            'Items' => 'النوع',
            'Members' => 'الأعضاء',
            'Edit Profile' => 'تعديل العضوية',
            'Comments' => 'التعليقات',
            'VisitShope' => 'زيارة الموقع',
            'Settings' => 'إعدادت',
            'Log Out' => 'تسجيل الخروج',
            // Page Members Word 
            'ManageMember' => 'إدارة الأعضاء' , 
            'id' => 'الرقم التعريفي',
            'userName' => 'اسم المستخدم' , 
            'Email' => 'الإيميل' , 
            'fullName' => 'الإسم الكامل' , 
            'DateRigestred' => 'تاريخ التسجيل' , 
            'Control' => 'التحكم' ,
            'Delete' => 'حذف' , 
            'AddNewMember' => 'إضافة عضو جديد',
            'thereisNoMemberToShow' => 'لا يوجد أعضاء لعرضهم ',
            // Words Activate Member  [New Word]
            // Words  Add New Member  [New Word]
            'AddMember' => 'إضافة عضو',
            'password' => 'كلمة المرور',
            // Words  Edit Member [New Word]
            'EditMember' => 'تعديل العضو',
            'Save' => 'حفظ',
            'ThatIdIsNotExist' => 'الرقم التعريفي غير موجود',
            // Words Update Member 
            'UpdateMember' => 'تحديث العضو',
            'newPasswordcantBe<strong>LessThan8Charecter' => 'كلمة السر الجديدة يجب  أن تحتوي على الأقل  <strong> 8 حروف </strong>',
            'userNamecantBe<strong>Empty</strong>' => 'حقل المستخدم لايجب أن يكون  <strong> فارغ </strong>',
            'userNamecantBe<strong>lessThan4Charecter</strong>' => 'إسم المستخدم لايجب أن يكون  <strong> أقل  من 4 حروف </strong>',
            'userNamecantBe<strong>MoreThan25Charecter</strong>' => 'إسم المستخدم لا بجي أن يكون  <strong> أكثر من 25 حرف </strong>',
            'EmailcantBe<strong>Empty</strong>' => 'حقل الإيميل لاجيب أن يكون  <strong> فارغ </strong> ',
            'fullNamecantBe<strong>Empty</strong>' => 'الإسم الكامل لاجيب أن يكون  <strong> فارغ </strong>',
            'fullNamecantBe<strong>lessThan4Charecter</strong>' => 'الإسم الكامل لاجيب أن يكون  <strong> أقل من 4 حروف  </strong>',
            'fullNamecantBe<strong>MoreThan25Charecter</strong>' => 'الإسم الكامل لاجيب أن يكون <strong> أكثر من 25 حرف </strong>',
            '<strong>Sorry:(</strong>youMustBeTryAgain' => '<strong> عذرا :( </strong> يجب  عليك المحاولة مجددا ',
            'RecordUpdated' => 'Record Updated',
            '<strong>Sorry:(</strong>youCantBrowsThisPageDirect' => '<strong> عذرا :( </strong>لايمكنك تصفح هته الصفحة مباشرة  ',
            // PAGE FUNCTION WORDS 

            'YouWillBeRedirect' => 'سوف يتم توجيهك  إلى ',
            'PageAfter<Strong>' => ' بعد  <Strong>',
            'Second' => 'ثانية',
            'Home' => 'الصفحة الرئيسية',
            'Previous'  => 'الصفحة السابقة'

        );
        return $lang[$phrase];
    }