<h1 name="user-content-readme-top">URLCleaner</h1>
<p align="center">
    <a href="https://github.com/aljawaid/URLCleaner/releases">
        <img src="https://img.shields.io/github/v/release/aljawaid/URLCleaner?style=for-the-badge&color=brightgreen" alt="GitHub Latest Release (by date)" title="GitHub Latest Release (by date)">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/releases">
        <img src="https://img.shields.io/github/downloads/aljawaid/URLCleaner/total?style=for-the-badge&color=orange" alt="GitHub All Releases" title="GitHub All Downloads">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/releases">
        <img src="https://img.shields.io/github/directory-file-count/aljawaid/URLCleaner?style=for-the-badge&color=orange" alt="GitHub Repository File Count" title="GitHub Repository File Count">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/releases">
        <img src="https://img.shields.io/github/repo-size/aljawaid/URLCleaner?style=for-the-badge&color=orange" alt="GitHub Repository Size" title="GitHub Repository Size">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/releases">
        <img src="https://img.shields.io/github/languages/code-size/aljawaid/URLCleaner?style=for-the-badge&color=orange" alt="GitHub Code Size" title="GitHub Code Size">
    </a>
</p>
<p align="center">
    <a href="https://github.com/aljawaid/URLCleaner/discussions">
        <img src="https://img.shields.io/github/discussions/aljawaid/URLCleaner?style=for-the-badge&color=blue" alt="GitHub Discussions" title="Read Discussions">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/compare">
        <img src="https://img.shields.io/github/commits-since/aljawaid/URLCleaner/latest?include_prereleases&style=for-the-badge&color=blue" alt="GitHub Commits Since Last Release" title="GitHub Commits Since Last Release">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/compare">
        <img src="https://img.shields.io/github/commit-activity/m/aljawaid/URLCleaner?style=for-the-badge&color=blue" alt="GitHub Commit Monthly Activity" title="GitHub Commit Monthly Activity">
    </a>
    <a href="https://github.com/kanboard/kanboard" title="Kanboard - Kanban Project Management Software">
        <img src="https://img.shields.io/badge/Plugin%20for-kanboard-D40000?style=for-the-badge&labelColor=000000" alt="Kanboard">
    </a>
</p>

URLCleaner adds compatibility aliases for supported Kanboard plugins when they do not already provide a clean route. Native Kanboard routes are displayed for reference and are never replaced. [URL rewriting](https://docs.kanboard.org/v1/admin/url-rewriting/) must be configured before aliases can be enabled.

<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#screenshots">&#8594; Next</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## Features

- Show current native Kanboard routes without registering or overriding them
- Add aliases only when the related plugin is installed, its controller action exists and no native route is available
- Restrict application-wide settings to Kanboard administrators
- Validate settings submissions and persist only the URLCleaner option
- Provide a responsive settings page with automatic light and dark presentation
- Respect reduced-motion preferences while retaining smooth hover and focus transitions
- Support clean aliases for:
  - [Bigboard](https://github.com/TimoStahl/kanboard_plugin_bigboard)
  - [Wiki](https://github.com/funktechno/kanboard-plugin-wiki)
  - [Calendar](https://github.com/kanboard/plugin-calendar) (upstream repository archived)
  - [MetaMagik](https://github.com/creecros/MetaMagik)

URLCleaner checks these integrations at startup. Unsupported, missing or incompatible plugins are ignored instead of receiving unusable routes.

<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#features">&#8592; Previous</a>] [<a href="#usage">&#8594; Next</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## Screenshots

**URL Management**  

![URL Management](../master/screenshot-url-cleaner.png)

![URL Management](../master/screenshot-url-cleaner-plugins.png)

<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#features">&#8592; Previous</a>] [<a href="#installation--compatibility">&#8594; Next</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## Usage

1. Configure URL rewriting for Kanboard.
2. Sign in as an application administrator.
3. Go to `Settings` &#10562; `URL Cleaner`.
4. Review the detected native and installed-plugin routes.
5. Enable plugin aliases and save the setting.

If URL rewriting is unavailable, URLCleaner shows setup guidance and does not register aliases.

<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#screenshots">&#8592; Previous</a>] [<a href="#authors--contributors">&#8594; Next</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## Installation & Compatibility

<details>
    <summary><strong>Installation</strong></summary>

- Install via the **[Kanboard](https://github.com/kanboard/kanboard "Kanboard - Kanban Project Management Software") Plugin Directory** or see [INSTALL.md](../master/INSTALL.md)
- Read the full [**Changelog**](../master/changelog.md "See changes") to see the latest updates

</details>
<details>
    <summary><strong>Compatibility</strong></summary>

- Requires [Kanboard](https://github.com/kanboard/kanboard "Kanboard - Kanban Project Management Software") ≥`1.2.54`
- Regression-tested with PHP `8.2`, `8.3`, `8.4` and `8.5`
- **Other Plugins & Action Plugins**
  - Aliases are registered only for supported plugins that are currently installed
  - Existing native plugin routes take precedence
  - Calendar support is retained for existing installations, but its upstream repository is archived
- **Core Files & Templates**
  - _No template overrides_
  - _No database changes_

</details>
<details>
    <summary><strong>Translations</strong></summary>

- English (United Kingdom)
- English (United States)
- Starter template available for additional languages

</details>

<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#usage">&#8592; Previous</a>] [<a href="#license">&#8594; Next</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## Authors & Contributors

- [@aljawaid](https://github.com/aljawaid) - Author
- _Contributors welcome_

<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#installation--compatibility">&#8592; Previous</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## License

- This project is distributed under the [MIT License](../master/LICENSE "Read The MIT license")

---

<p align="center">
    <a href="https://github.com/aljawaid/URLCleaner/stargazers" title="View Stargazers">
        <img src="https://img.shields.io/github/stars/aljawaid/URLCleaner?logo=github&style=flat-square" alt="URLCleaner">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/forks" title="See Forks">
        <img src="https://img.shields.io/github/forks/aljawaid/URLCleaner?logo=github&style=flat-square" alt="URLCleaner">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/blob/master/LICENSE" title="Read License">
        <img src="https://img.shields.io/github/license/aljawaid/URLCleaner?style=flat-square" alt="URLCleaner">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/issues" title="Open Issues">
        <img src="https://img.shields.io/github/issues-raw/aljawaid/URLCleaner?style=flat-square" alt="URLCleaner">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/issues?q=is%3Aissue+is%3Aclosed" title="Closed Issues">
        <img src="https://img.shields.io/github/issues-closed/aljawaid/URLCleaner?style=flat-square" alt="URLCleaner">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/discussions" title="Read Discussions">
        <img src="https://img.shields.io/github/discussions/aljawaid/URLCleaner?style=flat-square" alt="URLCleaner">
    </a>
    <a href="https://github.com/aljawaid/URLCleaner/compare/" title="Latest Commits">
        <img alt="GitHub commits since latest release (by date)" src="https://img.shields.io/github/commits-since/aljawaid/URLCleaner/latest?style=flat-square">
    </a>
</p>
<a name="user-content-readme-bottom"></a>
<p align="right">[<a href="#user-content-readme-top">&#8593; Top</a>]</p>
