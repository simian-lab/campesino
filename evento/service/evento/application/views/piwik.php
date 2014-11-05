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
                  _paq.push(['setSiteId', 32]);
                  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                  g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
                })();
              </script>
              <noscript><p><img src="//ceet.piwikpro.com/piwik.php?idsite=32" style="border:0;" alt="" /></p></noscript>
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
                  _paq.push(['setSiteId', 34]);
                  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                  g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
                })();
              </script>
              <noscript><p><img src="//ceet.piwikpro.com/piwik.php?idsite=34" style="border:0;" alt="" /></p></noscript>
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
                  _paq.push(['setSiteId', 36]);
                  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                  g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
                })();
              </script>
              <noscript><p><img src="//ceet.piwikpro.com/piwik.php?idsite=36" style="border:0;" alt="" /></p></noscript>
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
                  _paq.push(['setSiteId', 48]);
                  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                  g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
                })();
              </script>
              <noscript><p><img src="//ceet.piwikpro.com/piwik.php?idsite=48" style="border:0;" alt="" /></p></noscript>
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