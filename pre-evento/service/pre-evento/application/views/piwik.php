<?php switch (ENVIRONMENT) {
      case 'local':
          ?>
              <!-- Piwik -->
              <script type="text/javascript">
                var _paq = _paq || [];
                //_paq.push(['trackPageView']);
                _paq.push(['enableLinkTracking']);
                (function() {
                  var u="//ceet.piwikpro.com/";
                  _paq.push(['setTrackerUrl', u+'piwik.php']);
                  _paq.push(['setSiteId', 40]);
                  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                  g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
                })();
              </script>
              <noscript><p><img src="//ceet.piwikpro.com/piwik.php?idsite=40" style="border:0;" alt="" /></p></noscript>
              <!-- End Piwik Code -->


          <?php
      break;
      case 'development':
         ?>
             <!-- Piwik -->
            <script type="text/javascript">
              var _paq = _paq || [];
              //_paq.push(['trackPageView']);
              _paq.push(['enableLinkTracking']);
              (function() {
                var u="//ceet.piwikpro.com/";
                _paq.push(['setTrackerUrl', u+'piwik.php']);
                _paq.push(['setSiteId', 42]);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
              })();
            </script>
            <noscript><p><img src="//ceet.piwikpro.com/piwik.php?idsite=42" style="border:0;" alt="" /></p></noscript>
            <!-- End Piwik Code -->


         <?php
      break;
      case 'testing':
          ?>
              <!-- Piwik -->
              <script type="text/javascript">
                var _paq = _paq || [];
                //_paq.push(['trackPageView']);
                _paq.push(['enableLinkTracking']);
                (function() {
                  var u="//ceet.piwikpro.com/";
                  _paq.push(['setTrackerUrl', u+'piwik.php']);
                  _paq.push(['setSiteId', 44]);
                  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                  g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
                })();
              </script>
              <noscript><p><img src="//ceet.piwikpro.com/piwik.php?idsite=44" style="border:0;" alt="" /></p></noscript>
              <!-- End Piwik Code -->

         <?php
      break;
      case 'origin':
          ?>
              <!-- Piwik -->
              <script type="text/javascript">
                var _paq = _paq || [];
                _paq.push(['trackPageView']);
                _paq.push(['enableLinkTracking']);
                (function() {
                  var u="//ceet.piwikpro.com/";
                  _paq.push(['setTrackerUrl', u+'piwik.php']);
                  _paq.push(['setSiteId', 46]);
                  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                  g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
                })();
              </script>
              <noscript><p><img src="//ceet.piwikpro.com/piwik.php?idsite=46" style="border:0;" alt="" /></p></noscript>
              <!-- End Piwik Code -->


         <?php
      break;
      case 'production':
      ?>
          <!-- Piwik -->
          <script type="text/javascript">
            var _paq = _paq || [];
            //_paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
              var u="//ceet.piwikpro.com/";
              _paq.push(['setTrackerUrl', u+'piwik.php']);
              _paq.push(['setSiteId', 38]);
              var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
              g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
            })();
          </script>
          <noscript><p><img src="//ceet.piwikpro.com/piwik.php?idsite=38" style="border:0;" alt="" /></p></noscript>
          <!-- End Piwik Code -->

      <?php 
      break;
  } ?>