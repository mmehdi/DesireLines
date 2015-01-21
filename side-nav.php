<?php
//show sidebar on everypage except login
    $page_name = basename($_SERVER['PHP_SELF'], ".php");      
            if ($page_name !== "login"){

                echo '<div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                    <li>
                            <a href="my-journeys.php"><i class="fa fa-bus fa-fw"></i> My Journeys</a>
                        </li>
                        <li>
                            <a href="register-journey.php"><i class="fa fa-th-large fa-fw"></i> Register Journey</a>
                        </li>
                    </ul>
                </div>
            
            </div>';}?>

