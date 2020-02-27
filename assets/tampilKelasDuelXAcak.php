  <div class="loader"></div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-kls">Pilih Kelas Duel Acak</span></div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('tampilLevelDuelXAcak')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container kls" style="margin-top: 70px">
      
   </div>

   <script type="text/javascript">
    $('.loader').show();
    acm=true;

      db.ref('soal/'+aTingkatDuel).once('value').then(function(da){

      var data = da.val();  
      var html = '';
        if (aTingkatDuel == 'SMP') {//urutkan
            var dt = {};
            var index = 7;
           $.each(data, function(k,v){
              dt[romanize(index)] = data[romanize(index)];
              index++;
           })
           data = dt;
        }
        $.each(data, function(k,v){
            html+= '<button class="btn btn-block btn-danger" onclick="setKls(\''+k+'\')">'+k+'</button>';
        })
        $('.loader').hide();
        acm=false;
        $('.kls').html(html);
      })

      function setKls(a){
        aKelasDuel = a;
        loadPage('tampilMapelDuelXAcak');
      }

   </script>