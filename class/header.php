<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/12/17
 * Time: 5:24 AM
 */
class header
{
    function __construct()
    {
    }

    function __toString()
    {
        return '<header>
                    <nav class="navbar navbar-inverse">
                        <div class="container">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="'.$_SERVER['PHP_SELF'].'">TODO LIST</a>
                                </div>
                                <a class="logout" href="/?logout">Logout</a>

                            </div>
                            
                        </div>
                    </nav>
                </header>';
    }
}