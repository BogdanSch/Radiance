<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$wpaicg_action = isset($_GET['action']) && !empty($_GET['action']) ? sanitize_text_field($_GET['action']) : '';
$checkRole = \WPAICG\wpaicg_roles()->user_can('wpaicg_audio',empty($wpaicg_action) ? 'converter' : $wpaicg_action);
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
        if(empty($wpaicg_action)){
            $wpaicg_action = 'converter';
        };
        \WPAICG\wpaicg_util_core()->wpaicg_tabs('wpaicg_audio',array(
            'converter' => esc_html__('Audio Converter','gpt3-ai-content-generator'),
            'logs' => esc_html__('Logs','gpt3-ai-content-generator')
        ),$wpaicg_action);
        if(!$wpaicg_action || $wpaicg_action == 'converter'){
            $wpaicg_action = '';
        }
        ?>
    </h2>
</div>
<div id="poststuff">
    <?php
    if(empty($wpaicg_action)){
        include __DIR__.'/converter.php';
    }
    if($wpaicg_action == 'logs'){
        include __DIR__.'/logs.php';
    }
    ?>
</div>
