<?php
/**
 * Site Meta Information
 * 
 * A simple utility class to manage site metadata and generate description text.
 */

class SiteMeta {
    /**
     * @var array Stores the metadata for the site
     */
    private $metaData;

    /**
     * Constructor initializes default metadata
     */
    public function __construct() {
        $this->metaData = [
            'site_name' => 'NineYou Platform',
            'domain' => 'https://panel-9y.com',
            'keywords' => ['九游', 'gaming', 'entertainment', 'online'],
            'description' => 'A platform for diverse entertainment experiences.',
            'author' => 'System Admin',
            'version' => '1.0.0',
            'language' => 'zh-CN',
            'charset' => 'UTF-8'
        ];
    }

    /**
     * Set a specific metadata field
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setMeta($key, $value) {
        $this->metaData[$key] = $value;
    }

    /**
     * Get a specific metadata field
     *
     * @param string $key
     * @return mixed|null
     */
    public function getMeta($key) {
        return isset($this->metaData[$key]) ? $this->metaData[$key] : null;
    }

    /**
     * Get all metadata as an array
     *
     * @return array
     */
    public function getAllMeta() {
        return $this->metaData;
    }

    /**
     * Generate a brief description text from the metadata
     *
     * @return string
     */
    public function generateDescription() {
        $name = htmlspecialchars($this->metaData['site_name'], ENT_QUOTES, 'UTF-8');
        $domain = htmlspecialchars($this->metaData['domain'], ENT_QUOTES, 'UTF-8');
        $keywords = implode(', ', array_map(function($kw) {
            return htmlspecialchars($kw, ENT_QUOTES, 'UTF-8');
        }, $this->metaData['keywords']));
        $desc = htmlspecialchars($this->metaData['description'], ENT_QUOTES, 'UTF-8');

        return "Welcome to {$name} ({$domain}). Keywords: {$keywords}. {$desc}";
    }

    /**
     * Generate a short text snippet for social media or SEO
     *
     * @param int $maxLength Maximum characters for the snippet
     * @return string
     */
    public function getShortSnippet($maxLength = 160) {
        $fullText = $this->generateDescription();
        if (mb_strlen($fullText, 'UTF-8') <= $maxLength) {
            return $fullText;
        }
        $snippet = mb_substr($fullText, 0, $maxLength - 3, 'UTF-8');
        return $snippet . '...';
    }

    /**
     * Override toString to output description text
     *
     * @return string
     */
    public function __toString() {
        return $this->generateDescription();
    }
}

// Example usage
$siteMeta = new SiteMeta();

// Customize with specific data
$siteMeta->setMeta('site_name', '九游娱乐');
$siteMeta->setMeta('keywords', ['九游', 'game', 'fun', 'online platform']);

// Output generated description
echo $siteMeta->generateDescription() . "\n";

// Short snippet for social media
echo $siteMeta->getShortSnippet(100) . "\n";

// Display all metadata as JSON for debugging
echo json_encode($siteMeta->getAllMeta(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";