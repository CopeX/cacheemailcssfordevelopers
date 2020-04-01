<?php


namespace CopeX\CacheEmailCssForDevelopers\Plugin\Magento\Email\Model\Template;

use Magento\Framework\App\CacheInterface;
/**
 * Class Filter
 *
 * @package CopeX\CacheEmailCssForDevelopers\Plugin\Magento\Email\Model\TemplateContent
 */
class Filter
{


    /** @var \Magento\Framework\App\CacheInterface */
    protected $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function aroundGetCssFilesContent(
        \Magento\Email\Model\Template\Filter $subject,
        \Closure $proceed,
        array $files
    ) {
        $cacheKey = "EMAIL_FILTER_" . implode("_", $files);
        if (!$css = $this->cache->load($cacheKey)) {
            $css = $proceed($files);
            $this->cache->save($css, $cacheKey, ["config"]);
        }
        return $css;
    }
}

