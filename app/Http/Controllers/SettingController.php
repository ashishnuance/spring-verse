<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SettingController extends Controller

{
    public function index()
    {
      // $this->data['breadcrumbs'] = [
      //   ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Social"], ['name' => "Social Create"]
      // ];
        $this->data['pagetitle'] = 'Social Link';
        $this->data['response'] = SocialLink::first();
        
        return view('pages.social-create',$this->data);
    }

    public function store(Request $request)
    {
    // print_r($request->all()); exit();
    if (!empty($request->all())) {
        $validator = Validator::make(
            $request->all(),
            [
                 'facebook' => 'required',
                 'twitter' => 'required',
                 'youtube' => 'required',
                 'snapchat' => 'required',
                 'instagram' =>'required'
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $postdata = $request->all();
        unset($postdata['_token']);
        unset($postdata['submit']);

        $red = SocialLink::create($postdata);

        return redirect()->back();
    }
}
    public function update(Request $request)
    {
        // echo"<pre>"; print_r($request->all()); die;

      if (!empty($request->all())) {
        $updatedata = $request->all();
        unset($updatedata["_token"]);
        unset($updatedata['submit']);
        unset($updatedata['_method']);
        unset($updatedata['id']);

            $res = SocialLink::where(['id' => $request->input('id')])->update($updatedata);
            if ($res) {

              return redirect()->back()->withFlashSuccess('Social Updated Successfully!');
          } else {

              return redirect()->back()->with('error', 'Social Not Updated');
          }
        }

    }

}


