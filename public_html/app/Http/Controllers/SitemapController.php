<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
      // create sitemap
      $sitemap = App::make("sitemap");

      // set cache
      $sitemap->setCache('laravel.sitemap-index', 60);

      // add sitemaps (loc, lastmod (optional))
      $sitemap->addSitemap(URL::to('sitemap-categories'));
      $sitemap->addSitemap(URL::to('sitemap-articles'));
      $sitemap->addSitemap(URL::to('sitemap-attachment'));

      // show sitemap
      return $sitemap->render('sitemapindex');

    }

    public function categories()
    {
      // create sitemap
      $sitemap_categories = App::make("sitemap");

      // set cache
      $sitemap_categories->setCache('laravel.sitemap-categories', 60);

      // add items
      $categories = Category::whereAddedMenu('В меню')->orderBy('created_at', 'desc')->get();

      foreach ($categories as $category)
      {
          $images = [];

          if($category->articles->isNotEmpty()) {

            foreach($category->articles as $article) {

              $images[] = [
                'url' => URL::to('public/storage') . '/' . $article->img_prew_path,
              ];
            }
          }
          $images[] = [
            'url' => URL::to('public/storage') . '/' . $category->img_path,
          ];
          $sitemap_categories->add(URL::to('category').'/'.$category->id, $category->updated_at, '0.5', 'weekly', $images);
      }

      // show sitemap
      return $sitemap_categories->render('xml');

    }

    public function articles()
    {
      // create new sitemap object
    	$sitemap = App::make('sitemap');

    	$sitemap->setCache('laravel.sitemap-articles', 60);

    	if (!$sitemap->isCached()) {
    		// add item to the sitemap (url, date, priority, freq)
    		$sitemap->add(URL::to('/'), '2018-08-25T20:10:00+02:00', '1.0', 'daily');
    		// get all posts from db
    		$articles = DB::table('articles')->wherePublished('Опубликована')->orderBy('created_at', 'desc')->get();

        $img_pattern = '/<img[^>]+>/i';
        $src_pattern = '/(src|alt|title)=("[^"]*")/i';
    		// add every post to the sitemap
    		foreach ($articles as $article) {

          $img = [];
          $result = [];

          preg_match_all($img_pattern, $article->content, $images);

          if($images) {

            foreach($images[0] as $image) {

              preg_match_all($src_pattern, $image, $img[$image]);

              $result[] = [
                'url' => trim($img[$image][2][1], '"'),
                'title' => $img[$image][2][0],
              ];
            }
          }
    			$sitemap->add(URL::to('article').'/'.$article->id, $article->updated_at, '0.5', 'weekly', $result);
    		}
    	}
    	return $sitemap->render('xml');
    }

    public function attachment()
    {
      $sitemap = App::make('sitemap');

      $sitemap->setCache('laravel.sitemap-attachment', 60);

      if(!$sitemap->isCached()) {

        $articles = Article::wherePublished('Опубликована')->orderBy('updated_at', 'desc')->get();

        $img_pattern = '/<img[^>]+>/i';
        $src_pattern = '/(src|alt|title)=("[^"]*")/i';

        if(isset($articles) && $articles->isNotEmpty()) {

          foreach ($articles as $article) {

            $img = [];

            preg_match_all($img_pattern, $article->content, $images);

            if($images) {

              foreach($images[0] as $image) {

                preg_match_all($src_pattern, $image, $img[$image]);

                $sitemap->add(URL::to('attachment') . '/' . $article->id . '/' . trim($img[$image][2][1], '"'), $article->updated_at, '0.5', 'weekly');
              }
            }
          }
        }
      }
      return $sitemap->render('xml');
    }

}
