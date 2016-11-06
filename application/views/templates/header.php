<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?=$header_title?></title>

        <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

        <link href="<?php echo base_url('bootstrap/simple-sidebar.css');?>" rel="stylesheet">
        <style type="text/css">
            .calendar {
                font-size: 20px;
            }
            table.calendar{
                margin: auto; border-collapse: collapse;
            }
            .calendar .heading_row th{
                font-size: 32px;
                text-align: center;
                margin-bottom: 20px;
            }
            .calendar .days td{
                width: 220px; height: 160px; padding: 4px;
                border: 1px solid #999;
                vertical-align: top;
                background-color: #DEF;
            }
            .calendar .days td:hover{
                background-color: #FFF;
            }
            .calendar .highlight{
                font-weight: bold; color: #00F;
            }
        </style>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 

    </head>

    <body>

        <div id="wrapper">
