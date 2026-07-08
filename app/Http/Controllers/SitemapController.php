<?php

namespace App\Http\Controllers;

/**
 * XML sitemap of the public, indexable pages (served at /sitemap.xml).
 */
class SitemapController extends Controller
{
    public function index()
    {
        $urls = [
            ['loc' => route('home'),          'priority' => '1.0', 'freq' => 'weekly'],
            ['loc' => route('quote'),         'priority' => '0.9', 'freq' => 'monthly'],
            ['loc' => route('simulator'),     'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => route('list-hospitals'),'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => route('track.form'),    'priority' => '0.6', 'freq' => 'monthly'],
            ['loc' => route('assistant.form'),'priority' => '0.6', 'freq' => 'monthly'],
            ['loc' => route('faq'),           'priority' => '0.6', 'freq' => 'monthly'],
            ['loc' => route('contact.form'),  'priority' => '0.5', 'freq' => 'yearly'],
            ['loc' => route('cgu'),           'priority' => '0.3', 'freq' => 'yearly'],
            ['loc' => route('pc'),            'priority' => '0.3', 'freq' => 'yearly'],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            $xml .= "  <url>\n"
                . '    <loc>' . e($u['loc']) . "</loc>\n"
                . '    <changefreq>' . $u['freq'] . "</changefreq>\n"
                . '    <priority>' . $u['priority'] . "</priority>\n"
                . "  </url>\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
