/**
 * Blue Draft - Tracking events for GA4 / GTM / Meta Pixel
 * Pushes to dataLayer (GTM). When GA4/Meta loaded directly, also sends to gtag/fbq.
 */
(function () {
    function dataLayerPush(obj) {
        if (typeof window.dataLayer !== 'undefined') {
            window.dataLayer.push(obj);
        }
        if (typeof window.gtag === 'function') {
            window.gtag('event', obj.event || 'custom_event', obj);
        }
    }

    function trackMetaPixel(event, params) {
        if (typeof window.fbq === 'function') {
            window.fbq('track', event, params || {});
        }
    }

    // Phone click
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a[href^="tel:"]');
        if (link) {
            dataLayerPush({
                event: 'phone_click',
                link_url: link.getAttribute('href'),
                link_text: link.textContent?.trim?.() || 'phone',
            });
            trackMetaPixel('Contact');
        }
    });

    // Form submit (quote, contact, lead_magnet)
    document.addEventListener('submit', (e) => {
        const form = e.target;
        if (!form || form.tagName !== 'FORM') return;
        const formId = form.id || form.getAttribute('name') || 'form';
        const trackingType = form.getAttribute('data-tracking');
        let formType = 'contact';
        if (trackingType === 'lead_magnet') formType = 'lead_magnet';
        else if (form.closest('#quote') || form.action?.includes('quote')) formType = 'quote';
        else if (form.action?.includes('contact')) formType = 'contact';
        dataLayerPush({
            event: 'form_submit',
            form_id: formId,
            form_type: formType,
        });
        trackMetaPixel('Lead');
    });

    // Scroll 75%
    let scroll75Fired = false;
    window.addEventListener('scroll', () => {
        if (scroll75Fired) return;
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        if (docHeight > 0 && scrollTop / docHeight >= 0.75) {
            scroll75Fired = true;
            dataLayerPush({ event: 'scroll_75_percent' });
        }
    }, { passive: true });

    // Time on page (30s)
    let time30Fired = false;
    setTimeout(() => {
        if (!time30Fired) {
            time30Fired = true;
            dataLayerPush({ event: 'time_on_page_30s' });
        }
    }, 30000);

    // Service view (from __trackingData pushed by Blade)
    if (window.__trackingData?.service_slug) {
        dataLayerPush({
            event: 'service_view',
            service_slug: window.__trackingData.service_slug,
            service_title: window.__trackingData.service_title || '',
        });
        trackMetaPixel('ViewContent', { content_name: window.__trackingData.service_slug });
    }

    // Lead magnet & cost calculator (remarketing)
    if (window.__trackingData?.page_type && ['lead_magnet', 'cost_calculator'].includes(window.__trackingData.page_type)) {
        dataLayerPush({
            event: window.__trackingData.page_type + '_view',
            content_name: window.__trackingData.content_name || window.__trackingData.page_type,
        });
        trackMetaPixel('ViewContent', { content_name: window.__trackingData.content_name || window.__trackingData.page_type });
    }

    // Expose for manual use
    window.trackEvent = function (eventName, params = {}) {
        dataLayerPush({ event: eventName, ...params });
    };
})();
