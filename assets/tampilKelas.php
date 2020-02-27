  <div class="loader"></div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-kls">Pilih Kelas <span class="at"></span></div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('tampilLevel')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container kls" style="margin-top: 70px">
     	
   </div>

   <script type="text/javascript">

    $(function(){
      $('.loader').show();
      acm=true;
      db.ref('soal/'+aTingkat).once('value').then(function(da){

        var data = da.val();      
        var html = '';
        if (aTingkat == 'SMP') {//urutkan
            var dt = {};
            var index = 7;
           $.each(data, function(k,v){
              dt[romanize(index)] = data[romanize(index)];
              index++;
           })
           data = dt;
        }
        ref.once('value').then(function(snap){
          var dat = snap.val();
          kelas = dat.kls;
          $('.at').text(aTingkat);


          $.each(data, function(k,v){
            var disabled = 'disabled';
            var ion = 'ion-close';
            var blm='blm';
            var a = roman_to_Int(k);
            var b = roman_to_Int(kelas);
          if(a <= b){
            disabled = '';

            if(a < b){
              ion = 'ion-checkmark';
              blm = 'sdah';
            }
          } 
              html+= '<div class="row"><div class="col-3 p-1"><button class="btn btn-block btn-secondary"><i class="'+ion+'"></i></button></div><div class="col-9 p-1"><button '+disabled+' class="btn btn-block btn-danger btn" onclick="setAk(\''+k+'\')">'+k+'</button></div></div>';
          })
          $('.loader').hide();
          acm=false;
          $('.kls').html(html);
        })
      })

    })
      function setAk(a){
        aKelas = a;
        loadPage('tampilMapel');
      } 
   </script>