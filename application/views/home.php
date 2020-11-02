
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Demo Blog</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
   /*   .pagination {
  display: inline-block;
}*/

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  border: 1px solid #ddd;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

.pagination a:first-child {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

.pagination a:last-child {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
/* #data tr {
  display: none;
}*/
    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url().'Assets/css/blog.css';?>" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <a class="navbar-brand" href="#">Demo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Price</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Contact</a>
      </li>
    </ul>
    <form class="form-inline mt-2 mt-md-0">
      <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"> -->
      <!-- <button class="btn btn-default my-2 my-sm-0" type="submit"><a style="color: #fff;" href="<?php echo base_url().'login'?>">Login</a></button> -->
       <button class="btn btn-success"><a style="color: #fff !important" href="<?php echo base_url().'admindashboard/signOut';?>">Sign out</a></button>
    </form>
  </div>
</nav>

    </div>
<!--     <div class="container">
  

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 text-muted" href="#">Home</a>
      <a class="p-2 text-muted" href="#">About</a>
      <a class="p-2 text-muted" href="#">Services</a>
      <a class="p-2 text-muted" href="#">Portfolio</a>
      <a class="p-2 text-muted" href="#">Contact</a>
      <button type="button" class="btn btn-success"><a style="color: #fff !important;" class="p-2 text-muted" href="<?php echo base_url().'login';?>">login</a></button>
     
    </nav>
  </div>
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      
      <div class="col-12">
        <a class="blog-header-logo text-dark" href="#">Simple Blog Application in Codeigniter</a>
      </div>
      
    </div>
  </header>

</div> -->
<div class="container">
  <div class="row">
    
       <div class="col-md-3"  style="float: right !important;"> Filter- Select Category:
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
  </div>
</div>


<main role="main" class="container">
  <div class="row">
    <div class="col-md-12 blog-main">
      <h3 class="pb-4 mb-4 font-italic border-bottom">
        Our Blogs
      </h3>
      <div id="Mydata">

    <?php foreach($blogs as $blog)
    {

      ?> 
      

      <div class="blog-post">
        <h2 class="blog-post-title"><?php echo $blog['title'];?></h2>
        <p class="blog-post-meta"><?php echo $blog['created_at'];?> by <a href="#"><?php echo $blog['author'];?></a></p>

        <?php echo $blog['description'];?>
      </div>
      <?php
    }
    echo $links;
      ?>
    </div>

      <!-- <nav class="blog-pagination"> -->
        <!-- <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a> -->
        
      <!-- </nav> -->

    </div>

    

  </div>

</main>
<!-- <table id="dtBasicExample">
  <tr> <td>Row 1</td></tr>
  <tr> <td>Row 2</td></tr>
  <tr> <td>Row 3 </td></tr>
  <tr> <td>Row 4</td></tr>
  <tr> <td>Row 5</td></tr>
  <tr> <td>Row 6</td></tr>
  <tr> <td>Row 7</td></tr>
  <tr> <td>Row 8</td></tr>
</table> -->
<!-- <div class="pagination">
  <a href="#">&laquo;</a>
  <a href="#">1</a>
  <a class="active" href="#">2</a>
  <a href="#">3</a>
  <a href="#">4</a>
  <a href="#">5</a>
  <a href="#">6</a>
  <a href="#">&raquo;</a>
</div> -->
<script>
   function getProdsUsingAjax() {
console.log('Shree');
    var i;
    var categories = [];

    $('#cat option:selected').each(function(i){
      categories[i] = $(this).val();
    });

    $.ajax({
      type:"POST",
      url:"<?= base_url();?>home/getProdsUsingAjax",
      data:{categories:categories},
      success:function(data)
      {
        console.log(data);
        $("#Mydata").html(data);
      },
      
    });
  }
</script>
</body>
</html>
