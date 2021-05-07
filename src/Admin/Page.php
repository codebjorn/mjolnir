<?php

namespace Mjolnir\Admin;

class Page
{
    /**
     * @param string $parentSlug
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param string|callable $function
     * @param int|null $position
     */
    public static function submenu(string $parentSlug, string $pageTitle, string $menuTitle, string $capability, string $menuSlug, $function = '', int $position = null) {
        add_submenu_page($parentSlug, $pageTitle, $menuTitle, $capability, $menuSlug, $function, $position);
    }

    /**
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param string|callable $function
     * @param int|null $position
     */
    public static function management(string $pageTitle, string $menuTitle, string $capability, string $menuSlug, $function = '', int $position = null) {
        add_management_page($pageTitle, $menuTitle, $capability, $menuSlug, $function, $position);
    }

    /**
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param string|callable $function
     * @param int|null $position
     */
    public static function options(string $pageTitle, string $menuTitle, string $capability, string $menuSlug, $function = '', int $position = null) {
        add_options_page($pageTitle, $menuTitle, $capability, $menuSlug, $function, $position);
    }

    /**
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param string|callable $function
     * @param int|null $position
     */
    public static function theme(string $pageTitle, string $menuTitle, string $capability, string $menuSlug, $function = '', int $position = null) {
        add_theme_page($pageTitle, $menuTitle, $capability, $menuSlug, $function, $position);
    }

    /**
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param string|callable $function
     * @param int|null $position
     */
    public static function plugins(string $pageTitle, string $menuTitle, string $capability, string $menuSlug, $function = '', int $position = null) {
        add_plugins_page($pageTitle, $menuTitle, $capability, $menuSlug, $function, $position);
    }

    /**
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param string|callable $function
     * @param int|null $position
     */
    public static function users(string $pageTitle, string $menuTitle, string $capability, string $menuSlug, $function = '', int $position = null) {
        add_users_page($pageTitle, $menuTitle, $capability, $menuSlug, $function, $position);
    }

    /**
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param string|callable $function
     * @param int|null $position
     */
    public static function dashboard(string $pageTitle, string $menuTitle, string $capability, string $menuSlug, $function = '', int $position = null) {
        add_dashboard_page($pageTitle, $menuTitle, $capability, $menuSlug, $function, $position);
    }

    /**
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param string|callable $function
     * @param int|null $position
     */
    public static function posts(string $pageTitle, string $menuTitle, string $capability, string $menuSlug, $function = '', int $position = null) {
        add_posts_page($pageTitle, $menuTitle, $capability, $menuSlug, $function, $position);
    }

    /**
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param string|callable $function
     * @param int|null $position
     */
    public static function links(string $pageTitle, string $menuTitle, string $capability, string $menuSlug, $function = '', int $position = null) {
        add_links_page($pageTitle, $menuTitle, $capability, $menuSlug, $function, $position);
    }

    /**
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param string|callable $function
     * @param int|null $position
     */
    public static function pages(string $pageTitle, string $menuTitle, string $capability, string $menuSlug, $function = '', int $position = null) {
        add_pages_page($pageTitle, $menuTitle, $capability, $menuSlug, $function, $position);
    }

    /**
     * @param string $pageTitle
     * @param string $menuTitle
     * @param string $capability
     * @param string $menuSlug
     * @param string|callable $function
     * @param int|null $position
     */
    public static function comments(string $pageTitle, string $menuTitle, string $capability, string $menuSlug, $function = '', int $position = null) {
        add_comments_page($pageTitle, $menuTitle, $capability, $menuSlug, $function, $position);
    }

    /**
     * @param string $menuSlug
     * @return array|false
     */
    public static function remove(string $menuSlug) {
        return remove_menu_page($menuSlug);
    }

    /**
     * @param string $menuSlug
     * @param string $submenuSlug
     */
    public static function removeSub(string $menuSlug, string $submenuSlug) {
        remove_submenu_page($menuSlug, $submenuSlug);
    }
}
