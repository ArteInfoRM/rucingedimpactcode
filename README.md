# Reduce the impact of third-party code

`rucingedimpactcode` 1.0.9 by Tecnoacquisti.com® (Arte e Informatica di Loris Modena e C. s.a.s.).

The module adds connection hints for Google Fonts, Google Analytics and Google Tag Manager. It can load the full jQuery 3.7.1 or 4.0.0 build locally or from a selectable CDN and insert merchant-defined HTML and JavaScript in the storefront head. Performance depends on the theme, other modules and the resources used; connection hints do not guarantee a faster page.

## Requirements and compatibility

- PrestaShop 1.7 and later, including the 8.x and 9.x workspace targets. The existing entry point declares minimum `1.7` and uses the running `_PS_VERSION_` as its maximum. This declaration is preserved; it is not evidence that every release has been tested.
- Use the PHP version supported by the installed PrestaShop release. No separate PHP minimum was declared in the supplied module; this review does not introduce one.
- The module uses the legacy Module, Configuration, HelperForm and Smarty APIs supplied by PrestaShop. No Composer or npm installation is required.
- Actual compatibility across the declared versions requires functional installation and upgrade checks by the project owner.

## Installation and configuration

Back up the shop database and files. Install a module ZIP containing one top-level `rucingedimpactcode/` directory using the PrestaShop Module Manager, then open the module configuration.

1. Enable only the connection hints required by the shop.
2. Select jQuery mode: `0` disabled, `1` bundled local copy, `2` Google CDN, `3` official jQuery CDN, `4` cdnjs or `5` jsDelivr. Existing mode `3` selections now use the official jQuery CDN instead of Microsoft. Check whether the theme already loads jQuery before enabling another copy.
3. Select jQuery version: `3.7.1` is preselected for new and existing installations without a saved version. Selecting `4.0.0` uses that version for the chosen local/CDN mode. Google mode uses the official jQuery CDN for `4.0.0`, because the corresponding Google URL is unavailable. Version 4 removes some older APIs: test the theme and its plugins before switching. The version selection does not enable jQuery when the loading mode is disabled.
4. Select the output position: `0` displayHeader, `1` displayAfterTitleTag or `2` displayReduceImpact. Availability and placement depend on the theme. For the custom position, place `{hook h='displayReduceImpact'}` in the child theme head template.
5. Review and save any custom directives, then inspect the page source and browser network panel in staging.

The provider and version controls are validated server-side before settings are written. Fixed CDN script tags include version-specific Subresource Integrity (SRI) and `crossorigin="anonymous"`. A response that does not match the expected file is blocked by the browser. Local mode uses `views/js/jquery.min.js` for 3.7.1 and `views/js/jquery-4.0.0.min.js` for 4.0.0; it does not add SRI/CORS requirements to shop or media-server delivery. If the shop restricts script hosts with CSP, allow the selected provider, including `code.jquery.com` for the replacement of Microsoft or Google mode with 4.0.0.

## Custom directives and external requests

Custom directives are executable HTML and JavaScript, not plain text. They are rendered without escaping by design in the supplied implementation. Only trusted employees should have permission to change this module configuration. Do not paste unreviewed snippets, credentials, access tokens or personal data. Restrictions on script sources, inline scripts, input size and permitted markup are not implemented in this version; the owner requested that this behavior remain unchanged during the 2026-10-21 documentation review.

Connection hints and CDN scripts can contact third-party hosts from visitors' browsers. Assess their use alongside the shop consent setup and Content Security Policy; this module does not implement consent gating. Local jQuery mode avoids a jQuery CDN request. Disabling the jQuery mode does not disable JavaScript supplied by the theme, other modules or custom directives.

The first versioned package of these reviewed sources is `v1.0.7` (2026-10-21). This packaging date does not establish the original release date of the supplied module.

## Updating, disabling and removal

Obtain update and advisory information through the [Help Center](https://help.tecnoacquisti.com/) or [helpdesk@tecnoacquisti.com](mailto:helpdesk@tecnoacquisti.com). Back up first, read the changelog and test the actual release ZIP in staging before applying it to a live shop.

The historical 1.0.7 upgrade stores old directives in `rucingedimpactcode_tags` and removes the configuration value, while the supplied renderer still reads the configuration value. This review does not alter that migration. Preserve custom snippets separately before an upgrade and verify their effective output afterwards. Do not assume that the archived table is read by the storefront.

Disabling the module stops its hooks. Uninstalling deletes its seven configuration keys, including the jQuery version preference. The historical tags table is not removed by the supplied uninstall method; assess its retention separately and do not treat uninstall as complete snippet data erasure. Cache clearing and storefront checks may be needed after a configuration change.

## Documentation, license and security

- `CHANGELOG.md`: change history
- `SECURITY.md`: security reporting and support status
- `THIRD-PARTY-NOTICES.md`: dependency and license notices
- `CRA.md`: scope and limitations of this review

Module-owned code and documentation are licensed under the MIT License in `LICENSE.md`, as explicitly authorized by the owner on 2026-10-21. Bundled jQuery keeps its own MIT copyright notice and license. PrestaShop-derived directory guards retain AFL-3.0; see `licenses/AFL-3.0.txt`. Brand assets identify Tecnoacquisti.com; the software license does not grant trademark rights.

HTML copies of this README and the changelog are generated under `documentation/` using the shared workspace generator. Markdown remains the source of truth.
