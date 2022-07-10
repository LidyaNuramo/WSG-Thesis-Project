<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

    <body style="background-color: rgb(100,150,150);">
        <div class="container" style="background-color: rgba(255,255,255,0.5);;border-style: solid;border-color: blue; width: 65%; margin-top: 10%;padding-top: 2%;padding-bottom: 2%;">
            <div class="col-sm">
            </div>
            <div class="col-sm" >
                <h2 style="text-align: center;">Staff Portal Login</h2>
                <form action="../DB/process.php?action=stafflogin" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                    </div>
                    <?php
                        if(!empty($_GET['action']))
                        {
                            switch($_GET['action'])
                            {
                            case 'no':
                            ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label for="exampleInputEmail1" style="color: red;" class="control-label">Incorrect email or password. Please try again.</label>
                                        <br>
                                    </div>
                                </div>
                                <?php
                                break;
                            case 'noaccount':
                            ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label for="exampleInputEmail1" style="color: red;" class="control-label">Please log in first as you are currently not logged in.</label>
                                        <br>
                                    </div>
                                </div>
                                <?php
                                break;
                            case 'createaccount':
                                ?>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label for="exampleInputEmail1" style="color: red;" class="control-label">No account linked with this email address. Contact the IT to get an account created.</label>
                                            <br>
                                        </div>
                                    </div>
                                    <?php
                                    break;
                            }
                        }
                    ?>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-sm">
            </div>
        </div>
    </body>

</html>