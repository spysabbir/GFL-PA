<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DefaultSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    // Change Env Function
    public function changeEnv($envKey, $envValue)
    {
        $envFilePath = app()->environmentFilePath();
        $strEnv = file_get_contents($envFilePath);
        $strEnv.="\n";
        $keyStartPosition = strpos($strEnv, "{$envKey}=");
        $keyEndPosition = strpos($strEnv, "\n",$keyStartPosition);
        $oldLine = substr($strEnv, $keyStartPosition, $keyEndPosition-$keyStartPosition);

        if(!$keyStartPosition || !$keyEndPosition || !$oldLine){
            $strEnv.="{$envKey}={$envValue}\n";
        }else{
            $strEnv=str_replace($oldLine, "{$envKey}={$envValue}",$strEnv);
        }
        $strEnv=substr($strEnv, 0, -1);
        file_put_contents($envFilePath, $strEnv);
    }

    public function defaultSetting(){
        $default_setting = DefaultSetting::first();
        return view('admin.setting.default', compact('default_setting'));
    }

    public function defaultSettingUpdate(Request $request, $id){
        $request->validate([
            'logo_photo' => 'nullable|image|mimes:png,jpg,jpeg',
            'favicon' => 'nullable|image|mimes:png,jpg,jpeg',
            'app_name' => 'required|max:255',
            'app_url' => 'required',
            'time_zone' => 'required',
            'main_phone' => 'nullable|min:11|max:14',
            'support_phone' => 'nullable|min:11|max:14',
            'main_email' => 'nullable|email|max:255',
            'support_email' => 'nullable|email|max:255',
        ]);
        $this->changeEnv("APP_NAME", "'$request->app_name'");
        $this->changeEnv("APP_URL", "'$request->app_url'");
        $this->changeEnv("TIME_ZONE", "'$request->time_zone'");
        $default_setting = DefaultSetting::where('id', $id)->first();
        DefaultSetting::where('id', $id)->update([
            'app_name' => $request->app_name,
            'app_url' => $request->app_url,
            'time_zone' => $request->time_zone,
            'main_phone' => $request->main_phone,
            'support_phone' => $request->support_phone,
            'main_email' => $request->main_email,
            'support_email' => $request->support_email,
            'address' => $request->address,
            'google_map_link' => $request->google_map_link,
            'facebook_link' => $request->facebook_link,
            'twitter_link' => $request->twitter_link,
            'instagram_link' => $request->instagram_link,
            'linkedin_link' => $request->linkedin_link,
            'youtube_link' => $request->youtube_link,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        // Logo Photo Upload
        if($request->hasFile('logo_photo')){
            if($default_setting->logo_photo != 'default_logo_photo.png'){
                unlink(base_path("public/uploads/default_photo/").$default_setting->logo_photo);
            }
            $logo_photo_name = "Logo-Photo".".". $request->file('logo_photo')->getClientOriginalExtension();
            $upload_link = base_path("public/uploads/default_photo/").$logo_photo_name;
            Image::make($request->file('logo_photo'))->resize(192, 40)->save($upload_link);
            DefaultSetting::where('id', $id)->update([
                'logo_photo' => $logo_photo_name
            ]);
        }

        // Favicon Upload
        if($request->hasFile('favicon')){
            if($default_setting->favicon != 'default_favicon.png'){
                unlink(base_path("public/uploads/default_photo/").$default_setting->favicon);
            }
            $favicon_name = "Favicon".".". $request->file('favicon')->getClientOriginalExtension();
            $upload_link = base_path("public/uploads/default_photo/").$favicon_name;
            Image::make($request->file('favicon'))->resize(70, 70)->save($upload_link);
            DefaultSetting::where('id', $id)->update([
                'favicon' => $favicon_name
            ]);
        }

        $notification = array(
            'message' => 'Default setting updated successfully.',
            'alert-type' => 'success'
        );

        return back()->with($notification);

    }
}
