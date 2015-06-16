<?php
/**
 * Created by PhpStorm.
 * User: hiepnt1
 * Date: 3/26/2015
 * Time: 4:01 PM
 */
class testpdf extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mreport');

		$this->load->model('t_company_info');
		$this->load->model('t_company_profile');
		$this->load->model('mreport');
		$this->load->model('t_norm');
		$this->load->model('t_survey_question');
		$this->load->model('t_tracking');
		$this->load->model('t_participants_info');
	}

	public function draw_answer($number_table=0, $number_answer= 0, $selected = 0)
	{
		if($selected==0)
		{
			$array_location = array('x' => 0,  'y'=> 0, 'w' => 1, 'h' => 1 );
			return $array_location;
		}
		if($number_table==1)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 54, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 54, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 54, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 54, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 65, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 65, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 65, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 65, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 76, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 76, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 76, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 76, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else
			{
				return null;
			}
		}
		else if($number_table==2)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 105, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 105, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 105, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 105, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 116, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 116, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 116, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 116, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 127, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 127, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 127, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 127, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else
			{
				return null;
			}
		}
		else if($number_table==3)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 157, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 157, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 157, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 157, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 168, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 168, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 168, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 168, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 179, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 179, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 179, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 179, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else
			{
				return null;
			}
		}
		else if($number_table==4)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 209, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 209, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 209, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 209, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 220, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 220, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 220, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 220, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 231, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 231, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 231, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 231, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==4)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 242, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 242, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 242, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 242, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else
			{
				return null;
			}
		}
		else if($number_table==5)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 37, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 37, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 37, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 37, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 48, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 48, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 48, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 48, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 59, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 59, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 59, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 59, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==4)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 70, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 70, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 70, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 70, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else
			{
				return null;
			}
		}
		else if($number_table==6)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 98, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 98, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 98, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 98, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 109, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 109, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 109, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 109, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 120, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 120, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 120, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 120, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==4)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 131, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 131, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 131, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 131, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else
			{
				return null;
			}
		}
		else if($number_table==7)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 147, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 147, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 147, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 147, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 158, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 158, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 158, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 158, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 169, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 169, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 169, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 169, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==4)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 180, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 180, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 180, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 180, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else
			{
				return null;
			}
		}
		else if($number_table==8)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 196, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 196, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 196, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 196, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 207, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 207, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 207, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 207, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 218, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 218, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 218, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 218, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==4)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 229, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 229, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 229, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 229, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else
			{
				return null;
			}
		}
		else if($number_table==9)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 246, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 246, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 246, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 246, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 257, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 257, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 257, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 257, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 268, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 268, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 268, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 268, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==4)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 279, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 279, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 279, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 279, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else
			{
				return null;
			}
		}
		else if($number_table==10)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 37, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 37, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 37, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 37, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 48, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 48, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 48, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 48, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 59, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 59, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 59, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 59, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==4)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 70, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 70, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 70, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 70, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else
			{
				return null;
			}
		}
		else if($number_table==11)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 88, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 88, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 88, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 88, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 99, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 99, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 99, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 99, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 110, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 110, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 110, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 110, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else if($number_answer==4)
			{
				if($selected==1)
				{
					$array_location = array('x' => 82,  'y'=> 121, 'w' => 16, 'h' => 12 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 82,  'y'=> 121, 'w' => 33, 'h' => 12 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 82,  'y'=> 121, 'w' => 49, 'h' => 12 );
					return $array_location;
				}
				else
				{
					$array_location = array('x' => 82,  'y'=> 121, 'w' => 66, 'h' => 12 );
					return $array_location;
				}
			}
			else
			{
				return null;
			}
		}
		else
		{
			return null;
		}
	}

	public function draw_benchmark($number_table=0, $number_answer= 0, $selected= 0)
	{
		if($number_table==1)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 57, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 57, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 57, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 57, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 68, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 68, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 68, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 68, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 79, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 79, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 79, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 79, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else
			{
				return null;
			}
		}
		else if($number_table==2)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 108, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 108, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 108, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 108, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 119, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 119, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 119, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 119, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 130, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 130, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 130, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 130, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 141, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 141, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 141, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 141, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
		}
		else if($number_table==3)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 160, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 160, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 160, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 160, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 171, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 171, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 171, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 171, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 182, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 182, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 182, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 182, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 193, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 193, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 193, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 193, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
		}
		else if($number_table==4)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 212, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 212, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 212, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 212, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 223, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 223, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 223, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 223, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 234, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 234, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 234, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 234, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 245, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 245, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 245, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 245, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
		}
		else if($number_table==5)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 40, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 40, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 40, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 40, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 51, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 51, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 51, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 51, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 62, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 62, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 62, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 62, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 73, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 73, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 73, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 73, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
		}
		else if($number_table==6)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 101, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 101, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 101, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 101, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 112, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 112, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 112, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 112, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 123, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 123, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 123, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 123, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 134, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 134, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 134, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 134, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
		}
		else if($number_table==7)
		{

			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 150, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 150, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 150, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 150, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 161, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 161, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 161, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 161, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 172, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 172, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 172, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 172, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 183, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 183, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 183, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 183, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
		}
		else if($number_table==8)
		{

			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 199, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 199, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 199, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 199, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 210, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 210, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 210, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 210, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 221, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 221, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 221, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 221, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 232, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 232, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 232, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 232, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
		}
		else if($number_table==9)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 249, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 249, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 249, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 249, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 260, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 260, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 260, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 260, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 271, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 271, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 271, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 271, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 282, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 282, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 282, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 282, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
		}
		else if($number_table==10)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 40, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 40, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 40, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 40, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 51, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 51, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 51, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 51, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 62, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 62, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 62, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 62, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 73, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 73, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 73, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 73, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
		}
		else if($number_table==11)
		{
			if($number_answer==1)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 91, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 91, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 91, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 91, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==2)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 102, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 102, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 102, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 102, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else if($number_answer==3)
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 113, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 113, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 113, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 113, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
			else
			{
				if($selected==1)
				{
					$array_location = array('x' => 87,  'y'=> 124, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==2)
				{
					$array_location = array('x' => 104,  'y'=> 124, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==3)
				{
					$array_location = array('x' => 121,  'y'=> 124, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else if($selected==4)
				{
					$array_location = array('x' => 138,  'y'=> 124, 'w' => 5, 'h' => 5 );
					return $array_location;
				}
				else
				{
					return null;
				}
			}
		}
		else
		{
		}
	}

	public function create($id_company = 0, $id_survey = 0, $is_internal = true)
	{
 		$this->load->library('Mtcpdf');
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('');
		$pdf->SetTitle('');
		$pdf->SetSubject('');
		$pdf->SetKeywords('');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '', PDF_HEADER_STRING);
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		/**
		 * Page 1 - Cover
		 */
		$pdf->AddPage();
		$pdf->SetFont('centurygothic', 'N', 17);
		$pdf->setJPEGQuality(100);
		$pdf->set_ft_id_co("Company A");
		$pdf->set_ft_dt_create(date("d.m.Y"));
		$pdf->setPrintFooter(false);
		// get the current page break margin
		$bMargin = $pdf->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $pdf->getAutoPageBreak();
		// disable auto-page-break
		$pdf->SetAutoPageBreak(false, 0);
		// set bacground image
		// $img_file = K_PATH_IMAGES.'image_demo.jpg';
		$pdf->Image(base_url().'img/report_cover.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
		// restore auto-page-break status
		$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$pdf->setPageMark();
		/**
		 * Page 3 - Introduction
		 */
		$pdf->AddPage();
		$pdf->SetFont('centurygothic', 'N', 17);
		$pdf->setJPEGQuality(100);
		$pdf->setPrintFooter(true);
		$pdf->Bookmark('Introduction:::Overview of the HR Maturity Diagnostics tool', 0, 0, '', 'B', array(0,64,128));

		$html = "<div style='width:960px;float: left;'>
  		<h1 style=\"font-weight: normal;font-size: 30px;color: #0070C0; margin-bottom: 10px;margin-top: 0; padding: 0; \">Introduction</h1>
		<p style=\" font-size: 14px;margin:0px;width:960px;text-align: justify;\">The single greatest asset for any organization is its people and the culture they uphold. It is the people in an organization that innovate, market, produce and deliver the products and services that satisfy customer expectations and build relationships.</p>
		<p style=\"font-size: 14px;margin: 20px 0 0 0;width:960px;text-align: justify;\">The best run organizations across the world have systematically invested in their people, HR systems and processes for business success. Like many organizations, SMEs can also benefit by investing in talent and enhancing their HR capabilities to support their business growth. </p></div>";

		$pdf->Ln(0);

		$html .= "<h3 style=\"width:960px; font-weight: normal;font-size: 30px;color: #0070C0; padding: 0; margin: 0;\">Overview of the HR Maturity Diagnostics Tool</h3>
		<p style=\" font-size: 14px;margin:0px;width:960px;text-align: justify;\">Hay Group* developed the HR Maturity Diagnostics Tool (HRMD) for SMEs in Singapore to identify their HR needs and areas for improvement. The tool’s assessment of a company’s HR maturity is based on the HR Maturity Model, which is a growth framework that outlines progressive levels of HR maturity. These levels identify the state of HR maturity of a company, its management’s HR mindset, and key steps that the organization can take to attain greater HR maturity.</p>";

		$pdf->Ln(0);

		$html .= "<h1 style=\"width: 960px;font-weight: normal;font-size: 30px;color: #0070C0;\">How this report can help your organization</h1>
			<p style=\" font-size: 14px;margin:0px;width:960px;text-align: justify;\">The shareback report can help you to understand your organization’s:</p>";

		$pdf->Ln(0);

		$html .= "<table width=\"1160\" class=\"info\" style=\"float: left; font-size: 14px;\">
			<tr>
				<td style=\"width: 40px; text-align: right;\"><p>1. </p></td>
				<td style=\"font-size: 15px; text-align:left; padding-left: 25px; height: 70px;\">
					<p style=\"padding-left:30px;width:960px;text-align: justify;\"><span style=\"padding-left: 30px;font-weight: bold; font-size: 14px; text-decoration: underline; text-indent: 40px; \">Current state of HR maturity.</span> Your organization’s current state of HR maturity is determined through diagnosis of your HR processes and systems across 11 HR functional areas.</p>
				</td>
			</tr>
			<tr style='padding-bottom: 10px; float: left;'>
				<td style=\"width: 40px; text-align: right;\"><p>2. </p></td>
				<td style=\"font-size: 15px; text-align:left; padding-left: 25px; height: 90px;\">
					<p style=\"padding-left:30px;width:960px;text-align: justify;\"><span style=\"padding-left: 30px;font-weight: bold; font-size: 14px; text-decoration: underline; text-indent: 40px; \">HR Maturity Gaps.</span> Your organization’s state of HR maturity is mapped against an ideal state of HR maturity. This ideal state is identified based on the growth stage of your organization. The mapping of current versus ideal state of HR maturity would highlight HR gaps in the 11 HR functional areas.</p>
				</td>
			</tr>
			<tr style='padding-bottom: 10px; float: left;'>
				<td style=\"width: 40px; text-align: right;\"><p>3. </p></td>
				<td style=\"font-size: 15px; text-align:left; padding-left: 25px; height: 90px;\">
					<p style=\"padding-left:30px;width:960px;text-align: justify;\"><span style=\"padding-left: 30px;font-weight: bold; font-size: 14px; text-decoration: underline; text-indent: 40px; \">Strengths and Opportunities for Improvement.</span> The diagnosis of your current vis-à-vis the ideal HR maturity levels help to identify strengths and opportunities for improvement for your organization. These would help you to focus your resources and make human capital decisions that could further harness your organization’s strengths or address opportunities for improvement.</p>
				</td>
			</tr>
        </table>";
//		echo $html;exit;
		$pdf->SetXY(0, 7, true);
		//$pdf->writeHTML($html, true, 0, true, 0);
		$pdf->writeHTMLCell(180, 0, 15, 5, $html, 0, 0, false, true, '', false);
		/**
		 * Page 4 - Your HR Maturity Level
		 */
		$pdf->AddPage();
		$pdf->Bookmark('Your HR Maturity Level:::Description of the HR maturity level of your organization', 0, 0, '', 'B', array(0,64,128));
		$full_question = $this->mreport->get_full_question();
		$category = $this->mreport->get_category();
		$query = $this->mreport->get_data_by_id($id_company, $id_survey);

		$maturity_point = $query['POINT'][0]['INT_PT'];
		$maturity_level = ($maturity_point == 4 ? 4 : ($maturity_point < 4 && $maturity_point >= 3 ? 3 : ($maturity_point < 3 && $maturity_point >= 2 ? 2 : 1)));

		$html = '<div style="width: 960px; float: left;"><h1 style="color: #0070C0;width: 960px;font-weight: normal;font-size: 30px;color: #0070C0;">Your HR Maturity Level</h1>';
		$html .= '<p style="font-size:14px; padding-left:30px;width:960px;text-align: justify;">Your organization’s Overall HR Maturity Level is at <span style="font-weight: bold;">Level ';
		$html .= $this->convert_int_to_roman_numerals($maturity_level) . '</span></p>';
		$html .= '<p style="font-size:14px; padding-left:30px;width:960px;text-align: justify;">An organization at HR Maturity Level II is likely to have achieved a good level of standardization and compliance in its HR processes. Managers are beginning to take ownership of people management responsibilities. </p>';
		$html .= '<p style="font-size:14px; padding-left:30px;width:960px;text-align: justify;">Advancement to HR Maturity Level III will require the creation of a professional HR function. HR processes and systems will need to be formalised, and more deliberate efforts to engage and develop employees should be adopted.</p>';
		$html .= '</div>';

		$pdf->Image(base_url() . 'assets/tcpdf/img_report/maturity_' . $maturity_level . '.jpg', 10, 110, 250, 80, 'JPG', '', '', false, 100, '', false, false, 0, ' ', false, false);

		$pdf->SetXY(0, 7, true);
		//$pdf->writeHTML($html, true, 0, true, 0);
		$pdf->writeHTMLCell(180, 0, 15, 5, $html);
		/**
		 * Page 5 - Your HR Maturity Level
		 */
		$pdf->AddPage();
		$pdf->SetFont('centurygothic', 'N', 13);
		$pdf->setJPEGQuality(100);

		$html = '<div style="width: 960px; float: left;"><h1 style="color: #0070C0;font-size: 30px;color: #0070C0;font-weight: normal;">Your HR Maturity Level</h1></div>';

		$html .= "<table style='border-collapse: collapse;'>
			<tr style=\"background-color: #c2d69b; padding-top: 10px; padding-bottom: 10px;\">
				<td height=\"40\" valign=\"middle\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:bold;border:solid 1px #000000;\"><p>Process area</p></td>
				<td height=\"40\" valign=\"middle\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:bold;border:solid 1px #000000;\"><p>Current maturity level</p></td></tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">Recruitment</td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">" . $query['POINT'][0]['INT_CAT1'] . "</td>
			</tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">HR Management</td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">" . $query['POINT'][0]['INT_CAT2'] . "</td>
			</tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">Manpower Planning</td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">" . $query['POINT'][0]['INT_CAT3'] . "</td>
			</tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">Training & Development</td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">" . $query['POINT'][0]['INT_CAT4'] . "</td>
			</tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">Performance Management</td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">" . $query['POINT'][0]['INT_CAT5'] . "</td>
			</tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">Compensation & Benefits</td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">" . $query['POINT'][0]['INT_CAT6'] . "</td>
			</tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">Talent Management & Succession Planning</td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">" . $query['POINT'][0]['INT_CAT7'] . "</td>
			</tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">Organization Culture & Core Values</td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">" . $query['POINT'][0]['INT_CAT8'] . "</td>
			</tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">Employee Engagement & Communications</td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">" . $query['POINT'][0]['INT_CAT9'] . "</td>
			</tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">Employee Value Proposition</td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">" . $query['POINT'][0]['INT_CAT10'] . "</td>
			</tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">International Mobility</td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-weight:normal;border:solid 1px #000000;\">" . $query['POINT'][0]['INT_CAT11'] . "</td>
			</tr>
			<tr>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;border:solid 1px #000000;\"><strong>Overall</strong></td>
				<td height=\"60\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;border:solid 1px #000000;\"><strong>" . $query['POINT'][0]['INT_PT'] . "</strong></td>
			</tr>
		</table>";

		// echo $html;exit;
		$pdf->SetXY(0, 7, true);
		$pdf->writeHTMLCell(180, 0, 15, 5, $html);
		/**
		 * Page 6 - Your HR Maturity Gaps
		 */
		$pdf->AddPage();
		$pdf->Bookmark('Your HR Maturity Gaps:::Identification of the HR gaps in your organization', 0, 0, '', 'B', array(0,64,128));
		$pdf->SetFont('centurygothic', 'N', 13);
		$pdf->setJPEGQuality(100);

		$pdf->SetFont('centurygothic', 'N', 24);
		$pdf->setCellPaddings(5,1,0,0);
		$pdf->SetTextColor(23, 124, 198);
		$pdf->Cell(0, 5, "Your HR Maturity Level", 0, false, 'L', 0, '', 0, false, 'T', 'M');
		$pdf->Ln();
		$pdf->ImageSVG($file=base_url()."temp/COM_$id_company".".svg", $x=8, $y=36, $w=135, $h=110, $link='', $align='', $palign='', $border=0, $fitonpage=false);
		$pdf->Image(base_url().'img/report/HR_Maturity_Gaps_Note.jpg', 145, 44, 52, 0, 'JPG', '', '', false, 100, '', false, false, 0,' ', false, false);

//		$id_company
		$company_query = $this->t_company_info->get_data_by_id('*', $id_company);
		$company_profile_query = $this->t_company_profile->get_data_by_property('*', array('ID_COMPANY' => $company_query['ID_COMPANY']));
		$id_gs1 = $company_profile_query['ID_GS1'];
		$table_gap_name = '';
		switch ($id_gs1) {
			case 1:
				$table_gap_name = 'p5_table_gap_1';
				break;
			case 2:
				$table_gap_name = 'p5_table_gap_2';
				break;
			case 3:
				$table_gap_name = 'p5_table_gap_3';
				break;
			case 4:
				$table_gap_name = 'p5_table_gap_4';
				break;
			case 5:
				$table_gap_name = 'p5_table_gap_5';
				break;
		}

		$pdf->Image(base_url() . 'assets/tcpdf/img_report/' . $table_gap_name . '.jpg', 15, 160, 270, 100, 'JPG', '', '', false, 100, '', false, false, 0, ' ', false, false);
		/**
		 * Page 7 - Your HR Maturity Gaps
		 */
		$pdf->AddPage();
		$pdf->setCellPaddings(1,1,1,1);
		$pdf->SetFont('centurygothic', 'N', 13);
		$pdf->setJPEGQuality(100);

		$html = '<div style="width: 960px; float: left;"><h1 style="font-size: 30px;color: #0070C0;font-weight: normal;">Your HR Maturity Level</h1></div>';

		$pdf->SetXY(0, 7, true);
		$pdf->writeHTMLCell(180, 0, 15, 5, $html);

		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q1.jpg', $x = 15, $y = 43, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$pdf->SetTextColorArray(array(8, 112, 190));

		$question_in_table = $full_question[0]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, 17.5, 56.5, $question_in_table);
		$question_in_table = $full_question[1]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, 17.5, 67.5, $question_in_table);
		$question_in_table = $full_question[2]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, 17.5, 78.5, $question_in_table);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'B', 11);
		$temp_category = $category[0]['NM_CATEGORY'];
		$pdf->writeHTMLCell(0, 0, 15, 45.5, '1. ' . $temp_category);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		// DRAW ANSWER;


		for ($i = 0; $i < 34; $i++) {
			if (!isset($query['DRAW_ANSWER'][$i]['IN_POINT']) || empty($query['DRAW_ANSWER'][$i]['IN_POINT'])) {
				$query['DRAW_ANSWER'][$i]['IN_POINT'] = 0;
			}
			$query['GAP_CAL'][$i]['SUB'] = $query['DRAW_BENCHMARK'][$i]['IN_POINT'] - $query['DRAW_ANSWER'][$i]['IN_POINT'];
			if ($query['GAP_CAL'][$i]['SUB'] < 0) {
				//$query['GAP_CAL'][$i]['SUB'] = 0;
			}
		}
		$selected = $query['DRAW_ANSWER'][0]['IN_POINT'];
		$location = $this->draw_answer(1, 1, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][1]['IN_POINT'];
		$location = $this->draw_answer(1, 2, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][2]['IN_POINT'];
		$location = $this->draw_answer(1, 3, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW BENCHMARK

		$selected = $query['DRAW_BENCHMARK'][0]['IN_POINT'];

		$location = $this->draw_benchmark(1, 1, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][1]['IN_POINT'];
		$location = $this->draw_benchmark(1, 2, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][2]['IN_POINT'];
		$location = $this->draw_benchmark(1, 3, $selected);

		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);

		// TABLE 2
		// DRAW TABLE
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q2.jpg', $x = 15, $y = 94, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// QUESTION  4 - 7
		$pdf->SetTextColorArray(array(8, 112, 190));
		$pdf->SetFont('centurygothic', 'N', 11);
		$question_in_table = $full_question[3]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
		$question_in_table = $full_question[4]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
		$question_in_table = $full_question[5]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'B', 11);
		$x = 15;
		$y = 94;
		$temp_category = $category[1]['NM_CATEGORY'];
		$pdf->writeHTMLCell(0, 0, $x, ($y + 2.5), '2. ' . $temp_category);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		// DRAW ANSWER;

		$selected = $query['DRAW_ANSWER'][3]['IN_POINT'];
		$location = $this->draw_answer(2, 1, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][4]['IN_POINT'];
		$location = $this->draw_answer(2, 2, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][5]['IN_POINT'];
		$location = $this->draw_answer(2, 3, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW BENCHMARK

		$selected = $query['DRAW_BENCHMARK'][3]['IN_POINT'];

		$location = $this->draw_benchmark(2, 1, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][4]['IN_POINT'];
		$location = $this->draw_benchmark(2, 2, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][5]['IN_POINT'];
		$location = $this->draw_benchmark(2, 3, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);

		// TABLE 3

		// DRAW TABLE

		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q3.jpg', $x = 15, $y = 146, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$pdf->SetFont('centurygothic', 'N', 11);

		$question_in_table = $full_question[6]['NM_QUESTION'];
		$question_in_table = str_replace('Organisation', 'Org', $question_in_table);
		$pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
		$question_in_table = $full_question[7]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
		$question_in_table = $full_question[8]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'B', 11);
		$x = 15;
		$y = 146;
		$temp_category = $category[2]['NM_CATEGORY'];
		$pdf->writeHTMLCell(0, 0, $x, ($y + 2.5), '3. ' . $temp_category);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		// DRAW ANSWER;

		$selected = $query['DRAW_ANSWER'][6]['IN_POINT'];
		$location = $this->draw_answer(3, 1, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][7]['IN_POINT'];
		$location = $this->draw_answer(3, 2, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][8]['IN_POINT'];
		$location = $this->draw_answer(3, 3, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW BENCHMARK

		$selected = $query['DRAW_BENCHMARK'][6]['IN_POINT'];

		$location = $this->draw_benchmark(3, 1, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][7]['IN_POINT'];
		$location = $this->draw_benchmark(3, 2, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][8]['IN_POINT'];
		$location = $this->draw_benchmark(3, 3, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);

		// TABLE 4

		// DRAW TABLE

		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q4.jpg', $x = 15, $y = 198, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$pdf->SetFont('centurygothic', 'N', 11);
		$question_in_table = $full_question[9]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
		$question_in_table = $full_question[10]['NM_QUESTION'];
		$question_in_table = str_replace('and Development', '& Devt', $question_in_table);
		$pdf->SetFont('centurygothic', 'N', 11);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
		$pdf->SetFont('centurygothic', 'N', 11);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$question_in_table = $full_question[11]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
		$question_in_table = $full_question[12]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 33), $question_in_table);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'B', 11);
		$x = 15;
		$y = 198;
		$temp_category = $category[3]['NM_CATEGORY'];
		$pdf->writeHTMLCell(0, 0, $x, ($y + 2.5), '4. ' . $temp_category);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		// DRAW ANSWER;

		$selected = $query['DRAW_ANSWER'][9]['IN_POINT'];
		$location = $this->draw_answer(4, 1, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][10]['IN_POINT'];
		$location = $this->draw_answer(4, 2, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][11]['IN_POINT'];
		$location = $this->draw_answer(4, 3, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][12]['IN_POINT'];
		$location = $this->draw_answer(4, 4, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);

		// DRAW BENCHMARK

		$selected = $query['DRAW_BENCHMARK'][9]['IN_POINT'];

		$location = $this->draw_benchmark(4, 1, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][10]['IN_POINT'];
		$location = $this->draw_benchmark(4, 2, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][11]['IN_POINT'];
		$location = $this->draw_benchmark(4, 3, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][12]['IN_POINT'];
		$location = $this->draw_benchmark(4, 4, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);

		// DRAW GAP AND CURRENT
		$pdf->SetFont('centurygothic', 'N', 22);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$html = $query['GAP_CAL'][0]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 54, $html);
		$html = $query['GAP_CAL'][1]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 65, $html);
		$html = $query['GAP_CAL'][2]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 76, $html);
		$html = $query['GAP_CAL'][3]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 105, $html);
		$html = $query['GAP_CAL'][4]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 116, $html);
		$html = $query['GAP_CAL'][5]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 127, $html);
		$html = $query['GAP_CAL'][6]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 157, $html);
		$html = $query['GAP_CAL'][7]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 167, $html);
		$html = $query['GAP_CAL'][8]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 178, $html);
		$html = $query['GAP_CAL'][9]['SUB'];
		$pdf->writeHTMLCell(20, 10, 153, 209, $html);
		$html = $query['GAP_CAL'][10]['SUB'];
		$pdf->writeHTMLCell(20, 10, 153, 220, $html);
		$html = $query['GAP_CAL'][11]['SUB'];
		$pdf->writeHTMLCell(20, 10, 153, 231, $html);
		$html = $query['GAP_CAL'][12]['SUB'];
		$pdf->writeHTMLCell(20, 10, 153, 242, $html);
		// DRAW  CURRENT

		$total_point = 0;
		$pdf->SetFont('centurygothic', 'N', 24);
		$temp = ($query['DRAW_ANSWER'][0]['IN_POINT'] + $query['DRAW_ANSWER'][1]['IN_POINT'] + $query['DRAW_ANSWER'][2]['IN_POINT']) / 3;
		$temp = floor($temp * 10) / 10;
		$total_point = $total_point + $temp;
		$html = $temp;

		$pdf->writeHTMLCell(0, 0, 175, 64, $html);
		$temp = ($query['DRAW_ANSWER'][3]['IN_POINT'] + $query['DRAW_ANSWER'][4]['IN_POINT'] + $query['DRAW_ANSWER'][5]['IN_POINT']) / 3;
		$temp = floor($temp * 10) / 10;
		$total_point = $total_point + $temp;
		$html = $temp;
		$pdf->writeHTMLCell(0, 0, 175, 116, $html);
		$temp = ($query['DRAW_ANSWER'][6]['IN_POINT'] + $query['DRAW_ANSWER'][7]['IN_POINT'] + $query['DRAW_ANSWER'][8]['IN_POINT']) / 3;
		$temp = floor($temp * 10) / 10;
		$total_point = $total_point + $temp;
		$html = $temp;
		$pdf->writeHTMLCell(0, 0, 175, 167, $html);
		$temp = ($query['DRAW_ANSWER'][9]['IN_POINT'] + $query['DRAW_ANSWER'][10]['IN_POINT'] + $query['DRAW_ANSWER'][11]['IN_POINT'] + $query['DRAW_ANSWER'][12]['IN_POINT']) / 4;
		$temp = floor($temp * 10) / 10;
		$total_point = $total_point + $temp;
		$html = $temp;
		$pdf->writeHTMLCell(0, 0, 175, 225, $html);
		// here
		$pdf->lastPage();
		// PAGE 10
		/**
		 * Page 8 - Your HR Strengths & Opportunities
		 */
		$pdf->AddPage();

		$pdf->SetX(20);
		$pdf->SetFont('centurygothic', 'N', 17);
		$pdf->setJPEGQuality(100);
		// TABLE 5

		// DRAW TABLE

		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q5.jpg', $x = 15, $y = 26, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$pdf->SetFont('centurygothic', 'N', 11);
		$question_in_table = $full_question[13]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
		$question_in_table = $full_question[14]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
		$question_in_table = $full_question[15]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
		$question_in_table = $full_question[16]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 33), $question_in_table);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'B', 11);
		$x = 15;
		$y = 26;
		$temp_category = $category[4]['NM_CATEGORY'];
		$pdf->writeHTMLCell(0, 0, $x, ($y + 2.5), '5. ' . $temp_category);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		// DRAW ANSWER;

		$selected = $query['DRAW_ANSWER'][13]['IN_POINT'];
		$location = $this->draw_answer(5, 1, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][14]['IN_POINT'];
		$location = $this->draw_answer(5, 2, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][15]['IN_POINT'];
		$location = $this->draw_answer(5, 3, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][16]['IN_POINT'];
		$location = $this->draw_answer(5, 4, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);

		// DRAW BENCHMARK

		$selected = $query['DRAW_BENCHMARK'][13]['IN_POINT'];

		$location = $this->draw_benchmark(5, 1, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][14]['IN_POINT'];
		$location = $this->draw_benchmark(5, 2, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][15]['IN_POINT'];
		$location = $this->draw_benchmark(5, 3, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][16]['IN_POINT'];
		$location = $this->draw_benchmark(5, 4, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// TABLE 6
		// DRAW TABLE
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q6.jpg', $x = 15, $y = 87, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$pdf->SetFont('centurygothic', 'N', 11);
		$question_in_table = $full_question[17]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
		$question_in_table = $full_question[18]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
		$question_in_table = $full_question[19]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'B', 11);
		$x = 15;
		$y = 87;
		$temp_category = $category[5]['NM_CATEGORY'];
		$pdf->writeHTMLCell(60, 0, $x, ($y), '6. ' . $temp_category);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		// DRAW ANSWER;
		$selected = $query['DRAW_ANSWER'][17]['IN_POINT'];
		$location = $this->draw_answer(6, 1, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][18]['IN_POINT'];
		$location = $this->draw_answer(6, 2, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][19]['IN_POINT'];
		$location = $this->draw_answer(6, 3, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW BENCHMARK
		$selected = $query['DRAW_BENCHMARK'][17]['IN_POINT'];
		$location = $this->draw_benchmark(6, 1, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][18]['IN_POINT'];
		$location = $this->draw_benchmark(6, 2, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][19]['IN_POINT'];
		$location = $this->draw_benchmark(6, 3, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// TABLE 7
		// DRAW TABLE
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q7.jpg', $x = 15, $y = 136, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$pdf->SetFont('centurygothic', 'N', 11);
		$question_in_table = $full_question[20]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
		$question_in_table = $full_question[21]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
		$question_in_table = $full_question[22]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'B', 11);
		$x = 15;
		$y = 136;
		$temp_category = $category[6]['NM_CATEGORY'];
		$pdf->writeHTMLCell(60, 0, $x, ($y), '7. ' . $temp_category);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		// DRAW ANSWER;
		$selected = $query['DRAW_ANSWER'][20]['IN_POINT'];
		$location = $this->draw_answer(7, 1, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][21]['IN_POINT'];
		$location = $this->draw_answer(7, 2, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][22]['IN_POINT'];
		$location = $this->draw_answer(7, 3, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW BENCHMARK
		$selected = $query['DRAW_BENCHMARK'][20]['IN_POINT'];
		$location = $this->draw_benchmark(7, 1, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][21]['IN_POINT'];
		$location = $this->draw_benchmark(7, 2, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][22]['IN_POINT'];
		$location = $this->draw_benchmark(7, 3, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// TABLE 8
		// DRAW TABLE
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q8.jpg', $x = 15, $y = 185, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$pdf->SetFont('centurygothic', 'N', 11);
		$question_in_table = $full_question[23]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
		$question_in_table = $full_question[24]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
		$question_in_table = $full_question[25]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 22), $question_in_table);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'B', 11);
		$x = 15;
		$y = 185;
		$temp_category = $category[7]['NM_CATEGORY'];
		$pdf->writeHTMLCell(60, 0, $x, ($y), '8. ' . $temp_category);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		// DRAW ANSWER;
		$selected = $query['DRAW_ANSWER'][23]['IN_POINT'];
		$location = $this->draw_answer(8, 1, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][24]['IN_POINT'];
		$location = $this->draw_answer(8, 2, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][25]['IN_POINT'];
		$location = $this->draw_answer(8, 3, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW BENCHMARK
		$selected = $query['DRAW_BENCHMARK'][23]['IN_POINT'];
		$location = $this->draw_benchmark(8, 1, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][24]['IN_POINT'];;
		$location = $this->draw_benchmark(8, 2, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][25]['IN_POINT'];
		$location = $this->draw_benchmark(8, 3, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// TABLE 9
		// DRAW TABLE
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q9.jpg', $x = 15, $y = 235, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$pdf->SetFont('centurygothic', 'N', 11);
		$question_in_table = $full_question[26]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
		$question_in_table = $full_question[27]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'B', 11);
		$x = 15;
		$y = 235;
		$temp_category = $category[8]['NM_CATEGORY'];
		$pdf->writeHTMLCell(60, 0, $x, ($y), '9. ' . $temp_category);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		// DRAW ANSWER;
		$selected = $query['DRAW_ANSWER'][26]['IN_POINT'];
		$location = $this->draw_answer(9, 1, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][27]['IN_POINT'];
		$location = $this->draw_answer(9, 2, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW BENCHMARK
		$selected = $query['DRAW_BENCHMARK'][26]['IN_POINT'];
		$location = $this->draw_benchmark(9, 1, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][27]['IN_POINT'];
		$location = $this->draw_benchmark(9, 2, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW GAP
		$pdf->SetFont('centurygothic', 'N', 22);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$html = $query['GAP_CAL'][13]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 37, $html);
		$html = $query['GAP_CAL'][14]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 48, $html);
		$html = $query['GAP_CAL'][15]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 59, $html);
		$html = $query['GAP_CAL'][16]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 70, $html);
		$html = $query['GAP_CAL'][17]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 98, $html);
		$html = $query['GAP_CAL'][18]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 109, $html);
		$html = $query['GAP_CAL'][19]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 120, $html);
		$html = $query['GAP_CAL'][20]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 148, $html);
		$html = $query['GAP_CAL'][21]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 159, $html);
		$html = $query['GAP_CAL'][22]['SUB'];
		$pdf->writeHTMLCell(20, 10, 153, 170, $html);
		$html = $query['GAP_CAL'][23]['SUB'];
		$pdf->writeHTMLCell(20, 10, 153, 196, $html);
		$html = $query['GAP_CAL'][24]['SUB'];
		$pdf->writeHTMLCell(20, 10, 153, 207, $html);
		$html = $query['GAP_CAL'][25]['SUB'];
		$pdf->writeHTMLCell(20, 10, 153, 218, $html);
		$html = $query['GAP_CAL'][26]['SUB'];
		$pdf->writeHTMLCell(20, 10, 153, 246, $html);
		$html = $query['GAP_CAL'][27]['SUB'];
		$pdf->writeHTMLCell(20, 10, 153, 257, $html);
		// DRAW  CURRENT
		$pdf->SetFont('centurygothic', 'N', 24);
		$temp = ($query['DRAW_ANSWER'][13]['IN_POINT'] + $query['DRAW_ANSWER'][14]['IN_POINT'] + $query['DRAW_ANSWER'][15]['IN_POINT'] + $query['DRAW_ANSWER'][16]['IN_POINT']) / 4;
		$temp = floor($temp * 10) / 10;
		$total_point = $total_point + $temp;
		$html = $temp;
		$pdf->writeHTMLCell(0, 0, 175, 53, $html);
		$temp = ($query['DRAW_ANSWER'][17]['IN_POINT'] + $query['DRAW_ANSWER'][18]['IN_POINT'] + $query['DRAW_ANSWER'][19]['IN_POINT']) / 3;
		$temp = floor($temp * 10) / 10;
		$total_point = $total_point + $temp;
		$html = $temp;
		$pdf->writeHTMLCell(0, 0, 175, 109, $html);
		$temp = ($query['DRAW_ANSWER'][20]['IN_POINT'] + $query['DRAW_ANSWER'][21]['IN_POINT'] + $query['DRAW_ANSWER'][22]['IN_POINT']) / 3;
		$temp = floor($temp * 10) / 10;
		$total_point = $total_point + $temp;
		$html = $temp;
		$pdf->writeHTMLCell(0, 0, 175, 159, $html);
		$temp = ($query['DRAW_ANSWER'][23]['IN_POINT'] + $query['DRAW_ANSWER'][24]['IN_POINT'] + $query['DRAW_ANSWER'][25]['IN_POINT']) / 3;
		$temp = floor($temp * 10) / 10;
		$total_point = $total_point + $temp;
		$html = $temp;
		$pdf->writeHTMLCell(0, 0, 175, 207, $html);
		$temp = ($query['DRAW_ANSWER'][26]['IN_POINT'] + $query['DRAW_ANSWER'][27]['IN_POINT']) / 2;
		$temp = floor($temp * 10) / 10;
		$total_point = $total_point + $temp;
		$html = $temp;
		$pdf->writeHTMLCell(0, 0, 175, 251, $html);
		$pdf->lastPage();
		/**
		 * Page 9 - Your HR Strengths & Opportunities
		 */
		$pdf->AddPage();
		$pdf->SetX(20);
		$pdf->SetFont('centurygothic', 'N', 17);
		$pdf->setJPEGQuality(100);
		// TABLE 10
		// DRAW TABLE
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q10.jpg', $x = 15, $y = 26, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$pdf->SetFont('centurygothic', 'N', 11);
		$question_in_table = $full_question[28]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
		$question_in_table = $full_question[29]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, ($y + 13.5 + 11), $question_in_table);
		$question_in_table = $full_question[30]['NM_QUESTION'];
		$pdf->writeHTMLCell(55, 0, $x + 2.5, ($y + 11.5 + 22), $question_in_table);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'B', 11);
		$x = 15;
		$y = 26;
		$temp_category = $category[9]['NM_CATEGORY'];
		$pdf->writeHTMLCell(70, 0, $x, ($y), '10. ' . $temp_category);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		// DRAW ANSWER;
		$selected = $query['DRAW_ANSWER'][28]['IN_POINT'];
		$location = $this->draw_answer(10, 1, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][29]['IN_POINT'];
		$location = $this->draw_answer(10, 2, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][30]['IN_POINT'];
		$location = $this->draw_answer(10, 3, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW BENCHMARK
		$selected = $query['DRAW_BENCHMARK'][28]['IN_POINT'];
		$location = $this->draw_benchmark(10, 1, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][29]['IN_POINT'];
		$location = $this->draw_benchmark(10, 2, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][30]['IN_POINT'];
		$location = $this->draw_benchmark(10, 3, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// TABLE 11
		// DRAW TABLE
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p9_q11.jpg', $x = 15, $y = 77, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$pdf->SetFont('centurygothic', 'N', 11);
		$question_in_table = $full_question[31]['NM_QUESTION'];
		$pdf->writeHTMLCell(0, 0, $x + 2.5, $y + 13.5, $question_in_table);
		$question_in_table = $full_question[32]['NM_QUESTION'];
		$pdf->writeHTMLCell(65, 0, $x + 2.5, ($y + 11.5 + 11), $question_in_table);
		$question_in_table = $full_question[33]['NM_QUESTION'];
		$pdf->writeHTMLCell(55, 0, $x + 2.5, ($y + 11.5 + 22), $question_in_table);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'B', 11);
		$x = 15;
		$y = 77;
		$temp_category = $category[10]['NM_CATEGORY'];
		$pdf->writeHTMLCell(70, 0, $x, ($y + 2.5), '11. ' . $temp_category);
		$pdf->SetTextColorArray(array(0, 0, 0));
		$pdf->SetFont('centurygothic', 'N', 12);
		// DRAW ANSWER;
		$selected = $query['DRAW_ANSWER'][31]['IN_POINT'];
		$location = $this->draw_answer(11, 1, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][32]['IN_POINT'];
		$location = $this->draw_answer(11, 2, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_ANSWER'][33]['IN_POINT'];
		$location = $this->draw_answer(11, 3, $selected);
		$pdf->Image(base_url() . "assets/tcpdf/img_report/$selected.jpg", $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW BENCHMARK
		$selected = $query['DRAW_BENCHMARK'][31]['IN_POINT'];
		$location = $this->draw_benchmark(11, 1, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][32]['IN_POINT'];
		$location = $this->draw_benchmark(11, 2, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$selected = $query['DRAW_BENCHMARK'][33]['IN_POINT'];
		$location = $this->draw_benchmark(11, 3, $selected);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/tick_black.png', $x = $location['x'], $y = $location['y'], $w = $location['w'], $h = $location['h'], 'PNG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW GAP
		$pdf->SetFont('centurygothic', 'N', 22);
		$pdf->SetTextColorArray(array(8, 112, 190));
		$html = $query['GAP_CAL'][28]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 37, $html);
		$html = $query['GAP_CAL'][29]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 48, $html);
		$html = $query['GAP_CAL'][30]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 59, $html);
		$html = $query['GAP_CAL'][31]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 88, $html);
		$html = $query['GAP_CAL'][32]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 99, $html);
		$html = $query['GAP_CAL'][33]['SUB'];
		$pdf->writeHTMLCell(10, 10, 153, 110, $html);
		// DRAW INFORMATION FOR SURVEY
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p11_total.jpg', $x = 15, $y = 127, $w = 183, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		$pdf->Image(base_url() . 'assets/tcpdf/img_report/p11_note_color.jpg', $x = 15, $y = 230, $w = 70, $h = 0, 'JPG', '', '', false, 300, '', false, false, 0, ' ', false, false);
		// DRAW  CURRENT
		$pdf->SetFont('centurygothic', 'N', 24);
		$temp = ($query['DRAW_ANSWER'][28]['IN_POINT'] + $query['DRAW_ANSWER'][29]['IN_POINT'] + $query['DRAW_ANSWER'][30]['IN_POINT']) / 3;
		$temp = floor($temp * 10) / 10;
		$total_point = $total_point + $temp;
		$html = $temp;
		$pdf->writeHTMLCell(0, 0, 175, 48, $html);
		$temp = ($query['DRAW_ANSWER'][31]['IN_POINT'] + $query['DRAW_ANSWER'][32]['IN_POINT'] + $query['DRAW_ANSWER'][33]['IN_POINT']) / 3;
		$temp = floor($temp * 10) / 10;
		$total_point = $total_point + $temp;
		$html = $temp;
		$pdf->writeHTMLCell(0, 0, 175, 99, $html);
		$html = floor(($total_point / 11) * 10) / 10;
		$pdf->SetTextColorArray(array(255, 255, 255));
		$pdf->writeHTMLCell(0, 0, 175, 125.5, $html);

		$pdf->AddPage();
		$pdf->Bookmark('Your HR Strengths and Opportunities:::Presentation of your organization’s key HR strengths and opportunities for improvement', 0, 0, '', 'B', array(0,64,128));
		$pdf->SetX(20);
		$pdf->SetFont('centurygothic', 'N', 17);
		$pdf->setJPEGQuality(100);

		/* load positive gap  */
		$positive_gaps = array();
		$negative_gaps = array();

		foreach ($query['GAP_CAL'] as $key => $value) {
			if ($value['SUB'] >= 0) {
				$gap_item = new stdClass();
				$gap_item->question_id = $key + 1;
				$gap_item->score = $value['SUB'];
				$norms = $this->t_norm->get_norm_score($gap_item->question_id);
				$gap_item->norms = ($norms != null ? $norms : '-');
				foreach ($query['GAP_RECOMMENDATION'] as $value) {
					if ($gap_item->question_id == $value['ID_QUESTION']) {
						$gap_item->recommendation = ($value['TX_RECOMMENDATION'] != '' ? $value['TX_RECOMMENDATION'] : 'Work in Progress');
						$gap_item->question_name = $value['NM_QUESTION'];
						$gap_item->notes = $value['TX_NOTES'];
						break;
					}
				}
				array_push($positive_gaps, $gap_item);
			} else {
				$gap_item = new stdClass();
				$gap_item->question_id = $key + 1;
				$gap_item->score = $value['SUB'];
				$norms = $this->t_norm->get_norm_score($gap_item->question_id);
				$gap_item->norms = ($norms != null ? $norms : '-');
				foreach ($query['GAP_RECOMMENDATION'] as $value) {
					if ($gap_item->question_id == $value['ID_QUESTION']) {
						$gap_item->recommendation = ($value['TX_RECOMMENDATION'] != '' ? $value['TX_RECOMMENDATION'] : 'Work in Progress');
						$gap_item->question_name = $value['NM_QUESTION'];
						$gap_item->notes = $value['TX_NOTES'];
						break;
					}
				}
				array_push($negative_gaps, $gap_item);
			}
		}

		$html = '<div style="width: 960px; float: left;"><h1 style="color: #0070C0;font-size: 30px;color: #0070C0;font-weight: normal;">Your HR Strengths & Opportunities</h1></div>';
		$html .= '<div style="width: 960px; float: left;"><h1 style="color: #0070C0;font-size: 30px;color: #0070C0;font-weight: normal; text-decoration: underline; ">Strengths</h1></div>';

		$html .= "<table style=\"border-collapse: collapse;\">
			<tr style=\"background-color: #c2d69b; padding-top: 10px; padding-bottom: 10px;\">
				<td width=\"" . ($is_internal ? '20%': '30%') . "\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-size:15px;font-weight:bold;border:solid 1px #000000;\"><p>Process Area Details</p></td>
				<td width=\"" . ($is_internal ? '8%': '15%') . "\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-size:15px;font-weight:bold;border:solid 1px #000000;\"><p>Gap</p></td>
				<td width=\"" . ($is_internal ? '32%': '55%') . "\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-size:15px;font-weight:bold;border:solid 1px #000000;\"><p>Strengths</p></td>";

		if($is_internal){
			$html .= "<td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-size:15px;font-weight:bold;border:solid 1px #000000;\"><p>Industry Norms</p></td>
				<td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-size:15px;font-weight:bold;border:solid 1px #000000;\"><p>Notes</p></td>";
		}

		$html .= "</tr>";

		$text_length = 0;
		foreach ($positive_gaps as $value) {
			$html .= "<tr>
				<td width=\"" . ($is_internal ? '20%': '30%') . "\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#0070C0;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->question_name . "</td>
				<td width=\"" . ($is_internal ? '8%': '15%') . "\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#0070C0;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->score . "</td>";

			if($value->recommendation != 'Work in Progress'){
				$html .= "<td width=\"" . ($is_internal ? '32%': '55%') . "\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#0070C0;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->recommendation . "</td>";
			}else{
				$html .= "<td width=\"" . ($is_internal ? '32%': '55%') . "\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#e66c0a;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . "Work in Progress" . "</td>";
			}
			$text_length += strlen($value->recommendation);
			if($is_internal) {
				if ($value->recommendation != 'Work in Progress') {
					$html .= "<td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#0070C0;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->norms . "</td>";
				} else {
					$html .= "<td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#e66c0a;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->norms . "</td>";
				}

				if ($value->recommendation != 'Work in Progress') {
					$html .= "<td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#0070C0;font-size:15px;font-weight:normal;border:solid 1px #000000;\">$value->notes</td>";
				}else{
					$html .= "<td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#e66c0a;font-size:15px;font-weight:normal;border:solid 1px #000000;\">$value->notes</td>";
				}
			}
			$html .= "</tr>";
		}
		$html .= "</table>";

		$pdf->SetXY(0, 7, true);
		//$pdf->writeHTML($html, true, 0, true, 0);
		$pdf->writeHTMLCell(0, 0, 10, 10.5, $html);

		$page_text_count = ($is_internal? 750: 1200);
		for($i = $page_text_count; $i < $text_length; $i += $page_text_count){
			$pdf->AddPage();
			$pdf->SetFont('centurygothic', 'N', 17);
			$pdf->setJPEGQuality(100);
		}

		for($i = 0; $i <= 34; $i += 3){
			if (sizeof($negative_gaps) > $i) {
				$pdf->AddPage();
				$pdf->SetX(20);
				$pdf->SetFont('centurygothic', 'N', 17);
				$pdf->setJPEGQuality(100);

				$html = '';
				if($i == 0){
					$html .= "<div style=\"width: 960px; float: left;\"><h1 style=\"color: #0070C0;font-size: 30px;color: #0070C0;font-weight: normal; text-decoration: underline; \">Opportunities</h1></div>";
				}else{
					$html .= "<div style=\"width: 960px; float: left;\"><h1 style=\"color: #0070C0;font-size: 30px;color: #0070C0;font-weight: normal; text-decoration: underline; \"></h1></div>";
				}

				$html .= "<table style='border-collapse: collapse;'>
						<tr style=\"background-color: #c2d69b; padding-top: 10px; padding-bottom: 10px;\">
							<td width=\"" . ($is_internal ? '20%': '30%') . "\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-size:15px;font-weight:bold;border:solid 1px #000000;\"><p>Process Area Details</p></td>
				<td width=\"" . ($is_internal ? '8%': '15%') . "\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-size:15px;font-weight:bold;border:solid 1px #000000;\"><p>Gap</p></td>
				<td width=\"" . ($is_internal ? '32%': '55%') ."\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-size:15px;font-weight:bold;border:solid 1px #000000;\"><p>Strengths</p></td>";
				if($is_internal){
					$html .= "<td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-size:15px;font-weight:bold;border:solid 1px #000000;\"><p>Industry Norms</p></td>
                        <td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#000000;font-size:15px;font-weight:bold;border:solid 1px #000000;\"><p>Notes</p></td>";
				}
				$html .= "</tr>";
				foreach ($negative_gaps as $key => $value) {
					if ($key >= $i && $key < ($i+3)) {
						$html .= "<tr>
							<td width=\"" . ($is_internal ? '20%': '30%') . "\" height=\"220\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#0070C0;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->question_name . "</td>
							<td width=\"" . ($is_internal ? '8%': '15%') . "\" height=\"220\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#0070C0;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->score . "</td>";

						if($value->recommendation != 'Work in Progress'){
							$html .= "<td width=\"" . ($is_internal ? '32%': '55%') . "\" height=\"220\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#0070C0;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->recommendation . "</td>";
						}else{
							$html .= "<td width=\"" . ($is_internal ? '32%': '55%') . "\" height=\"220\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#e66c0a;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . "Work in Progress" . "</td>";
						}

						if($is_internal){
							if($value->recommendation != 'Work in Progress'){
								$html .= "<td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#0070C0;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->norms . "</td>";
							}else{
								$html .= "<td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#e66c0a;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->norms . "</td>";
							}

							if ($value->recommendation != 'Work in Progress') {
								$html .= "<td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#0070C0;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->notes . "</td>";
							}else{
								$html .= "<td width=\"20%\" style=\"padding: 20px; vertical-align: middle; text-align:center; color:#e66c0a;font-size:15px;font-weight:normal;border:solid 1px #000000;\">" . $value->notes . "</td>";
							}
						}

						$html .= "</tr>";
					}
				}
				$html .= "</table>";
				$pdf->SetXY(0, 7, true);
				$pdf->writeHTMLCell(0, 0, 10, 10.5, $html);
			}
		}

		$pdf->AddPage();
		$pdf->Bookmark('Appendix:::Additional information in relation to the HR Maturity diagnostics tool', 0, 0, '', 'B', array(0,64,128));
		$pdf->SetFont('centurygothic', 'N', 17);
		$pdf->setJPEGQuality(100);
		$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$pdf->Line(15, 26, 198, 26, $style);
		$pdf->SetXY(15,28);
		$pdf->SetTextColorArray(array(8,112,190));
		$pdf->SetFont('centurygothic', 'N', 25);
//		$pdf->Cell(20, 7, "Appendix");
		$pdf->Cell(20, 37, "Management Style", 0, false, 'L', 0, '', 0, true, 'T', 'M');
		$pdf->SetTextColorArray(array(0,0,0));
		$pdf->SetFont('centurygothic', 'N', 11);
		$pdf->Ln(0);
		$html='<p>As the owner grows its business, there is a clear trade-off between the owner\'s ability to execute versus his ability to delegate. The more complex and the larger the business, the greater the need</p>';
		$html2 = '<p>for the owner to focus on more strategic issues and rely on building up or brining in professionals to help him manage the needs of a more diversified company.</p>';
		$html1="<p>There is an optimal style for each Growth Stage and the owner needs to recognize the criticality of relinquishing and delegating responsibilities to ensure the company's continued growth.</p>";
		$pdf->setFontSpacing(-0.01);
		$pdf->writeHTMLCell(187,60,14,57,$html);
		$pdf->setFontSpacing(-0.025);
		$pdf->writeHTMLCell(186,60,14,67,$html2);
		$pdf->setFontSpacing(0);
		$pdf->writeHTMLCell(185,60,14,82,$html1);
		$pdf->Image(base_url().'assets/tcpdf/img_report/page_6_chart.jpg', $x=35, $y=100, $w=140, $h=145, 'JPG', '', '', false, 300, '', false, false, 0,' ', false, false);
		$pdf->Image(base_url().'assets/tcpdf/img_report/management_style_' . $id_gs1 . '.jpg', $x=20, $y=180, $w=180, $h=145, 'JPG', '', '', false, 300, '', false, false, 0,' ', false, false);

		$pdf->AddPage();
		$pdf->SetFont('centurygothic', 'N', 17);
		$pdf->setJPEGQuality(100);
		$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$pdf->Line(15, 26, 198, 26, $style);
		$pdf->SetXY(15,28);
		$pdf->SetTextColorArray(array(8,112,190));
		$pdf->SetFont('centurygothic', 'N', 25);
//		$pdf->Cell(20, 7, "Appendix");
		$pdf->Cell(20, 37, "Appendix – Leadership", 0, false, 'L', 0, '', 0, true, 'T', 'M');
		$pdf->SetTextColorArray(array(0,0,0));
		$pdf->SetFont('centurygothic', 'N', 11);
		$pdf->Ln(0);
		$html='<p>Leadership support and commitment to human capital development is a key driver for building HR Maturity.</p>';
		$html2 = '<p>The following captures an initial diagnosis of your organisation’s emphasis and commitment to addressing people capability issues.</p>';
		$html1="<p>*Note: This is an indicative assessment based on interviews and interactions in the course of the HR Maturity Diagnosis process.</p>";
		$pdf->setFontSpacing(-0.01);
		$pdf->writeHTMLCell(187,60,14,57,$html);
		$pdf->setFontSpacing(-0.025);
		$pdf->writeHTMLCell(186,60,14,72,$html2);
		$pdf->setFontSpacing(0);
		$pdf->writeHTMLCell(185,60,14,87,$html1);

		$pdf->Image(base_url().'assets/tcpdf/img_report/leadership_' . $id_gs1 .'.jpg', $x=15, $y=108, $w=180, $h=145, 'JPG', '', '', false, 300, '', false, false, 0,' ', false, false);

		$tracking = $this->t_tracking->get_data_by_id('*', $id_survey);
		$participants = $this->t_participants_info->get_data_by_id('*', $tracking['ID_CONSULTANT']);

		if(!$is_internal){
			$pdf->Line($x1 = 10, $y1 = 265, $x2 = 70, $y2 = 265, $style = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(183, 212, 66)));
			$pdf->Line($x1 = 70, $y1 = 265, $x2 = 70, $y2 = 195, $style = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(183, 212, 66)));
			$pdf->Line($x1 = 70, $y1 = 195, $x2 = 205, $y2 = 195, $style = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(183, 212, 66)));

			$html = "<h4 style=\" color: #b7d442; line-height: 20px; font-size: 18px; font-weight: normal; letter-spacing: -1px; \">Thank you for completing the HRMD.</h4>";
			$html .= "<h5 style=\"color: #b7d442; font-weight: bold; font-size: 13px; \">Contact</h5>";
			$html .= "<span style=\"display: inline; color: #b7d442; font-weight: normal; font-size: 13px; \">N</span>";
			$html .= "<a style=\" text-decoration: none; font-size: 9px; display: inline; color: #11296d; font-weight: normal; font-size: 13px; \"> " . $participants['NM_PARTICIPANT'] . "</a>";
			$html .= "<br>";
			$html .= "<span style=\"display: inline; color: #b7d442; font-weight: normal; font-size: 13px; \">E</span>";
			$html .= "<a style=\" text-decoration: none; font-size: 9px; display: inline; color: #11296d; font-weight: normal; font-size: 13px; \" href=\"mailto:" . $participants['NM_EMAIL'] . "\"> " . $participants['NM_EMAIL'] . "</a>";
			$html .= "<br>";
			$html .= "<span style=\" padding-top: 5px; display: inline; color: #b7d442; font-weight: normal; font-size: 13px; \">T</span>";
			$html .= "<a style=\" text-decoration: none; font-size: 9px; display: inline; color: #11296d; font-weight: normal; font-size: 13px; \" ></a>";
			$html .= "<br>";
			$pdf->writeHTMLCell(185,60,75,200,$html);
		}

		if($is_internal){
			// Interview page
			$pdf->AddPage();
			$pdf->SetFont('centurygothic', 'B', 12);
			$pdf->setCellPaddings(5,0,0,0);
			$pdf->SetTextColor(0, 0, 0);
			$pdf->Cell(0, 1, "Strategic Interview 1", 0, false, 'L', 0, '', 0, false, 'T', 'M');
			$pdf->Ln();

			$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

			// set cell padding
			$pdf->setCellPaddings(1, 1, 1, 1);
			$pdf->setCellMargins(5, 5, 1, 1);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->SetFont('centurygothic', 'N', 10);
			$pdf->MultiCell(183, 220, $txt, 1, 'L', 1, 1, '', '', true, 0, false, true, 40, 'T');

			// Interview page
			$pdf->AddPage();
			$pdf->SetFont('centurygothic', 'B', 12);
			$pdf->setCellPaddings(5,0,0,0);
			$pdf->SetTextColor(0, 0, 0);
			$pdf->Cell(0, 1, "Strategic Interview 2 (Optional)", 0, false, 'L', 0, '', 0, false, 'T', 'M');
			$pdf->Ln();

			$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

			// set cell padding
			$pdf->setCellPaddings(1, 1, 1, 1);
			$pdf->setCellMargins(5, 5, 1, 1);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->SetFont('centurygothic', 'N', 10);
			$pdf->MultiCell(183, 220, $txt, 1, 'L', 1, 1, '', '', true, 0, false, true, 40, 'T');

			// Interview page
			$pdf->AddPage();
			$pdf->SetFont('centurygothic', 'B', 12);
			$pdf->setCellPaddings(5,0,0,0);
			$pdf->SetTextColor(0, 0, 0);
			$pdf->Cell(0, 1, "Strategic Interview 3", 0, false, 'L', 0, '', 0, false, 'T', 'M');
			$pdf->Ln();

			$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

			// set cell padding
			$pdf->setCellPaddings(1, 1, 1, 1);
			$pdf->setCellMargins(5, 5, 1, 1);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->SetFont('centurygothic', 'N', 10);
			$pdf->MultiCell(183, 220, $txt, 1, 'L', 1, 1, '', '', true, 0, false, true, 40, 'T');
			/* Last page */
			$pdf->AddPage();
			$pdf->SetFont('centurygothic', 'N', 17);
			$pdf->setJPEGQuality(100);

//		$pdf->Cell(30, 30, 'TEST CELL STRETCH: no stretch', array('RB' => array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 2, 'C', 0, '', 0);

			$pdf->Line($x1 = 10, $y1 = 180, $x2 = 70, $y2 = 180, $style = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(183, 212, 66)));
			$pdf->Line($x1 = 70, $y1 = 180, $x2 = 70, $y2 = 110, $style = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(183, 212, 66)));
			$pdf->Line($x1 = 70, $y1 = 110, $x2 = 205, $y2 = 110, $style = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(183, 212, 66)));

			$html = "<h4 style=\" color: #b7d442; line-height: 20px; font-size: 18px; font-weight: normal; letter-spacing: -1px; \">Thank you for completing the HRMD.</h4>";
			$html .= "<h5 style=\"color: #b7d442; font-weight: bold; font-size: 13px; \">Contact</h5>";
			$html .= "<span style=\"display: inline; color: #b7d442; font-weight: normal; font-size: 13px; \">N</span>";
			$html .= "<a style=\" text-decoration: none; font-size: 9px; display: inline; color: #11296d; font-weight: normal; font-size: 13px; \"> " . $participants['NM_PARTICIPANT'] . "</a>";
			$html .= "<br>";
			$html .= "<span style=\"display: inline; color: #b7d442; font-weight: normal; font-size: 13px; \">E</span>";
			$html .= "<a style=\" text-decoration: none; font-size: 9px; display: inline; color: #11296d; font-weight: normal; font-size: 13px; \" href=\"mailto:" . $participants['NM_EMAIL'] . "\"> " . $participants['NM_EMAIL'] . "</a>";
			$html .= "<br>";
			$html .= "<span style=\" padding-top: 5px; display: inline; color: #b7d442; font-weight: normal; font-size: 13px; \">T</span>";
			$html .= "<a style=\" text-decoration: none; font-size: 9px; display: inline; color: #11296d; font-weight: normal; font-size: 13px; \" ></a>";
			$html .= "<br>";
			$pdf->writeHTMLCell(185,70,75,115,$html);
		}

		// Add TOCpage
		$pdf->addTOCPage();
// write the TOC title and/or other elements on the TOC page
		$pdf->SetFont('centurygothic', 'N', 24);
		$pdf->setCellPaddings(5,4,0,0);
		$pdf->setCellMargins(0, 0, 0, 0);
		$pdf->SetTextColor(23, 124, 198);
		$pdf->Cell(0, 5, "Content", 0, false, 'L', 0, '', 0, false, 'T', 'M');
		$pdf->Ln();
		$pdf->SetFont('centurygothic', 'N', 14);
// define styles for various bookmark levels
		$bookmark_templates = array();
		$bookmark_templates[0] = '<table border="0" cellpadding="5" cellspacing="5" style="background-color:#F2F2F2; padding-left: 20mm;">
<tr>
<td width="50mm"><span style="color:#0070BF" >#TOC_DESCRIPTION#</span></td>
<td width="110mm"><span style="color:#000000" >#TOC_DETAIL#</span></td>
<td width="25mm"><span style="color:#808080" align="right">#TOC_PAGE_NUMBER#</span></td>
</tr></table>';
		$pdf->addHTMLTOC(2, 'Index', $bookmark_templates, true, 'B', array(128,0,0));
// end of TOC page
		$pdf->endTOCPage();

		$pdf->Output('test.pdf', 'I');
	}

	public function convert_int_to_roman_numerals($number){
		$n = intval($number);
		$res = '';

		$roman_numerals = array(
			'M'  => 1000,
			'CM' => 900,
			'D'  => 500,
			'CD' => 400,
			'C'  => 100,
			'XC' => 90,
			'L'  => 50,
			'XL' => 40,
			'X'  => 10,
			'IX' => 9,
			'V'  => 5,
			'IV' => 4,
			'I'  => 1);

		foreach ($roman_numerals as $roman => $number){
			$matches = intval($n / $number);
			$res .= str_repeat($roman, $matches);
			$n = $n % $number;
		}
		return $res;
	}
}