<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'siteTitle'=>$request->title,
            'siteUrl'=>$request->url,
            'siteLogo'=>$request->logo==''? 'frontend/images/logo.png' : $request->logo,
            'siteFavicon'=>$request->favicon==''? 'frontend/images/favicon.png' : $request->favicon,
            'footer'=>$request->footer,
            'about'=>$request->about,
            'phone'=>$request->phone,
            'officeTime'=>$request->office_time,
            'email'=>$request->email,
            'address'=>$request->address,
            'shortIntro'=>$request->short_intro,
            'facebookUrl'=>$request->
        ];
    }
}
