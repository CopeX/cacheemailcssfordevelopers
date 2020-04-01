<?php

namespace CopeX\CacheEmailCssForDevelopers\Plugin\Magento\Email\Model\Template;

use Magento\Framework\App\CacheInterface;
use Magento\Framework\App\State;

/**
 * Class Filter
 * @package CopeX\CacheEmailCssForDevelopers\Plugin\Magento\Email\Model\TemplateContent
 */
class Filter
{

    /** @var CacheInterface */
    protected $cache;
    /**
     * @var State
     */
    protected $state;

    /**
     * Filter constructor.
     * @param State          $state
     * @param CacheInterface $cache
     */
    public function __construct(State $state, CacheInterface $cache)
    {
        $this->state = $state;
        $this->cache = $cache;
    }

    /**
     * @param \Magento\Email\Model\Template\Filter $subject
     * @param \Closure                             $proceed
     * @param array                                $files
     * @return string
     */
    public function aroundGetCssFilesContent(
        \Magento\Email\Model\Template\Filter $subject,
        \Closure $proceed,
        array $files
    ) {
        if ($this->state->getMode() !== State::MODE_PRODUCTION) {
            $cacheKey = "EMAIL_FILTER_" . implode("_", $files);
            if (!$css = $this->cache->load($cacheKey)) {
                $css = $proceed($files);
                $this->cache->save($css, $cacheKey, ["config"]);
            }
        } else {
            $css = $proceed($files);
        }
        return $css;
    }
}

