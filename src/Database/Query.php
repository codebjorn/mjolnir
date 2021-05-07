<?php

namespace Mjolnir\Database;

use ReflectionException;
use Mjolnir\Abstracts\AbstractQuery;
use Mjolnir\Database\Parameter\Author;
use Mjolnir\Database\Parameter\Category;
use Mjolnir\Database\Parameter\Comment;
use Mjolnir\Database\Parameter\Date;
use Mjolnir\Database\Parameter\Fields;
use Mjolnir\Database\Parameter\Meta;
use Mjolnir\Database\Parameter\Order;
use Mjolnir\Database\Parameter\Pagination;
use Mjolnir\Database\Parameter\Password;
use Mjolnir\Database\Parameter\PostAndPage;
use Mjolnir\Database\Parameter\PostStatus;
use Mjolnir\Database\Parameter\PostType;
use Mjolnir\Database\Parameter\Search;
use Mjolnir\Database\Parameter\Tag;
use Mjolnir\Database\Parameter\Tax;
use Mjolnir\Support\Collection;
use WP_Post;
use WP_Query;

class Query extends AbstractQuery
{

    /**
     * @return WP_Query
     */
    public function make(): WP_Query
    {
        return new WP_Query($this->arguments);
    }

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return new Collection($this->make()->get_posts());
    }

    /**
     * @return int[]|WP_Post[]
     */
    public function getRaw()
    {
        return $this->make()->get_posts();
    }

    /**
     * @param null|Author|string $author
     * @param string|null $author_name
     * @param array|null $author__in
     * @param array|null $author__not_in
     * @return $this
     * @throws ReflectionException
     */
    public function author($author = null, string $author_name = null, array $author__in = null, array $author__not_in = null): Query
    {
        $this->updateArgs(Author::class, $author, $author_name, $author__in, $author__not_in);
        return $this;
    }

    /**
     * @param null|Category|string $cat
     * @param string|null $category_name
     * @param array|null $category__and
     * @param array|null $category__in
     * @param array|null $category__not_in
     * @return $this
     * @throws ReflectionException
     */
    public function category($cat = null, string $category_name = null, array $category__and = null, array $category__in = null, array $category__not_in = null): Query
    {
        $this->updateArgs(Category::class, $cat, $category_name, $category__and, $category__in, $category__not_in);
        return $this;
    }

    /**
     * @param null|Tag|string $tag
     * @param int|null $tag_id
     * @param array|null $tag__and
     * @param array|null $tag__in
     * @param array|null $tag__not_in
     * @param array|null $tag_slug__and
     * @param array|null $tag_slug__in
     * @return $this
     * @throws ReflectionException
     */
    public function tag($tag = null, int $tag_id = null, array $tag__and = null, array $tag__in = null, array $tag__not_in = null, array $tag_slug__and = null, array $tag_slug__in = null): Query
    {
        $this->updateArgs(Tag::class, $tag, $tag_id, $tag__and, $tag__in, $tag__not_in, $tag_slug__and, $tag_slug__in);
        return $this;
    }

    /**
     * @param null|Tax|string $relation
     * @param array|null $arguments
     * @return $this
     * @throws ReflectionException
     */
    public function tax($relation = null, array $arguments = null): Query
    {
        $this->updateArgs(Tax::class, $relation, $arguments);

        return $this;
    }

    /**
     * @param null|PostAndPage|string $p
     * @param string|null $name
     * @param string|null $title
     * @param int|null $page_id
     * @param string|null $pagename
     * @param array|null $post_name__in
     * @param array|null $post_parent
     * @param array|null $post_parent__in
     * @param array|null $post_parent__not_in
     * @param array|null $post__in
     * @param array|null $post__not_in
     * @return $this
     * @throws ReflectionException
     */
    public function postAndPage($p = null, string $name = null, string $title = null, int $page_id = null, string $pagename = null, array $post_name__in = null, array $post_parent = null, array $post_parent__in = null, array $post_parent__not_in = null, array $post__in = null, array $post__not_in = null): Query
    {
        $this->updateArgs(PostAndPage::class, $p, $name, $title, $page_id, $pagename, $post_name__in, $post_parent, $post_parent__in, $post_parent__not_in, $post__in, $post__not_in);

        return $this;
    }

    /**
     * @param null|Password|bool|string $has_password
     * @param string|null $post_password
     * @return $this
     * @throws ReflectionException
     */
    public function password($has_password = null, string $post_password = null): Query
    {
        $this->updateArgs(Password::class, $has_password, $has_password);

        return $this;
    }

    /**
     * @param null|PostType|string $post_type
     * @return $this
     * @throws ReflectionException
     */
    public function postType($post_type = null): Query
    {
        $this->updateArgs(PostType::class, $post_type);

        return $this;
    }

    /**
     * @param null|PostStatus|mixed $post_status
     * @return $this
     * @throws ReflectionException
     */
    public function postStatus($post_status = null): Query
    {
        $this->updateArgs(PostStatus::class, $post_status);

        return $this;
    }

    /**
     * @param null|Comment|mixed $comment_count
     * @return $this
     * @throws ReflectionException
     */
    public function comment($comment_count = null): Query
    {
        $this->updateArgs(Comment::class, $comment_count);

        return $this;
    }

    /**
     * @param null|Pagination|string $posts_per_page
     * @param bool|null $nopaging
     * @param int|null $paged
     * @param int|null $posts_per_archive_page
     * @param int|null $offset
     * @param int|null $page
     * @param bool|null $ignore_sticky_posts
     * @return $this
     * @throws ReflectionException
     */
    public function pagination($posts_per_page = null, bool $nopaging = null, int $paged = null, int $posts_per_archive_page = null, int $offset = null, int $page = null, bool $ignore_sticky_posts = null): Query
    {
        $this->updateArgs(Pagination::class, $posts_per_page, $nopaging, $paged, $posts_per_archive_page, $offset, $page, $ignore_sticky_posts);

        return $this;
    }

    /**
     * @param null|Order|string $order
     * @param string|null $orderby
     * @return $this
     * @throws ReflectionException
     */
    public function order($order = null, string $orderby = null): Query
    {
        $this->updateArgs(Order::class, $order, $orderby);
        return $this;
    }

    /**
     * @param Date|null|array $date_query
     * @param int|null $year
     * @param int|null $monthnum
     * @param int|null $w
     * @param int|null $day
     * @param int|null $hour
     * @param int|null $minute
     * @param int|null $second
     * @param int|null $m
     * @return $this
     * @throws ReflectionException
     */
    public function date($date_query, int $year = null, int $monthnum = null, int $w = null, int $day = null, int $hour = null, int $minute = null, int $second = null, int $m = null): Query
    {
        $this->updateArgs(Date::class, $date_query, $year, $monthnum, $w, $day, $hour, $minute, $second, $m);

        return $this;
    }

    /**
     * @param Meta|null|array $meta_query
     * @param string|null $meta_key
     * @param string|null $meta_value
     * @param string|null $meta_value_num
     * @param string|null $meta_compare
     * @return $this
     * @throws ReflectionException
     */
    public function meta($meta_query, string $meta_key = null, string $meta_value = null, string $meta_value_num = null, string $meta_compare = null): Query
    {
        $this->updateArgs(Meta::class, $meta_query, $meta_key, $meta_value, $meta_value_num, $meta_compare);

        return $this;
    }

    /**
     * @param null|Search|string $s
     * @param bool|null $exact
     * @param bool|null $sentence
     * @return $this
     * @throws ReflectionException
     */
    public function search($s = null, bool $exact = null, bool $sentence = null): Query
    {
        $this->updateArgs(Search::class, $s, $exact, $sentence);

        return $this;
    }

    /**
     * @param null|Fields|array $fields
     * @return $this
     * @throws ReflectionException
     */
    public function fields($fields = null): Query
    {
        $this->updateArgs(Fields::class, $fields);
        return $this;
    }
}
