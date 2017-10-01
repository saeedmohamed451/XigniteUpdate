<?php include("isvalid.php");

?>
<!DOCTYPE html>
<html lang="en">
    <head>


        <!-- start: Meta -->
        <meta charset="utf-8">
        <title><?php echo "Admin"; ?></title>
        <meta name="description" content="Bootstrap Metro Dashboard">
        <meta name="author" content="Dennis Ji">
        <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <!-- end: Meta -->

        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- end: Mobile Specific -->

        <!-- start: CSS -->
        <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link id="base-style" href="css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
        <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>-->
        <!-- end: CSS -->


        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <link id="ie-style" href="css/ie.css" rel="stylesheet">
        <![endif]-->

        <!--[if IE 9]>
                <link id="ie9style" href="css/ie9.css" rel="stylesheet">
        <![endif]-->

        <!-- start: Favicon -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- end: Favicon -->
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">


            function valid()
            {
//alert("hii");
                var st = 1;

                if (document.getElementById("newpass").value != document.getElementById("conpass").value)
                {
                    alert("Password not match");
                    st = 0;
                }
                if (st == 0)
                {
                    return false;
                }
            }</script>	

        <script type="text/javascript">
            function statename(value)
            {
                //var value=document.getElementById("hstate").value;
                //alert(value);
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        if (xmlhttp.responseText == 1)
                        { //alert(xmlhttp.responseText);
                        } else {
                            //alert(xmlhttp.responseText);
                            document.getElementById("state").innerHTML = xmlhttp.responseText;
                        }
                    }
                }
                xmlhttp.open("GET", "getstate.php?id=" + value, true);
                xmlhttp.send();
                return true;
            }

            function cityname(value)
            {
                //var value=document.getElementById("hstate").value;
                //alert(value);
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        if (xmlhttp.responseText == 1)
                        { //alert(xmlhttp.responseText);
                        } else {
                            //alert(xmlhttp.responseText);
                            document.getElementById("city").innerHTML = xmlhttp.responseText;
                        }
                    }
                }
                xmlhttp.open("GET", "getcity.php?id=" + value, true);
                xmlhttp.send();
                return true;
            }
            function subcat1(value)
            {
                //var value=document.getElementById("hstate").value;
                //alert(value);
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        if (xmlhttp.responseText == 1)
                        { //alert(xmlhttp.responseText);
                        } else {
                            //alert(xmlhttp.responseText);
                            document.getElementById("subcategory").innerHTML = xmlhttp.responseText;
                            document.getElementById("subtopic").innerHTML = '<option value="">Select Subtopic</option>';
                        }
                    }
                }
                xmlhttp.open("GET", "getsubcat.php?id=" + value, true);
                xmlhttp.send();
                return true;
            }

            function subtopic1(value)
            {
                //var value=document.getElementById("hstate").value;
                //alert(value);
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        if (xmlhttp.responseText == 1)
                        { //alert(xmlhttp.responseText);
                        } else {
                            //alert(xmlhttp.responseText);
                            document.getElementById("subtopic").innerHTML = xmlhttp.responseText;
                        }
                    }
                }
                xmlhttp.open("GET", "getsubtopic.php?id=" + value, true);
                xmlhttp.send();
                return true;
            }
        </script>
        <!--
        function checkall()
        { 
        //alert("hii");
        if(document.getElementById("ac").checked==true)
        {
        var checkbox = document.getElementsByName('ckbox[]');
            var ln = checkbox.length;
                
            for (i = 1; i<=ln; i++)
        {
        var att="ckbox"+i;
        
                document.getElementById(att).checked = true ;
        }
                
           
        }
        else
        {
        var checkbox = document.getElementsByName('ckbox[]');
            var ln = checkbox.length;
            for (i = 1; i<=ln; i++)
        {
        var att="ckbox"+i;
        
                document.getElementById(att).checked = false ;
        }
        }
        }
        
        
        function statename1(value)
        { 
        //var value=document.getElementById("hstate").value;
        //alert(value);
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
         if(xmlhttp.responseText==1)
         { //alert(xmlhttp.responseText);
         }else{
         //alert(xmlhttp.responseText);
        document.getElementById("state1").innerHTML=xmlhttp.responseText;
         }
        }
        }
        xmlhttp.open("GET","getstate.php?id="+value,true);
        xmlhttp.send();
        return true;
        }
                </script>	-->	
    </head>

    <body>
        <!-- start: Header -->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="admin_home.php"><span><?php echo "Admin"; ?></span></a>

                    <!-- start: Header Menu -->
                    <div class="nav-no-collapse header-nav">
                        <ul class="nav pull-right">

                            <li class="dropdown">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="halflings-icon white user"></i> Admin
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-menu-title">
                                        <span>Account Settings</span>
                                    </li>
                                    <li><a href="change.php"><i class="halflings-icon cog"></i> Setting</a></li>
                                    <li><a href="logout.php"><i class="halflings-icon off"></i> Logout</a></li>
                                </ul>
                            </li>
                            <!-- end: User Dropdown -->
                        </ul>
                    </div>
                    <!-- end: Header Menu -->

                </div>
            </div>
        </div>