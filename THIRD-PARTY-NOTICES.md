# Third-party notices

This inventory covers `rucingedimpactcode` 1.0.7 as reviewed on 2026-10-21 by Tecnoacquisti.com®.

## Bundled jQuery

| Field | Inventory |
| --- | --- |
| Component | jQuery 3.7.1 |
| Origin | https://github.com/jquery/jquery/tree/3.7.1 |
| Distributed file | `views/js/jquery.min.js` |
| Distribution | Included; loaded only when local jQuery mode is selected |
| License | MIT |
| Copyright | OpenJS Foundation and other contributors, https://openjsf.org/ |
| Complete legal text | `licenses/jquery-MIT.txt` |
| Local modifications | None detected: SHA-256 equals the official minified distribution |
| SHA-256 | `fc9a93dd241f6b045cbff0481cf4e1901becd0e12fb45166a8f17f95823f0b1a` |

The upstream comparison used https://code.jquery.com/jquery-3.7.1.min.js. The license was retrieved from https://raw.githubusercontent.com/jquery/jquery/3.7.1/LICENSE.txt. Its header and copyright have been preserved; the module license does not replace them.

## PrestaShop-derived directory guards

The supplied `index.php` files in the module root and existing subdirectories carry PrestaShop SA copyright, 2007-2022, and AFL-3.0 license headers. They are retained under their original license. The complete legal text is included at `licenses/AFL-3.0.txt`. No upstream commit or exact PrestaShop version was available; the header year is not a component version.

During this review the license-file reference was corrected and comment alignment and line endings were normalized; executable guard code remains unchanged. The new guards in `documentation/` and `licenses/` are module-owned and MIT-licensed.

## Platform-provided software

PrestaShop supplies the Module, Configuration, HelperForm, ObjectModel and database APIs and the Smarty renderer. The module does not bundle the PrestaShop application, Smarty, PHP, MySQL or the platform's back-office assets. Their versions depend on the installed shop and their original licenses remain applicable. No Composer/npm manifest, lockfile, vendor directory, separate SDK, CSS library or font file was found in this module.

`logo.png` and `views/img/logo-tecnoacquisti.svg` are Tecnoacquisti.com brand assets. Trademark rights are not granted by the module software license.

## Optional external jQuery delivery

All configured CDN modes load jQuery 3.7.1. The CDN services are external delivery providers, not additional libraries included in the module archive:

| Mode | Provider | Script endpoint |
| --- | --- | --- |
| 2 | Google Hosted Libraries | https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js |
| 3 | Microsoft Ajax CDN | https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.7.1.min.js |
| 4 | cdnjs | https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js |
| 5 | jsDelivr | https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js |

jQuery remains MIT-licensed in these modes. The local-copy hash verification does not verify the contents returned by every CDN. The existing template does not set Subresource Integrity attributes.

## Optional connection hints and merchant snippets

The fixed Google Fonts hints address `https://fonts.googleapis.com` and `https://fonts.gstatic.com`; the Analytics hints address `https://www.google-analytics.com/`; the Tag Manager hint addresses `https://www.googletagmanager.com/`. These hints do not themselves bundle fonts, Analytics or Tag Manager scripts. They can still initiate browser DNS lookups or connections.

Merchant-defined directives can add further code, libraries and remote destinations. Their contents are stored in the individual shop database and are not part of the delivered source inventory. The merchant must review those dependencies separately. This source review does not inventory production shop configuration, the theme or separately installed modules.
