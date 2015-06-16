<?php
if (!function_exists('check'))
{
    function is_spadmin_hp($data)
    {
        if(isset($data['USER_ROLE']) && $data['USER_ROLE'] != ''){
            $role = $data['USER_ROLE'];
            if($role == 1){
                return true;
            }
        }

        return false;
    }

    function is_agency_admin_hp($data)
    {
        if(isset($data['USER_ROLE']) && $data['USER_ROLE'] != ''){
            $role = $data['USER_ROLE'];
            if($role == 1 || $role == 2){
                return true;
            }
        }

        return false;
    }

    function is_admin_hp($data)
    {
        if(isset($data['USER_ROLE']) && $data['USER_ROLE'] != ''){
            $role = $data['USER_ROLE'];
            if($role == 1 || $role == 2){
                return true;
            }
        }

        return false;
    }

    function is_consultant_hp($data)
    {
        if(isset($data['USER_ROLE']) && $data['USER_ROLE'] != ''){
            $role = $data['USER_ROLE'];
            if($role == 3 || $role == 4){
                return true;
            }
        }

        return false;
    }

    function is_user_hp($data)
    {
        if(isset($data['USER_ROLE']) && $data['USER_ROLE'] != ''){
            $role = $data['USER_ROLE'];
            if($role == 3){
                return true;
            }
        }

        return false;
    }

    function is_restricted_ruser_hp($data)
    {
        if(isset($data['USER_ROLE']) && $data['USER_ROLE'] != ''){
            $role = $data['USER_ROLE'];
            if($role == 4){
                return true;
            }
        }

        return false;
    }
}