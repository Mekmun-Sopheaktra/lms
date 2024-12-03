<?php

namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Enum\MediaTypeEnum;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;

class SettingRepository extends Repository
{
    public static function model()
    {
        return Setting::class;
    }

    public static function updateByRequest(SettingUpdateRequest $request, Setting $setting)
    {

        $logo = $request->hasFile('logo') ? MediaRepository::updateOrCreateByRequest(
            $request->file('logo'),
            'setting/logo',
            $setting->logo,
            MediaTypeEnum::IMAGE
        ) : $setting->logo;

        $footer = $request->hasFile('footerlogo') ? MediaRepository::updateOrCreateByRequest(
            $request->file('footerlogo'),
            'setting/logo/footer',
            $setting->footer,
            MediaTypeEnum::IMAGE
        ) : $setting->footer;


        $favicon = $request->hasFile('favicon') ? MediaRepository::updateOrCreateByRequest(
            $request->file('favicon'),
            'setting/favicon',
            $setting->favicon,
            MediaTypeEnum::IMAGE
        ) : $setting->favicon;


        return self::update($setting, [
            'logo_id' => $logo ? $logo->id : null,
            'footerlogo_id' => $footer ? $footer->id : null,
            'favicon_id' => $favicon ? $favicon->id : null,
            'footer_text' => $request->footer_text ?? $setting->footer_text,
            'currency_position' => $request->currency_position ?? $setting->currency_position,
        ]);
    }
}
