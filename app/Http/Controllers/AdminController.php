<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    public function userList()
    {
        $users = User::all();
        return view('user.admin.list', ['users' => $users]);
    }

    public function GET_datatable()
    {

        $filtrados = 0;

        // $query = Business::leftJoin('w_business_types', 'w_business_types.id', '=', 'w_businesses.business_type_id')
        //     ->leftJoin('w_businesses_users', 'w_businesses_users.business_id', '=', 'w_businesses.id')
        //     ->leftJoin('w_users', 'w_users.id', '=', 'w_businesses_users.user_id')
        //     ->select(
        //         'w_businesses.*',
        //         'w_business_types.name as business_type_name',
        //         'w_businesses.CODE_ERP as codigo_cliente',
        //         'w_businesses.business_name as razon_social',
        //         'w_users.id as userid',
        //         'w_users.nombre as username',
        //         'w_businesses.CUIT as cuitpresea',
        //     );
        $query = User::select('*');
        if (request('order'))
        {
            $columnIndex = request('order')[0]['column'];
            $columnName = request('columns')[$columnIndex]['name'];
            $query->orderBy($columnName, request('order')[0]['dir']);
        }

        if (request('search') && request('search.value') != '')
        {
            $query->where(function ($q)
            {
                $q->where("role", 'LIKE', '%' . request('search.value') . '%')
                    ->orWhere("nick", 'LIKE', '%' . request('search.value') . '%')
                    ->orWhere("name", 'LIKE', '%' . request('search.value') . '%')
                    ->orWhere("email", 'LIKE', '%' . request('search.value') . '%');
            });
        }

        foreach (request('columns') as $column)
        {
            if ($column['search'] && $column['search']['value'] != '')
            {
                $query->where($column['name'], 'LIKE', '%' . $column['search']['value'] . '%');
            }
        }

        $filtrados = $query->toBase()->getCountForPagination();

        if (request('start') && request('start') != 0)
        {
            $query->offset(request('start'));
        }

        if (request('length') && request('length') != 0)
        {
            $query->limit(request('length'));
        }
        $result = $query->get();
        $response['draw'] = request('draw');
        $response['data'] = $result;
        $response['recordsTotal'] = $query->toBase()->getCountForPagination();
        $response['recordsFiltered'] = $filtrados;

        return $response;
    }

    public function updatePermissions(Request $request, User $user)
    {
        $user->syncPermissions($request->input('permissions', []));

        return redirect()->back()->with('success', 'Permisos actualizados correctamente');
    }

    public function blockUser(User $user)
    {
        $user->update(['blocked' => true]);

        return redirect()->back()->with('success', 'Usuario bloqueado correctamente');
    }
}