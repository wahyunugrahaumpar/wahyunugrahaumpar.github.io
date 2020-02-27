  <div class="loader"></div>
<nav class="navbar navIndex navbar-expand-lg">
  <img src="img/logo.png" class="navbar-brand mx-auto" height="auto" width="50">
  <div class="navbar-collapse">
      <ul class="list-inline dl">
       <li class="log list-inline-item"><span class="nav-link active"><strong>LOGIN</strong></span ></li>
       <li class="sign list-inline-item"><span class="nav-link noactive"><strong>SINGUP</strong></span ></li>
      </ul> 
  </div>
 </nav>
<hr>
 <div id="swipe-log-daf" class="swipe">
  <div class="swipe-wrap">   
   <div class="container-fluid login swipe-item">
    <form class="data-login">
     <div class="form-group">
      <label for="email">Email :</label>
      <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" autocomplete required />
     </div>
     <div class="form-group">
      <label for="password">Password :</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Input Password" autocomplete required />   
     </div>
     <div class="form-group">
      <input type="hidden" name="kode_login" value="0">
     </div> 
      <button type="submit" class="btn-login btn btn-primary form-control">LOGIN</button>
    </form>
        <div class="reset-password">Lupa Password? Klik <a href="#" onclick="resetPassword()"><i><b>Reset Password</i></b></a></div>
        <div class="mt-1 alert alert-warning alert-dismissible fade show d-none" role="alert">
          Kami telah mengirim email verifikasi ke alamat email <span class="alamat-email"></span> Silahkan Cek Email Anda.
          <strong> Belum Menerima Email?</strong> Silahkan periksa pada bagian <b>Promosi</b> Email anda, jika tidak ada silahkan cek Pada <b>Spam</b>   Gmail Anda!
        </div>        

        <div class="mt-1 alert-belum alert-warning alert-dismissible fade show d-none" role="alert">
          <strong>Silahkan verifikasi email anda terlebih dahulu !</strong>
        </div>

   </div>

   <div class="container-fluid signup swipe-item">
    <form class="data-daftar">
      <div class="form-group">
        <label for="username" class="uerr">Username :</label>
        <input type="text" class="username form-control" name="username" minlength="4" placeholder="Input Username" required>
      </div>
      <div class="form-group">
        <label for="umur" class="uerr">umur :</label>
        <input type="number" class="umur form-control" name="umur" min="6" placeholder="Input Umur" required>
      </div>        
      <div class="form-group">
        <label for="email" class="eerr">Email :</label>
        <input type="email" class="email form-control" name="email" minlength="4" placeholder="Input Valid Email" required>
      </div>
      <div class="form-group">
        <label for="password" class="epass">Password :</label>
        <input type="password" class="form-control password" name="password" minlength="6" placeholder="Input Password" required>
      </div>
      <div class="form-group">
        <label for="password_verify" class="epassv">Password Verify :</label>
        <input type="password" class="form-control password_verify" id="password_verify" name="password_verify" minlength="6" placeholder="Retype Password" required>
      </div>
      <button type="submit" class="btn-signup btn btn-primary form-control">SIGNUP</button>
    </form>
     </div> 
  </div>
 </div>

    <div class="b-alert-bawah">
      <div class="alert-bawah">
        <p class="info">Tekan Lagi Untuk Keluar</p>
      </div>
    </div>
 <script type="text/javascript">
  logDaf();
 </script>