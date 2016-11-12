<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    private $user; // 用户信息


    /**
     * 根据传入的id获取用户信息
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function userInfo($user_id){
        $this->user = self::find($user_id);
    }

    /**
     * 用户所发布的链接
     * @return [type] [description]
     */
    public function linkData(){
      return $this->hasMany('App\Model\Link', 'user_id', 'id');
    }

    public function link_collections(){
        return $this->belongsToMany('App\Model\Link', 'user_link_collections');
    }


    /**
     * 链接是否已经被用户收藏
     * @param  [type]  $link_id [要测试的链接id]
     * @return boolean          [返回值,bool类型]
     */
    public function isLinkCollection($link_id){
        // return $this->link_collections()->where('link_id', 2)->first();

        if ($this->link_collections()->where('link_id', $link_id)->first() == null){
            return false; // 未收藏
        } else {
            return true;
        }
    }

    public static function getAvatarPath($userId,$size='big',$ext='jpg')
    {
        $avatarDir = self::getAvatarDir($userId);
        $avatarFileName = self::getAvatarFileName($userId,$size);
        return $avatarDir.'/'.$avatarFileName.'.'.$ext;
    }

    /**
     * 获取用户头像存储目录
     * @param $user_id
     * @return string
     */
    public static function getAvatarDir($userId,$rootPath='avatars')
    {
        $userId = sprintf("%09d", $userId);
        return $rootPath.'/'.substr($userId, 0, 3) . '/' . substr($userId, 3, 2) . '/' . substr($userId, 5, 2);
    }

    /**
     * 获取头像文件命名
     * @param string $size
     * @return mixed
     */
    public static function getAvatarFileName($userId,$size='big')
    {
        $avatarNames = [
            'small'=>'user_small_'.$userId,
            'middle'=>'user_middle_'.$userId,
            'big'=>'user_big_'.$userId,
            'origin'=>'user_origin_'.$userId
        ];
       return $avatarNames[$size];
    }

}
