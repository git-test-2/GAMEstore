<?php

namespace App\Http\Controllers;

use App\Adress;
use Illuminate\Http\Request;

class AdressController extends Controller
{
    public function change()
    {
        return view('address.edit', ['address' => 1]);
    }

    /**
     * @param NotifyaddressRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * Сохранение адреса
     */
    public function save(Request $request)
    {
        $address = Adress::query()->find($request->id);
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'MAIL_USERNAME=' . $address->name, 'MAIL_USERNAME=' . $request->name, file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'MAIL_PASSWORD=' . $address->password, 'MAIL_PASSWORD=' . $request->password, file_get_contents($path)
            ));
        }
        $address->name = $request->name;
        $address->password = $request->password;
        $address->save();
        return redirect()->route('admin');
    }
}
