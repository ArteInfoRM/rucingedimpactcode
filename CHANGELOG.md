# Changelog

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
