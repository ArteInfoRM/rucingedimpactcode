# Third-party notices

This inventory covers `rucingedimpactcode` 1.0.9, updated on 2026-10-21 by Tecnoacquisti.com®.

## Bundled jQuery

The module includes both full minified builds. The merchant selects which version is loaded; 3.7.1 remains the default.

| Version | Distributed file | Official distribution | Distributed SHA-256 |
| --- | --- | --- | --- |
| 3.7.1 | `views/js/jquery.min.js` | https://code.jquery.com/jquery-3.7.1.min.js | `0a5c63ec13758f3b560e52bdce30010d7ab40beb01154f0ed34e9435204f2e4b` |
| 4.0.0 | `views/js/jquery-4.0.0.min.js` | https://code.jquery.com/jquery-4.0.0.min.js | `a09b6025ec2f65814edded022db2d67c94c05e56e27dbb6b44a126d7467b3376` |

Both files retain their upstream copyright header: OpenJS Foundation and other contributors, https://openjsf.org/. A validator-readable MIT comment with author, copyright and license tags is prepended for packaging. The original upstream banner and executable code remain byte-for-byte unchanged after this added comment. The complete license is included at `licenses/jquery-MIT.txt`; the upstream legal texts for 3.7.1 and 4.0.0 are identical. The module's own license does not replace those notices.

The original upstream SHA-256 values are `fc9a93dd241f6b045cbff0481cf4e1901becd0e12fb45166a8f17f95823f0b1a` for 3.7.1 and `39a546ea9ad97f8bfaf5d3e0e8f8556adb415e470e59007ada9759dce472adaa` for 4.0.0. CDN SRI continues to verify those upstream files; local loading does not use SRI. Adding the local packaging comment does not change the CDN hashes.

Sources and legal texts:

- https://github.com/jquery/jquery/tree/3.7.1
- https://github.com/jquery/jquery/tree/4.0.0
- https://raw.githubusercontent.com/jquery/jquery/3.7.1/LICENSE.txt
- https://raw.githubusercontent.com/jquery/jquery/4.0.0/LICENSE.txt

## PrestaShop-derived directory guards

The supplied `index.php` files in the module root and existing subdirectories carry PrestaShop SA copyright, 2007-2022, and AFL-3.0 license headers. They are retained under their original license. The complete legal text is included at `licenses/AFL-3.0.txt`. No upstream commit or exact PrestaShop version was available; the header year is not a component version.

During this review the license-file reference was corrected and comment alignment and line endings were normalized; executable guard code remains unchanged. The new guards in `documentation/` and `licenses/` are module-owned and MIT-licensed.

## Platform-provided software

PrestaShop supplies the Module, Configuration, HelperForm, ObjectModel and database APIs and the Smarty renderer. The module does not bundle the PrestaShop application, Smarty, PHP, MySQL or the platform's back-office assets. Their versions depend on the installed shop and their original licenses remain applicable. No Composer/npm manifest, lockfile, vendor directory, separate SDK, CSS library or font file was found in this module.

`logo.png` and `views/img/logo-tecnoacquisti.svg` are Tecnoacquisti.com brand assets. Trademark rights are not granted by the module software license.

## Optional external jQuery delivery

CDNs are external delivery providers, not additional libraries bundled in the module. Requests use exact versioned URLs. Let `VERSION` be the selected `3.7.1` or `4.0.0`:

| Mode | Provider | Script endpoint |
| --- | --- | --- |
| 2 | Google Hosted Libraries for 3.7.1 | https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js |
| 2, version 4.0.0 | Official jQuery CDN fallback | https://code.jquery.com/jquery-4.0.0.min.js |
| 3 | Official jQuery CDN | `https://code.jquery.com/jquery-VERSION.min.js` |
| 4 | cdnjs | `https://cdnjs.cloudflare.com/ajax/libs/jquery/VERSION/jquery.min.js` |
| 5 | jsDelivr | `https://cdn.jsdelivr.net/npm/jquery@VERSION/dist/jquery.min.js` |

Mode 3 replaces the former Microsoft Ajax CDN choice. Existing saved provider IDs are preserved; the destination changes to the official jQuery CDN. No Microsoft script URL is used by the module's predefined loading modes.

All predefined CDN tags include version-specific SHA-384 SRI and `crossorigin="anonymous"`. For each available endpoint, HTTPS status, CORS headers and exact response bytes were checked against the official version. These checks do not guarantee future availability. A file that changes unexpectedly will fail browser integrity verification. Merchant-defined directives are outside this fixed resource contract and remain unfiltered.

## Optional connection hints and merchant snippets

The fixed Google Fonts hints address `https://fonts.googleapis.com` and `https://fonts.gstatic.com`; the Analytics hints address `https://www.google-analytics.com/`; the Tag Manager hint addresses `https://www.googletagmanager.com/`. These hints do not themselves bundle fonts, Analytics or Tag Manager scripts. They can still initiate browser DNS lookups or connections.

Merchant-defined directives can add further code, libraries and remote destinations. Their contents are stored in the individual shop database and are not part of the delivered source inventory. The merchant must review those dependencies separately. This source review does not inventory production shop configuration, the theme or separately installed modules.
