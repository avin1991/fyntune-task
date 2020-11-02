<?php $this->load->view('Admin/header');?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">List Blog</h1>
	</div>
    <div class="col-md-3"> Filter- Select Category:
        <select name="categories[]"  class="form-control" id="cat" onchange="getProdsUsingAjax()">
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
    <br>

    <?php $success = $this->session->userdata('success');?>
            <?php if(!empty($userdata))
            {?>
            <div class="alert alert-danger" role="alert">
                <?php echo $success;?>
            </div>

        <?php
         }
         ?>

        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Author</th>
                     <?php  if($this->session->userdata('user'))
                     {
                      $data=$this->session->userdata('user');
                      if($data['role']=='1')
                      {
                        ?> <th width="200">Action</th> <?php
                      }
                     }
                     ?>
                </tr>
                <tbody id="Mydata">

                <?php if(!empty($blogs))
                {
                  $i=0;
                    foreach ($blogs as $blog) {
                      $i++;
                     ?>
                     <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $blog['title']?></td>
                        <td><?php echo $blog['description']?></td>
                        <td><?php echo $blog['author']?></td>

                        <?php  if($this->session->userdata('user'))
                     {
                      $data=$this->session->userdata('user');
                      if($data['role']=='1')
                      {
                        ?>
                        <td>
                            <a href="<?php echo base_url().'blog/edit/'.$blog['blog_id'];?>" class="btn btn-primary">Edit</a>
                            <a href="#" onclick="deleteBlog(<?php echo $blog['blog_id'];?>);" class="btn btn-danger">Delete</a>
                        </td>
                         <?php
                      }
                     }
                     ?>
                        
                    </tr>
                    <?php }
                }else
                {
                ?>
                <tr>
                    <td colspan="4">Records Not Found</td>
                </tr>
            <?php }?>

                </tbody>
            </table>
            <?= $links;?>
        </div>
           
    </main>
 <?php $this->load->view('Admin/footer');?>
 <script type="text/javascript">
     function deleteBlog(id)
     {
        if(confirm("Are you sure you want to delete?"))
        {
            window.location.href="<?php echo base_url().'blog/delete/'?>"+id;
        }
     }

    //  $(document).ready(function() {
    //     $('.js-example-basic-multiple').select2();
    // });


  function getProdsUsingAjax() {

    var i;
    var categories = [];

    $('#cat option:selected').each(function(i){
      categories[i] = $(this).val();
    });

    $.ajax({
      type:"POST",
      url:"<?= base_url();?>blog/getProdsUsingAjax",
      data:{categories:categories},
      success:function(data)
      {
        console.log(data);
        $("#Mydata").html(data);
      },
      
    });
  }
 </script>
