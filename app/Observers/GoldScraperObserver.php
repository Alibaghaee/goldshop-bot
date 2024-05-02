<?php

namespace App\Observers;

use DOMDocument;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\DomCrawler\Crawler;
use Spatie\Crawler\CrawlObservers\CrawlObserver;

class GoldScraperObserver extends CrawlObserver
{

    private $content;

    public function __construct()
    {
        $this->content = null;
    }

    /*
     * Called when the crawler will crawl the url.
     */
    public function willCrawl(UriInterface $url, ?string $linkText): void
    {
        info('willCrawl', ['url' => $url]);
    }

    /*
     * Called when the crawler has crawled the given url successfully.
     */
    public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText = null,
    ): void {
        info("Crawled: {$url}");

        $crawler = new Crawler($response->getBody());

        $tableHtml = collect($crawler->filter('table > tbody > tr'))

            ->each(function ( $tr, $i) {


                collect($tr->childNodes)->each(function ($i){

                    if (!ctype_space($i->nodeValue) && trim($i->nodeValue) !=='—'){

                        info(trim($i->nodeValue));
                    }
                });
              if (str_contains($tr->nodeValue,'طلای ۱۸ عیار' ) ){

//                  dd($tr->nodeValue);
              }
            })->filter()->values();



    }

    /*
     * Called when the crawler had a problem crawling the given url.
     */
    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText = null,
    ): void {
        Log::error("Failed: {$url}");
    }

    /*
     * Called when the crawl has ended.
     */
    public function finishedCrawling(): void
    {
        info("Finished crawling");
    }
}
