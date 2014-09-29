<?php defined('SYSPATH') or die('No direct script access.');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $title; ?></title>
        <style type="text/css">
            body, html{
                height:100%;
            }
            body{
                font-family: "Georgia";
                margin:0;
            }
            header{
                height: 10%;
                width: 100%;
                background: linear-gradient(#bbbbbb, #E7E5DC);
            }
            footer{
                height: 10%;
                width: 100%;
                background: linear-gradient(#d8dfbf, #E7E5DC);
            }
            section.outer{
                width: 70%;
                min-height: 80%;
                margin-left: 15%;
                background: bisque;
            }
            section.inner{
                padding:10px;
            }
            section.inner > section{
                display:inline-block;
                vertical-align: top;
            }
            section.inner > section.menu{
                width: 10%;
            }
            section.body{
                width:85%;
            }
            td{
                padding: 5px;
            }
        </style>
            
    </head>
    <body>
        <header>
            
        </header>
        <section class="outer">
            <section class="inner">
                <section class="menu">
                    <p><a href="<?php echo URL::base(true,true); ?>">Home</a></p>
                    <p><a href="<?php echo URL::base(true,true); ?>players">Players</a></p>
                    <p><a href="<?php echo URL::base(true,true); ?>teams">Teams</a></p>
                    <p><a href="<?php echo URL::base(true,true); ?>matches">Matches</a></p>
                </section>
                <section class="body">
                    <p style="text-align: right;"><a href="<?php echo URL::base(true,true) ?>/login/logout">Log out</a></p>
                    <?php echo $body ?>
                </section>
            </section>
        </section>
        <footer>
            
        </footer>
    </body>
</html>