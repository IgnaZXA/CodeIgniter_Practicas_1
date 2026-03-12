<?php

namespace App\Enums; 

enum Roles: string {
    case SuperAdmin = "SuperAdmin";
    case Admin      = "Admin";
    case Moderador  = "Moderador";
    case Empleado   = "Empleado";
    case Cliente    = "Cliente";

    public function id(): int{
        return match($this){
            Roles::SuperAdmin   => 1,
            Roles::Admin        => 2,
            Roles::Moderador    => 3,
            Roles::Empleado     => 4,
            Roles::Cliente      => 5,
        };
    }
};