<!DOCTYPE html>
<html  ng-app="applicationModule">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="all,follow">
        <meta name="googlebot" content="index,follow,snippet,archive">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog</title>

        <meta name="keywords" content="">

       <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800' rel='stylesheet' type='text/css'> -->

        <!-- Bootstrap and Font Awesome css -->
        <link href="/app/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="/app/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <!-- Css animations  -->
        <link href="/app/assets/css/animate.css" rel="stylesheet" type="text/css"/>

        <!-- Theme stylesheet, if possible do not edit this stylesheet -->
        <link href="/app/assets/css/style.default.css" rel="stylesheet" d="theme-stylesheet">

        <!-- Custom stylesheet - for your changes -->
        <link href="/app/assets/css/custom.css" rel="stylesheet" type="text/css"/>

        <!-- Block ui style -->
        <link href="/css/angular-block-ui.min.css" rel="stylesheet" type="text/css"/>

        <!-- toastr stylesheet-->
        <link href="/css/toastr.css" rel="stylesheet" />

        <!-- SyntaxHighlighter stylesheet-->
        <link href="/css/syntaxhighlighter/shCore.css" rel="stylesheet" type="text/css"/>
        <link href="/css/syntaxhighlighter/shThemeDefault.css" rel="stylesheet" type="text/css"/>
        

        <!-- Responsivity for older IE -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

        <!-- Favicon and apple touch icons-->

        <link rel="shortcut icon" href="/app/assets/img/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="/app/assets/img/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="/app/assets/img/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/app/assets/img/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="/app/assets/img/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/app/assets/img/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="/app/assets/img/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="/app/assets/img/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="/app/assets/img/apple-touch-icon-152x152.png" />

        <!-- Library Scripts -->

        <!-- jquery JavaScript -->
        <script src="/js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <script src="/app/assets/js/jquery.cookie.js" type="text/javascript"></script>
        <script src="/app/assets/js/respond.min.js" type="text/javascript"></script>
        <script src="/app/assets/js/waypoints.min.js" type="text/javascript"></script>
        <script src="/app/assets/js/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="/app/assets/js/jquery.parallax-1.1.3.js" type="text/javascript"></script>
        <!-- bootstrap -->
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- front -->
        <script src="/app/assets/js/front.js" type="text/javascript"></script>
        <!-- Angular Core JavaScript -->
        <script src="/js/angular.min.js" type="text/javascript"></script>
        <script src="/js/angular-resource.min.js" type="text/javascript"></script>
        <script src="/js/angular-route.min.js" type="text/javascript"></script>
        <script src="/js/angular-ui-router.js" type="text/javascript"></script>
        <script src="/js/angular-route.min.js" type="text/javascript"></script>
        <script src="/js/angular-sanitize.min.js" type="text/javascript"></script>
        <script src="/js/angular-locale_es-pe.js" type="text/javascript"></script>
        <script src="/js/angular-ui/ui-bootstrap-tpls.min.js" type="text/javascript"></script>
        <script src="/js/angular-block-ui.min.js" type="text/javascript"></script>
        <script src="/js/angular-messages.min.js" type="text/javascript"></script> 
        <script src="/js/angular-animate.min.js" type="text/javascript"></script>
   
        <!-- angular-google-maps -->
        <script src="/js/angular-simple-logger.js"></script>
        <script src="/js/lodash.js"></script>
        <script src="/js/angular-google-maps.js"></script>

        <!-- Application Script-->
        <script src="/app/app.config.js"></script>

        <!-- toastr Script-->
        <script src="/js/toastr.min.js"></script>

        <!-- Home -->
        <script src="/app/components/home/homeController.js"></script>
        <!-- Personal Informnation -->
        <script src="/app/components/personalInformation/personalInformationRepository.js" type="text/javascript"></script>
        <!-- Tag -->
        <script src="/app/components/tag/tagRepository.js"></script>
        <!-- blogEntries -->
        <script src="/app/components/blogEntries/blogEntriesRepository.js"></script>
        <script src="/app/components/blogEntries/blogEntriesController.js"></script>
        <!-- navigationUrl -->
        <script src="/app/components/navigationUrl/navigationUrlRepository.js"></script>
        <!-- about -->
        <script src="/app/components/about/aboutController.js" type="text/javascript"></script>
        <!-- contact -->
        <script src="/app/components/contact/contactController.js" type="text/javascript"></script>

        <!-- Services-->
        <script src="/app/shared/services/helperService.js"></script>
        <!-- Filter-->
        <script src="/app/shared/filter/filter.js"></script>
        <!-- Directives-->
        <script src="/app/shared/directives/common/commonDirective.js"></script>
        <script src="/app/shared/directives/inputs/inputTextEdit.js"></script>
        <!-- Footer -->
        <script src="/app/shared/directives/footer/footer.js"></script>
        <!-- Header -->
        <script src="/app/shared/directives/header/header.js"></script>
        <!-- SideBar -->
        <script src="/app/shared/directives/sideBar/sideBar.js"></script>
        <!-- Common -->

         <!-- SyntaxHighlighter js-->
        <script src="/js/syntaxhighlighter/shCore.js" type="text/javascript"></script>
        <script src="/js/syntaxhighlighter/shAutoloader.js" type="text/javascript"></script>
        <script src="/js/syntaxhighlighter/shBrushPhp.js" type="text/javascript"></script>
        <script src="/js/syntaxhighlighter/shBrushCSharp.js" type="text/javascript"></script>
        <script src="/js/syntaxhighlighter/shBrushCss.js" type="text/javascript"></script>
        <script src="/js/syntaxhighlighter/shBrushJScript.js" type="text/javascript"></script>
        <script src="/js/syntaxhighlighter/shBrushJava.js" type="text/javascript"></script>
        <script src="/js/syntaxhighlighter/shBrushPython.js" type="text/javascript"></script>
        <script src="/js/syntaxhighlighter/shBrushSql.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="all">
            <div header></div>
            <div id="content">
                <div class="container">
                    <div class="row">

                        <!-- *** LEFT COLUMN ***
                             _________________________________________________________ -->

                        <div ui-view></div>

                        <!-- /.col-md-9 -->

                        <!-- *** LEFT COLUMN END *** -->

                        <!-- *** RIGHT COLUMN ***
                                                 _________________________________________________________ -->

                        <div sidebar class="col-md-3" ></div>
                        <!-- /.col-md-3 -->

                        <!-- *** RIGHT COLUMN END *** -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->

            </div>
            <!-- /#content -->

            <div footer></div>
        </div>
        <!-- /#all -->

         <script type="text/javascript">
            SyntaxHighlighter.config.bloggerMode = true;
            SyntaxHighlighter.defaults['toolbar'] = false;
            SyntaxHighlighter.all();
         </script>
    </body>
</html>