<?php
session_start();
if(!defined('LOCALROOT')){
    define('LOCALROOT',dirname(__FILE__).'/');
}
if(!defined('SERVERROOT')){
    define('SERVERROOT',$_SERVER['SERVER_NAME'].'/depeddoctrack/');
}

//css
if(!defined('css')){
    define('css',"<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css'>");
}

//angularfilter
if(!defined('customcss')){
	define('customcss',"<link rel='stylesheet' href='../../libs/css/custom.css'>");
}

//materializejs
if(!defined('js')){
    define('js',"<script src='../../libs/bootstrap/js/bootstrap.min.js'></script>");
}

//jquery
if(!defined('jquery')){
    define('jquery',"<script src='../../libs/js/jquery-3.1.0.min.js'></script>");
}

//title
if(!defined('title')){
    define('title','Deped Document Tracking System');
}

//angular
if(!defined('angular')){
    define('angular',"<script src='../../libs/js/angular.min.js'></script>");
}

//angular
if(!defined('angularroute')){
    define('angularroute',"<script src='../../libs/js/angular-route.min.js'></script>");
}

//angular
if(!defined('angularanimate')){
    define('angularanimate',"<script src='../../libs/js/angular-animate.min.js'></script>");
}

//angular
if(!defined('angularscript')){
    define('angularscript',"<script src='../../libs/js/ng-script.js'></script>");
}

//angular
if(!defined('hrscript')){
    define('hrscript',"<script src='../../libs/js/hr-script.js'></script>");
}

//angularfilter
if(!defined('angularfilter')){
	define('angularfilter',"<script src='../../libs/js/angular-filter.min.js'></script>");
}

//ngmaterial
if(!defined('ngmaterial')){
	define('ngmaterial',"<script src='https://cdnjs.cloudflare.com/ajax/libs/angular-materialize/0.2.1/angular-materialize.min.js'></script>");
}