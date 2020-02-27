    <div class="loader"></div>
   <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-akun">MY ACCOUNT</div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('main')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container akun" style="margin-top: 70px">
    <div class="level">
      
    </div>
    <form class="d-user">
      
      <div class="form-group text-center">
        <img src="" id="user-img" class="img-fluid rounded-circle" width="80" height="auto" alt="">
        <input type="file" id="photoUrl" name="photoUrl" disabled="" onchange="loadImg('photoUrl','user-img')" accept="">
      </div>
      <div class="form-group">
        <label for="Username">Username</label>
        <input type="Username" class="form-control" id="username" readonly placeholder="name@example.com">
      </div>
      <div class="form-group">
        <label for="umur" class="uerr">umur :</label>
        <input type="number" class="umur form-control" name="umur" id="umur" min="6" placeholder="Input Umur" readonly="" required>
      </div>    
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" readonly placeholder="name@example.com">
      </div>  

      <div class="form-group">
        <label for="password">Password</label>
        <div class="row">
          <div class="col-10">
            <input type="password" class="form-control pass" id="password"  readonly placeholder="name@example.com">
          </div>
          <div class="col-2">
            <label class="bg-warning p-2 rounded-circle" onclick="showPass()"><i class="ion-eye"></i></label>
          </div>
        </div>
      </div>
    </form>

      <div class="eds">
        <button class="btn btn-block btn-primary edit-user" onclick="editUser()">EDIT</button>
      </div>      
      <div class="cancel">
        <button class="btn btn-block btn-secondary cancel-user" onclick="cancelEdit()">Cancel</button>
      </div>

    </div>

  <script type="text/javascript">
    tampilAkun();
  </script>