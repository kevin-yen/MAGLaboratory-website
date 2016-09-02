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
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="/assets/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Eczar:600|Raleway:400,400i" rel="stylesheet">
    <!--[if IE]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="/assets/js/jquery-2.2.4.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
  </head>
  <body></body>
</html>
