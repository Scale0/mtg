<?php

namespace MtgBundle\Twig;

class MtgSymbolExtension extends \Twig_Extension
{
    const IMG_PATH = '/images/symbols/mana/';

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('symbol', [$this, 'parseSymbol'], ['is_safe' => ['html']])
        ];
    }

    public function parseSymbol($str)
    {
        $str = preg_replace(
            "/{(.*?)}/",
            "<img class=\"symbol\" src=\"" . self::IMG_PATH . "$1.svg\">",
            $str
        );
        $str = str_replace('
', '<br />', $str);
        return $str;
    }

    public function getName()
    {
        return 'mtg_Symbol';
    }
}
