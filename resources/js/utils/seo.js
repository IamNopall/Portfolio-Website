/**
 * SEO Manager Utility for Dynamic Metadata Management
 */

const DEFAULT_TITLE = 'Naufal Tsaqif — Informatics Engineer & Creative Developer';
const DEFAULT_DESC = 'Portfolio of Naufal Tsaqif (IamNopall), an Informatics Engineer and Creative Developer specializing in Unity 3D (C#), spatial mechanics, VR, Vue 3, Laravel, and tactile web interfaces.';
const DEFAULT_IMAGE = '/images/guwe.jpeg';
const DEFAULT_ROBOTS = 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';

function setMetaTag(attrName, attrValue, content) {
    if (!content) return;
    let element = document.querySelector(`meta[${attrName}="${attrValue}"]`);
    if (!element) {
        element = document.createElement('meta');
        element.setAttribute(attrName, attrValue);
        document.head.appendChild(element);
    }
    element.setAttribute('content', content);
}

function setCanonical(url) {
    let link = document.querySelector('link[rel="canonical"]');
    if (!link) {
        link = document.createElement('link');
        link.setAttribute('rel', 'canonical');
        document.head.appendChild(link);
    }
    link.setAttribute('href', url || window.location.href);
}

export function updateSeo({
    title = DEFAULT_TITLE,
    description = DEFAULT_DESC,
    image = DEFAULT_IMAGE,
    url = window.location.href,
    isNoIndex = false,
} = {}) {
    // 1. Title
    document.title = title;

    // 2. Standard Meta
    setMetaTag('name', 'description', description);
    setMetaTag('name', 'robots', isNoIndex ? 'noindex, nofollow' : DEFAULT_ROBOTS);
    setMetaTag('name', 'googlebot', isNoIndex ? 'noindex, nofollow' : 'index, follow');

    // 3. Open Graph
    setMetaTag('property', 'og:title', title);
    setMetaTag('property', 'og:description', description);
    setMetaTag('property', 'og:url', url);
    setMetaTag('property', 'og:image', image.startsWith('http') ? image : `${window.location.origin}${image}`);

    // 4. Twitter Cards
    setMetaTag('name', 'twitter:title', title);
    setMetaTag('name', 'twitter:description', description);
    setMetaTag('name', 'twitter:image', image.startsWith('http') ? image : `${window.location.origin}${image}`);

    // 5. Canonical URL
    if (!isNoIndex) {
        setCanonical(url);
    }
}
