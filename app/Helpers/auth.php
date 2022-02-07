<?php
if(!function_exists('getUserLoggedRoleId'))
{
    function getUserLoggedRoleId()
    {
        return auth()->user()->role_id;
    }
}

if(!function_exists('getUserLoggedId'))
{
    function getUserLoggedId()
    {
        return auth()->user()->id;
    }
}

if(!function_exists('getUserLoggedIsAdmin'))
{
    function getUserLoggedIsAdmin()
    {
        return auth()->user()->role_id == 1;
    }
}



if(!function_exists('verifyUserLogged'))
{
    function verifyUserLogged()
    {
        return auth()->check();
    }
}


if(!function_exists('redirect404UserNotLogged'))
{
    function redirect404UserNotLogged()
    {
        if(verifyUserLogged() === false)
        {
            abort(404);
        }
    }
}
