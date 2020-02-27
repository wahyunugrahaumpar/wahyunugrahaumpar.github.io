  <div class="loader"></div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-smg-berhasil"><span class="xvx"></span><span style="position: absolute; right: 5px;" class="waktu text-right">0</span></div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="cekKembali()">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container smg-berhasil" style="margin-top: 70px">
      <div class="pertanyaan">    

        
      </div>  
   </div>

   <script type="text/javascript">
    clearInterval();
    nilai = 0;
    inde=0;
    var keyAktif= '';
    if(gs('acak') == 'menunggu'){
      setP();
      keyAktif = uid;
      // console.log(uid); //key sekaligus uid menunggu

      // console.log(uidnya); //lawan
      $('.xvx').text(gls('user')+" VS "+ unanya);
    }else{
      setP();
      keyAktif = uidnya;
      // console.log(uidnya);//key sekaligus uid lawan

      // console.log(uidnya); // lawan
      $('.xvx').text(gls('user')+" VS "+ unanya);
    }


    function setP(){
      var detik = parseInt(gs('deso'));
      timer1 = setInterval(function(){
        $('.waktu').text(detik);
        detik--;
        if (detik < 0) {
          clearInterval(timer1);
        }
      }, 1000);

      timer = setTimeout(function(){
        clearInterval(timer1);
        // clearTimeout(timer);
        swal({
          title:'INFORMASI',
          text:'Waktu Habis, Klik Ok untuk melihat hasil!',
          closeOnClickOutside: false,
          icon:'info'
        }).then(function(e){
            if(e){
             if (gs('acak') == 'menunggu') {
                 db.ref('duelacakmain/'+uid+'/'+uid+'/state').set(true);
              }else{
                 db.ref('duelacakmain/'+uidnya+'/'+uid+'/state').set(true);
              }
              loadPage('hasilDuelAcak');
            }
        })
      }, (detik*1000)+2000);


      var html ='', nilai=0;
      $.each(fdt, function(k,v){
        if (v.jeso == 'B or S') {
          html +=  `<div class="perhide pertanyaan${k}"><div class=" text-justify rounded p-2 bg-secondary mb-2" style="max-height: 400px; overflow: auto;">
            ${v.soal}
          </div>
          <div class="row" style="position: absolute; bottom: 0; left: 30px; right: 30px;">
            <div class="col text-left" onclick="hide(${v.pointidak},${k})"><button class=" btn p-4 rounded-circle btn-danger" name="salah${k}" value="">Salah</button></div>
            <div class="col text-right" onclick="hide(${v.poinya},${k})"><button class=" btn p-4 rounded-circle btn-success" name="benar${k}" value="">Benar</button></div>
          </div></div>`
        }else{
          html += `<div class="perhide pertanyaan${k}"><div class="text-justify p-2 bg-secondary rounded mb-2" style="max-height: 300px; overflow: auto;">${v.soal}
          </div>
          <div class="text-center">
            <img src="${v.gambar}" class="img-fluid">
          </div>
          <div style="position: absolute; bottom: 0; left: 5px; right: 5px;">
            <button class="btn btn-primary btn-block btn-modif text-left" onclick="hide(${v.poinjawabana},${k})">A. ${v.jawabana}</button>
            <button class="btn btn-primary btn-block btn-modif text-left" onclick="hide(${v.poinjawabanb},${k})">B. ${v.jawabanb}</button>
            <button class="btn btn-primary btn-block btn-modif text-left" onclick="hide(${v.poinjawabanc},${k})">C. ${v.jawabanc}</button>
            <button class="btn btn-primary btn-block btn-modif text-left" onclick="hide(${v.poinjawaband},${k})">D. ${v.jawaband}</button>
          </div></div>`;
        }
      })
      html+='<div class="perhide pertanyaan'+fdt.length+'"><div class="jumbutron"><h4>Kamu Telah Menjawab Seluruh Pertanyaan Silahkan tunggu sampai waktu habis!</h3></div> </div>'
      $('.pertanyaan').html(html);
      $('.perhide').hide();
      $('.pertanyaan0').show();
    }

     function hide(n,a){
      // console.log(fdt.length);
      // console.log(a);
      // console.log('---');
        nilai += n;

        if (gs('acak') == 'menunggu') {
           db.ref('duelacakmain/'+uid+'/'+uid+'/poin').set(nilai);
        }else{
           db.ref('duelacakmain/'+uidnya+'/'+uid+'/poin').set(nilai);
        }

        $('.pertanyaan'+a).hide();
        $('.pertanyaan'+(a+1)).show();
    }


    function cekKembali(){
        swal({
          title:'Bahaya bosq..',
          text:'Yakin ingin Kembali, Kamu Akan Kalah Loh!',
          icon:'warning'
        }).then(function(e){
            if(e){
              clearTimeout(timer);
              clearInterval(timer1);
              if (gs('acak') == 'menunggu') {
                 db.ref('duelacakmain/'+uid+'/'+uid+'/state').set(true);
              }else{
                 db.ref('duelacakmain/'+uidnya+'/'+uid+'/state').set(true);
              }


              db.ref('duelacakmain/'+keyAktif).once('value').then(function(snap){
                var data = snap.val();
                $.each(data, function(k,v){
                  if(v.state){
                    inde++;
                  }
                })
                  if(inde >= 2){
                    inde=0;
                    db.ref('duelacakmain/'+keyAktif).remove();
                  }
                    setTimeout(function(){
                      $('.m-lagi').fadeIn();
                    }, 2000);
              })
              loadPage('main');
            }
        })
      }

      // setInt();
   </script>