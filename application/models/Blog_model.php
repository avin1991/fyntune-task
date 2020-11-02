<?php

class Blog_model extends CI_model
{
	function create($formArray)
	{
		$this->db->insert('blogs',$formArray);	
	}

	function getAllBlogs()
	{
		$blogs = $this->db->get('blogs')->result_array();
		return $blogs;
	}

	function updateBlog($id,$array)
	{
		$this->db->where('blog_id',$id);
		$this->db->update('blogs',$array);
	}

	function getBlog($id)
	{
		$this->db->where('blog_id',$id);
		$blog = $this->db->get('blogs')->row_array();
		return $blog;
	}

	function deleteBlog($id)
	{
		$this->db->where('blog_id',$id);
		$this->db->delete('blogs');
	}

	function getList($table, $pagination=array()) {


        if((isset($pagination['cur_page'])) and !empty($pagination['per_page']))

        {

          $this->db->limit($pagination['per_page'],$pagination['cur_page']);

        }


        $query = $this->db->get($table);

        return $result = $query->result_array();

    }

	function getProductUsingAjax($table,$categories='')
	{
		$this->db->select("$table.*");
		$this->db->from($table);
		if (!empty($categories)) 
		{
			$this->db->where_in('category_id', $categories);
		}
		$query = $this->db->get();
		return $result = $query->result();
	}

}

?>