<?php

class Home extends CI_controller
{
	public function index($id='1')
	{
		$this->load->library('pagination');
		$this->load->model('Blog_model');
		$allBlogs = $this->Blog_model->getAllBlogs();
		
		$data['allBlogs'] = $allBlogs;
		$data=array();
		//$this->load->view('home',$data);

		// PAGINATION


		$config = array();

		$config['suffix']='?'.$_SERVER['QUERY_STRING'];

        $config["base_url"] = base_url() . "home/index";

        $total_row = $this->db->get('blogs')->num_rows();

        $config["first_url"] = base_url()."home/index".'?'.$_SERVER['QUERY_STRING'];

        $config["total_rows"] = $total_row;

        $config["per_page"] = $per_page = $data['per_page']=3 ;

        $config["uri_segment"] = $this->uri->total_segments();

        $config['use_page_numbers'] = TRUE;

        $config['num_links'] = 3; //$total_row

        $config['cur_tag_open'] = '&nbsp;<a class="current">';

        $config['cur_tag_close'] = '</a>';

        $config['full_tag_open'] = "<ul class='pagination'>";

		$config['full_tag_close'] ="</ul>";

		$config['num_tag_open'] = '<li>';

		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";

		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";

		$config['next_tag_open'] = "<li>";

		$config['next_tagl_close'] = "</li>";

		$config['prev_tag_open'] = "<li>";

		$config['prev_tagl_close'] = "</li>";

		$config['first_link'] = 'First';

		$config['first_tag_open'] = "<li>";

		$config['first_tagl_close'] = "</li>";

		$config['last_link'] = 'Last';

		$config['last_tag_open'] = "<li>";

		$config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);

        if($this->uri->segment(2)){

        	$cur_page = $id;

        	$pagi = array("cur_page"=>($cur_page-1)*$per_page, "per_page"=>$per_page);
        }

        else{	

    		$pagi = array("cur_page"=>0, "per_page"=>$per_page);

    	}



        $data["blogs"] = $result = $this->Blog_model->getList("blogs",$pagi);

        $str_links = $this->pagination->create_links();

        $data["links"] = $str_links;

        //echo $data;

	    $this->load->view('home',$data);
	}

	 function getProdsUsingAjax($id=1)
    { 
    	$this->load->library('pagination');
        $cats = '';
        if (isset($_POST['categories'])) {
            $cats = $_POST['categories'];
        }
        $data_ses=$this->session->userdata('user');
		            // PAGINATION

		$config = array();

		$config['suffix']='?'.$_SERVER['QUERY_STRING'];

        $config["base_url"] = base_url() . "home/index";

        $total_row = $this->db->where_in('category_id',$cats)->get('blogs')->num_rows();

        $config["first_url"] = base_url()."home/index".'?'.$_SERVER['QUERY_STRING'];

        $config["total_rows"] = $total_row;

        $config["per_page"] = $per_page = $data['per_page']=3;

        $config["uri_segment"] = $this->uri->total_segments();

        $config['use_page_numbers'] = TRUE;

        $config['num_links'] = 3; //$total_row

        $config['cur_tag_open'] = '&nbsp;<a class="current">';

        $config['cur_tag_close'] = '</a>';

        $config['full_tag_open'] = "<ul class='pagination'>";

		$config['full_tag_close'] ="</ul>";

		$config['num_tag_open'] = '<li>';

		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";

		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";

		$config['next_tag_open'] = "<li>";

		$config['next_tagl_close'] = "</li>";

		$config['prev_tag_open'] = "<li>";

		$config['prev_tagl_close'] = "</li>";

		$config['first_link'] = 'First';

		$config['first_tag_open'] = "<li>";

		$config['first_tagl_close'] = "</li>";

		$config['last_link'] = 'Last';

		$config['last_tag_open'] = "<li>";

		$config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);

        if($this->uri->segment(2)){

        	$cur_page = $id;

        	$pagi = array("cur_page"=>($cur_page-1)*$per_page, "per_page"=>$per_page);
        }

        else{	

    		$pagi = array("cur_page"=>0, "per_page"=>$per_page);

    	}



        // $data["blogs"] = $result = $this->Blog_model->getList("blogs",$pagi);

        $str_links = $this->pagination->create_links();

        // $data["links"] = $str_links;
		            
            $response= $this->db-> where_in('category_id',$cats)->limit($pagi['per_page'],$pagi['cur_page'])->get('blogs')->result_array();
            $res='';
            if(count($response)>0)
            {
	            foreach ($response as $key => $value) 
	            {
	            	$res.='<div class="blog-post">
        <h2 class="blog-post-title">'.$value['title'].'</h2>
        <p class="blog-post-meta">'. $value['created_at'].' by <a href="#">'.$value['author'].'</a></p>
'.$value['description'].'
      </div>';
	            	// $res.='<tr><td>'.($key+1).'</td>';
	            	// $res.='<td>'.$value->title.'</td>';
	            	// $res.='<td>'.$value->description.'</td>';
	            	// $res.='<td>'.$value->author.'</td>';
	            	//   if($data_ses['role']=='1')
		            //   {
		            //    $res.='<td>
		            //         <a href="echo base_url().blog/edit/'.$value->blog_id.'" class="btn btn-primary">Edit</a>
		            //         <a href="#" onclick="deleteBlog('.$value->blog_id.');" class="btn btn-danger">Delete</a>
		            //         </td>';
		            //   }
		            //   $res.='</tr>';
	            }
            }
            else
            {
            	
            	
            	$res.=' No Data Found';
            }
             $res.=$str_links;
            echo $res;
            exit();
       
        
    }
}

?>