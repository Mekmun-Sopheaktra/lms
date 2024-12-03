<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingUpdateRequest;
use App\Repositories\SettingRepository;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $zones = array();
        $timestamp = time();

        foreach (timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones[$key]['zone'] = $zone;
            $zones[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }

        return view('setting.edit', [
            'timezones' => $zones,
            'setting' => SettingRepository::query()->get()->first(),
        ]);
    }

    public function update(SettingUpdateRequest $request)
    {
        $setting = SettingRepository::query()->first();

        SettingRepository::updateByRequest($request, $setting);

        $this->setEnv('APP_NAME', $request->get('app_name'));
        $this->setEnv('APP_CURRENCY', $request->get('app_currency'));
        $this->setEnv('APP_CURRENCY_SYMBOL', $request->get('app_currency_symbol'));
        $this->setEnv('APP_TIMEZONE', $request->get('app_timezone'));

        Artisan::call('config:clear');

        return to_route('setting.index')->withSuccess('Settings updated');
    }

    private function setEnv($key, $value): bool
    {
        try {
            $path = base_path('.env');
            $file = file($path); // Open File Line By line
            $diffFileLines = array_diff($file, ["\n"]); // Remove all empty lines

            $exists = false;
            foreach($diffFileLines as $lineNo => $oldValue){
                if (strpos($oldValue, $key . '=') !== false) {
                    $file[$lineNo] = $key .'="'. $value . '"' . "\n";
                    $exists = true;
                }
            }
            if(!$exists){
                $file[] = $key .'="'. $value . '"' . "\n";
            }

            file_put_contents($path, implode('', $file));

            return true;
        } catch (Exception $e) {
            // Log or report the exception
            Log::error("Error updating environment variable: {$e->getMessage()}");
            return false;
        }
    }
}