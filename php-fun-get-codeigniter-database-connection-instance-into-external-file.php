<?php

/*
Demo user on joe site to implement on booking calander show on property page.
*/
class Calendar
{
	function __construct()
	{
		$CI =& get_instance();
		$this->db = $CI->load->database('default', TRUE);
		//$this->gb_date = array();
		$this->gb_date['start_day'] = array();
		$this->gb_date['start_month'] =array();
		$this->gb_date['start_year'] = array();
		$this->gb_date['end_day'] = array();
		$this->gb_date['end_month'] = array();
		$this->gb_date['end_year'] = array();
		
	}
	
	function check_leap_year($year_no)
	{
		if($year_no%400==0 || $year_no%4==0)
			return true;
		else
			return false;
	}
	
	function get_month($mnth_no)
	{
		switch($mnth_no)
		{
			case 1:return "January";
			break;
			case 2:return "February";
			break;
			case 3:return "March";
			break;
			case 4:return "April";
			break;
			case 5:return "May";
			break;
			case 6:return "June";
			break;
			case 7:return "July";
			break;
			case 8:return "August";
			break;
			case 9:return "September";
			break;
			case 10:return "October";
			break;
			case 11:return "November";
			break;
			case 12:return "December";
			break;

		}
	}
	
	function get_month_days($mnth_no,$year_no)
	{
		switch($mnth_no)
		{
			case 1:return 31;
			break;
			case 3:return 31;
			break;
			case 5:return 31;
			break;
			case 7:return 31;
			break;
			case 8:return 31;
			break;
			case 12:return 31;
			break;
			case 10:return 31;
			break;
			case 4:return 30;
			break;
			case 6:return 30;
			break;
			case 9:return 30;
			break;
			case 11:return 30;
			break;
			case 2:if($this->check_leap_year($year_no))
				{
					return 29;
				}
				else
				{
					return 28;
				}
			break;
		}
	}

	
	function get_current_month($mnth_no,$year_no)
	{
		return $year_no.$mnth_no."01";
	}

	function get_previous_month($mnth_no,$year_no)
	{
		if($mnth_no==1)
		{
			return ($year_no-1)."1201";
		}
		else
		{
			$mnth_no=$mnth_no-1;
			if(strlen($mnth_no)==1)
				$mnth_no="0".$mnth_no;
			return $year_no.$mnth_no."01";
		}
	}

	function get_next_month($mnth_no,$year_no)
	{
		if($mnth_no==12)
		{
			return ($year_no+1)."0101";
		}
		else
		{
			$mnth_no=$mnth_no+1;
			if(strlen($mnth_no)==1)
				$mnth_no="0".$mnth_no;
			return $year_no.$mnth_no."01";
		}
	}	
	
	function get_previous_year($mnth_no,$year_no)
	{
		if($mnth_no==1)
		{
			return ($year_no-1)."1201";
		}
		else
		{
			$year_no=$year_no-1;
			if(strlen($mnth_no)==1)
				$mnth_no="0".$mnth_no;
			return $year_no.$mnth_no."01";
		}
	}
	
	function get_next_year($mnth_no,$year_no)
	{
		if($mnth_no==1)
		{
			return ($year_no+1)."1201";
		}
		else
		{
//			$mnth_no=$mnth_no+1;
			$year_no=$year_no+1;
			if(strlen($mnth_no)==1)
				$mnth_no="0".$mnth_no;
			return $year_no.$mnth_no."01";
		}
	}	

	function get_previous_month_num($mnth_no,$year_no,$num)
	{
		$mnth_no = intval(intval($mnth_no)-intval($num));
		if($mnth_no<=0)
		{
			$mnth_no = abs($mnth_no);
			$i = floor($mnth_no/12);
			$mnth_no = 12-($mnth_no%12);
			if(strlen($mnth_no)==1)
				$mnth_no="0".$mnth_no;
			return ($year_no-($i+1)).$mnth_no."01";
		}
		else
		{
			if(strlen($mnth_no)==1)
				$mnth_no="0".$mnth_no;
			return $year_no.$mnth_no."01";
		}
	}

	function get_next_month_num($mnth_no,$year_no,$num)
	{
		$mnth_no = intval(intval($mnth_no)+intval($num));
		if($mnth_no>12)
		{
			$mnth_no = $mnth_no-12;
			if(strlen($mnth_no)==1)
				$mnth_no="0".$mnth_no;
			return ($year_no+1).$mnth_no."01";
		}
		else
		{
			if(strlen($mnth_no)==1)
				$mnth_no="0".$mnth_no;
			return $year_no.$mnth_no."01";
		}
	}
	

	
	
	function get_booking_days($month,$year,$propertyid)
	{	
		
		$start_days_arr = array();
		$end_days_arr = array();
		$start_months_arr = array();
		$end_months_arr = array();
		$start_years_arr = array();
		$end_years_arr = array();
		
		$days = array();
		$days_type = array();
		$payment=array();
		$sameday=array();
		$sql = "SELECT * FROM property_calendar_ical WHERE prop_id=".$propertyid." and ((start_date between '".mktime("0","0","0",$month,"1",$year)."' and '".mktime("11","59","59",$month,$this->get_month_days($month,$year),$year)."') or (end_date between '".mktime("0","0","0",$month,"1",$year)."' and '".mktime("11","59","59",$month,$this->get_month_days($month,$year),$year)."') or (start_date<='".mktime("0","0","0",$month,"1",$year)."' and end_date>='".mktime("11","59","59",$month,$this->get_month_days($month,$year),$year)."'))";
		$query = $this->db->query($sql);		
		$k=0;
		$no_of_rows = $query->num_rows();
		$datar = $query->result_array();
		
		if($no_of_rows>0){
			foreach($datar as $data){
			if((date("Y", (int)$data['start_date']) == date("Y",(int)$data['end_date'])) && (date("m",(int)$data['start_date']) == date("m",(int)$data['end_date'])))
			{
				$start_day = date("j",(int)$data['start_date']);
				$end_day = date("j",(int)$data['end_date']);
				
				$start_months_arr = array_merge($start_months_arr,array(date("m",(int)$data['start_date'])));
				$end_months_arr = array_merge($end_months_arr,array(date("m",(int)$data['end_date'])));
				$start_years_arr = array_merge($start_years_arr,array(date("Y",(int)$data['start_date'])));
				$end_years_arr = array_merge($end_years_arr,array(date("Y",(int)$data['end_date'])));
				
				for($i=$start_day;$i<=$end_day;$i++)
				{
					$days[$k] = $i;
					$days_type[$i] = '1';
					if($data['payment_status'])
					$payment[$i]='1';
					if($data['start_date']==$data['end_date'])
					$sameday[$i]='1';
					$k++;
				}
				
				$start_days_arr = array_merge($start_days_arr,array($start_day));
				$end_days_arr = array_merge($end_days_arr,array($end_day));
			}
			
			if((date("Y",(int)$data['start_date']) == date("Y",(int)$data['end_date'])) && (date("m",(int)$data['start_date']) < date("m",(int)$data['end_date'])))
			{
				$start_years_arr = array_merge($start_years_arr,array(date("Y",$data['start_date'])));
				$end_years_arr = array_merge($end_years_arr,array(date("Y",$data['end_date'])));
				
				for($j=intval(date("m",$data['start_date']));$j<=date("m",$data['end_date']);$j++)
				{
					if($j==$month)
					{
						if($j==intval(date("m",$data['start_date'])))
						{	
							$start_day = date("j",$data['start_date']);
							$start_months_arr = array_merge($start_months_arr,array(date("m",$data['start_date'])));
							$start_days_arr = array_merge($start_days_arr,array($start_day));
						}
						else
						{
							$start_day = 01;
						}
						
						if($j==date("m",$data['end_date']))
						{
							$end_day = date("j",$data['end_date']);
							$end_months_arr = array_merge($end_months_arr,array(date("m",$data['end_date'])));
							$end_days_arr = array_merge($end_days_arr,array($end_day));
						}
						else
						{
							$end_day = $this->get_month_days($j,date("Y",$data['start_date']));
						}
						
						for($i=$start_day;$i<=$end_day;$i++)
						{
							$days[$k] = $i;
							$days_type[$i] = '1';
							if($data['payment_status'])
							$payment[$i]='1';
							if($data['start_date']==$data['end_date'])
							$sameday[$i]='1';
							$k++;
						}
					}
				}
			}
			
			if(date("Y",(int)$data['start_date']) < date("Y",(int)$data['end_date']))
			{
				for($a=intval(date("Y",$data['start_date']));$a<=intval(date("Y",$data['end_date']));$a++)
				{
					if($a == date("Y",$data['start_date']))
					{
						$start_years_arr = array_merge($start_years_arr,array(date("Y",$data['start_date'])));
						$lower_month = intval(date("m",$data['start_date']));
						$upper_month = 12;
					}
					elseif($a == date("Y",$data['end_date']))
					{
						$lower_month = 1;
						$upper_month = intval(date("m",$data['end_date']));
						$end_years_arr = array_merge($end_years_arr,array(date("Y",$data['end_date'])));
					}
					else
					{
						$lower_month = 1;
						$upper_month = 12;
					}
		
					for($j=$lower_month;$j<=$upper_month;$j++)
					{
						if($j==$month && $a==$year)
						{
							if($j==intval(date("m",$data['start_date']))  && $a==date("Y",$data['start_date']))
							{
								$start_day = date("j",$data['start_date']);
								$start_days_arr = array_merge($start_days_arr,array($start_day));
								$start_months_arr = array_merge($start_months_arr,array(date("m",$data['start_date'])));
							}
							else
							{
								$start_day = 1;
							}
							
							if($j==date("m",$data['end_date']) && $a==date("Y",$data['end_date']))
							{
								$end_day = date("j",$data['end_date']);
								$end_days_arr = array_merge($end_days_arr,array($end_day));
								$end_months_arr = array_merge($end_months_arr,array(date("m",$data['end_date'])));
							}
							else
							{
								$end_day = $this->get_month_days($j,$a);
							}
							
							for($i=$start_day;$i<=$end_day;$i++)
							{
								$days[$k] = $i;
								$days_type[$i] = '1';
								if($data['payment_status'])
								$payment[$i]='1';
								if($data['start_date']==$data['end_date'])
								$sameday[$i]='1';
								$k++;
							}	
						}
					}
				}
			}		
		}
		}
		$this->gb_date['start_day'] = $start_days_arr;
		$this->gb_date['end_day'] = $end_days_arr;
		$this->gb_date['start_month'] = $start_months_arr;
		$this->gb_date['end_month'] = $end_months_arr;
		$this->gb_date['start_year'] = $start_years_arr;
		$this->gb_date['end_year'] = $end_years_arr;

		//echo implode(",",$end_days_arr);
		//echo "<br />".implode(",",$days);
		return array($days,$days_type,$payment,$sameday);
	}
	
	function show_calendar($date)
	{
		$curr_year=substr($date,0,4);
		$curr_month=substr($date,4,2);
		$curr_day=date("d");//substr($curr_date,6,2);
		echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" width=\"100%\">";
		echo "<tr><td align=\"center\" width=\"100%\" class=\"header\">";
		echo "<a href=\"index.php?page=calendar&date=".$curr_year.$curr_month."01\">".get_month($curr_month).$curr_year."</a>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
			echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"2\" width=\"100%\" align=\"center\" style=\"border:1px #ececec solid\">";
			echo "<tr>";
			echo "<td align=\"center\" width=\"14%\" style=\"border:1px #ececec solid\">Sun</td>";
			echo "<td align=\"center\" width=\"14%\" style=\"border:1px #ececec solid\">Mon</td>";
			echo "<td align=\"center\" width=\"14%\" style=\"border:1px #ececec solid\">Tue</td>";
			echo "<td align=\"center\" width=\"14%\" style=\"border:1px #ececec solid\">Wed</td>";
			echo "<td align=\"center\" width=\"14%\" style=\"border:1px #ececec solid\">Thu</td>";
			echo "<td align=\"center\" width=\"14%\" style=\"border:1px #ececec solid\">Fri</td>";
			echo "<td align=\"center\" width=\"14%\" style=\"border:1px #ececec solid\">Sat</td>";
			echo "</tr>";
			
			$curr_month_days=$this->get_month_days($curr_month,$curr_year);
			$days_before=date("w",mktime("0","0","0",$curr_month,1,$curr_year));
			$days_after_1=date("w",mktime("0","0","0",$curr_month,$curr_month_days,$curr_year));
			$days_after=6-$days_after_1;
			$no_of_weeks=ceil(($days_before+$curr_month_days+$days_after)/7);
				
			$count=0;
			while($count<($no_of_weeks*7))
			{
				if($count%7==0)
				{
					echo "<tr>";
				}
				echo "<td align=\"left\" valign=\"top\" style=\"border:1px #ececec solid\">";
				if($count<$days_before || $count>($days_before+$curr_month_days-1))
				{
					echo "&nbsp";
				}
				else
				{
					echo $count-$days_before+1;
				}
				echo "</td>";
				
				if($count%7==6)
				{
					echo "</tr>";
				}
				
				$count=$count+1;
			}
			echo "</table>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}

	



function get_event_property($month,$year,$propertyid)
{
	global $gb_date;
	$start_day = 0;
	$days_before = 0;
	$end_day = 0;
	$days = array();
	$sql = "SELECT * FROM property_calendar_ical where prop_id='".$propertyid."' and ((start_date between '".mktime("0","0","0",$month,"1",$year)."' and '".mktime("11","59","59",$month,$this->get_month_days($month,$year),$year)."') or (end_date between '".mktime("0","0","0",$month,"1",$year)."' and '".mktime("11","59","59",$month,$this->get_month_days($month,$year),$year)."') or (start_date<='".mktime("0","0","0",$month,"1",$year)."' and end_date>='".mktime("11","59","59",$month,$this->get_month_days($month,$year),$year)."'))";
	$k=0;
		
	$query = $this->db->query($sql);
	$no_of_rows = $query->num_rows();
	$datar = $query->result_array();

	if($no_of_rows>0){
		foreach($datar as $data){
		if((date("Y",$data['start_date']) == date("Y",$data['end_date'])) && (date("m",$data['start_date']) == date("m",$data['end_date']))){
			$start_day = date("d",$data['start_date']);
			$end_day = date("d",$data['end_date']);
			
			$gb_date['start_month'] = date("m",$data['start_date']);
			$gb_date['end_month'] = date("m",$data['end_date']);
			$gb_date['start_year'] = date("Y",$data['start_date']);
			$gb_date['end_year'] = date("Y",$data['end_date']);
			
			for($i=$start_day;$i<=$end_day;$i++){
				$days[$k] = $i;
				$k++;
			}
		}
		
	if((date("Y",$data['start_date']) == date("Y",$data['end_date'])) && (date("m",$data['start_date']) < date("m",$data['end_date']))){
			$gb_date['start_month'] = date("m",$data['start_date']);
			$gb_date['end_month'] = date("m",$data['end_date']);
			$gb_date['start_year'] = date("Y",$data['start_date']);
			$gb_date['end_year'] = date("Y",$data['end_date']);
			
			for($j=intval(date("m",$data['start_date']));$j<=date("m",$data['end_date']);$j++){
				if($j==$month){
					if($j==intval(date("m",$data['start_date']))){
						$start_day = date("d",$data['start_date']);
					}else{
						$start_day = 1;
					}
					
					if($j==date("m",$data['end_date'])){
						$end_day = date("d",$data['end_date']);
					}else{
						$end_day = $this->get_month_days($j,date("Y",$data['start_date']));
					}
					
					for($i=$start_day;$i<=$end_day;$i++){
						$days[$k] = $i;
						$k++;
					}
				}
			}
		}
		
		if(date("Y",$data['start_date']) < date("Y",$data['end_date']))
		{
			$gb_date['start_month'] = date("m",$data['start_date']);
			$gb_date['end_month'] = date("m",$data['end_date']);
			$gb_date['start_year'] = date("Y",$data['start_date']);
			$gb_date['end_year'] = date("Y",$data['end_date']);
			
			$upper_month = date("m",$data['end_date']);
			$upper_month = $upper_month + 12;
			
			for($j=intval(date("m",$data['start_date']));$j<=$upper_month;$j++){
				if($j>12){
					$x = $j - 12;
				}else{
					$x = $j;
				}
					
				if($x==$month){
					if($j==intval(date("m",$data['start_date']))){
						$start_day = date("d",$data['start_date']);
					}else{
						$start_day = 1;
					}
					
					if($x==date("m",$data['end_date'])){
						$end_day = date("d",$data['end_date']);
					}
					else
					{
						$end_day = $this->get_month_days($j,date("Y",$data['start_date']));
					}
					
					for($i=$start_day;$i<=$end_day;$i++)
					{
						$days[$k] = $i;
						$k++;
					}
				}
			}
		}		
	}	}
	$this->gb_date['start_day'] = $start_day;
	$this->gb_date['end_day'] = $end_day;
	
	return $days;
}

function show_property_calendar($date,$propertyid)
	{
		if(empty($_POST['type'])){
			$type = 0;
		}else{			
			$type = $_POST['type'];
		}
		$curr_year=substr($date,0,4);
		$curr_month=substr($date,4,2);
		$curr_day=date("j");//substr($curr_date,6,2);
		
		$tempreturn = array();
		$days = array();
		$days_type = array();
		$payment=array();
		$sameday=array();
		$tempreturn = $this->get_booking_days($curr_month,$curr_year,$propertyid);
		//echo "<pre>";print_r($tempreturn);
		$days = $tempreturn[0];
		$days_type = $tempreturn[1];
		
		$payment=$tempreturn[2];
		$sameday=$tempreturn[3];
		//echo "<pre>";print_r($payment);
		
	echo "<table>";
	echo "<tr>";
	echo "<td height='22' colspan='7' style='text-align:center'>";
	echo $this->get_month($curr_month)." - ".$curr_year;
	echo "</td></tr>";
	echo "<tr>";
	echo "<td style='text-align:center;border:1px solid #D5D3D3;' bgcolor='#E5E0E0'>Sun</td>";
	echo "<td style='text-align:center;border:1px solid #D5D3D3;' bgcolor='#E5E0E0'>Mon</td>";
	echo "<td style='text-align:center;border:1px solid #D5D3D3;' bgcolor='#E5E0E0'>Tue</td>";
	echo "<td style='text-align:center;border:1px solid #D5D3D3;' bgcolor='#E5E0E0'>Wed</td>";
	echo "<td style='text-align:center;border:1px solid #D5D3D3;' bgcolor='#E5E0E0'>Thu</td>";
	echo "<td style='text-align:center;border:1px solid #D5D3D3;' bgcolor='#E5E0E0'>Fri</td>";
	echo "<td style='text-align:center;border:1px solid #D5D3D3;' bgcolor='#E5E0E0'>Sat</td>";
	echo "</tr>";
			
			$curr_month_days=$this->get_month_days($curr_month,$curr_year);
			$days_before=date("w",mktime("0","0","0",$curr_month,1,$curr_year));
			$days_after_1=date("w",mktime("0","0","0",$curr_month,$curr_month_days,$curr_year));
			$days_after=6-$days_after_1;
			$no_of_weeks=ceil(($days_before+$curr_month_days+$days_after)/7);
				
			$count=0;
			while($count<($no_of_weeks*7))
			{
				if($count%7==0)
				{
					echo "<tr>";
				}
				
				if($count<$days_before || $count>($days_before+$curr_month_days-1))
				{
					echo "<td class='daysDead'>";
					echo "&nbsp";
					echo "</td>";
				}
				else
				{
					$this_day = $count-$days_before+1;
					$unique_this_day = array();
					$unique_this_day = array_count_values($days);
					//echo "<pre>";print_r($unique_this_day);
					if(in_array($this_day,$days))
					{
						
						if($days_type[$this_day] == "3")
						{
							//Booking Unavailable
							echo "<td align='center' valign='top' class='daysBookingUnavailable'>";
							echo "u".($count+1)."";
							echo "</td>";
						}
						
						else if(empty($payment))
						{
							echo "<td align='center' valign='top' class='daysTempBooking'>";
							//echo "<a title='Temp Reserved Day'>".($count-$days_before+1)."</a>";
							echo ($count-$days_before+1);
							echo "</td>";
						}
						else if(!empty($sameday))
						{
							echo "<td align='center' valign='top' class='showReservedDeparture'>";
							echo "<a title='Arival/Departure Same Day'>".($count-$days_before+1)."</a>";
							echo "</td>";
						}
						elseif($days_type[$this_day] == "2")
						{
							//Code sometime later for Tentative bookings
						}
						elseif(($unique_this_day[$this_day] > 1) && in_array($curr_month,$this->gb_date['start_month']) && in_array($curr_year,$this->gb_date['start_year']))
						{
							echo "<td align='center' valign='top' class='showReservedDeparture'>";
							echo "<a title='Arival/Departure Same Day'>".($count-$days_before+1)."</a>";
							//echo ($count-$days_before+1);
							echo "</td>";
						}
						elseif(in_array($this_day,$this->gb_date['start_day']) && in_array($curr_month,$this->gb_date['start_month']) && in_array($curr_year,$this->gb_date['start_year']))
						{
							echo "<td align='center' valign='top' class='showArival'>";
							//echo "<a title='Arival Day'>".($count-$days_before+1)."</a>";
							echo ($count-$days_before+1);
							echo "</td>";
						}						
						elseif(in_array($this_day,$this->gb_date['end_day']) && in_array($curr_month,$this->gb_date['end_month']) && in_array($curr_year,$this->gb_date['end_year']))
						{
							
							echo "<td align='center' valign='top' class='showDeparture'>";
							$d=($count-$days_before+1);
	        				$dtime=mktime("0","0","0",$curr_month,$d,$curr_year);
	        				//echo "<a title='Departure Day' href='/property-reservation-form.php?propid=".$propertyid."&action=reserv&date=".$dtime."'>".($count-$days_before+1)."</a>";
							//echo "<a title='Departure Day' href='/inquiry?propid=".$propertyid."&action=reserv&date=".$dtime."'>".($count-$days_before+1)."</a>";
							echo ($count-$days_before+1);
													
							
							//echo $count-$days_before+1;
							echo "</td>";
						}												
						else
						{
							echo "<td align='center' valign='top'class='showReserved'>";
							echo "<a title='Reserved Day'>".($count-$days_before+1)."</a>";
							echo "</td>";
						}
					}
					else
					{
						$this_day = $count-$days_before+1;
						if(mktime("0","0","0",$curr_month,$this_day,$curr_year) < mktime("0","0","0",date("m"),date("d"),date("Y")))
						{
							echo "<td class='daysDead'>";
							echo "<a title='Past Days'>".($count-$days_before+1)."</a>";  // Past Days of the Month
							echo "</td>";
						}else{
							$d=($count-$days_before+1);// Available Days of the Month
							$dtime=mktime("0","0","0",$curr_month,$d,$curr_year);
	        				echo "<td class='daysAvailable'>";
	        				//echo "<a title='Available Day' href='property-reservation-form.php?page=reservation&type=".$type."&propid=".$propertyid."&amp;action=reserv&date=".$dtime."'>".($count-$days_before+1)."</a>";
							//echo "<a title='Available Day' href='/inquiry?page=reservation&type=".$type."&propid=".$propertyid."&amp;action=reserv&date=".$dtime."'>".($count-$days_before+1)."</a>";
							echo ($count-$days_before+1);
	        				echo "</td>";
					}
				}
			}			
				if($count%7==6)
				{
					echo "</tr>";
				}
				
				$count=$count+1;
			}
			echo "</table>";
	}	

function show_property_page_calendar($date,$propertyid)
	{
		if(empty($_POST['type'])){
			$type = 0;
		}else{			
			$type = $_POST['type'];
		}
		$curr_year=substr($date,0,4);
		$curr_month=substr($date,4,2);
		$curr_day=date("j");//substr($curr_date,6,2);
		
		$tempreturn = array();
		$days = array();
		$days_type = array();
		$payment=array();
		$sameday=array();
		$tempreturn = $this->get_booking_days($curr_month,$curr_year,$propertyid);
		//echo "<pre>";print_r($tempreturn);
		$days = $tempreturn[0];
		$days_type = $tempreturn[1];
		
		$payment=$tempreturn[2];
		$sameday=$tempreturn[3];
		//echo "<pre>";print_r($payment);
		
	echo "<table style='width:100%;'>";
	echo "<tr>";
	echo "<td height='22' colspan='7' style='text-align:center'>";
	echo $this->get_month($curr_month)." - ".$curr_year;
	echo "</td></tr>";
	echo "<tr>";
	echo "<td class='dayHeading'>Sun</td>";
	echo "<td class='dayHeading'>Mon</td>";
	echo "<td class='dayHeading'>Tue</td>";
	echo "<td class='dayHeading'>Wed</td>";
	echo "<td class='dayHeading'>Thu</td>";
	echo "<td class='dayHeading'>Fri</td>";
	echo "<td class='dayHeading'>Sat</td>";
	echo "</tr>";
			
			$curr_month_days=$this->get_month_days($curr_month,$curr_year);
			$days_before=date("w",mktime("0","0","0",$curr_month,1,$curr_year));
			$days_after_1=date("w",mktime("0","0","0",$curr_month,$curr_month_days,$curr_year));
			$days_after=6-$days_after_1;
			$no_of_weeks=ceil(($days_before+$curr_month_days+$days_after)/7);
				
			$count=0;
			while($count<($no_of_weeks*7))
			{
				if($count%7==0)
				{
					echo "<tr>";
				}
				
				if($count<$days_before || $count>($days_before+$curr_month_days-1))
				{
					echo "<td class='daysDead tdBodr'>";
					echo "&nbsp";
					echo "</td>";
				}
				else
				{
					$this_day = $count-$days_before+1;
					$unique_this_day = array();
					$unique_this_day = array_count_values($days);
					//echo "<pre>";print_r($unique_this_day);
					if(in_array($this_day,$days))
					{
									
						if(empty($payment))
						{
							echo "<td class='daysTempBooking tdBodr'>";
							echo "<a title='Temp Reserved Day'>".($count-$days_before+1)."</a>";
							echo "</td>";
						}
						else if(!empty($sameday))
						{
							echo "<td class='showReservedDeparture tdBodr'>";
							echo "<a title='Arival/Departure Same Day'>".($count-$days_before+1)."</a>";
							echo "</td>";
						}
						elseif($days_type[$this_day] == "2")
						{
							//Code sometime later for Tentative bookings
						}
						elseif(($unique_this_day[$this_day] > 1) && in_array($curr_month,$this->gb_date['start_month']) && in_array($curr_year,$this->gb_date['start_year']))
						{
							echo "<td class='showReservedDeparture tdBodr'>";
							echo "<a title='Arival/Departure Same Day'>".($count-$days_before+1)."</a>";
							//echo ($count-$days_before+1);
							echo "</td>";
						}
						elseif(in_array($this_day,$this->gb_date['start_day']) && in_array($curr_month,$this->gb_date['start_month']) && in_array($curr_year,$this->gb_date['start_year']))
						{
							echo "<td class='showArival tdBodr'>";
							echo "<a title='Arival Day'>".($count-$days_before+1)."</a>";
							echo "</td>";
						}						
						elseif(in_array($this_day,$this->gb_date['end_day']) && in_array($curr_month,$this->gb_date['end_month']) && in_array($curr_year,$this->gb_date['end_year']))
						{
							
							echo "<td class='showDeparture tdBodr'>";
							$d=($count-$days_before+1);
	        				$dtime=mktime("0","0","0",$curr_month,$d,$curr_year);
	        				//echo "<a title='Departure Day' href='property-reservation-form.php?propid=".$propertyid."&action=reserv&date=".$dtime."'>".($count-$days_before+1)."</a>";
	        				//echo "<a title='Departure Day' href='/property/inquiry/".$propertyid."/".$dtime."'>".($count-$days_before+1)."</a>";
							echo "<a title='Departure Day'>".($count-$days_before+1)."</a>";
							
							//echo $count-$days_before+1;
							echo "</td>";
						}												
						else
						{
							echo "<td class='showReserved tdBodr'>";
							echo "<a title='Reserved Day'>".($count-$days_before+1)."</a>";
							echo "</td>";
						}
					}
					else
					{
						$this_day = $count-$days_before+1;
						if(mktime("0","0","0",$curr_month,$this_day,$curr_year) < mktime("0","0","0",date("m"),date("d"),date("Y")))
						{
							echo "<td class='daysDead tdBodr'>";
							echo "<a title='Past Days'>".($count-$days_before+1)."</a>";  // Past Days of the Month
							echo "</td>";
						}else{
							$d=($count-$days_before+1);// Available Days of the Month
							$dtime=mktime("0","0","0",$curr_month,$d,$curr_year);
	        				echo "<td class='daysAvailable tdBodr'>";
	        				//echo "<a style='color:#1E57DC' title='Available Day' href='/property-reservation-form.php?&propid=".$propertyid."&action=reserv&date=".$dtime."'>".($count-$days_before+1)."</a>";
							//echo "<a style='color:#1E57DC' title='Available Day' href='/property/inquiry/".$propertyid."/".$dtime."'>".($count-$days_before+1)."</a>";
							echo "<a style='color:#1E57DC' title='Available Day'>".($count-$days_before+1)."</a>";							
	        				echo "</td>";
					}
				}
			}			
				if($count%7==6)
				{
					echo "</tr>";
				}
				
				$count=$count+1;
			}
			echo "</table>";
	}



function show_combined_calendar($date,$propertyid)
{
	global $gb_date;
	$days_before = 0;
	$curr_year=substr($date,0,4);
	$curr_month=substr($date,4,2);
	$curr_day=date("j");//substr($curr_date,6,2);
	
	$days = array();
	$days = $this->get_event_property($curr_month,$curr_year,$propertyid);
	
		$curr_month_days=$this->get_month_days($curr_month,$curr_year);
		

		
		$count=0;
		while($count<$curr_month_days)
		{			
				$this_day = $count+1;
				$days_before = 0;
//				$this_day = $count-$days_before+1;
				if(mktime("0","0","0",$curr_month,$this_day,$curr_year) < mktime("0","0","0",date("m"),date("d"),date("Y")))
				{
					echo "<td class='daysDead'>";
					echo "<a title='Past Day'>".($count-$days_before+1)."</a>";  // Dead Days
					echo "</td>";
				}
				
				elseif(in_array($this_day,$days)){
					echo "<td class='showReserved'>";
					echo "<a title='Reserved Day'>".($count+1)."<a/>"; // Booked Days
					echo "</td>";
				}
				else{
					
					$d=($count-$days_before+1);// Available Days of the Month
					$dtime=mktime("0","0","0",$curr_month,$d,$curr_year);							
					echo "<td class='daysAvailable'>";
					//echo "<a title='Available Day' href='property-reservation-form.php?page=reservation&type=".$_GET['type']."&propid=".$propertyid."&action=reserv&date=".$dtime."'>".($count-$days_before+1)."</a>";
					//echo "<a title='Available Day' href='/inquiry?page=reservation&type=".$_GET['type']."&propid=".$propertyid."&action=reserv&date=".$dtime."'>".($count-$days_before+1)."</a>";
					echo ($count-$days_before+1);

					echo "</td>";

				}
			$count=$count+1;
		}
		//echo "</tr>";	
}


}