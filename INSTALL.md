# Plugin Installation

> **Compatibility:** URLCleaner 3.0.0 requires Kanboard 1.2.54 or later and URL rewriting must be configured before plugin aliases can be enabled. The plugin has no database migrations.

- **Install via the [Kanboard](https://github.com/kanboard/kanboard "Kanboard - Kanban Project Management Software") Plugin Directory**
  - _Go to:_
    - Kanboard: `Plugins` &#10562; `Plugin Directory`
  - _or with [PluginManager](https://github.com/aljawaid/PluginManager "A Kanboard plugin") installed:_
    - Kanboard: `Settings` &#10562; `Plugins` &#10562; `Plugin Directory`
- **Install via the [Releases](../master/Releases/ "A copy of each release is saved in the folder") folder**
  - The `/Releases` folder contains historical packaged releases; use the latest published release for a new installation
  - Simply extract the `.zip` file into the `/plugins` directory
- **Install via [GitHub](https://github.com/ "Find the correct plugin from the list of repositories")**
  - Download the `.zip` file and decompress everything under the directory `/plugins`
  - The folder inside the `.zip` must not contain any branch names and must be exact case (matching the plugin name)

_Note: The `/plugins` folder is case-sensitive._

After installation, sign in as an application administrator and open `Settings` &#10562; `URL Cleaner`. URLCleaner ignores supported integrations that are not installed and will not replace routes already supplied by Kanboard or another plugin.

- **Install using Git CLI**
  - `git clone` (_or ftp upload_) and extract the `.zip` file into this folder: `.\plugins\` (must be exact case)

---

Read the full [**Changelog**](../master/changelog.md "See changes") or view the [**README**](../master/README.md "View README")
