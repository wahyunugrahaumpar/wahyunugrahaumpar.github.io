  <div class="loader"></div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-mapel">Pilih Pokok Pembahasan <span class="at"></span></div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('tampilMapel')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container mapel" style="margin-top: 70px">
     	
   </div>

   <script type="text/javascript">
    $('.loader').show();
    acm=true;
    swall('INFORMASI','Selesaikan Minimal Satu Pokok Pembahasan Untuk Ke Level Selanjutnya..','info')
    var dt= [], dtt=[];
    db.ref('soal/'+aTingkat+'/'+aKelas+'/'+aMapel).once('value').then(function(da){
      fdt=[];
      var data = da.val();
      var html='';
      $('.at').text(aTingkat);
      var index = 0;
      $.each(data, function(k,v){
        dt.push(v);
          html+= '<button class="btn btn-block btn-danger" onclick="jawabSoal('+index+')">'+k+'</button>';
        index++;
      })
      $('.loader').hide();
      acm=false;
        $('.mapel').html(html);
    })

    function jawabSoal(index){
      $('.loader').show();
      $.each(dt[index], function(k,v){
        $.each(v, function(kk, vv){
          dtt.push(vv);
        })
      })
      fdt = shuffle(dtt).slice(0,10);
      loadPage('mulaiJawab');      
    }

   </script>