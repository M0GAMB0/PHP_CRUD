<?php
include('connect.php');

$query="SELECT * FROM users";
$res=mysqli_query($conn,$query);
if($res){
  $users=mysqli_fetch_all($res, MYSQLI_ASSOC);
}
else{
  echo "Table fetch failed";
}
// echo "<pre>";
// print_r($users);
// exit;
$edit =  isset($_GET['edit']) ? $users[$_GET['edit']]['id'] : '-1';
if(isset($_GET['delete'])){
  deleteQuery($_GET['delete']);
  header('Location: index.php');
}
function deleteQuery($id){
  global $conn;
  $query="DELETE FROM users WHERE id=$id";
  $res=mysqli_query($conn,$query);
  return $res;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>
  </head>
  <body>
    <form class="card m-4 p-4" action="./addForm.php" method="POST">
      <div class="mb-3">
      <input type="hidden" name="user_id" id="userId" value="<?php echo $edit;?>">
        <label for="email" class="form-label">Email address</label>
        <input
          type="email"
          class="form-control"
          id="email"
          aria-describedby="emailHelp"
          name="email" 
          value="<?php echo isset($_GET['edit'])?$users[$_GET['edit']]['email'] : '';?>"/>
        <div id="emailHelp" class="form-text">
          We'll never share your email with anyone else.
        </div>
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_GET['edit'])?$users[$_GET['edit']]['name'] : '';?>"/>
      </div>
      <div class="mb-3">
        <label for="mobile" class="form-label">Mobile Number</label>
        <input type="tel" class="form-control" id="mobile" name="mobile" value="<?php echo isset($_GET['edit'])?$users[$_GET['edit']]['mobile'] : '';?>"/>
      </div>
      <input type="submit" class="btn btn-primary" name="submit" value="<?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?> " style="width:80px">
      </div>
      
      
      
    </form>
    <table class="table"style="width:90%;margin:0px auto;">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Mobile</th>
          <th scope="col">Operations</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $key => $user){?>
        <tr>
          <th scope="row"><?php echo $key + 1; ?></th>
          <td><?php echo $user['name']; ?></td>
          <td><?php echo $user['email']; ?></td>
          <td><?php echo $user['mobile']; ?></td>
          <td>
          <a href="index.php?edit=<?php echo $key; ?>"class="btn btn-success btn-sm">Edit</a>
          <a href="index.php?delete=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <!-- <script>
      const editBtn=(name,email,mobile)=>{
        // const edit=document.getElementById('editBtn');
        // console.log(edit);
        // edit.style.display="block";
        document.getElementById('name').value=name;
        document.getElementById('email').value=email;
        document.getElementById('mobile').value=mobile;
      }

      </script> -->
  </body>
</html>
