# Changelog


## v3.0.1 - 2026-10-18

_(most recent changes are listed on top):_
- FIX: Use Kanboard's primary theme text colour for secondary URL-management text so the light theme clears normal-text contrast requirements


## v3.0.0 - 2026-10-18

_(unreleased):_
- Rebuilt route discovery around Kanboard 1.2.54 native routes
- Registered aliases only for installed supported plugins with available controller actions
- Prevented URLCleaner from replacing native Kanboard or plugin routes
- Restricted settings to application administrators and validated all settings submissions
- Added responsive light and dark presentation with reduced-motion support
- Bound plug-in colours to the selected Kanboard theme instead of the operating-system colour preference
- Added complete British and American English translation catalogues
- Added focused permission, route, presentation, translation and integration regression checks
- Added PHP 8.2 to 8.5 compatibility automation
- Removed the unnecessary repository secret scan from the feature-focused linter workflow
- No database changes


## v2.0

_(most recent changes are listed on top):_
- FIX: Add Hint to Core Section for Latest Version - #6
- NEW: Apply Core Routes for Older Versions - all core routes merged into the core since v1.2.28 - keep routes for older versions - relates to 1f6069a - fixes #6
- FIX: Conflicting Route for KB 1.2.28+ - fixes #6
- FIX: Code Syntax
- FIX: CSS Code Syntax
- FIX: README Navigation Links for GitHub
- FIX: Markdown Syntax
- FIX: Code Syntax
- NEW: Add Footer Badges to README.md
- NEW: Add Section Navigation Links to README.md
- NEW: Add Badges to README.md
- NEW: Add README Page Navigation Links
- FIX: Content Flow for README.md


## v1.6

_(most recent changes are listed on top):_
- FIX: Update Kanboard Links
- NEW: Add CostControl Compatibility - disable routes and show badge if CostControl is installed - fixes #4


## v1.5

_(most recent changes are listed on top):_
- Add route `/settings/link-labels/:link_id/delete`
- Add route `/settings/link-labels/:link_id/edit`
- Add route `/settings/link-labels/add`
- Add route `/settings/currencies/change`
- Add route `/settings/currencies/add`
- FIX: Route Caused Error `/settings/currencies`
- Add route `/project/:project_id/task/:task_id/delete`
- Add route `/project/:project_id/task/:task_id/files/screenshots/add`
- Update screenshots


## v1.0

_(most recent changes are listed on top):_
- Initial release
- Translations starter template included

---

Read the full [**Changelog**](../master/changelog.md "See changes") or view the [**README**](../master/README.md "View README")
