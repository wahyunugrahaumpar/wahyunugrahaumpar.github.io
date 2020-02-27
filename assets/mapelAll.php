  <div class="loader"></div>
  <div class="container">   

    <div class="form-group">
      <label for="j-kelas">Filter Kelas : </label>
      <select class="form-control j-kelas" id="j-kelas">
 
      </select>
    </div>     

    <div class="form-group">
      <label for="j-mapel">Filter Pelajaran : </label>
      <select class="form-control j-mapel" id="j-mapel">
 
      </select>
    </div> 
 

  </div>

  <div class="container">
     <div class="tambah-soal">
       <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modaltambah" onclick="tambahSoal()">Tambah Mata Pelajaran</button>
     </div>
   </div>

   <div class="container soal" style="overflow: auto;">
  
   </div>


   <!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltambahLabel">Tambah Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-input-soal">
      <div class="modal-body">

        <div class="form-group">
          <label for="j-kelas-i">Pilih Kelas : *</label>
          <select class="form-control j-kelas" id="j-kelas-i">
     
          </select>
        </div> 

        <div class="form-group">
          <label for="j-mapel-i">Mata Pelajaran : *</label>
          <select class="form-control j-mapel" id="j-mapel-i">

          </select>
        </div>        

        <div class="form-group">
          <label for="pokok">Pokok Pembahasan : *</label>
          <input type="text" placeholder="Pokok Pembahasan" id="pokok" class="form-control">
        </div>
         
       
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

 var dataKelas = Object.entries(searchKelas(aKate, wagoData));//cari kelas

 var mpl = mapel[0], kls = dataKelas[0][0];

 var htmlKelas='',htmlMapel='';

 $.each(dataKelas, function(k,v){
  htmlKelas+='<option>'+v[0]+'</option>'
 })

 $('.j-kelas').html(htmlKelas); 

 $.each(mapel, function(k,v){
  htmlMapel+='<option>'+v+'</option>'
 })
 $('.j-mapel').html(htmlMapel);

 $('#j-kelas').on('change', function(){
   kls = $(this).val();
   tampilMapel(aKate,kls,mpl); 
 })

 $('#j-mapel').on('change', function(){
   mpl = $(this).val();
   tampilMapel(aKate,kls,mpl); 
 }) 

 tampilMapel(aKate,kls,mpl);//tampil diawal 


function tampilMapel(aKate,kls,mpl){
  db.ref('mapel/'+aKate+'/'+kls+'/'+mpl).once('value').then(function(snap){
    var dt = snap.val();
    var html =`<table class="table table-sm"><thead class="thead-dark">
      <tr>
      <th scope="col">NO</th>
      <th scope="col">NAMA</th>
      <th scope="col">ACTION</th>
      </tr>
          </thead>
          <tbody class="body-user">`;
    var no =1;
    if(dt == null){
      $('.soal').html('<h1 class="blm-ada-soal">Belum Ada Mata Pelajaran !</h1>');
    }else{
      $.each(dt, function(k,v){
        html += `<tr><th scope="row">${no}</th><td scope="row">${v}</td><td><button class="btn btn-secondary" onclick="hpsMapel('${aKate}','${kls}','${mpl}','${k}')">Hps</button><button class="btn btn-success" data-toggle="modal" data-target="#modaltambah" onclick="editMapel('${aKate}','${kls}','${mpl}','${k}','${v}')">Edit</button></td></tr>`;
        no++;
      })
         html += `</tbody>
                </table>`;
      $('.soal').html(html);

      // console.log(dt);
    }
  })
}

function hpsMapel(a,b,c,d){
  swal({
    title:'WARNING',
    text:'Yakin Ingin Menghapus Soal?',
    icon:'warning',
    buttons: true 
  }).then(function(e){
      if(e){
          var rm = db.ref('mapel/'+a+'/'+b+'/'+c+'/'+d).remove();
           tampilMapel(a,b,c);
            $('#j-kelas').val(b)
            $('#j-mapel').val(c)
      }
  })
}

function simpan(kode){
  var kelas_i = $('#j-kelas-i').val();
  var mapel_i = $('#j-mapel-i').val();
  var pokok_i = $('#pokok').val();
  if (pokok_i !== "") {
   var pokok =  db.ref('mapel/'+aKate+'/'+kelas_i+'/'+mapel_i);
   if (kode == undefined) {
    pokok.push(pokok_i.toUpperCase());//jika simpan
   }else{
    pokok.child(kode).set(pokok_i.toUpperCase());//jika edit
   }

   pokok.once('child_added').then(function(){
     $('.form-input-soal').trigger('reset');
     swall('BERHASIL','Pokok Pembahasan Berhasil Ditambahkan', 'success');
     tampilMapel(aKate,kelas_i,mapel_i);
      $('#j-kelas').val(kelas_i)
      $('#j-mapel').val(mapel_i)
   })
  }else{
    swall('ERROR','Pokok Pembahasan Tidak Boleh Kosong', 'error');
  }

} 

function tambahSoal(){
  $('#modaltambahLabel').text('Tambah Mata Pelajaran');
  $('.form-input-soal').trigger('reset');
  $('#j-mapel-i').attr('disabled',false);
  $('#j-kelas-i').attr('disabled',false);

  $('.btn-simpan').attr('onclick','simpan()');
}

function editMapel(a,b,c,d,e){
  $('.btn-simpan').attr('onclick','simpan(\''+d+'\')');
  $('#modaltambahLabel').text('Edit Mata Pelajaran');

  $('#j-kelas-i').val(b).attr('disabled',true);
  $('#j-mapel-i').val(c).attr('disabled',true);
  $('#pokok').val(e);

}

</script>

