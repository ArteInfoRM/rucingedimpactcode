# Changelog

## [1.0.9] - 2026-10-21

### Fixed

- Use a strict provider allowlist without the redundant integer type check flagged by static analysis.
- Add the missing copyright tag in the required author/copyright/license order to module-owned source headers.
- Add validator-readable MIT headers to the bundled jQuery builds while preserving the original upstream banner and executable code; document the distinct local and upstream hashes.

## [1.0.8] - 2026-10-21

### Added

- Add a jQuery version selector with 3.7.1 as the default and 4.0.0 as an explicit choice, applied to local and CDN loading.
- Include the unmodified full local jQuery 4.0.0 build; verify the existing local 3.7.1 file against the official distribution.
- Add version-specific SHA-384 Subresource Integrity and anonymous CORS to predefined CDN script tags for both versions.

### Changed

- Replace Microsoft CDN mode with the official jQuery CDN while preserving the saved provider ID.
- Use the official jQuery CDN when Google mode is selected with 4.0.0, preserving the requested version.
- Track the jQuery version preference in installation, uninstallation and server-side form validation; existing installations default to 3.7.1 without a database migration.
- Update third-party inventory and usage documentation for both jQuery builds.
- Include the updated module logo supplied by the project owner.

### Fixed

- Resolve the back-office credits logo from the module base URI so it loads on nested PrestaShop 9 configuration routes.
- Show the configuration save confirmation only when all setting writes succeed; report an error if any write fails while preserving custom HTML and JavaScript handling.
- Validate switches and select options with native PrestaShop validators and the form's allowed choices before writing any settings; preserve valid zero values and compatibility with disabled switches from older forms.
- Use native numeric switch values and display historical empty disabled values as zero.

## [1.0.7] - 2026-10-21

### License

- Apply MIT to module-owned source files and documentation with explicit owner authorization dated 2026-10-21; replace proprietary license headers and add the complete license text.
- Preserve the bundled jQuery 3.7.1 copyright and MIT terms; add its full upstream license.
- Preserve the AFL-3.0 license and attribution of the PrestaShop-derived directory guards and include the complete license text.

### Documentation and packaging

- Replace the minimal `Readme.md` with `README.md`; document configuration, compatibility declarations, executable custom snippets and upgrade limitations.
- Add security reporting, support status, third-party inventory and a CRA readiness note.
- Prepare a CycloneDX 1.5 inventory and verification evidence in the restricted internal archive outside the module.
- Add archive exclusions and directory guards for the new documentation and license directories.
- Correct the Apache 2.4 PHP-deny syntax in the module root `.htaccess` and add template/configuration-file protection from the workspace template. Nginx does not apply these rules.
- Generate HTML documentation from the Markdown sources.
- Normalize PHP arrays to short syntax, concatenation spacing and license-header separation for packaging; preserve executable behavior.

This first Git/tagged package keeps the supplied version 1.0.7. The date above identifies the first packaging of these reviewed sources under MIT, not the unknown original release date. Script handling, configuration processing, hook rendering and upgrade behavior remain unchanged. No completed CRA conformity assessment, clean ZIP installation/upgrade test or successful PrestaShop validator result is asserted.

## Supplied baseline: 1.0.7

The source entry point supplied for review declares version 1.0.7. No reliable historical release date, Git history or original distribution ZIP was available during this review. The existing upgrade scripts for 1.0.4 and 1.0.7 are preserved; their presence alone does not establish a release history.
