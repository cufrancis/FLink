<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function website(Request $request) {
        // 表单验证
        $validateRules = [
            'website_name'  =>  'required|max:128',
            'website_url'   =>  'required',
            'website_icp'   =>  'sometimes|max:128',
            'website_admin_email'   =>  'required|email',
        ];
        
        $themes = [];
        // 从文件夹中获取所有模板
        $themePath = base_path(). "/resources/views/themes";
        if ($dh = opendir($themePath)) {
            while (($file = readdir($dh)) !== false) {
                $themes[] = $file;
            }
        }
        closedir($dh);
        // 删除多余的数据，例如. ..等
        for ($x=0; $x < count($themes); $x++) { 
            if ($themes[$x] == ".." || $themes[$x] == '.')
                unset($themes[$x]);
        }
        $themes = array_values($themes);
        
        // 处理表单提交的值
        if ($request->isMethod('post')) {
            $this->validate($request, $validateRules);
            $data = $request->except('_token');
            foreach($data as $name=>$value) {
                Setting()->set($name, $value);
            }
            Setting()->clearAll();
            return $this->success(route('admin.setting.website'), '站点设置成功');
        }
        
        return view('adminTheme::setting.website')->with('themes', $themes);
    }
    
    public function time(Request $request) {
        $timeOffsets = [
            '-12' => '(标准时-12:00) 日界线西',
            '-11' => '(标准时-11:00) 中途岛、萨摩亚群岛',
            '-10' => '(标准时-10:00) 夏威夷',
            '-9' => '(标准时-9:00) 阿拉斯加',
            '-8' => '(标准时-8:00) 太平洋时间(美国和加拿大)',
            '-7' => '(标准时-7:00) 山地时间(美国和加拿大)',
            '-6' => '(标准时-6:00) 中部时间(美国和加拿大)、墨西哥城',
            '-5' => '(标准时-5:00) 东部时间(美国和加拿大)、波哥大',
            '-4' => '(标准时-4:00) 大西洋时间(加拿大)、加拉加斯',
            '-3.5' => '(标准时-3:30) 纽芬兰',
            '-3' => '(标准时-3:00) 巴西、布宜诺斯艾利斯、乔治敦',
            '-2' => '(标准时-2:00) 中大西洋',
            '-1' => '(标准时-1:00) 亚速尔群岛、佛得角群岛',
            '0' => '(格林尼治标准时) 西欧时间、伦敦、卡萨布兰卡',
            '1' => '(标准时+1:00) 中欧时间、安哥拉、利比亚',
            '2' => '(标准时+2:00) 东欧时间、开罗，雅典',
            '3' => '(标准时+3:00) 巴格达、科威特、莫斯科',
            '3.5' => '(标准时+3:30) 德黑兰',
            '4' => '(标准时+4:00) 阿布扎比、马斯喀特、巴库',
            '4.5' => '(标准时+4:30) 喀布尔',
            '5' => '(标准时+5:00) 叶卡捷琳堡、伊斯兰堡、卡拉奇',
            '5.5' => '(标准时+5:30) 孟买、加尔各答、新德里',
            '6' => '(标准时+6:00) 阿拉木图、 达卡、新亚伯利亚',
            '7' => '(标准时+7:00) 曼谷、河内、雅加达',
            '8' => '(标准时+8:00)北京、重庆、香港、新加坡',
            '9' => '(标准时+9:00) 东京、汉城、大阪、雅库茨克',
            '9.5' => '(标准时+9:30) 阿德莱德、达尔文',
            '10' => '(标准时+10:00) 悉尼、关岛',
            '11' => '(标准时+11:00) 马加丹、索罗门群岛',
            '12' => '(标准时+12:00) 奥克兰、惠灵顿、堪察加半岛'
        ];
        $validateRules = [
            'time_diff' =>  'integer',
        ];
        
        // 处理表单提交的数据
        if ($request->isMethod('post')) {
            $this->validate($request, $validateRules);
            $data = $request->except('_token');
            foreach ($data as $name=>$value)Setting()->set($name, $value);
            Setting()->clearAll();
            
            return $this->success(route('admin.setting.time'), '时间设置成功');
        }
        return view('adminTheme::setting.time')->with(compact('timeOffsets'));
    }
}
