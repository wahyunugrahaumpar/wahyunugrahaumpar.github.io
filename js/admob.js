var admobid = {
    banner: 'ca-app-pub-2010417376945164/4717539596',
    interstitial: 'ca-app-pub-2010417376945164/3404457929',
    rewardvideo: 'ca-app-pub-2010417376945164/9778294582',
}

function showBanner(){
  AdMob.createBanner({
    adId: admobid.banner,
    size:'BANNER',
    position: AdMob.AD_POSITION.BOTTOM_CENTER,
    overlap: false,
    offsetTopBar: false,
    // isTesting: true,
    autoShow: true,
    bgColor: 'white'
  });
}

function setInt(){
    AdMob.prepareInterstitial({
      adId: admobid.interstitial,
      // isTesting: true,
      autoShow: false
    });  
}


