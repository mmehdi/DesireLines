<?php include('core/init.core.php');?>
<?php include('header.php');
if($_GET["reset"]==1)
{
    session_destroy();
    header('Location: index.php');
}?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" role="form" action="twitter-callback.php">
                            <fieldset>
                                <!-- Change this to a button or input when using this as a form -->
                            <button class="btn btn-lg btn-success btn-block" type="submit">Login with twitter</button><br/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('footer.php');?>