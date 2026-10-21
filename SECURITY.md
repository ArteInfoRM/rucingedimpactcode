# Security policy

## Reporting a vulnerability

Report suspected vulnerabilities in `rucingedimpactcode` privately to [helpdesk@tecnoacquisti.com](mailto:helpdesk@tecnoacquisti.com). We handle reports for Tecnoacquisti.com® (Arte e Informatica di Loris Modena e C. s.a.s.). Do not use public issues for unpatched vulnerabilities.

Include the module, PrestaShop and PHP versions, relevant configuration without secrets, reproduction steps and potential impact. Do not include customer data, credentials, tokens or complete production database exports. If access credentials are necessary, follow our [protected credential procedure](https://www.tecnoacquisti.com/it/content/19-come-inviare-le-tue-password).

## Release and support status

The current package is version 1.0.9. The initial source review and first versioned package covered 1.0.7 with MIT licensing and CRA documentation. The existing PrestaShop declaration remains minimum 1.7, with the running PrestaShop version as maximum; use the PHP version supported by that platform release. Compatibility tests are not established by this documentation review.

The project owner has not defined a security support end date or approved a maintained-release policy for this module. No support promise for earlier releases is made. Contact the reporting address to confirm the remediation available for an installed version. This unresolved policy must be settled before publishing a complete support commitment.

## Security updates

Obtain applicable fix and advisory information, affected versions and update instructions from our [Help Center](https://help.tecnoacquisti.com/) or by contacting the private reporting address. The module does not contain an automatic updater or a dedicated advisory feed. Read the changelog and test a supplied update in staging.

Commercial assistance and download subscriptions are separate from the handling and availability of applicable security updates. No response-time or resolution-time SLA is promised in this file.

## Deployment precautions

Custom directives execute HTML and JavaScript in visitors' browsers. Keep configuration access restricted to trusted staff, review every snippet, and account for any external destinations in the shop's CSP and consent setup. Do not place secrets or personal data in custom directives. This review preserves the existing script behavior at the owner's request; this policy is not a claim that the code has been hardened.
