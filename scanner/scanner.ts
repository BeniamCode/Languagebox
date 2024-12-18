import { JSDOM } from 'jsdom';

const scanPage = (html: string): string[] => {
    const dom = new JSDOM(html);
    const elements = dom.window.document.querySelectorAll('[data-content]');
    return Array.from(elements).map(el => el.getAttribute('data-content') || '');
};

export default scanPage;
