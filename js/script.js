document.addEventListener('DOMContentLoaded', () => {
    const app = document.getElementById('language-box-app');
    if (app) {
        const language = app.getAttribute('data-language');
        const content = app.getAttribute('data-content');

        fetch(`/wp-content/plugins/language-box/languages/${language}.json`)
            .then(response => response.json())
            .then(data => {
                const translatedContent = data[content] || content;
                app.textContent = translatedContent;
            })
            .catch(error => console.error('Error fetching translation:', error));
    }
});
