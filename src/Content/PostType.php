<?php

namespace Mjolnir\Content;

use Mjolnir\Abstracts\AbstractCustomContent;

class PostType extends AbstractCustomContent
{

    /**
     * @param string $name
     * @param array $arguments
     */
    public function __construct(string $name, array $arguments = [])
    {
        parent::__construct($name, $arguments);
        $this->arguments = $arguments ?: [
            'label' => ucfirst($name),
            'public' => true
        ];
    }

    /**
     * @return void
     */
    public function register()
    {
        register_post_type($this->name, $this->arguments);
    }

    /**
     * @param string $label
     * @return $this
     */
    public function label(string $label): PostType
    {
        $this->setArgument('label', $label);
        return $this;
    }

    /**
     * @param int $position
     * @return $this
     */
    public function menuPosition(int $position = 5): PostType
    {
        $this->setArgument('menu_position', $position);
        return $this;
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function menuIcon(string $icon): PostType
    {
        $this->setArgument('icon', $icon);
        return $this;
    }

    /**
     * @param array|string[] $supports
     * @return $this
     */
    public function supports(array $supports = ['title']): PostType
    {
        $this->setArgument('supports', $supports);
        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function registerMetabox(callable $callback): PostType
    {
        $this->setArgument('register_meta_box_cb', $callback);
        return $this;
    }

    /**
     * @param array $taxonomies
     * @return $this
     */
    public function taxonomies(array $taxonomies): PostType
    {
        $this->setArgument('taxonomies', $taxonomies);
        return $this;
    }

    /**
     * @param bool $hasArchive
     * @return $this
     */
    public function hasArchive(bool $hasArchive = true): PostType
    {
        $this->setArgument('has_archive', $hasArchive);
        return $this;
    }

}
