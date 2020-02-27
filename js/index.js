var d = new Date(), sBack=[], kodeSide=false, uid, ref, file, dataUser, nameC, keyC, refakudankamu,refkamudanaku, tingkat,kelas,mappel,nmappel,nnmappel,fdt=[],nilai=0,kett,timer,timer1,uidnya,unanya,kodespesial,mapelAktifLength=0, acm=false;

var bgc = ['btn-danger','btn-warning','btn-secondary','btn-primary','btn-success','btn-dark','','btn-light'];

var kate = ['SD','SMP','SMA'];

var mapel = [{'IPA':['biologi','kimia','fizika']},{'IPS':['sosiologi','sejarah','geografi','ekonomi','antropologi','akuntansi']},{'PENJAS':['kepelatihan keolahragaan','ilmu keolaragahan','pendidikan jasmani','pendidikan kesehatan','pendidikan rekreasi']},{'MATEMATIKA':['aljabar','analisis','geometri']},{'AGAMA':['islam','kristen','katolik','hindu','buddha','konghucu']},{'BAHASA INDONESIA':['fonologi','morfologi','sintaksis','semantik']},{'BAHASA INGGRIS':['fonologi','morfologi','sintaksis','semantik']},{'PKN':['ilmu politik']}];

var jenSo = ['B or S','Pilihan Ganda'];

var refku, refnya;
var aTingkat,aKelas,aMapel,aTingkatDuel,aKelasDuel,mappelDuel;

var tingkatan = [
	{'SD':['V','VI']},
	{'SMP':['VII','VIII','IX']},
	{'SMA':['X','XI','XII']},
];

function swall(title,text,icon){
  swal({
    title:title,
    text:text,
    icon:icon
  });
}

function alertBack2Kali(data){
  $('.b-alert-bawah').stop();
  $('.info').text(data);
  $('.b-alert-bawah').show().animate({bottom: "8%"}, "fast", "swing" , function(){
      $('.b-alert-bawah').animate({bottom: "6%"}, "fast", function(){
        $('.b-alert-bawah').delay(1500).fadeOut('fast');
      });
  });
}

function search(key, arr){
	for (var i = 0; i < arr.length; i++) {
			if (Object.keys(arr[i]) == key) {
				return Object.values(arr[i])[0];
			}
	}
}

function logDaf(){
  function showhiden(log, sign, reset){
    $('.'+reset).trigger('reset');
    $('.'+log+' span').removeClass('active').addClass('noactive');
    $('.'+sign+' span').removeClass('noactive').addClass('active');
  }

  var element = document.getElementById('swipe-log-daf');
  var pass,passv,activeDir;
  window.mySwipe = new Swipe(element, {
    startSlide:  0,
    auto: false,
    draggable: false,
    autoRestart: false,
    continuous: false,
    disableScroll: false,
    stopPropagation: false,
    callback: function(index, element, dir) {
    activeDir = dir;
     if (dir == -1) {
      showhiden('log', 'sign', 'data-login');
      $('hr').css('float', 'right');
     
      $('.data-daftar').trigger('reset');
     }else{
      $('.data-login').trigger('reset');
      $('hr').css('float', 'none');
     }
    },
    transitionEnd: function(index, element) {}
  });
  $('.log')[0].onclick = mySwipe.prev; 
  $('.sign')[0].onclick = mySwipe.next;


$('.data-daftar').submit(function(e){
	$('.loader').show();
	acm=true;
  e.preventDefault();

  var data_daftar = $(this).serializeArray();
  var user = data_daftar[0].value; 
  var umur = data_daftar[1].value; 
  var email = data_daftar[2].value; 
  var password = data_daftar[3].value; 
  var password_verify = data_daftar[4].value; 
  if (password === password_verify) {
			auth.createUserWithEmailAndPassword(email, password).then(function(snap){

					snap.user.sendEmailVerification().then(function() {

					ref  = db.ref('users/' + snap.user.uid);	

				  ref.set({
				    username: user,
				    umur: umur,
				    password: password,
				    email: email,
				    photoUrl: "../www/img/logo.png",
				    emailVerified:false,
				    uid:snap.user.uid,
				    admin:false,
				    banned:false,
				    lvl:'SD',
				    kls:'V',
				    lvl_mapel: { SD:{V:0}, SMP:{VII:0}, SMA:{X:0}},
				    friends:""
				  });

				  ref.once("child_added", function(){
							$('.alamat-email').text(email);
				  	$('.alert').removeClass('d-none');
							mySwipe.slide(0);
							$('.loader').hide();
							acm=false;
				  }, function(e){
				  	$('.loader').hide();
				  	acm=false;
				  		swall("ERROR",e.message,'error');
				  })

					}).catch(function(e) {
						$('.loader').hide();
						acm=false;
					  swall('ERROR',e.message,'error');
					});

	
	
				}).catch(function(e) {
					$('.loader').hide();
					acm=false;
			  swall('ERROR',e.message,'error');

			});
  }else{
  			$('.loader').hide();
  			acm=false;
			  swall('ERROR',"Password or Password Verify Doesn't not Math",'error');
  }

});


$('.data-login').submit(function(e){
  e.preventDefault();
  var data_login = $(this).serializeArray();
  var email = data_login[0].value;
  var password = data_login[1].value;
  login(email,password);
})

}

function login(email,password){
	 $('.loader').show();
	 acm=true;
	 auth.signInWithEmailAndPassword(email, password).then(function(snap){

	 	if (snap.user.emailVerified) {
		 	uid = snap.user.uid;
		 	ref  = db.ref('users/' + uid);	
	 		ref.update({
			    emailVerified:true,
				})

				ref.once("value", function(snap){
					$('.loader').hide();
					acm=false;
			 	sls('email', email);
			 	sls('password', password);
					if(snap.val().admin){
	  			loadPage('mainAdmin');  
					}else{
						if (!snap.val().banned) {
	  				loadPage('main');
	  				//cekonline
				    db.ref('users').on('value', function(snap) {
				      var cou = 0;
				      var users = snap.val(); 
				      $.each(users, function(key,val){
				        if (val.state == "online") {
				          cou++;
				        }
				      })

				      tampilMyFriends();
				      tampilMyDuels();
				    });//end cekonline

						}else{
							$('.loader').hide();
							acm=false;
	 						swall('ERROR','Akun anda Dibanned!','error');
						}

					}
				})


	 	}else{
	 		$('.loader').hide();
	 		acm=false;
	 		swall('ERROR','Email Not Verified!','error');
	 	}
  }).catch(function(e){
  	$('.loader').hide();
  	acm=false;
	  swall("ERROR", e.message, 'error');
		});
}

function logout(){
		if(auth.currentUser){
			auth.signOut().then(function(){
				loadPage('logdaf');
				rls('email');
				rls('user');
	 		rls('password');
	 		rls('photoUrl');
			}).catch(function(e){
				swall('ERROR',e.message,'error');
			})
		}else{
			console.log('tidak ada user');
		}
}

function sendEmail(){
		auth.currentUser.sendEmailVerification().then(function() {
			console.log('resent');
		}).catch(function(e) {
		  console.log(e.message);
		});
}

function resetPassword(){
	swal({
		title: "Input Valid Email",
  content: {
    element: "input",
    attributes: {
      placeholder: "Type your Email",
      type: "email",
    },
  },
	}).then(function(data){
		if (data != null && data != "") {

				auth.sendPasswordResetEmail(data).then(function() {
					swall('SUCCESS','Berhasil Mengirim Email','success');
				}).catch(function(error) {
					swall('ERROR','Gagal Mengirim Email','error');
				});

		}
	})
}

function tampilAkun(){
	ref.once('value', function(snap) {
		dataUser = snap.val();
		$('#user-img').attr('src', dataUser.photoUrl).attr('readonly',true);
		$('#username').val(dataUser.username).attr('readonly',true);
		$('#umur').val(dataUser.umur).attr('readonly',true);
		$('#email').val(dataUser.email).attr('readonly',true);
		$('#password').val(dataUser.password).attr('readonly',true);

		$('.level').text('LEVEL : '+dataUser.lvl+' kelas '+ dataUser.kls);
	});
}

function loadImg(id,idg){
	file = document.getElementById(id).files[0];
	var typ = file.name.split('.');
	var typEnd = typ[typ.length-1].toLowerCase();
	if (typEnd == 'png' || typEnd == 'jpg') {
		var reader = new FileReader();
		reader.readAsDataURL(file);
		reader.onloadend = function(){
			$('#'+idg).attr('src',reader.result);
		}
	}else{
		swall('ERROR','Upload Hanya File Gambar Bambang!', 'error')
		$('#'+id).val("");
		return;
	}
}

function showPass(){
	if ($('.pass').attr('type') == "password") {
		$('.pass').attr('type','text');
	}else{
		$('.pass').attr('type','password');
	}
}

function cancelEdit(){
	$('.cancel-user').hide();
	$('.edit-user').attr('onclick','editUser()').text('Edit');
	$('#photoUrl').val("").attr('disabled',true);
	tampilAkun();
}

function editUser(){
	$('.edit-user').attr('onclick','saveuser()').text('Save');
	$('#username, #password, #umur').removeAttr('readonly');
	$('#photoUrl').removeAttr('disabled');
	$('.cancel-user').show();
}

function saveuser(){
	var username = $('#username').val();
	var password = $('#password').val();
	var umur = $('#umur').val();

	if (parseInt(umur) < 6) {
		swall('ERROR','Minimal Kamu harus Berumur 6 tahun!','error');
		return;
	}
	if (username.length < 4) {
		swall('ERROR','Username terlalu pendek','error');
		return;
	}	
	if (password.length < 6) {
		swall('ERROR','Password terlalu pendek','error');
		return;
	}
	ss('umur', umur)

		if (dataUser.password != password) {
			auth.currentUser.updatePassword(password).then(function(){
				ref.update({
		 		password: password,
				})
				ref.once("child_added", function(){
					alert('Password Telah Diubah Anda Perlu login kembali !');
					rls('user')
					rls('email')
	    rls('password')
		 		location.reload();
				})

			}).catch(function(e){
				swall('ERROR',e.message,'error');
			})
		}

		// if (dataUser.username != username) {
				ref.update({
		 		username: username,
		 		umur: umur,
				})
				ref.once("child_added",function(){
					cancelEdit();
				})
		// }

	if (file != undefined) {
		
		var refS = storage.ref('imguser/'+uid+".png");
		var uploadTask = refS.put(file);

		uploadTask.on("state_changed", function(a){
		},function(e){

		},function(c){
			refS.getDownloadURL().then(function(url){
					ref.update({
	    	photoUrl: url,
					})
					ref.once("child_added",function(){
						cancelEdit();
					})
			})
		})

	}else{
		cancelEdit();
	}

}

function cariTeman(){
	var kunci =  $('#cteman').val().toLowerCase()
	if (kunci == "") {return;}

   db.ref('users').once('value', okF, errF);

  function okF(snap){
  	var html = '';
   var duser = snap.val();

   var data=[];

   var userf = duser[uid].friends;

   $.each(userf, function(k,val){
   	data.push(val.key);
   })

   var kode =0;

   	$.each(duser, function(key,val){
   	if (key != uid) {

      if (val.username.toLowerCase().indexOf(kunci) != -1) {//bukan diri sendiri
      		var disabled='';
      		var disabledText='Add';
      		if(data.indexOf(key) != -1){//jika sudah di add
      				disabled ='disabled';
      		  disabledText='Was add';
      		}
      		html+= '<div class="row mt-2 border-warning border-bottom"><div class="col-3 my-auto mx-auto"><img src="'+val.photoUrl+'" alt="" class="img-fluid rounded-circle" height="50" width="50"></div><div class="col-6 my-auto"><div class="username overtitik">'+val.username+'</div><div class="status">'+val.state+'</div></div><div class="col-3 my-auto mx-auto"><button '+disabled+' class="btn btn-sm tambahTeman'+kode+'" onclick="tambahTeman(\''+key+'\','+kode+')">'+disabledText+'</button></div></div>';
      }
      kode++;
    }
   })

   if (html == "") {
				html+= '<div class="text-center"><h2>Username Not Found!!</h2></div>';
			}

   $('.orang').html(html);


  }   //end ok


   function errF(e){
    swall("ERROR",e.message,'error');
   }
}

function tambahTeman(key,kode){
				var reff = db.ref('users/'+uid+'/friends');//yang meminta
		  var keyRef = reff.push();//dapatkan key yang meminta

		  var reff1 = db.ref('users/'+key+'/friends');//yang dituju
		  
		  var keyRef1 = reff1.push();//dapatkan key yang meminta

			 keyRef.set({//isikan nilai ke keynya | yang meminta
		    key: key,
		    state:false
		  });

		  reff.once('child_added').then(function(){

		  		keyRef1.set({//yang dituju
		    	key: uid,
		    	state:false
		  		});

		  		reff1.once('child_added').then(function(){
					  
					  var keyfer =  reff1.getParent().child('permintaan_pertemanan').push();

					  keyfer.set({
					  	 key_ku: keyRef1.key,
					  	 key_nya: keyRef.key,
					  	 name_nya: gls('user'),
					  	 photoUrl_nya: gls('photoUrl'),
					  	 keyfer: keyfer.key,
					  	 uid_pemohon: uid
					  });

		  			swall("INFORMASI","PERMINTAAN PERTEMANAN TERKIRIM !",'info');
		  		})

		  	$('.tambahTeman'+kode).attr('disabled',true);
		  }).catch(function(e){
		  	swall("ERROR",e.message,'error');
		  })				
}

function tampilPermintaanPertemanan(){
	var refPer = ref.child("permintaan_pertemanan");

 var html ='';
	refPer.once("value").then(function(snap){
		var data = snap.val();
		if (data == null) {
			html+= '<div class="text-center"><h2>Tidak Ada Permintaan Pertemanan</h2></div>';
		}
		$.each(data, function(key,val){
			html+= '<div class="row mt-2 border-warning border-bottom"><div class="col-3 my-auto mx-auto"><img src="'+val.photoUrl_nya+'" alt="" class="img-fluid rounded-circle" height="50" width="50"></div><div class="col-6 my-auto"><div class="username overtitik">'+val.name_nya+'</div></div><div class="col-3 my-auto mx-auto"><button class="btn btn-sm terimaTeman" onclick="terimahTeman(\''+val.uid_pemohon+'\',\''+val.key_nya+'\',\''+val.key_ku+'\',\''+val.keyfer+'\')">Terima</button></div></div>';
		})
		$('.inbox').html(html);

	}).catch(function(e){
			swall('ERROR',e.message,'error');
	})
}

function terimahTeman(uid_nya,key_nya,key_ku,kode){
	var refnya = db.ref('users/'+uid_nya+'/friends/'+key_nya);
	var refku = db.ref('users/'+uid+'/friends/'+key_ku);

	refnya.update({
		state:true
	})
	refnya.once("child_added").then(function(){
		refku.update({
			state:true
		})
		refku.once("child_added").then(function(){
			var refper = ref.child('permintaan_pertemanan').child(kode).remove();
					swall('SUCCESS',"Anda Sekarang berteman",'success');
					tampilPermintaanPertemanan();
		})
	})
}

function tampilMyDuels(){
	tampilMyFriends('x');	
}

function tampilMyFriends(kod){
	var reff = ref.child('friends');
	var html ='';
	var online = '';
	var offline = '';
	var listFriend=[];
	var kode=0;

	reff.once("value").then(function(snap){
		var data = snap.val();

		$.each(data, function(k,v){
			if(v.state){//jika sudah berteman
				listFriend.push(v.key);
			}
		})

		if (listFriend.length == 0) {
				html = '<div class="text-center"><h2>Kamu Belum Memiliki Teman...</h2></div>';
				if (kod == undefined) {
					$('.teman').html(html);		
				}else{
					$('.duel-teman').html(html);
				}
		}

		$.each(listFriend, function(k,v){

				var reff = ref.getParent().child(v);

				reff.once('value').then(function(snap){					
					var du =  snap.val();
					var buff = '<div class="row mt-2 border-warning border-bottom"><div class="col-3 my-auto mx-auto"><img src="'+du.photoUrl+'" alt="" class="img-fluid rounded-circle" height="50" width="50"></div><div class="col-6 my-auto"><div class="username overtitik">'+du.username+'</div><div class="status">'+du.state+'</div></div><div class="col-3 my-auto mx-auto">'
					if(kod == undefined){
						buff += '<button class="btn btn-sm chatTeman" onclick="chatTeman(\''+v+'\',\''+du.username+'\')">Chat</button>';
					}else{
							if (du.state == 'online') {
								buff += '<button class="btn btn-sm chatTeman" onclick="pilihWaktu(\''+v+'\',\''+du.username+'\',\'\')">Duel</button>';
							}
					}
					buff+='</div></div>';
	
						if (du.state == 'online') {
							online += buff;
						}else{
							offline += buff;
						}
					if(listFriend.length == k+1){//jika sudah diakhir
						if(online == ""){
							online = '<div class="text-center"><h2>Tidak Ada Online</h2></div>';
						}						
						if(offline == ""){
							offline = '<div class="text-center"><h2>Tidak Ada Ofline</h2></div>';
						}
						online = '<div class="text-center bg-primary">ONLINE</div>'+online;
						offline ='<div class="text-center bg-secondary">OFFLINE</div>'+offline;
						html = online+offline;
					  if (html == "") {
								html = '<div class="text-center"><h2>Kasi, Belum ada temanna ^.^</h2></div>';
							}
							if (kod == undefined) {
								$('.teman').html(html);		
							}else{
								$('.duel-teman').html(html);
							}
					}

				})

		}) //end ech list

	}).catch(function(e){
			swall('ERROR',e.message,'error');
	})

}


function shuffle(a) {
    var j, x, i;
    for (i = a.length-1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}

function ambilSoalAcak(snap){
		var dataPer = [];
		$.each(snap.val(), function(k,v){//kelas
					$.each(v, function(kk,vv){//mapel
							$.each(vv, function(kkk,vvv){//type soal
									dataPer.push(vvv);
							})
					})
		})
		return shuffle(dataPer);
}

function tantangAcak(deso){
	console.log(deso);
	ss('deso', deso);
	$('.bg-duel').show();
	acm=true;
	fdt=[];
	var r = db.ref('soal/'+aTingkatDuel+'/'+aKelasDuel+'/'+mappelDuel);
	r.once('value').then(function(snap){
		fdt = ambilSoalAcak(snap).slice(0,deso);

		var ducak = db.ref('duelacak/'+aTingkatDuel+'/'+mappelDuel+'/'+deso);

			ducak.once('value').then(function(snap){
				var data = snap.val();
				
				if(data == null){//jika blm ada yang mencari
					ducak.child(uid).set({
			  	menunggu: uid,
			  	menunggu_name: gls('user'),
			  	state:false
			  })

			  db.ref('duelacakmain/'+uid).set({
			  	soal:fdt,
			  	[uid]: {nama: gls('user'), poin:0, state:false}
			  })

			  timer = setTimeout(function(){
			  	clearTimeout(timer);
			  	ducak.child(uid).remove();
			  	db.ref('duelacakmain/'+uid).remove();
			  	swall('INFORMASI', 'Tidak Ada Lawan Ditemukan..','info');
			  	$('.bg-duel').hide();
			  	acm=false;
			  }, 15000);

				}else{//sudah ada yang mencari

					$.each(data, function(k,v){
						if (k != uid) {//jika bukan diri sendiri
							if(!v.state){//jika belum menemukan lawan
								uidnya = v.menunggu;

								unanya = v.menunggu_name;
								ducak.child(k).update({
									ditunggu:uid,
									ditunggu_name: gls('user'),
									state:true
								})

								db.ref('duelacakmain/'+uidnya).update({
									[uid]:{nama: gls('user'), poin:0, state:false}
								})

								db.ref('duelacakmain/'+uidnya).once('value').then(function(snap){
									var dtt = snap.val();
									fdt = dtt.soal;
								 goPage('ditunggu');
								 clearTimeout(timer);
								})

								return false;
							}
						}
					})

					timer = setTimeout(function(){
						clearTimeout(timer);
			  	swall('INFORMASI', 'Tidak Ada Lawan Ditemukan..','info');
			  	$('.bg-duel').hide();
			  	acm=false;
			  }, 15000);

				}//end cari
			})

			function goPage(kode){
				ss('acak', kode);
				acm=false;
				loadPage('goDuelAcak');
			}

			ducak.child(uid).on('value', function(snap){//untuk menunggu
				var data = snap.val();
				if(data != null){
					if(data.state){

						 uidnya = data.ditunggu//ambil uid lawan
						 unanya = data.ditunggu_name;//nama lawan
						 ducak.child(uid).remove();

								db.ref('duelacakmain/'+uid).once('value').then(function(snap){
									fdt = snap.val().soal; 
								 goPage('menunggu');
								 clearTimeout(timer);
								})
						// console.log('lawan ditemukan');
					}
				}

			})


	})

	// console.log(aTingkatDuel);
	// console.log(mappelDuel);
}

function pilihWaktu(idnya, unamenya, kode){
	$('#waktuModal').modal({backdrop: 'static', keyboard: false});
	var deso = 10;

	$('.modal-body button').each(function(){
		if (kode!= undefined) {//tantang teman
			$(this).attr('onclick', 'tantangTeman(\''+idnya+'\', \''+unamenya+'\', '+deso+')')
		}else{//tantang acak
			$(this).attr('onclick', 'tantangAcak('+deso+')');
		}
		deso +=10;
	})
}

function tantangTeman(idnya,unamenya, deso){
	ss('deso', parseInt(deso));
	$('.bg-duel').show();
	acm=true;
	uidnya = idnya;
	unanya = unamenya;
	fdt=[];
	
	var r = db.ref('soal/'+aTingkatDuel+'/'+aKelasDuel+'/'+mappelDuel);
	r.once('value').then(function(snap){

		fdt = ambilSoalAcak(snap).slice(0, deso);

		// console.log(fdt);

  var sopus = db.ref('duel/'+uid+'_'+uidnya);
  sls('bug', 'duel/'+uid+'_'+uidnya);
  sopus.set({
  	soal:fdt,
  	[uid]: {nama: gls('user'), poin:0, state:false },
  	[uidnya]: {nama: unanya, poin:0, state:false },
  })

  var re = ref.getParent().child(uidnya+'/duel');
  re.once('value').then(function(snap){
  	if(snap.val() == null){//hanya menerima satu tantangan
		 	re.set({
		 		[uid] : {
		 			at:aTingkatDuel,
		 			kls:aKelasDuel,
		 			mpl : mappelDuel,
		 			uid : uid,
		 			uidd : uidnya,
		 			deso : deso,
		 			nama: gls('user'),
		 			state: false,
		 			isi:'Teman Kamu '+gls('user')+' Menantangmu!'
		 		}
		 	})

		 	re.once('child_added').then(function(){
			  	var link  = db.ref(`users/${uidnya}/duel/${uid}`);
			 	var koda = true;
			 	timer = setTimeout(function(){

			  	link.once('value').then(function(snap){
				  		koda=false;
				  		link.remove();
				  		sopus.remove();
				  		$('.bg-duel').hide();
				  		acm=false;
			  		if(snap.val() != null){
				  		if(!snap.val().state){//tidak merespon
				  			swall('INFORMASI','teman tidak merespon!','info');
				  			fdt=[];
				  			clearTimeout(timer);
				  		}
			  		}
			  	})
		  	}, 10000);

			 	db.ref(`users/${uidnya}`).on('child_removed', function(snap){
			 		clearTimeout(timer);
			 		$('.bg-duel').hide();
			 		acm=false;
			 		if(koda){
			 			koda = false;
			 			loadPage('goDuel');
			 		}
			 	})
			 	
		 	})

  	}else{
  		$('.bg-duel').hide();
  		acm=false;
  		swall('INFORMATION','Teman Sedang Sibuk','info')
  	}
  })

	})	
}

function chatTeman(key,name){
		ss('user-chat-key',key);
		ss('user-chat-name',name);
		loadPage('chat');
}

function tampilChat(){
	nameC = gs('user-chat-name');
	keyC = gs('user-chat-key');

	$('.label-chat').text(nameC);

	refakudankamu = db.ref('messages/'+uid+"_"+keyC);
	refkamudanaku = db.ref('messages/'+keyC+"_"+uid);


 refakudankamu.on('value', function(snap){//user 1
 	$('.isi-chat').val('');
 	var data = snap.val();
 	var html = '';
 	if(data != null){
 		ss('uAktif', "user1");
 		$.each(data, function(k,v){
 			if (v.uid == uid) {
 				html += '<div class="text-right p-1"><span class="rounded pl-2 pr-2 bg-primary"><b>'+v.isi+'</b></span></div>';
 			}else{
 				html += '<div class="text-left p-1"><span class="rounded pl-2 pr-2 bg-success"><b>'+v.isi+'</b></span></div>';
 			}
 		})
 		if (html != "") {
 			$('.chat').html(html);
 		}
 	}
	})

	refkamudanaku.on('value', function(snap){//user2
		var html = '';
 	var data = snap.val();
 	if (data!=null) {
 		ss('uAktif', "user2");
 		$.each(data, function(k,v){
 			if (v.uid == uid) {
 				html += '<div class="text-right p-1"><span class="rounded pl-2 pr-2 bg-primary"><b>'+v.isi+'</b></span></div>';
 			}else{
 				html += '<div class="text-left p-1"><span class="rounded pl-2 pr-2 bg-success"><b>'+v.isi+'</b></span></div>';
 			}
 		})
 		if(html != ""){
 			$('.chat').html(html);
 		}
 	}
	})

}

function sendPesan(){
	var isi = $('.isi-chat').val();
	if(isi == ""){
		return;
	}else{
		if (gs('uAktif') == "user1") {
				refakudankamu.push({
				isi:isi,
				uid:uid
			})
		}else{
			refkamudanaku.push({
				isi:isi,
				uid:uid
			})
		}
	}
}



//admin
function tampilUserAll(){
		$('.body-user-all').html('<h1>LOADING..</h1>');
	ref.getParent().on("value", function(snap){
		var data = snap.val();
		var htmlUser='';
		var no =1;
		$.each(data, function(k,v){
				var checked = '';
			if(v.banned){
				checked = 'checked';
			}
			htmlUser += '<tr><td scope="row">'+no+'</td><td scope="row"><input type="checkbox" onclick="bann(\''+checked+'\',\''+v.uid+'\')" class="" '+checked+'></td><td>'+v.username+'</td><td>'+v.email+'</td><td>'+v.emailVerified+'</td><td>'+v.password+'</td><td>'+v.state+'</td><td>'+v.uid+'</td><td>'+v.last_changed+'</td></tr>';
			no++;
		})
		$('.jml-user').text("Total User : "+(no-1));
		$('.body-user-all').html(htmlUser);
	})
}

function bann(stat, ui){
	var refu = ref.getParent().child(ui);
	var bann = false;
	if(stat == ""){
			bann = true;
	}
	refu.update({
		banned:bann
	})

	refu.once("value").then(function(snap){
		snap.val().banned?swall('INFORMATION', 'User Telah Dibanned','info'):swall('INFORMATION', 'User Telah Dipulihkan','info');
	})

}

function cekModal(){
 $('#modalDetail, #modaltambah, #waktuModal').on('show.bs.modal', function(event){
  ad('tampil-modal')
 }) 
 $('#modalDetail, #modaltambah, #waktuModal').on('hide.bs.modal', function(event){
  rm('tampil-modal')
 })
}



function tampilSoal(kategori, kls,mapel,pk, jeso){
	// console.log('tes');
	var link = "soal/"+kategori+'/'+kls+'/'+mapel+'/'+pk+'/'+jeso;
	// console.log(link);
	var refSoal =	db.ref(link);
	$('#soal-all').html('<h1>LOAD SOAL....</h1>');
	refSoal.on('value', function(snap){
		var data = snap.val();
		var html=`<table class="table table-sm" id="dataTable"><thead class="thead-dark">
      <tr>`;
  var no =1;
		if (data != null) {
			$.each(data, function(k,v){
				if(no==1){//untuk judul
							html += '<th scope="col">NO</th>';
					$.each(Object.keys(v), function(i,m){
							html += '<th scope="col">'+m.toUpperCase()+'</th>';
					})
							html += '<th scope="col">ACTION</th>';
					  html+=`</tr>
			    </thead>
			    <tbody class="body-soal">`;
				}
				if(jeso == 'B or S'){
					html += '<tr><th scope="row">'+no+'</th><td scope="row">'+v.jeso+'</td><td>'+v.kelas+'</td><td>'+v.ket+'</td><td>'+v.mapel+'</td><td>'+v.pointidak+'</td><td>'+v.poinya+'</td><td>'+v.pokok+'</td><td>'+v.soal+'</td><td>'+v.tingkat+'</td><td><button class="btn btn-secondary" onclick="hpsSoal(\''+k+'\',\''+link+'\')">Hps</button><button class="btn btn-success" data-toggle="modal" data-target="#modaltambah" onclick="editSoal(\''+k+'\',\''+v.jeso+'\',\''+v.kelas+'\',\''+v.tingkat+'\',\''+v.ket+'\',\''+v.mapel+'\',\''+v.soal+'\',\''+v.pokok+'\',\''+v.pointidak+'\',\''+v.poinya+'\')">Edit</button></td></tr>'
				}else{
					html += '<tr><th scope="row">'+no+'</th><td scope="row">'+v.gambar+'</td><td>'+v.jawabana+'</td><td>'+v.jawabanb+'</td><td>'+v.jawabanc+'</td><td>'+v.jawaband+'</td><td>'+v.jeso+'</td><td>'+v.kelas+'</td><td>'+v.ket+'</td><td>'+v.mapel+'</td><td>'+v.poinjawabana+'</td><td>'+v.poinjawabanb+'</td><td>'+v.poinjawabanc+'</td><td>'+v.poinjawaband+'</td><td>'+v.pokok+'</td><td>'+v.soal+'</td><td>'+v.tingkat+'</td><td><button class="btn btn-secondary" onclick="hpsSoal(\''+k+'\',\''+link+'\')">Hps</button><button class="btn btn-success" data-toggle="modal" data-target="#modaltambah" onclick="editSoal(\''+k+'\',\''+v.jeso+'\',\''+v.kelas+'\',\''+v.tingkat+'\',\''+v.ket+'\',\''+v.mapel+'\',\''+v.soal+'\',\''+v.pokok+'\',\''+v.jawabana+'\',\''+v.jawabanb+'\',\''+v.jawabanc+'\',\''+v.jawaband+'\',\''+v.poinjawabana+'\',\''+v.poinjawabanb+'\',\''+v.poinjawabanc+'\',\''+v.poinjawaband+'\',\''+v.gambar+'\')">Edit</button></td></tr>'
				}
				no++;
			})

   html += `</tbody>
    </table>`;
    			// console.log('aa');
			$('#soal-all').html(html);
			$('#dataTable').DataTable();
		}else{
			$('#soal-all').html('<h1 class="blm-ada-soal">Belum Ada Soal !</h1>');
		}
	})

}

function editSoal(key,jeso,kelas,tingkat,ket,mapel,soal,pkok,ja,jb,jc,jd,pa,pb,pc,pd,gambar){
	$('.btn-simpan').attr('onclick','simpan(\''+key+'\')');
	$('#modaltambahLabel').text('Edit Soal');
	setPokok1(mapel);

	$('#j-kelas-i').val(kls).attr('disabled',true);
	$('#j-mapel-i').val(mpl).attr('disabled',true);
	$('#j-pokok-i').val(pkok).attr('disabled',true);
	$('#j-soal-i').val(jenis).attr('disabled',true);

	$('#isi-soal').val(soal);
	$('#isi-ket').val(ket);
	if (jeso == 'B or S') {
		$('.pilgan').hide();		
		$('.ya-tidak').show();

		$('#poin-tidak').val(ja);
		$('#poin-ya').val(jb);
	}else{

		$('#soal-img').attr('src',gambar);
		$('#poin-jawaban-a').val(pa)
		$('#poin-jawaban-b').val(pb)
		$('#poin-jawaban-c').val(pc)
		$('#poin-jawaban-d').val(pd)
		$('#jawaban-a').val(ja)
		$('#jawaban-b').val(jb)
		$('#jawaban-c').val(jc)
		$('#jawaban-d').val(jd)
		$('.ya-tidak').hide();
		$('.pilgan').show();
	}
}


function hpsSoal(key,link){

  swal({
    title:'WARNING',
    text:'Yakin Ingin Menghapus Soal?',
    icon:'warning',
    buttons: true
  }).then(function(e){
  		if(e){
					db.ref(link+"/"+key).remove();
					storage.ref(link+"/"+key+'.png').delete().then(function(){
						swall('SUCCESS', 'Soal Berhasil Dihapus', 'success');
					})
  		}
  })

}

//end admin

function roman_to_Int(str1) {
	if(str1 == null) return -1;
	var num = char_to_int(str1.charAt(0));
	var pre, curr;

	for(var i = 1; i < str1.length; i++){
	curr = char_to_int(str1.charAt(i));
	pre = char_to_int(str1.charAt(i-1));
	if(curr <= pre){
	num += curr;
	} else {
	num = num - pre*2 + curr;
	}
	}

	return num;
}

function char_to_int(c){
	switch (c){
	case 'I': return 1;
	case 'V': return 5;
	case 'X': return 10;
	case 'L': return 50;
	case 'C': return 100;
	case 'D': return 500;
	case 'M': return 1000;
	default: return -1;
	}
}

function romanize(num) {
  var lookup = {M:1000,CM:900,D:500,CD:400,C:100,XC:90,L:50,XL:40,X:10,IX:9,V:5,IV:4,I:1},roman = '',i;
  for ( i in lookup ) {
    while ( num >= lookup[i] ) {
      roman += i;
      num -= lookup[i];
    }
  }
  return roman;
}
function swallBatal(title,text,icon){
  swal({
    title:title,
    text:text,
    icon:icon,
    buttons:true
  }).then(function(e){
  	if (e) {
  		window.location.reload();
  	}
  })
}

// function loadPage(page, kode){
// 	if (acm) {
// 		swallBatal('INFORMASI','Server sedang Sibuk, klik ok untuk kembali ke menu utama?','warning');
// 		return;
// 	}else{
// 		$.get('http://localhost:80/wahyu/'+page+".php", function(data){
// 	 	if (kode == undefined) {
// 	  	$('body').html(data);
// 	 	}else{
// 	 	 ss('kategori', kode);
// 	  	$('.main-all').html(data);
// 	 	}
// 	 })
// 	}
// }

function loadPage(page, kode){
	if (acm) {
		swallBatal('INFORMASI','Server sedang Sibuk, klik ok untuk kembali ke menu utama?','warning');
		return;
	}else{

	 $.get('assets/'+page+".php", function(data){
			if(ik('sidebar') != -1){
	    ss('kode',0);
	    rm('sidebar');
	    $(".overlay, .sideMenu").removeClass("open");
	    $('html, body').remove('block-scroll');
	  }
	 	if (kode == undefined) {
	 		if(page != 'main' && page != 'mainAdmin' &&  page != 'logdaf'){
	 			if (ik('page') == -1) {
	 				ad('page');
	 			}
	 		}else{
	 			if (ik('page') != -1) {
	 				rm('page');
	 			}
	 		}
	  	$('body').html(data);
	 	}else{
	 		ss('kategori', kode);
	  	$('.main-all').html(data);
	 	}
	 })
	}
}

document.addEventListener('deviceready', function() {
 var exitApp = false; 
 document.addEventListener("backbutton", function (e){
 	// alert();
  e.preventDefault();
  var intval = setTimeout(function(){exitApp = false;}, 2000);
  if (exitApp) {
   clearTimeout(intval) 
   (navigator.app && navigator.app.exitApp()) || (device && device.exitApp())
  }else{
  	// alert(sBack);
   if(sBack.length == 0){
     exitApp = true;
     alertBack2Kali('Tekan lagi untuk keluar !');     
   }else{
     for(var i=sBack.length-1; i>=0; i--){
     	if (sBack[i] == 'page') {
     		$('.btn-back').click();
     	}

      if(sBack[i] == 'tampil-modal'){
       $('#modalDetail, #modaltambah, #waktuModal').modal('hide');
       break;
      }      

      if (sBack[i]=='sidebar'){
       $(".sideMenu, .overlay").removeClass('open').removeAttr('style');
       ss('kode', 0);
       rm(sBack[i]);
       break;
      }
     }//end for
   
   } //end if sback
  } //en if exit app
 }, false);
}, false);