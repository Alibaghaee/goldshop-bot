<?php

use App\Models\General\Action;
use App\Models\General\Controller;
use App\Models\General\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;

if (!function_exists('get_page_title')) {
    /**
     * get the current page title from related controller action
     * @param string $default
     * @return string
     */
    function get_page_title($default = '')
    {
        if ($default) {
            return $default;
        }
        if (get_current_action()) {
            return __(get_current_action()->title);
        }
        return 'no title';
    }
}

if (!function_exists('get_current_module')) {
    /**
     * get the current related module record in modules table according to request path
     * @return Module|null
     */
    function get_current_module()
    {
        $path_array = explode('/', request()->path());
        $module_name = array_get($path_array, 0, null);
        $module = Cache::remember('module.' . $module_name, 3600, function () use ($module_name) {
            return Module::where('name', $module_name)->first();
        });

        return $module;
    }
}


if (! function_exists('array_get')) {
    /**
     * Get an item from an array using "dot" notation.
     *
     * @param  \ArrayAccess|array  $array
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function array_get($array, $key, $default = null)
    {
        return Arr::get($array, $key, $default);
    }
}

if (! function_exists('kebab_case')) {
    /**
     * Convert a string to kebab case.
     *
     * @param  string  $value
     * @return string
     */
    function kebab_case($value)
    {
        return Str::kebab($value);
    }
}
if (! function_exists('studly_case')) {
    /**
     * Convert a value to studly caps case.
     *
     * @param  string  $value
     * @return string
     */
    function studly_case($value)
    {
        return Str::studly($value);
    }
}

if (!function_exists('get_current_controller')) {
    /**
     * get the current related controller record in controllers table according to route parameters
     * @return Controller|null
     */
    function get_current_controller()
    {

        $get_current_module = get_current_module();
        if (!$get_current_module) {
            return null;
        }
        $current_controller = Cache::remember('current_controller.' . get_route('controller'), 3600, function () use ($get_current_module) {
            return $get_current_module->controllers()->where('name', get_route('controller'))->first();
        });

        return $current_controller;
    }
}

if (!function_exists('get_current_action')) {
    /**
     * get the current related action record in actions table according to route parameters
     * @return Action|null
     */
    function get_current_action()
    {


        $current_action = Cache::remember('current_action.' . get_route('controller') . '.' . get_route('action'), 3600, function () {

            return get_current_controller()->actions()->where('name', get_route('action'))->first();
        });

        return $current_action;
    }
}

if (!function_exists('get_route')) {
    /**
     * parse current route name
     * @return Array|null
     */
    function get_route($value)
    {

        $route_name_array = explode('.', request()->route()->getName());
        if (count($route_name_array) == 2) {
            $route['controller'] = array_get($route_name_array, 0, null);
            $route['action'] = array_get($route_name_array, 1, null);
        } else {
            $route['controller'] = array_get($route_name_array, 1, null);
            $route['action'] = array_get($route_name_array, 2, null);
        }
        $route = adaptRouteActionName($route);
        return array_get($route, $value);
    }
}

if (!function_exists('adaptRouteActionName')) {
    /**
     * adapt route action name
     * @param Array $route_info
     * @return Array
     */
    function adaptRouteActionName(array $route_info)
    {
        $route_info['action'] = $route_info['action'] == 'update' ? 'edit' : $route_info['action'];
        $route_info['action'] = $route_info['action'] == 'store' ? 'create' : $route_info['action'];

        return $route_info;
    }
}

if (!function_exists('is_upload_request')) {
    /**
     * check either request is file(s) upload request or not
     * @return boolean
     */
    function is_upload_request(Request $request)
    {
        return strpos($request->header('Content-Type'), 'multipart/form-data') !== false;
    }
}

if (!function_exists('multiselect_adapter')) {
    /**
     * iterate over validated input data and foreach mutltiselected input convert array to
     * nested value by given id
     * @param string $nested_key
     * @param array $inputs
     * @return array
     */
    function multiselect_adapter($inputs, $nested_key = "id")
    {

        $inputs = array_map(function ($input) use ($nested_key) {
            if (is_array($input)) {
                if (!Arr::exists($input, $nested_key) && count($input) == count($input, COUNT_RECURSIVE)) {
                    return $input;
                }
                if (count($input) == count($input, COUNT_RECURSIVE)) {
                    return array_get($input, $nested_key, null);
                }
                if (Arr::exists($input, 'services')) {
                    return collect($input['services'])->pluck('id')->toArray();
                }
                return collect($input)->pluck('id')->toArray();
            }
            return $input;
        }, $inputs);

        return $inputs;
    }
}

if (!function_exists('get_current_module_table_tag')) {
    /**
     * get the current related module table tag
     * example: <user-table></user-table>
     * @return string
     */
    function get_current_module_table_tag($data = null, $model = null, $manual = false, $component = null, $pageTitle = null)
    {
        if ($manual) {
            printf('<%s page_title="%s" :data=\'%s\' :model=\'%s\'></%s>',
                $component,
                $pageTitle,
                json_encode($data),
                json_encode($model),
                $component
            );
        } else {
            printf('<%s-table page_title="%s" :data=\'%s\' :model=\'%s\'></%s-table>',
                kebab_case(studly_case(get_current_controller()->name)),
                get_page_title(),
                json_encode($data),
                json_encode($model),
                kebab_case(studly_case(get_current_controller()->name))
            );
        }
    }
}

if (!function_exists('get_per_page')) {
    /**
     * return per_page (as default) property in request query string if exists
     * else return null
     * @return integer
     */
    function get_per_page($request, $parameter = 'per_page')
    {
        return $request->has($parameter) ? (int)$request->$parameter : null;
    }
}
if (! function_exists('str_plural')) {
    /**
     * Get the plural form of an English word.
     *
     * @param  string  $value
     * @param  int     $count
     * @return string
     */
    function str_plural($value, $count = 2)
    {
        return Str::plural($value, $count);
    }
}

if (! function_exists('str_replace_first')) {
    /**
     * Replace the first occurrence of a given value in the string.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $subject
     * @return string
     */
    function str_replace_first($search, $replace, $subject)
    {
        return Str::replaceFirst($search, $replace, $subject);
    }
}


if (!function_exists('success_flash')) {
    /**
     * Flash a key / value pair to the session with success message
     * @return void
     */
    function success_flash($message = 'The opration successfully done!')
    {
        flash_message($message);
    }
}
if (! function_exists('snake_case')) {
    /**
     * Convert a string to snake case.
     *
     * @param  string  $value
     * @param  string  $delimiter
     * @return string
     */
    function snake_case($value, $delimiter = '_')
    {
        return Str::snake($value, $delimiter);
    }
}
if (!function_exists('flash_message')) {
    /**
     * Flash a key / value pair to the session with success message
     * @return void
     */
    function flash_message($message, $level = 'success')
    {
        session()->flash('flash', __($message));
        session()->flash('level', $level);
    }
}

if (!function_exists('request_parameter')) {
    /**
     * return request paramenter for given index if exists, otherwise return null
     * @return string|null
     */
    function request_parameter($index)
    {
        return array_get(request()->route()->parameterNames(), $index, null);
    }
}

if (!function_exists('get_selected_option_from_array')) {
    /**
     * get selected option from array for multiselect 'value' property and cast to Json
     * @param array $array like [ ['id' => 1, 'name' => 'abcd'] ]
     * @param integer $id
     * @return Json
     */
    function get_selected_option_from_array(array $array, $id)
    {

        return json_encode(collect($array)->firstWhere('id', $id));
    }
}

if (!function_exists('get_selected_option_from_json')) {
    /**
     * get selected option from array for multiselect 'value' property and cast to Json
     */
    function get_selected_option_from_json($obj, $id)
    {

        return json_encode($obj->firstWhere('id', $id));
    }
}

if (!function_exists('get_option_from_array')) {
    /**
     * cast array to Json for multiselect 'options' property
     * @param array $array like [ ['id' => 1, 'name' => 'abcd'] ]
     * @return Json
     */
    function get_option_from_array(array $array)
    {
        $array = translate_options_array($array);

        return json_encode($array);
    }
}

if (!function_exists('translate_options_array')) {
    /**
     * @param array $array like [ ['id' => 1, 'name' => 'abcd'] ]
     * @return Json
     */
    function translate_options_array(array $array)
    {
        return array_map(function ($item) {
            if (Arr::has($item, 'name')) {
                $item['name'] = __($item['name']);
            }
            return $item;
        }, $array);
    }
}

if (!function_exists('make_slug')) {
    /**
     * @param string $string
     * @param string $separator
     * @return string
     */
    function make_slug($string, $separator = '-')
    {
        $string = trim($string);
        $string = str_slug($string, $separator);

        return $string;
    }
}

if (!function_exists('imageCache')) {
    /**
     * @param string $string
     * @param string $separator
     * @return string
     */
    function imageCache($path, $width = 200, $height = 200, $type = 'fit')
    {
        return '/get_image/' . $width . '/' . $height . '/' . $type . '/' . trim($path, '/');
    }
}

if (!function_exists('setting')) {

    /**
     * get setting
     * @param Integer $id
     * @param String $default
     * @return Mix
     */
    function setting($id, $default = '')
    {
        $setting = \App\Models\General\Setting::find($id);
        return $setting ? $setting->value : $default;
    }
}

if (!function_exists('localeSetting')) {

    /**
     * get locale setting
     * given {local} and {id} pair must exists in portal config => portal.settings.{local}.{id}
     * @param Integer $id
     * @param String $default
     * @return Mix
     */
    function localeSetting($id, $default = '')
    {
        $id = config('portal.settings.' . request()->segment(1) . '.' . $id);
        $setting = \App\Models\General\Setting::find($id);
        return $setting ? $setting->value : $default;
    }
}

if (!function_exists('localeMenuId')) {

    /**
     * get locale setting
     * given {local} and {id} pair must exists in portal config => portal.settings.{local}.{id}
     * @param Integer $id
     * @return Mix
     */
    function localeMenuId($id)
    {
        return config('portal.menus.' . request()->segment(1) . '.' . $id);
    }
}

if (!function_exists('getSiteBladePath')) {

    /**
     * get site blade path
     * @param String $view_path
     * @return String
     */
    function getSiteBladePath($view_path)
    {
        $path = 'site.' . request()->segment(1) . '.' . $view_path;
        $default_path = 'site.' . config('portal.default_local') . '.' . $view_path;
        return View::exists($path) ? $path : $default_path;
    }
}

if (!function_exists('get_options_value')) {

    /**
     * get site blade path
     * @param String $view_path
     * @return String
     */
    function get_options_value($options_key, $id, $key = 'name')
    {
        return array_get(collect(config('portal.' . $options_key))->where('id', $id)->first(), $key);
    }
}

if (!function_exists('locale_url')) {
    /**
     * get locale url
     * @param String $url
     * @return String
     */
    function locale_url($url = '')
    {
        return implode('/', [
            '',
            app()->getLocale(),
            trim($url, '/'),
        ]);
    }
}

if (!function_exists('is_active_url')) {
    /**
     * @param String $url
     * @return bool
     */
    function is_active_url($url = '')
    {
        return request()->path() == trim(locale_url($url), '/');
    }
}

if (!function_exists('is_active_url')) {
    /**
     * @param String $url
     * @return String
     */
    function is_active_url($url = '')
    {
        return request()->path() == locale_url($url);
    }
}

if (!function_exists('nav_active_url_class')) {
    /**
     * @param String $url
     * @return String
     */
    function nav_active_url_class($url = '', $mobile = false)
    {
        if ($mobile) {
            return is_active_url($url) ? 'text-teal-lighter' : 'text-indigo-dark hover:text-purple-light';
        }
        return is_active_url($url) ? 'text-teal-light' : 'text-indigo-dark hover:text-purple-light';
    }
}

if (!function_exists('has_access_to_action')) {
    /**
     * @return boolean
     */
    function has_access_to_action($id)
    {
        return auth()->user()->level->actions()->where('actions.id', $id)->exists();
    }
}

if (!function_exists('get_host_name')) {
    /**
     * @param boolean $with_www
     * @return string
     */
    function get_host_name($with_www = false)
    {
        // for fixing queue jobs issue
        if (config('app.domain')) {
            return config('app.domain');
        }

        if ($with_www) {
            return request()->getHttpHost();
        }

        return ltrim(request()->getHttpHost(), 'www.');
    }
}

if (!function_exists('send_notification')) {
    /**
     * send push notifications
     * @param integer $entity_id
     * @param \App\Models\General\RequestItem $request_item
     * @return void
     */
    function send_notification($entity, $request_item)
    {
        web_push_notification($entity, $request_item);
        onesignal_notification($entity);
    }
}

if (!function_exists('from_camel_case')) {
    function from_camel_case($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}

if (!function_exists('page_was_refreshed')) {
    function page_was_refreshed()
    {
        return isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
    }
}

if (!function_exists('smsWithCustomConfig')) {

    function smsWithCustomConfig(array $config)
    {
        $ch = curl_init();
        $data = http_build_query([
            'username' => $config['username'],
            'password' => $config['password'],
            'sender_number' => $config['sender_number'],
            'receiver_number' => $config['mobile'],
            'note' => $config['message'],
            'token' => 'rVW9HmLH41RjA5PywpuHGdfXODzbQo', // for api proxy on robots.rahco.ir
            'domain' => $config['domain'],
        ]);
        $url = 'http://' . $config['domain'] . '/send_via_get/send_sms.php';
        // $url = 'http://robots.rahco.ir/api/proxy/send';
        $getUrl = $url . "?" . $data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            \Log::info('SMS Request Error:' . curl_error($ch));
            \Log::info($data);
        } else {
            return $response;
        }
        curl_close($ch);
    }


}
if (!function_exists('checkDelivery')) {

    function checkDelivery(array $config)
    {
        $ch = curl_init();
        $data = http_build_query([
            'username' => $config['username'],
            'password' => $config['password'],
            'dargah' => $config['dargah'],
            'smsid' => $config['smsid'],
            'token' => 'rVW9HmLH41RjA5PywpuHGdfXODzbQo', // for api proxy on robots.rahco.ir
            'domain' => $config['domain'],
        ]);
        $url = 'http://' . $config['domain'] . '/send_via_get/send_sms.php';
        // $url = 'http://robots.rahco.ir/api/proxy/send';
        $getUrl = $url . "?" . $data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            \Log::info('SMS Request Error:' . curl_error($ch));
            \Log::info($data);
        } else {
            return $response;
        }
        curl_close($ch);
    }


}

if (!function_exists('balancePanel')) {

    function balancePanel(array $config)
    {
        $ch = curl_init();
        $data = http_build_query([
            'username' => $config['username'],
            'password' => $config['password'],
            'token' => 'rVW9HmLH41RjA5PywpuHGdfXODzbQo', // for api proxy on robots.rahco.ir
            'domain' => $config['domain'],
        ]);
        $url = 'http://' . $config['domain'] . '/send_via_get/user_credit.php';
        // $url = 'http://robots.rahco.ir/api/proxy/send';
        $getUrl = $url . "?" . $data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            \Log::info('SMS Request Error:' . curl_error($ch));
            \Log::info($data);
        } else {
            return $response;
        }
        curl_close($ch);
    }


}


if (!function_exists('text_to_array')) {

    function text_to_array($str)
    {

        //Initialize arrays
        $keys = array();
        $values = array();
        $output = array();

        //Is it an array?
        if (substr($str, 0, 5) == 'Array') {

            //Let's parse it (hopefully it won't clash)
            $array_contents = substr($str, 7, -2);
            $array_contents = str_replace(array('[', ']', '=>'), array('#!#', '#?#', ''), $array_contents);
            $array_fields = explode("#!#", $array_contents);

            //For each array-field, we need to explode on the delimiters I've set and make it look funny.
            for ($i = 0; $i < count($array_fields); $i++) {

                //First run is glitched, so let's pass on that one.
                if ($i != 0) {

                    $bits = explode('#?#', $array_fields[$i]);
                    if ($bits[0] != '') $output[$bits[0]] = $bits[1];

                }
            }

            //Return the output.
            return $output;

        } else {

            //Duh, not an array.
            echo 'The given parameter is not an array.';
            return null;
        }

    }


}

if (!function_exists('deductionBlacklist')) {

    function deductionBlacklist(array $config)
    {
        $ch = curl_init();
        $data = http_build_query([
            'username' => $config['deduction_username'],
            'password' => $config['deduction_password'],

            'admin_unit_price' => env('SMS_ADMIN_UNIT_PRICE'),
            'user_unit_price' => env('SMS_USER_UNIT_PRICE'),

            'token' => 'rVW9HmLH41RjA5PywpuHGdfXODzbQo', // for api proxy on robots.rahco.ir
            'domain' => $config['deduction_domain'],
        ]);
        $url = 'http://' . $config['deduction_domain'] . '/send_via_get/cost_deduction.php';
        // $url = 'http://robots.rahco.ir/api/proxy/send';
        $getUrl = $url . "?" . $data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            \Log::info('SMS Request Error:' . curl_error($ch));
            \Log::info($data);
        } else {
            return $response;
        }
        curl_close($ch);
    }

}


if (!function_exists('smsGetCatList')) {

    function smsGetCatList(array $config)
    {
        $data = [
            'username' => $config['username'],
            'password' => $config['password'],


            'start' => '',
            'perpage' => '30',


            'order' => 'DESC', // '' , 'ASC' , 'DESC'
        ];
        $options = ['soap_defencoding' => 'UTF-8', 'decode_utf8' => false];
        $url = 'http://' . $config['domain'] . '/webservice/soap/smsService.php?wsdl';
        $s = new \SoapClient($url, $options);


        $response = $s->__soapCall("sms_get_cat_list", $data);


        if (is_soap_fault($response)) {

            return response()->json([
                'error' => 'is_soap_fault'
            ]);
        } else {

            return response()->json([
                'response' => collect($response)
            ]);
        }


    }
}
if (!function_exists('smsGetNumberInCat')) {

    function smsGetNumberInCat(array $config)
    {
        $data = [
            'username' => $config['username'],
            'password' => $config['password'],
            'catid' => $config['catId'],


            'start' => '',
            'perpage' => '30',


            'order' => 'DESC', // '' , 'ASC' , 'DESC'
        ];
        $options = ['soap_defencoding' => 'UTF-8', 'decode_utf8' => false];
        $url = 'http://' . $config['domain'] . '/webservice/soap/smsService.php?wsdl';
        $s = new \SoapClient($url, $options);


        $response = $s->__soapCall("sms_get_number_in_cat", $data);


        if (is_soap_fault($response)) {

            return response()->json([
                'error' => 'is_soap_fault'
            ]);
        } else {

            return response()->json([
                'response' => collect($response)
            ]);
        }


    }
}

if (!function_exists('addContactCategory')) {

    function addContactCategory(array $config)
    {
        $data = [
            'username' => $config['username'],
            'password' => $config['password'],
            'title' => [$config['title']],


            'start' => '',
            'perpage' => '30',


            'order' => 'DESC', // '' , 'ASC' , 'DESC'
        ];
        $options = ['soap_defencoding' => 'UTF-8', 'decode_utf8' => false];
        $url = 'http://' . $config['domain'] . '/webservice/soap/smsService.php?wsdl';
        $s = new \SoapClient($url, $options);


        $response = $s->__soapCall("user_add_cat", $data);


        if (is_soap_fault($response)) {

            return response()->json([
                'error' => 'is_soap_fault'
            ]);
        } else {
            return response()->json([
                'response' => collect($response)
            ]);
        }


    }
}


if (!function_exists('getSenderNumber')) {

    function getSenderNumber(array $config)
    {
        $data = [
            'username' => $config['username'],
            'password' => $config['password'],
            'start' => '',
            'perpage' => '30',
            'order' => 'DESC', // '' , 'ASC' , 'DESC'
        ];
        $options = ['soap_defencoding' => 'UTF-8', 'decode_utf8' => false];
        $url = 'http://' . $config['domain'] . '/webservice/soap/smsService.php?wsdl';
        $s = new \SoapClient($url, $options);


        $response = $s->__soapCall("get_number", $data);


        if (is_soap_fault($response)) {

            return response()->json([
                'error' => 'is_soap_fault'
            ]);
        } else {
            return response()->json([
                'response' => collect($response)
            ]);
        }


    }
}


if (!function_exists('addMobileToGroup')) {

    function addMobileToGroup(array $config)
    {
        $ch = curl_init();
        $data = http_build_query([
            'username' => $config['username'],
            'password' => $config['password'],
            'group' => $config['catId'],
            'fullname' => $config['fullName'],
            'mobile' => $config['mobile'],

            'token' => 'rVW9HmLH41RjA5PywpuHGdfXODzbQo', // for api proxy on robots.rahco.ir
            'domain' => $config['domain'],
        ]);
        $url = 'http://' . $config['domain'] . '/send_via_get/add_mobile_group.php';

        $getUrl = $url . "?" . $data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            \Log::info('SMS Request Error:' . curl_error($ch));
            \Log::info($data);
        } else {
            return $response;
        }

        curl_close($ch);
    }
}
if (!function_exists('sms')) {
    /**
     * send sms
     * @param string $mobile
     * @param string $message
     * @return integer sms id
     */
    function sms($mobile, $message)
    {
        $ch = curl_init();
        $data = http_build_query([
            'username' => env('SMS_USERNAME'),
            'password' => env('SMS_PASSWORD'),
            'sender_number' => env('SMS_SENDER_NUMBER'),
            'receiver_number' => $mobile,
            'note' => $message,
            'token' => 'rVW9HmLH41RjA5PywpuHGdfXODzbQo', // for api proxy on robots.rahco.ir
            'domain' => env('SMS_DOMAIN'),
        ]);

        $url = 'http://' . env('SMS_DOMAIN') . '/send_via_get/send_sms.php';
        // $url = 'http://robots.rahco.ir/api/proxy/send';
        $getUrl = $url . "?" . $data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            \Log::info('SMS Request Error:' . curl_error($ch));
            \Log::info($data);
        } else {
            return $response;
        }
        curl_close($ch);
    }


    /**
     * receive inbox sms
     * @param string $mobile
     * @param string $message
     * @return integer sms id
     */
    function receiveInbox(): \Illuminate\Http\JsonResponse
    {
        ///user:samaneh


        $data = [
            'username' => env('SMS_USERNAME'),
            'password' => env('SMS_PASSWORD'),

            'number' => env('SMS_SENDER_NUMBER'),
            'catid' => '',
            'start' => '',
            'perpage' => '10',
            'read' => '0', // '-1' , '0' , '1'

            'order' => 'DESC', // '' , 'ASC' , 'DESC'
        ];
        $options = ['soap_defencoding' => 'UTF-8', 'decode_utf8' => false];
        $url = 'http://' . env('SMS_DOMAIN') . '/webservice/soap/smsService.php?wsdl';
        $s = new \SoapClient($url, $options);


        $response = $s->__soapCall("sms_receive", $data);


        if (is_soap_fault($response)) {

            return response()->json([
                'error' => 'is_soap_fault'
            ]);
        } else {

            return response()->json([
                'response' => $response
            ]);
        }

    }

    function sendSms(string $receiver_number, string $note): \Illuminate\Http\JsonResponse
    {
        ///user:samaneh


        $data = [
            'username' => env('SMS_USERNAME'),
            'password' => env('SMS_PASSWORD'),


            'sender_number' => [env('SMS_SENDER_NUMBER')],
            'receiver_number' => [$receiver_number],
            'note' => [$note],
            'date' => ['0'],
            'request_uniqueid' => ['13'],
            'flash' => 'no',
            'onlysend' => 'ok',
        ];
        $options = ['soap_defencoding' => 'UTF-8', 'decode_utf8' => false];
        $url = 'http://' . env('SMS_DOMAIN') . '/webservice/soap/smsService.php?wsdl';
        $s = new \SoapClient($url, $options);


        $response = $s->__soapCall("send_sms", $data);


        if (is_soap_fault($response)) {

            return response()->json([
                'error' => 'is_soap_fault'
            ]);
        } else {
            return response()->json([
                'response' => $response
            ]);
        }
    }

    function smsChangeToRead(string $id): \Illuminate\Http\JsonResponse
    {

        $data = [
            'username' => env('SMS_USERNAME'),
            'password' => env('SMS_PASSWORD'),

//            'number' => env('SMS_SENDER_NUMBER'),
            'id' => [(int)$id],
            'read' => 1,
        ];
        $options = ['soap_defencoding' => 'UTF-8', 'decode_utf8' => false];
        $url = 'http://' . env('SMS_DOMAIN') . '/webservice/soap/smsService.php?wsdl';
        $s = new \SoapClient($url, $options);


        $response = $s->__soapCall("sms_receive_change_read", $data);


        if (is_soap_fault($response)) {

            return response()->json([
                'error' => 'is_soap_fault'
            ]);
        } else {

            return response()->json([
                'response' => $response
            ]);
        }

    }

    /**
     * Convert Persian/Arabic numbers to English numbers.
     *
     * @param String $string
     * @return String
     */
    function to_english_numbers(string $string): string
    {

        $persinaDigits1 = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $persinaDigits2 = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $allPersianDigits = array_merge($persinaDigits1, $persinaDigits2);
        $replaces = [...range(0, 9), ...range(0, 9)];

        return str_replace($allPersianDigits, $replaces, trim($string));
    }
}

if (! function_exists('array_prepend')) {
    /**
     * Push an item onto the beginning of an array.
     *
     * @param  array  $array
     * @param  mixed  $value
     * @param  mixed  $key
     * @return array
     */
    function array_prepend($array, $value, $key = null)
    {
        return Arr::prepend($array, $value, $key);
    }
}

if (! function_exists('now_fa')) {

    function now_fa($format='Y-m-d H:m:s')
    {
        return Jalalian::fromDateTime(now())->format($format);
    }
}

if (! function_exists('time_fa')) {

    function time_fa($time,$format='Y-m-d H:m:s')
    {
        return Jalalian::fromDateTime($time)->format($format);
    }
}
