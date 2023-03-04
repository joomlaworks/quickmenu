<?php
/**
 * @version    1.0
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
$canAccessAdminTasks = ($isSuperAdmin || $user->authorise('core.manage', 'com_config') || $user->authorise('core.manage', 'com_modules') || $user->authorise('core.manage', 'com_users') || $user->authorise('core.manage', 'com_installer') || $user->authorise('core.manage', 'com_checkin') || $user->authorise('core.manage', 'com_cache')) ? true : false;

// CSS
$gridColumns = '1fr';
if ($canAccessAdminTasks) {
    $gridColumns = '1fr 1fr';
}
$document = Factory::getDocument();
$document->addStyleDeclaration('

    /* Styles for Admin Quick Menu [start] */
    .header .dropdown-menu.aqm_container {border:0;border-radius:5px;background:var(--template-bg-dark-70);}
    .aqm_grid {display:grid;grid-template-columns:'.$gridColumns.';grid-gap:15px;padding:15px;}
    .aqm_grid > div > .aqm_list_header {background:none;color:#98a6b9;font-size:1.1rem;margin:0 0 5px 0;padding:5px 15px;white-space:nowrap;}
    .aqm_grid > div > a.dropdown-item {margin:0;padding:15px;border-top:0;border-bottom:1px solid var(--template-bg-dark-80);}
    .aqm_grid > div > a.dropdown-item:last-child {border:0;}
    @media only screen and (max-width:1024px) {
        .aqm_grid > div > .aqm_list_header {white-space:normal;line-height:120%;}
    }
    /* Styles for Admin Quick Menu [finish] */

');

// Load the Bootstrap Dropdown
HTMLHelper::_('bootstrap.dropdown', '.dropdown-toggle');

?>
<div class="header-item-content dropdown header-profile">
    <button class="dropdown-toggle d-flex align-items-center ps-0 py-0" data-bs-toggle="dropdown" type="button" title="<?php echo Text::_('MOD_JW_QM_TITLE'); ?>">
        <div class="header-item-icon">
            <span class="icon-ellipsis-v" aria-hidden="true"></span>
        </div>
        <div class="header-item-text">
            <?php echo Text::_('MOD_JW_QM_TITLE'); ?>
        </div>
        <span class="icon-angle-down" aria-hidden="true"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-end aqm_container">
        <div class="aqm_grid">
            <div>
                <div class="aqm_list_header">
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
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_plugins')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_plugins'); ?>">
                    <span class="icon-plug icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_PLUGINS'); ?>
                </a>
                <?php endif; ?>
            </div>
            <?php if ($canAccessAdminTasks): ?>
            <div>
                <div class="aqm_list_header">
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
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_users')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_users'); ?>">
                    <span class="icon-users icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_USERS'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_joomlaupdate'); ?>">
                    <span class="icon-joomla icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_UPDATE_JOOMLA'); ?>
                </a>
                <?php endif; ?>
                <?php if ($isSuperAdmin || $user->authorise('core.manage', 'com_installer')): ?>
                <a class="dropdown-item" href="<?php echo Route::_('index.php?option=com_installer&view=update'); ?>">
                    <span class="icon-puzzle-piece icon-fw" aria-hidden="true"></span>
                    <?php echo Text::_('MOD_JW_QM_UPDATE_EXTENSIONS'); ?>
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
        </div>
    </div>
</div>
