  <div class="loader"></div>
<nav class="navbar fixed-top navbar-expand-md navbar-light bg-nav sidebarNavigation" data-sidebarClass="navbar-light bg-light">
    <a class="navbar-brand">
        <img src="img/logo.png" width="30" height="auto" alt=""> 
    </a>
    <button class="navbar-toggler leftNavbarToggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item">
              <a class="nav-link" href="#" onclick="loadPage('userAll','user')"><i class="ion-android-contacts abs"></i><span class="pl-4">Kelola User</span></a>
          </li>     
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="ion-cube abs"></i><span class="pl-4">Kelola Soal</span></a>
            <div class="dropdown-menu drop-kat">

  
            </div>
          </li>
           
          <li class="nav-item">
              <a class="nav-link" href="#" onclick="logout()"><i class="ion-log-out abs"></i><span class="pl-4">Logout</span></a>
          </li>
      </ul>
    </div>

    <div class="d-flex"> 
    <div kode="dropset" class="dropdown menu-more pb-1 pt-1">        
     <button class="ml-2 btn bg-ova ion-more icon-more" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropset">
     </button>
     <div class="dropdown-menu dm-more"aria-labelledby="dropset">
       <a data="kode" class="dropdown-item" href="#" onclick="DetectAndServe()">Rate 5 Star</a>
       <a data="kode" class="dropdown-item" href="#" onclick="navigator.app.exitApp()">Exit</a>
     </div> 
   </div>
  </div>
</nav>

<div class="main-all" style="margin-top: 70px;">
  <div class="container my-auto">
    <h1>SELAMAT DATANG ADMIN</h1>
  </div>
</div>

     <div class="b-alert-bawah">
      <div class="alert-bawah">
        <p class="info">Tekan Lagi Untuk Keluar</p>
      </div>
    </div>

<div class="user-online">
  <span><i><b>online : </b></i></span> <span class="u-val">-</span>
</div>

<script type="text/javascript">
	b4_sidebar();
  var html='';
  $.each(kate, function(k,v){
    // var v= Object.keys(v);
    html +='<a class="dropdown-item" href="#" onclick="loadPage(\'soalAll\',\''+v+'\')">'+v+'</a>';
  })
  $('.drop-kat').html(html);

  ref.once('value').then(function(snap){
    var data = snap.val();
    $('.user').text(data.username);
    $('.img-user').attr('src', data.photoUrl);
  }).catch(function(e){
    swall('ERROR',e.message,'error');
  })

    var isOfflineForDatabase = {
        state: 'offline',
        last_changed: firebase.database.ServerValue.TIMESTAMP,
    };

    var isOnlineForDatabase = {
        state: 'online',
        last_changed: firebase.database.ServerValue.TIMESTAMP,
    };

    db.ref('.info/connected').on('value', function(snapshot) {
      if (snapshot.val() == false) {
          return;
      };
      ref.onDisconnect().update(isOfflineForDatabase).then(function() {
          ref.update(isOnlineForDatabase);
          // $('.label-chat').text(gs)
      });
    });    

    db.ref('users').on('value', function(snap) {
      var cou = 0;
      var users = snap.val(); 
      $.each(users, function(key,val){
        if (val.state == "online") {
          cou++;
        }
      })
      $('.u-val').text(cou);
    });


</script>
