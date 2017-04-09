<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package Gallery Creator
 * @link    http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */

namespace Markocupic;


/**
 * Provide methods to rotate Images.
 *
 * @author Marko Cupic <https://github.com/markocupic>
 */
class RotateImage extends \Backend
{


    /**
     * Rotate an image clockwise by 90°
     * @return bool
     */
    public function rotateImage()
    {
        $src = TL_ROOT . '/' . \Input::get('id');

        if (!is_file($src))
        {
            return false;
        }

        $objFile = new \File(\Input::get('id'));
        if (!$objFile->isGdImage)
        {
            return false;
        }

        $angle = 270;

        if (!function_exists('imagerotate'))
        {
            return false;
        }

        $source = imagecreatefromjpeg($src);

        //rotate
        $imgTmp = imagerotate($source, $angle, 0);

        // Output
        imagejpeg($imgTmp, $src);
        imagedestroy($source);

        $this->redirect($this->getReferer());

    }

}

