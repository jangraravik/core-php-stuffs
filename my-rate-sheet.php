<?php 
define('SERVER','localhost:3366');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','vrpms.dev');
define('DB_DRIVER','mysql');
 
class Mypdo extends PDO{
    function __construct() {
        parent::__construct(DB_DRIVER.":host=".SERVER.";dbname=".DB_NAME,DB_USER,DB_PASS);
   }
   private function updatedataque($arr) {
        $str="";
        if(!empty($arr) && is_array($arr)){
            foreach ($arr as $arrkey=>$arrvalue) {
                $str.=$arrkey.'='."'".$arrvalue."',";               
            }
            return substr($str,0,-1);   
        }
        return 0;
    }
   function insertdata($tbl,$data){
       $substr=$this->updatedataque($data);
       $this->exec("insert into ".$tbl." SET ".$substr);
       return $this->lastInsertId();
    }
    function updatedata($tbl,$data,$fld,$fldvalue){
       $substr=$this->updatedataque($data);     
       return $this->exec("UPDATE ".$tbl." SET ".$substr." where ".$fld."="."'".$fldvalue."'");       
    }
    function deletedata($tbl,$fld,$fldvalue){          
       return $this->exec("DELETE from ".$tbl." where ".$fld."="."'".$fldvalue."'");      
    }
    function fetchdata($query){
        $result=$this->query($query);           
       $result->setFetchMode(PDO::FETCH_ASSOC);
       return $result;           
    }
          
}
$db=new Mypdo(); 
$result =$db->fetchdata("select * from property_rate where prop_id='1' order by rate_date ASC");
$cnt=$result->rowCount();




$nightly=array();
$weekend_mndt=array();
$weekend_spcl=array();
$weekly_mndt=array();
$weekend_extd=array();
$weekend_extd_mndt=array();
$special=array();
$special_mndt=array();


while($user = $result->fetch()){
//print_r($user);
if($user['rate_type']=='nightly'){
$nightly[count($nightly)]=$user;
}
if($user['rate_type']=='weekend_mndt'){
$weekend_mndt[count($weekend_mndt)]=$user;
}
if($user['rate_type']=='weekend_spcl'){
$weekend_spcl[count($weekend_spcl)]=$user;
}
if($user['rate_type']=='weekend_extd'){
$weekend_extd[count($weekend_extd)]=$user;
}

if($user['rate_type']=='weekly_mndt'){
$weekly_mndt[count($weekly_mndt)]=$user;
}
if($user['rate_type']=='weekend_extd_mndt'){
$weekend_extd_mndt[count($weekend_extd_mndt)]=$user;
}
if($user['rate_type']=='special'){
$special[count($special)]=$user;
}
if($user['rate_type']=='special_mndt'){
$special_mndt[count($special_mndt)]=$user;
}

}
//print_r($nightly);
$nightlyarr=array();
if(!empty($nightly)){
echo "Nightly"."<br>";
foreach($nightly as $k=>$nightlyvl){
//echo date('Y-m-d', strtotime($nightly[$k++]['date']));
$tt=$k+1;
if(!empty($nightlyarr)){}else{$nightlyarr['startdate']=$nightlyvl['rate_date'];}
if(date('Y-m-d',strtotime('+1 day',strtotime($nightlyvl['rate_date']))) != date('Y-m-d', strtotime(@$nightly[$tt]['rate_date']))){
//echo date('Y-m-d', strtotime(@$nightly[$tt]['date']));
$nightlyarr['enddate']=$nightlyvl['rate_date'];
//echo $nightlyarr['startdate'].','.$nightlyarr['enddate'].','.$nightlyvl['rate_price']."<br>";
$allNightly[] = $nightlyarr['startdate'].','.$nightlyarr['enddate'].','.$nightlyvl['rate_price'];
$nightlyarr=array();
}

}
}


$nightlyarr=array();
if(!empty($weekend_mndt)){
echo "Weekend_mndt"."<br>";
foreach($weekend_mndt as $k=>$nightlyvl){
//echo date('Y-m-d', strtotime($nightly[$k++]['date']));
$tt=$k+1;
if(!empty($nightlyarr)){}else{$nightlyarr['startdate']=$nightlyvl['rate_date'];}
if(date('Y-m-d',strtotime('+1 day',strtotime($nightlyvl['rate_date']))) != date('Y-m-d', strtotime(@$weekend_mndt[$tt]['rate_date']))){
//echo date('Y-m-d', strtotime(@$nightly[$tt]['date']));
$nightlyarr['enddate']=$nightlyvl['rate_date'];
//echo $nightlyarr['startdate'].' to '.$nightlyarr['enddate'].'->'.$nightlyvl['rate_price']."<br>";
$nightlyarr=array();
}

}
}

$nightlyarr=array();
if(!empty($weekend_spcl)){
echo "Weekend_spcl"."<br>";
foreach($weekend_spcl as $k=>$nightlyvl){
//echo date('Y-m-d', strtotime($nightly[$k++]['date']));
$tt=$k+1;
if(!empty($nightlyarr)){}else{$nightlyarr['startdate']=$nightlyvl['rate_date'];}
if(date('Y-m-d',strtotime('+1 day',strtotime($nightlyvl['rate_date']))) != date('Y-m-d', strtotime(@$weekend_spcl[$tt]['rate_date']))){
//echo date('Y-m-d', strtotime(@$nightly[$tt]['date']));
$nightlyarr['enddate']=$nightlyvl['rate_date'];
//echo $nightlyarr['startdate'].' to '.$nightlyarr['enddate'].'->'.$nightlyvl['rate_price']."<br>";
$nightlyarr=array();
}

}
}

$nightlyarr=array();
if(!empty($weekend_extd)){
echo "weekend_extd"."<br>";
foreach($weekend_extd as $k=>$nightlyvl){
//echo date('Y-m-d', strtotime($nightly[$k++]['date']));
$tt=$k+1;
if(!empty($nightlyarr)){}else{$nightlyarr['startdate']=$nightlyvl['rate_date'];}
if(date('Y-m-d',strtotime('+1 day',strtotime($nightlyvl['rate_date']))) != date('Y-m-d', strtotime(@$weekend_extd[$tt]['rate_date']))){
//echo date('Y-m-d', strtotime(@$nightly[$tt]['date']));
$nightlyarr['enddate']=$nightlyvl['rate_date'];
//echo $nightlyarr['startdate'].' to '.$nightlyarr['enddate'].'->'.$nightlyvl['rate_price']."<br>";
$nightlyarr=array();
}

}
}

$nightlyarr=array();
if(!empty($weekly_mndt)){
echo "weekly_mndt"."<br>";
foreach($weekly_mndt as $k=>$nightlyvl){
//echo date('Y-m-d', strtotime($nightly[$k++]['date']));
$tt=$k+1;
if(!empty($nightlyarr)){}else{$nightlyarr['startdate']=$nightlyvl['rate_date'];}
if(date('Y-m-d',strtotime('+1 day',strtotime($nightlyvl['rate_date']))) != date('Y-m-d', strtotime(@$weekly_mndt[$tt]['rate_date']))){
//echo date('Y-m-d', strtotime(@$nightly[$tt]['date']));
$nightlyarr['enddate']=$nightlyvl['rate_date'];
//echo $nightlyarr['startdate'].' to '.$nightlyarr['enddate'].'->'.$nightlyvl['rate_price']."<br>";
$nightlyarr=array();
}

}
}


$nightlyarr=array();
if(!empty($weekend_extd_mndt)){
echo "weekend_extd_mndt"."<br>";
foreach($weekend_extd_mndt as $k=>$nightlyvl){
//echo date('Y-m-d', strtotime($nightly[$k++]['date']));
$tt=$k+1;
if(!empty($nightlyarr)){}else{$nightlyarr['startdate']=$nightlyvl['rate_date'];}
if(date('Y-m-d',strtotime('+1 day',strtotime($nightlyvl['rate_date']))) != date('Y-m-d', strtotime(@$weekend_extd_mndt[$tt]['rate_date']))){
//echo date('Y-m-d', strtotime(@$nightly[$tt]['date']));
$nightlyarr['enddate']=$nightlyvl['rate_date'];
//echo $nightlyarr['startdate'].' to '.$nightlyarr['enddate'].'->'.$nightlyvl['rate_price']."<br>";
$nightlyarr=array();
}

}
}

$nightlyarr=array();
if(!empty($special)){
echo "special"."<br>";
foreach($special as $k=>$nightlyvl){
//echo date('Y-m-d', strtotime($nightly[$k++]['date']));
$tt=$k+1;
if(!empty($nightlyarr)){}else{$nightlyarr['startdate']=$nightlyvl['rate_date'];}
if(date('Y-m-d',strtotime('+1 day',strtotime($nightlyvl['rate_date']))) != date('Y-m-d', strtotime(@$special[$tt]['rate_date']))){
//echo date('Y-m-d', strtotime(@$nightly[$tt]['date']));
$nightlyarr['enddate']=$nightlyvl['rate_date'];
//echo $nightlyarr['startdate'].' to '.$nightlyarr['enddate'].'->'.$nightlyvl['rate_price']."<br>";
$nightlyarr=array();
}

}
}

$nightlyarr=array();
if(!empty($special_mndt)){
echo "special_mndt"."<br>";
foreach($special_mndt as $k=>$nightlyvl){
//echo date('Y-m-d', strtotime($nightly[$k++]['date']));
$tt=$k+1;
if(!empty($nightlyarr)){}else{$nightlyarr['startdate']=$nightlyvl['rate_date'];}
if(date('Y-m-d',strtotime('+1 day',strtotime($nightlyvl['rate_date']))) != date('Y-m-d', strtotime(@$special_mndt[$tt]['rate_date']))){
//echo date('Y-m-d', strtotime(@$nightly[$tt]['date']));
$nightlyarr['enddate']=$nightlyvl['rate_date'];
//echo $nightlyarr['startdate'].' to '.$nightlyarr['enddate'].'->'.$nightlyvl['rate_price']."<br>";
$nightlyarr=array();
}

}
}


echo "<hr>";
echo "All Nightly<br>";
foreach($allNightly as $dataNightly){
	echo $dataNightly."<br>";
}



?>