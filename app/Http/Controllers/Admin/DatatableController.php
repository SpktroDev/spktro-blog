<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    public function posts()
    {
        $posts = Post::select('id', 'name')
            ->where('user_id', auth()->id())
            ->latest('id')
            ->get();
            
        // return datatables()->of($posts)->toJson();
        $data = $posts->map(function ($post) {
            return [
                'id'      => $post->id,
                'name'    => $post->name,
                'edit'    => '<a href="'.route('admin.posts.edit', $post).'" class="btn btn-sm btn-primary">Editar</a>',
                'delete'  => '<form method="POST" action="'.route('admin.posts.destroy', $post).'" style="display:inline">'
                            .csrf_field()
                            .method_field('DELETE')
                            .'<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'¿Eliminar este post?\')">Eliminar</button>'
                            .'</form>',
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function users()
    {
        $users = User::all();
            
        $data = $users->map(function ($user) {
            return [
                'id'      => $user->id,
                'name'    => $user->name,
                'email'   => $user->email,
                'edit'    => '<a href="'.route('admin.users.edit', $user).'" class="btn btn-sm btn-primary">Editar</a>',
            ];
        });

        return response()->json(['data' => $data]);
    }
}
