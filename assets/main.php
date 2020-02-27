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
              <a class="nav-link" href="#" onclick="loadPage('akun')"><i class="ion-person abs"></i><span class="pl-4">Akunku</span></a>
          </li> 
         <li class="nav-item">
              <a class="nav-link" href="#" onclick="loadPage('friend')"><i class="ion-android-contacts abs"></i><span class="pl-4">Temanku</span></a>
          </li>               
          <li class="nav-item">
              <a class="nav-link" href="#" onclick="loadPage('cari')"><i class="ion-android-search abs"></i><span class="pl-4">Cari Pemain</span></a>
          </li> 
           <li class="nav-item">
              <a class="nav-link" href="#" onclick="loadPage('tambahteman')"><i class="ion-earth abs"></i><span class="pl-4">Permintaan Pertemananku </span><span class="bg-danger rounded"><b class="cek-inbox"></b></span></a>
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

<div class="container main" style="margin-top: 70px">
  <div class="row">
    <div class="col-sm-4 main-sendiri text-center">
      <div class="p-2 bg-primary"><b>SINGLE MODE</b></div>
      <img src="img/solo.jfif" class="img-fluid rounded-circle" width="80" height="auto">
      <div class="mulai-main-sendiri">
        <button class="btn btn-danger" onclick="loadPage('tampilLevel')">Mulai</button>
      </div>    
    </div>

    <div class="col-sm-4 duel text-center">
      <div class="p-2 bg-primary"><b>DUEL MODE VS TEMAN</b></div>
      <img src="img/duel.jfif" class="img-fluid rounded-circle" width="80" height="auto">
      <div class="mulai-duel">
        <button class="btn btn-warning" onclick="loadPage('tampilLevelDuelXTeman')">Mulai</button>
      </div>
    </div>  

    <div class="col-sm-4 duel-acak text-center">
      <div class="p-2 bg-primary"><b>DUEL MODE ACAK</b></div>
      <img src="img/acak.jfif" class="img-fluid rounded" width="100" height="auto">
      <div class="mulai-duel">
        <button class="btn btn-secondary" onclick="loadPage('tampilLevelDuelXAcak')">Mulai</button>
      </div>
    </div>
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

  fdt=[]//clear all soal
  ref.on('value', function(snap){
    var data = snap.val();
    tingkat = data.lvl;
    kelas = data.kls;
    mappel = data.lvl_mapel;
    if(data.duel != undefined){
      var datan = Object.values(data.duel)[0];
        swal({
          title:'Dapat Tantangan !!',
          text:datan.isi,
          icon:'info',
          buttons:['Tolak', 'Terima']
        }).then(function(ok){
          if(ok){
            uidnya = datan.uid;
            unanya = datan.nama;
            aTingkatDuel = datan.at;
            aKelasDuel = datan.kls;
            mappelDuel = datan.mpl;
            ss('deso', datan.deso);
            var rr = ref.child('duel/'+uidnya);
            rr.once('value').then(function(snap){
              if(snap.val() != null){//jika tantangna masih berlalaku
                rr.remove();
                loadPage('goDuel');
              }
            })
          }
        })
    }

    ss('umur', data.umur);
    sls('user', data.username);
    sls('photoUrl', data.photoUrl);
    $('.user').text(gls('user'));
    $('.img-user').attr('src', data.photoUrl);
    if (data.permintaan_pertemanan != null) {
      var coun = Object.keys(data.permintaan_pertemanan).length;
      $('.cek-inbox').text(coun);
    }
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
          if (gls('bug') != null) {
            db.ref(gls('bug')).remove();// clear bug
          }
          ref.child('duel').remove();//clear bug
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

