<?php defined('SYSPATH') or die('No direct script access.');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <style type="text/css">
            .container{
                position: fixed;
                top: 50%;
                left: 50%;
                width: 400px;
                height:200px;
                margin: -200px 0 0 -100px;
            }
        </style>
    </head>
    <body>
        <?php echo Form::open() ?>
            <section class="container">
                <section>
                    <p><?php echo $error; ?></p>
                    <h1>Log in</h1>
                    <p style="font-size: small;">(Username: admin, Password: demo123)</p>
                </section>
                <table>
                    <tr>
                        <td><?php echo Form::label('username', 'User') ?></td>
                        <td><?php echo Form::input('username') ?></td>
                    </tr>
                    <tr>
                        <td><?php echo Form::label('password', 'Password') ?></td>
                        <td><?php echo Form::input('password') ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><p><?php echo Form::submit(NULL, 'login') ?></p></td>
                    </tr>
                </table>
            </section>
        <?php echo Form::close() ?>
    </body>
</html>