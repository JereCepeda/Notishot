<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lector = Role::create(['name' => 'lector']);
        $redactor = Role::create(['name' => 'redactor']);
        $administrador = Role::create(['name' => 'administrador']);

        $publicacionLeer = Permission::create(['name' => 'publicacion.leer']);// funciona
        $publicacionLike = Permission::create(['name' => 'publicacion.like']);//funciona
        $publicacionComentar = Permission::create(['name' => 'publicacion.comentar']);//funciona
        $publicacionBloquear=Permission::create(['name' => 'publicacion.bloquear']);//rol admin
        $publicacionEliminar=Permission::create(['name' => 'publicacion.eliminar']);// funciona
        $publicacionComentarioEliminar=Permission::create(['name' => 'comentario.eliminar']);//rol admin
        $usuarioProfile=Permission::create(['name' => 'usuario.profile']);//funciona
        // $usuarioActualizarRol=Permission::create(['name' => 'usuario.actualizar.rol']);
        // $usuarioSolicitarRol=Permission::create(['name' => 'usuario.solicitar.rol']);
        $usuariosListar = Permission::create(['name' => 'usuarios.listar']);//rol admin
        $usuarioBloquear = Permission::create(['name' => 'usuario.bloquear']);//rol admin
        
        $users = User::where('role','lector')->get();
        foreach($users as $user){$user->assignRole($lector->name);$user->givePermissionTo($publicacionLeer);}
        $users =User::where('role','redactor')->get();
        foreach($users as $user){$user->assignRole($redactor->name);$user->givePermissionTo([$publicacionLeer, $publicacionLike,$publicacionComentar,$publicacionEliminar,$publicacionComentarioEliminar,$usuarioProfile]);}
        $users =User::where('role','administrador')->get();
        foreach($users as $user){$user->assignRole($administrador->name);$user->givePermissionTo([$publicacionLeer,$usuariosListar, $usuarioBloquear,$publicacionBloquear]);}
    }
}