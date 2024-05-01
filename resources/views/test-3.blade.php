<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Video.js Resolution Switcher</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/videojs-resolution-switcher-vjs7@1.0.0/videojs-resolution-switcher.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-ads/6.9.0/videojs.ads.css" integrity="sha512-0gIqgiX1dWTChdWUl8XGIBDFvLo7aTvmd6FAhJjzWx5bzYsCJTiPJLKqLF3q31IN4Kfrc0NbTO+EthoT6O0olQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-ads/6.9.0/videojs-contrib-ads.css" integrity="sha512-0gIqgiX1dWTChdWUl8XGIBDFvLo7aTvmd6FAhJjzWx5bzYsCJTiPJLKqLF3q31IN4Kfrc0NbTO+EthoT6O0olQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/videojs-seek-buttons/dist/videojs-seek-buttons.css">
  
</head>
<body>

 <video
    id="video"
    class="video-js w-full rounded vjs-theme-fantasyX vjs-big-play-centered"
    controls
    preload="auto"
    data-setup="{}"
  ></video>

  <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/videojs-seek-buttons/dist/videojs-seek-buttons.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/videojs-resolution-switcher-vjs7@1.0.0/videojs-resolution-switcher.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-ads/6.9.0/videojs.ads.min.js" integrity="sha512-ff4Rc39SC+LyUOUEKUvQ5VW/BMtzy+p3/zN+zB/VloiEfFpkY4JseoJC2TtwJTnn2PrSsm+dvSW6S4yV6uADUA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-ads/6.9.0/videojs-contrib-ads.js" integrity="sha512-XjyyAijQGlXZET35toG8igvVs8HvfVgKXGnbfAs2EpZ0o8vjJoIrxL9RBBQbQjzAODIe0jvWelFfZOA3Z/vdWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  videojs('video', {
    controls: true,
    muted: true,
    width: 1000,
    plugins: {
        videoJsResolutionSwitcher: {
          default: 'high',
          dynamicLabel: false
        }
      }
  }, function(){
    
    var player = this;
    window.player = player

    player.ads(); // initialize videojs-contrib-ads
    // your custom ad plugin code
    // request ads whenever there's new video content
    player.on('contentchanged', function() {
      // in a real plugin, you might fetch new ad inventory here
      player.trigger('adsready');
    });

    player.on('readyforpreroll', function() {
      player.ads.startLinearAdMode();
      // play your linear ad content
      // in this example, we use a static mp4
      player.src('ocean.mp4');

      // send event when ad is playing to remove loading spinner
      player.one('adplaying', function() {
        player.trigger('ads-ad-started');
      });

      // resume content when all your linear ads have finished
      player.one('adended', function() {
        player.ads.endLinearAdMode();
      });
    });
    // in a real plugin, you might fetch ad inventory here
    player.trigger('adsready');
    
    
    player.seekButtons({
        forward: 10,
        back: 10
      });
    // Add dynamically sources via updateSrc method
    player.updateSrc([
        {
          src: 'https://vjs.zencdn.net/v/oceans.mp4?sd',
          type: 'video/mp4',
          label: 'SD',
          res: 360
        },
        {
          src: 'https://vjs.zencdn.net/v/oceans.mp4?hd',
          type: 'video/mp4',
          label: 'HD',
          res: 720
        }
      ])

      player.on('resolutionchange', function(){
        player.play();
        console.info('Source changed to %s', player.src())
      })
      
  })
</script>
  
  
</body>
</html>