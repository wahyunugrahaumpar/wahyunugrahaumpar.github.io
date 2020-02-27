  <div class="loader"></div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-mapel">Pilih Mata Pelajaran <span class="at"></span></div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('tampilKelas')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container mapel" style="margin-top: 70px">
     	
   </div>

   <script type="text/javascript">
    $('.loader').show();
    acm=true;
      db.ref('soal/'+aTingkat+'/'+aKelas).once('value').then(function(da){
        var data = da.val();
        var index = 0;

        mapelAktifLength = Object.keys(data).length;//set length mapel untuk hasil

        ref.once('value').then(function(snap){
          var html = '';
          var dat = snap.val().lvl_mapel;
          $('.at').text(aTingkat);

          var poin_mpl = dat[aTingkat][aKelas];

          $.each(data, function(k,v){

            var disabled = 'disabled';
            var ion = 'ion-close';
            var blm='blm';

            if(index <= poin_mpl){
              disabled = '';
              if(index < poin_mpl){
                ion = 'ion-checkmark';
                blm = 'sdh';
              }
            }

            html+= '<div class="row"><div class="col-3 p-1"><button class="btn btn-block btn-secondary"><i class="'+ion+'"></i></button></div><div class="col-9 p-1"><button '+disabled+' class="btn btn-block btn-danger" onclick="setAm(\''+k+'\',\''+blm+'\')">'+k+'</button></div></div>';
            index++;
          })
          $('.loader').hide();
          acm=false;
          $('.mapel').html(html);
        })

      })

      function setAm(a,kode){
        aMapel = a;
        kett = kode;
        loadPage('tampilPokok');
      } 


   </script>