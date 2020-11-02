<?php $this->load->view('Admin/header');?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Blog</h1>
	</div>
        <form name="blogForm" id="blogForm" action="<?php echo base_url().'blog/add';?>" method="post">
        	<div class="form-group">
        		<label>Title</label>
        		<input type="text" name="title" id="title" value="<?php echo set_value('title');?>" class="form-control">
        		<p class="help-block"><?php echo form_error('title');?></p>
        	</div>

        	<div class="form-group">
        		<label>Description</label>
        		<textarea name="description" id="description" class="form-control" rows="5"><?php echo set_value('description');?></textarea>
        		<p class="help-block"><?php echo form_error('description');?></p>
        	</div>

        	<div class="form-group">
        		<label>Author</label>
        		<input type="text" name="author" id="author" class="form-control" value="<?php echo set_value('author');?>">
        		<p class="help-block"><?php echo form_error('author');?></p>
        	</div>
            <div class="form-group">
                <label>Category</label>
              <select name="category_id"  class="form-control" >
                <?php $data=$this->db->get('category')->result();
                if($data)
                {
                foreach($data as $key=>$value)
                    {
                        ?><option value="<?= $value->id;?>"><?= $value->category;?></option><?php
                    }
                }?>
                </select>
             </div>

        	<div class="form-group">
        		<button class="btn btn-primary">Create</button>
        	</div>
        </form>    
    </main>
 <?php $this->load->view('Admin/footer');?>
