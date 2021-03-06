<?php
/**
 * Generated by Haxe 4.0.0 (git build development @ da28365)
 * Haxe source file: /Users/ut/Documents/LAB/ufront-mvc/src/ufront/web/url/filter/UFUrlFilter.hx
 */

namespace ufront\web\url\filter;

use \ufront\web\url\VirtualUrl;
use \php\Boot;
use \ufront\web\url\PartialUrl;
use \php\_Boot\HxAnon;

/**
 * Interface for defining new Url filters.
 * These filters are used in `HttpContext.getRequestUri()` and `HttpContext.generateUri()`.
 */
interface UFUrlFilter {
	/**
	 * Filter a raw URI from the web server into a normalized state for our web app to handle.
	 * For example:
	 * - Changing `index.n/home/` to `/home/` (as in `PathInfoUrlFilter`).
	 * - Changing `/path/to/app/item/34/` to `/item/34/` (as in `DirectoryUrlFilter`).
	 * 
	 * @param PartialUrl $url
	 * 
	 * @return void
	 */
	public function filterIn ($url) ;


	/**
	 * Transform a normalized URI from the app into a raw URI that fits the current server environment.
	 * For example:
	 * - Changing `/home/` to `index.n/home/` (as in `PathInfoUrlFilter`).
	 * - Changing `/item/34/` to `/path/to/app/item/34/` (as in `DirectoryUrlFilter`).
	 * 
	 * @param VirtualUrl $url
	 * 
	 * @return void
	 */
	public function filterOut ($url) ;
}


Boot::registerClass(UFUrlFilter::class, 'ufront.web.url.filter.UFUrlFilter');
Boot::registerMeta(UFUrlFilter::class, new HxAnon(["obj" => new HxAnon(["interface" => null])]));
