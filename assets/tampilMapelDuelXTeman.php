  <div class="loader"></div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-mapel">Pilih Mata Pelajaran Duel</span></div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('tampilLevelDuelXTeman')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container mapel" style="margin-top: 70px">
      
   </div>

   <script type="text/javascript">
    $('.loader').show();
    acm=true;
    db.ref('soal/'+aTingkatDuel+'/'+aKelasDuel).once('value').then(function(da){
      var data = da.val();
      var html = '';
      $.each(data, function(k,v){
        html+= '<button class="btn btn-block btn-danger" onclick="setMpl(\''+k+'\')">'+k+'</button>';
      })
      $('.loader').hide();
      acm=false;
      $('.mapel').html(html);
    })

      function setMpl(a){
        mappelDuel = a;
        loadPage('cteman');
      }

   </script>