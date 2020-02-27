</div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-lihat-hasil">Hasil Akhir</div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('tampilPokok')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container lihat-hasil" style="margin-top: 70px">
   		<div class="p-2 bg-primary"><i><b><span class="nilai"></span></b></i></div>
   	
	   	<div class="jumbotron" style="overflow: auto;">
	   		<h2><span class="isi"></span></h2>
	   	</div>

   		<div class="row footer-hasil" style="position: absolute; bottom: 2%; left: 10%; right: 10%;">
         
        </div>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

  <script type="text/javascript">
  	$('.nilai').text('NILAI KAMU : '+nilai);
	if (nilai >= 80) {//berhasil
		$('.isi').text('Yeah..., Kamu berhasil Mendapat Nilai Yang Memuaskan, Kamu berhak Ke Level Selanjutnya');
		$('.footer-hasil').html(`<div class="col text-center" onclick=""><button class=" btn p-4 rounded-circle btn-danger" data-toggle="modal" data-target="#modalDetail">Keterangan</button></div>
      		<div class="col text-center" onclick=""><button class="btn p-4 btn-lanjut rounded-circle btn-success" onclick=loadPage('tampilMapel')>Next</button></div>`);

		var html = '';
		$.each(fdt, function(k,v){
			html +=`<div><b>${k+1}. </b>${v.soal}</div>
    				<div><b>penjelasan : </b>${v.ket}</div>` ;	
		})
		$('.modal-body').html(html);

		if (kett == 'blm') {
			var rr = ref.child('lvl_mapel/'+aTingkat+'/'+aKelas);

			rr.once('value').then(function(snap){
				var data = snap.val()+1;
				rr.set(data);
 
				if(data >= mapelAktifLength){//jika seluruh mapel dalam kelas telah selesai
					$('.btn-lanjut').attr("onclick","loadPage('tampilKelas')").text('Next Kelas')
					ref.child('kls').once('value').then(function(snap){
						var tingkat = roman_to_Int(snap.val())+1;
						console.log(tingkat);

						var cekT = search(aTingkat, tingkatan);

						if(tingkat <= roman_to_Int(cekT[cekT.length-1])){ //belum naik tingkat
							ref.child('kls').set(romanize(tingkat));
							rr.getParent().child(romanize(tingkat)).set(0);//memulai kelas baru

						}else{//naik tingkat
							var cek = kate.indexOf(aTingkat)+1;
							if(kate[cek] != undefined ){
								var kls = search(kate[cek], tingkatan)[0]; // reset kelas
								ref.child('kls').set(kls); // reset kelas
								$('.btn-lanjut').attr("onclick","loadPage('tampilLevel')").text('Next Tingkat')
								ref.child('lvl').set( kate[cek]);//naik tingkat
							}
						}

					})
				}
			})
		}

	}else{//gagal
		$('.isi').text('Huuhh..., Nilai yang kamu dapatkan belum memenuhi standar nilai untuk kelevel berikutnya, minimal nilai yang harus kamu peroleh adalah 80, jangan lupa terus belajar yah...');
		$('.footer-hasil').html(`<button class="btn btn-danger btn-block" onclick="loadPage('mulaiJawab')">ULANGI</button>`)
	}    	
	// AdMob.showInterstitial();
   </script>