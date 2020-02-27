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
    nilai = 0;
    inde=0;

    refku = db.ref('duel/'+uidnya+'_'+uid);
    refnya = db.ref('duel/'+uid+'_'+uidnya);

    if(fdt.length == 0){//yang ditantang
      $('.loader').show();
      $('.xvx').text(gls('user')+" VS "+ unanya)
      refku.once('value').then(function(snap){
        var data = snap.val();
        if(data != null){
          fdt = data.soal;
    // console.log(fdt.length);
          $('.loader').hide();
          setP('ditantang');
        }
      })
      ss('duelAktif', uidnya+'_'+uid);
    }else{//penantang
    // console.log(fdt.length);
      ss('duelAktif', uid+'_'+uidnya);
      setP('penantang');
      $('.xvx').text(gls('user')+" VS "+ unanya)
    }


    function setP(kode){
      kodespesial = kode;
      var detik = gs('deso');
      timer = setTimeout(function(){
        clearTimeout(timer);
        clearInterval(timer1);
        swal({
          title:'INFORMASI',
          text:'Waktu Habis, Klik Ok untuk melihat hasil!',
          closeOnClickOutside: false,
          icon:'info'
        }).then(function(e){
            if(e){
              if (kodespesial == 'ditantang') {
                 refku.child(uid+'/state').set(true);
              }
              if(kodespesial == 'penantang'){
                 refnya.child(uid+'/state').set(true);
              }
              loadPage('hasilDuel');
            }
        })
      }, (detik*1000)+2000);

      timer1 = setInterval(function(){
        $('.waktu').text(detik);
        detik--;
      },1000);


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
            <button class="btn btn-primary btn-block btn-modif text-left" onclick="hide(${v.poinjawabana},${k}, '${kode}')">A. ${v.jawabana}</button>
            <button class="btn btn-primary btn-block btn-modif text-left" onclick="hide(${v.poinjawabanb},${k}, '${kode}')">B. ${v.jawabanb}</button>
            <button class="btn btn-primary btn-block btn-modif text-left" onclick="hide(${v.poinjawabanc},${k}, '${kode}')">C. ${v.jawabanc}</button>
            <button class="btn btn-primary btn-block btn-modif text-left" onclick="hide(${v.poinjawaband},${k}, '${kode}')">D. ${v.jawaband}</button>
          </div></div>`;
        }
      })
      html+='<div class="perhide pertanyaan'+fdt.length+'"><div class="jumbutron"><h4>Kamu Telah Menjawab Seluruh Pertanyaan Silahkan tunggu sampai waktu habis!</h3></div> </div>';
      $('.pertanyaan').html(html);
      $('.perhide').hide();
      $('.pertanyaan0').show();

        // if (kode == 'ditantang') {
          
        // }
    }
    
      function hide(n,a,kod){
        nilai += n;

        if (kod == 'ditantang') {
          refku.child(uid+'/poin').set(nilai);//ditantang
        }

        if(kod == 'penantang' ){
          refnya.child(uid+'/poin').set(nilai);//penantang
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
              if (kodespesial == 'ditantang') {
                 refku.child(uid+'/state').set(true);
              }
              if(kodespesial == 'penantang'){
                 refnya.child(uid+'/state').set(true);
              }

              db.ref('duel/'+gs('duelAktif')).once('value').then(function(snap){
                var data = snap.val();
                $.each(data, function(k,v){
                  if(v.state){
                    inde++;
                  }
                })
                  if(inde >= 2){
                    inde=0;
                    if(kodespesial == "ditantang"){
                      refku.remove();
                    }              
                    if(kodespesial == "penantang"){
                      refnya.remove();
                    }
                  }

              })
              clearTimeout(timer);
              clearInterval(timer1);
              loadPage('main');
            }
        })
      }
      // setInt();
   </script>