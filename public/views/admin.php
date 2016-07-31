<!DOCTYPE html>
<html lang="en" ng-app="applicationAdminModule">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Blog Admin</title>

        <!-- Style sheets -->

        <!-- Bootstrap Core CSS -->
        <link href="/appAdmin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- MetisMenu CSS -->
        <link href="/appAdmin/assets/css/metisMenu.css" rel="stylesheet" type="text/css"/>  
        <!-- Custom CSS -->
        <link href="/appAdmin/assets/css/sb-admin-2.css" rel="stylesheet" type="text/css"/>
        <!-- Custom Fonts -->
        <link href="/appAdmin/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Alerts  -->
        <link href="/css/toastr.min.css" rel="stylesheet" type="text/css"/>
        <!-- Block UI -->
        <link href="/css/angular-block-ui.min.css" rel="stylesheet" type="text/css"/>
        <!-- HTM editor -->
        <link href="/appAdmin/assets/css/textAngular.css" rel="stylesheet" type="text/css"/>
        <!-- LightBox -->
        <link href="/css/angular-bootstrap-lightbox.min.css" rel="stylesheet" type="text/css"/>
        <!-- Grid -->
        <link href="/appAdmin/assets/css/ng-grid.min.css" rel="stylesheet" type="text/css"/>
        <!-- ng-tags -->
        <link href="/appAdmin/assets/css/ng-tags-input.min.css" rel="stylesheet" type="text/css"/>
        <!-- autocomplete -->
        <link href="/appAdmin/assets/css/angucomplete-alt.css" rel="stylesheet" type="text/css"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Library Scripts -->

        <!-- jquery JavaScript -->
        <script src="/js/jquery-2.2.1.min.js" type="text/javascript"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Angular Core JavaScript -->
        <script src="/js/angular.min.js" type="text/javascript"></script>
        <script src="/js/angular-route.min.js" type="text/javascript"></script>
        <script src="/js/angular-ui-router.js" type="text/javascript"></script>
        <script src="/js/angular-route.min.js" type="text/javascript"></script>
        <script src="/js/angular-resource.min.js" type="text/javascript"></script>
        <script src="/js/angular-sanitize.min.js" type="text/javascript"></script>
        <script src="/js/angular-locale_es-pe.js" type="text/javascript"></script>
        <script src="/js/angular-ui/ui-bootstrap-tpls.min.js" type="text/javascript"></script>
        <script src="/js/angular-block-ui.min.js" type="text/javascript"></script>
        <script src="/js/angular-messages.min.js" type="text/javascript"></script> 
        <script src="/js/angular-animate.min.js" type="text/javascript"></script>
        <!-- LightBox JavaScript-->
        <script src="/js/angular-bootstrap-lightbox.min.js" type="text/javascript"></script>
        <!-- Format local-->
<!--        <script src="/js/angular-locale_es-pe.js" type="text/javascript"></script>-->
        <!-- Alerts JavaScript-->
        <script src="/js/toastr.min.js" type="text/javascript"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="/appAdmin/assets/js/metisMenu.js" type="text/javascript"></script>
        <!-- Custom Theme JavaScript -->
        <script src="/appAdmin/assets/js/sb-admin-2.js" type="text/javascript"></script>   
        <!-- Mask TextBox Validator JavaScript -->
        <script src="/appAdmin/assets/js/fcsaNumber.js" type="text/javascript"></script>
        <script src="/appAdmin/assets/js/mask.js" type="text/javascript"></script>  
        <!-- Account JavaScript -->
        <script src="/appAdmin/assets/js/satellizer.js" type="text/javascript"></script>
        <script src="/appAdmin/assets/js/angular-permission.js" type="text/javascript"></script>
        <!-- Ng-Grid JavaScript -->
        <script src="/appAdmin/assets/js/ng-grid.min.js" type="text/javascript"></script>
        <!-- textAngular -->
        <script src="/appAdmin/assets/js/textAngular-rangy.min.js" type="text/javascript"></script>
        <script src="/appAdmin/assets/js/textAngular-sanitize.min.js" type="text/javascript"></script>
        <script src="/appAdmin/assets/js/textAngular.min.js" type="text/javascript"></script>
        <script src="/appAdmin/assets/js/textAngularSetup.js" type="text/javascript"></script>
        <!-- ng-tag -->
        <script src="/appAdmin/assets/js/ng-tags-input.min.js" type="text/javascript"></script>
        <!-- autocomplete -->
        <script src="/appAdmin/assets/js/angucomplete-alt.js" type="text/javascript"></script>
        
        <!-- Angular Modules Script-->
        <script src="/appAdmin/appAdmin.config.js" type="text/javascript"></script>
        <!-- Angular Services-->
        <script src="/appAdmin/shared/services/helperService.js" type="text/javascript"></script>
        <script src="/appAdmin/shared/services/authManager.js" type="text/javascript"></script>
        <!-- Directives-->
        <script src="/appAdmin/shared/directives/validation.js" type="text/javascript"></script>
        <script src="/appAdmin/shared/directives/frame/frame.js" type="text/javascript"></script>
        <script src="/appAdmin/shared/directives/inputs/inputTextEdit.js" type="text/javascript"></script>
       
        <!-- filter-->
        <script src="/appAdmin/shared/filter/filter.js" type="text/javascript"></script>
        
        <!-- Common-->
        <script src="/appAdmin/components/common/commonRepository.js" type="text/javascript"></script>
        <!-- Account-->
        <script src="/appAdmin/components/account/accountController.js" type="text/javascript"></script>
        <script src="/appAdmin/components/account/accountResetPasswordController.js" type="text/javascript"></script>
        <script src="/appAdmin/components/account/accountRepository.js" type="text/javascript"></script>

        <!-- Home -->
        <script src="/appAdmin/components/home/homeRepository.js" type="text/javascript"></script>
        <script src="/appAdmin/components/home/homeController.js" type="text/javascript"></script>

        <!-- Blog Entries -->
        <script src="/appAdmin/components/blogEntries/blogEntriesEditController.js"></script>
        <script src="/appAdmin/components/blogEntries/blogEntriesListController.js"></script>
        <script src="/appAdmin/components/blogEntries/blogEntriesDetailController.js"></script>
        <script src="/appAdmin/components/blogEntries/blogEntriesRepository.js"></script>
        <script src="/appAdmin/components/blogEntries/blogEntriesService.js"></script>

        <!-- Tag-->
        <script src="/appAdmin/components/tag/tagRepository.js" type="text/javascript"></script>

        <!-- Personal Information -->
        <script src="/appAdmin/components/personalInformation/personalInformationDetailController.js" type="text/javascript"></script>
        <script src="/appAdmin/components/personalInformation/personalInformationEditController.js" type="text/javascript"></script>
        <script src="/appAdmin/components/personalInformation/personalInformationListController.js" type="text/javascript"></script>
        <script src="/appAdmin/components/personalInformation/personalInformationRepository.js" type="text/javascript"></script>
        <script src="/appAdmin/components/personalInformation/personalInformationService.js" type="text/javascript"></script>

        <!-- Navigation Url -->
        <script src="/appAdmin/components/navigationUrl/navigationUrlDetailController.js" type="text/javascript"></script>
        <script src="/appAdmin/components/navigationUrl/navigationUrlEditController.js" type="text/javascript"></script>
        <script src="/appAdmin/components/navigationUrl/navigationUrlListController.js" type="text/javascript"></script>   
        <script src="/appAdmin/components/navigationUrl/navigationUrlRepository.js" type="text/javascript"></script>
        <script src="/appAdmin/components/navigationUrl/navigationUrlService.js" type="text/javascript"></script>
    </head>

    <body>
        <div id="wrapper">
            <div frame></div>

                <div ui-view></div>
            
        </div>
        <!-- /#wrapper -->
    </body>

</html>
