<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$wpaicg_action = isset($_GET['action']) && !empty($_GET['action']) && in_array(sanitize_text_field($_GET['action']), array('embeddings','fine-tunes','files','data','manual','upload')) ? sanitize_text_field($_GET['action']) : 'preparation';
$checkRole = \WPAICG\wpaicg_roles()->user_can('wpaicg_finetune',empty($wpaicg_action) ? 'preparation' : ($wpaicg_action == 'fine-tunes' ? 'file-tunes':$wpaicg_action));
if($checkRole){
    echo '<script>window.location.href="'.$checkRole.'"</script>';
    exit;
}
?>
<style>
.wpaicg_notice_text_rw {
    padding: 10px;
    background-color: #F8DC6F;
    text-align: left;
    margin-bottom: 12px;
    color: #000;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
</style>
<div class="wrap fs-section">
    <h2 class="nav-tab-wrapper">
        <?php
        \WPAICG\wpaicg_util_core()->wpaicg_tabs('wpaicg_finetune', array(
            'preparation' => esc_html__('Preparation','gpt3-ai-content-generator'),
            'upload' => esc_html__('Upload','gpt3-ai-content-generator'),
            'manual' => esc_html__('Manual Entry','gpt3-ai-content-generator'),
            'data' => esc_html__('Data Converter','gpt3-ai-content-generator'),
            'files' => esc_html__('Datasets','gpt3-ai-content-generator'),
            'fine-tunes' => esc_html__('Trainings','gpt3-ai-content-generator')

        ), $wpaicg_action);
        if(!$wpaicg_action || $wpaicg_action == 'preparation'){
            $wpaicg_action = 'help';
        }
        ?>
    </h2>
    <div id="poststuff">
        <?php
        include(WPAICG_PLUGIN_DIR.'admin/views/finetune/'.$wpaicg_action.'.php');
        ?>
    </div>
</div>
