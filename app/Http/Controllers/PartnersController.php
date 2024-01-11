<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Patner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_patner()
    {
        $this->data['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Patner"], ['name' => "Patner Create"]
        ];
        //Pageheader set true for breadcrumbs
        $this->data['pageConfigs'] = ['pageHeader' => true, 'isFabButton' => true];
        $this->data['pagetitle'] = "Patner Create";
      
        return view('pages.patner', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function patneradd(request $request)
    {
      //after submit

        if (!empty($request->all())) {

            
            $validator = Validator::make(
                $request->all(),
                [
                    'mobile' => 'required|string|min:10|max:10|unique:patners',
                    'email' =>'required|email|unique:patners',                   
                    'patner_location' => 'required',

                ],
                
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }

            if ($request->has('logo')) {
                $validator = Validator::make(
                    $request->file(),
                    [
                        'logo' => 'image|mimes:jpeg,png,jpg,PNG,JPEG,JPG',
                    ],
                    [
                        'logo.mimes:jpeg,png,jpg,PNG,JPEG,JPG' => 'Image Must be in format of jpeg,png,jpg,PNG,JPEG,JPG'
                    ]
                );
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors());
                }
            }

            $postdata = $request->all();
            unset($postdata['_token']);
            unset($postdata['submit']);
           
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $name = rand(10000, 99999) . time() . '.' . $logo->getClientOriginalExtension();
                $destinationPath = base_path() . '/assets/uploadimage/';
                $logo->move($destinationPath, $name);
                $postdata['logo'] = $name;
              
            }
          
            $red = Patner::create($postdata);

            if ($red) {
                return redirect()->intended(route('patner-list'))->withFlashSuccess('Patner Created Successfully!');

            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function patnerlist($id = '')
    {


        $this->data['patnerlist'] = Patner::select('id','company_name','patner_location','logo','type','status','created_at')->get();

        $this->data['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Patner"], ['name' => "Patner List"]
        ];
        //Pageheader set true for breadcrumbs
        $this->data['pageConfigs'] = ['pageHeader' => true, 'isFabButton' => true];
        $this->data['pagetitle'] = 'Patner List';


        return view('pages.patner-list', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function patneredit($id)
    {
        if ($id != '') {
            $Patner = Patner::where(['id' => $id]);
          
            if ($Patner->count() > 0) {
                $this->data['response'] = $Patner->first();
            }
          
            $this->data['breadcrumbs'] = [
                ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Patner"], ['name' => "Patner Edit"]
            ];
            //Pageheader set true for breadcrumbs
            $this->data['pageConfigs'] = ['pageHeader' => true, 'isFabButton' => true];
            $this->data['pagetitle'] = "Patner Edit";
        }
        return view('pages.patner', $this->data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function patnerupdate(Request $request)
    {
        if (!empty($request->all())) {

            $updatedata = $request->all();
            unset($updatedata["_token"]);
            unset($updatedata['submit']);
            unset($updatedata['id']);


            if (!isset($updatedata['logo']) && !isset($updatedata['old_img'])) {

                return redirect()->back()->withErrors(['logo' => 'Image is required']);
            } elseif (!isset($updatedata['logo']) && $updatedata['old_img'] != '') {

                $updatedata['logo'] = $updatedata['old_img'];
            }

            unset($updatedata['old_img']);
      
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $name = rand(10000, 99999) . time() . '.' . $logo->getClientOriginalExtension();
                $destinationPath = base_path() . '/assets/uploadimage/';
                $logo->move($destinationPath, $name);
                $updatedata['logo'] = $name;
              
            }
   
            $res = Patner::where(['id' => $request->input('id')])->update($updatedata);

            if ($res) {

                return redirect()->intended(route('patner-list'))->withFlashSuccess('Patner Updated Successfully!');
            } else {

                return redirect()->intended(route('patner-list'))->with('error', 'Patner Not Updated');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_patner($id = 0)
    {
        if ($id != 0) {

            $trash_update = Patner::where(['id' => $id])->update(['trash' => 1]);

            if ($trash_update) {
                return redirect()->back()->with(['success' => 'Data Delete Successfully']);
            } else {
                return redirect()->back()->with(['error' => "Something Went Wrong"]);
            }
        }
    }
    public function update_status($id = 0, $status = 1)
    {

        if ($id != 0 && $status != '') {
            $update = Patner::where(['id' => $id])->update(['status' => $status]);
            if ($update) {
                return redirect()->back()->with(['success' => 'Status Change Successfully']);
            } else {
                return redirect()->back()->with(['error' => "Something Went Wrong"]);
            }
        }
    }
}
