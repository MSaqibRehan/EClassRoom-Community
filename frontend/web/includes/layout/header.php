<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/jpg" href="images/icon.png">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="hover-master/css/hover-min.css">
                <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
                    <script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
                        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
        nav a{
            color: grey;
            font-size: 20px;
        }
        #dex{
             padding-top: 10px;
            }
        #dex a:hover{
            color: white !important;
            font-weight: normal !important;
            background: #033B6A;
            text-decoration: none;
            padding: 5px;
            border-radius: 5px;
        }
        .sidebar a{
            font-size: 18px;
        }
        .sidebar a:hover{
            background-color: dodgerblue;
            border-radius: 5px;

        }
        .sidebar a.active{
            background-color: dodgerblue;
            border-radius: 5px;
        }

    </style>
</head>
<body>
<div class="container-fluid">
        <div class="row my-0">
            <div class="col-12 ">
                    <nav class="navbar navbar-expand-lg bg-dark py-0 pr-3" style="border-top: 5px solid #36B0DD; border-bottom: 5px solid #36B0DD;">

                <a href="index.php" class=" offset-1 navbar-brand js-scroll-trigger font-weight-bold p-1" style="color: #36B0DD; font-size: 25px; font-style: italic;"> eClassroom & Community</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase bg-success text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav nav-pills ">
                        
                        

           <form action="search.php" method="GET" class="my-auto  ml-auto mr-5">
            <div class="input-group">
              <input type="text" name="query" class="form-control" placeholder="Search">
              <div class="input-group-append">
                <input type="submit" name="submit" class=" btn btn-success" value="search">
                
              </div>
            </div>
    </form>
                    </ul>
                </div>
            </nav>
        </div>
            </div>



