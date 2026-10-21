{*
 * Copyright (c) 2009-2026 Arte e Informatica di Loris Modena e C. s.a.s.
 *
 * @author    Tecnoacquisti.com <helpdesk@tecnoacquisti.com>
 * @license   https://opensource.org/license/mit MIT License
 * @version   1.0.7
 *
 * See LICENSE.md for the complete license text.
*}

    <!-- Reduce the impact of third-party code Module by Tecnoacquisti.com -->
{if $google_font == 1}
    <link rel="dns-prefetch" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
{/if}
{if $google_analytics == 1}
    <link rel="dns-prefetch" href="https://www.google-analytics.com/" />
    <link rel="preconnect" href="https://www.google-analytics.com/" crossorigin>
{/if}
{if $google_tag == 1}
    <link rel="dns-prefetch" href="https://www.googletagmanager.com/" />
{/if}
{if $custom_head != ''}
    {$custom_head nofilter}
{/if}
{if  $jquery_local > 0 && $url_js != ''}
    <script src="{$url_js|escape:'htmlall':'UTF-8'}" type="text/javascript"{if $jquery_integrity != ''} integrity="{$jquery_integrity|escape:'htmlall':'UTF-8'}" crossorigin="anonymous"{/if}></script>
{/if}
    <!-- End Reduce the impact of third-party code -->
