<?php
/**
 * Created by PhpStorm.
 * User: zhouribin
 * Date: 2019-01-23
 * Time: 13:58
 */

namespace App\Services;


use App\Exceptions\ServiceException;
use Creativeorange\Gravatar\Facades\Gravatar;

class GravatarService
{
    const AVATAR_TYPE_DEFAULT = 'mp';
    const AVATAR_TYPE_KALEIDOSCOPE = 'identicon';
    const AVATAR_TYPE_MONSTER = 'monsterid';
    const AVATAR_TYPE_FACE = 'wavatar';
    const AVATAR_TYPE_RETRO = 'retro';
    const AVATAR_TYPE_ROBOT = 'robohash';
    const AVATAR_TYPE_BLANK = 'blank';

    const AVATAR_TYPE_MAP = [
        "default"      => self::AVATAR_TYPE_DEFAULT,
        "kaleidoscope" => self::AVATAR_TYPE_KALEIDOSCOPE,
        "monster"      => self::AVATAR_TYPE_MONSTER,
        "face"         => self::AVATAR_TYPE_FACE,
        "retro"        => self::AVATAR_TYPE_RETRO,
        "robot"        => self::AVATAR_TYPE_ROBOT,
        "blank"        => self::AVATAR_TYPE_BLANK,
    ];

    /**
     * 获取Gravatar头像
     * @param $email
     * @param string $type
     * @param int $size
     * @return string
     * @throws ServiceException
     */
    public function getAvatar($email, $type = 'monster', $size = 200)
    {
        if (empty($email)) {
            throw new ServiceException("错误的邮箱地址");
        }

        if (!isset(self::AVATAR_TYPE_MAP[$type])) {
            throw new ServiceException("错误的头像类型");
        }

        if ($size < 30) {
            throw new ServiceException("头像像素不可以小于30");
        }

        $avatarType = self::AVATAR_TYPE_MAP[$type];

        $avatarUrl = Gravatar::get($email,
            [
                'size'           => $size,//大小px
                'fallback'       => $avatarType,//默认头像类型
                'secure'         => true,
                'maximumRating'  => 'g',
                'forceDefault'   => true,//是否使用默认头像 false会优先使用已经在gravatar上注册的账号头像
                'forceExtension' => 'jpg',//图片格式
            ]);

        return $avatarUrl;
    }
}