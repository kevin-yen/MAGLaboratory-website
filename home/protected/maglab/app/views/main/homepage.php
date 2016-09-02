<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if($meta_description) { ?>
      <meta <?php echo MtHaml\Runtime::renderAttributes(array(array('name', 'description'), array('content', $meta_description)), 'html5', 'UTF-8'); ?>>
    <?php } ?>
    <title><?php echo htmlspecialchars($title,ENT_QUOTES,'UTF-8'); ?></title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="/css/maglab.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Eczar:600|Raleway:400,400i|Bree+Serif" rel="stylesheet">
    <!--[if IE]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="/js/jquery-2.2.4.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </head>
  <body>
    <script type="text/javascript">
    //<![CDATA[
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      
      ga('create', 'UA-83590106-1', 'auto');
      ga('send', 'pageview');
      //'
    //]]>
    </script>
    <div id="header" class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <a href="/">
              <image <?php echo MtHaml\Runtime::renderAttributes(array(array('id', 'logo'), array('src', '/images/logo.png'), array('title', ('MAGLab Logo'))), 'html5', 'UTF-8'); ?>></image>
            </a>
          </div>
        </div>
      </div>
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button <?php echo MtHaml\Runtime::renderAttributes(array(array('class', ('navbar-toggle' . ' ' . 'collapsed')), array('type', ('button')), array('data-toggle', ('collapse')), array('data-target', ('#main-nav'))), 'html5', 'UTF-8'); ?>>
              Menu
              <span class="glyphicon glyphicon-menu-hamburger"></span>
            </button>
          </div>
          <div id="main-nav" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li>
                <a <?php echo MtHaml\Runtime::renderAttributes(array(array('href', ('/membership'))), 'html5', 'UTF-8'); ?>>Membership</a>
              </li>
              <li>
                <a <?php echo MtHaml\Runtime::renderAttributes(array(array('href', ('/wiki'))), 'html5', 'UTF-8'); ?>>Wiki</a>
              </li>
              <li>
                <a <?php echo MtHaml\Runtime::renderAttributes(array(array('href', ('https://groups.google.com/forum/?fromgroups#!forum/maglaboratory'))), 'html5', 'UTF-8'); ?>>Forum / Mailing list</a>
              </li>
              <li>
                <a <?php echo MtHaml\Runtime::renderAttributes(array(array('href', ('/hal'))), 'html5', 'UTF-8'); ?>>HAL</a>
              </li>
              <li>
                <a <?php echo MtHaml\Runtime::renderAttributes(array(array('href', ('/members/procurement'))), 'html5', 'UTF-8'); ?>>Shopping List</a>
              </li>
              <li>
                <a <?php echo MtHaml\Runtime::renderAttributes(array(array('href', ('/members'))), 'html5', 'UTF-8'); ?>>Members Dashboard</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container">
        <ul class="social-icons">
          <li>
            <a <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'sprite-mail'), array('href', ('mailto:contact@maglaboratory.org')), array('target', ('_blank'))), 'html5', 'UTF-8'); ?>></a>
          </li>
          <li>
            <a <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'sprite-facebook'), array('href', ('https://www.facebook.com/MAGLaboratory')), array('target', ('_blank'))), 'html5', 'UTF-8'); ?>></a>
          </li>
          <li>
            <a <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'sprite-twitter'), array('href', ('https://www.twitter.com/MAGLaboratory')), array('target', ('_blank'))), 'html5', 'UTF-8'); ?>></a>
          </li>
          <li>
            <a <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'sprite-instagram'), array('href', ('https://www.instagram.com/MAGLaboratory/')), array('target', ('_blank'))), 'html5', 'UTF-8'); ?>></a>
          </li>
          <li>
            <a <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'sprite-youtube'), array('href', ('https://www.youtube.com/channel/UCxkmJiwGmDQnIvLe2gDKbpg')), array('target', ('_blank'))), 'html5', 'UTF-8'); ?>></a>
          </li>
          <li>
            <a <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'sprite-yelp'), array('href', ('https://www.yelp.com/biz/mag-lab-walnut')), array('target', ('_blank'))), 'html5', 'UTF-8'); ?>></a>
          </li>
          <li>
            <a <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'sprite-github'), array('href', ('https://github.com/MAGLaboratory')), array('target', ('_blank'))), 'html5', 'UTF-8'); ?>></a>
          </li>
        </ul>
      </div>
    </div>
    <div <?php echo MtHaml\Runtime::renderAttributes(array(array('class', 'container-fluid'), array('style', ('height: 250px;'))), 'html5', 'UTF-8'); ?>>
  hello
</div>

  </body>
</html>
