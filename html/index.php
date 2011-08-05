<!doctype html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">

  <title>FreeSmil.es ! Your one resource for free smiles, every day!</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="stylesheet" href="css/style.css?v=1">
  <link rel="stylesheet" media="handheld" href="css/handheld.css?v=1">
  <script src="js/modernizr-1.5.min.js"></script>

</head>

  <div id="container">
    <header>
    </header>
    
    <div id="main">
        <div id="image_content"></div>
    </div>
    
    <footer>
    </footer>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
  <script>!window.jQuery && document.write('<script src="js/jquery-1.4.4.min.js"><\/script>')</script>
  <script src="js/plugins.js?v=1"></script>
  <script src="js/script.js?v=1"></script>

  <!--[if lt IE 7 ]>
    <script src="js/dd_belatedpng.js?v=1"></script>
  <![endif]-->

  <script>
    currentPage = 0;
    pic = new Image();        

    function picAction() {

        // Get the new pic data 
        page = currentPage + 1; 
        currentPage = page;
        $.get('flickr.php?page='+page, function(data) {
            data = $.parseJSON(data);

            // Preload the pic 
            pic.src = data.img;

            if (checkLoaded()) {
                
                styleWidth = pic.width;
                
                if (styleWidth == 0) {
                    styleWidth = 640;
                }

                styleWidth = parseInt(styleWidth + 20);

                $(pic).addClass('img');
                // load the html
                $('#image_content').html('');
                $('#image_content').css('width', styleWidth + 'px');
                $('#image_content').append('<a id="newpic" href="'+data.img_url+'" target="_blank">');
                $('#newpic').append(pic);
                $('#image_content').append("<br />Photograph by " + data.owner_name + " - Flickr Profile <a href='"+data.owner_url+"' target='_blank'>here</a>.");
            }
        });

        setTimeout('picAction()', 7000);
    }
    
    function checkLoaded() {
        if (!pic.complete) {
            setTimeout('checkLoaded()', 500)
        }
        return true;
    }

    picAction();
  </script>

  <script>
   // var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
   // (function(d, t) {
   //  var g = d.createElement(t),
   //      s = d.getElementsByTagName(t)[0];
   //  g.async = true;
   //  g.src = '//www.google-analytics.com/ga.js';
   //  s.parentNode.insertBefore(g, s);
   // })(document, 'script');
  </script>
  
</body>
</html>