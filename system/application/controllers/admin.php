<?php

class Admin extends Controller {
	
	function Admin(){
		parent::Controller();	
		
		$this->view_data['base_url'] = base_url();		
	}
	
	function index(){	
		$this->controls();
	}
        
        function controls (){
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'admin/controls/';
		$config['per_page'] = '40';
		$limit = $config['per_page'];
		$offset = $this->uri->segment(3, 0);
		$this->db->orderby('last_edited', 'DESC');
		$this->db->where('flagged', 0);
		$get = $this->db->get('templates', $limit, $offset);
			
		$this->view_data['data'] = $get;
			
		$config['total_rows'] = $this->db->count_all('templates');
		$this->pagination->initialize($config);
		$this->view_data['pagination'] = $this->pagination->create_links();
		
            $this->load->view('admin_controls', $this->view_data);
        }
        
        function clean_up_pictures () {
            if($this->session->userdata('user_email') == 'fitzsimons.finn@gmail.com')
            {
                $data = $this->db->get('pictures');
                foreach($data->result() as $row):
                if (!@GETIMAGESIZE('picture_images/' . $row->thumb_path) || !@GETIMAGESIZE('picture_images/' . $row->image_path)) {
                    if(file_exists('picture_images/' . $row->thumb_path)) {
                        unlink('picture_images/' . $row->thumb_path);
                    }
                    if(file_exists('picture_images/' . $row->image_path)) {
                        unlink('picture_images/' . $row->image_path);
                    }
                    $this->db->where('picture_id', $row->picture_id);
                    $this->db->delete('pictures');
		    $this->db->where('picture_id', $row->picture_id);
		    $this->db->delete('picture_keywords'); 
                }
                endforeach;
                $this->load->view('admin_controls', $this->view_data);
            }
            else {
                redirect ('user/login');
            }
        }
	
	function clean_up_keywords (){
		if($this->session->userdata('user_email') == 'fitzsimons.finn@gmail.com')
            {
		$keywords = $this->db->get('picture_keywords');
                foreach($keywords->result() as $row):
                if (!@GETIMAGESIZE('picture_images/' . $row->picture_id . '_thumb.png')) {
                    $this->db->where('picture_id', $row->picture_id);
		    $this->db->delete('picture_keywords'); 
                }
                endforeach;
                $this->load->view('admin_controls', $this->view_data);
            }
            else {
                redirect ('user/login');
            }
	}
	
        function flag ($template_id) {
            if($this->session->userdata('user_email') == 'fitzsimons.finn@gmail.com')
            {
                $query = "UPDATE templates SET flagged = '1' WHERE template_id LIKE '$template_id'";
		$this->db->query($query);
                redirect ('admin');
            }
            else {
                redirect ('user/login');
            }
        }
        
        function get_email_list () {
		//$this->output->enable_profiler(TRUE);
            if($this->session->userdata('user_email') == 'fitzsimons.finn@gmail.com')
            {
                $query = "SELECT user_email FROM users";
		$result = $this->db->query($query);
                $array = $result->result_array();
		$return = '';
		for($a = 0; $a < count($array); $a= $a+1){
			$return .= $array[$a]['user_email'] . ", ";
		}
		echo $return;
            }
            else {
                redirect ('user/login');
            }
        }
        
	
	function send_email_1(){
		
		$message = '<head>
    

<style type="text/css">
a:hover { color: #ff1980 !important; }
.link:hover { color: #ff1980 !important; }
</style>
</head>
<body bgcolor="#f8f8f8" style="font-family: Arial; background-color: #f8f8f8;">



<table cellspacing="0" border="0" style="margin: auto;" width="100%" cellpadding="0">
<tr>
<td>
    
<table cellspacing="0" border="0" style="margin: auto;" cellpadding="10">
<tr >
<td width="200" >&nbsp;</td>
<td width="600"><a href="http://numberpicture.com" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/name.jpg" height="100" alt="Number Picture" style="display: block;" width="600" /></span></a></td>
<td width="200">&nbsp;</td>
</tr>
<tr >
<td width="200" >&nbsp;</td>
<td width="600"><img src="http://numberpicture.com/emailimg/new_templates.jpg" height="70" alt="New Templates" style="display: block;" width="600" /></td>
<td width="200">&nbsp;</td>
</tr>
</table>
<table style="margin: auto;">
<tr >
<td width="250"><a href="http://numberpicture.com/picture/new_picture/125" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/125_thumb.jpg" height="250" alt="Template 125" style="display: block;" width="250" /></span></a></td>
<td width="250"><a href="http://numberpicture.com/picture/new_picture/136" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/136_thumb.jpg" height="250" alt="Template 136" style="display: block;" width="250" /></span></a></td>
<td width="250"><a href="http://numberpicture.com/picture/new_picture/123" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/123_thumb.jpg" height="250" alt="Template 123" style="display: block;" width="250" /></span></a></td>
<td width="250"><a href="http://numberpicture.com/picture/new_picture/132" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/132_thumb.jpg" height="250" alt="Template 132" style="display: block;" width="250" /></span></a></td>
</tr>
<tr >
<td width="250"><a href="http://numberpicture.com/picture/new_picture/135" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/135_thumb.jpg" height="250" alt="Template 135" style="display: block;" width="250" /></span></a></td>
<td width="250"><a href="http://numberpicture.com/picture/new_picture/124" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/124_thumb.jpg" height="250" alt="Template 124" style="display: block;" width="250" /></span></a></td>
<td width="250"><a href="http://numberpicture.com/picture/new_picture/130" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/130_thumb.jpg" height="250" alt="Template 130" style="display: block;" width="250" /></span></a></td>
<td width="250"><a href="http://numberpicture.com/picture/new_picture/121" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/121_thumb.jpg" height="250" alt="Template 121" style="display: block;" width="250" /></span></a></td>
</tr>
</table>
<table style="margin: auto;">
<tr >
<td width="200" >&nbsp;</td>
<td width="600"><br><br><br><img src="http://numberpicture.com/emailimg/we_need_your_help.jpg" height="70" alt="We Need Your Help" style="display: block;" width="600" /></td>
<td width="200" >&nbsp;</td>
</tr>
</table>
<table style="margin: auto;">
<tr >
<td width="300"></td>
<td width="400">
<p align="center" style="font-weight: normal; margin-bottom: 10px; text-align: center; font-size: 1em; line-height: 1.2em;">Number Picture is trying to raise money in order to make the website better and easier to use.</p>
<p align="center" style="font-weight: normal; margin-bottom: 10px; text-align: center; font-size: 1em; line-height: 1.2em;">We have submitted appeals on several crowdfunding websites in order to try raise funds from members of the public for doing this.</p>
<p align="center" style="font-weight: normal; margin-bottom: 10px; text-align: center; font-size: 1em; line-height: 1.2em;">The crowdfunding websites are <a href="http://www.rockethub.com/projects/2029-numberpicture-dataviz-meets-crowdsourcing" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span>RocketHub</span></a>, <a href="http://www.pozible.com.au/index.php/archive/index/1091/description/0/0" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span>Pozible</span></a> and <a href="http://www.indiegogo.com/NUMBERPICTURE-DATAVIZ-MEETS-CROWDSOURCNG" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span>IndieGoGo</span></a> and you can view the project pages by clicking on the respective links.</p>
</td>
<td width="300"></td>
</tr>
</table>
<br>
<table style="margin: auto;">
<tr >
<td width="300" ></td>  
<td width="130" ><a href="http://www.rockethub.com/projects/2029-numberpicture-dataviz-meets-crowdsourcing" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/rockethub.jpg" height="28" alt="RocketHub" style="display: block;" width="130" /></span></a></td>
<td width="130"><a href="http://www.pozible.com.au/index.php/archive/index/1091/description/0/0" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/pozible.jpg" height="28" alt="Pozible" style="display: block;" width="130" /></span></a></td>
<td width="130" ><a href="http://www.indiegogo.com/NUMBERPICTURE-DATAVIZ-MEETS-CROWDSOURCNG" target="_blank" style="text-transform: uppercase; text-decoration: none; color: #000000;"><span><img src="http://numberpicture.com/emailimg/indiegogo.jpg" height="28" alt="IndieGoGo" style="display: block;" width="130" /></span></a></td>
<td width="300" ></td>
</tr>
</table>
<br><br>
<table style="margin: auto;">
<tr >
<td width="300"></td>
<td width="400">
<p align="center" style="font-weight: normal; margin-bottom: 10px; text-align: center; font-size: 1em; line-height: 1.2em;">With the money raised we plan to implement image handling functionality into templates - this will mean that you can literally create any template you dream of. For example a skyline of skyscrapers with varying heights, or a bunch of hippos with wings.</p>
<p align="center" style="font-weight: normal; margin-bottom: 10px; text-align: center; font-size: 1em; line-height: 1.2em;">Secondly, we will develop a spreadsheet on the website where you can either input or edit your data that has been copied and pasted in - creating a much more user-friendly interface.</p>
<p align="center" style="font-weight: normal; margin-bottom: 10px; text-align: center; font-size: 1em; line-height: 1.2em;">Thirdly, we will introduce dynamic data functionality which will mean that you will not only be able to create images of your data but also have Number Pictures that update themselves in real-time and can be embedded onto your website wherever it may be.</p>
<p align="center" style="font-weight: normal; margin-bottom: 10px; text-align: center; font-size: 1em; line-height: 1.2em;">And, maybe with your help pie- &amp; bar-charts will become obsolete and so much more information will be able to be conveyed because the tools we use are so much more interesting and engaging.</p>

</td>
<td width="300"></td>
</tr>
</table>
<table style="margin: auto;">
<tr >
<td width="200" >&nbsp;</td>
<td width="600"><br><br><br><img src="http://numberpicture.com/emailimg/thanks.jpg" height="70" alt="Thanks" style="display: block;" width="600" /></td>
<td width="200" >&nbsp;</td>
</tr>
</table>
<table style="margin: auto;">
<tr >
<td width="200"></td>
<td width="600">
    <p align="center" style="font-weight: normal; margin-bottom: 10px; text-align: center; font-size: 1em; line-height: 1.2em;">
From the Number Picture Team<br>&amp; Happy Number Picturing...
    </p>
    <br><br><br><br>
</td>
<td width="200"></td>
</tr>
</table>

</td>
</tr>
</table>
</body>';
	}
}
