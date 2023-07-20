<?php

class cArticle
{
    public $id;
    public $title;
    public $content;
    public $excerpt;
    public $date;
    public $dateEdit;
    public $readingTime;
    public $tags;
    public $tagsString;

    public $img;

    public $categories;
    public $mainCategory;
    public $categoryString;

    public $link;

    public $authorId;
    public $authorImg;
    public $authorName;
    public $authorLink;
    public $authorDescription;

    /**
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    static function getAllCategories()
    {
        return get_categories(array("hide_empty" => true, 'orderby' => 'name', 'order' => 'ASC'));
    }

    static function readingTime($content)
    {
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200);

        $minutes_forms = array('хвилину', 'хвилини', 'хвилин');
        $form_key = ($reading_time % 100 > 4 && $reading_time % 100 < 20) ? 2 : (($reading_time % 10 === 1) ? 0 : (($reading_time % 10 >= 2 && $reading_time % 10 <= 4) ? 1 : 2));
        $minutes_form = $minutes_forms[$form_key];

        $total_reading_time = $reading_time . ' ' . $minutes_form . ' читати';
        return $total_reading_time;
    }

    public function getTags()
    {
        $this->tags = array();
        if(get_the_tags($this->id)){
            foreach (get_the_tags($this->id) as $tag) {
                $this->tags[] = $tag->name;
            }
            return $this->tags;
        }
        return "";
    }
    public function getTagsString(){
        $this->getTags();
        if($this->tags){
            $this->tagsString = implode(", ", $this->tags);
            return $this->tagsString;
        }
        return "";
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        $this->title = get_the_title($this->id);
        return $this->title;
    }

    /**
     * @return array|int|string
     */
    public function getContent()
    {
        $this->content = str_replace(
            array(
                'has-large-font-size',
                'wp-block-image'
            ),
            array(
                'text-xlg',
                'tt-blog-post-image'
            ),
            get_post_field('post_content', $this->id)
        );
        return $this->content;
    }

    /**
     * @return string
     */
    public function getExcerpt(): string
    {
        $this->excerpt = wp_trim_words(get_the_excerpt($this->id), 44, '...');
        return $this->excerpt;
    }

    /**
     * @return false|int|string
     */
    public function getDate()
    {
        $this->date = get_the_date('F j, Y', $this->id);
        return $this->date;
    }

    /**
     * @return false|int|string
     */
    public function getDateEdit()
    {
        $this->dateEdit = get_the_modified_date('F j, Y', $this->id);
        return $this->dateEdit;
    }

    /**
     * @return string
     */
    public function getReadingTime(): string
    {
        $this->readingTime = cArticle::readingTime($this->getContent());
        return $this->readingTime;
    }

    /**
     * @return false|string
     */
    public function getImg($size = false)
    {
        if ($size != false) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($this->id), $size);
            return $this->img = $image[0];
        }
        $this->img = get_the_post_thumbnail_url($this->id);
        if ($this->img == '') {
            $this->img = '/wp-content/uploads/2023/01/diseases_img.jpg';
        }
        return $this->img;
    }

    /**
     * @return WP_Term[]
     */
    public function getCategories()
    {
        $this->categories = get_the_category($this->id);
        return $this->categories;
    }

    public function getMainCategory()
    {
        $this->getCategories();
        if (!empty($this->categories)) {
            $this->mainCategory = $this->categories[0];
        } else {
            $this->mainCategory = new stdClass;
            $this->mainCategory->name = "";
        }
        return $this->mainCategory;
    }
    public function getCategoryString(): string
    {
        $this->getMainCategory();
        $this->categoryString = $this->mainCategory->name;
        return $this->categoryString;
    }
    public function getCategoryLink()
    {
        $this->getMainCategory();
        $category_link = get_category_link($this->mainCategory->term_id);
        return $category_link;
    }
    /**
     * @return false|string|WP_Error
     */
    public function getLink(): string
    {
        $this->link = get_the_permalink($this->id);
        return $this->link;
    }

    /**
     * @return array|int|string
     */
    public function getAuthorId()
    {
        $this->authorId = get_post_field('post_author', $this->id);
        return $this->authorId;
    }

    /**
     * @return mixed
     */
    public function getAuthorImg()
    {
        $this->authorImg = get_avatar($this->authorId, 90, '', $this->authorName, ['class' => 'img-circle']);
        if ($this->authorImg == '') {
            $this->authorImg = '/wp-content/uploads/avatar.jpg';
        }
        return $this->authorImg;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        $this->authorName = get_the_author_meta('display_name', $this->getAuthorId());
        return $this->authorName;
    }
    /**
     * @return string
     */
    public function getAuthorLink(): string
    {
        $this->getAuthorId();
        $this->authorLink = get_author_posts_url($this->authorId);
        return $this->authorLink;
    }
    /**
     * @return string
     */
    public function getAuthorDescription(): string
    {
        $this->getAuthorId();
        $this->authorDescription = get_the_author_meta('description', $this->id);
        return nl2br($this->authorDescription);
    }
    static function latest($count = 3, $exclude = false)
    {
        return get_posts(
            array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'numberposts' => $count,
                'orderby' => 'date',
                'order' => 'DESC',
                'exclude' => array($exclude),
            )
        );
    }

    static function mostViewed($count = 3)
    {
        $popularpostbyview = array(
            'meta_key' => 'wp_post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'posts_per_page' => $count
        );

        $prime_posts = new WP_Query($popularpostbyview);

        return $prime_posts->posts;
    }
}