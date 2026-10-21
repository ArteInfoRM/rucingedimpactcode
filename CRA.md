# CRA readiness review

`rucingedimpactcode`, source version 1.0.7, reviewed on 2026-10-21 by Tecnoacquisti.com® (Arte e Informatica di Loris Modena e C. s.a.s.).

This note describes source inventory, license alignment and documentation work. It is not an EU Cyber Resilience Act declaration of conformity or a completed product conformity assessment.

## Scope

The module adds resource connection hints, optional local/CDN jQuery 3.7.1 and merchant-defined executable head directives. It stores six configuration keys and contains a historical upgrade that creates a snippet archive table. It has no dedicated customer account, payment, authentication or security-filtering function. Custom directives may nevertheless execute code and contact arbitrary services in visitors' browsers.

The owner explicitly authorized MIT for module-owned material. Third-party jQuery MIT and PrestaShop-derived AFL-3.0 notices and legal texts are preserved. The existing compatibility declaration remains unchanged; see [README.md](README.md). Reporting and support status are documented in [SECURITY.md](SECURITY.md), and included versus external components in [THIRD-PARTY-NOTICES.md](THIRD-PARTY-NOTICES.md).

## Evidence

The restricted internal archive outside the module contains the original source snapshot, before/after SHA-256 inventories, CycloneDX 1.5 SBOM, schema validation, risk register, verification record and assessment manifest. The SBOM remains internal because future repository visibility and SBOM publication have not been decided. The archive is local evidence storage, not a verified independent backup.

At the start of the review, no original distribution ZIP or local Git repository was available. No historical release date, commit, tag or ZIP hash has been reconstructed.

The owner subsequently requested the first local commit, annotated tag `v1.0.7` and ZIP from that tag on 2026-10-21. Packaging changes normalize PHP array syntax, concatenation spacing and license-header separation without changing script behavior. A separate internal packaging record links the resulting tag, commit, SBOM and ZIP SHA-256. This local packaging operation does not imply GitHub publication, independent backup, completed manual controls or conformity approval.

## Outstanding decisions and controls

The owner requested that script/directive behavior remain unchanged. Source-review findings and proposed remediation are recorded internally; documenting them does not resolve them. Security support duration, maintained branches, CRA applicability/classification, technical documentation approval, incident-handling responsibilities and cover, and independent evidence retention still require owner decisions.

Clean ZIP installation/upgrade tests and execution of the applicable PrestaShop validator remain manual owner controls. They have not been reported as completed. Source lint and SBOM validation are separate checks and do not establish release readiness or legal conformity.
