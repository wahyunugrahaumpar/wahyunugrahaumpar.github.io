  <div class="loader"></div>

  <div class="bg-duel">
  <div class="duel-text">
    <i><b>Menunggu Teman...</b></i>
  </div>
</div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-lihat-hasil">Hasil Akhir</div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('main')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container lihat-hasil" style="margin-top: 70px">

   </div>

   <!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailLabel">Penjelasan Tiap Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

  <script type="text/javascript">
    $('.loader').show();
    acm=true;
    var satuKali = true, inde=0; 
    
    refku.once('value').then(function(snap){//yang ditantang
      var data1 = snap.val();
      if(data1 != null){
        cetakHasil(data1);
        // console.log(uid,'ditantang');
        // console.log(uidnya,'ditantang');
      }

    })    

    refnya.once('value').then(function(snap){//penantang
      var data0 = snap.val();
      if(data0 != null){ 
          cetakHasil(data0);
        // console.log(uid,'penantang');
        // console.log(uidnya,'penantang');
      }
    })


    function cetakHasil(dataSoal){
      var html = `<div class="text-center">
                   <div class="user1 bg-danger rounded">
                      <h2><b>${dataSoal[uid].nama}</b></h2>
                    </div>
                    <div class="poin-user1">
                      <h3><b>${dataSoal[uid].poin}</b></h3>
                    </div>
                    <div class="vsbg-warning ">
                      <h4><i><b>VS</b></i></h4>
                    </div>
                    <div class="poin-user2">
                      <h3><b>${dataSoal[uidnya].poin}</b></h3>
                    </div>
                    <div class="user2 bg-danger rounded">
                      <h2><b>${dataSoal[uidnya].nama}</b></h2>
                    </div>
                  </div><div><button class="btn btn-block btn-success m-lagi" onclick=tantangTeman('${uidnya}','${dataSoal[uidnya].nama}','${dataSoal[uidnya].nama}','${gs('deso')}');>LAGI ?</button></div>`;
        $('.lihat-hasil').html(html);
        // db.ref('duel').remove();

        if (dataSoal[uid].poin < dataSoal[uidnya].poin) {
          swall('Kalah Huhh!!', 'Kamu kalah..', 'info');
        }else if(dataSoal[uid].poin == dataSoal[uidnya].poin){
          swall('Seri!!', 'Permainan Seri..', 'info');
        }else{
          swall('MENANG YEAH..!!', 'Kamu Menang..', 'info');
        }

      $('.loader').hide();
      acm=false;

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
              setTimeout(function(){
                $('.m-lagi').fadeIn();
              }, 2000)
      })

    }

fdt=[]//clear all soal
ref.on('value', function(snap){
    var data = snap.val();
    if(data.duel != undefined){
      var datan = Object.values(data.duel)[0];
      // console.log(datan)
        swal({
          title:'Dapat Tantangan !!',
          text: datan.isi,
          icon:'info',
          buttons:['Tolak', 'Terima']
        }).then(function(ok){
          if(ok){
            uidnya = datan.uid;
            // uid = datan.uidd,
            unanya = datan.nama;
            aTingkatDuel = datan.at;
            mappelDuel = datan.mpl;
            // console.log(mappel);
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
})
  // AdMob.showInterstitial();
   </script>