    <div class="loader"></div>
  <div class="container-fluid">

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="j-kelas">Filter Kelas : </label>
          <select class="form-control j-kelas" id="j-kelas">
     
          </select>
        </div>     
      </div>
      <div class="col">
        <div class="form-group">
          <label for="j-mapel">Filter Pelajaran : </label>
          <select class="form-control j-mapel" id="j-mapel">
     
          </select>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="j-pokok">Filter Pokok : </label>
          <select class="form-control j-pokok" id="j-pokok">
     
          </select>
        </div> 
        
      </div>
      <div class="col">
        <div class="form-group">
          <label for="j-soal">Filter Jenis Soal :</label>
          <select class="form-control j-soal" id="j-soal">

          </select>
        </div>
      </div>
    </div>


  </div>

  <div class="container-fluid">
     <div class="tambah-soal mb-1">
       <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modaltambah" onclick="tambahSoal()">Tambah Soal</button>
     </div>
   </div>

   <div class="container-fluid" id="soal-all" style="overflow: auto;">
  
   </div>


   <!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltambahLabel">Tambah Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-input-soal">
      <div class="modal-body">         
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="j-kelas-i">Pilih Kelas : </label>
                <select class="form-control j-kelas" id="j-kelas-i">
           
                </select>
              </div> 
            </div>
              
            <div class="col">
              <div class="form-group">
                <label for="j-mapel-i">Mata Pelajaran : *</label>
                <select class="form-control j-mapel" id="j-mapel-i">

                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="j-pokok-i">Pokok Pembahasan * : </label>
                <select class="form-control j-pokok" id="j-pokok-i">
           
                </select>
              </div> 
            </div>
            <div class="col">
              <div class="form-group">
                <label for="j-soal-i">Jenis Soal : *</label>
                <select class="form-control j-soal" id="j-soal-i">
                  <option>B or S  </option>
                  <option>Pilihan Ganda</option>
                </select>
              </div>
            </div>
          </div> 
        
        

        
        <div class="form-group">
          <label for="soal">Soal : *</label>
          <textarea class="form-control" id="isi-soal" placeholder="Input Soal"></textarea>
        </div>

        <div class="ya-tidak">
          <div class="row">
            <div class="col">
                <div class="form-group">
                  <label for="poin-ya">Poin Benar : *</label>
                  <input type="number" class="form-control" id="poin-ya" placeholder="input poin ya">
                </div>    
            </div>
            <div class="col">
              <div class="form-group">
                <label for="poin-tidak">Poin Salah : *</label>
                <input type="number" class="form-control" id="poin-tidak" placeholder="input poin tidak">
              </div>
            </div>
          </div>
        </div><!-- end ya tidak -->

        <div class="pilgan">
          <div class="form-group">
            <div class="text-center">
              <img src="" id="soal-img" class="img-fluid" width="60" height="auto" alt="">              
            </div>
           <label for="i-gambar">Input Gambar : </label>
           <input type="file" class="form-control" id="i-gambar" onchange="loadImg('i-gambar','soal-img')">
          </div>          
          <div class="form-group">
           <label for="jawaban-a">Jawaban A : *</label>
           <input type="text" class="form-control" id="jawaban-a" placeholder="Input Jawaban A">
          </div>          
          <div class="form-group">
           <label for="poin-jawaban-a">Poin Jawaban A : *</label>
           <input type="number" class="form-control" id="poin-jawaban-a" placeholder="Input Poin Jawaban A">
          </div>
          <div class="form-group">
           <label for="jawaban-b">Jawaban B : *</label>
           <input type="text" class="form-control" id="jawaban-b" placeholder="Input Jawaban B">
          </div>         
          <div class="form-group">
           <label for="poin-jawaban-b">Poin Jawaban B : *</label>
           <input type="number" class="form-control" id="poin-jawaban-b" placeholder="Input Poin Jawaban B">
          </div>
          <div class="form-group">
           <label for="jawaban-c">Jawaban C : *</label>
           <input type="text" class="form-control" id="jawaban-c" placeholder="Input Jawaban C">
          </div>          
          <div class="form-group">
           <label for="poin-jawaban-c">Poin Jawaban C : *</label>
           <input type="number" class="form-control" id="poin-jawaban-c" placeholder="Input Poin Jawaban C">
          </div>
          <div class="form-group">
           <label for="jawaban-d">Jawaban D : *</label>
           <input type="text" class="form-control" id="jawaban-d" placeholder="Input Jawaban D">
          </div>          
          <div class="form-group">
           <label for="poin-jawaban-d">Poin Jawaban D : *</label>
           <input type="number" class="form-control" id="poin-jawaban-d" placeholder="Input Poin Jawaban D">
          </div>
        </div><!-- end pilgan -->

        <div class="form-group">
          <label for="soal">Ket : </label>
          <textarea class="form-control" id="isi-ket" placeholder="Input Keterangan Jawaban"></textarea>
        </div>

        <div class="note">
         <div><b>Note : </b>* Wajib diisi</div>
        </div>
        </form>

      </div> <!-- modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary btn-simpan" onclick="simpan()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
//awal
 var aKate = gs('kategori');
 var dataKelas = search(aKate,tingkatan);

 var  htmlKelas='', htmlMapel ='', htmlPokok ='', htmlJeso='';

 $.each(dataKelas, function(k,v){
  htmlKelas+='<option>'+v+'</option>'
 })
 $('.j-kelas').html(htmlKelas); 

 $.each(mapel, function(k,v){
  htmlMapel+='<option>'+Object.keys(v)+'</option>'
 })
 $('.j-mapel').html(htmlMapel);   

 $.each(jenSo, function(k,v){
  htmlJeso+='<option>'+v+'</option>'
 })
 $('.j-soal').html(htmlJeso);


 $('#j-kelas').on('change', function(){
   kls = $(this).val();
   tampilSoal(aKate,kls,mpl,pokok,jenis); 
 })

 $('#j-mapel').on('change', function(){
    mpl = $(this).val();
    setPokok(mpl);
 })  

 $('#j-pokok').on('change', function(){
   pokok = $(this).val();
   tampilSoal(aKate,kls,mpl,pokok,jenis); 
 }) 

 $("#j-soal").on('change', function(){
  jenis = $(this).val();
  tampilSoal(aKate,kls,mpl,pokok,jenis); 
 })



 var kls = $("#j-kelas").val(), mpl = $("#j-mapel").val(), pokok ,jenis=$("#j-soal").val();

 setPokok(mpl);


//end block awal

 function setPokok(kode){
  htmlPokok = '';
    var data = search(kode, mapel);
     $.each(data, function(k,v){
      htmlPokok+='<option>'+v+'</option>'
     })
      $('#j-pokok').html(htmlPokok);
      pokok = $("#j-pokok").val();
      tampilSoal(aKate,kls,mpl,pokok,jenis);
 } 

 function setPokok1(kode){
  htmlPokok = '';
    var data = search(kode, mapel);
     $.each(data, function(k,v){
      htmlPokok+='<option>'+v+'</option>'
     })
      $('#j-pokok-i').html(htmlPokok);
 }

//input
 
 $('#j-mapel-i').on('change', function(){
    setPokok1($(this).val(),'kode');
 }) 

 

 $("#j-soal-i").on('change', function(){
  if ($(this).val() == "Pilihan Ganda") {
   $('.ya-tidak').hide();
   $('.pilgan').show();   
  }else{
   $('.pilgan').hide();
   $('.ya-tidak').show();
  }
 })
//end input 



function simpan(kode){
  var kls_i = $('#j-kelas-i').val();
  var mpl_i = $('#j-mapel-i').val();
  var pokok_i = $('#j-pokok-i').val();
  var jenis_i = $('#j-soal-i').val();
  var isi = $('#isi-soal').val();
  var poinya = $('#poin-ya').val();
  var pointidak = $('#poin-tidak').val();
  var jawabana = $('#jawaban-a').val();
  var jawabanb = $('#jawaban-b').val();
  var jawabanc = $('#jawaban-c').val();
  var jawaband = $('#jawaban-d').val();
  var poinjawabana = $('#poin-jawaban-a').val();
  var poinjawabanb = $('#poin-jawaban-b').val();
  var poinjawabanc = $('#poin-jawaban-c').val();
  var poinjawaband = $('#poin-jawaban-d').val();
  file = document.getElementById('i-gambar').files[0];
  var ket = $('#isi-ket').val();
  var inf = 'ditambahkan';
  if(kode == undefined){
    var refIn = db.ref('soal/'+aKate+'/'+kls_i+'/'+mpl_i+'/'+pokok_i+'/'+jenis_i).push();
  }else{
    inf = 'diEdit';
    var refIn = db.ref('soal/'+aKate+'/'+kls_i+'/'+mpl_i+'/'+pokok_i+'/'+jenis_i+'/'+kode);
  }
 if (jenis_i == 'B or S') {
  if (isi=="" || poinya=="" || pointidak=="") {
   swall('ERROR','Isi Dulu Kolom Yang kosong');
  }else{
   refIn.set({
    tingkat: aKate,
    mapel:mpl_i,
    kelas:kls_i,
    pokok:pokok_i,
    jeso: jenis_i,
    soal:isi,
    poinya:poinya,
    pointidak:pointidak,
    ket:ket
   });

   refIn.once('child_added', function(){
    swall('Berhasil','Soal Tingkat '+ aKate+' Kelas '+kls_i+' '+mpl_i+' Pokok Pembahasan'+ pokok_i +' Jenis '+ jenis_i+' Berhasil '+inf,'success');
        if(kode != undefined){//jika edit
          $('#modaltambah').modal('hide')
        }
     $('.form-input-soal').trigger('reset');
   })

  }
 }else{
  if (isi=="" || jawabana=="" || jawabanb=="" || jawabanc==""  || jawaband=="" || poinjawabana=="" || poinjawabanb=="" || poinjawabanc=="" || poinjawaband=="") {
   swall('ERROR','Isi Dulu Kolom Yang kosong');
  }else{
   refIn.set({
    tingkat: aKate,
    mapel:mpl_i,
    kelas:kls_i,
    pokok:pokok_i,
    jeso: jenis_i,
    soal:isi,
    gambar:"",
    jawabana: jawabana,
    poinjawabana:poinjawabana,
    jawabanb: jawabanb,
    poinjawabanb:poinjawabanb,
    jawabanc: jawabanc,
    poinjawabanc:poinjawabanc,
    jawaband: jawaband,
    poinjawaband:poinjawaband,
    ket:ket
   });

   refIn.once('child_added', function(){
    swall('Berhasil','Soal Tingkat '+ aKate+' Kelas '+kls_i+' '+mpl_i+' Pokok Pembahasan'+ pokok_i +' Jenis '+ jenis_i+' Berhasil '+inf,'success');
        if(kode != undefined){//jika edit
          $('#modaltambah').modal('hide')
        }
     $('.form-input-soal').trigger('reset');
   })

    if (file != undefined) {
      var refS = storage.ref('soal/'+aKate+'/'+kls_i+'/'+mpl_i+'/'+pokok_i+'/'+jenis_i+'/'+refIn.key+'.png');

      var uploadTask = refS.put(file);

      uploadTask.on("state_changed", function(a){
      },function(e){

      },function(c){
        refS.getDownloadURL().then(function(url){
          refIn.update({
           gambar: url,
          }).then(function(){
            swall('Berhasil','Gambar Berhasil Di Upload','success');
          })
        })
      })
    }

  }
 }
} 

function tambahSoal(){
  setPokok1('IPA');
  $('#soal-img').attr('src','');
  $('#modaltambahLabel').text('Tambah Soal');
  $('.form-input-soal').trigger('reset');
  $('.pilgan').hide();
  $('.ya-tidak').show();
  $('#j-kelas-i').attr('disabled',false);
  $('#j-mapel-i').attr('disabled',false);
  $('#j-pokok-i').attr('disabled',false)
  $('#j-soal-i').attr('disabled',false);
  $('.btn-simpan').attr('onclick','simpan()');
}
</script>

