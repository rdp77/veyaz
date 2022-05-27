<?php

namespace App\Http\Traits;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Str;

trait SeoTrait
{
    public function getSeo()
    {
        // General Seo Tag
        SEOMeta::setTitle('asdad')
            ->setDescription('adsada')
            ->setKeywords('sadasda')
            ->addMeta('google-site-verification', 'asdsada')
            ->addMeta('msvalidate.01', 'asdsada')
            ->addMeta('yandex-verification', 'asdsada')
            ->addMeta('dmca-site-verification', 'asdsada')
            ->setCanonical(
                Str::startsWith($current = url()->full(), 'https://www') ?
                    str_replace('https://www.', 'https://', $current) :
                    str_replace('https://', 'https://www.', $current)
            );

        // SEOMeta::addAlternateLanguage($lang, $url);
        // SEOMeta::addAlternateLanguages(array $languages);



        SEOTools::addImages('google.com/images/image.jpg');
        OpenGraph::setDescription('This is my page description');
        OpenGraph::setTitle('Home');
        OpenGraph::setUrl('http://current.url.com');
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle('Homepage');
        TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle('Homepage');
        JsonLd::setDescription('This is my page description');
    }
}