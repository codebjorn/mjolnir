<?php

namespace Mjolnir\Content;

use Mjolnir\Abstracts\AbstractCustomContent;

class Taxonomy extends AbstractCustomContent
{
    private $postTypes = [];

    /**
     * @param string $name
     * @param array $arguments
     */
    public function __construct(string $name, array $arguments = [])
    {
        parent::__construct($name, $arguments);
        $uName = ucfirst($this->name);
        $this->arguments = $arguments ?: [
            'labels' => [
                'name' => _x($uName, 'taxonomy general name', 'app'),
                'singular_name' => _x($uName, 'taxonomy singular name', 'app'),
                'search_items' => __('Search ' . $uName, 'app'),
                'all_items' => __('All ' . $uName, 'app'),
                'parent_item' => __('Parent ' . $uName, 'app'),
                'parent_item_colon' => __('Parent: ' . $uName, 'app'),
                'edit_item' => __('Edit ' . $uName, 'app'),
                'update_item' => __('Update ' . $uName, 'app'),
                'add_new_item' => __('Add New ' . $uName, 'app'),
                'new_item_name' => __('New Genre ' . $uName, 'app'),
                'menu_name' => __($uName, 'app'),
            ],
            'public' => true
        ];
    }

    /**
     * @return void
     */
    public function register()
    {
        register_taxonomy($this->name, $this->postTypes ?? ['post'], $this->arguments);
    }

    /**
     * @param array $postTypes
     * @return $this
     */
    public function postTypes(array $postTypes)
    {
        $this->postTypes = $postTypes;
        return $this;
    }

    /**
     * @param bool $show
     * @return $this
     */
    public function showTagCloud(bool $show = true): Taxonomy
    {
        $this->setArgument('show_tagcloud', $show);
        return $this;
    }

    /**
     * @param bool $show
     * @return $this
     */
    public function showInQuickEdit(bool $show = true): Taxonomy
    {
        $this->setArgument('show_in_quick_edit', $show);
        return $this;
    }

    /**
     * @param bool $show
     * @return $this
     */
    public function showAdminColumn(bool $show = false): Taxonomy
    {
        $this->setArgument('show_admin_column', $show);
        return $this;
    }

    /**
     * @param $metabox
     * @return $this
     */
    public function metabox($metabox): Taxonomy
    {
        $this->setArgument('meta_box_cb', $metabox);
        return $this;
    }

    /**
     * @param $metabox
     * @return $this
     */
    public function metaboxSanitize($metabox): Taxonomy
    {
        $this->setArgument('meta_box_sanitize_cb', $metabox);
        return $this;
    }

    /**
     * @param array $capabilities
     * @return $this
     */
    public function capabilities(array $capabilities): Taxonomy
    {
        $this->setArgument('capabilities', $capabilities);
        return $this;
    }

    /**
     * @param $term
     * @return $this
     */
    public function defaultTerm($term): Taxonomy
    {
        $this->setArgument('default_term', $term);
        return $this;
    }

}
