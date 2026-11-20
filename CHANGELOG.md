# Changelog

All notable changes to **Quick Menu** (`mod_jw_quickmenu`) are documented in this file.

## [2.0] - 2026-11-20

### Added
- Full support for **Joomla 4, 5, and 6** using Joomla's modern DI container architecture (`services/provider.php` and `src/Dispatcher/Dispatcher.php` extending `AbstractModuleDispatcher`).
- New SVG, PNG, and WebP logos and icons in `media/mod_jw_quickmenu/logo/` (including light and dark variants).
- GitHub Pages update server manifest (`docs/update.xml`) supporting Joomla 4, 5, and 6.
- `CHANGELOG.md` documenting project history from v1.0 onward.

### Changed
- Renamed module from **Quick Menu (by JoomlaWorks)** to **Quick Menu**.
- Replaced deprecated/removed `Factory::getUser()` and `Factory::getDocument()` calls with `$app->getIdentity()` and `$app->getDocument()` (`WebAssetManager::addInlineStyle()`).
- Updated `<updateservers>` in `mod_jw_quickmenu.xml` to point to `https://joomlaworks.github.io/quickmenu/update.xml`.
- Updated module description, language files, and `README.md` with the new logo, Joomla 4/5/6 compatibility, and v2.0 release metadata.

### Removed
- Removed legacy procedural entrypoint `mod_jw_quickmenu.php` in favor of `services/provider.php`.

## [1.1] - 2023-03-07

### Added
- Added Spanish (`es-ES`) translation (`language/es-ES/`).

### Changed
- Updated post-installation message link to auto-filter Administrator Modules by `filter[module]=mod_jw_quickmenu`.
- Updated `README.md` and preview assets.

## [1.0] - 2023-03-04

### Added
- Initial release of Quick Menu for Joomla 4.
- Two-column backend dropdown menu in the `status` position for **Content Management** and **Common Admin Tasks**, respecting user group ACL permissions.
- Responsive mobile layout adjustments.
