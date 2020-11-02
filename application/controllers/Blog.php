<?php

class Blog extends CI_controller
{
	public function index($id='1')
	{

		$this->load->library('pagination');
		$this->load->model('Blog_model');
		$blogs =$this->Blog_model->getAllBlogs();
		$data = array();
		//$data['blogs'] = $blogs;
		//$this->load->view('admin/blog/list',$data);

		// PAGINATION

		$config = array();

		$config['suffix']='?'.$_SERVER['QUERY_STRING'];

        $config["base_url"] = base_url() . "blog/index";

        $total_row = $this->db->get('blogs')->num_rows();

        $config["first_url"] = base_url()."blog/index".'?'.$_SERVER['QUERY_STRING'];

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

	    $this->load->view('admin/blog/list',$data);

        // ./ PAGINATION /.

	}


	public function add()
	{
		$this->load->model('Blog_model');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('author', 'Author', 'trim|required');
		$this->form_validation->set_rules('category_id', 'category_id', 'trim|required');


		if($this->form_validation->run() == true)
		{	
			$form_array = array();
			$form_array['title'] = $this->input->post('title');
			$form_array['description'] = $this->input->post('description');
			$form_array['author'] = $this->input->post('author');
			$form_array['category_id'] = $this->input->post('category_id');
			$form_array['created_at'] = date('Y-m-d');

			$this->Blog_model->create($form_array);

			$this->session->set_flashdata('success','Blog Created Successfully');
			redirect(base_url().'blog/index');
		}
		else
		{
			$this->load->view('Admin/blog/add');
		}
	}



	public function edit($id)
	{
		$data = array();
		$this->load->model('Blog_model');
		$blog = $this->Blog_model->getBlog($id);
		if(empty($blog))
		{
			$this->session->set_flashdata('success','Blog not found');
			redirect(base_url().'blog/index');
		}
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('author', 'Author', 'trim|required');

		if($this->form_validation->run() == true)
		{	
			$form_array = array();
			$form_array['title'] = $this->input->post('title');
			$form_array['description'] = $this->input->post('description');
			$form_array['author'] = $this->input->post('author');
			$form_array['created_at'] = date('Y-m-d');

			$this->Blog_model->updateBlog($id,$form_array);

			$this->session->set_flashdata('success','Blog Update Successfully');
			redirect(base_url().'blog/index');
		}
		else
		{
			$data['blog'] = $blog;
			$this->load->view('Admin/blog/edit',$data);
		}
	}

	function delete($id)
	{
		$this->load->model('Blog_model');
		$blog = $this->Blog_model->getBlog($id);
		if(empty($blog))
		{
			$this->session->set_flashdata('success','Blog not found');
			redirect(base_url().'blog/index');
		}

		$this->Blog_model->deleteBlog($id);

		$this->session->set_flashdata('success','Blog Delete Successfully');
		redirect(base_url().'blog/index');
	}

	 function getProdsUsingAjax()
    { 
        $cats = '';
        if (isset($_POST['categories'])) {
            $cats = $_POST['categories'];
        }
        $data_ses=$this->session->userdata('user');
		            
            $data = $this->db-> where_in('category_id',$cats)->get('blogs')->result();
            $res='';
            if(count($data)>0)
            {
	            foreach ($data as $key => $value) 
	            {
	            	$res.='<tr><td>'.($key+1).'</td>';
	            	$res.='<td>'.$value->title.'</td>';
	            	$res.='<td>'.$value->description.'</td>';
	            	$res.='<td>'.$value->author.'</td>';
	            	  if($data_ses['role']=='1')
		              {
		               $res.='<td>
		                    <a href="echo base_url().blog/edit/'.$value->blog_id.'" class="btn btn-primary">Edit</a>
		                    <a href="#" onclick="deleteBlog('.$value->blog_id.');" class="btn btn-danger">Delete</a>
		                    </td>';
		              }
		              $res.='</tr>';
	            }
            }
            else
            {
            	$colspan=4;
            	if($data_ses['role']=='1')
	              {
	              	$colspan=5;
	              }
            	
            	$res.=' <tr><td colspan="'.$colspan.'"> No Data Found</td></tr>';
            }
            echo $res;
            exit();
       
        
    }
}

?>