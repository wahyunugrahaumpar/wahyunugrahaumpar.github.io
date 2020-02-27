  <div class="loader"></div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-smg-berhasil">Semoga Berhasil </div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('tampilMapel')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container smg-berhasil" style="margin-top: 70px">
      <div class="pertanyaan">    

        
      </div>  
   </div>

   <script type="text/javascript">

    // var reff = ref.child('lvl_mapel/'+aTingkat+'/'+aKelas);
    // reff.on('value', function(snap){
      // var data = snap.val();
      // nnmappel = data;
    // })

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
    html+=`<div class="pertanyaan10 perhide">
          <div class="jumbotron text-center">
            <p>Kamu Telah Menjawab Semua Pertanyaan, Klik Lihat Hasil Untuk Melihat Hasil Tes Mu..</p>
            <button class="btn btn-primary" onclick="loadPage('hasil')">Lihat Hasil</button>
          </div>
        </div>`;

    function hide(n,a){
      nilai += n;
      $('.pertanyaan'+a).hide();
      $('.pertanyaan'+(a+1)).show();
    }

    $('.pertanyaan').html(html);
    $('.perhide').hide();
    $('.pertanyaan0').show();
    // setInt();

   </script>