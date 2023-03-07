<?php
/**
 * @version    1.1
 * @package    Quick Menu (admin module)
 * @author     JoomlaWorks https://www.joomlaworks.net
 * @copyright  Copyright (c) 2009 - 2023 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL: https://gnu.org/licenses/gpl.html
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

// ACL
$user = Factory::getUser();
$isSuperAdmin = $user->authorise('core.admin', 'com_config');
$canAccessAdminTasks = ($isSuperAdmin || $user->authorise('core.manage', 'com_config') || $user->authorise('core.manage', 'com_modules') || $user->authorise('core.manage', 'com_plugins') || $user->authorise('core.manage', 'com_users') || $user->authorise('core.manage', 'com_checkin') || $user->authorise('core.manage', 'com_cache')) ? true : false;

// CSS
$gridColumns = '1fr';
if ($canAccessAdminTasks) {
    $gridColumns = '1fr 1fr';
}
$document = Factory::getDocument();
$document->addStyleDeclaration('

    /* Styles for Admin Quick Menu [start] */
    .jw_qm_container {position:relative;margin-left:30px;}
    a.jw_qm_home_link {display:block;position:absolute;top:10px;left:-30px;}
    .jw_qm_container > .dropdown-menu.jw_qm_menu {border:0;border-radius:5px;background:var(--template-bg-dark-70);overflow:hidden;}
    .jw_qm_grid {display:grid;grid-template-columns:'.$gridColumns.';grid-gap:0;}
    .jw_qm_grid > div {padding:15px 15px 5px;}
    .jw_qm_grid > div > .jw_qm_list_header {background:none;color:#98a6b9;font-size:1.1rem;margin:0 0 5px 0;padding:5px 0;white-space:nowrap;}
    .jw_qm_grid > div > a.dropdown-item {margin:0;padding:15px 5px;border-top:0;border-bottom:1px solid var(--template-bg-dark-80);}
    .jw_qm_grid > div > a.dropdown-item:last-child {border:0;}
    .jw_qm_grid > div.jw_qm_grid_cell_bottom {grid-area:2/1/span 1/span 2;background:var(--template-bg-dark-90);border-top:2px solid var(--template-bg-dark-60);display:flex;align-items:center;justify-content:space-evenly;padding:5px;gap:5px;}
    .jw_qm_grid_cell_bottom .jw_qm_ext_label {color:#98a6b9;display:inline-block;font-weight:normal;font-size:0.75rem;justify-self:flex-end;}
    .jw_qm_grid_cell_bottom .jw_qm_ext_label span {font-size:0.85rem;}
    .jw_qm_grid_cell_bottom .jw_qm_ext_actions {background:var(--template-bg-dark);border-radius:5px;overflow:hidden;}
    .jw_qm_grid_cell_bottom .jw_qm_ext_actions a {padding:5px 8px;margin:0;display:inline-block;font-size:0.8rem;}
    .jw_qm_grid_cell_bottom .jw_qm_ext_actions a:hover {background:var(--template-bg-dark-50);}
    .jw_qm_grid_cell_bottom .jw_qm_ext_actions a:nth-child(2) {border-left:1px solid var(--template-bg-dark-90);border-right:1px solid var(--template-bg-dark-90);}
    .jw_qm_grid_cell_bottom .jw_qm_jupdate {padding-left:10px;}
    .jw_qm_grid_cell_bottom .jw_qm_jupdate a {padding:5px;display:inline-block;font-size:0.8rem;}
    .jw_qm_grid_cell_bottom .jw_qm_jupdate a:hover {color:var(--template-bg-dark-30);}
    .jw_qm_grid_cell_bottom .jw_qm_jupdate a b {font-weight:inherit;}
    @media only screen and (max-width:1024px) {
        .jw_qm_container {position:relative;margin-left:0;}
        a.jw_qm_home_link {display:none;}
        .jw_qm_container > .dropdown-menu.jw_qm_menu {margin-bottom:10px !important;}
        .jw_qm_grid > div > .jw_qm_list_header {white-space:normal;line-height:120%;}
        .jw_qm_grid_cell_bottom .jw_qm_ext_actions a {padding:10px 5px;}
        .jw_qm_grid_cell_bottom .jw_qm_jupdate {padding-left:5px;}
        .jw_qm_grid_cell_bottom .jw_qm_jupdate a b {display:none;}
    }
    /* Styles for Admin Quick Menu [finish] */

');

// Load the Bootstrap Dropdown
HTMLHelper::_('bootstrap.dropdown', '.dropdown-toggle');

?>
<div class="header-item-content dropdown header-profile jw_qm_container">
    <a class="jw_qm_home_link" href="<?php echo Route::_('index.php'); ?>" title="<?php echo Text::_('MOD_JW_QM_DASHBOARD'); ?>">
        <span class="icon-home" aria-hidden="true"></span>
    </a>
    <button class="dropdown-toggle d-flex align-items-center ps-0 py-0" data-bs-toggle="dropdown" type="button" title="<?php echo Text::_('MOD_JW_QM_TITLE'); ?>">
        <div class="header-item-icon">
            <span class="icon-ellipsis-v" aria-hidden="true"></span>
        </div>
        <div class="header-item-text">
            <?php echo Text::_('MOD_JW_QM_TITLE'); ?>
        </div>
        <span class="icon-angle-down" aria-hidden="true"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-end jw_qm_menu">
        <div class="jw_qm_grid">
            <div class="jw_qm_grid_cell_left">
                <div class="jw_qm_list_header">
                    <?php echo Text::_('MOD_JW_QM_CONTENT_MANAGEMENT'); ?>
                </div>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_content')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_content'); ?>">
                    <span class="icon-file-alt icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_ARTICLES'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin || $user->authorise('core.edit', 'com_content.category')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_categories&view=categories&extension=com_content'); ?>">
                    <span class="icon-folder icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_CATEGORIES'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_tags')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_tags'); ?>">
                    <span class="icon-tags icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_TAGS'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_media')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_media'); ?>">
                    <span class="icon-images icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_MEDIA_MANAGER'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_menus')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_menus'); ?>">
                    <span class="icon-list icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_MENUS'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_modules')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_modules&view=modules&client_id=0'); ?>">
                    <span class="icon-cube icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_MODULES'); ?>
                </a>
                <?php endif; ?>
            </div>
            <?php if ($canAccessAdminTasks): ?>
            <div class="jw_qm_grid_cell_right">
                <div class="jw_qm_list_header">
                    <?php echo Text::_('MOD_JW_QM_COMMON_ADMIN_TASKS'); ?>
                </div>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_config')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_config'); ?>">
                    <span class="icon-cog icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_GLOBAL_CONFIGURATION'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_modules')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_modules&view=modules&client_id=1'); ?>">
                    <span class="icon-cube icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_MODULES_ADMIN'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_plugins')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_plugins'); ?>">
                    <span class="icon-plug icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_PLUGINS'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_users')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_users'); ?>">
                    <span class="icon-users icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_USERS'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_checkin')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_checkin'); ?>">
                    <span class="icon-check-square icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_GLOBAL_CHECK_IN'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_cache')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_cache'); ?>">
                    <span class="icon-bolt icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_CLEAR_CACHE'); ?>
                </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_installer')): ?>
            <div class="jw_qm_grid_cell_bottom">
                <?php if ($user->authorise('core.manage', 'com_installer')): ?>
                <div class="jw_qm_ext_label">
                    <span class="icon-puzzle-piece icon-fw" aria-hidden="true"></span> <?php echo Text::_('MOD_JW_QM_EXTENSIONS'); ?>
                </div>
                <div class="jw_qm_ext_actions">
                    <a href="<?php echo Route::_('index.php?option=com_installer&view=manage'); ?>"><?php echo Text::_('MOD_JW_QM_MANAGE'); ?></a><a href="<?php echo Route::_('index.php?option=com_installer&view=update'); ?>"><?php echo Text::_('MOD_JW_QM_UPDATE'); ?></a><a href="<?php echo Route::_('index.php?option=com_installer&view=install'); ?>"><?php echo Text::_('MOD_JW_QM_INSTALL'); ?></a>
                </div>
                <?php endif; ?>
                <?php if ($isSuperAdmin): ?>
                <div class="jw_qm_jupdate">
                    <a href="<?php echo Route::_('index.php?option=com_joomlaupdate'); ?>">
                        <span class="icon-joomla icon-fw" aria-hidden="true"></span>
                        <?php echo Text::_('MOD_JW_QM_JOOMLA_UPDATE'); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
