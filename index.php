<?php
$insert = false;
$update = false;
$delete = false;
//INSERT INTO `notes` (`sno`, `title`, `description`, `time`) VALUES (NULL, 'call Imran', 'call Imran tomorrow.', current_timestamp());
// connection to the database

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "notes";
    
    $conn = mysqli_connect($server, $username, $password,$database);
    if (!$conn){
        die ("connection to the DB has failed due to". $mysqli_connect_error());
    }
    if(isset($_GET['delete'])){
        $sno = $_GET['delete'];
        $delete = true;
        $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
        $result = mysqli_query($conn, $sql);
      }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset( $_POST['snoEdit'])){
           //record update
           $sno = $_POST["snoEdit"];
           $title= $_POST["titleEdit"];
           $description= $_POST["descriptionEdit"];
           $sql2= "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = $sno;";
           $result= mysqli_query ($conn, $sql2);
           if ($result){
            $update = true;
         }
        }
        else{

        $title= $_POST["title"];
         $description= $_POST["description"];
         $sql2= "INSERT INTO `notes` (`sno`, `title`, `description`, `time`) VALUES (NULL, '$title', '$description', current_timestamp());";
         $result= mysqli_query ($conn, $sql2);
         if ($result){
            $insert = true;
         }
        }
    }


    ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">


    <title>Notes projects</title>

  </head>

  <body>

   <!-- Edit Button modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/practice/CRUD/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div> 
            <button type="submit" class="btn btn-primary">Update Note</button>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Learn PHP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Tutorials</a></li>
            <li><a class="dropdown-item" href="#">Videos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Contact Us</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<?php
if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success</strong> Your note has been recorded.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
?>
<?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Note has been deleted!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Note has been updated!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>
<div class= "container my-3">
    <h2>Add a Note</h2>
<form action="/practice/CRUD/index.php" method ="POST">
  <div class="Form-group">
    <label for="title" class="form-label">Note title</label>
    <input type="text" class="form-control" id="title" name="title"aria-descriptionribedby="emailHelp">
    
  <div class="Form-group my-3">
    <label for="description" class="form-label">Details</label>
    <input type="text" class="form-control" id="description" name="description">
 
</div class= "button mb-4">

  <button type="submit" class="btn btn-primary">Add Note</button>
</form>
</div>
<div class="container  my-4">
    
    <table class="table" id= "myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $sql1 = "SELECT * FROM `notes`";
    $result = mysqli_query($conn,$sql1);
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
        <th scope='row'>". $row['sno']."</th>
        <td>". $row['title']."</td>
        <td>". $row['description']."</td>
        <td><button class='edit btn btn-sm primary' id = ".$row['sno'].">Update</button> <button class='delete btn btn-sm primary' id =d".$row['sno'].">Delete</button> </td>
      </tr>";
        
    }
    ?>
    
    
  </tbody>
</table>

</div>
<hr>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click", (e)=>{
                console.log("edit", );
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description =  tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(e.target.id)
                $('#editModal').modal('toggle');
            })
        })

                deletes = document.getElementsByClassName('delete');
                Array.from(deletes).forEach((element) => {
                element.addEventListener("click", (e) => {
                 console.log("edit ");
                 sno = e.target.id.substr(1);

                 if (confirm("Are you sure you want to delete this note!")) {
                      console.log("yes");
                      window.location = `/practice/CRUD/index.php?delete=${sno}`;
                     }
                    else {
                     console.log("no");
        }
      })
    })
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    -->
  </body>
</html>