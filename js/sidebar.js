function ss(name, val){ sessionStorage.setItem(name,val);}
function rs(name){ sessionStorage.removeItem(name);}
function gs(name){ return sessionStorage.getItem(name);}

function sls(name, val){localStorage.setItem(name,val);}
function rls(name){localStorage.removeItem(name);}
function gls(name){ return localStorage.getItem(name);}

function ad(classs){sBack.push(classs)}
function rm(classs){sBack.splice(sBack.indexOf(classs),1);}

function ik(classs){return sBack.indexOf(classs);}
function b4_sidebar(){
      $(".sidebarNavigation .navbar-collapse").hide().clone().appendTo("body").removeAttr("class").addClass("sideMenu").show(),
      $("body").append("<div class='overlay'></div>"),
      $(".sideMenu").addClass($(".sidebarNavigation").attr("data-sidebarClass")).prepend("<div class='container-user'><img src='' title='' class='img-user img-fluid rounded-circle'></img><p class='user'></p></div>"),
      $(".navbar-toggle, .navbar-toggler").on("click",function(){
        if(ik('sidebar') == -1){
          ad('sidebar')
          ss('kode',1);
          $('html, body').addClass('block-scroll');        
        }else{
          ss('kode',0);
          rm('sidebar');
          $('html, body').remove('block-scroll');
        }

        $('.overlay').css('background-color','rgba(0,0,0,0.4)');
        $(".sideMenu, .overlay").toggleClass("open");
      }),
      $(".overlay").on("click",function(){
        ss('kode',0);
        rm('sidebar');
         $("html, body").removeClass('block-scroll');
        $(this).removeClass("open"),
        $(".sideMenu").removeClass("open");
      }),
      $("body").on("click",".sideMenu.open .nav-item",function(){
        $(this).hasClass("dropdown")||$(".sideMenu, .overlay").toggleClass("open")
      }),
      $(window).resize(function(){
      $(".navbar-toggler").is(":hidden")?$(".sideMenu, .overlay").hide():$(".sideMenu, .overlay").show()
    })
      // alert($('body').html());
    var startX, startY;
    var lebarMenu = 288;

 $(window).on('touchstart', function (e) {
     startX =  e.touches[0].clientX;
     startY =  e.touches[0].clientY;
     var change = startX - lebarMenu; 
     if (gs('kode') != 1) {
      ss('kode',0);
      if(startX <= 30 && startY >= 66){
       $(".sideMenu").toggleClass("open").css({"left":change+'px','transition':'all ease 0s'});
      }
     }

  }); 

  $(window).on('touchmove', function (e) {
      var touch = e.touches[0];
      var change = touch.clientX - lebarMenu;
      var x = startX - touch.clientX;
      move0(change, x, touch);
      move1(change, x, touch);
  });        

  $(window).on('touchend', function (e) {
      var change = e.changedTouches[0].clientX -startX;
      var changeback = startX - e.changedTouches[0].clientX;
      if (gs('kode') == 0) {
         if (change > (lebarMenu / 2) && startX <= 30 && startY >= 66) {
           $(".sideMenu, .overlay").addClass('open').removeAttr('style');
           ss('kode',1);
           ad('sidebar');
           $('html, body').addClass('block-scroll');
           }else{
           $(".sideMenu, .overlay").removeClass('open').removeAttr('style');
           ss('kode',0);
           }
      }else if (gs('kode') == 1) {
        if (changeback > (lebarMenu / 2)) {
         $(".sideMenu, .overlay").removeClass('open').removeAttr('style');
         ss('kode',0);
         rm('sidebar');
         }else{
         $(".sideMenu, .overlay").addClass('open').removeAttr('style');
         ss('kode',1);
        }
      }  
  });

function move0(change, x, touch){
    if (startX <= 30 && startY >= 66 && gs('kode') == 0) {
        lebarMove0 = parseInt(lebarMenu-Math.abs(change));  
        if (change >= 1) {return;}
        $(".sideMenu").toggleClass("open").css({"left":change+'px','transition':'all ease 0s'});
        $(".overlay").css({'left':'0px','right':'0px','background-color':'rgba(0,0,0,0.1)'});
    }

}

function move1(change, x, touch){      
    if (gs('kode') == 1) {
        if(touch.clientX <= lebarMenu && x >= 0){
            if(startX >= lebarMenu){startX=lebarMenu;}
            var changeback = startX - touch.clientX;
            lebarMove1 = lebarMenu-Math.abs(changeback);
            $(".sideMenu").css({"left":'-'+changeback+'px','transition':'all ease 0s'});
            $(".overlay").css({'left':'0px','right':'0px','background-color':'rgba(0,0,0,0.1)'});
        }
       
    }
}
}