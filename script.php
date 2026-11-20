<?php
/**
 * @version    2.0
 * @package    Quick Menu (admin module)
 * @author     JoomlaWorks https://www.joomlaworks.net
 * @copyright  Copyright (c) 2009 - 2026 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL: https://gnu.org/licenses/gpl.html
 */

defined('_JEXEC') or die;

use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScript;

/**
 * Installer script for mod_jw_quickmenu.
 */
class mod_jw_quickmenuInstallerScript extends InstallerScript
{
    /**
     * Extension name.
     *
     * @var  string
     */
    protected $extension = 'mod_jw_quickmenu';

    /**
     * Files to delete during update/install housekeeping (relative to JPATH_ROOT).
     *
     * @var  array
     */
    protected $deleteFiles = [
        '/administrator/modules/mod_jw_quickmenu/mod_jw_quickmenu.php',
    ];

    /**
     * Folders to delete during update/install housekeeping (relative to JPATH_ROOT).
     *
     * @var  array
     */
    protected $deleteFolders = [];

    /**
     * Method to run after an install/update/discover_install method.
     *
     * @param   string            $type    The type of change (install, update, or discover_install).
     * @param   InstallerAdapter  $parent  The class calling this method.
     *
     * @return  bool
     */
    public function postflight($type, $parent): bool
    {
        if (\in_array($type, ['install', 'update', 'discover_install'], true)) {
            $this->removeFiles();
        }

        return true;
    }
}
