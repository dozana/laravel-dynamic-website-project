<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;
use Carbon\Carbon;

class FooterController extends Controller
{
    public function footerSetup()
    {
        $all_footer = Footer::find(1);
        return view('admin.footer.footer_all', compact('all_footer'));
    }

    public function footerUpdate(Request $request, $id)
    {
        Footer::findOrFail($id)->update([
            'number' => $request->number,
            'short_description' => $request->short_description,
            'address' => $request->address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'x' => $request->x,
            'copyright' => $request->copyright,
        ]);

        $notification = [
            'message' => 'Footer Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
