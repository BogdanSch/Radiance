<?php
namespace WPAICG;
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( '\\WPAICG\\WPAICG_WooCommerce' ) ) {
    class WPAICG_WooCommerce
    {
        private static  $instance = null ;

        public static function get_instance()
        {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function __construct()
        {
            add_action('add_meta_boxes_product', array($this,'wpaicg_register_meta_box'));
            add_action('wp_ajax_wpaicg_product_generator',array($this,'wpaicg_product_generator'));
            add_action('wp_ajax_wpaicg_product_save',array($this,'wpaicg_product_save'));
            add_action('manage_posts_extra_tablenav',[$this,'wpaicg_woocommerce_content_button']);
            add_action('admin_footer',[$this,'wpaicg_woocommerce_content_footer']);
            add_action('wp_ajax_wpaicg_woo_content_generator',[$this,'wpaicg_woo_content_generator']);
        }

        public function wpaicg_woo_content_generator()
        {
            global $wpdb;
            $wpaicg_result = array('status' => 'error','msg' => esc_html__('Something went wrong','gpt3-ai-content-generator'));
            if(!current_user_can('wpaicg_woocommerce_content')){
                $wpaicg_result['status'] = 'error';
                $wpaicg_result['msg'] = esc_html__('You do not have permission for this action.','gpt3-ai-content-generator');
                wp_send_json($wpaicg_result);
            }
            if ( ! wp_verify_nonce( $_POST['nonce'], 'wpaicg-ajax-action' ) ) {
                $wpaicg_result['status'] = 'error';
                $wpaicg_result['msg'] = WPAICG_NONCE_ERROR;
                wp_send_json($wpaicg_result);
            }
            $open_ai = WPAICG_OpenAI::get_instance()->openai();
            if(!$open_ai){
                $wpaicg_result['msg'] = esc_html__('Missing API Setting','gpt3-ai-content-generator');
                wp_send_json($wpaicg_result);
                exit;
            }
            if(
                isset($_REQUEST['title'])
                && !empty($_REQUEST['title'])
                && isset($_REQUEST['id'])
                && !empty($_REQUEST['id'])
                && isset($_REQUEST['step'])
                && !empty($_REQUEST['step'])
            ) {
                $temperature = floatval($open_ai->temperature);
                $max_tokens = intval($open_ai->max_tokens);
                $top_p = floatval($open_ai->top_p);
                $best_of = intval($open_ai->best_of);
                $frequency_penalty = floatval($open_ai->frequency_penalty);
                $presence_penalty = floatval($open_ai->presence_penalty);
                $wpai_language = sanitize_text_field($open_ai->wpai_language);
                $wpaicg_language_file = plugin_dir_path(dirname(__FILE__)) . 'admin/languages/' . $wpai_language . '.json';
                if (!file_exists($wpaicg_language_file)) {
                    $wpaicg_language_file = plugin_dir_path(dirname(__FILE__)) . 'admin/languages/en.json';
                }
                $wpaicg_language_json = file_get_contents($wpaicg_language_file);
                $wpaicg_languages = json_decode($wpaicg_language_json, true);
                $wpaicg_woo_generate_title = isset($_REQUEST['wpaicg_woo_generate_title']) && !empty($_REQUEST['wpaicg_woo_generate_title']) ? true : false;
                $wpaicg_woo_meta_description = isset($_REQUEST['wpaicg_woo_meta_description']) && !empty($_REQUEST['wpaicg_woo_meta_description']) ? true : false;
                $wpaicg_woo_generate_description = isset($_REQUEST['wpaicg_woo_generate_description']) && !empty($_REQUEST['wpaicg_woo_generate_description']) ? true : false;
                $wpaicg_woo_generate_short = isset($_REQUEST['wpaicg_woo_generate_short']) && !empty($_REQUEST['wpaicg_woo_generate_short']) ? true : false;
                $wpaicg_woo_generate_tags = isset($_REQUEST['wpaicg_woo_generate_tags']) && !empty($_REQUEST['wpaicg_woo_generate_tags']) ? true : false;
                $wpaicg_woo_custom_prompt = isset($_REQUEST['wpaicg_woo_custom_prompt']) && !empty($_REQUEST['wpaicg_woo_custom_prompt']) ? true : false;
                $wpaicg_woo_custom_prompt_title = isset($_REQUEST['wpaicg_woo_custom_prompt_title']) && !empty($_REQUEST['wpaicg_woo_custom_prompt_title']) ? sanitize_text_field($_REQUEST['wpaicg_woo_custom_prompt_title']) : get_option('wpaicg_woo_custom_prompt_title',esc_html__('Compose an SEO-optimized title in English for the following product: %s. Ensure it is engaging, concise, and includes relevant keywords to maximize its visibility on search engines.','gpt3-ai-content-generator'));
                $wpaicg_woo_custom_prompt_short = isset($_REQUEST['wpaicg_woo_custom_prompt_short']) && !empty($_REQUEST['wpaicg_woo_custom_prompt_short']) ? sanitize_text_field($_REQUEST['wpaicg_woo_custom_prompt_short']) : get_option('wpaicg_woo_custom_prompt_short',esc_html__('Provide a compelling and concise summary in English for the following product: %s, highlighting its key features, benefits, and unique selling points.','gpt3-ai-content-generator'));
                $wpaicg_woo_custom_prompt_description = isset($_REQUEST['wpaicg_woo_custom_prompt_description']) && !empty($_REQUEST['wpaicg_woo_custom_prompt_description']) ? sanitize_text_field($_REQUEST['wpaicg_woo_custom_prompt_description']) : get_option('wpaicg_woo_custom_prompt_description',esc_html__('Craft a comprehensive and engaging product description in English for: %s. Include specific details, features, and benefits, as well as the value it offers to the customer, thereby creating a compelling narrative around the product.','gpt3-ai-content-generator'));
                $wpaicg_woo_custom_prompt_meta = isset($_REQUEST['wpaicg_woo_custom_prompt_meta']) && !empty($_REQUEST['wpaicg_woo_custom_prompt_meta']) ? sanitize_text_field($_REQUEST['wpaicg_woo_custom_prompt_meta']) : get_option('wpaicg_woo_custom_prompt_meta',esc_html__('Craft a compelling and concise meta description in English for: %s. Aim to highlight its key features and benefits within a limit of 155 characters, while incorporating relevant keywords for SEO effectiveness.','gpt3-ai-content-generator'));
                $wpaicg_woo_custom_prompt_keywords = isset($_REQUEST['wpaicg_woo_custom_prompt_keywords']) && !empty($_REQUEST['wpaicg_woo_custom_prompt_keywords']) ? sanitize_text_field($_REQUEST['wpaicg_woo_custom_prompt_keywords']) : get_option('wpaicg_woo_custom_prompt_keywords',esc_html__('Propose a set of relevant keywords in English for the following product: %s. The keywords should be directly related to the product, enhancing its discoverability. Please present these keywords in a comma-separated format, avoiding the use of symbols such as -, #, etc.','gpt3-ai-content-generator'));
                if(!$wpaicg_woo_custom_prompt){
                    $wpaicg_woo_custom_prompt_title = $wpaicg_languages['woo_product_title'];
                    $wpaicg_woo_custom_prompt_short = $wpaicg_languages['woo_product_short'];
                    $wpaicg_woo_custom_prompt_description = $wpaicg_languages['woo_product_description'];
                    $wpaicg_woo_custom_prompt_meta = $wpaicg_languages['meta_desc_prompt'];
                    $wpaicg_woo_custom_prompt_keywords = $wpaicg_languages['woo_product_tags'];
                }
                $wpaicg_ai_model = get_option('wpaicg_ai_model','gpt-3.5-turbo');
                $wpaicg_generator = WPAICG_Generator::get_instance();
                $wpaicg_generator->openai($open_ai);
                $wpaicg_generator->sleep_request();
                $title = sanitize_text_field($_REQUEST['title']);
                $id = sanitize_text_field($_REQUEST['id']);
                $step = sanitize_text_field($_REQUEST['step']);
                if($step === 'title'){
                    $prompt = sprintf($wpaicg_woo_custom_prompt_title,$title);
                }
                if($step === 'meta'){
                    $prompt = sprintf($wpaicg_woo_custom_prompt_meta,$title);
                }
                if($step === 'description'){
                    $prompt = sprintf($wpaicg_woo_custom_prompt_description,$title);
                }
                if($step === 'short'){
                    $prompt = sprintf($wpaicg_woo_custom_prompt_short,$title);
                }
                if($step === 'tags'){
                    $prompt = sprintf($wpaicg_woo_custom_prompt_keywords,$title);
                }
                if($wpaicg_ai_model == 'gpt-3.5-turbo' || $wpaicg_ai_model == 'gpt-4' || $wpaicg_ai_model == 'gpt-4-32k'){
                    $prompt = $wpaicg_languages['fixed_prompt_turbo'].' '.$prompt;
                }
                $opts = array(
                    'model' => $wpaicg_ai_model,
                    'prompt' => $prompt,
                    'temperature' => $temperature,
                    'max_tokens' => $max_tokens,
                    'frequency_penalty' => $frequency_penalty,
                    'presence_penalty' => $presence_penalty,
                    'top_p' => $top_p,
                    'best_of' => $best_of,
                );
                $wpaicg_result['prompt'] = $prompt;
                $complete = $wpaicg_generator->wpaicg_request($opts);
                if($complete['status'] == 'error'){
                    $wpaicg_result['msg'] = $complete['msg'];
                }
                else{
                    $result = $complete['data'];
                    $wpaicg_result['data'] = trim($result);
                    $wpaicg_result['status'] = 'success';
                    if($step === 'tags'){
                        $tags = preg_split( "/\r\n|\n|\r/", $result );
                        $tags = preg_replace( '/^\\d+\\.\\s/', '', $tags );
                        if(is_array($tags)){
                            $tags = $tags[0];
                            $tags = array_map('trim', explode(',', $tags));
                            $wpaicg_result['data'] = array();
                            if($tags && is_array($tags) && count($tags)){
                                $post_tags = wp_get_post_terms($id,'product_tag');
                                if($post_tags && is_array($post_tags) && count($post_tags)){
                                    $terms_id = wp_list_pluck($post_tags,'term_id');
                                    wp_remove_object_terms($id, $terms_id,'product_tag');
                                }
                                $terms_id = array();
                                foreach($tags as $tag){
                                    $product_tag = term_exists($tag,'product_tag');
                                    if(!$product_tag){
                                        $product_tag = wp_insert_term($tag,'product_tag');
                                    }
                                    $term = get_term($product_tag['term_id'],'product_tag');
                                    $wpaicg_result['data'][$term->slug] = $tag;
                                    $terms_id[] = (int)$term->term_id;
                                }
                                wp_add_object_terms($id, $terms_id,'product_tag');
                            }
                        }
                    }
                    elseif($step == 'title'){
                        wp_update_post(array(
                            'ID' => $id,
                            'post_title' => trim($result)
                        ));
                    }
                    elseif($step == 'meta'){
                        $seo_option = get_option('_yoast_wpseo_metadesc',false);
                        $seo_plugin_activated = wpaicg_util_core()->seo_plugin_activated();
                        if($seo_plugin_activated == '_yoast_wpseo_metadesc' && $seo_option){
                            update_post_meta($id,$seo_plugin_activated,$result);
                        }
                        $seo_option = get_option('_aioseo_description',false);
                        if($seo_plugin_activated == '_aioseo_description' && $seo_option){
                            update_post_meta($id,$seo_plugin_activated,$result);
                            $check = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."aioseo_posts WHERE post_id=%d",$id));
                            if($check){
                                $wpdb->update($wpdb->prefix,'aioseo_posts', array(
                                    'description' => $result
                                ), array(
                                    'post_id' => $id
                                ));
                            }
                            else{
                                $wpdb->insert($wpdb->prefix.'aioseo_posts',array(
                                    'post_id' => $id,
                                    'description' => $result,
                                    'created' => date('Y-m-d H:i:s'),
                                    'updated' => date('Y-m-d H:i:s')
                                ));
                            }
                        }
                        $seo_option = get_option('rank_math_description',false);
                        if($seo_plugin_activated == 'rank_math_description' && $seo_option){
                            update_post_meta($id,$seo_plugin_activated,$result);
                        }
                        update_post_meta($id,'_wpaicg_meta_description', $result);
                    }
                    elseif($step == 'description'){
                        wp_update_post(array(
                            'ID' => $id,
                            'post_content' => trim($result)
                        ));
                    }
                    elseif($step == 'short'){
                        wp_update_post(array(
                            'ID' => $id,
                            'post_excerpt' => trim($result)
                        ));
                    }
                }

            }
            else{
                $wpaicg_result['msg'] = esc_html__('Missing request parameters','gpt3-ai-content-generator');
            }
            wp_send_json($wpaicg_result);
        }

        public function wpaicg_woocommerce_content_footer()
        {
            ?>
            <div class="wpaicg-woo-content-default" style="display: none">
                <?php
                include WPAICG_PLUGIN_DIR.'admin/views/settings/woocommerce.php';
                ?>
            </div>
            <script>
                jQuery(document).ready(function ($){
                    function wpaicgLoading(btn){
                        btn.attr('disabled','disabled');
                        if(!btn.find('spinner').length){
                            btn.append('<span class="spinner"></span>');
                        }
                        btn.find('.spinner').css('visibility','unset');
                    }
                    function wpaicgRmLoading(btn){
                        btn.removeAttr('disabled');
                        btn.find('.spinner').remove();
                    }
                    var ids = [];
                    var titles = {};
                    var wpaicgWooContentAjax = false;
                    var wpaicgWooContentWorking = true;
                    var wpaicgWooContentSuccess = 0;
                    var wooGenerateContent = $('.wpaicg-woocommerce-content-btn');
                    var wpaicgSteps = [];
                    var hasGenerateTitle = false;
                    var hasGenerateTags = false;
                    var wpaicgFirstStep = '';
                    var wpaicgLastStep = '';
                    wooGenerateContent.click(function (){
                        if(!wpaicgWooContentAjax){
                            ids = [];
                            titles = {};
                            let form = $(this).closest('#posts-filter');
                            form.find('.wp-list-table th.check-column input[type=checkbox]:checked').each(function (idx, item){
                                let post_id = $(item).val();
                                ids.push(post_id);
                                let row = form.find('#post-'+post_id);
                                let post_name = row.find('.column-title .row-title').text();
                                if(post_name === ''){
                                    post_name = row.find('.column-name .row-title').text();
                                }
                                titles[post_id] = post_name.trim();
                            });
                            if(ids.length === 0){
                                alert('<?php echo esc_html__('Please select a product to generate.','gpt3-ai-content-generator')?>');
                            }
                            else{
                                wpaicgWooContentWorking = true;
                                $('.wpaicg_modal_title').html('<?php echo esc_html__('WooCommerce Content Generator','gpt3-ai-content-generator')?><span style="font-weight: bold;font-size: 16px;background: #fba842;padding: 1px 5px;border-radius: 3px;display: inline-block;margin-left: 6px;color: #222;" class="wpaicg-woocontent-remain">0/'+ids.length+'</span>');
                                $('.wpaicg_modal').css({
                                    top: '5%',
                                    height: '90%'
                                });
                                $('.wpaicg_modal_content').css({
                                    'max-height': 'calc(100% - 103px)',
                                    'overflow-y': 'auto'
                                });
                                var woo_content_message = '<?php echo esc_html__('This will generate content for [numbers] products. Do you want to continue?','gpt3-ai-content-generator')?>';
                                var html = '<form action="" method="post" id="wpaicg-woo-content-form">';
                                html += '<input type="hidden" name="action" value="wpaicg_woo_content_generator">';
                                html += '<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('wpaicg-ajax-action')?>">';
                                html += $('.wpaicg-woo-content-default').html();
                                html += '<p><?php echo esc_html__('If you would like to change your default settings please go to Settings - WooCommerce and adjust your settings.','gpt3-ai-content-generator')?></p>'
                                html += '<p>'+woo_content_message.replace('[numbers]',ids.length)+'</p>';
                                html += '<button class="button button-primary wpaicg_woo_content_btn"><?php echo esc_html__('Start','gpt3-ai-content-generator')?></button>';
                                html += '&nbsp;<button type="button" class="button wpaicg_woo_content_cancel" style="display: none"><?php echo esc_html__('Cancel','gpt3-ai-content-generator')?></button>';
                                html += '<div class="wpaicg-woo-content-modal-content" style="padding:10px 0px"></div>';
                                html += '</form>';
                                $('.wpaicg_modal_content').html(html);
                                $('#wpaicg-woo-content-form h3').hide();
                                $('#wpaicg-woo-content-form .wpaicg_woo_token_sale').hide();
                                $('.wpaicg-overlay').show();
                                $('.wpaicg_modal').show();
                            }
                        }
                        else{
                            alert('<?php echo esc_html__('Please wait old generate task finished','gpt3-ai-content-generator')?>');
                        }
                    });
                    $(document).on('submit','#wpaicg-woo-content-form',function(e){
                        e.preventDefault();
                        wpaicgSteps = [];
                        var form = $(e.currentTarget);
                        if(form.find('input[name=wpaicg_woo_generate_title]:checked').length){
                            wpaicgSteps.push('title');
                            hasGenerateTitle = true;
                        }
                        else{
                            hasGenerateTitle = false;
                        }
                        if(form.find('input[name=wpaicg_woo_meta_description]:checked').length){
                            wpaicgSteps.push('meta');
                        }
                        if(form.find('input[name=wpaicg_woo_generate_description]:checked').length){
                            wpaicgSteps.push('description');
                        }
                        if(form.find('input[name=wpaicg_woo_generate_short]:checked').length){
                            wpaicgSteps.push('short');
                        }
                        if(form.find('input[name=wpaicg_woo_generate_tags]:checked').length){
                            wpaicgSteps.push('tags');
                            hasGenerateTags = true;
                        }
                        else{
                            hasGenerateTags = false;
                        }
                        if(ids.length === 0){
                            alert('<?php echo esc_html__('Please select a product to generate.','gpt3-ai-content-generator')?>');
                        }
                        else if(wpaicgSteps.length === 0){
                            alert('<?php echo esc_html__('Please enter at least one step for generate.','gpt3-ai-content-generator')?>');
                        }
                        else{
                            $('.wpaicg-woo-content-modal-content').empty();
                            wpaicgFirstStep = wpaicgSteps[0];
                            wpaicgLastStep = wpaicgSteps[wpaicgSteps.length-1];
                            $('.wpaicg_modal_close').hide();
                            var btn = $('.wpaicg_woo_content_btn');
                            wpaicgLoading(btn);
                            $('.wpaicg_woo_content_cancel').show();
                            wpaicgWooContentSuccess = 0;
                            wpaicgWooContentGenerator(0,0,ids);
                        }
                    });
                    $(document).on('click','.wpaicg_woo_content_cancel',function (){
                        var btn = $('.wpaicg_woo_content_btn');
                        wpaicgRmLoading(btn);
                        $('.wpaicg_woo_content_cancel').hide();
                        if(wpaicgWooContentAjax){
                            wpaicgWooContentAjax.abort();
                            wpaicgWooContentAjax = false;
                        }
                    });
                    function wpaicgWooContentGenerator(start,step,ids){
                        var btn = $('.wpaicg_woo_content_btn');
                        var contentEl = $('.wpaicg-woo-content-modal-content');
                        var data = $('#wpaicg-woo-content-form').serialize();
                        var currentStep = wpaicgSteps[step];
                        var currentStepText = wpaicgSteps[step];
                        var nextID = start;
                        var id = ids[start];
                        if(start + 1 > ids.length){
                            $('.wpaicg_modal_close').show();
                            wpaicgWooContentAjax = false;
                            wpaicgRmLoading(btn);
                            $('.wpaicg_woo_content_cancel').hide();
                        }
                        else {
                            data += '&id='+id;
                            data += '&title='+titles[id];
                            data += '&step='+currentStep;
                            if(currentStepText === 'short'){
                                currentStepText = 'short description';
                            }
                            wpaicgWooContentAjax = $.ajax({
                                url: '<?php echo admin_url('admin-ajax.php')?>',
                                data: data,
                                type: 'POST',
                                beforeSend: function () {
                                    if(!$('#wpaicg-product-generate-'+id).length){
                                        contentEl.append('<div class="wpaicg-product-generate-pending" id="wpaicg-product-generate-'+id+'" style="background: #ebebeb;border-radius: 3px;padding: 5px;margin-bottom: 5px;border: 1px solid #dfdfdf;"><div style="display: flex; justify-content: space-between;"><span>'+titles[id]+'</span><span style="font-style: italic" class="wpaicg-product-generate-status"><?php echo esc_html__('Generating...','gpt3-ai-content-generator')?></span></div></div>');
                                    }
                                },
                                dataType: 'JSON',
                                success: function (res) {
                                    var product = $('#wpaicg-product-generate-'+id);
                                    if(res.status === 'success'){
                                        var row = $('#post-'+id);
                                        product.append('<div style="color: #0f8f00;font-size: 12px;">['+currentStepText+']&nbsp;<?php echo esc_html__('OK','gpt3-ai-content-generator')?></div>');
                                        if(currentStep === 'title'){
                                            row.find('.column-name a.row-title').html(res.data);
                                        }
                                        if(currentStep === 'tags'){
                                            row.find('.column-product_tag').empty();
                                            if(typeof res.data !== "undefined"){
                                                var key = 0;
                                                $.each(res.data,function(slug, tag){
                                                    var html = '';
                                                    if(key > 0){
                                                        html += ', ';
                                                    }
                                                    html += '<a href="<?php echo admin_url('edit.php?product_tag=')?>'+slug+'&post_type=product">'+tag+'</a>';
                                                    row.find('.column-product_tag').append(html);
                                                    key += 1;
                                                })
                                            }
                                        }
                                        if(currentStep === wpaicgLastStep) {
                                            wpaicgWooContentSuccess += 1;
                                            $('.wpaicg-woocontent-remain').html(wpaicgWooContentSuccess + '/' + ids.length);
                                            product.css({
                                                'background-color': '#cde5dd'
                                            });
                                            product.removeClass('wpaicg-product-generate-pending');
                                            product.find('.wpaicg-product-generate-status').html('<?php echo esc_html__('Done', 'gpt3-ai-content-generator')?>');
                                            product.find('.wpaicg-product-generate-status').css({
                                                'font-style': 'normal',
                                                'font-weight': 'bold',
                                                'color': '#008917'
                                            });
                                        }
                                    }
                                    else{
                                        product.css({
                                            'background-color': '#e5cdcd'
                                        });
                                        product.find('.wpaicg-product-generate-status').html('<?php echo esc_html__('Error','gpt3-ai-content-generator')?>');
                                        product.find('.wpaicg-product-generate-status').css({
                                            'font-style': 'normal',
                                            'font-weight': 'bold',
                                            'color': '#e30000'
                                        })
                                        product.append('<div style="color: #e30000;font-size: 12px;">['+currentStepText+']&nbsp;' + res.msg + '</div>');
                                    }
                                    if(currentStep === wpaicgLastStep){
                                        nextID = start+1;
                                        step = 0;
                                    }
                                    else{
                                        step = step+1;
                                    }
                                    wpaicgWooContentGenerator(nextID,step,ids);
                                },
                                error: function (request, status, error) {
                                    $('.wpaicg_modal_close').show();
                                }
                            });
                        }
                    }
                })
            </script>
            <?php
        }

        public function wpaicg_woocommerce_content_button()
        {
            global $post_type;
            if($post_type == 'product' && current_user_can('wpaicg_woocommerce_content')){
                ?>
                <div class="alignleft actions">
                    <a style="height: 32px" href="javascript:void(0)" class="button button-primary wpaicg-woocommerce-content-btn"><?php echo esc_html__('Generate Content','gpt3-ai-content-generator')?></a>
                </div>
                <?php
            }
        }

        public function wpaicg_register_meta_box()
        {
            if(current_user_can('wpaicg_woocommerce_product_writer')) {
                add_meta_box('wpaicg-woocommerce-generator', esc_html__('AI Power Product Writer','gpt3-ai-content-generator'), [$this, 'wpaicg_meta_box']);
            }
        }

        public function wpaicg_meta_box($post)
        {
                include WPAICG_PLUGIN_DIR . 'admin/views/woocommerce/wpaicg-meta-box.php';
        }

        public function wpaicg_product_save()
        {
            global $wpdb;
            $wpaicg_result = array('status' => 'error','msg' => esc_html__('Something went wrong','gpt3-ai-content-generator'));
            if(!current_user_can('wpaicg_woocommerce_product_writer')){
                $wpaicg_result['status'] = 'error';
                $wpaicg_result['msg'] = esc_html__('You do not have permission for this action.','gpt3-ai-content-generator');
                wp_send_json($wpaicg_result);
            }
            if ( ! wp_verify_nonce( $_POST['nonce'], 'wpaicg-ajax-nonce' ) ) {
                $wpaicg_result['status'] = 'error';
                $wpaicg_result['msg'] = WPAICG_NONCE_ERROR;
                wp_send_json($wpaicg_result);
            }
            if(
                isset($_REQUEST['id'])
                && !empty($_REQUEST['id'])
                && isset($_REQUEST['mode'])
                && !empty($_REQUEST['mode'])
            ){
                $wpaicgMode = sanitize_text_field($_REQUEST['mode']);
                $wpaicgProductID = sanitize_text_field($_REQUEST['id']);
                if($wpaicgMode == 'new'){
                    $wpaicgProductData = array(
                        'post_title' => '',
                        'post_type' => 'product'
                    );
                    if(isset($_REQUEST['wpaicg_product_title']) && !empty($_REQUEST['wpaicg_product_title'])){
                        $wpaicgProductData['post_title'] = sanitize_text_field($_REQUEST['wpaicg_product_title']);
                    }
                    elseif(isset($_REQUEST['wpaicg_original_title']) && !empty($_REQUEST['wpaicg_original_title'])){
                        $wpaicgProductData['post_title'] = sanitize_text_field($_REQUEST['wpaicg_original_title']);
                    }
                    $wpaicgProductID = wp_insert_post($wpaicgProductData);
                }
                $wpaicgData = array('ID' => $wpaicgProductID);
                if(isset($_REQUEST['wpaicg_product_title']) && !empty($_REQUEST['wpaicg_product_title'])){
                    $wpaicgData['post_title'] = sanitize_text_field($_REQUEST['wpaicg_product_title']);
                    update_post_meta($wpaicgProductID,'wpaicg_product_title', sanitize_text_field($_REQUEST['wpaicg_product_title']));
                }
                if(isset($_REQUEST['wpaicg_product_short']) && !empty($_REQUEST['wpaicg_product_short'])){
                    $wpaicgData['post_excerpt'] = sanitize_text_field($_REQUEST['wpaicg_product_short']);
                    update_post_meta($wpaicgProductID,'wpaicg_product_short', sanitize_text_field($_REQUEST['wpaicg_product_short']));
                }
                if(isset($_REQUEST['wpaicg_product_meta']) && !empty($_REQUEST['wpaicg_product_meta'])){
                    $seo_description = sanitize_text_field($_REQUEST['wpaicg_product_meta']);
                    $seo_option = get_option('_yoast_wpseo_metadesc',false);
                    $seo_plugin_activated = wpaicg_util_core()->seo_plugin_activated();
                    if($seo_plugin_activated == '_yoast_wpseo_metadesc' && $seo_option){
                        update_post_meta($wpaicgProductID,$seo_plugin_activated,$seo_description);
                    }
                    $seo_option = get_option('_aioseo_description',false);
                    if($seo_plugin_activated == '_aioseo_description' && $seo_option){
                        update_post_meta($wpaicgProductID,$seo_plugin_activated,$seo_description);
                        $check = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."aioseo_posts WHERE post_id=%d",$wpaicgProductID));
                        if($check){
                            $wpdb->update($wpdb->prefix,'aioseo_posts', array(
                                'description' => $seo_description
                            ), array(
                                'post_id' => $wpaicgProductID
                            ));
                        }
                        else{
                            $wpdb->insert($wpdb->prefix.'aioseo_posts',array(
                                'post_id' => $wpaicgProductID,
                                'description' => $seo_description,
                                'created' => date('Y-m-d H:i:s'),
                                'updated' => date('Y-m-d H:i:s')
                            ));
                        }
                    }
                    $seo_option = get_option('rank_math_description',false);
                    if($seo_plugin_activated == 'rank_math_description' && $seo_option){
                        update_post_meta($wpaicgProductID,$seo_plugin_activated,$seo_description);
                    }
                    update_post_meta($wpaicgProductID,'_wpaicg_meta_description', $seo_description);

                }
                if(isset($_REQUEST['wpaicg_product_description']) && !empty($_REQUEST['wpaicg_product_description'])){
                    $wpaicgData['post_content'] = wp_kses_post($_REQUEST['wpaicg_product_description']);
                    update_post_meta($wpaicgProductID,'wpaicg_product_description', wp_kses_post($_REQUEST['wpaicg_product_description']));
                }
                if(isset($_REQUEST['wpaicg_product_tags']) && !empty($_REQUEST['wpaicg_product_tags'])){
                    $wpaicgTags = sanitize_text_field($_REQUEST['wpaicg_product_tags']);
                    $wpaicgTags = array_map('trim', explode(',', $wpaicgTags));
                    wp_set_object_terms($wpaicgProductID, $wpaicgTags,'product_tag');
                    update_post_meta($wpaicgProductID,'wpaicg_product_tags', sanitize_text_field($_REQUEST['wpaicg_product_tags']));
                }
                if(isset($_REQUEST['wpaicg_generate_title']) && $_REQUEST['wpaicg_generate_title']){
                    update_post_meta($wpaicgProductID,'wpaicg_generate_title', 1);
                }
                else{
                    delete_post_meta($wpaicgProductID,'wpaicg_generate_title');
                }
                if(isset($_REQUEST['wpaicg_generate_description']) && $_REQUEST['wpaicg_generate_description']){
                    update_post_meta($wpaicgProductID,'wpaicg_generate_description', 1);
                }
                else{
                    delete_post_meta($wpaicgProductID,'wpaicg_generate_description');
                }
                if(isset($_REQUEST['wpaicg_generate_short']) && $_REQUEST['wpaicg_generate_short']){
                    update_post_meta($wpaicgProductID,'wpaicg_generate_short', 1);
                }
                else{
                    delete_post_meta($wpaicgProductID,'wpaicg_generate_short');
                }
                if(isset($_REQUEST['wpaicg_generate_tags']) && $_REQUEST['wpaicg_generate_tags']){
                    update_post_meta($wpaicgProductID,'wpaicg_generate_tags', 1);
                }
                else{
                    delete_post_meta($wpaicgProductID,'wpaicg_generate_tags');
                }
                if(isset($_REQUEST['wpaicg_generate_meta']) && $_REQUEST['wpaicg_generate_meta']){
                    update_post_meta($wpaicgProductID,'wpaicg_generate_meta', 1);
                }
                else{
                    delete_post_meta($wpaicgProductID,'wpaicg_generate_meta');
                }
                wp_update_post($wpaicgData);
                $wpaicg_result['status'] = 'success';
                $wpaicg_result['url'] = admin_url('post.php?post='.$wpaicgProductID.'&action=edit');
            }
            wp_send_json($wpaicg_result);
        }

        public function wpaicg_product_generator()
        {
            global $wpdb;
            $open_ai = WPAICG_OpenAI::get_instance()->openai();
            $wpaicg_result = array('status' => 'error','msg' => esc_html__('Something went wrong','gpt3-ai-content-generator'),'data' => '');
            if(!current_user_can('wpaicg_woocommerce_product_writer')){
                $wpaicg_result['status'] = 'error';
                $wpaicg_result['msg'] = esc_html__('You do not have permission for this action.','gpt3-ai-content-generator');
                wp_send_json($wpaicg_result);
            }
            if ( ! wp_verify_nonce( $_POST['nonce'], 'wpaicg-ajax-nonce' ) ) {
                $wpaicg_result['status'] = 'error';
                $wpaicg_result['msg'] = WPAICG_NONCE_ERROR;
                wp_send_json($wpaicg_result);
            }
            if(!$open_ai){
                $wpaicg_result['msg'] = esc_html__('Missing API Setting','gpt3-ai-content-generator');
                wp_send_json($wpaicg_result);
                exit;
            }
            ini_set( 'max_execution_time', 1000 );
            $temperature = floatval( $open_ai->temperature );
            $max_tokens = intval( $open_ai->max_tokens );
            $top_p = floatval( $open_ai->top_p );
            $best_of = intval( $open_ai->best_of );
            $frequency_penalty = floatval( $open_ai->frequency_penalty );
            $presence_penalty = floatval( $open_ai->presence_penalty );
            $wpai_language = sanitize_text_field( $open_ai->wpai_language );
            $wpaicg_language_file = plugin_dir_path( dirname( __FILE__ ) ) . 'admin/languages/' . $wpai_language . '.json';
            if ( !file_exists( $wpaicg_language_file ) ) {
                $wpaicg_language_file = plugin_dir_path( dirname( __FILE__ ) ) . 'admin/languages/en.json';
            }
            $wpaicg_language_json = file_get_contents( $wpaicg_language_file );
            $wpaicg_languages = json_decode( $wpaicg_language_json, true );
            if(isset($_REQUEST['step']) && !empty($_REQUEST['step']) && isset($_REQUEST['title']) && !empty($_REQUEST['title'])) {
                $wpaicg_step = sanitize_text_field($_REQUEST['step']);
                $wpaicg_title = sanitize_text_field($_REQUEST['title']);
                if($wpaicg_step == 'meta'){
                    $wpaicg_language_key = 'meta_desc_prompt';
                }
                else{
                    $wpaicg_language_key = isset($wpaicg_languages['woo_product_'.$wpaicg_step]) ? 'woo_product_'.$wpaicg_step : 'woo_product_title';
                }
                /*Custom Prompt*/
                $wpaicg_woo_custom_prompt = get_option('wpaicg_woo_custom_prompt',false);
                if($wpaicg_woo_custom_prompt) {
                    if($wpaicg_step == 'title'){
                        $wpaicg_languages[$wpaicg_language_key] = get_option('wpaicg_woo_custom_prompt_title', esc_html__('Compose an SEO-optimized title in English for the following product: %s. Ensure it is engaging, concise, and includes relevant keywords to maximize its visibility on search engines.','gpt3-ai-content-generator'));
                    }
                    if($wpaicg_step == 'meta'){
                        $wpaicg_languages[$wpaicg_language_key] = get_option('wpaicg_woo_custom_prompt_meta', esc_html__('Craft a compelling and concise meta description in English for: %s. Aim to highlight its key features and benefits within a limit of 155 characters, while incorporating relevant keywords for SEO effectiveness.','gpt3-ai-content-generator'));
                    }
                    if($wpaicg_step == 'short'){
                        $wpaicg_languages[$wpaicg_language_key] = get_option('wpaicg_woo_custom_prompt_short', esc_html__('Provide a compelling and concise summary in English for the following product: %s, highlighting its key features, benefits, and unique selling points.','gpt3-ai-content-generator'));
                    }
                    if($wpaicg_step == 'description'){
                        $wpaicg_languages[$wpaicg_language_key] = get_option('wpaicg_woo_custom_prompt_description', esc_html__('Craft a comprehensive and engaging product description in English for: %s. Include specific details, features, and benefits, as well as the value it offers to the customer, thereby creating a compelling narrative around the product.','gpt3-ai-content-generator'));
                    }
                    if($wpaicg_step == 'tags'){
                        $wpaicg_languages[$wpaicg_language_key] = get_option('wpaicg_woo_custom_prompt_keywords', esc_html__('Propose a set of relevant keywords in English for the following product: %s. The keywords should be directly related to the product, enhancing its discoverability. Please present these keywords in a comma-separated format, avoiding the use of symbols such as -, #, etc.','gpt3-ai-content-generator'));
                    }
                }
                /*End Custom Prompt*/
                $myprompt = isset($wpaicg_languages[$wpaicg_language_key]) && !empty($wpaicg_languages[$wpaicg_language_key]) ? sprintf($wpaicg_languages[$wpaicg_language_key], $wpaicg_title) : $wpaicg_title;
                $wpaicg_result['prompt'] = $myprompt;
                $wpaicg_ai_model = get_option('wpaicg_ai_model','gpt-3.5-turbo');
                if($wpaicg_ai_model == 'gpt-3.5-turbo' || $wpaicg_ai_model == 'gpt-4' || $wpaicg_ai_model == 'gpt-4-32k'){
                    $myprompt = $wpaicg_languages['fixed_prompt_turbo'].' '.$myprompt;
                }
                $wpaicg_generator = WPAICG_Generator::get_instance();
                $wpaicg_generator->openai($open_ai);
                $wpaicg_generator->sleep_request();
                $complete = $wpaicg_generator->wpaicg_request([
                    'model' => $wpaicg_ai_model,
                    'prompt' => $myprompt,
                    'temperature' => $temperature,
                    'max_tokens' => $max_tokens,
                    'frequency_penalty' => $frequency_penalty,
                    'presence_penalty' => $presence_penalty,
                    'top_p' => $top_p,
                    'best_of' => $best_of,
                ]);
                if($complete['status'] == 'error'){
                    $wpaicg_result['msg'] = $complete['msg'];
                }
                else{
                    $wpaicg_result['status'] = 'success';
                    $complete = $complete['data'];
                    if($wpaicg_step == 'tags'){
                        $wpaicgTags = preg_split( "/\r\n|\n|\r/", $complete );
                        $wpaicgTags = preg_replace( '/^\\d+\\.\\s/', '', $wpaicgTags );
                        foreach($wpaicgTags as $wpaicgTag){
                            if(!empty($wpaicgTag)){
                                $wpaicg_result['data'] .= (empty($wpaicg_result['data']) ? '' : ', ').trim($wpaicgTag);
                            }
                        }
                    }
                    else{
                        $wpaicg_result['data'] = trim($complete);
                        if($wpaicg_step == 'title'){
                            $wpaicg_result['data'] = str_replace('"','',$wpaicg_result['data']);
                        }
                        if(empty($wpaicg_result['data'])){
                            $wpaicg_result['data'] = esc_html__('There was no response for this product from OpenAI. Please try again','gpt3-ai-content-generator');
                        }
                    }
                }
            }
            wp_send_json($wpaicg_result);
        }
    }

    WPAICG_WooCommerce::get_instance();
}
