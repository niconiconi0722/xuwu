<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Image;

class UsersRepository
{
    public function index()
    {
        $users = User::paginate(22);
        return $users;
    }

    public function store($request)
    {
        $user = User::create([
            'username' => $request->username,
            'ni_cheng' => $request->ni_cheng,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'email' => $request->email
        ]);

        Auth::login($user);
    }

    public function update($user, $request)
    {
        $data = [];
        if (isset($request->ni_cheng)) {
            $data['ni_cheng'] = $request->ni_cheng;
        }

        if ($request->password) {
            $hash = $user->password;
            if (password_verify($request->old_password, $hash)) {
                $data['password'] = password_hash($request->password, PASSWORD_DEFAULT);
            } else {
                session()->flash('danger', '旧密码不正确');
            }
        }

        $data['email'] = $request->email;

        $user->update($data);
    }

    public function updateIcon($user, $img)
    {
        $old_icon = $user->iconpath;
        $default_icon = '/img/default.png';

        preg_match('/^(data:\s*image\/(\w+);base64,)/', $img, $result);
        $type = $result[2];
        $img_data = str_replace($result[1], '', $img);
        $path = '/upload/icon/'.date("YmdHis.").$type;

        Image::make($img_data)->resize(100, 100)->save(storage_path().'/app/public'.$path);

        // 删除以前用户上传的图片
        if ($old_icon != $default_icon) {
            \File::delete(public_path().$old_icon);
        }

        $data['iconpath'] = '/storage' . $path;
        $user->update($data);
    }

    public function destroy($user)
    {
        $user->delete();
    }
}
